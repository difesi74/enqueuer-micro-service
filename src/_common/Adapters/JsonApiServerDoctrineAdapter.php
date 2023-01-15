<?php

namespace App\Common\Adapters;

use App\Common\Constants\ApiConstants;
use App\Common\Contracts\JsonApiServerRepositoryInterface;
use Closure;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\QueryBuilder;
use Tobyz\JsonApiServer\Adapter\AdapterInterface;
use Tobyz\JsonApiServer\Context;
use Tobyz\JsonApiServer\Deferred;
use Tobyz\JsonApiServer\Schema\Attribute;
use Tobyz\JsonApiServer\Schema\HasMany;
use Tobyz\JsonApiServer\Schema\HasOne;
use Tobyz\JsonApiServer\Schema\Relationship;

final class JsonApiServerDoctrineAdapter implements AdapterInterface
{
    private $entityClass;
    private $repository;

    public function __construct(string $entityClasss, JsonApiServerRepositoryInterface $repository)
    {
        $this->entityClass = $entityClasss;
        $this->repository  = $repository;
    }

    public function query(): QueryBuilder
    {
        return $this->repository->query();
    }

    public function filterByIds($query, array $ids): void
    {
        if ($query instanceof QueryBuilder) {
            $this->repository->filterByIds($query, $ids);
        }
    }

    public function filterByAttribute($query, Attribute $attribute, $value, string $operator = '='): void
    {
        if ($query instanceof QueryBuilder) {
            $this->repository->filterByProperty($query, $attribute->getName(), $value, $operator);
        }
    }

    public function filterByRelationship($query, Relationship $relationship, Closure $scope): void
    {
        if ($query instanceof QueryBuilder) {
            $query = $this->repository->filterByRelationship($query, $relationship->getName(), $scope);
        }
    }

    public function sortByAttribute($query, Attribute $attribute, string $direction): void
    {
        if ($query instanceof QueryBuilder) {
            $this->repository->sortByProperty($query, $attribute->getName(), $direction);
        }
    }

    public function paginate($query, int $limit, int $offset): void
    {
        if ($query instanceof QueryBuilder) {
            $this->repository->paginate($query, $limit, $offset);
        }
    }

    public function find($query, string $id): ?object
    {
        return $this->repository->findById($id);
    }

    public function get($query): array
    {
        if ($query instanceof QueryBuilder) {
            return $this->repository->getQueryResult($query);
        }

        return [];
    }

    public function count($query): int
    {
        if ($query instanceof QueryBuilder) {
            return $this->repository->queryResultCount($query);
        }

        return 0;
    }

    public function getId($model): string
    {
        return $this->getProperty($model, 'id');
    }

    public function getAttribute($model, Attribute $attribute): mixed
    {
        return $this->getProperty($model, $attribute->getname());
    }

    public function getHasOne($model, HasOne $relationship, bool $linkageOnly, Context $context): Deferred
    {
        return new Deferred(function () use ($model, $relationship) {
            return $this->getProperty($model, $relationship->getName());
        });
    }

    public function getHasMany($model, HasMany $relationship, bool $linkageOnly, Context $context): Deferred
    {
        return new Deferred(function () use ($model, $relationship) {
            $related = $this->getProperty($model, $relationship->getName());

            if (!$related instanceof Collection) {
                return [];
            }

            return $related->toArray();
        });
    }

    public function represents($model): bool
    {
        return $model instanceof $this->entityClass;
    }

    public function model(): object
    {
        $entityClass = $this->entityClass;

        return new $entityClass();
    }

    public function setId($model, string $id): void
    {
    }

    public function setAttribute($model, Attribute $attribute, $value): void
    {
        $this->setProperty($model, $attribute->getName(), $value);
    }

    public function setHasOne($model, HasOne $relationship, $related): void
    {
        $this->setProperty($model, $relationship->getName(), $related);
    }

    public function save($model): void
    {
        $this->repository->save($model);
    }

    public function saveHasMany($model, HasMany $relationship, array $related): void
    {
        $previousRelated = $this->getProperty($model, $relationship->getName());

        if (!$previousRelated instanceof Collection) {
            return;
        }

        $previousRelated     = $previousRelated->toArray();
        $removeRelatedMethod = 'remove'.ucfirst(ApiConstants::getSingularApiTypes()[$relationship->getName()]);

        if (method_exists($model, $removeRelatedMethod)) {
            foreach ($previousRelated as $object) {
                $model = $model->{$removeRelatedMethod}($object);
            }
        }

        $addRelatedMethod = 'add'.ucfirst(ApiConstants::getSingularApiTypes()[$relationship->getName()]);

        if (method_exists($model, $addRelatedMethod)) {
            foreach ($related as $object) {
                $model = $model->{$addRelatedMethod}($object);
            }
        }
    }

    public function delete($model): void
    {
        $this->repository->delete($model);
    }

    private function getProperty(object $model, string $propertyName): mixed
    {
        $getMethodName = 'get'.ucfirst($propertyName);
        $isMethodName  = 'is'.ucfirst($propertyName);

        if (method_exists($model, $getMethodName)) {
            return $model->{$getMethodName}();
        }

        if (method_exists($model, $isMethodName)) {
            return $model->{$isMethodName}();
        }

        return null;
    }

    private function setProperty(object $model, string $propertyName, mixed $value): void
    {
        $setterName = 'set'.ucfirst($propertyName);

        if (method_exists($model, $setterName)) {
            $model->{$setterName}($value);
        }
    }
}

<?php

namespace App\Example;

use App\Common\Contracts\JsonApiServerRepositoryInterface;
use Closure;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method null|Example find($id, $lockMode = null, $lockVersion = null)
 * @method null|Example findOneBy(array $criteria, array $orderBy = null)
 * @method Example[]    findAll()
 * @method Example[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
final class ExampleRepository extends ServiceEntityRepository implements JsonApiServerRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Example::class);
    }

    public function findById(string $id): ?Example
    {
        return $this->find($id);
    }

    public function save(object $example): void
    {
        if (!$example->getCreatedAt()) {
            $this->_em->persist($example);
        }
        $this->_em->flush();
    }

    public function delete(object $example): void
    {
        $this->_em->remove($example);
        $this->_em->flush();
    }

    public function query(): QueryBuilder
    {
        return $this->createQueryBuilder('example');
    }

    public function filterByIds(QueryBuilder $query, array $ids): void
    {
        $query->andWhere($query->expr()->in('example.id', $ids));
    }

    public function filterByProperty(QueryBuilder $query, string $propertyName, mixed $value, string $operator = '='): void
    {
        $query->andWhere('example.'.$propertyName.' '.$operator.' :'.$propertyName)->setParameter($propertyName, $value);
    }

    public function filterByRelationship(QueryBuilder $query, string $relationName, Closure $scope): QueryBuilder
    {
        return $scope->call($this, $query, $relationName);
    }

    public function sortByProperty(QueryBuilder $query, string $propertyName, string $direction): void
    {
        $query->orderBy('example.'.$propertyName, strtoupper($direction));
    }

    public function paginate(QueryBuilder $query, int $limit, int $offset): void
    {
        $query->setFirstResult($offset)->setMaxResults($limit);
    }

    public function getQueryResult(QueryBuilder $query): array
    {
        return $query->getQuery()->getResult();
    }

    public function queryResultCount(QueryBuilder $query): int
    {
        return count($query->getQuery()->getResult());
    }
}

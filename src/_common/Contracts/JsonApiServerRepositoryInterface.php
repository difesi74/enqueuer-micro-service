<?php

namespace App\Common\Contracts;

use Closure;
use Doctrine\ORM\QueryBuilder;

interface JsonApiServerRepositoryInterface
{
    public function findById(string $id): ?object;

    public function save(object $model): void;

    public function delete(object $model): void;

    public function query(): QueryBuilder;

    public function filterByIds(QueryBuilder $query, array $ids): void;

    public function filterByProperty(QueryBuilder $query, string $propertyName, mixed $value, string $operator): void;

    public function filterByRelationship(QueryBuilder $query, string $relationName, Closure $scope): QueryBuilder;

    public function sortByProperty(QueryBuilder $query, string $propertyName, string $direction): void;

    public function paginate(QueryBuilder $query, int $limit, int $offset): void;

    public function getQueryResult(QueryBuilder $query): array;

    public function queryResultCount(QueryBuilder $query): int;
}

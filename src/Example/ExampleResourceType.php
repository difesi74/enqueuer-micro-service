<?php

namespace App\Example;

use App\Common\Adapters\JsonApiServerDoctrineAdapter;
use Tobyz\JsonApiServer\Context;
use Tobyz\JsonApiServer\Schema\Type;

final class ExampleResourceType
{
    private $exampleRepository;

    public function __construct(ExampleRepository $exampleRepository)
    {
        $this->exampleRepository = $exampleRepository;
    }

    public function type(): string
    {
        return 'examples';
    }

    public function adapter(): JsonApiServerDoctrineAdapter
    {
        return new JsonApiServerDoctrineAdapter(Example::class, $this->exampleRepository);
    }

    public function schema()
    {
        return function (Type $type) {
            $type->dontPaginate();

            $type->attribute('name')
                ->writable()
                ->filterable()
                ->sortable()
            ;

            $type->meta('createdAt', function ($model, Context $context) {
                return $model->getCreatedAt();
            });

            $type->meta('updatedAt', function ($model, Context $context) {
                return $model->getUpdatedAt();
            });

            $type->meta('deletedAt', function ($model, Context $context) {
                return $model->getDeletedAt();
            });
        };
    }
}

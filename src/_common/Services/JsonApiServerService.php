<?php

namespace App\Common\Services;

use App\Example\ExampleResourceType;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Tobyz\JsonApiServer\JsonApi;

final class JsonApiServerService
{
    private $api;
    private $resourceTypes;
    private $exampleResourceType;

    public function __construct(
        ExampleResourceType $exampleResourceType
    ) {
        $this->exampleResourceType = $exampleResourceType;

        $this->init();
    }

    public function handleRequest(ServerRequestInterface $request): ResponseInterface
    {
        try {
            $response = $this->api->handle($request);
        } catch (\Exception $e) {
            $response = $this->api->error($e);
        }

        return $response;
    }

    public function getApi(): JsonApi
    {
        return $this->api;
    }

    private function init()
    {
        $this->api = new JsonApi('/public');

        $this->resourceTypes = [
            $this->exampleResourceType,
        ];

        $this->loadResourceTypes();
    }

    private function loadResourceTypes()
    {
        foreach ($this->resourceTypes as $resourceType) {
            $this->api->resourceType($resourceType->type(), $resourceType->adapter(), $resourceType->schema());
        }
    }
}

<?php

namespace App\Example\Services;

use App\Common\Services\JsonApiServerService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class ExampleListFinderService
{
    private $jsonApiServerService;

    public function __construct(JsonApiServerService $jsonApiServerService)
    {
        $this->jsonApiServerService = $jsonApiServerService;
    }

    public function __invoke(ServerRequestInterface $psr7Request): ResponseInterface
    {
        return $this->jsonApiServerService->handleRequest($psr7Request);
    }
}

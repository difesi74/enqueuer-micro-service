<?php

namespace App\Common\Listeners;

use App\Common\Helpers\HttpHelper;
use App\Common\Services\JsonApiServerService;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;

final class ExceptionListener
{
    private $jsonApiServerService;

    public function __construct(JsonApiServerService $jsonApiServerService)
    {
        $this->jsonApiServerService = $jsonApiServerService;
    }

    public function onKernelException(ExceptionEvent $event): void
    {
        $exception = $event->getThrowable();

        $psr7Response = $this->jsonApiServerService->getApi()->error($exception);

        $response = HttpHelper::psr7ResponseToSymfonyJsonResponse($psr7Response);

        $event->setResponse($response);
    }
}

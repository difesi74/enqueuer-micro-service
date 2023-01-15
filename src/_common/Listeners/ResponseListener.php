<?php

namespace App\Common\Listeners;

use App\Common\Constants\ApiConstants;
use Symfony\Component\HttpKernel\Event\ResponseEvent;

final class ResponseListener
{
    public function onKernelResponse(ResponseEvent $event): void
    {
        $uri = $event->getRequest()->getUri();

        if (false !== strpos($uri, '/_profiler')) {
            return;
        }

        $response = $event->getResponse();
        $response->headers->set('Content-Type', ApiConstants::getJsonApiMediaType());
    }
}

<?php

namespace App\Common\Helpers;

use Nyholm\Psr7\Factory\Psr17Factory;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Symfony\Bridge\PsrHttpMessage\Factory\HttpFoundationFactory;
use Symfony\Bridge\PsrHttpMessage\Factory\PsrHttpFactory;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

final class HttpHelper
{
    public static function symfonyRequestToPsr7Request(Request $request): ServerRequestInterface
    {
        $psr17Factory   = new Psr17Factory();
        $psrHttpFactory = new PsrHttpFactory($psr17Factory, $psr17Factory, $psr17Factory, $psr17Factory);

        return $psrHttpFactory->createRequest($request);
    }

    public static function psr7ResponseToSymfonyJsonResponse(ResponseInterface $psrResponse)
    {
        $httpFoundationFactory = new HttpFoundationFactory();
        $response              = $httpFoundationFactory->createResponse($psrResponse);

        return JsonResponse::fromJsonString($response->getContent(), $response->getStatusCode());
    }
}

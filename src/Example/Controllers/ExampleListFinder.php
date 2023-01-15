<?php

namespace App\Example\Controllers;

use App\Common\Helpers\HttpHelper;
use App\Example\Services\ExampleListFinderService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

final class ExampleListFinder extends AbstractController
{
    private $exampleListFinderService;

    public function __construct(ExampleListFinderService $exampleListFinderService)
    {
        $this->exampleListFinderService = $exampleListFinderService;
    }

    #[Route('/examples', name: 'examples_list_finder', methods: ['GET'])]
    public function __invoke(Request $request): JsonResponse
    {
        $psr7Request = HttpHelper::symfonyRequestToPsr7Request($request);

        $psr7Response = $this->exampleListFinderService->__invoke($psr7Request);

        return HttpHelper::psr7ResponseToSymfonyJsonResponse($psr7Response);
    }
}

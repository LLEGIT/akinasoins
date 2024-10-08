<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Services\DiagnosisService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class DiagnosisController extends Controller
{

    public function __construct(
        private readonly DiagnosisService $diagnosisService,
    ) {}

    public function create(Request $request): JsonResponse {
        $body = $request->getContent() ?? null;

        if (null === $body) {
            return new JsonResponse('No body given in request', Response::HTTP_BAD_REQUEST);
        }

        if (false === $this->diagnosisService->create(json_decode($body, true))) {
            return new JsonResponse('Incorrect body request', Response::HTTP_BAD_REQUEST);
        }

        return new JsonResponse([], Response::HTTP_NO_CONTENT);
    }

    public function getAll(): JsonResponse
    {
        return new JsonResponse($this->diagnosisService->getAll(), Response::HTTP_OK);
    }

}

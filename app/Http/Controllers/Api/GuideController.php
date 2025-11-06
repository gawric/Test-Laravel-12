<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Guide;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Services\Interface\GuideServiceInterface;

class GuideController extends Controller
{
     private GuideServiceInterface $guideService;


     public function __construct(GuideServiceInterface $guideService)
     {
        $this->guideService = $guideService;
     }

     public function index(Request $request): JsonResponse
     {

        $guides = $this->guideService->listActiveGuides();

        if ($guides->isEmpty()) 
        {
            return $this->notFoundResponse('No active guides found');
        }

        return $this->successResponse($guides, 'Guides retrieved successfully');
     }





     private function successResponse($data, string $message = 'Success', int $statusCode = 200): JsonResponse
     {
        return response()->json([
            'success' => true,
            'data' => $data,
            'message' => $message
        ], $statusCode);
     }

     private function notFoundResponse(string $message = 'Resource not found', int $statusCode = 404): JsonResponse
     {
        return response()->json([
            'success' => false,
            'message' => $message
        ], $statusCode);
     }

     

}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Hunting;
use App\Models\Guide;
use App\Http\Requests\BookingStoreRequest;
use App\Services\Interface\BookingServiceInterface;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\JsonResponse;


class BookingController extends Controller
{
    private BookingServiceInterface $bookingService;

    public function __construct(BookingServiceInterface $bookingService)
    {
        $this->bookingService = $bookingService;
    }
    
    //participants_count >10  checked in BookingStoreRequest
    public function store(BookingStoreRequest $request): JsonResponse
    {
        try
        {
            $data = $request->only(['guide_id', 'date']);

            $guideId = $data['guide_id'];
            $date = $data['date'];


            if (!$this->bookingService->isValidDate($guideId, $date)) {
                        return $this->errorResponse('Invalid date for booking', self::HTTP_UNPROCESSABLE_ENTITY);
            }

            //$booking = $this->bookingService->createBooking($request);
                    
            return $this->successResponse([
                    'booking_id' => 9,
                    'date' => $request['date']
            ], 'Booking created successfully', self::HTTP_CREATED);
        } 
        catch (\Exception $e)
        {
                return $this->errorResponse('Failed to create booking', self::HTTP_INTERNAL_SERVER_ERROR);
        }
    }


   
    private function successResponse($data, string $message = 'Success', int $statusCode = 200): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => $data,
            'message' => $message
        ], $statusCode);
    }

   
    private function errorResponse(string $message, int $statusCode = 400): JsonResponse
    {
        return response()->json([
            'success' => false,
            'message' => $message
        ], $statusCode);
    }

    
}

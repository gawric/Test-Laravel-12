<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\Guide;
use Illuminate\Support\Facades\Log;

class BookingVerification
{
    
    public function handle(Request $request, Closure $next)
    {
        // Check if request expects JSON
        if (!$request->expectsJson()) {
            return response()->json([
                'success' => false,
                'message' => 'API request must accept JSON'
            ], 400);
        }

        return $next($request);
    }
}
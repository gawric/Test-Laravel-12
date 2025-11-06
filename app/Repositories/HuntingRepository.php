<?php

namespace App\Repositories;

use App\Models\Hunting;
use App\Repositories\Abstract\BaseRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Log;

class HuntingRepository extends BaseRepository
{
   
    public function __construct(Hunting $hunting)
    {
        parent::__construct($hunting);
    }
    
    public function hasBookingForDate(int $guideId, string $bookingDate): bool
    {
        try 
        {
            return $this->model
                ->where('guide_id', $guideId)
                ->whereDate('date', $date)
                ->exists();
        } 
        catch (\Exception $e)
        {
            $this->saveLog( $guideId,  $bookingDate ,  $e);
            return false;
        }
    }

    private function saveLog(int $guideId, string $bookingDate , \Exception $e)
    {
            Log::error('Error checking booking availability', [
                'guide_id' => $guideId,
                'date' => $bookingDate,
                'error' => $e->getMessage()
            ]);
    }
}
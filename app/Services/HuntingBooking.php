<?php

namespace App\Services;

use App\Models\Hunting;
use App\Models\Guide;
use App\Services\Interface\BookingServiceInterface;
use App\Services\AbstractService\BaseRepository;
use App\Services\AbstractService;
use Carbon\Carbon;
use App\Repositories\GuideRepository;
use App\Repositories\HuntingRepository;
use Illuminate\Support\Facades\Log;

class HuntingBooking implements BookingServiceInterface
{
  
    private GuideRepository $guideRepository;
    private HuntingRepository $huntingRepository;

    public function __construct(GuideRepository $guideRepository , HuntingRepository $huntingRepository)
    {
        $this->guideRepository = $guideRepository;
        $this->huntingRepository = $huntingRepository;
    }

    public function isValidDate(int $guideId, string $date): bool
    {
        try 
        {
            $guide = $this->guideRepository->findActiveGuide($guideId);

            if (!$guide) 
            {
                return false;
            }
            $bookingDate = Carbon::parse($date)->toDateString();
            return $this->huntingRepository->hasBookingForDate($guideId, $bookingDate) != true;
        }
        catch (\Exception $e)
        {
            return false;
        }
    }
}

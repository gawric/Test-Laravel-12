<?php

namespace App\Services\Interface;

interface BookingServiceInterface
{
    public function  isValidDate(int $guide_id , string $data) : bool;
}
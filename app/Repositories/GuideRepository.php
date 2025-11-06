<?php

namespace App\Repositories;

use App\Models\Guide;
use App\Repositories\Abstract\BaseRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class GuideRepository extends BaseRepository
{
   
    public function __construct(Guide $guide)
    {
        parent::__construct($guide);
    }


    public function getActiveGuides(): Collection
    {
        return $this->model
            ->where('is_active', true)
            ->orderBy('experience_years', 'desc')
            ->get();
    }

    public function findActiveGuide(int $guideId): ?Guide
    {
        return $this->findActive($guideId);
    }

    
}

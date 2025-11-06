<?php

namespace App\Services;

use App\Models\Guide;
use App\Services\Interface\GuideServiceInterface;
use App\Services\AbstractService\BaseRepository;
use App\Repositories\GuideRepository;

class GuideService  implements GuideServiceInterface
{
    private bool $filterActive = true;
    private GuideRepository $repository;

    public function __construct(GuideRepository $repository)
    {
        $this->repository = $repository;
    }


    public function listActiveGuides()
    {
        //$query = Guide::query();
        //$query->where('is_active', $this->filterActive);
        //return $query->get();

        return $this->repository->getActiveGuides();
    }
    
}
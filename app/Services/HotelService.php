<?php

namespace App\Services;

use App\Models\Hotel;
use App\Repositories\Contracts\HotelRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class HotelService
{
    /**
     * @var HotelRepositoryInterface
     */
    private $hotels;

    public function __construct(HotelRepositoryInterface $hotels)
    {
        $this->hotels = $hotels;
    }

    public function create(array $data): Hotel
    {
        return $this->hotels->create($data);
    }

    public function list(array $filters, int $perPage = 10): LengthAwarePaginator
    {
        return $this->hotels->paginateWithFilters($filters, $perPage);
    }
}

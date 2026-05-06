<?php

namespace App\Repositories\Contracts;

use App\Models\Hotel;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface HotelRepositoryInterface
{
    public function create(array $data): Hotel;

    public function paginateWithFilters(array $filters, int $perPage = 10): LengthAwarePaginator;
}

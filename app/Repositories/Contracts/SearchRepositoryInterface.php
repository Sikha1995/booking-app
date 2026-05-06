<?php

namespace App\Repositories\Contracts;

use Illuminate\Support\Collection;

interface SearchRepositoryInterface
{
    public function availableHotelsByCityAndGuests(string $city, int $guests): Collection;
}

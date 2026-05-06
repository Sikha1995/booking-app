<?php

namespace App\Repositories\Eloquent;

use App\Models\Hotel;
use App\Repositories\Contracts\SearchRepositoryInterface;
use Illuminate\Support\Collection;

class SearchRepository implements SearchRepositoryInterface
{
    public function availableHotelsByCityAndGuests(string $city, int $guests): Collection
    {
        return Hotel::query()
            ->where('city', 'like', '%' . $city . '%')
            ->with(['rooms' => function ($query) use ($guests) {
                $query->where('max_occupancy', '>=', $guests)
                    ->where('available_rooms', '>', 0);
            }])
            ->get()
            ->filter(function (Hotel $hotel) {
                return $hotel->rooms->isNotEmpty();
            })
            ->values();
    }
}

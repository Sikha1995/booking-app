<?php

namespace App\Repositories\Eloquent;

use App\Models\Hotel;
use App\Repositories\Contracts\HotelRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class HotelRepository implements HotelRepositoryInterface
{
    public function create(array $data): Hotel
    {
        return Hotel::query()->create($data);
    }

    public function paginateWithFilters(array $filters, int $perPage = 10): LengthAwarePaginator
    {
        return Hotel::query()
            ->when($filters['city'] ?? null, function ($query, $city) {
                $query->where('city', 'like', '%' . $city . '%');
            })
            ->when($filters['rating'] ?? null, function ($query, $rating) {
                $query->where('rating', $rating);
            })
            ->latest('id')
            ->paginate($perPage)
            ->withQueryString();
    }
}

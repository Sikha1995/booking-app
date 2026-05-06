<?php

namespace App\Repositories\Eloquent;

use App\Models\Room;
use App\Repositories\Contracts\RoomRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class RoomRepository implements RoomRepositoryInterface
{
    public function create(array $data): Room
    {
        return Room::query()->create($data);
    }

    public function paginate(int $perPage = 10): LengthAwarePaginator
    {
        return Room::query()
            ->with('hotel')
            ->latest('id')
            ->paginate($perPage);
    }
}

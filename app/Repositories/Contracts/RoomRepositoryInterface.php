<?php

namespace App\Repositories\Contracts;

use App\Models\Room;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface RoomRepositoryInterface
{
    public function create(array $data): Room;

    public function paginate(int $perPage = 10): LengthAwarePaginator;
}

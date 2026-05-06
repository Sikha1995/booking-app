<?php

namespace App\Services;

use App\Models\Room;
use App\Repositories\Contracts\RoomRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class RoomService
{
    /**
     * @var RoomRepositoryInterface
     */
    private $rooms;

    public function __construct(RoomRepositoryInterface $rooms)
    {
        $this->rooms = $rooms;
    }

    public function create(array $data): Room
    {
        return $this->rooms->create($data);
    }

    public function list(int $perPage = 10): LengthAwarePaginator
    {
        return $this->rooms->paginate($perPage);
    }
}

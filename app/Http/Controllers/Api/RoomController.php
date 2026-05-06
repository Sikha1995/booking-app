<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreRoomRequest;
use App\Http\Resources\RoomResource;
use App\Services\RoomService;

class RoomController extends Controller
{
    /**
     * @var RoomService
     */
    private $rooms;

    public function __construct(RoomService $rooms)
    {
        $this->rooms = $rooms;
    }

    public function store(StoreRoomRequest $request)
    {
        $room = $this->rooms->create($request->validated());

        return (new RoomResource($room))
            ->response()
            ->setStatusCode(201);
    }
}

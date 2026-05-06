<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\StoreRoomRequest;
use App\Models\Hotel;
use App\Services\RoomService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class RoomManagementController extends Controller
{
    /**
     * @var RoomService
     */
    private $rooms;

    public function __construct(RoomService $rooms)
    {
        $this->rooms = $rooms;
    }

    public function index(): View
    {
        return view('rooms.index', [
            'rooms' => $this->rooms->list(10),
            'hotels' => Hotel::query()->orderBy('name')->get(),
        ]);
    }

    public function store(StoreRoomRequest $request): RedirectResponse
    {
        $this->rooms->create($request->validated());

        return redirect()->route('rooms.index')->with('status', 'Room created successfully.');
    }
}

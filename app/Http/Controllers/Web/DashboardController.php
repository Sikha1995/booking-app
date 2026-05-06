<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Hotel;
use App\Models\Room;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(): View
    {
        $totalHotels = Hotel::query()->count();
        $totalRooms = Room::query()->count();

        return view('dashboard', [
            'totalHotels' => $totalHotels,
            'totalRooms' => $totalRooms,
            'totalAvailableUnits' => (int) Room::query()->sum('available_rooms'),
            'avgHotelRating' => $totalHotels ? round((float) Hotel::query()->avg('rating'), 1) : null,
            'avgRoomPrice' => $totalRooms ? round((float) Room::query()->avg('price_per_night'), 2) : null,
            'cityCount' => (int) Hotel::query()->selectRaw('count(distinct city) as aggregate')->value('aggregate'),
        ]);
    }
}

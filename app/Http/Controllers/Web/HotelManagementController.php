<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\StoreHotelRequest;
use App\Services\HotelService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HotelManagementController extends Controller
{
    /**
     * @var HotelService
     */
    private $hotels;

    public function __construct(HotelService $hotels)
    {
        $this->hotels = $hotels;
    }

    public function index(Request $request): View
    {
        return view('hotels.index', [
            'hotels' => $this->hotels->list($request->only(['city', 'rating']), 10),
            'filters' => $request->only(['city', 'rating']),
        ]);
    }

    public function store(StoreHotelRequest $request): RedirectResponse
    {
        $this->hotels->create($request->validated());

        return redirect()->route('hotels.index')->with('status', 'Hotel created successfully.');
    }
}

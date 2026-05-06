<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreHotelRequest;
use App\Http\Resources\HotelResource;
use App\Services\HotelService;
use Illuminate\Http\Request;

class HotelController extends Controller
{
    /**
     * @var HotelService
     */
    private $hotels;

    public function __construct(HotelService $hotels)
    {
        $this->hotels = $hotels;
    }

    public function store(StoreHotelRequest $request)
    {
        $hotel = $this->hotels->create($request->validated());

        return (new HotelResource($hotel))
            ->response()
            ->setStatusCode(201);
    }

    public function index(Request $request)
    {
        $hotels = $this->hotels->list($request->only(['city', 'rating']), (int) $request->get('per_page', 10));

        return HotelResource::collection($hotels);
    }
}

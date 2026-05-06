<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\SearchAvailabilityRequest;
use App\Http\Resources\HotelResource;
use App\Services\SearchService;

class SearchController extends Controller
{
    /**
     * @var SearchService
     */
    private $search;

    public function __construct(SearchService $search)
    {
        $this->search = $search;
    }

    public function __invoke(SearchAvailabilityRequest $request)
    {
        $validated = $request->validated();
        $results = $this->search->search(
            $validated['city'],
            $validated['checkin_date'],
            $validated['checkout_date'],
            (int) $validated['guests']
        );

        return HotelResource::collection($results);
    }
}

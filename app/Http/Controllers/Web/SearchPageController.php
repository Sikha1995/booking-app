<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\SearchAvailabilityRequest;
use App\Services\SearchService;
use Illuminate\View\View;

class SearchPageController extends Controller
{
    /**
     * @var SearchService
     */
    private $searchService;

    public function __construct(SearchService $searchService)
    {
        $this->searchService = $searchService;
    }

    public function index(): View
    {
        return view('search.index', [
            'results' => collect(),
        ]);
    }

    public function search(SearchAvailabilityRequest $request): View
    {
        $validated = $request->validated();
        $results = $this->searchService->search(
            $validated['city'],
            $validated['checkin_date'],
            $validated['checkout_date'],
            (int) $validated['guests']
        );

        return view('search.index', [
            'results' => $results,
        ]);
    }
}

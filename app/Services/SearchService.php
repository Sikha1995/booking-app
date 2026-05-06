<?php

namespace App\Services;

use App\Repositories\Contracts\SearchRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class SearchService
{
    /**
     * @var SearchRepositoryInterface
     */
    private $searchRepository;

    public function __construct(SearchRepositoryInterface $searchRepository)
    {
        $this->searchRepository = $searchRepository;
    }

    public function search(string $city, string $checkinDate, string $checkoutDate, int $guests): Collection
    {
        $checkin = Carbon::parse($checkinDate);
        $checkout = Carbon::parse($checkoutDate);
        $nights = $checkin->diffInDays($checkout);

        $cacheKey = sprintf(
            'search:%s:%s:%s:%d',
            strtolower($city),
            $checkin->toDateString(),
            $checkout->toDateString(),
            $guests
        );

        return Cache::remember($cacheKey, now()->addMinutes(5), function () use ($city, $guests, $nights) {
            return $this->searchRepository
                ->availableHotelsByCityAndGuests($city, $guests)
                ->map(function ($hotel) use ($nights) {
                    $rooms = $hotel->rooms->map(function ($room) use ($nights) {
                        $room->total_price = (float) $room->price_per_night * $nights;
                        return $room;
                    });

                    $hotel->setRelation('rooms', $rooms);
                    return $hotel;
                });
        });
    }
}

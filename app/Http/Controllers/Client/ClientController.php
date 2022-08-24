<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Destination;
use App\Models\Tour;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index(Destination $destination, Tour $tour)
    {
        return view('clients.index', [
            'destinations' => $destination->getDestinationHomepage(),
            'tours_attr' => $tour->getAttrTourHomepage(),
            'tours_cul' => $tour->getCulTourHomepage()
        ]);
    }

    public function tours(Tour $tour)
    {
        return view('clients.tours', [
            'all_tour' => $tour->getAllTour()
        ]);
    }

    public function detailTour(Tour $tour, $slug)
    {
        $tour = $tour->getBySlug($slug);
 
        return view('clients.slug-tour', [
            'data' => $tour,
            'related_tours' => $tour->getRelatedTour($tour->id),
            'tour_reviews' => $tour->getReview($tour->id),
            'stars' => $tour->countStar()
        ]);
    }
}

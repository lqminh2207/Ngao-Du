<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Tour;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    protected $booking;
    protected $tour;

    public function __construct(Tour $tour, Booking $booking)
    {
        $this->tour = $tour;
        $this->booking = $booking;
    }

    public function index()
    {
        return view('admin.bookings.index');
    }

    public function getData(Request $request)
    {
        if ($request->ajax())
        {
            return $this->booking->getDataAjax($request);
        }
    }
}

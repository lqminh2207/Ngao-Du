<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Tour;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function checkout(Request $request, Booking $payment, Tour $tour, $slug)
    {
        // dd($request);
        $tour = $tour->getBySlug($slug);

        return view('clients.checkout', [
            'data' => $tour,
            'date' => $request->date,
            'people' => $request->people
        ]);
    }
}

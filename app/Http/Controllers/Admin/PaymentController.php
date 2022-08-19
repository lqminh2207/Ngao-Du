<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Tour;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Stripe;

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

    public function stripe() 
    {
        return view('stripe');
    }

    public function stripePost(Request $request)
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        Stripe\Charge::create ([
                "amount" => 100 * 100,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Test payment from itsolutionstuff.com." 
        ]);
  
        Session::flash('success', 'Payment successful!');
          
        return back();
    }
}

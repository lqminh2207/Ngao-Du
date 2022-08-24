<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Tour;
use Error;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Stripe;

class PaymentController extends Controller
{
    protected $booking;
    protected $tour;

    public function __construct(Tour $tour, Booking $booking)
    {
        $this->tour = $tour;
        $this->booking = $booking;
    }

    public function checkout(Request $request, Tour $tour, $slug)
    {
        $tour = $tour->getBySlug($slug);

        return view('clients.checkout', [
            'data' => $tour,
            'date' => $request->date,
            'people' => $request->people
        ]);
    }

    public function stripe(Request $request, $id)
    {
        $bookingID = $request->id;

        $booking = $this->booking->findById($id);

        if($booking->payment_status != 2)
        {
            return redirect()->route('index');
        }

        $routePayment = route('stripe.post', $bookingID);
        $routeSuccess = route('paymentSuccess', $bookingID);

        return view('clients.payment', compact('routePayment', 'routeSuccess'));

    }

    public function storeStripe(Request $request)
    {
        $request->validate($this->booking->rules());
        $booking = $this->booking->saveData($request);

        $bookingID = $booking->id;

        return redirect()->route('stripe', $bookingID);
    }

    public function stripePost(Request $request, $id)
    {
        $booking = $this->booking->findOrFail($id);

        if (!($this->booking->where('payment_status', 2)->find($id))) {
            \abort(404);
        }

        $price = $booking->price * $booking->people;

        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        try {
            // retrieve JSON from POST body
            $jsonStr = file_get_contents('php://input');
            $jsonObj = json_decode($jsonStr);
        
            // Create a PaymentIntent with amount and currency
            $paymentIntent = \Stripe\PaymentIntent::create([
                'amount' => 100 * $price,
                'currency' => 'usd',
                'automatic_payment_methods' => [
                    'enabled' => true,
                ],
            ]);

            $input['payment_detail'] = json_encode($paymentIntent);
            $booking->update($input);
            
            $output = [
                'clientSecret' => $paymentIntent->client_secret,
            ];
 
            return json_encode($output);
        } catch (Error $e) {
            http_response_code(500);
            return json_encode(['error' => $e->getMessage()]);
        }
          
        return back();
    }

    public function paymentSuccess(Request $request, $id)
    {
        $booking = $this->booking->findOrFail($id);

        $stripe = new \Stripe\StripeClient(
            env('STRIPE_SECRET')
        );

        $payment_detail_arr = json_decode($booking->payment_detail);
        $payment_id = $payment_detail_arr->id;

        $newPaymentIntent = $stripe->paymentIntents->retrieve(
            $payment_id,
            []
        );

        if($request->redirect_status === "succeeded") 
        {
            $input['payment_detail'] = json_encode($newPaymentIntent);
            $input['payment_status'] = 1;
            $booking->update($input);
        }
        
        return view('clients.thanks');
    }

    public function stripeRefund(Request $request, $id)
    {
        $booking = $this->booking->find($id);
        $payment_detail_arr = json_decode($booking->payment_detail);

        $charge_id = $payment_detail_arr->charges->data[0]->id;
        
        $stripe = new \Stripe\StripeClient(
            env('STRIPE_SECRET')
        );

        $refund = $stripe->refunds->create([
            'charge' => $charge_id,
        ]);

        $input['payment_status'] = 3;
        $booking->update($input);
    }
}

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
        // dd($request);
        $tour = $tour->getBySlug($slug);

        return view('clients.checkout', [
            'data' => $tour,
            'date' => $request->date,
            'people' => $request->people
        ]);
    }

    public function stripe(Request $request)
    {
        $request->validate($this->booking->rules());
        $booking = $this->booking->saveData($request);

        $bookingID = $booking->id;
        $routePayment = route('stripe.post', $bookingID);
        $routeSuccess = route('paymentSuccess', $bookingID);

        return view('clients.payment', compact('routePayment', 'routeSuccess'));
    }

    public function stripePost(Request $request, $id)
    {
        $booking = $this->booking->find($id);
        $price = $booking->price * $booking->people;

        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        
        $stripe = new \Stripe\StripeClient(
            env('STRIPE_SECRET')
        );

        // $stripe->paymentIntents->retrieve(
        //     'pi_3LZVr1DlyvxhygrP0oCqHmAy',
        //     []
        // );

        // $bookingDetail = $request->id;
        // dd($bookingDetail);

        // $stripe = new Stripe();
        // $stripe = Stripe::make(env('STRIPE_SECRET'));

        // $charge_id = Session::get('charge_id');
        // $amount = Session::get('payment_amount');    
        // $refund = $stripe->refunds->create($charge_id, 100 * $price, ['reason' => 'refund']);

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
        $booking = $this->booking->find($id);

        if($request->redirect_status === "succeeded") 
        {
            $input['payment_status'] = 1;
            $booking->update($input);
        }
        
        return view('clients.thanks');
    }

    public function stripeRefund()
    {
        
    }
}

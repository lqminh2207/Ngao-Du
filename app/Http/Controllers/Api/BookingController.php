<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BookingResource;
use App\Models\Booking;
use App\Models\Tour;
use Error;
use Illuminate\Http\Request;
use Stripe;

class BookingController extends Controller
{
    protected $tour;
    protected $booking;

    public function __construct(Tour $tour, Booking $booking)
    {
        $this->tour = $tour;
        $this->booking = $booking;
    }

    public function getAllData()
    {
        $data = $this->booking->getAll();

        return response()->json([
            'data' => BookingResource::collection($data),
            'message' => 'Booking retrieved successfully.'
        ]);
    }

    public function storeStripe(Request $request)
    {
        $request->validate($this->booking->rules());
        $booking = $this->booking->saveData($request);

        return response()->json([
            'data' => new BookingResource($booking),
            'message' => 'Booking created successfully.'
        ]);
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
            $jsonStr = file_get_contents('php://input');
            $jsonObj = json_decode($jsonStr);
        
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
 
            return response([
                'data' => new BookingResource($booking),
                'message' => 'Stored payment information successfully.'
            ]);
        } catch (Error $e) {
            http_response_code(500);
            return response([
                'message' => 'Stored payment information failed.'
            ], 500);
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
            return response()->json([
                'message' => 'Payment was successfully processed!'
            ]);
        } else {
            return response()->json([
                'message' => 'Payment failed!'
            ]);
        }
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

        return response()->json([
            'message' => 'Refunded successfully'
        ]);
    }
}

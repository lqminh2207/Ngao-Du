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

    public function optionsPayment(Request $request)
    {
        $request->validate($this->booking->rules());
        $payment_method = $request->payment_method;
        $booking = $this->booking->saveData($request);

        $bookingID = $booking->id;

        if($payment_method == 1) {
            return redirect()->route('stripe', $bookingID);
        } else if($payment_method == 2) {
            $url = $this->momoPayment($request, $booking);
            return response()->json([
                'url' => $url,
            ]);
        } else {
            return redirect()->route('zaloPayment', $bookingID);
        }
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

        if($booking->payment_method == STRIPE) 
        {
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

        if($booking->payment_method == MOMO)
        {
            $result = $this->checkPaymentMomo($request, $booking);
            if($result['success']){
                return response()->json($result);
            }

            return response()->json($result, 500);
        }

        if($booking->payment_method == ZALOPAY)
        {
            
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

    public function execPostRequest($url, $data)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data))
        );
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        //execute post
        $result = curl_exec($ch);
        //close connection
        curl_close($ch);
        return $result;
    }

    public function momoPayment(Request $request, $booking)
    {
        $bookingID = $booking->id;

        $price = $booking->price * $booking->people;

        $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";

        $partnerCode = 'MOMOBKUN20180529';
        $accessKey = 'klm05TvNBzhg7h7j';
        $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';

        // $partnerCode = 'MOMOPMXV20220829';
        // $accessKey = 'LwsPU85egmX8oIzo';
        // $secretKey = 'zGjxmVeNMkw0jp4bFUxPx3wdPsJKl4wP';
        $orderInfo = "Thanh toán qua MoMo";
        $amount = $price * 24000;
        $orderId = time() ."";
        $redirectUrl =  route('paymentSuccess', $bookingID);
        $ipnUrl = route('ipnMomo', $bookingID);
        $extraData = json_encode(['bookingID' => $bookingID]);

        $requestId = time() . "";
        $requestType = "captureWallet";
        $extraData = "";

        //before sign HMAC SHA256 signature
        $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
        $signature = hash_hmac("sha256", $rawHash, $secretKey);
        $data = array(
            'partnerCode' => $partnerCode,
            'partnerName' => "Test",
            "storeId" => "MomoTestStore",
            'requestId' => $requestId,
            'amount' => $amount,
            'orderId' => $orderId,
            'orderInfo' => $orderInfo,
            'redirectUrl' => $redirectUrl,
            'ipnUrl' => $ipnUrl,
            'lang' => 'vi',
            'extraData' => $extraData,
            'requestType' => $requestType,
            'signature' => $signature
        );
        $result = $this->execPostRequest($endpoint, json_encode($data));    
        $jsonResult = json_decode($result, true);  // decode json

        $input['orderId'] = $orderId;
        $input['payment_detail'] = $jsonResult;
        $booking->update($input);
        $url = $jsonResult['payUrl'];

        return $url;
    }

    public function ipnMomo(Request $request, $bookingID)
    {
        $booking = $this->booking->findOrFail($bookingID);
        $result = $this->checkPaymentMomo($request, $booking);

        return response()->json($result);
    }

    public function checkPaymentMomo(Request $request, $booking)
    {
        $orderIdReal = $booking->orderId;

        $input['payment_detail'] = json_encode($request->all());
        $booking->update($input);

        $accessKey = 'klm05TvNBzhg7h7j';
        $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa'; //Put your secret key in there

        $partnerCode = $request->partnerCode;
        $orderId = $request->orderId;
        $requestId = $request->requestId;
        $amount = $request->amount;	
        $orderInfo = $request->orderInfo;
        $orderType = $request->orderType;
        $transId = $request->transId;
        $resultCode = $request->resultCode;
        $message = $request->message;
        $payType = $request->payType;
        $responseTime = $request->responseTime;
        $extraData = $request->extraData;
        $m2signature = $request->signature; //MoMo signature

        //Checksum
        $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&message=" . $message . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo .
            "&orderType=" . $orderType . "&partnerCode=" . $partnerCode . "&payType=" . $payType . "&requestId=" . $requestId . "&responseTime=" . $responseTime .
            "&resultCode=" . $resultCode . "&transId=" . $transId;

        $partnerSignature = hash_hmac("sha256", $rawHash, $secretKey);
        dd($m2signature, $partnerSignature, $orderIdReal, $orderId);
        $success = false;
        if (($m2signature == $partnerSignature) && ($orderIdReal == $orderId)) {
            if ($resultCode == '0') {
                $input['payment_status'] = 1;
                $booking->update($input);

                $success = true;
            } 
        } else {
            $message = 'This transaction could be hacked, please check your signature and returned signature';
        }
        
        return [
            'success' => $success,
            'message' => $message
        ];
    }
}

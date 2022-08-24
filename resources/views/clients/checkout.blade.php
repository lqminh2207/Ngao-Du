@extends('layouts.template')

@section('title', 'Checkout')

@section('header')
    <div class="checkout-page">
        <div class="container">
            <h2>Booking Submission</h2>
            <div class="row">
                <div class="col-12 col-md-7"><hr></div>
            </div>
            <form action="{{ route('stripe') }}" method="POST" class="form" id="form-1">
                <div class="row">
                    <div id="second-position-type2" class="col-12 col-md-12 col-lg-7 col-xl-7 booking-detail">
                        <h4>Traveler Details</h4>
                        <p>Information we need to confirm your tour or activity</p>
                            <div class="booking-detail-form">
                                <h5>Lead Traveler (Adult)</h5>
                                <div class="row">
                                    <div class="col-12 col-md-6 booking-detail-form-left">
                                        <input type="text" name="tour_id" id="tour_id" value="{{ $data->id }}" hidden>
                                        <div class="form-group">
                                            <label for="firstname">First Name<span>*</span></label>
                                            <input type="text" class="form-control form-control-lg" id="firstname" placeholder="Your Name" name="firstname">
                                            
                                            @if ($errors->has('firstname'))
                                                <span class="text-danger">
                                                    <small>{{ $errors->first('firstname') }}</small>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 booking-detail-form-right">
                                        <div class="form-group">
                                            <label for="lastname">Last Name<span>*</span></label>
                                            <input type="text" class="form-control form-control-lg" id="lastname" placeholder="Last Name" name="lastname">
                                            
                                            @if ($errors->has('lastname'))
                                                <span class="text-danger">
                                                    <small>{{ $errors->first('lastname') }}</small>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 booking-detail-form-left">
                                        <div class="form-group">
                                            <label for="email">Email<span>*</span></label>
                                            <input type="text" class="form-control form-control-lg" id="email" placeholder="email@domain.com" name="email">
                                            
                                            @if ($errors->has('email'))
                                                <span class="text-danger">
                                                    <small>{{ $errors->first('email') }}</small>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 booking-detail-form-right">
                                        <div class="form-group">
                                            <label for="phone">Phone Number<span>*</span></label>
                                            <input type="text" class="form-control form-control-lg" id="phone" placeholder="Your Phone" name="phone">
                                            
                                            @if ($errors->has('phone'))
                                                <span class="text-danger">
                                                    <small>{{ $errors->first('phone') }}</small>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <h5>Address</h5>
                                <div class="row">
                                    <div class="col-12 booking-detail-form-full">
                                        <div class="form-group">
                                            <label for="address">Your Address</label>
                                            <input type="text" class="form-control form-control-lg" id="address" placeholder="Your Address" name="address">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 booking-detail-form-left">
                                        <div class="form-group">
                                            <label for="city">City</label>
                                            <input type="text" class="form-control form-control-lg" id="city" placeholder="Your City" name="city">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 booking-detail-form-right">
                                        <div class="form-group">
                                            <label for="state">State/Province/Region</label>
                                            <input type="text" class="form-control form-control-lg" id="state" placeholder="Your State/Province/Region" name="state">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 booking-detail-form-left">
                                        <div class="form-group">
                                            <label for="code">Zip Code/ Postal Code</label>
                                            <input type="text" class="form-control form-control-lg" id="code" placeholder="Zip Code/ Postal Code" name="zip_code">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 booking-detail-form-right">
                                        <div class="form-group">
                                            <label for="country">Country</label>
                                            <input type="text" class="form-control form-control-lg" id="country" placeholder="Your Country" name="country">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="messenger"><h5>Special Requirement</h5></label>      
                                    <textarea id="messenger" class="form-control form-control-lg"  placeholder="Special Requirement" rows="4"></textarea>
                                </div>
                            </div>
                            <hr>
                            <div class="payment-method">
                                <h4>Payment Menthod</h4>
                                <p>Pay securely—we use SSL encryption to keep your data safe</p>
                                <div class="checkbox-align">
                                    <input type="radio" id="data1" name="payment_method" value="1" class="big">
                                    <label for="">Stripe</label><br>
                                    <img class="credit-card" src="{{ asset('image/checkout/credit-card.png') }}" alt="credit_card">
                                </div>
                                <div class="checkbox-align">
                                    <input type="radio" id="data1" name="payment_method" value="2" class="big">
                                    <label for="">Paypal</label><br>
                                    <img class="paypal" src="{{ asset('image/checkout/paypal') }}.png" alt="paypal">
                                </div>
                                <div class="checkbox-align">
                                    <input type="radio" id="data1" name="payment_method" value="3" class="big">
                                    <label for="">Pay in cash</label><br>
                                </div>
                            </div>
                            @if ($errors->has('payment_method'))
                                <span class="text-danger">
                                    <small>{{ $errors->first('payment_method') }}</small>
                                </span>
                            @endif
                            <ul class="list-dots">
                                <li>You will be charged the total amount once your order is confirmed.</li>
                                <li>If confirmation isn't received instantly, an authorization for the total amount will be held until your booking is confirmed.</li>
                                <li>You can cancel for free up to 24 hours before the day of the experience, local time.
                                    By clicking ‘Pay with PayPal,’ you are acknowledging that you have read and are bound by Ojimah’s </li>
                                <li>Customer Terms of Use, Privacy Policy, plus the tour operator’s rules & regulations (see the listing for more details).</li>
                            </ul>
                            <button type="submit"  class="push-filter" >Payment</button>
                    </div>
                    <div id="first-position-type2" class="col-12 col-md-8 col-lg-5 col-xl-4 detail-price-box">
                        <div class="detail-price">
                            <p class="title-detail-price">{{ $data->title }}</p>
                            <div class="detail-destination">
                                <img src="{{ asset('icon/location-orange.svg') }}" alt="">
                                <span>{{ $data->destination->title }}</span>
                            </div>
                            <div class="detail-price-content">
                                <div class="detail-duration">
                                    <span>Duration:</span>
                                    <p>{{ $data->duration_tour }}</p>
                                </div>
                                <div class="detail-tour-type">
                                    <span>Tour type:</span>
                                    <p>{{ $data->type->title }}</p>
                                </div>
                            </div>
                            <div class="tour-form-book">
                                <input class="tour-price" type="text" name="price" value="{{ $data->price }}" hidden>
                                <div class="input-group mb-4 mr-sm-2">
                                    <div class="input-group-prepend">
                                    <div class="input-group-text"><img src="{{ asset('icon/calendar-clock-oragne.svg') }}" alt=""></div>
                                    </div>
                                    <input type="date" name="start_at" value="{{ $date }}" min="{{ date('Y-m-d') }}" max="2099/01/01" class="date-form">
                                </div>
                                <div class="input-group mb-3 mr-sm-2">
                                    <div class="input-group-prepend">
                                    <div class="input-group-text"><img src="{{ asset('icon/people.svg') }}" alt=""></div>
                                    </div>
                                    <select class="js-example-basic-single form-control" id="people" name="people">
                                        <option value="{{ $people }}">{{ $people }} People</option>
                                        <option value="1">1 People</option>
                                        <option value="2">2 People</option>
                                        <option value="3">3 People</option>
                                        <option value="4">4 People</option>
                                        <option value="5">5 People</option>
                                        <option value="6">6 People</option>
                                        <option value="7">7 People</option>
                                        <option value="8">8 People</option>
                                        <option value="9">9 People</option>
                                        <option value="10">10 People</option>
                                        <option value="11">11 People</option>
                                        <option value="12">12 People</option>
                                        <option value="13">13 People</option>
                                        <option value="14">14 People</option>
                                        <option value="15">15 People</option>
                                        <option value="16">16 People</option>
                                        <option value="17">17 People</option>
                                        <option value="18">18 People</option>
                                        <option value="19">19 People</option>
                                        <option value="20">20 People</option>
                                    </select>
                                </div>  
                                <div class="promo-code">
                                    <input type="text" class="form-control" id="country" placeholder="Promo Code" name="Promo Code">
                                    <button type="submit">Apply</button>
                                </div>
                            </div>
                            <div class="total-price">
                                <h5>Total</h5>
                                <span id="total-price">$0</span>
                            </div>
                            @if ($errors->has('people'))
                                <span class="text-danger">
                                    <small>{{ $errors->first('people') }}</small>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div> 
@endsection

@push('scripts')
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>

    <script>
        $(document).ready(function() {
            let tour_price = $('.tour-price').val();
            let price = $('select[name=people]').val() * tour_price;
            $('#total-price').text('$' + price)

            $('#people').on('change', function() {
                price = $('select[name=people]').val() * tour_price;
                $('#total-price').text('$' + price)
            })
        })
    </script>
@endpush


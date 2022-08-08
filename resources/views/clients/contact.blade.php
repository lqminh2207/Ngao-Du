@extends('layouts.template')

@section('title', 'Contact')

@section('header')
    @include('elements.header-contact')
@endsection

@section('content')
    <div class="page-position">
        <div class="container">
            <a href="{{ route('index') }}">
                <span>Home</span>
            </a>
            <span class="dot-space dot-inital">Contact us</span>
        </div>
    </div>

    <div class="contact">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-6 contact-form-left">
                    <h2>We'd love to hear from you</h2>
                    <p>Send us a message and we'll respond as soon as possible</p>
                    <form action="{{ route('contacts.store') }}" method="POST" class="form" id="frm">
                        @csrf
                        <div class="form-group">
                            <input type="text" class="form-control form-control-lg" id="fullname" placeholder="Your Name" name="name">
                            @if ($errors->has('name'))
                                <span class="text-danger">
                                    <small>{{ $errors->first('name') }}</small>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control form-control-lg" placeholder="Your Email" id="email" name="email">
                            @if ($errors->has('email'))
                                <span class="text-danger">
                                    <small>{{ $errors->first('email') }}</small>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control form-control-lg" placeholder="Your Phone" name="phone" id="phone">
                            @if ($errors->has('phone'))
                                <span class="text-danger">
                                    <small>{{ $errors->first('phone') }}</small>
                                </span>
                            @endif
                        </div>
                        <div class="mb-3">
                            <div class="form-group">
                                <textarea id="messenger" class="form-control form-control-lg" name="message" placeholder="Message" rows="4"></textarea>
                                @if ($errors->has('message'))
                                <span class="text-danger">
                                    <small>{{ $errors->first('message') }}</small>
                                </span>
                                @endif
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">Send Message</button>
                    </form>
                </div>
                <div class="col-12 col-lg-6">
                    <div class="image-contact">
                        <img src="{{ asset('/image/contact/img1.png') }}" alt="">
                        <div class="image-contact-info">
                            <h2>Our Office</h2>
                            <div class="image-contact-info-horizontal">
                                <img src="{{ asset('/icon/address.svg') }}" alt="">
                                <div class="contact-content-right">
                                    <h6>Address</h6>
                                    <p>27 Old Gloucester Street, London, WC1N 3AX</p>
                                </div>
                            </div>
                            <div class="image-contact-info-horizontal">
                                <img src="{{ asset('icon/phone-big.svg') }}" alt="">
                                <div class="contact-content-right">
                                    <h6>Phone Number</h6>
                                    <p>+84 (0)20 33998400 </p>
                                </div>
                            </div>
                            <div class="image-contact-info-horizontal">
                                <img src="{{ asset('/icon/emal-big.svg') }}" alt="">
                                <div class="contact-content-right">
                                    <h6>Email Us</h6>
                                    <p>info@ngaoduvietnam.com</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="contact-map">
        <img src="{{ asset('/image/contact/map.png') }}" alt="map">
    </div>
@endsection


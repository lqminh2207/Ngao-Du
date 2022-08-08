@extends('layouts.template')

@section('title', 'Thanks')

@section('content')
    <div class="thanks-page">
        <div class="img-box">
            <img src="{{ asset('image/thanks/thankslider.png') }}" alt="">
            <div class="thanks-content">
                <h1>Thank You!</h1>
                <p>Your order has been successfully ordered. <br>
                    Order information has been emailed to you. Thank you!
                    </p>
                    <a href="{{ route('index') }}">Back to our home</a>
            </div>
        </div>
    </div>
@endsection

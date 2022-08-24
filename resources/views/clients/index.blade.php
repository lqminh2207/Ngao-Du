@extends('layouts.template')

@section('title', 'Home')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.theme.default.css') }}">
@endsection

@section('header')
    @include('elements.header')
@endsection

@section('content')
    <div class="about-ngaodu">
        <div class="container">
            <div class="row">
                <div id="second-position" class="col-12 col-md-12 col-lg-6 box-image"> 
                    <img src="{{ asset('image/home/home-img1') }}.png" alt="image">
                    <div class="sub-box-image">
                        <img src="{{ asset('image/home/home-img2') }}.png" alt="image">
                    </div>
                </div>
                <div id="first-position"  class="col-12 col-md-12 col-lg-6 about-content">
                    <h1>With <span>NgaoduVietnam</span>, immerses you in majestic space and unique cultural features</h1>
                    <div class="row">
                        <div class="col-1 col-lg-1 about-content-icon">
                            <img src="{{ asset('icon/quote.svg') }}" alt="">
                        </div>
                        <div class="col-10 col-lg-10 about-content-detail">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Purus viverra nuQlla eget sed odio. Vulputate risus faucibus sem non, feugiat nec consequat, montes. Elementum scelerisque phasellus donec lectus ullamcorper faucibus. Malesuada et adipiscing molestie egestas leo ut. </br> </br>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Purus viverra nuQlla eget sed odio. Vulputate risus faucibus sem non, feugiat nec consequat, montes. 
                        </div>
                    </div>
                </div>        
            </div>
        </div>
    </div>

    <div class="outstanding-location">  
        <div class="container">
            <div class="outstanding-location-header">
                <h1>Discover fascinating destinations</h1>
                <a href="">View all</a>
            </div>
            <div class="oustanding-location-detail">
                @if (!empty($destinations) && count($destinations) > 0)
                    <div id="oustanding-location-detail-carousel" class="owl-carousel owl-theme">
                        @foreach ($destinations as $item)
                            <div class="item">
                                <a href="">
                                    <img src="{{ $item->img_url }}" alt="image">
                                    <h5>{{ $item->title }}</h5>
                                    <span>{{ $item->tours_count }} experiences</span>
                                </a>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>  
    </div>
    
    <div class="attractive-tour">  
        <div class="container">
            <div class="attractive-tour-header">
                <h1>Attractive tour and interesting experiences</h1>
                <a href="{{ route('tours') }}">View all</a>
            </div>
            <div class="attractive-tour-detail">
                @if (!empty($tours_attr) && count($tours_attr) > 0)
                    <div id="attractive-tour-detail-carousel" class="owl-carousel owl-theme">
                        @foreach ($tours_attr as $item)
                            <div class="item">
                                <a href="{{ route('detailTour', $item->slug) }}">
                                    <div class="attractive-tour-box-image">
                                        <img src="{{ $item->img_url }}" alt="image">
                                        <img class="marker" src="{{ asset('icon/marker.svg') }}" alt="">
                                        <span class="vote-star"><img src="{{ asset('icon/star.svg') }}" alt="">{{ $item->countStar($item->id)['average'] }}</span>
                                    </div>
                                </a>
                                <p><img src="./icon/location-orange.svg" alt="">{{ $item->destination->title }}</p>
                                <a href="{{ route('detailTour', $item->slug) }}">{{ $item->title }}</a>
                                <div class="attractive-tour-detail-bottom">
                                    <p><img src="{{ asset('icon/calendar-clock-oragne.svg') }}" alt="">{{ $item->duration_tour }}</p>
                                    <p>from <span>${{ $item->price }}</span></p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>  
    </div>

    <div class="traditional-tour">  
        <div class="container">
            <div class="traditional-tour-header">
                <h1>Experience the traditional cultural beauties of Vietnam</h1>
                <a href="{{ route('tours') }}">View all</a>
            </div>
            <div class="traditional-tour-detail">
                @if (!empty($tours_cul) && count($tours_cul) > 0)
                    <div id="traditional-tour-detail-carousel" class="owl-carousel owl-theme">
                        @foreach ($tours_cul as $item)
                            <div class="item">
                                <a href="{{ route('detailTour', $item->slug) }}">
                                <div class="traditional-tour-box-image">
                                    <img src="{{ $item->img_url }}" alt="image">
                                    <img class="marker" src="{{ asset('icon/marker.svg') }}" alt="">
                                    <span class="vote-star"><img src="{{ asset('icon/star.svg') }}" alt="">{{ $item->countStar($item->id)['average'] }}</span>
                                </div>
                                </a>
                                <p><img src="./icon/location-orange.svg" alt="">{{ $item->destination->title }}</p>
                                <a href="{{ route('detailTour', $item->slug) }}">{{ $item->title }}</a>
                                <div class="traditional-tour-detail-bottom">
                                    <p><img src="{{ asset('icon/calendar-clock-oragne.svg') }}" alt="">{{ $item->duration_tour }}</p>
                                    <p>from <span>${{ $item->price }}</span></p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>  
    </div>

    <div class="send-email">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-6 email-content">
                    <h1>Leave us an email,<br>to get <span>the latest deals</span></h1>
                </div>
                <div class="col-12 col-md-6 email-form">
                    <form class="form-inline" action="/action_page.php">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><img src="{{ asset('icon/mail.svg') }}" alt=""></div>
                            </div>
                            <input type="email" class="form-control" placeholder="example@gmail.com" id="email">
                        </div>
                        <button type="submit" class="btn btn-primary">Send</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection


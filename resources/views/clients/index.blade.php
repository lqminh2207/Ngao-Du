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
                <div id="oustanding-location-detail-carousel" class="owl-carousel owl-theme">
                    <div class="item">
                        <a href="">
                            <img src="{{ asset('image/home/img1.png') }}" alt="image">
                        <h5>Sapa, Laocai</h5>
                        <span>24 experiences</span>
                        </a>
                    </div>
                    <div class="item">
                        <a href="">
                            <img src="{{ asset('image/home/img2.png') }}" alt="image">
                        <h5>Hoian, Quangnam</h5>
                        <span>12 experiences</span>
                        </a>
                    </div>
                    <div class="item">
                        <a href="">
                            <img src="{{ asset('image/home/img3.png') }}" alt="image">
                        <h5>Ba Na Hill, Danang</h5>
                        <span>28 experiences</span>
                        </a>
                    </div>
                    <div class="item">
                        <a href="">
                            <img src="{{ asset('image/home/img4.png') }}" alt="image">
                        <h5>Muine, Binhthuan</h5>
                        <span>11 experiences</span>
                        </a>
                    </div>
                    <div class="item">
                        <a href="">
                            <img src="{{ asset('image/home/img1.png') }}" alt="image">
                        <h5>Sapa, Laocai</h5>
                        <span>24 experiences</span>
                        </a>
                    </div>
                    <div  class="item">
                        <a href="">
                            <img src="{{ asset('image/home/img2.png') }}" alt="image">
                        <h5>Hoian, Quangnam</h5>
                        <span>12 experiences</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>  
    </div>
    
    <div class="attractive-tour">  
        <div class="container">
            <div class="attractive-tour-header">
                <h1>Attractive tour and interesting experiences</h1>
                <a href="">View all</a>
            </div>
            <div class="attractive-tour-detail">
                <div id="attractive-tour-detail-carousel" class="owl-carousel owl-theme">
                    <div class="item">
                        <a href="">
                            <div class="attractive-tour-box-image">
                                <img src="{{ asset('image/home/img5.png') }}" alt="image">
                                <img class="marker" src="{{ asset('icon/marker.svg') }}" alt="">
                                <span class="vote-star"><img src="{{ asset('icon/star.svg') }}" alt=""> 4.5</span>
                            </div>
                        </a>
                        <p><img src="./icon/location-orange.svg" alt=""> Sapa, Laocai</p>
                        <a href="">Discover interesting things in the romantic coastal city of Vungtau</a>
                        <div class="attractive-tour-detail-bottom">
                            <p><img src="{{ asset('icon/calendar-clock-oragne.svg') }}" alt=""> 3 days - 2 night</p>
                            <p>from <span>$146.00</span></p>
                        </div>
                    </div>
                    <div class="item">
                        <a href="">
                        <div class="attractive-tour-box-image">
                            <img src="{{ asset('image/home/img6.png') }}" alt="image">
                            <img class="marker" src="{{ asset('icon/marker.svg') }}" alt="">
                            <span class="vote-star"><img src="{{ asset('icon/star.svg') }}" alt=""> 4.5</span>
                        </div>
                    </a>
                        <p><img src="./icon/location-orange.svg" alt=""> Sapa, Laocai</p>
                        <a href="">Discover the most majestic Fansipan peak in Vietnam - the roof of Indochina                            </a>
                        <div class="attractive-tour-detail-bottom">
                            <p><img src="{{ asset('icon/calendar-clock-oragne.svg') }}" alt=""> 3 days - 2 night</p>
                            <p>from <span>$234.00</span></p>
                        </div>
                    </div>
                    <div class="item">
                        <a href="">
                        <div class="attractive-tour-box-image">
                            <img src="{{ asset('image/home/img7.png') }}" alt="image">
                            <img class="marker" src="{{ asset('icon/marker.svg') }}" alt="">
                            <span class="vote-star"><img src="{{ asset('icon/star.svg') }}" alt=""> 4.5</span>
                        </div>
                    </a>
                        <p><img src="{{ asset('icon/location-orange.svg') }}" alt=""> Sapa, Laocai</p>
                        <a href="">Experience sea tourism on Phuquoc golden pearl                            </a>
                        <div class="attractive-tour-detail-bottom">
                            <p><img src="{{ asset('icon/calendar-clock-oragne.svg') }}" alt=""> 3 days - 2 night</p>
                            <p>from <span>$334.00</span></p>
                        </div>
                    </div>
                    <div class="item">
                        <a href="">
                        <div class="attractive-tour-box-image">
                            <img src="{{ asset('image/home/img5.png') }}" alt="image">
                            <img class="marker" src="{{ asset('icon/marker.svg') }}" alt="">
                            <span class="vote-star"><img src="{{ asset('icon/star.svg') }}" alt=""> 4.5</span>
                        </div>
                    </a>
                        <p><img src="./icon/location-orange.svg" alt=""> Sapa, Laocai</p>
                        <a href="">Discover interesting things in the romantic coastal city of Vungtau</a>
                        <div class="attractive-tour-detail-bottom">
                            <p><img src="{{ asset('icon/calendar-clock-oragne.svg') }}" alt=""> 3 days - 2 night</p>
                            <p>from <span>$146.00</span></p>
                        </div>
                    </div>
                    <div class="item">
                        <a href="">
                        <div class="attractive-tour-box-image">
                            <img src="{{ asset('image/home/img6.png') }}" alt="image">
                            <img class="marker" src="{{ asset('icon/marker.svg') }}" alt="">
                            <span class="vote-star"><img src="{{ asset('icon/star.svg') }}" alt=""> 4.5</span>
                        </div>
                    </a>
                        <p><img src="./icon/location-orange.svg" alt=""> Sapa, Laocai</p>
                        <a href="">Discover the most majestic Fansipan peak in Vietnam - the roof of Indochina                            </a>
                        <div class="attractive-tour-detail-bottom">
                            <p><img src="{{ asset('icon/calendar-clock-oragne.svg') }}" alt=""> 3 days - 2 night</p>
                            <p>from <span>$234.00</span></p>
                        </div>
                    </div>
                    <div class="item">
                        <a href="">
                        <div class="attractive-tour-box-image">
                            <img src="{{ asset('image/home/img7.png') }}" alt="image">
                            <img class="marker" src="{{ asset('icon/marker.svg') }}" alt="">
                            <span class="vote-star"><img src="{{ asset('icon/star.svg') }}" alt=""> 4.5</span>
                        </div>
                    </a>
                        <p><img src="./icon/location-orange.svg" alt=""> Sapa, Laocai</p>
                        <a href="">Experience sea tourism on Phuquoc golden pearl                            </a>
                        <div class="attractive-tour-detail-bottom">
                            <p><img src="{{ asset('icon/calendar-clock-oragne.svg') }}" alt=""> 3 days - 2 night</p>
                            <p>from <span>$334.00</span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>  
    </div>

    <div class="traditional-tour">  
        <div class="container">
            <div class="traditional-tour-header">
                <h1>Experience the traditional cultural beauties of Vietnam</h1>
                <a href="">View all</a>
            </div>
            <div class="traditional-tour-detail">
                <div id="traditional-tour-detail-carousel" class="owl-carousel owl-theme">
                    <div class="item">
                        <a href="">
                        <div class="traditional-tour-box-image">
                             <img src="{{ asset('image/home/img8.png') }}" alt="image">
                            <img class="marker" src="{{ asset('icon/marker.svg') }}" alt="">
                            <span class="vote-star"><img src="{{ asset('icon/star.svg') }}" alt=""> 4.5</span>
                        </div>
                    </a>
                        <p><img src="./icon/location-orange.svg" alt=""> Lang Vong, Hanoi</p>
                        <a href="">“ Com lang Vong “ - Traditional culinary features of the old Hanoi people</a>
                        <div class="traditional-tour-detail-bottom">
                            <p><img src="{{ asset('icon/calendar-clock-oragne.svg') }}" alt=""> 6 hours</p>
                            <p>from <span>$234.00</span></p>
                        </div>
                    </div>
                    <div class="item">
                        <a href="">
                        <div class="traditional-tour-box-image">
                             <img src="{{ asset('image/home/img9.png') }}" alt="image">
                            <img class="marker" src="{{ asset('icon/marker.svg') }}" alt="">
                            <span class="vote-star"><img src="{{ asset('icon/star.svg') }}" alt=""> 4.5</span>
                        </div>
                    </a>
                        <p><img src="./icon/location-orange.svg" alt=""> Hue City, Thuathienhue</p>
                        <a href="">“ Bun bo Hue “ - culinary specialties in the ancient capital of Hue</a>
                        <div class="traditional-tour-detail-bottom">
                            <p><img src="{{ asset('icon/calendar-clock-oragne.svg') }}" alt=""> 3 days - 2 night</p>
                            <p>from <span>$234.00</span></p>
                        </div>
                    </div>
                    <div class="item">
                        <a href="">
                        <div class="traditional-tour-box-image">
                            <img src="{{ asset('image/home/img10.png') }}" alt="image">
                            <img class="marker" src="{{ asset('icon/marker.svg') }}" alt="">
                            <span class="vote-star"><img src="{{ asset('icon/star.svg') }}" alt=""> 4.5</span>
                        </div>
                    </a>
                        <p><img src="./icon/location-orange.svg" alt=""> Tiendu, Bacninh</p>
                        <a href="">Heritage of Quan Ho Bac Ninh - Singing passionate hearts</a>
                        <div class="traditional-tour-detail-bottom">
                            <p><img src="{{ asset('icon/calendar-clock-oragne.svg') }}" alt=""> 2 hours</p>
                            <p>from <span>$234.00</span></p>
                        </div>
                    </div>
                    <div class="item">
                        <a href="">
                        <div class="traditional-tour-box-image">
                             <img src="{{ asset('image/home/img8.png') }}" alt="image">
                            <img class="marker" src="{{ asset('icon/marker.svg') }}" alt="">
                            <span class="vote-star"><img src="{{ asset('icon/star.svg') }}" alt=""> 4.5</span>
                        </div>
                    </a>
                        <p><img src="./icon/location-orange.svg" alt=""> Lang Vong, Hanoi</p>
                        <a href="">“ Com lang Vong “ - Traditional culinary features of the old Hanoi people</a>
                        <div class="traditional-tour-detail-bottom">
                            <p><img src="{{ asset('icon/calendar-clock-oragne.svg') }}" alt=""> 6 hours</p>
                            <p>from <span>$234.00</span></p>
                        </div>
                    </div>
                    <div class="item">
                        <a href="">
                        <div class="traditional-tour-box-image">
                             <img src="{{ asset('image/home/img9.png') }}" alt="image">
                            <img class="marker" src="{{ asset('icon/marker.svg') }}" alt="">
                            <span class="vote-star"><img src="{{ asset('icon/star.svg') }}" alt=""> 4.5</span>
                        </div>
                    </a>
                        <p><img src="./icon/location-orange.svg" alt=""> Hue City, Thuathienhue</p>
                        <a href="">“ Bun bo Hue “ - culinary specialties in the ancient capital of Hue</a>
                        <div class="traditional-tour-detail-bottom">
                            <p><img src="{{ asset('icon/calendar-clock-oragne.svg') }}" alt=""> 6 hours</p>
                            <p>from <span>$234.00</span></p>
                        </div>
                    </div>
                    <div class="item">
                        <a href="">
                        <div class="traditional-tour-box-image">
                            <img src="{{ asset('image/home/img10.png') }}" alt="image">
                            <img class="marker" src="{{ asset('icon/marker.svg') }}" alt="">
                            <span class="vote-star"><img src="{{ asset('icon/star.svg') }}" alt=""> 4.5</span>
                        </div>
                    </a>
                        <p><img src="./icon/location-orange.svg" alt=""> Tiendu, Bacninh</p>
                        <a href="">Heritage of Quan Ho Bac Ninh - Singing passionate hearts</a>
                        <div class="traditional-tour-detail-bottom">
                            <p><img src="{{ asset('icon/calendar-clock-oragne.svg') }}" alt=""> 2 hours</p>
                            <p>from <span>$234.00</span></p>
                        </div>
                    </div>
                </div>
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


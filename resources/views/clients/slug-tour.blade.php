@extends('layouts.template')

@section('title', 'Detail tour')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/splide.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/splide-skyblue.min.css') }}">
@endsection

@section('header')
    @include('elements.menu-slug')
@endsection

@section('content')
    <div class="page-position">
        <div class="container">
            <a href="{{ route('index') }}">
                <span>Home</span>
            </a>
            <a href="{{ route('tours') }}">
                <span class="dot-space">Tours</span>
            </a>
            <span class="dot-space dot-inital">Detail tour</span>
        </div>
    </div>

    <div class="detail-tour">
        <div class="container">
            <h2>{{ $data->title }}</h2>
            <div class="tour-destination">
                <img src="{{ asset('icon/location-orange.svg') }}" alt="">
                <span>{{ $data->destination->title }}</span>
            </div>
            <div class="rating-tour">
                <span class="vote-star"><img src="{{ 'icon/star.svg' }}" alt="">{{ $stars['average'] }}</span>
                <p class="rating-nunber">128 reviews</p>
            </div>
            <div class="row">
                @if (!empty($data->galleries) && count($data->galleries) > 0)
                    <div class="col-12 col-lg-7 col-xl-7 detail-content-left">
                        <div id="image-slider" class="splide">
                            <div class="splide__track">
                                <ul class="splide__list">
                                    @foreach ($data->galleries as $item)
                                    <li class="splide__slide">
                                            <img src="{{ $item->image }}">
                                            <img class="marker" src="./icon/marker.svg" alt="">
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div id="thumbnail-slider" class="splide">
                            <div class="splide__track">
                                <ul class="splide__list">
                                    @foreach ($data->galleries as $item)
                                    <li class="splide__slide">
                                        <img src="{{ $item->image }}">
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endif

                <div class="col-12 col-lg-5 col-xl-4 detail-price">
                    <div class="detail-price-box">
                        <p>from <span>
                            $<span class="tour-price">{{ $data->price }}</span>
                        </span>                        
                        </p>
                    </div>
                    <hr>
                    <div class="detail-price-box">
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
                            <form action="{{ route('checkout', $data->slug) }}">
                                <div class="input-group mb-4 mr-sm-2">
                                    <div class="input-group-prepend">
                                    <div class="input-group-text"><img src="{{ asset('icon/calendar-clock-oragne.svg') }}" alt=""></div>
                                    </div>
                                    <input type="date" name="date" value="{{ date('Y-m-d') }}" min="{{ date('Y-m-d') }}" max="2025-01-01" class="date-form">
                                </div>
                                <div class="input-group mb-4 mr-sm-2">
                                    <div class="input-group-prepend">
                                    <div class="input-group-text"><img src="{{ asset('icon/people.svg') }}" alt=""></div>
                                    </div>
                                    <select class="js-example-basic-single form-control" id="form-payment" name="people">
                                        <option value="" disabled selected>Numbers of people</option>
                                        <option value="1">1 Adult</option>
                                        <option value="2">2 Adults</option>
                                        <option value="3">3 Adults</option>
                                        <option value="4">4 Adults</option>
                                        <option value="5">5 Adults</option>
                                        <option value="6">6 Adults</option>
                                        <option value="7">7 Adults</option>
                                        <option value="8">8 Adults</option>
                                        <option value="9">9 Adults</option>
                                        <option value="10">10 Adults</option>
                                        <option value="11">11 Adults</option>
                                        <option value="12">12 Adults</option>
                                        <option value="13">13 Adults</option>
                                        <option value="14">14 Adults</option>
                                        <option value="15">15 Adults</option>
                                        <option value="16">16 Adults</option>
                                        <option value="17">17 Adults</option>
                                        <option value="18">18 Adults</option>
                                        <option value="19">19 Adults</option>
                                        <option value="20">20 Adults</option>
                                    </select>
                                </div>
                                <div class="total-price">
                                    <h5>Total</h5>
                                    <span id="total-price">$0</span>
                                </div>
                                <button type="submit" class="btn btn-primary">Book now</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class=" col-12 col-lg-7 tour-tabs">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="description-tab" data-toggle="tab" href="#description" role="tab" aria-controls="description" aria-selected="true">Descriptions</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="addition-tab" data-toggle="tab" href="#addition" role="tab" aria-controls="addition" aria-selected="false">Additional Info</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="review-tab" data-toggle="tab" href="#review" role="tab" aria-controls="review" aria-selected="false">Reviews(54)</a>
                        </li>
                    </ul>
                    <hr>
                        <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="description" role="tabpanel" aria-labelledby="description-tab">
                            @if (!empty($data->overview))
                                <h5>Overview</h5>
                                <ul class="list-dots">
                                    <p>{!! $data->overview !!}</p>
                                </ul>
                                <hr>
                            @endif
                            @if (!empty($data->include))
                                <h5>What's Included</h5>
                                <ul class="list-check">
                                    <p>{!! $data->include !!}</p>
                                </ul>
                                <hr>
                            @endif
                            @if (!empty($data->departure))
                                <div class="departure" style="color: #1E1E1ECC;">
                                    <p>{!! $data->departure !!}</p>
                                </div>
                                <hr>
                            @endif

                            @if (!empty($data->itineraries) && count($data->itineraries) > 0)
                                <h5>Tour Itinerary</h5>
                                <div id="accordion1" class="description-part">
                                    @foreach ($data->itineraries as $key => $itinerary)
                                    <div class="card">
                                        <div class="card-header card-header-{{ $key }}" id="heading{{ $key }}">
                                        <h5 class="mb-0 ">
                                            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse{{ $key }}" aria-expanded="false" aria-controls="collapse{{ $key }}">
                                                {{ $itinerary->title }}
                                                <img class="collapse-arrow" src="{{ asset('icon/collapse-arrow.svg') }}" alt="">
                                            </button>
                                        </h5>
                                        </div>
                                    
                                        <div id="collapse{{ $key }}" class="collapse-rotate collapse" aria-labelledby="heading{{ $key }}" data-parent="#accordion1">
                                        <div class="card-body">
                                            @if (!empty($itinerary->places))
                                                <div class="tour-schedule">
                                                    @foreach ($itinerary->places as $place)
                                                        <div class="tour-schedule-destination">
                                                            <div class="tour-schedule-destination-content">
                                                                <h6>{!! $place->title !!}</h6>
                                                                <div>{!! $place->content !!}</div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @endif
                                        </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            @endif
                            
                            @if (!empty($data->map))
                                <h5>Maps</h5>
                                <iframe width="100%" height="400px" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" id="gmap_canvas" src="{{ $data->map }}"></iframe> <a href='https://www.add-map.net/'></a> 
                            @endif
                            @if (!empty($data->image_360))
                                <h5>360° Panoramic Images and Videos</h5>
                                <iframe width="100%" height="400px" src="{{ $data->image_360 }}" frameborder="0"></iframe>
                            @endif
                            @if (!empty($data->video))
                                <iframe width="100%" height="400px" src="{{ $data->video }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                            @endif
                        </div>
                        <div class="tab-pane fade" id="addition" role="tabpanel" aria-labelledby="addition-tab">
                            @if (!empty($data->additional))
                                <ul class="list-dots">
                                    {!! $data->additional !!}
                                </ul>
                            @endif

                            @if (!empty($data->faqs) && count($data->faqs))
                                <h5>FAQs</h5>
                                <div id="accordion" class="addition-part">
                                    @foreach ($data->faqs as $key => $faq)
                                        <div class="card">
                                            <div class="card-header card-header-{{ $key }} active" id="heading{{ $key }}">
                                            <h5 class="mb-0 ">
                                                <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapse{{ $key }}" aria-expanded="false" aria-controls="collapse{{ $key }}">
                                                <div class="row">
                                                    <div class="col-1">
                                                        <img src="{{ asset('icon/help-circle.svg') }}" alt="">
                                                    </div>
                                                    <div class="col-10">
                                                        {{ $faq->question }}
                                                    </div>
                                                    <div class="col-1">
                                                        <img class="collapse-arrow" src="{{ asset('icon/collapse-arrow.svg') }}" alt="">
                                                    </div>
                                                </div>
                                            </button>
                                            </h5>
                                            </div>
                                            
                                            <div id="collapse{{ $key }}" class="collapse-rotate collapse" aria-labelledby="heading{{ $key }}" data-parent="#accordion">
                                            <div class="card-body">
                                                <div class="tour-question">
                                                    <div class="tour-question-content">
                                                        <div class="row">
                                                            <div class="col-1"></div>
                                                            <div class="col-11">
                                                                <p>{!! $faq->answer !!}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                        <div class="tab-pane fade" id="review" role="tabpanel" aria-labelledby="review-tab">
                            <div class="review-part">
                                <div class="row rate-area">
                                    <div class="col-12 col-md-5 col-lg-4 total-rate">
                                        <h1>{{ $stars['average'] }}/5</h1>
                                        <img src="{{ asset('icon/4star-rate.svg') }}" alt="">
                                        <p>Based on <span>{{ $stars['total'] }} reviews</span></p>
                                    </div>
                                    <div class="col-12 col-md-7 col-lg-8 each-rate">
                                        <div class="number-rates 5-star">
                                            <h6>5</h6>
                                            <img src="{{ 'icon/star-assess' }}.svg" alt="">
                                            <div class="rate-bar">
                                                <span class="progress-bar" style="width: {{ $stars['average_five'] }}%;"></span>
                                            </div>
                                            <span>{{ $stars['five_star'] }} reviews</span>
                                        </div>
                                        <div class="number-rates 4-star">
                                            <h6>4</h6>
                                            <img src="{{ 'icon/star-assess' }}.svg" alt="">
                                            <div class="rate-bar">
                                                <span class="progress-bar" style="width: {{ $stars['average_four'] }}%;"></span>
                                            </div>
                                            <span>{{ $stars['four_star'] }} reviews</span>
                                        </div>
                                        <div class="number-rates 3-star">
                                            <h6>3</h6>
                                            <img src="{{ 'icon/star-assess' }}.svg" alt="">
                                            <div class="rate-bar">
                                                <span class="progress-bar" style="width: {{ $stars['average_three'] }}%;"></span>
                                            </div>
                                            <span>{{ $stars['three_star'] }} reviews</span>
                                        </div>
                                        <div class="number-rates 2-star">
                                            <h6>2</h6>
                                            <img src="{{ 'icon/star-assess' }}.svg" alt="">
                                            <div class="rate-bar">
                                                <span class="progress-bar" style="width: {{ $stars['average_two'] }}%;"></span>
                                            </div>
                                            <span>{{ $stars['two_star'] }} reviews</span>
                                        </div>
                                        <div class="number-rates 1-star">
                                            <h6>1</h6>
                                            <img src="{{ 'icon/star-assess' }}.svg" alt="">
                                            <div class="rate-bar">
                                                <span class="progress-bar" style="width: {{ $stars['average_one'] }}%;"></span>
                                            </div>
                                            <span>{{ $stars['one_star'] }} reviews</span>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="review-guest-comment">
                                    <img src="./icon/guest-icon.svg" alt="">
                                    <form action="{{ route('reviews.store', $data->id) }}" method="POST" class="form" id="form-1">
                                        @csrf
                                        <textarea id="messenger" class="form-control form-control-lg" name="message" placeholder="Type anything" rows="3"></textarea>
                                        <div class="submit-comment">
                                            <div class="stars">
                                                <input class="star fa fa-star star-5" id="star-5" type="radio" value="5" name="star"/>
                                                <label class="star fa fa-star star-5" for="star-5"></label>
                                                <input class="star fa fa-star star-4" id="star-4" type="radio" value="4" name="star"/>
                                                <label class="star fa fa-star star-4" for="star-4"></label>
                                                <input class="star fa fa-star star-3" id="star-3" type="radio" value="3" name="star"/>
                                                <label class="star fa fa-star star-3" for="star-3"></label>
                                                <input class="star fa fa-star star-2" id="star-2" type="radio" value="2" name="star"/>
                                                <label class="star fa fa-star star-2" for="star-2"></label>
                                                <input class="star fa fa-star star-1" id="star-1" type="radio" value="1" name="star"/>
                                                <label class="star fa fa-star star-1" for="star-1"></label>
                                            </div>
                                            <button type="submit" id="btn-sub" class="btn btn-primary mt-3">Upload review</button>
                                        </div>
                                    </form>
                                </div>
                                @if ($errors->has('star'))
                                    <span class="text-danger">
                                        <small>{{ $errors->first('star') }}</small>
                                    </span>
                                @endif
                                @if ($errors->has('message'))
                                    <span class="text-danger">
                                        <small>{{ $errors->first('message') }}</small>
                                    </span>
                                @endif
                                <hr>
                                @if (!empty($tour_reviews) && count($tour_reviews) > 0)
                                    @foreach ($tour_reviews as $review)
                                        <div class="review-commented">
                                            <div class="info-people-commented">
                                                <img src="{{ asset('icon/Alex-icon.svg') }}" alt="">
                                                <div class="title-commented">
                                                    <img src="{{ asset('icon/5star-rate.svg') }}" alt="">
                                                    <p>The best experience ever!</p>
                                                    <span>Nevermind</span>
                                                    <span class="dot-space">Sep 2020</span>
                                                </div>
                                            </div>
                                            <p>{{ $review->message }}</p>
                                        </div>
                                        <hr>
                                    @endforeach
                                    {{ $tour_reviews->links('elements.paginateR') }}
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="related-tour list-related-tour">
                <div class="related-tour-detail">
                    @if (!empty($related_tours) && count($related_tours) > 0)
                    <h5>Related tours</h5>
                        <div class="row" style="justify-content: unset;">
                            @foreach ($related_tours as $item)
                                <div class="col-12 col-md-6 col-lg-4 item">
                                    <a href="{{ route('detailTour', $item->slug) }}">
                                        <div class="related-tour-box-image">
                                            <img src="{{ $item->img }}" alt="image">
                                            <img class="marker" src="./icon/marker.svg" alt="">
                                            <span class="vote-star"><img src="{{ 'icon/star.svg' }}" alt="">{{ $item->countStar($item->id)['average'] }}</span>
                                        </div>
                                    </a>
                                    <p><img src="{{ asset('icon/location-orange.svg') }}" alt="">{{ $item->destination->title }}</p>
                                    <a href="{{ route('detailTour', $item->slug) }}">{{ $item->title }}</a>
                                    <div class="related-tour-detail-bottom">
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
    </div>
@endsection

@push('scripts')
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
    <script src="{{ asset("js/splide.min.js") }}"></script>

    <script>
        $(document).ready(function() {
            // $('#btn-sub').on('click' ,function(e) {
            //     e.preventDefault();
            //     $(this).attr('disabled', true);
            // })

            $('.js-example-basic-single').select2();
            let tour_price = $('.tour-price').text();
            $('#form-payment').on('change', function(e) {
                let price = $('select[name=people]').val() * tour_price;
                $('#total-price').text('$' + price)
            })  
        });
        
    </script>

    <script>
        document.addEventListener( 'DOMContentLoaded', function () {
            var main = new Splide( '#image-slider', {
                cover      : true,
                heightRatio: 1,
                type      : 'fade',
                rewind    : false,
                pagination: false,
                arrows    : true,
                fixedWidth: '100%',
                height: 545,
                breakpoints: {
                    767: {
                        height: 330,
                    },
                    1024: {
                        height: 590,
                    },
                    1400: {
                        height: 545,
                    },
                }
            } );

        var thumbnails = new Splide( '#thumbnail-slider', {
            fixedWidth  : 137,
            fixedHeight : 97,
            rewind      : false,
            arrows: false,
            pagination  : false,
            cover       : true,
            isNavigation: true,
            gap: 30,    
            focus: 'center',
            breakpoints: {
                    768: {
                        gap: 10,
                    },
                    1024: {
                        gap: 20,
                    },
                    1400: {
                        gap: 30,
                    },
                }
        } );

        main.sync( thumbnails );
        main.mount();
        thumbnails.mount();
        } );

        
        // var btn = document.getElementById("btn-sub")
        // btn.disabled = true

        // setTimeout(()=>{
        //     btn.disabled = false
        // }, 2000)
        
    </script>
@endpush  


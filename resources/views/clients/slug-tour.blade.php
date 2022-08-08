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
            <h2>Discover interesting things in the romantic coastal city of Vungtau</h2>
            <div class="tour-destination">
                <img src="{{ asset('icon/location-orange.svg') }}" alt="">
                <span>Vungtau City, Baria-Vungtau</span>
            </div>
            <div class="rating-tour">
                <span class="vote-star"><img src="{{ 'icon/star.svg' }}" alt=""> 4.5</span>
                <p class="rating-nunber">128 reviews</p>
            </div>
            <div class="row">
                <div class="col-12 col-lg-7 col-xl-7 detail-content-left">
                    <div id="image-slider" class="splide">
                        <div class="splide__track">
                            <ul class="splide__list">
                                <li class="splide__slide">
                                    <img src="{{ asset('image/tour-detail/img1.png') }}">
                                    <img class="marker" src="./icon/marker.svg" alt="">
                                </li>
                                <li class="splide__slide">
                                    <img src="{{ asset('image/list-tour/img1.png') }}">
                                    <img class="marker" src="./icon/marker.svg" alt="">
                                </li>
                                <li class="splide__slide">
                                    <img src="{{ asset('image/list-tour/img9.png') }}">
                                    <img class="marker" src="./icon/marker.svg" alt="">
                                </li>
                                <li class="splide__slide">
                                    <img src="{{ asset('image/list-tour/img15.png') }}">
                                    <img class="marker" src="./icon/marker.svg" alt="">
                                </li>
                                <li class="splide__slide">
                                    <img src="{{ asset('image/list-tour/img2.png') }}">
                                    <img class="marker" src="./icon/marker.svg" alt="">
                                </li>
                                <li class="splide__slide">
                                    <img src="{{ asset('image/list-tour/img3.png') }}">
                                    <img class="marker" src="./icon/marker.svg" alt="">
                                </li>
                                <li class="splide__slide">
                                    <img src="{{ asset('image/list-tour/img4.png') }}">
                                    <img class="marker" src="./icon/marker.svg" alt="">
                                </li>
                                <li class="splide__slide">
                                    <img src="{{ asset('image/list-tour/img5.png') }}">
                                    <img class="marker" src="./icon/marker.svg" alt="">
                                </li>
                                <li class="splide__slide">
                                    <img src="{{ asset('image/list-tour/img6.png') }}">
                                    <img class="marker" src="./icon/marker.svg" alt="">
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div id="thumbnail-slider" class="splide">
                        <div class="splide__track">
                            <ul class="splide__list">
                                <li class="splide__slide">
                                    <img src="{{ asset('image/tour-detail/img1.png') }}">
                                </li>
                                <li class="splide__slide">
                                    <img src="{{ asset('image/list-tour/img1.png') }}">
                                </li>
                                <li class="splide__slide">
                                    <img src="{{ asset('image/list-tour/img9.png') }}">
                                </li>
                                <li class="splide__slide">
                                    <img src="{{ asset('image/list-tour/img15.png') }}">
                                </li>
                                <li class="splide__slide">
                                    <img src="{{ asset('image/list-tour/img2.png') }}">
                                </li>
                                <li class="splide__slide">
                                    <img src="{{ asset('image/list-tour/img3.png') }}">
                                </li>
                                <li class="splide__slide">
                                    <img src="{{ asset('image/list-tour/img4.png') }}">
                                </li>
                                <li class="splide__slide">
                                    <img src="{{ asset('image/list-tour/img5.png') }}">
                                </li>
                                <li class="splide__slide">
                                    <img src="{{ asset('image/list-tour/img6.png') }}">
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg-5 col-xl-4 detail-price">
                    <div class="detail-price-box">
                        <p>from <span>$234.00</span></p>
                    </div>
                    <hr>
                    <div class="detail-price-box">
                        <div class="detail-price-content">
                            <div class="detail-duration">
                                <span>Duration:</span>
                                <p>3 days - 2 nights</p>
                            </div>
                            <div class="detail-tour-type">
                                <span>Tour type:</span>
                                <p>Sun - Beach</p>
                            </div>
                        </div>
                        <div class="tour-form-book">
                            <form action="/action_page.php">
                                <div class="input-group mb-4 mr-sm-2">
                                    <div class="input-group-prepend">
                                    <div class="input-group-text"><img src="{{ asset('icon/calendar-clock-oragne.svg') }}" alt=""></div>
                                    </div>
                                    <input type="date" name="date" value="2021-07-22" min="2021-01-01" max="2025-01-01" class="date-form">
                                </div>
                                <div class="input-group mb-4 mr-sm-2">
                                    <div class="input-group-prepend">
                                    <div class="input-group-text"><img src="{{ asset('icon/people.svg') }}" alt=""></div>
                                    </div>
                                    <select class="js-example-basic-single form-control" id="tour-types" name="state">
                                        <option>Number of people</option>
                                        <option>1 Adult</option>
                                        <option>2 Adults</option>
                                        <option>3 Adults</option>
                                        <option>4 Adults</option>
                                        <option>5 Adult</option>
                                        <option>6 Adults</option>
                                        <option>7 Adults</option>
                                        <option>8 Adults</option>
                                        <option>9 Adult</option>
                                        <option>10 Adults</option>
                                        <option>11 Adults</option>
                                        <option>12 Adults</option>
                                        <option>13 Adults</option>
                                        <option>14 Adults</option>
                                        <option>15 Adult</option>
                                        <option>16 Adults</option>
                                        <option>17 Adults</option>
                                        <option>18 Adults</option>
                                        <option>19 Adult</option>
                                        <option>20 Adults</option>
                                    </select>
                                </div>
                                <div class="total-price">
                                    <h5>Total</h5>
                                    <span>$450.00</span>
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
                            <h5>Overview</h5>
                            <p>Set sail for the idyllic Italian island of Capri on this full-day tour, including round-trip jetfoil transfers from Naples or Sorrento. 
                                Stop to browse the handicraft stores of Anacapri and soak up the atmosphere in buzzing La Piazzetta. 
                                Top it off with a visit to the Blue Grotto and a funicular ride to Marina Grande.</p>
                            <ul class="list-dots">
                                <li>Full-day tour of Capri island from Naples or Sorrento Admire views along the coast as you cruise to the island by jetfoil</li>
                                <li> Visit the lively island towns of Anacapri and Capri Ride</li>
                                <li>The funicular from La Piazzetta to Marina Grande Marvel at natural wonders like the Blue Grotto Small-group tour ensures a personalized experience</li>
                            </ul>
                            <hr>
                            <h5>What's Included</h5>
                            <ul class="list-check">
                                <li>Port pickup and drop-off</li>
                                <li>Local guide</li>
                                <li>Round-trip shared transfer</li>
                                <li>Transport by minibus</li>
                                <li>Blue Grotto admission tickets</li>
                                <li>Shared boat ride tour around the island ( if Blue grotto is closed)</li>
                            </ul>
                            <hr>
                            <h5>Departure & Return</h5>
                            <span>Departure Point</span>
                            <p>1: Molo Beverello, 80133 Napoli NA, Italy</p>
                            <p class="mb-3">2: Hotel Il Faro, Via Marina Piccola, 5, 80067 Sorrento NA, Italy</p>
                            <span>Departure Time</span>
                            <p>8:00 AM</p>
                            <hr>
                            <h5>Tour Itinerary</h5>
                            <div id="accordion1" class="description-part">
                                <div class="card">
                                    <div class="card-header card-header-first" id="headingOne">
                                    <h5 class="mb-0 ">
                                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        Day 1: Molo Beverello (4 stops)
                                            <img class="collapse-arrow" src="{{ asset('icon/collapse-arrow.svg') }}" alt="">
                                        </button>
                                    </h5>
                                    </div>
                                
                                    <div id="collapseOne" class="collapse-rotate collapse show" aria-labelledby="headingOne" data-parent="#accordion1">
                                    <div class="card-body">
                                        <div class="tour-schedule">
                                            <div class="tour-schedule-destination">
                                                <div class="tour-schedule-destination-content">
                                                    <h6>Molo Beverello</h6>
                                                    <p>We start our trip from the famouse place Jemaa Lefna in center of Marrakech, Crossed the highest Atlas Through pass (Tizi N Tichka)</p><br>
                                                    <p><span>Duration: </span>5 minutes</p>
                                                    <p>Admission Ticket Free</p>
                                                </div>
                                            </div>
                                            <div class="tour-schedule-destination">
                                                <div class="tour-schedule-destination-content">
                                                    <h6>Mariana Piccola</h6>
                                                    <p>so we will visit the UNESCO World Heritage Site Ait Benhaddou / Official name Ksar of Ait-Ben-Haddou is located in south of Morocco, 
                                                        It is an ighrem (fortified village in English) (ksar in Arabic), along the former caravan route between the Sahara and Marrakech in present-day Morocco. Most citizens attracted by the tourist trade live in more modern dwellings in a village on the other side of the river, although there are four families still living in the ancient village. Inside the walls of the ksar are half a dozen (Kasbahs) or merchants houses and other individual dwellings, </p><br>
                                                    <p><span>Duration: </span>1 hour 30 minutes</p>
                                                    <p>Admission Ticket Free</p>
                                                </div>
                                            </div>
                                            <div class="tour-schedule-destination">
                                                <div class="tour-schedule-destination-content">
                                                    <h6>Blue Grotto</h6>
                                                    <p>Pass trough the Ait Saouen Col in anti atlas</p><br>
                                                </div>
                                            </div>
                                            <div class="tour-schedule-destination">
                                                <div class="tour-schedule-destination-content">
                                                    <h6>Villa San Michele</h6>
                                                    <p>Crossed by the Draa valley, where there is more than 2 million palms along the draa river which stretches for a length to Senegal to the south.</p><br>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header" id="headingTwo">
                                        <h5 class="mb-0 ">
                                        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                            Day 2: Marina Piccola (1 stop)
                                            <img class="collapse-arrow" src="{{ asset('icon/collapse-arrow.svg') }}" alt="">
                                        </button>
                                        </h5>
                                    </div>
                                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion1">
                                        <div class="card-body">
                                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                <div class="card-header" id="headingThree">
                                    <h5 class="mb-0 ">
                                    <button class="btn btn-link collapsed"  data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                        Day 3: Marina Piccola (1 stop)
                                        <img class="collapse-arrow" src="{{ asset('icon/collapse-arrow.svg') }}" alt="">
                                    </button>
                                    </h5>
                                </div>
                                <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion1">
                                    <div class="card-body">
                                    Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                </div>
                                </div>
                                </div>
                            </div>
                            <h5>Maps</h5>
                            <iframe width="100%" height="400px" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" id="gmap_canvas" src="https://maps.google.com/maps?width=520&amp;height=400&amp;hl=en&amp;q=%20Hanoi+()&amp;t=&amp;z=12&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"></iframe> <a href='https://www.add-map.net/'>Add-Map</a> 
                            <script type='text/javascript' src='https://embedmaps.com/google-maps-authorization/script.js?id=16f2ec9ea42b59b38c7ffccd9ca5f4216850af7a'></script>
                            <h5>360° Panoramic Images and Videos</h5>
                            <iframe width="100%" height="400px" src="https://momento360.com/e/u/adbe00019890481c91e55e0c1d8ea295?utm_campaign=embed&utm_source=other&heading=318.17&pitch=-44.28&field-of-view=70&size=medium" frameborder="0"></iframe>
                            <video width="100%" height="auto" controls>
                                <source src="{{ asset('image/video.mp4') }}" type="video/mp4">
                            </video>
                        </div>
                        <div class="tab-pane fade" id="addition" role="tabpanel" aria-labelledby="addition-tab">
                            <ul class="list-dots">
                                <li>Confirmation will be received at time of booking</li>
                                <li>Not recommended for travelers with back problems </li>
                                <li>Not recommended for pregnant travelers Infant seats available </li>
                                <li>Not wheelchair accessible </li>
                                <li>Children must be accompanied by an adult</li>
                                <li>Vegetarian option is available, please advise at time of booking if required.</li>
                                <li>Minimum numbers apply.</li>
                                <li>There is a possibility of cancellation after confirmation if the meteorological. </li>
                                <li>conditions do not allow it</li>
                                <li>Stroller accessible </li>
                                <li>Service animals allowed </li>
                                <li>Near public transportation </li>
                                <li>Most travelers can participate </li>
                                <li>This tour/activity will have a maximum of 17 travelers</li>
                            </ul>

                            <h5>FAQs</h5>
                            <div id="accordion" class="addition-part">
                                <div class="card">
                                    <div class="card-header card-header-first active" id="headingOne">
                                    <h5 class="mb-0 ">
                                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        <div class="row">
                                            <div class="col-1">
                                                <img src="{{ asset('icon/help-circle.svg') }}" alt="">
                                            </div>
                                            <div class="col-10">
                                                What is the maximum group size during 2 Days 1 Night To Zagora Desert From Marrakech?
                                            </div>
                                            <div class="col-1">
                                                <img class="collapse-arrow" src="./{{ asset('icon/collapse-arrow.svg') }}" alt="">
                                            </div>
                                        </div>
                                    </button>
                                    </h5>
                                    </div>
                                    
                                    <div id="collapseOne" class="collapse-rotate collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                                    <div class="card-body">
                                        <div class="tour-question">
                                            <div class="tour-question-content">
                                                <div class="row">
                                                    <div class="col-1"></div>
                                                    <div class="col-11">
                                                        <p>This activity will have a maximum of 17 travelers.</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header" id="headingTwo">
                                        <h5 class="mb-0 ">
                                        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                            <div class="row">
                                                <div class="col-1">
                                                    <img src="{{ asset('icon/help-circle.svg') }}" alt="">
                                                </div>
                                                <div class="col-10">
                                                    When and where does the tour start?
                                                </div>
                                                <div class="col-1">
                                                    <img class="collapse-arrow" src="./{{ asset('icon/collapse-arrow.svg') }}" alt="">
                                                </div>
                                            </div>
                                        </button>
                                        </h5>
                                    </div>
                                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-1"></div>
                                                <div class="col-11">
                                                    Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                    <div class="card">
                                    <div class="card-header" id="headingThree">
                                        <h5 class="mb-0 ">
                                        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                            <div class="row">
                                                <div class="col-1">
                                                    <img src="{{ asset('icon/help-circle.svg') }}" alt="">
                                                </div>
                                                <div class="col-10">
                                                    Do you arrange airport transfers?
                                                </div>
                                                <div class="col-1">
                                                    <img class="collapse-arrow" src="./{{ asset('icon/collapse-arrow.svg') }}" alt="">
                                                </div>
                                            </div>
                                        </button>
                                        </h5>
                                    </div>
                                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-1"></div>
                                                <div class="col-11">
                                                    Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                                </div>
                                            </div>
                                    </div>
                                    </div>
                                    </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="review" role="tabpanel" aria-labelledby="review-tab">
                            <div class="review-part">
                                <div class="row rate-area">
                                    <div class="col-12 col-md-5 col-lg-4 total-rate">
                                        <h1>4/5</h1>
                                        <img src="{{ asset('icon/4star-rate.svg') }}" alt="">
                                        <p>Based on <span>150 reviews</span></p>
                                    </div>
                                    <div class="col-12 col-md-7 col-lg-8 each-rate">
                                        <div class="number-rates 5-star">
                                            <h6>5
                                            </h6>
                                            <img src="{{ 'icon/star-assess' }}.svg" alt="">
                                            <div class="rate-bar"></div>
                                            <span>42 reviews</span>
                                        </div>
                                        <div class="number-rates 4-star">
                                            <h6>4
                                            </h6>
                                            <img src="{{ 'icon/star-assess' }}.svg" alt="">
                                            <div class="rate-bar"></div>
                                            <span>21 reviews</span>
                                        </div>
                                        <div class="number-rates 3-star">
                                            <h6>3
                                            </h6>
                                            <img src="{{ 'icon/star-assess' }}.svg" alt="">
                                            <div class="rate-bar"></div>
                                            <span>36 reviews</span>
                                        </div>
                                        <div class="number-rates 2-star">
                                            <h6>2
                                            </h6>
                                            <img src="{{ 'icon/star-assess' }}.svg" alt="">
                                            <div class="rate-bar"></div>
                                            <span>0 reviews</span>
                                        </div>
                                        <div class="number-rates 1-star">
                                            <h6>1
                                            </h6>
                                            <img src="{{ 'icon/star-assess' }}.svg" alt="">
                                            <div class="rate-bar"></div>
                                            <span>0 reviews</span>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="review-guest-comment">
                                    <img src="./icon/guest-icon.svg" alt="">
                                    <form action="/action_page.php" method="POST" class="form" id="form-1">
                                        <textarea id="messenger" class="form-control form-control-lg"  placeholder="Type anything" rows="3"></textarea>
                                        <div class="submit-comment">
                                            <!-- <img src="{{ asset('icon/4star-rate.svg') }}" alt=""> -->
                                            <div class="stars">
                                                <form action="">
                                                <input class="star fa fa-star star-5" id="star-5" type="radio" name="star"/>
                                                <label class="star fa fa-star star-5" for="star-5"></label>
                                                <input class="star fa fa-star star-4" id="star-4" type="radio" name="star"/>
                                                <label class="star fa fa-star star-4" for="star-4"></label>
                                                <input class="star fa fa-star star-3" id="star-3" type="radio" name="star"/>
                                                <label class="star fa fa-star star-3" for="star-3"></label>
                                                <input class="star fa fa-star star-2" id="star-2" type="radio" name="star"/>
                                                <label class="star fa fa-star star-2" for="star-2"></label>
                                                <input class="star fa fa-star star-1" id="star-1" type="radio" name="star"/>
                                                <label class="star fa fa-star star-1" for="star-1"></label>
                                                </form>
                                            </div>
                                            <button type="submit" class="btn btn-primary mt-3">Upload review</button>
                                        </div>
                                    </form>
                                </div>
                                <hr>
                                <div class="review-commented">
                                    <div class="info-people-commented">
                                        <img src="{{ asset('icon/Alex-icon.svg') }}" alt="">
                                        <div class="title-commented">
                                            <img src="{{ asset('icon/5star-rate.svg') }} }}" alt="">
                                            <p>The best experience ever!</p>
                                            <span>Nevermind</span>
                                            <span class="dot-space">Sep 2020</span>
                                        </div>
                                    </div>
                                    <p>It was excellent! The trip is long but the vans are comfortable and have wi-fi. The driver very friendly as well as Ahmed our guide to the dromedaries. The camp was beautiful, comfortable beds, clean bathroom and delicious food! </p>
                                </div>
                                <hr>
                                <div class="review-commented">
                                    <div class="info-people-commented">
                                        <img src="{{ asset('icon/Alex-icon.svg') }}" alt="">
                                        <div class="title-commented">
                                            <img src="{{ asset('icon/5star-rate.svg') }} }}" alt="">
                                            <p>The best experience ever!</p>
                                            <span>Nevermind</span>
                                            <span class="dot-space">Sep 2020</span>
                                        </div>
                                    </div>
                                    <p>It was excellent! The trip is long but the vans are comfortable and have wi-fi. The driver very friendly as well as Ahmed our guide to the dromedaries. The camp was beautiful, comfortable beds, clean bathroom and delicious food! </p>
                                </div>
                                <hr>
                                <div class="review-pagination">
                                    <div class="page-pagination">
                                        <nav aria-label="Page navigation example">
                                            <ul class="pagination">
                                                <li class="page-item disabled">
                                                <a class="page-link" href="#" tabindex="-1">
                                                    <svg width="15" height="9" viewBox="0 0 15 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path class="arrow-pag-left" d="M5.07971 7.89839L2.21215 5.0308L14.6758 5.0308L14.6758 4.07492L2.21221 4.07492L5.07971 1.20739L4.40381 0.531494L0.382445 4.55289L4.40381 8.57429L5.07971 7.89839Z" fill="black"/>
                                                    </svg>
                                                </a>
                                                </li>
                                                <li class="page-item"><a class="page-link" href="#">1</a></li>
                                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                                <li class="page-item">
                                                <a class="page-link" href="#">
                                                    <svg width="16" height="9" viewBox="0 0 16 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path class="arrow-pag-right" d="M10.3441 1.20732L13.2117 4.07491L0.748047 4.07491L0.748047 5.03079L13.2116 5.03079L10.3441 7.89832L11.02 8.57422L15.0414 4.55282L11.02 0.531426L10.3441 1.20732Z" fill="black"/>
                                                    </svg>
                                                </a>
                                                </li>
                                            </ul>
                                            </nav>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <h5>Related tours</h5>
            <div class="related-tour list-related-tour">
                <div class="related-tour-detail">
                    <div class="row">
                        <div class="col-12 col-md-6 col-lg-4 item">
                            <a href="tour-detail.html">
                                <div class="related-tour-box-image">
                                    <img src="{{ asset('image/list-tour/img1.png') }}" alt="image">
                                    <img class="marker" src="./icon/marker.svg" alt="">
                                    <span class="vote-star"><img src="{{ 'icon/star.svg' }}" alt=""> 4.5</span>
                                </div>
                            </a>
                            <p><img src="{{ asset('icon/location-orange.svg') }}" alt=""> Sapa, Laocai</p>
                            <a href="">Discover interesting things in the romantic coastal city of Vungtau</a>
                            <div class="related-tour-detail-bottom">
                                <p><img src="{{ asset('icon/calendar-clock-oragne.svg') }}" alt=""> 3 days - 2 night</p>
                                <p>from <span>$146.00</span></p>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4 item">
                            <a href="">
                                <div class="related-tour-box-image">
                                    <img src="{{ asset('image/list-tour/img2.png') }}" alt="image">
                                    <img class="marker" src="./icon/marker.svg" alt="">
                                    <span class="vote-star"><img src="{{ 'icon/star.svg' }}" alt=""> 4.5</span>
                                </div>
                            </a>
                            <p><img src="{{ asset('icon/location-orange.svg') }}" alt=""> Sapa, Laocai</p>
                            <a href="">Discover the most majestic Fansipan peak in Vietnam - the roof of Indochina</a>
                            <div class="related-tour-detail-bottom">
                                <p><img src="{{ asset('icon/calendar-clock-oragne.svg') }}" alt=""> 3 days - 2 night</p>
                                <p>from <span>$234.00</span></p>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4 item">
                            <a href="">
                                <div class="related-tour-box-image">
                                    <img src="{{ asset('image/list-tour/img3.png') }}" alt="image">
                                    <img class="marker" src="./icon/marker.svg" alt="">
                                    <span class="vote-star"><img src="{{ 'icon/star.svg' }}" alt=""> 4.5</span>
                                </div>
                            </a>
                            <p><img src="{{ asset('icon/location-orange.svg') }}" alt=""> Sapa, Laocai</p>
                            <a href="">Experience sea tourism on Phuquoc golden pearl</a>
                            <div class="related-tour-detail-bottom">
                                <p><img src="{{ asset('icon/calendar-clock-oragne.svg') }}" alt=""> 3 days - 2 night</p>
                                <p>from <span>$334.00</span></p>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4 item">
                            <a href="">
                                <div class="related-tour-box-image">
                                    <img src="{{ asset('image/list-tour/img4.png') }}" alt="image">
                                    <img class="marker" src="./icon/marker.svg" alt="">
                                    <span class="vote-star"><img src="{{ 'icon/star.svg' }}" alt=""> 4.5</span>
                                </div>
                            </a>
                            <p><img src="{{ asset('icon/location-orange.svg') }}" alt=""> Sapa, Laocai</p>
                            <a href="">Discover interesting things in the romantic coastal city of Vungtau</a>
                            <div class="related-tour-detail-bottom">
                                <p><img src="{{ asset('icon/calendar-clock-oragne.svg') }}" alt=""> 3 days - 2 night</p>
                                <p>from <span>$146.00</span></p>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4 item">
                            <a href="">
                                <div class="related-tour-box-image">
                                    <img src="{{ asset('image/list-tour/img5.png') }}" alt="image">
                                    <img class="marker" src="./icon/marker.svg" alt="">
                                    <span class="vote-star"><img src="{{ 'icon/star.svg' }}" alt=""> 4.5</span>
                                </div>
                            </a>
                            <p><img src="{{ asset('icon/location-orange.svg') }}" alt=""> Sapa, Laocai</p>
                            <a href="">Discover the most majestic Fansipan peak in Vietnam - the roof of Indochina</a>
                            <div class="related-tour-detail-bottom">
                                <p><img src="{{ asset('icon/calendar-clock-oragne.svg') }}" alt=""> 3 days - 2 night</p>
                                <p>from <span>$234.00</span></p>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4 item">
                            <a href="">
                                <div class="related-tour-box-image">
                                    <img src="{{ asset('image/list-tour/img6.png') }}" alt="image">
                                    <img class="marker" src="./icon/marker.svg" alt="">
                                    <span class="vote-star"><img src="{{ 'icon/star.svg' }}" alt=""> 4.5</span>
                                </div>
                            </a>
                            <p><img src="{{ asset('icon/location-orange.svg') }}" alt=""> Sapa, Laocai</p>
                            <a href="">Experience sea tourism on Phuquoc golden pearl</a>
                            <div class="related-tour-detail-bottom">
                                <p><img src="{{ asset('icon/calendar-clock-oragne.svg') }}" alt=""> 3 days - 2 night</p>
                                <p>from <span>$334.00</span></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset("js/splide.min.js") }}"></script>

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

        $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });
    </script>
@endpush  


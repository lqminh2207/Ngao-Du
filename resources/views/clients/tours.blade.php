@extends('layouts.template')

@section('title', 'Tours')

@section('header')
    @include('elements.header-tours')
@endsection

@section('content')
    <div class="page-position">
        <div class="container">
            <a href="{{ route('index') }}">
                <span>Home</span>
            </a>
            <span class="dot-space dot-inital">Tours</span>
        </div>
    </div>

    <div class="attractive-tour list-attractive-tour">  
        <div class="container">
            <div class="attractive-tour-header">
                <h1>Attractive tour and interesting experiences</h1>
                <div class="filter">
                    <div id="filter-button">
                        <span href="#">
                            Filter
                            <img src="{{ asset('icon/close-filter.svg') }}" alt="">
                        </span>
                    </div>
                    <div id="sub-filter-dropdown" class="sub-filter">
                        <div class="sub-filter-above">
                            <h6>FILTER BY</h6>
                        </div>
                        <hr>
                            <div class="filter-checkbox">
                                <form action="/form/submit" method="post">
                                <div class="filter-range">
                                    <p>Budget:</p>
                                    <div class="row slider-labels">
                                        <div class="col-xs-6 caption">
                                        <strong><span id="slider-range-value1"></span></strong>
                                        </div>
                                        <div class="col-xs-6 text-right caption">
                                        <strong><span id="slider-range-value2"></span></strong>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                        <div id="slider-range"></div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <input type="hidden" name="min-value" value="">
                                            <input type="hidden" name="max-value" value="">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <p>Duration</p>
                                <div class="filter-checkbox-align">
                                    <input type="checkbox" id="data1" name="" value="" class="big">
                                    <label for="">0 - 3 days</label><br>
                                </div>
                                <div class="filter-checkbox-align">
                                    <input type="checkbox" id="data2" name="" value="" class="big">
                                    <label for=""> 3 - 5 days</label><br>
                                </div>
                                <div class="filter-checkbox-align">
                                    <input type="checkbox" id="data3" name="" value="" class="big">
                                    <label for=""> 5 -7 days</label><br>
                                </div>
                                <div class="filter-checkbox-align">
                                    <input type="checkbox" id="data4" name="" value="" class="big">
                                    <label for=""> over 1 week</label><br>
                                </div>
                                <hr>
                                <p>Type of Tours</p>
                                <div class="filter-checkbox-align">
                                    <input type="checkbox" id="data1" name="" value="" class="big">
                                    <label for=""> City-Break</label><br>
                                </div>
                                <div class="filter-checkbox-align">
                                    <input type="checkbox" id="data2" name="" value="" class="big">
                                    <label for=""> Wildlife</label><br>                                     
                                </div>
                                <div class="filter-checkbox-align">
                                    <input type="checkbox" id="data2" name="" value="" class="big">
                                    <label for=""> Cultural</label><br>                                     
                                </div>
                                <div class="filter-checkbox-align">
                                    <input type="checkbox" id="data2" name="" value="" class="big">
                                    <label for=""> Ecotourism</label><br>                                     
                                </div>
                                <div class="filter-checkbox-align">
                                    <input type="checkbox" id="data2" name="" value="" class="big">
                                    <label for=""> Sun and Beaches</label><br>                                     
                                </div>
                                <input class="reset-button" type="reset" value="CLEAR">
                                <button type="submit"  class="push-filter" >Apply Filter</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="attractive-tour-detail">
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-4 item list-item">
                        <a href="{{ asset('slug') }}">
                            <div class="attractive-tour-box-image">
                                <img src="{{ asset('image/list-tour/img1.png') }}" alt="image">
                                <img class="marker" src="{{ asset("icon/marker.svg") }}" alt="">
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
                    <div class="col-12 col-md-6 col-lg-4 item list-item">
                        <a href="">
                            <div class="attractive-tour-box-image">
                                <img src="{{ asset('image/list-tour/img2.png') }}" alt="image">
                                <img class="marker" src="{{ asset("icon/marker.svg") }}" alt="">
                                <span class="vote-star"><img src="{{ asset('icon/star.svg') }}" alt=""> 4.5</span>
                            </div>
                        </a>
                        <p><img src="./icon/location-orange.svg" alt=""> Sapa, Laocai</p>
                        <a href="">Discover the most majestic Fansipan peak in Vietnam - the roof of Indochina</a>
                        <div class="attractive-tour-detail-bottom">
                            <p><img src="{{ asset('icon/calendar-clock-oragne.svg') }}" alt=""> 3 days - 2 night</p>
                            <p>from <span>$234.00</span></p>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4 item list-item">
                        <a href="">
                            <div class="attractive-tour-box-image">
                                <img src="{{ asset('image/list-tour/img3.png') }}" alt="image">
                                <img class="marker" src="{{ asset("icon/marker.svg") }}" alt="">
                                <span class="vote-star"><img src="{{ asset('icon/star.svg') }}" alt=""> 4.5</span>
                            </div>
                        </a>
                        <p><img src="./icon/location-orange.svg" alt=""> Sapa, Laocai</p>
                        <a href="">Experience sea tourism on Phuquoc golden pearl</a>
                        <div class="attractive-tour-detail-bottom">
                            <p><img src="{{ asset('icon/calendar-clock-oragne.svg') }}" alt=""> 3 days - 2 night</p>
                            <p>from <span>$334.00</span></p>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4 item list-item">
                        <a href="">
                            <div class="attractive-tour-box-image">
                                <img src="{{ asset('image/list-tour/img4.png') }}" alt="image">
                                <img class="marker" src="{{ asset("icon/marker.svg") }}" alt="">
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
                    <div class="col-12 col-md-6 col-lg-4 item list-item">
                        <a href="">
                            <div class="attractive-tour-box-image">
                                <img src="{{ asset('image/list-tour/img5.png') }}" alt="image">
                                <img class="marker" src="{{ asset("icon/marker.svg") }}" alt="">
                                <span class="vote-star"><img src="{{ asset('icon/star.svg') }}" alt=""> 4.5</span>
                            </div>
                        </a>
                        <p><img src="./icon/location-orange.svg" alt=""> Sapa, Laocai</p>
                        <a href="">Discover the most majestic Fansipan peak in Vietnam - the roof of Indochina</a>
                        <div class="attractive-tour-detail-bottom">
                            <p><img src="{{ asset('icon/calendar-clock-oragne.svg') }}" alt=""> 3 days - 2 night</p>
                            <p>from <span>$234.00</span></p>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4 item list-item">
                        <a href="">
                            <div class="attractive-tour-box-image">
                                <img src="{{ asset('image/list-tour/img6.png') }}" alt="image">
                                <img class="marker" src="{{ asset("icon/marker.svg") }}" alt="">
                                <span class="vote-star"><img src="{{ asset('icon/star.svg') }}" alt=""> 4.5</span>
                            </div>
                        </a>
                        <p><img src="./icon/location-orange.svg" alt=""> Sapa, Laocai</p>
                        <a href="">Experience sea tourism on Phuquoc golden pearl</a>
                        <div class="attractive-tour-detail-bottom">
                            <p><img src="{{ asset('icon/calendar-clock-oragne.svg') }}" alt=""> 3 days - 2 night</p>
                            <p>from <span>$334.00</span></p>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4 item list-item">
                        <a href="">
                            <div class="attractive-tour-box-image">
                                <img src="{{ asset('image/list-tour/img7.png') }}" alt="image">
                                <img class="marker" src="{{ asset("icon/marker.svg") }}" alt="">
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
                    <div class="col-12 col-md-6 col-lg-4 item list-item">
                        <a href="">
                            <div class="attractive-tour-box-image">
                                <img src="{{ asset('image/list-tour/img8.png') }}" alt="image">
                                <img class="marker" src="{{ asset("icon/marker.svg") }}" alt="">
                                <span class="vote-star"><img src="{{ asset('icon/star.svg') }}" alt=""> 4.5</span>
                            </div>
                        </a>
                        <p><img src="./icon/location-orange.svg" alt=""> Sapa, Laocai</p>
                        <a href="">Discover the most majestic Fansipan peak in Vietnam - the roof of Indochina</a>
                        <div class="attractive-tour-detail-bottom">
                            <p><img src="{{ asset('icon/calendar-clock-oragne.svg') }}" alt=""> 3 days - 2 night</p>
                            <p>from <span>$234.00</span></p>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4 item list-item">
                        <a href="">
                            <div class="attractive-tour-box-image">
                                <img src="{{ asset('image/list-tour/img9.png') }}" alt="image">
                                <img class="marker" src="{{ asset("icon/marker.svg") }}" alt="">
                                <span class="vote-star"><img src="{{ asset('icon/star.svg') }}" alt=""> 4.5</span>
                            </div>
                        </a>
                        <p><img src="./icon/location-orange.svg" alt=""> Sapa, Laocai</p>
                        <a href="">Experience sea tourism on Phuquoc golden pearl</a>
                        <div class="attractive-tour-detail-bottom">
                            <p><img src="{{ asset('icon/calendar-clock-oragne.svg') }}" alt=""> 3 days - 2 night</p>
                            <p>from <span>$334.00</span></p>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4 item list-item">
                        <a href="">
                            <div class="attractive-tour-box-image">
                                <img src="{{ asset('image/list-tour/img10.png') }}" alt="image">
                                <img class="marker" src="{{ asset("icon/marker.svg") }}" alt="">
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
                    <div class="col-12 col-md-6 col-lg-4 item list-item">
                        <a href="">
                            <div class="attractive-tour-box-image">
                                <img src="{{ asset('image/list-tour/img11.png') }}" alt="image">
                                <img class="marker" src="{{ asset("icon/marker.svg") }}" alt="">
                                <span class="vote-star"><img src="{{ asset('icon/star.svg') }}" alt=""> 4.5</span>
                            </div>
                        </a>
                        <p><img src="./icon/location-orange.svg" alt=""> Sapa, Laocai</p>
                        <a href="">Discover the most majestic Fansipan peak in Vietnam - the roof of Indochina</a>
                        <div class="attractive-tour-detail-bottom">
                            <p><img src="{{ asset('icon/calendar-clock-oragne.svg') }}" alt=""> 3 days - 2 night</p>
                            <p>from <span>$234.00</span></p>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4 item list-item">
                        <a href="">
                            <div class="attractive-tour-box-image">
                                <img src="{{ asset('image/list-tour/img12.png') }}" alt="image">
                                <img class="marker" src="{{ asset("icon/marker.svg") }}" alt="">
                                <span class="vote-star"><img src="{{ asset('icon/star.svg') }}" alt=""> 4.5</span>
                            </div>
                        </a>
                        <p><img src="./icon/location-orange.svg" alt=""> Sapa, Laocai</p>
                        <a href="">Experience sea tourism on Phuquoc golden pearl</a>
                        <div class="attractive-tour-detail-bottom">
                            <p><img src="{{ asset('icon/calendar-clock-oragne.svg') }}" alt=""> 3 days - 2 night</p>
                            <p>from <span>$334.00</span></p>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4 item list-item">
                        <a href="">
                            <div class="attractive-tour-box-image">
                                <img src="{{ asset('image/list-tour/img13.png') }}" alt="image">
                                <img class="marker" src="{{ asset("icon/marker.svg") }}" alt="">
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
                    <div class="col-12 col-md-6 col-lg-4 item list-item">
                        <a href="">
                            <div class="attractive-tour-box-image">
                                <img src="{{ asset('image/list-tour/img14.png') }}" alt="image">
                                <img class="marker" src="{{ asset("icon/marker.svg") }}" alt="">
                                <span class="vote-star"><img src="{{ asset('icon/star.svg') }}" alt=""> 4.5</span>
                            </div>
                        </a>
                        <p><img src="./icon/location-orange.svg" alt=""> Sapa, Laocai</p>
                        <a href="">Discover the most majestic Fansipan peak in Vietnam - the roof of Indochina</a>
                        <div class="attractive-tour-detail-bottom">
                            <p><img src="{{ asset('icon/calendar-clock-oragne.svg') }}" alt=""> 3 days - 2 night</p>
                            <p>from <span>$234.00</span></p>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4 item list-item">
                        <a href="">
                            <div class="attractive-tour-box-image">
                                <img src="{{ asset('image/list-tour/img15.png') }}" alt="image">
                                <img class="marker" src="{{ asset("icon/marker.svg") }}" alt="">
                                <span class="vote-star"><img src="{{ asset('icon/star.svg') }}" alt=""> 4.5</span>
                            </div>
                        </a>
                        <p><img src="./icon/location-orange.svg" alt=""> Sapa, Laocai</p>
                        <a href="">Experience sea tourism on Phuquoc golden pearl</a>
                        <div class="attractive-tour-detail-bottom">
                            <p><img src="{{ asset('icon/calendar-clock-oragne.svg') }}" alt=""> 3 days - 2 night</p>
                            <p>from <span>$334.00</span></p>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4 item list-item">
                        <a href="">
                            <div class="attractive-tour-box-image">
                                <img src="{{ asset('image/list-tour/img16.png') }}" alt="image">
                                <img class="marker" src="{{ asset("icon/marker.svg") }}" alt="">
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
                    <div class="col-12 col-md-6 col-lg-4 item list-item">
                        <a href="">
                            <div class="attractive-tour-box-image">
                                <img src="{{ asset('image/list-tour/img17.png') }}" alt="image">
                                <img class="marker" src="{{ asset("icon/marker.svg") }}" alt="">
                                <span class="vote-star"><img src="{{ asset('icon/star.svg') }}" alt=""> 4.5</span>
                            </div>
                        </a>
                        <p><img src="./icon/location-orange.svg" alt=""> Sapa, Laocai</p>
                        <a href="">Discover the most majestic Fansipan peak in Vietnam - the roof of Indochina</a>
                        <div class="attractive-tour-detail-bottom">
                            <p><img src="{{ asset('icon/calendar-clock-oragne.svg') }}" alt=""> 3 days - 2 night</p>
                            <p>from <span>$234.00</span></p>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4 item list-item">
                        <a href="">
                            <div class="attractive-tour-box-image">
                                <img src="{{ asset('image/list-tour/img18.png') }}" alt="image">
                                <img class="marker" src="{{ asset("icon/marker.svg") }}" alt="">
                                <span class="vote-star"><img src="{{ asset('icon/star.svg') }}" alt=""> 4.5</span>
                            </div>
                        </a>
                        <p><img src="./icon/location-orange.svg" alt=""> Sapa, Laocai</p>
                        <a href="">Experience sea tourism on Phuquoc golden pearl</a>
                        <div class="attractive-tour-detail-bottom">
                            <p><img src="{{ asset('icon/calendar-clock-oragne.svg') }}" alt=""> 3 days - 2 night</p>
                            <p>from <span>$334.00</span></p>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4 item list-item">
                        <a href="">
                            <div class="attractive-tour-box-image">
                                <img src="{{ asset('image/list-tour/img19.png') }}" alt="image">
                                <img class="marker" src="{{ asset("icon/marker.svg") }}" alt="">
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
                    <div class="col-12 col-md-6 col-lg-4 item list-item">
                        <a href="">
                            <div class="attractive-tour-box-image">
                                <img src="{{ asset('image/list-tour/img20.png') }}" alt="image">
                                <img class="marker" src="{{ asset("icon/marker.svg") }}" alt="">
                                <span class="vote-star"><img src="{{ asset('icon/star.svg') }}" alt=""> 4.5</span>
                            </div>
                        </a>
                        <p><img src="./icon/location-orange.svg" alt=""> Sapa, Laocai</p>
                        <a href="">Discover the most majestic Fansipan peak in Vietnam - the roof of Indochina</a>
                        <div class="attractive-tour-detail-bottom">
                            <p><img src="{{ asset('icon/calendar-clock-oragne.svg') }}" alt=""> 3 days - 2 night</p>
                            <p>from <span>$234.00</span></p>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4 item list-item">
                        <a href="">
                            <div class="attractive-tour-box-image">
                                <img src="{{ asset('image/list-tour/img21.png') }}" alt="image">
                                <img class="marker" src="{{ asset("icon/marker.svg") }}" alt="">
                                <span class="vote-star"><img src="{{ asset('icon/star.svg') }}" alt=""> 4.5</span>
                            </div>
                        </a>
                        <p><img src="./icon/location-orange.svg" alt=""> Sapa, Laocai</p>
                        <a href="">Experience sea tourism on Phuquoc golden pearl</a>
                        <div class="attractive-tour-detail-bottom">
                            <p><img src="{{ asset('icon/calendar-clock-oragne.svg') }}" alt=""> 3 days - 2 night</p>
                            <p>from <span>$334.00</span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>  
    </div>

    <div class="list-tour-pagination">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-4"></div>
                <div class="col-12 col-lg-4 show-page-current">
                    <p>Showing  <span>1 / 2</span></p>
                </div>
                <div class="col-12 col-lg-4 page-pagination">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination justify-content-end">
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
@endsection

@push('scripts')
    <script src="{{ asset('js/range.js') }}"></script>  
@endpush

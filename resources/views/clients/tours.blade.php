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
                {{-- {{ print_r($all_tour) }} --}}
                @if (!empty($all_tour) && count($all_tour) > 0)
                    <div class="row">
                        @foreach ($all_tour as $item)
                            <div class="col-12 col-md-6 col-lg-4 item list-item">
                                <a href="{{ route('detailTour', $item->slug) }}">
                                    <div class="attractive-tour-box-image">
                                        <img src="{{ $item->img }}" alt="image">
                                        <img class="marker" src="{{ asset("icon/marker.svg") }}" alt="">
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

    <div class="list-tour-pagination w-100">
        <div class="container d-flex align-items-center justify-content-end">
            <div class="show-page-current" style="">
                {{-- <p>Showing  <span>1 / 2</span></p> --}}
            </div>
            <div class="page-pagination">
                {{ $all_tour->links('elements.paginate') }}
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/range.js') }}"></script>  
@endpush

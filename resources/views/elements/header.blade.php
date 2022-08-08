<section>
    <div class="slider">
        <div class="container">
            <div class="slider-above">
                @include('elements.menu')
            </div>
            <div class="slider-featured">
                <div class="row row-home-slider">
                    <div  class="col-12 col-md-12 col-lg-7">
                        <div class="col-12 slider-content">
                            <span>Welcome to NgaoduVietnam</span>
                            <h1>Perfect place for your stories</h1>
                        </div>
                        <div class="col-12 slider-position">
                            <h6>Featured</h6>
                                <div class="slider-featured-content">
                                    <p><span>200+</span> tours</p>
                                    <p><span>100+</span> destination</p>
                                    <p><span>8+</span> type of tour</p>
                                </div>
                                <div class="white-box"></div>
                        </div>
                    </div>
                    <div class="col-12 col-md-12 col-lg-5 tour-form">
                        <form action="/action_page.php">
                            <h4 class="mb-4">Discover beautiful Vietnam</h4>
                            <div class="input-group mb-4 mr-sm-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><img src="{{ asset('/icon/search-orange.svg') }}" alt=""></div>
                                </div>
                                <input type="text" class="form-control" placeholder="Tour name" id="tour-name">
                            </div>
                            <div class="input-group mb-4 mr-sm-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><img src="{{ asset('/icon/location-orange.svg') }}" alt=""></div>
                                </div>
                                <input type="text" class="form-control" placeholder="Quatlam Beach, Giaothuy, Namdinh" id="tour-address">
                            </div>
                            <div class="input-group mb-4 mr-sm-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><img src="{{ asset('/icon/flag-orange.svg') }}" alt=""></div>
                                </div>
                                <select class="js-example-basic-single form-control" id="tour-types" name="state">
                                    <option value="type">Type of tour</option>
                                    <option value="AL">Alabama</option>
                                    <option value="WY">Wyoming</option>
                                  </select>
                            </div>
                            <div class="input-group mb-4 mr-sm-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><img src="{{ asset('icon/calendar-clock-oragne.svg') }}" alt=""></div>
                                </div>
                                <input type="text" class="form-control" placeholder="Departure time" id="tour-time">
                            </div>
                            <button type="submit" class="btn btn-primary"><img src="{{ asset('icon/search-white.svg') }}" alt=""> Search</button>
                        </form>
                    </div>
                    <div class="col-12 bottom-text-mobile">
                        <div  class="slider-position">
                            <div class="white-box"></div>
                            <h6>Featured</h6>
                                <div class="slider-featured-content">
                                    <p><span>200+</span> tours</p>
                                    <p><span>100+</span> destination</p>
                                    <p><span>8+</span> type of tour</p>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
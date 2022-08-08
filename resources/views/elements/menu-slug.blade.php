<div class="tour-detail-slider">
    <div class="container">
        <div class="slider-above">
            <div class="row navigation">
                <div class="col-6 navigation-left">
                    <a href="{{ route('index') }}">
                        <img src="{{ asset('icon/logo-black.svg') }}" alt="logo">
                    </a>
                </div>
                <div class="col-6 navigation-right">
                    <ul>
                        <li><a href="{{ route('index') }}">Home</a></li>
                        <li><a href="">About</a></li>
                        <li><a href="{{ route('tours') }}">Tours</a></li>
                        <li><a href="#">Hotels</a></li>
                        <li><a href="{{ route('contact') }}">Contact</a></li>
                        <li><a href="">Login</a></li>
                    </ul>
                </div>

                <div class="col-6 navigation-menu-icon">
                    <input type="checkbox" hidden  id="navigation-input" class="navigation-mobile-input">
                    <label for="navigation-input" class="navigation-overlay" id="overlay"></label>
                    <label for="navigation-input" id="nav-icon">
                        <span></span>
                        <span></span>
                        <span></span>
                    </label>
                    <div class="navigation-menu-mobile">
                        <a class="logo-nav-mobile" href="{{ route('index') }}">
                            <img src="{{ asset('icon/logo-black.svg') }}" alt="logo">
                        </a>
                        <ul>
                            <li><a href="{{ route('index') }}">Home</a></li>
                            <li><a href="">About</a></li>
                            <li><a href="{{ route('tours') }}">Tours</a></li>
                            <li><a href="#">Hotels</a></li>
                            <li><a href="{{ route('contact') }}">Contact</a></li>
                            <li><a href="">Login</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
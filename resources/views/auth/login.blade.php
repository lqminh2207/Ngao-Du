<!DOCTYPE html>
<html dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('xtreme/assets/images/favicon.png') }}">
    <title>Xtreme admin Template - The Ultimate Multipurpose admin template</title>
    <!-- Custom CSS -->
    <link href="{{ asset('xtreme/dist/css/style.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" type = "text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.css">

</head>

<body>
    <div class="main-wrapper">

        <div class="preloader">
            <div class="lds-ripple">
                <div class="lds-pos"></div>
                <div class="lds-pos"></div>
            </div>
        </div>

        <div class="auth-wrapper d-flex no-block justify-content-center align-items-center" style="background:url({{ asset('xtreme/assets/images/big/auth-bg.jpg') }}) no-repeat center center;">
            <div class="auth-box">
                <div id="loginform">
                    <div class="logo">
                        <span class="db"><img src="{{ asset('xtreme/assets/images/logo-icon.png') }}" alt="logo" /></span>
                        <h5 class="font-medium mb-3">Sign In to Admin</h5>
                    </div>
                    <!-- Form -->
                    <div class="row">
                        <div class="col-12">
                            <form class="form-horizontal mt-3" method="POST" id="loginform" action="{{ route('execute.signin') }}">
                                @csrf
                                <div class="form-group mb-3">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1"><i class="ti-user"></i></span>
                                        </div>
                                        <input type="text" class="form-control form-control-lg" name="email" id="email" value="{{ old('email') }}" placeholder="Username">
                                    </div>
                                    @if (Session::has('error'))
                                        <span class="text-danger pt-2">{{ Session::get('error') }}</span>
                                    @endif
                                    @if ($errors->has('email'))
                                        <span class="text-danger">
                                            <small>{{ $errors->first('email') }}</small>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group mb-3">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon2"><i class="ti-pencil"></i></span>
                                        </div>
                                        <input type="password" class="form-control form-control-lg" placeholder="Password" name="password">
                                    </div>
                                    @if ($errors->has('password'))
                                        <span class="text-danger">
                                            <small>{{ $errors->first('password') }}</small>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="customCheck1">
                                            <label class="custom-control-label" for="customCheck1">Remember me</label>
                                            <a href="{{ route('password.request') }}" id="to-recover" class="text-dark float-right"><i class="fa fa-lock mr-1"></i> Forgot password?</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group text-center">
                                    <div class="col-xs-12 pt-3">
                                        <button class="btn btn-block btn-lg btn-info" type="submit">Log In</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>

    </div>

    <script src="{{ asset('xtreme/assets/libs/jquery/dist/jquery.min.js') }}"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="{{ asset('xtreme/assets/libs/popper.js/dist/umd/popper.min.js') }}"></script>
    <script src="{{ asset('xtreme/assets/libs/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js"></script>
    <script src="{{ asset('js.admin.js') }}"></script>

    <script>
    $('[data-toggle="tooltip"]').tooltip();
    $(".preloader").fadeOut();
    // ============================================================== 
    // Login and Recover Password 
    // ============================================================== 
    $('#to-recover').on("click", function() {
        $("#loginform").slideUp();
        $("#recoverform").fadeIn();
    });
    </script>

    <script>
        @if (Session::has('message'))
            var type = "{{ Session::get('alert-type'), 'info' }}";
            switch(type){
                case 'info':
                    toastr.options.positionClass = 'toast-top-right';
                    toastr.info("{{ Session::get('message') }}");
                    toastr.options.timeOut = 4000;
                    break;
                case 'warning': 
                    toastr.options.positionClass = 'toast-top-right';
                    toastr.options.timeOut = 4000;
                    toastr.warning("{{ Session::get('message') }}");
                    break;
                case 'success':
                    toastr.options.positionClass = 'toast-top-right';
                    toastr.options.timeOut = 4000;
                    toastr.success("{{ Session::get('message') }}");
                    break;
                case 'error':
                    toastr.options.positionClass = 'toast-top-right';
                    toastr.options.timeOut = 4000;
                    toastr.error();("{{ Session::get('message') }}");
                    break;
            }
        @endif
    </script>
</body>

</html>
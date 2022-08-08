<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://kit.fontawesome.com/0221aa3b3d.js" crossorigin="anonymous"></script>
<script src="{{ asset('js/owl.carousel.min.js') }}"></script>  
<script src="{{ asset('js/custom.js') }}"></script>
<script src="{{ asset('xtreme/assets/libs/toastr/build/toastr.min.js') }}"></script>
<script src="{{ asset('xtreme/assets/extra-libs/toastr/toastr-init.js') }}"></script>
<script>
    @if (Session::has('message'))
        toastr.options =
        {
        "closeButton" : true,
        "progressBar" : true,
        }
        toastr.success("{{ session('message') }}");
    @endif

    @if (Session::has('error'))
        toastr.options =
        {
        "closeButton" : true,
        "progressBar" : true
        }
        toastr.error("{{ session('error') }}");
    @endif

    @if (Session::has('info'))
        toastr.options =
        {
        "closeButton" : true,
        "progressBar" : true
        }
        toastr.info("{{ session('info') }}");
    @endif

    @if (Session::has('warning'))
        toastr.options =
        {
        "closeButton" : true,
        "progressBar" : true
        }
        toastr.warning("{{ session('warning') }}");
    @endif
</script>
<script>
    $('body').on('submit', '#frm', function() {
        $(this).find('[type="submit"]').prop('disabled', true)
    })
</script>
<script>
    $(document).ready(function() {
        $('.js-example-basic-single').select2();
    });
</script>


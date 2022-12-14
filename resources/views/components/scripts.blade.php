<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="{{ asset('xtreme/assets/libs/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('xtreme/assets/extra-libs/DataTables/datatables.min.js') }}"></script>
<!-- Bootstrap tether Core JavaScript -->
<script src="{{ asset('xtreme/assets/libs/popper.js/dist/umd/popper.min.js') }}"></script>
{{-- <script src="{{ asset('xtreme/assets/libs/bootstrap/dist/js/bootstrap.min.js') }}"></script> --}}
<!-- Sweet alert -->
<script src="{{ asset('xtreme/assets/libs/sweetalert2/dist/sweetalert2.all.min.js') }}"></script>
<script src="{{ asset('xtreme/assets/libs/sweetalert2/sweet-alert.init.js') }}"></script>
<!-- apps -->
<script src="{{ asset('xtreme/dist/js/app.min.js') }}"></script>
<script src="{{ asset('xtreme/dist/js/app.init.js') }}"></script>
<script src="{{ asset('xtreme/dist/js/app-style-switcher.js') }}"></script>
<script src="{{ asset('xtreme/assets/libs/toastr/build/toastr.min.js') }}"></script>
<script src="{{ asset('xtreme/assets/extra-libs/toastr/toastr-init.js') }}"></script>
<!-- slimscrollbar scrollbar JavaScript -->
<script src="{{ asset('xtreme/assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js') }}"></script>
<script src="{{ asset('xtreme/assets/extra-libs/sparkline/sparkline.js') }}"></script>
<!--Wave Effects -->
<script src="{{ asset('xtreme/dist/js/waves.js') }}"></script>
<!--Menu sidebar -->
<script src="{{ asset('xtreme/dist/js/sidebarmenu.js') }}"></script>
<!--Custom JavaScript -->
<script src="{{ asset('xtreme/dist/js/custom.js') }}"></script>
<script src="{{ asset('xtreme/assets/libs/bootstrap-switch/dist/js/bootstrap-switch.min.js') }}"></script>
<script src="{{ asset('xtreme/assets/extra-libs/DataTables/datatables.min.js') }}"></script>
<script src="{{ asset('xtreme/dist/js/pages/datatable/datatable-basic.init.js') }}"></script>
<!--This page JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<!--chartis chart-->
{{-- <script src="{{ asset('xtreme/assets/libs/chartist/dist/chartist.min.js') }}"></script> --}}
{{-- <script src="{{ asset('xtreme/assets/libs/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js') }}"></script> --}}
<!--c3 charts -->
<script src="{{ asset('xtreme/assets/extra-libs/c3/d3.min.js') }}"></script>
<script src="{{ asset('xtreme/assets/extra-libs/c3/c3.min.js') }}"></script>
<!--chartjs -->
{{-- <script src="{{ asset('xtreme/assets/libs/chart.js/dist/Chart.min.js') }}"></script>
<script src="{{ asset('xtreme/dist/js/pages/dashboards/dashboard1.js') }}"></script> --}}
<script src="{{ asset('js/admin.js') }}"></script>

{{-- toastr --}}
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
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
{{-- select2 --}}
<script>
    $(document).ready(function() {
    $('.js-example-basic-single').select2();
});
</script>
{{-- openFile --}}
<script>
    var openFile1 = function(event) {
        var input = event.target;
        var reader = new FileReader();
        reader.onload = function() {
            var dataURL = reader.result;
            // var output = $('#img');
            var output = document.getElementById('img');
            output.src = dataURL;
        };
        reader.readAsDataURL(input.files[0]);
    };
// Insert image 360 or video
    // var openFile2 = function(event) {
    //     var input = event.target;
    //     var reader = new FileReader();
    //     reader.onload = function() {
    //         var dataURL = reader.result;
    //         // var output = $('#image_360');
    //         var output = document.getElementById('image_360');
    //         output.src = dataURL;
    //     };
    //     reader.readAsDataURL(input.files[0]);
    // };
    // var openFile3 = function(event) {
    //     var input = event.target;
    //     var reader = new FileReader();
    //     reader.onload = function() {
    //         var dataURL = reader.result;
    //         var output = document.getElementById('video');
    //         output.src = dataURL;
    //     };
    //     reader.readAsDataURL(input.files[0]);
    // };
</script>
{{-- end toastr --}}
{{-- ck editor --}}
<script src="{{ asset('xtreme/assets/libs/ckeditor/ckeditor.js') }}"></script>

<script src="{{ asset('js/template.js') }}"></script>
{{-- Destroy record --}}
<script type="text/javascript">removeData('.btn-delete', '#datatable', '', true, "")</script>
{{-- End Destroy record --}}

<script>
    function ChangeToSlug(str) {
        str = str.toLowerCase();

        //?????i k?? t??? c?? d???u th??nh kh??ng d???u
        str = str.replace(/??|??|???|???|??|??|???|???|???|???|???|??|???|???|???|???|???/gi, "a");
        str = str.replace(/??|??|???|???|???|??|???|???|???|???|???/gi, "e");
        str = str.replace(/i|??|??|???|??|???/gi, "i");
        str = str.replace(/??|??|???|??|???|??|???|???|???|???|???|??|???|???|???|???|???/gi, "o");
        str = str.replace(/??|??|???|??|???|??|???|???|???|???|???/gi, "u");
        str = str.replace(/??|???|???|???|???/gi, "y");
        str = str.replace(/??/gi, "d");
        //X??a c??c k?? t??? ?????t bi???t
        str = str.replace(
            /\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi,
            ""
        );
        //?????i kho???ng tr???ng th??nh k?? t??? g???ch ngang
        str = str.replace(/ /gi, "-");
        //?????i nhi???u k?? t??? g???ch ngang li??n ti???p th??nh 1 k?? t??? g???ch ngang
        //Ph??ng tr?????ng h???p ng?????i nh???p v??o qu?? nhi???u k?? t??? tr???ng
        str = str.replace(/\-\-\-\-\-/gi, "-");
        str = str.replace(/\-\-\-\-/gi, "-");
        str = str.replace(/\-\-\-/gi, "-");
        str = str.replace(/\-\-/gi, "-");
        //X??a c??c k?? t??? g???ch ngang ??? ?????u v?? cu???i
        str = "@" + str + "@";
        str = str.replace(/\@\-|\-\@|\@/gi, "");
        //In slug ra textbox c?? id ???slug???
        return str;
    }

    // Get slug of inputTyping's value to inputSlug
    function renderSlugInput(inputTyping, inputSlug) {
        inputTyping.on("keyup", function () {
            if (inputTyping.val() != null) {
                let slug = ChangeToSlug(inputTyping.val());
                inputSlug.val(slug);
            }
        });
    }

    renderSlugInput($('#title'), $('#slug'))
</script>
@stack('js')

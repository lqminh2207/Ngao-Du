@extends('admin.master')

@section('content')
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 align-self-center">
            <h4 class="page-title">Rates</h4>
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('tours.index') }}">Tour</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Rates</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
    <div class="row">
    <div class="col-12">
        <div class="container-fluid">
            <div class="row mb-3" style="padding-top:8px;">
                <input type="hidden" id="tour_id" value="{{ $tour_id }}">
            </div>
            <div class="table-responsive hide-search-datatable custom-table">
                <table class="table table-striped table-bordered data-table w-100" id="myTable" >
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Star</th>
                            <th>Message</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
 
@endsection
@push('js')
    <!-- get data -->
    <script>
        $(document).ready(function() {
            var datatable = $('#myTable').DataTable({
                processing: true,
                responsive: true,
                serverSide: true,
                stateSave: true,
                searching: false,
                ajax:{
                    type:"POST",
                    url:"{{route('reviews.getData', $tour_id)}}",
                    data: function (d) {
                        d.search = $('#filter_search').val(),
                        d.status = $('#status').val()
                        d.tour_id = $('#tour_id').val()
                    }
                },
                columns:[
                    {data: 'DT_RowIndex', name: 'DT_RowIndex',width:'5%', orderable: false, searchable:false, class: 'align-middle'},
                    {data:'star', name:'star', width:'10%', orderable: false, searchable:false, class:'text-center align-middle'},
                    {data:'message', name:'message', width:'60%', orderable: false, searchable:false, class:'text-center align-middle'},
                    {data:'status', name:'status', width:'15%', orderable: false, searchable:false, class:'text-center align-middle'},
                    {data:'action', name:'action', width:'10%', orderable: false, searchable:false, class:'text-center align-middle'},
                ],
            });
    
            $('#filter_search').on('keyup',function(){
                datatable.draw();
            });
    
            $('#status').on('change', function(){
                datatable.draw();
            });
        });
    </script>


    {{-- changeStatus --}}
    <script>
        $(document).on('click', '.toggle-class', function(e) {
            var status = $(this).prop('checked') == true ? 1 : 2;
            // var rate_id = $(this).data('id')
            var id = $(this).data('id');

            $.ajax({
                type: 'POST',
                dataType: 'JSON',
                url: '{{ route("reviews.changeStatus", $tour_id) }}',
                data: {
                    'status': status,
                    'id': id
                },
                success: function(resposne) {
                    toastr.success(resposne.message);
                }
            });
        });
    </script>
    {{-- End ChangeStatus --}}

    {{-- Destroy Data --}}
    <script>
        removeData('.btn-delete', '#myTable', '', true, "")
    </script>
    {{-- End Destroy Data --}}
@endpush

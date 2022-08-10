@extends('admin.master')

@section('content')
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 align-self-center">
                <h4 class="page-title">Tours</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Tours</li>
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
                    <div class="col-2">
                        <input type="text" id="filter_search" value="{{old('filter_search')}}" class="form-control" placeholder="Search">
                    </div>

                    <div class="col-2">
                        <select id="destinations" class="form-control select2-hide-search" style="width:100%; height:36px;">
                            <option value="">All Destinations</option>
                            @foreach ($destinations as $item)
                                <option value="{{ $item->id }}">{{ $item->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-2">
                        <select id="types" class="form-control select2-hide-search" style="width:100%; height:36px;">
                            <option value="">All Types</option>
                            @foreach ($types as $item)
                                <option value="{{ $item->id }}">{{ $item->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-2">
                        <select id="trending" class="form-control select2-hide-search" style="width:100%; height:36px;">
                            <option value="">All Trending</option>
                            <option value="1">Trending</option>
                            <option value="2">Not Trending</option>
                        </select>
                    </div>
                    <div class="col-2">
                        <select id="status" class="form-control select2-hide-search" style="width:100%; height:36px;">
                            <option value="">All Status</option>
                            <option value="1">Show</option>
                            <option value="2">Hide</option>
                        </select>
                    </div>

                    <div class="col-2">
                        <div class="text-right col-md-7 ml-auto p-r-0">
                            <a href="{{ route('tours.create') }}" class="btn btn-info btn-create text-white">Create tour</a>
                        </div>
                    </div>
                </div>
                <div class="table-responsive hide-search-datatable custom-table">
                    <table class="table table-striped table-bordered data-table w-100" id="myTable" >
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Img</th>
                                <th>Title</th>
                                <th>Duration</th>
                                <th>Price</th>
                                <th>Trending</th>
                                <th>Status</th>
                                <th>Details</th>
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
                    url:"{{route('tours.getData')}}",
                    data: function (d) {
                        d.search = $('#filter_search').val(),
                        d.destination = $('#destinations').val()
                        d.type = $('#types').val()
                        d.trending = $('#trending').val()
                        d.status = $('#status').val()
                    }
                },
                columns:[
                    {data: 'DT_RowIndex', name: 'DT_RowIndex',width:'5%', orderable: false, searchable:false, class: 'align-middle'},
                    {data:'image', name:'image', width:'10%', orderable: false, searchable:false, class:'text-center align-middle'},
                    {data:'title', name:'title', width:'20%', orderable: false, searchable:false, class:'text-center align-middle'},
                    {data:'duration', name:'duration', width:'15%', orderable: false, searchable:false, class:'text-center align-middle'},
                    {data:'price', name:'price', width:'15%', orderable: false, searchable:false, class:'text-center align-middle'},
                    {data:'trending', name:'trending', width:'10%', orderable: false, searchable:false, class:'text-center align-middle'},
                    {data:'status', name:'status', width:'10%', orderable: false, searchable:false, class:'text-center align-middle'},
                    {data:'details', name:'details', width:'15%', orderable: false, searchable:false, class:'text-center align-middle'},
                    {data:'action', name:'action', width:'5%', orderable: false, searchable:false, class:'text-center align-middle'},
                ],
            });
    
            $('#filter_search').on('keyup',function(){
                datatable.draw();
            });
    
            $('#destinations').on('change', function(){
                datatable.draw();
            });
            
            $('#types').on('change', function(){
                datatable.draw();
            });
            
            $('#trending').on('change', function(){
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
            var id = $(this).data('id');
            $.ajax({
                type: 'POST',
                dataType: 'JSON',
                url: '{{ route('tours.changeStatus') }}',
                data: {
                    'status': status,
                    'id': id
                },
                success: function(data) {
                    toastr.success(data.message);
                }
            });
        });
        $(document).on('click', '.toggle-class-trending', function(e) {
            var trending = $(this).prop('checked') == true ? 1 : 2;
            var id = $(this).data('id');
            $.ajax({
                type: 'POST',
                dataType: 'JSON',
                url: '{{ route('tours.changeStatusTrending') }}',
                data: {
                    'trending': trending,
                    'id': id
                },
                success: function(data) {
                    toastr.success(data.message);
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

@extends('admin.master')

@section('content')
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 align-self-center">
                <h4 class="page-title">Bookings</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Bookings</li>
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
                    <div class="col-4">
                        <input type="text" id="filter_search" value="{{old('filter_search')}}" class="form-control" placeholder="Search">
                    </div>
                    <div class="col-3">
                        <select id="status" class="form-control select2-hide-search" style="width:100%; height:36px;">
                            <option value="">All</option>
                            <option value="1">Active</option>
                            <option value="2">Block</option>
                        </select>
                    </div>
                </div>
                <div class="table-responsive hide-search-datatable custom-table">
                    <table class="table table-striped table-bordered data-table w-100" id="myTable" >
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Full Name</th>
                                <th>Numbers of people</th>
                                <th>Departure date</th>
                                <th>Price</th>
                                <th>Payment status</th>
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
                    url:"{{route('bookings.getData')}}",
                    data: function (d) {
                        d.search = $('#filter_search').val(),
                        d.status = $('#status').val()
                    }
                },
                columns:[
                    {data: 'DT_RowIndex', name: 'DT_RowIndex', width:'5%', orderable: false, searchable:false, class: 'align-middle'},
                    {data:'fullname', name:'firstname' . ' ' . 'lastname', width:'20%', orderable: false, searchable:false, class:'text-center align-middle'},
                    {data:'people', name:'people', width:'15%', orderable: false, searchable:false, class:'text-center align-middle'},
                    {data:'start_at', name:'start_at', width:'15%', orderable: false, searchable:false, class:'text-center align-middle'},
                    {data:'price', name:'price', width:'10%', orderable: false, searchable:false, class:'text-center align-middle'},
                    {data:'payment_status', name:'payment_status', width:'15%', orderable: false, searchable:false, class:'text-center align-middle'},
                    {data:'status', name:'status', width:'10%', orderable: false, searchable:false, class:'text-center align-middle'},
                    {data:'action', name:'action', width:'5%', orderable: false, searchable:false, class:'text-center align-middle'},
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
            var id = $(this).data('id');
            $.ajax({
                type: 'GET',
                dataType: 'JSON',
                url: '{{ route('bookings.changeStatus') }}',
                data: {
                    'status': status,
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

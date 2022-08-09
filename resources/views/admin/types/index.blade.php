@extends('admin.master')

@section('content')
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-9 align-self-center">
                <h4 class="page-title">Types of tour</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Types</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="card">
            <div class="card-body border-top">
                <div class="row">
                    <div class="col-12">
                        <div class="row mb-3">
                         
                            <div class="col-md-5">
                                <input type="text" name="filter_search" id="filter_search"
                                    value="{{ old('filter_search') }}" class="form-control" placeholder="Search">
                            </div>
                            <div class="col-3">
                                <select id="status" class="form-control select2-hide-search" style="width:100%; height:36px;">
                                    <option value="">All</option>
                                    <option value="1">Active</option>
                                    <option value="2">Block</option>
                                </select>
                            </div>
                            <div class="col-4">
                                <div class="text-right col-md-7 ml-auto p-r-0">
                                    <a href="{{ route('types.create') }}" class="btn btn-info btn-create text-white">Create types of tour</a>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive hide-search-datatable custom-table">
                            <table id="myTable" class="table table-striped display table-hover" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Name</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        $(document).ready(function() {
            var datatables = $('#myTable').DataTable({  
                processing: true,
                responsive: true,
                serverSide: true,
                stateSave: true,
                searching: false, 
                ajax:{
                    type:"POST",
                    url:"{{ route('types.getData') }}",
                    data: function (d) {
                        d.search = $('#filter_search').val(),
                        d.status = $('#status').val()
                    }
                },
                columns:[
                    {data: 'DT_RowIndex', name: 'DT_RowIndex',width:'5%', orderable: false, searchable:false, class: 'text-center align-middle'},
                    {data:'title', name:'title', width:'65%', orderable: false, searchable:false, class:'text-center align-middle'},
                    {data:'status', name:'status', width:'10%', orderable: false, searchable:false, class:'text-center align-middle'},
                    {data:'action', name:'action', width:'20%', orderable: false, searchable:false, class:'text-center align-middle'},
                ],
            });
            $('#filter_search').on('keyup', function() {
                datatables.draw();
            })
            $('#status').on('change', function() {
                datatables.draw();
            })
        })
    </script>

    {{-- changeStatus --}}
    <script>
        $(document).on('click', '.toggle-class', function(e) {
            var status = $(this).prop('checked') == true ? 1 : 2;
            var id = $(this).data('id');
            $.ajax({
                type: 'POST',
                dataType: 'JSON',
                url: '{{ route('types.changeStatus') }}',
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

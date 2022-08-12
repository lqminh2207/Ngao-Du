@extends('admin.master')

@section('content')
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 align-self-center">
                <h4 class="page-title">Destinations</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Destinations</li>
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
                    
                    <div class="col-5">
                        <div class="text-right col-md-7 ml-auto p-r-0">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#staticBackdrop">
                                Create destination
                            </button>
                              
                              <!-- Modal -->
                            <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title" id="staticBackdropLabel">Create Destination</h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                    <form method="post" action="{{ route('destinations.store') }}" enctype="multipart/form-data" id="insert_data">
                                        <div class="modal-body" style="text-align: left;">
                                            @csrf
                                            <div class="form-group" >
                                                <label for="exampleInputTitle">Title <span style="color: red">*</span></label>
                                                <input type="text" class="form-control" onkeyup="ChangeToTitle()" id="title"
                                                    value="{{ old('title') }}" name="title"
                                                    placeholder="Title destination" maxlength="100">
                                                    @if ($errors->has('title'))
                                                    <span class="text-danger">
                                                        <small>{{ $errors->first('title') }}</small>
                                                    </span>
                                                    @endif
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputSlug">Slug <span style="color: red">*</span></label>
                                                <input type="text" class="form-control" onkeyup="ChangeToSlug()" id="slug"
                                                    value="{{ old('slug') }}" name="slug"
                                                    placeholder="Slug destination" maxlength="255">
                                                    @if ($errors->has('slug'))
                                                    <span class="text-danger">
                                                        <small>{{ $errors->first('slug') }}</small>
                                                    </span>
                                                    @endif
                                            </div>
                                        
                                            <div class="form-group ">
                                                <label for="exampleInputEmail1">Image <span style="color: red">*</span></label>
                                                {{-- style="height: 100px" id="show_image" --}}
                                                <div class="col-md-4 feature_image_container">
                                                    {{-- style="height: 100%;" --}}
                                                    <div class="row">
                                                        {{-- style="height: 100%;" --}}
                                                        {{-- h-100 --}}
                                                        <img id="img" class="feature_image d-block w-100 " src="" alt="">
                                                    </div>
                                                </div>
                                                <input id="image" type="file" class="form-control-file mt-4" name="image" accept='image/*'
                                                    onchange='openFile1(event)'>
                                                @if ($errors->has('image'))
                                                <span class="text-danger">
                                                    <small>{{ $errors->first('image') }}</small>
                                                </span>
                                                @endif
                                            </div>

                                            <div class="form-group">
                                                <label for="exampleStatus">Status <span style="color: red">*</span></label>
                                                <br>
                                                <input type="radio" name="status" style="margin: 0 15px" id="status_active" value="1"
                                                    checked {{ old('status') == '1' ? 'checked' : '' }}> Active
                                                <input type="radio" name="status" style="margin: 0 15px" id="block" value="2"
                                                    {{ old('status') == '2' ? 'checked' : '' }}> Inactive
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Create</button>
                                        </div>
                                    </form>
                                  </div>
                                </div>
                            </div>
                            {{-- <a href="{{ route('destinations.create') }}" class="btn btn-info btn-create text-white">Create destination</a> --}}
                        </div>
                    </div>
                </div>
                <div class="table-responsive hide-search-datatable custom-table">
                    <table class="table table-striped table-bordered data-table w-100" id="myTable" >
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Image</th>
                                <th>Title</th>
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
                    url:"{{route('destinations.getData')}}",
                    data: function (d) {
                        d.search = $('#filter_search').val(),
                        d.status = $('#status').val()
                    }
                },
                columns:[
                    {data: 'DT_RowIndex', name: 'DT_RowIndex',width:'5%', orderable: false, searchable:false, class: 'align-middle'},
                    {data:'image', name:'image', width:'10%', orderable: false, searchable:false, class:'text-center align-middle'},
                    {data:'title', name:'title', width:'32%', orderable: false, searchable:false, class:'text-center align-middle'},
                    {data:'status', name:'status', width:'10%', orderable: false, searchable:false, class:'text-center align-middle'},
                    {data:'action', name:'action', width:'20%', orderable: false, searchable:false, class:'text-center align-middle'},
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
                type: 'POST',
                dataType: 'JSON',
                url: '{{ route('destinations.changeStatus') }}',
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

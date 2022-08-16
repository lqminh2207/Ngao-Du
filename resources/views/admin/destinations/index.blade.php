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
                            <button type="button" class="btn btn-primary btn-create" data-toggle="modal" data-target="#staticBackdrop">
                                Create destination
                            </button>
                              
                              <!-- Modal -->
                            <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title" id="staticBackdropLabel"></h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>

                                    <div class="modal-body" style="text-align: left;">
                                        <form method="POST" enctype="multipart/form-data" id="upload-form">
                                            <input type="text" id="edit_id" value="{{ old('id') }}" hidden>
                                            <div class="form-group" >
                                                <label for="exampleInputTitle">Title<span style="color: red">*</span></label>
                                                <input type="text" class="form-control" id="title"
                                                    value="{{ old('title') }}" name="title"
                                                    placeholder="Title destination" maxlength="100">
                                                    <span id="errorTitle" class="text-danger"></span>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputSlug">Slug<span style="color: red">*</span></label>
                                                <input type="text" class="form-control" onkeyup="ChangeToSlug()" id="slug"
                                                    value="{{ old('slug') }}" name="slug" 
                                                    placeholder="Slug destination" maxlength="255">
                                                    <p id="errorSlug" class="text-danger"></p>
                                            </div>
                                        
                                            <div class="form-group ">
                                                <label for="exampleInputEmail1">Image<span style="color: red">*</span></label>
                                                <div class="col-md-4 feature_image_container">
                                                    <div class="row">
                                                        <img id="img" class="feature_image d-block w-100 " src="" alt="">
                                                    </div>
                                                </div>
                                                <input id="image" type="file" class="form-control-file mt-4" name="image" accept='image/*'
                                                    onchange='openFile1(event)'>
                                                <span id="errorImage" class="text-danger"></span>
                                            </div>

                                            <div class="form-group">
                                                <label for="exampleStatus">Status <span style="color: red">*</span></label>
                                                <br>
                                                <input type="radio" name="status" style="margin: 0 15px" id="status_active" value="1"
                                                    checked {{ old('status') == '1' ? 'checked' : '' }}> Active
                                                <input type="radio" name="status" style="margin: 0 15px" id="block" value="2"
                                                    {{ old('status') == '2' ? 'checked' : '' }}> Inactive
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary btn-close" data-dismiss="modal">Close</button>
                                        <button id="btn-submit" type="submit" class="btn btn-primary d-none"></button>
                                        <button id="btn-submit-edit" type="submit" class="btn btn-primary d-none"></button>
                                    </div>
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

    <script>
        $('.btn-create').click(function (e) {
            $('.modal-title').text("Create destination")    
            $('#btn-submit').text('Create').prop('disabled', false)
            document.getElementById('btn-submit').classList.remove('d-none')
            document.getElementById('btn-submit-edit').classList.add('d-none')
            resetForm()
        })

        $(document).on('click', '.btn-edit', function(e) {
            resetForm()
            $('.modal-title').text('Edit destination')
            $('#btn-submit-edit').text('Save change').prop('disabled', false)
            document.getElementById('btn-submit-edit').classList.remove('d-none')
            document.getElementById('btn-submit').classList.add('d-none')

            let id = $(this).data('id')
            let url = '{{ route('destinations.show', ":id") }}'
            url = url.replace(':id', id)

            $.ajax({
                type: 'GET',
                dataType: 'JSON',
                url: url,
                
                success: function(response) {
                    $('#edit_id').val(response.destination.id)
                    $('#title').val(response.destination.title)
                    $('#slug').val(response.destination.slug)
                    // $('#image').val(response.destination.image)
                    $('#block').prop('checked', true)
                    if (response.destination.status == 1)
                        $('#status_active').prop('checked', true)
                }
            });
        })

        function resetForm() {
            $('#btn-create').prop('disabled', false)
            $('#title').val('')
            $('#slug').val('')
            document.getElementById("img").src = "";
            $('#image').val('')
            $('#errorTitle').text('')
            $('#errorSlug').text('')
            $('#errorImage').text('')
        }

        $('#btn-submit').click(function (e) {
            event.preventDefault();
            $('#errorTitle').text('')
            $('#errorSlug').text('')
            $('#errorImage').text('')

            let status = 1
            if ($('#block').is(":checked")) {
                status = 2
            }
            let formData = new FormData($('#upload-form')[0]);
            let title = $('#title').val();
            let slug = $('#slug').val();
            let image = document.getElementById("image").files[0]

            formData.append('title', title);
            formData.append('slug', slug);
            formData.append('image', image);
            formData.append('status', status);
            $.ajax({
                type: 'POST',
                dataType: 'JSON',
                url: '{{ route('destinations.store') }}',
                data: formData,
                processData: false,
                contentType: false,

                success: function(response) {
                    $('#myTable').DataTable().ajax.reload();
                    $('.btn-close').click()
                    $('#btn-submit').prop('disabled', true)
                    toastr.success(response.message)
                    resetForm()
                },  

                error: function(xhr) {
                    if (xhr.responseJSON.errors) {
                        $('#errorTitle').text(xhr.responseJSON.errors.title)
                        $('#errorSlug').text(xhr.responseJSON.errors.slug)
                        $('#errorImage').text(xhr.responseJSON.errors.image)
                    }

                    var btn = document.getElementById("btn-submit")
                    btn.disabled = true

                    setTimeout(()=>{
                        btn.disabled = false
                    }, 1000)
                    toastr.error(xhr.responseJSON.message)
                }
            });
        }) 

        $('#btn-submit-edit').click(function (e) {
            event.preventDefault();
            $('#errorTitle').text('')
            $('#errorSlug').text('')
            $('#errorImage').text('')

            let status = 1
            if ($('#block').is(":checked")) {
                status = 2
            }
            let formData = new FormData($('#upload-form')[0]);

            let title = $('#title').val();
            let slug = $('#slug').val();
            let image = document.getElementById("image").files[0]
            console.log(image)

            formData.append('title', title);
            formData.append('slug', slug);
            formData.append('image', image);
            formData.append('status', status);
            formData.set('title', title);
            formData.set('slug', slug);
            formData.set('image', image);
            formData.set('status', status);
            
            let destination_id = $('#edit_id').val();
            let url = '{{ route('destinations.update', ":id") }}';
            url = url.replace(':id', destination_id);
            console.log(url);

            $.ajax({
                type: 'PUT',
                dataType: 'JSON',
                url: url,
                data: formData,
                processData: false,
                contentType: false,

                success: function(response) {
                    $('#myTable').DataTable().ajax.reload();
                    $('.btn-close').click()
                    $('#btn-submit').prop('disabled', true)
                    toastr.success(response.message)
                    resetForm()
                },  

                error: function(xhr) {
                    console.log(xhr);
                    if (xhr.responseJSON.errors) {
                        $('#errorTitle').text(xhr.responseJSON.errors.title)
                        $('#errorSlug').text(xhr.responseJSON.errors.slug)
                        $('#errorImage').text(xhr.responseJSON.errors.image)
                    }

                    var btn = document.getElementById("btn-submit-edit")
                    btn.disabled = true

                    setTimeout(()=>{
                        btn.disabled = false
                    }, 1000)
                    toastr.error(xhr.responseJSON.message)
                }
            });
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

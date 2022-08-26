@extends('admin.master')

@section('content')
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 align-self-center">
                <h4 class="page-title">Itineraries</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('tours.index') }}">Tour</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Itineraries</li>
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
                    <div class="col-8">
                        <div class="text-right col-md-7 ml-auto p-r-0">
                            <button type="button" class="btn btn-primary btn-create" data-toggle="modal" data-target="#staticBackdrop">
                                Create Itinerary
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
                                        <input type="text" id="edit_id" value="{{ old('id') }}" hidden>
                                        <input type="text" id="tour_id" value="{{ $tour_id }}" hidden>

                                        <div class="form-group">
                                            <label for="exampleInputTitle">Title<span style="color: red">*</span></label>
                                            <input type="text" class="form-control" id="title"
                                                value="{{ old('title') }}" name="title"
                                                placeholder="Your title" maxlength="255">
                                                <p id="errorTitle" class="text-danger"></p>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary btn-close" data-dismiss="modal">Close</button>
                                        <button id="btn-submit" type="butoon" class="btn btn-primary"></button>
                                        <button id="btn-submit-edit" type="button" class="btn btn-primary"></button>
                                    </div>
                                  </div>
                                </div>
                            </div>
                            {{-- <a href="{{ route('itineraries.create', $tour_id) }}" class="btn btn-info btn-create text-white">Create Itinerary</a> --}}
                        </div>
                    </div>
                </div>
                <div class="table-responsive hide-search-datatable custom-table">
                    <table class="table table-striped table-bordered data-table w-100" id="myTable" >
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
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
                    url:"{{route('itineraries.getData', 'id')}}",
                    data: function (d) {
                        d.search = $('#filter_search').val(),
                        d.tour_id = $('#tour_id').val()
                    }
                },
                columns:[
                    {data: 'DT_RowIndex', name: 'DT_RowIndex',width:'5%', orderable: false, searchable:false, class: 'align-middle'},
                    {data:'title', name:'title', width:'75%', orderable: false, searchable:false, class:'text-center align-middle'},
                    {data:'action', name:'action', width:'20%', orderable: false, searchable:false, class:'text-center align-middle'},
                ],
            });
    
            $('#filter_search').on('keyup',function(){
                datatable.draw();
            });
        });
    </script>

    <script>
        $('.btn-create').click(function (e) {
            $('.modal-title').text("Create itinerary")    
            $('#btn-submit').text('Create').prop('disabled', false)
            document.getElementById('btn-submit').classList.remove('d-none')
            document.getElementById('btn-submit-edit').classList.add('d-none')
            resetForm()
        })

        $(document).on('click', '.btn-edit', function(e) {
            resetForm()
            $('.modal-title').text('Edit itinerary')
            $('#btn-submit-edit').text('Save change').prop('disabled', false)
            document.getElementById('btn-submit-edit').classList.remove('d-none')
            document.getElementById('btn-submit').classList.add('d-none')

            let id = $(this).data('id')
            let url = '{{ route('itineraries.showInfo', [$tour_id, ":id"]) }}'
            url = url.replace(':id', id)

            $.ajax({
                type: 'GET',
                dataType: 'JSON',
                url: url,
                
                success: function(response) {
                    console.log(response);
                    $('#edit_id').val(response.itinerary.id)
                    $('#tour_id').val(response.itinerary.tour_id)
                    $('#title').val(response.itinerary.title)
                }
            });
        })

        function resetForm() {
            $('#btn-create').prop('disabled', false)
            $('#title').val('')
            $('#errorTitle').text('')
        }

        $('#btn-submit').click(function (e) {
            $('#errorTitle').text('')

            $.ajax({
                type: 'POST',
                dataType: 'JSON',
                url: '{{ route('itineraries.store', $tour_id) }}',
                data: {
                    'title': $('#title').val()
                },

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
            $('#errorTitle').text('')

            let itinerary_id = $('#edit_id').val();
            let url = '{{ route('itineraries.update', [$tour_id, ":id"]) }}';
            url = url.replace(':id', itinerary_id);

            $.ajax({
                type: 'POST',
                dataType: 'JSON',
                url: url,
                data: {
                    'id': $('#edit_id').val(),
                    'tour_id': $('#tour_id').val(),
                    'title': $('#title').val()
                },

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


    {{-- Destroy Data --}}
    <script>
        removeData('.btn-delete', '#myTable', '', true, "")
    </script>
    {{-- End Destroy Data --}}
@endpush

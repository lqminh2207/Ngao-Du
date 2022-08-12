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
                                    <button type="button" class="btn btn-primary btn-create" id="btn-create" data-toggle="modal" data-target="#staticBackdrop" id="CreateTypeModal">
                                        Create types of tour
                                    </button>
                                      
                                      <!-- Modal -->
                                    <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <h5 class="modal-title" id="staticBackdropLabel">Create types of tour</h5>
                                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                              </button>
                                            </div>
                                            
                                            <div class="modal-body" style="text-align: left;">
                                                <div class="form-group">
                                                    <label for="exampleInputTitle">Title<span style="color: red">*</span></label>
                                                    <input type="text" class="form-control" onkeyup="ChangeToSlug()" id="title"
                                                        value="{{ old('title') }}" name="title"
                                                        placeholder="Title type of tour" maxlength="100">
                                                            <p id="errorTitle" class="text-danger"></p>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleStatus">Status<span style="color: red">*</span></label>
                                                    <br>
                                                    <input type="radio" name="status" style="margin: 0 15px" id="status_active" value="1"
                                                        checked {{ old('status') == '1' ? 'checked' : '' }}> Active
                                                    <input type="radio" name="status" style="margin: 0 15px" id="block" value="2"
                                                        {{ old('status') == '2' ? 'checked' : '' }}> Inactive
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" id="btn-close" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button id="type_sub" type="submit" class="btn btn-primary">Create</button>
                                            </div>
                                          </div>
                                        </div>
                                    </div>
                                    {{-- <a href="{{ route('types.create') }}" class="btn btn-info btn-create text-white">Create types of tour</a> --}}
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

    <div class="modal fade" id="edit-modal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="staticBackdropLabel">Create types of tour</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            
            <div class="modal-body" style="text-align: left;">
                <div class="form-group">
                    <label for="exampleInputTitle">Title <span style="color: red">*</span></label>
                    <input type="text" class="form-control title" onkeyup="ChangeToSlug()" id="title"
                        value="{{ old('title') }}" name="title"
                        placeholder="Title type of tour" maxlength="100">
                        <p class="text-danger"></p>
                </div>
                
                <div class="form-group">
                    <label for="exampleStatus">Status<span style="color: red">*</span></label>
                    <br>
                    <input type="radio" name="status" style="margin: 0 15px" id="status_active" value="1"
                    checked {{ old('status') == '1' ? 'checked' : '' }}>Active
                <input type="radio" name="status" style="margin: 0 15px" id="block" value="2"
                    {{ old('status') == '2' ? 'checked' : '' }}>Inactive
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="btn-close" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button id="type_sub" type="submit" class="btn btn-primary">Save change</button>
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

    <script>
        function resetForm() {
            $('#title').val(''),
            $('#status_active').prop('checked', true);

            $('#errorTitle').text('');
        }

        $('.btn-create').click(function(e) {
            $('#type_sub').prop('disabled', false);
            resetForm()
        })

        $('#type_sub').click(function(e) {
            $('#errorTitle').text('');

            let status = 1;
            if($('#block').is(":checked")) {
                status = 2;
            }
            $('#type_sub').prop('disabled', true);
            
            $.ajax({
                type: 'POST',
                dataType: 'JSON',
                url: '{{ route('types.store') }}',
                data: { 
                    'title': $('#title').val(),
                    'status': status
                },

                success: function(response) {
                    $('#myTable').DataTable().ajax.reload();
                    $('#btn-close').click();
                    toastr.success(response.message);
                    resetForm();
                },

                error: function(xhr) {
                    if (xhr.responseJSON.errors) {
                        $('#errorTitle').text(xhr.responseJSON.errors.title);
                    }
                    $('#type_sub').attr('disabled', false);

                    toastr.error(xhr.responseJSON.message);
                },
            });
        });

        $(document).on('click', '.btn-edit', function(e) {
            let data = $(this).data('old-info')
            console.log(data.status)
            $('.title').val(data.title)
            $("input[name='status']").filter(`[value="${data.status}"]`).attr('checked', true);
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

@extends('admin.master')

@section('content')
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 align-self-center">
                <h4 class="page-title">Faqs</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('tours.index') }}">Tour</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Faqs</li>
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
                            <option value="1">Show</option>
                            <option value="2">Hide</option>
                        </select>
                    </div>
                    <div class="col-5">
                        <div class="text-right col-md-7 ml-auto p-r-0">
                            <button type="button" class="btn btn-primary btn-create" data-toggle="modal" data-target="#staticBackdrop">
                                Create Faq
                            </button>
                              
                              <!-- Modal -->
                            <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" style="max-width: 800px;">
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
                                            <label for="exampleInputQuestion">Question<span style="color: red">*</span></label>
                                            <input type="text" class="form-control" id="question"
                                                value="{{ old('question') }}" name="question"
                                                placeholder="Your Question" maxlength="255">
                                                <p id="errorQues" class="text-danger"></p>
                                        </div>
                
                                        <div class="form-group col-md-12 p-0 mt-3">
                                            <label style="" for="exampleInputAnswer">Answer<span style="color: red">*</span></label>
                                            <textarea value="{{ old('answer') }}" name="answer" class="form-control answer" id="editor1"></textarea>
                                            <p id="errorAns" class="text-danger"></p>
                                        </div> 
                
                                        <div class="form-group">
                                            <label for="exampleStatus">Status <span style="color: red">*</span></label>
                                            <br>
                                            <input type="radio" name="status" style="margin: 0 15px" id="status_active" value="1"
                                                checked {{ old('status') == '1' ? 'checked' : '' }}>Show
                                            <input type="radio" name="status" style="margin: 0 15px" id="block" value="2"
                                                {{ old('status') == '2' ? 'checked' : '' }}>Hide
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
                            {{-- <a href="{{ route('faqs.create', $tour_id) }}" class="btn btn-info btn-create text-white">Create Faq</a> --}}
                        </div>
                    </div>
                    <input type="hidden" id="tour_id" value="{{ $tour_id }}">
                </div>
                <div class="table-responsive hide-search-datatable custom-table">
                    <table class="table table-striped table-bordered data-table w-100" id="myTable" >
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Question</th>
                                <th>Answer</th>
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
                    url:"{{route('faqs.getData', $tour_id)}}",
                    data: function (d) {
                        d.search = $('#filter_search').val(),
                        d.status = $('#status').val()
                        d.tour_id = $('#tour_id').val()
                    }
                },
                columns:[
                    {data: 'DT_RowIndex', name: 'DT_RowIndex',width:'5%', orderable: false, searchable:false, class: 'align-middle'},
                    {data:'question', name:'question', width:'25%', orderable: false, searchable:false, class:'text-center align-middle'},
                    {data:'answer', name:'answer', width:'40%', orderable: false, searchable:false, class:'text-center align-middle'},
                    {data:'status', name:'status', width:'10%', orderable: false, searchable:false, class:'text-center align-middle'},
                    {data:'action', name:'action', width:'15%', orderable: false, searchable:false, class:'text-center align-middle'},
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
            $('.modal-title').text("Create faq")    
            $('#btn-submit').text('Create').prop('disabled', false)
            document.getElementById('btn-submit').classList.remove('d-none')
            document.getElementById('btn-submit-edit').classList.add('d-none')
            resetForm()
        })

        $(document).on('click', '.btn-edit', function(e) {
            resetForm()
            $('.modal-title').text('Edit faq')
            $('#btn-submit-edit').text('Save change').prop('disabled', false)
            document.getElementById('btn-submit-edit').classList.remove('d-none')
            document.getElementById('btn-submit').classList.add('d-none')

            let id = $(this).data('id')
            let url = '{{ route('faqs.showInfo', [$tour_id, ":id"]) }}'
            url = url.replace(':id', id)

            $.ajax({
                type: 'GET',
                dataType: 'JSON',
                url: url,
                
                success: function(response) {
                    console.log(response);
                    $('#edit_id').val(response.faq.id)
                    $('#tour_id').val(response.faq.tour_id)
                    $('#question').val(response.faq.question)
                    CKEDITOR.instances.editor1.setData(response.faq.answer)
                    $('#block').prop('checked', true)
                    if (response.faq.status == 1)
                        $('#status_active').prop('checked', true)
                }
            });
        })

        function resetForm() {
            $('#btn-create').prop('disabled', false)
            $('#question').val('')
            CKEDITOR.instances.editor1.setData('')
            $('#errorQues').text('')
            $('#errorAns').text('')
        }

        $('#btn-submit').click(function (e) {
            $('#errorQues').text('')
            $('#errorAns').text('')

            let status = 1
            if ($('#block').is('checked') == 1) {
                status = 2
            }

            $.ajax({
                type: 'POST',
                dataType: 'JSON',
                url: '{{ route('faqs.store', $tour_id) }}',
                data: {
                    'question': $('#question').val(),
                    'answer': CKEDITOR.instances.editor1.getData(),
                    'status': status,
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
                        $('#errorQues').text(xhr.responseJSON.errors.question)
                        $('#errorAns').text(xhr.responseJSON.errors.answer)
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
            $('#errorQues').text('')
            $('#errorAns').text('')

            let faq_id = $('#edit_id').val();
            let url = '{{ route('faqs.update', [$tour_id, ":id"]) }}';
            url = url.replace(':id', faq_id);
            
            let status = 1
            if ($('#block').is('checked') == 1) {
                status = 2
            }

            $.ajax({
                type: 'POST',
                dataType: 'JSON',
                url: url,
                data: {
                    'id': $('#edit_id').val(),
                    'tour_id': $('#tour_id').val(),
                    'question': $('#question').val(),   
                    'answer': CKEDITOR.instances.editor1.getData(),
                    'status': status
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
                        $('#errorQues').text(xhr.responseJSON.errors.question)
                        $('#errorAns').text(xhr.responseJSON.errors.answer)
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

        CKEDITOR.replace('editor1');
    </script>

    {{-- changeStatus --}}
    <script>
        $(document).on('click', '.toggle-class', function(e) {
            var status = $(this).prop('checked') == true ? 1 : 2;
            var faq_id = $(this).data('id')
            var id = $(this).data('id');
            $.ajax({
                type: 'POST',
                dataType: 'JSON',
                url: '{{ route("faqs.changeStatus", $tour_id) }}',
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

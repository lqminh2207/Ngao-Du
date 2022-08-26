@extends('admin.master')

@section('content')
    <div class="container-fluid">
        <div class="page-breadcrumb">
            <div class="row">
                <div class="col-12 align-self-center">
                    <h4 class="page-title">Galleries</h4>
                    <div class="d-flex align-items-center">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('tours.index') }}">Tour</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Galleries</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <strong>{{ $message }}</strong>
                        </div>
                    @endif
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    {{-- @if (session('message'))
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
                    @endif --}}
                    
                    <div class="card-body">
                        {{-- @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif --}}
                        <form method="post" id="upload-file" enctype="multipart/form-data">
                            @csrf
                            <div style="display: flex; flex-wrap:wrap">
                                <div class="col-12" style="text-align: center;">
                                    <div class="form-group ">
                                        <label for="exampleInputEmail1" style="font-size: 24px;">Add Image</label>
                                    </div>
                                </div>
                            </div>
                            <div class="wrapper-upload">
                                <div class="file-upload">
                                  <input id="inputFile" type="file" class="form-control-file m-2" name="image[]" accept="image/*"
                                      multiple onchange="">
                                  <i class="fa fa-arrow-up"></i>
                                </div>
                              </div>
                        </form>

                        <div class="col-md-12">
                            <div class="row galleries">
                                @if ($tour->galleries->isEmpty())
                                    <strong id="empty-album" class="mb-2 mt-3" style="font-size: 46px; width: 100%; text-align:center;">Empty Album</strong>
                                @else
                                    @foreach ($tour->galleries as $tourImageItem)
                                        <div class="col-md-3 wrap-image" id="image{{ $tourImageItem->id }}"
                                            style="position: relative">
                                            <img class="image_item"
                                                src="{{ $tourImageItem->image }}" alt=""
                                                width="100%" height="auto" style="margin-top: 15px">
                                            <a  title="Delete" href="{{ route('galleries.destroy', [$tour->id, $tourImageItem->id]) }}"
                                                id="delete-gallery"
                                                data-id = "{{ $tourImageItem->id }}"
                                                class="btn btn-danger waves-effect waves-light btn-sm btn-delete-gallary"
                                                style="position: absolute;top:15px;right:10px">
                                                <i class="fas fa-trash-alt"></i>
                                            </a>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                        <input type="text" id="url" value="{{ route('galleries.destroy', [$tour->id, 1]) }}" hidden>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        $('body').on('click', '.btn-delete-gallary', function(e) {
            e.preventDefault();
            let url = $(this).attr('href')  
            let imageId = '#image' + $(this).data('id')
            swal({
                title: '',
                text: 'Do you want to delete this item?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#f15e5d',
                cancelButtonColor: '#c1c1c1',
                confirmButtonText: 'Có',
                cancelButtonText: 'Không',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: url,
                        type: 'DELETE',

                        success: function (response) {
                            if(response == 1)
                            {
                                toastr.success("Image successfully deleted")
                                $(imageId).remove()
                                if ($('.wrap-image').length == 0)
                                {
                                    $('.galleries').append('<strong id="empty-album" class="mb-2 mt-3" style="font-size: 46px; width: 100%; text-align:center;">Empty Album</strong>');
                                }
                            }
                        },
                        error: function (xhr) {
                            toastr.error(xhr.responseJSON.message);
                        },
                    })
                }
            })
        });

    </script>

    <script>
        $('#inputFile').on('change', function(e) {
            let formData = new FormData($('#upload-file')[0]);

            let totalFiles = this.files.length;
            for (let i = 0; i < totalFiles; i++) {
                formData.append("file" + i, this.files[i]);
            }
            formData.append("totalFiles", totalFiles);

            $.ajax({
                type:'POST',
                url: "{{ route('galleries.store', $tour_id) }}",
                data: formData,
                contentType: false,
                processData: false,

                success: (response) => {
                    if (response) {
                        console.log(response);
                        // if(response.errors.length > 0) {
                        //     toastr.error(response.errors[i]);
                        // }

                        if(response.length > 0) {
                            $('#empty-album').remove()

                            for (let i = 0; i < response.length; i++) {
                                let url = $('#url').val();
                                let string2= ''
                                const myArray = url.split("/");
                                myArray[7] = response[i].id
                                
                                for(let i = 0; i < myArray.length; i++) {
                                    string2 += myArray[i]+'/'
                                }
                                console.log(response[i]);
                                let string = `<div class="col-md-3 " id="image${response[i].id}" style="position: relative">`
                                    string += `<img class="image_item" src="${response[i].image}" alt="" width="100%" height="auto" style="margin-top: 15px">`
                                    string += `<a title="Delete" href="${string2}" id="delete-gallery" data-id="${response[i].id}" class="btn btn-danger waves-effect waves-light btn-sm btn-delete-gallary" style="position: absolute;top:15px;right:10px"><i class="fas fa-trash-alt"></i></a>`
                                    string += `</div>`

                                $('.galleries').append(string)
                            }
    
                            toastr.success("Image(s) successfully added")
                        }
                    }

                    $('#upload-file')[0].reset();
                },
                error: function(xhr){
                    console.log(xhr);
                    toastr.error(xhr.responseJSON.message);
                }
            })
        });
    </script>
@endpush
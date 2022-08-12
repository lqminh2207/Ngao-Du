@extends('admin.master')

@section('content')
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 align-self-center">
                <h4 class="page-title">Edit Destination</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('destinations.index') }}">Destinations</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Edit Destination</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 p-4">
            <div class="card">
                <div class="card-body">
                    <form method="post" action="{{ route('destinations.update', [$destination->id]) }}" enctype="multipart/form-data" id="insert_data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="exampleInputTitle">Title <span style="color: red">*</span></label>
                            <input type="text" class="form-control" onkeyup="ChangeToTitle()" id="title"
                                value="{{ $destination->title }}" name="title"
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
                                value="{{ $destination->slug }}" name="slug"
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
                            <input type="radio" name="status" style="margin: 0 15px"  value="1"
                            checked {{ $destination->status == '1' ? 'checked' : '' }}> Active
                            <input type="radio" name="status" style="margin: 0 15px" id="block" value="2"
                                {{ $destination->status == '2' ? 'checked' : '' }}> Inactive
                        </div>
                        <button type="submit" name="add_destinationtour" class="btn btn-primary" id="button_destination">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
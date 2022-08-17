@extends('admin.master')

@section('content')
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 align-self-center">
                <h4 class="page-title">Edit Place</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('tours.index') }}">Tour</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('itineraries.show', [$tour_id]) }}">Itinerary</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('places.show', [$tour_id, $itinerary_id]) }}">Place</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Edit Place</li>
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
                    <form method="post" action="{{ route('places.update', [$place->itinerary->tour_id, $place->itinerary_id ,$place->id]) }}" enctype="multipart/form-data" id="insert_data">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputTitle">Title <span style="color: red">*</span></label>
                            <input type="text" class="form-control" onkeyup="ChangeToTitle()" id="title"
                                value="{{ $place->title }}" name="title"
                                placeholder="Title" maxlength="255">
                                @if ($errors->has('title'))
                                <span class="text-danger">
                                    <small>{{ $errors->first('title') }}</small>
                                </span>
                                @endif
                        </div>
                        <div class="form-group col-md-12 p-0 mt-3">
                            <label style="" for="exampleInputContent">Content <span style="color: red">*</span></label>
                            <textarea placeholder="Content" name="content" class="form-control" id="editor1">{{ $place->content }}</textarea>
                            <span class="text-danger">
                                <small>{{ $errors->first('content') }}</small>
                            </span>
                        </div>
                        <button type="submit" name="add_placetour" class="btn btn-primary" id="button_place">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
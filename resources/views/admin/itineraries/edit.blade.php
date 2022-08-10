@extends('admin.master')

@section('content')
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 align-self-center">
                <h4 class="page-title">Edit Itinerary</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('tours.index') }}">Tour</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('itineraries.show', [$itinerary->tour_id]) }}">Itinerary</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Edit Itinerary</li>
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
                    <form method="post" action="{{ route('itineraries.update', [$itinerary->tour_id ,$itinerary->id]) }}" enctype="multipart/form-data" id="insert_data">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputTitle">Title <span style="color: red">*</span></label>
                            <input type="text" class="form-control" onkeyup="ChangeToTitle()" id="title"
                                value="{{ $itinerary->title }}" name="title"
                                placeholder="Title" maxlength="255">
                                @if ($errors->has('title'))
                                <span class="text-danger">
                                    <small>{{ $errors->first('title') }}</small>
                                </span>
                                @endif
                        </div>
                        <button type="submit" name="add_itinerary" class="btn btn-primary" id="button_itinerary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
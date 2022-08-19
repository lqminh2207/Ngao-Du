@extends('admin.master')

@section('content')
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 align-self-center">
                <h4 class="page-title">Tours</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('tours.index') }}">Tours</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Edit Tour</li>
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
                    <form method="post" action="{{ route('tours.update', [$tour->id]) }}" enctype="multipart/form-data" id="insert_data">
                        @csrf
                            @method('PUT')  
                            <div class="row">
                                <div class="col-6 form-group">
                                    <label for="exampleInputTitle">Title<span style="color: red">*</span></label>
                                    <input type="text" class="form-control" onkeyup="ChangeToTitle()" id="title"
                                        value="{{ $tour->title }}" name="title"
                                        placeholder="Title tour" maxlength="100">
                                        @if ($errors->has('title'))
                                        <span class="text-danger">
                                            <small>{{ $errors->first('title') }}</small>
                                        </span>
                                        @endif
                                </div>
                                <div class="col-6 form-group">
                                    <label for="exampleInputSlug">Slug <span style="color: red">*</span></label>
                                    <input type="text" class="form-control" onkeyup="ChangeToSlug()" id="slug"
                                        value="{{ $tour->slug }}" name="slug"
                                        placeholder="Slug tour" maxlength="255">
                                    @if ($errors->has('slug'))
                                        <span class="text-danger">
                                            <small>{{ $errors->first('slug') }}</small>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-6 form-group">
                                    <label class="d-block" for="exampleInputDestination">Destinations<span style="color: red">*</span></label>
                                    <select class="js-example-basic-single w-100" name="destination_id">
                                        @foreach ($destinations as $item)
                                            {{-- <option value="{{ old('$item->id') }}">{{ $item->title }}</option> --}}
                                            <option value="{{ $item->id }}"
                                                {{ $item->id == $tour->destination_id ? 'selected' : '' }}>
                                                {{ $item->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-6 form-group">
                                    <label class="d-block" for="exampleInputType">Types<span style="color: red">*</span></label>
                                    <select class="js-example-basic-single w-100" name="type_id">
                                        @foreach ($types as $item)
                                            <option value="{{ $item->id }}"
                                                {{ $item->id == $tour->type_id ? 'selected' : '' }}>
                                                {{ $item->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-6 form-group">
                                    <label for="exampleInputDuration">Duration<span style="color: red">*</span></label>
                                    <input type="text" class="form-control" onkeyup="ChangeToDuration()" id="duration"
                                        value="{{ $tour->duration }}" name="duration"
                                        placeholder="Duration tour" maxlength="50">
                                    @if ($errors->has('duration'))
                                        <span class="text-danger">
                                            <small>{{ $errors->first('duration') }}</small>
                                        </span>
                                    @endif
                                </div>
        
                                <div class="col-6 form-group">
                                    <label for="exampleInputPrice">Price<span style="color: red">*</span></label>
                                    <input type="text" class="form-control" onkeyup="ChangeToPrice()" id="price"
                                        value="{{ $tour->price }}" name="price"
                                        placeholder="Price tour">
                                    @if ($errors->has('price'))
                                        <span class="text-danger">
                                            <small>{{ $errors->first('price') }}</small>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            

                        <div class="row">
                            <div class="col-6 form-group">
                                <label for="exampleInputImage360">Embed link image 360</label>
                                <input type="text" class="form-control" onkeyup="ChangeToImage360()" id="image_360"
                                    value="{{ $tour->image_360 }}" name="image_360"
                                    placeholder="Image 360">
                            </div>

                            <div class="col-6 form-group">
                                <label for="exampleInputVideo">Embed link video</label>
                                <input type="text" class="form-control" onkeyup="ChangeToVideo()" id="video"
                                    value="{{ $tour->video }}" name="video"
                                    placeholder="Video">
                                @if ($errors->has('video'))
                                    <span class="text-danger">
                                        <small>{{ $errors->first('video') }}</small>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-6 form-group">
                                <label for="exampleInputMap">Embed link map</label>
                                <input type="text" class="form-control" onkeyup="ChangeToMap()" id="map"
                                    value="{{ $tour->map }}" name="map"
                                    placeholder="map">
                            </div>

                            <div class="col-6 form-group ">
                                <label for="exampleInputImage">Image<span style="color: red">*</span></label>
                                {{-- style="height: 100px" id="show_image" --}}
                                <div class="col-md-4 feature_image_container">
                                    {{-- style="height: 100%;" --}}
                                    <div class="row">
                                        {{-- style="height: 100%;" --}}
                                        {{-- h-100 --}}
                                        <img id="img" class="feature_image d-block w-100 " src="" alt="">
                                    </div>
                                </div>
                                <input id="image" type="file" value="{{ $tour->image }}" class="form-control-file mt-4" name="image" accept='image/*'
                                    onchange='openFile1(event)'>
                                @if ($errors->has('image'))
                                    <span class="text-danger">
                                        <small>{{ $errors->first('image') }}</small>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-3 form-group">
                                <label for="exampleIsInterested">Interested <span style="color: red">*</span></label>
                                <br>
                                @if ($tour->is_interested == 1)
                                    <input type="radio" name="is_interested" style="margin: 0 15px"  value="1"
                                    checked {{ old('is_interested') == '1' ? 'checked' : '' }}> Interested
                                    <input type="radio" name="is_interested" style="margin: 0 15px" id="block" value="2"
                                        {{ old('is_interested') == '2' ? 'checked' : '' }}> Normal
                                @elseif($tour->is_interested == 2)
                                    <input type="radio" name="is_interested" style="margin: 0 15px"  value="1"
                                    {{ old('is_interested') == '1' ? 'checked' : '' }}> Interested
                                    <input type="radio" checked  name="is_interested" style="margin: 0 15px" value="2"
                                        {{ old('is_interested') == '2' ? 'checked' : '' }}> Normal
                                @endif
                            </div>
    
                            <div class="col-3 form-group">
                                <label for="exampleIsCulture">Cultural<span style="color: red">*</span></label>
                                <br>
                                @if ($tour->is_culture == 1)
                                    <input type="radio" name="is_culture" style="margin: 0 15px"  value="1"
                                    checked {{ old('is_culture') == '1' ? 'checked' : '' }}> Cultural
                                    <input type="radio" name="is_culture" style="margin: 0 15px" id="block" value="2"
                                        {{ old('is_culture') == '2' ? 'checked' : '' }}> Normal
                                @elseif($tour->is_culture == 2)
                                    <input type="radio" name="is_culture" style="margin: 0 15px"  value="1"
                                    {{ old('is_culture') == '1' ? 'checked' : '' }}> Cultural
                                    <input type="radio" checked  name="is_culture" style="margin: 0 15px" value="2"
                                        {{ old('is_culture') == '2' ? 'checked' : '' }}> Normal
                                @endif
                            </div>
    
                            <div class="col-3 form-group">
                                <label for="exampleTrending">Trending <span style="color: red">*</span></label>
                                <br>
                                @if ($tour->trending == 1)
                                    <input type="radio" name="trending" style="margin: 0 15px"  value="1"
                                    checked {{ old('trending') == '1' ? 'checked' : '' }}>Trending
                                    <input type="radio" name="trending" style="margin: 0 15px" id="block" value="2"
                                        {{ old('trending') == '2' ? 'checked' : '' }}>Not Trending
                                @elseif($tour->trending == 2)
                                    <input type="radio" name="trending" style="margin: 0 15px"  value="1"
                                    {{ old('trending') == '1' ? 'checked' : '' }}>Trending
                                    <input type="radio" checked  name="trending" style="margin: 0 15px" value="2"
                                        {{ old('trending') == '2' ? 'checked' : '' }}>Not Trending
                                @endif
                            </div>
    
                            <div class="col-3 form-group">
                                <label for="exampleStatus">Status <span style="color: red">*</span></label>
                                <br>
                                @if ($tour->status == 1)
                                    <input type="radio" name="status" style="margin: 0 15px"  value="1"
                                    checked {{ old('status') == '1' ? 'checked' : '' }}>Show
                                    <input type="radio" name="status" style="margin: 0 15px" id="block" value="2"
                                        {{ old('status') == '2' ? 'checked' : '' }}>Hide
                                @elseif($tour->status == 2)
                                    <input type="radio" name="status" style="margin: 0 15px"  value="1"
                                    {{ old('status') == '1' ? 'checked' : '' }}>Show
                                    <input type="radio" checked  name="status" style="margin: 0 15px" value="2"
                                        {{ old('status') == '2' ? 'checked' : '' }}>Hide
                                @endif
                            </div>
                        </div>

                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                              <a class="nav-link active" id="overview-tab" data-toggle="tab" href="#overview" role="tab" aria-controls="overview" aria-selected="true">Overview</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" id="inlcude-tab" data-toggle="tab" href="#inlcude" role="tab" aria-controls="inlcude" aria-selected="false">What Include</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" id="departure-tab" data-toggle="tab" href="#departure" role="tab" aria-controls="departure" aria-selected="false">Departure</a>
                            </li>
                          </ul>
                          <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview-tab">
                                <div class="form-group col-md-12 p-0">
                                    <textarea name="overview" class="form-control" id="editor1">{{ $tour->overview }}</textarea>
                                </div> 
                            </div>
                            <div class="tab-pane fade" id="inlcude" role="tabpanel" aria-labelledby="inlcude-tab">
                                <div class="form-group col-md-12 p-0">
                                    <textarea class="form-control" name="include" id="editor2">{{ $tour->include }}</textarea>
                                </div> 
                            </div>
                            <div class="tab-pane fade" id="departure" role="tabpanel" aria-labelledby="departure-tab">
                                <div class="form-group col-md-12 p-0">
                                    <textarea name="departure" class="form-control" id="editor3">{{ $tour->departure }}</textarea>
                                </div> 
                            </div>
                          </div>

                          <div class="form-group col-md-12 p-0 mt-3">
                            <label style="" for="exampleInputAdditional">Additional</label>
                            <textarea name="additional" class="form-control" id="editor4">{{ $tour->additional }}</textarea>
                          </div> 
                        <button type="submit" name="add_tour" class="btn btn-primary" id="button_tour">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        CKEDITOR.replace('editor1');
        CKEDITOR.replace('editor2'); 
        CKEDITOR.replace('editor3'); 
        CKEDITOR.replace('editor4'); 
        CKEDITOR.replace('editor5'); 
    </script>
@endpush
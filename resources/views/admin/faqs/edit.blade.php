@extends('admin.master')

@section('content')
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 align-self-center">
                <h4 class="page-title">Edit Faqs</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('tours.index') }}">Tour</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('faqs.show', [$faq->tour_id, $faq->id]) }}">Faqs</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Edit Faqs</li>
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
                    <form method="post" action="{{ route('faqs.update', [$faq->tour_id ,$faq->id]) }}" enctype="multipart/form-data" id="insert_data">
                        @csrf  
                        <div class="form-group">
                            <label for="exampleInputQuestion">Question <span style="color: red">*</span></label>
                            <input type="text" class="form-control" onkeyup="ChangeToQuestion()" id="question"
                                value="{{ $faq->question }}" name="question"
                                placeholder="Question" maxlength="255">
                                @if ($errors->has('question'))
                                <span class="text-danger">
                                    <small>{{ $errors->first('question') }}</small>
                                </span>
                                @endif
                        </div>

                        <div class="form-group col-md-12 p-0 mt-3">
                            <label style="" for="exampleInputAnswer">Answer <span style="color: red">*</span></label>
                            <textarea name="answer" class="form-control" id="editor1">{{ $faq->answer }}</textarea>
                            <span class="text-danger">
                                <small>{{ $errors->first('answer') }}</small>
                            </span>
                        </div> 
                        
                        <div class="form-group">
                            <label for="exampleStatus">Status <span style="color: red">*</span></label>
                            <br>
                            @if ($faq->status == 1)
                                <input type="radio" name="status" style="margin: 0 15px"  value="1"
                                checked {{ old('status') == '1' ? 'checked' : '' }}> Show
                                <input type="radio" name="status" style="margin: 0 15px" id="hide" value="2"
                                    {{ old('status') == '2' ? 'checked' : '' }}> Hide
                            @elseif($faq->status == 2)
                                <input type="radio" name="status" style="margin: 0 15px"  value="1"
                                {{ old('status') == '1' ? 'checked' : '' }}> Show
                                <input type="radio" checked  name="status" style="margin: 0 15px" value="2"
                                    {{ old('status') == '2' ? 'checked' : '' }}> Hide
                            @endif
                        </div>
                        <button type="submit" name="add_faq" class="btn btn-primary" id="button_faq">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
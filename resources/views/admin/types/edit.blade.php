@extends('admin.master')

@section('content')
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 align-self-center">
            <h4 class="page-title">Edit Type</h4>
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('types.index') }}">Types</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Type</li>
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
                <form method="post" action="{{ route('types.update', [$type->id]) }}" enctype="multipart/form-data" id="insert_data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="exampleInputTitle">Title <span style="color: red">*</span></label>
                        <input type="text" class="form-control" onkeyup="ChangeToSlug()" id="slug"
                            value="{{ $type->title }}" name="title"
                            placeholder="Title type of tour" maxlength="100">
                            @if ($errors->has('title'))
                            <span class="text-danger">
                                <small>{{ $errors->first('title') }}</small>
                            </span>
                            @endif
                    </div>
                    
                    <div class="form-group">
                        <label for="exampleStatus">Status <span style="color: red">*</span></label>
                        <br>
                        @if ($type->status == 1)
                            <input type="radio" name="status" style="margin: 0 15px"  value="1"
                            checked {{ old('status') == '1' ? 'checked' : '' }}> Active
                            <input type="radio" name="status" style="margin: 0 15px" id="block" value="2"
                                {{ old('status') == '2' ? 'checked' : '' }}> Inactive
                        @elseif($type->status == 2)
                            <input type="radio" name="status" style="margin: 0 15px"  value="1"
                            {{ old('status') == '1' ? 'checked' : '' }}> Active
                            <input type="radio" checked  name="status" style="margin: 0 15px" value="2"
                                {{ old('status') == '2' ? 'checked' : '' }}> Inactive
                        @endif
                    </div>
                    <button type="submit" name="add_typetour" class="btn btn-primary" id="button_type">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection


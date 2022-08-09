@extends('admin.master')

@section('content')
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 align-self-center">
                <h4 class="page-title">Create Type</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('types.index') }}">Types</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Create Type</li>
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
                    <form method="post" action="{{ route('types.store') }}" enctype="multipart/form-data" id="insert_data">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputTitle">Title <span style="color: red">*</span></label>
                            <input type="text" class="form-control" onkeyup="ChangeToSlug()" id="slug"
                                value="{{ old('title') }}" name="title"
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
                            <input type="radio" name="status" style="margin: 0 15px" id="status_active" value="1"
                                checked {{ old('status') == '1' ? 'checked' : '' }}> Active
                            <input type="radio" name="status" style="margin: 0 15px" id="block" value="2"
                                {{ old('status') == '2' ? 'checked' : '' }}> Inactive
                        </div>
                        <button type="submit" name="add_typetour" class="btn btn-primary" id="button_type">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- <form action="{{ route('types.store') }}" method="post">
        @csrf
        <label for="title">
            Title:
            <input type="text" name="title">
        </label><br><br>
        <label for="status">
            Status:
            <input type="text" name="status">
        </label><br><br>
        <button type="submit" name="create">Create types</button>
    </form> --}}
@endsection
@if (!empty($message))
    <a data-toggle="modal" data-target="#exampleModal" data-id="{{ $id }}" data-message="{{ $message }}" class="show-mess btn btn-primary waves-effect waves-light btn-sm" title="Show"><i
        class="fas fa-eye"></i></a>
@endif
@if (!empty($url_show))
    <a href="{{ $url_show }}" class="btn btn-primary waves-effect waves-light btn-sm " title="Show"><i
        class="fas fa-eye"></i></a>
@endif
@if (!empty($url_edit))
    <a href="{{ $url_edit }}" class="btn btn-info waves-effect waves-light btn-sm"
        title="Edit"><i class="fas fa-edit"></i></a>
@endif
@if (!empty($url_destroy))
    <a href="{{ $url_destroy }}" class="btn btn-danger waves-effect waves-light btn-sm btn-delete" title="Delete"><i
        class="fas fa-trash-alt"></i></a>
@endif
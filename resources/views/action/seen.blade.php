@if ($checked == 1) 
    <button type="button" data-id="{{ $id }}" class="btn btn-xs btn-info">New</button>
@endif
@if ($checked == 2) 
    <button type="button" data-id="{{ $id }}" class="btn btn-xs btn-success">Seen</button>
@endif

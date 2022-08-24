@if ($checked == 1) 
    <button type="button" data-id="{{ $id }}" class="btn btn-xs btn-success">Paid</button>
@endif
@if ($checked == 2) 
    <button type="button" data-id="{{ $id }}" class="btn btn-xs btn-info">Unpaid</button>
@endif

@if (!empty($places))
    <a href="{{ $places }}" class="btn btn-info waves-effect waves-light btn-sm" title="Edit">Places</a>
@endif
@if (!empty($itineraries))
    <a href="{{ $itineraries }}" class="btn btn-info waves-effect waves-light btn-sm mt-1" title="Edit">Itineraries</a>
@endif
@if (!empty($faqs))
    <a href="{{ $faqs }}" class="btn btn-info waves-effect waves-light btn-sm mt-1" title="Edit">Faqs</a>
@endif
@if (!empty($galleries))
    <a href="{{ $galleries }}" class="btn btn-info waves-effect waves-light btn-sm mt-1" title="Delete">Galleries</a>
@endif
@if (!empty($reviews))
    <a href="{{ $reviews }}" class="btn btn-info waves-effect waves-light btn-sm mt-1" title="Delete">Reviews</a>
@endif
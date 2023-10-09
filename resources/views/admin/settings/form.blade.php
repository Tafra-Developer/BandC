{{--@include('layouts.partials.validation-errors')--}}

@foreach ($records as $record)
{!! \Helper\Field::text($record->key,__($record->key) ,$record->value) !!}


@endforeach

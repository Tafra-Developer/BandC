{{--@include('layouts.partials.validation-errors')--}}
@include('flash::message')

{!! \Helper\Field::text('ogtitle',__('ogtitle'). '*') !!}
{!! \Helper\Field::text('meta_description',__('meta_description'). '*') !!}
{!! \Helper\Field::text('meta_keyword',__('meta_keyword'). '*') !!}
{!! \Helper\Field::text('author',__('author'). '*') !!}
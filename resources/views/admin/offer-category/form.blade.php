{{--@include('layouts.partials.validation-errors')--}}
@include('flash::message')
{!! \Helper\Field::text('name_ar',__('الاسم بالعربية'). '*') !!}
{!! \Helper\Field::text('name_en',__('الاسم بالانجليزية'). '*') !!}

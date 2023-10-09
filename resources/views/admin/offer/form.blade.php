{{--@include('layouts.partials.validation-errors')--}}

@php
$departments = new \App\Models\Category();
@endphp
{!! \Helper\Field::text('name_ar',__('عنوان بالعربية'). '*') !!}
{!! \Helper\Field::text('name_en',__('عنوان بالانجليزية'). '*') !!}
{!! \Helper\Field::text('content_ar',__('وصف بالعربية'). '*') !!}
{!! \Helper\Field::text('content_en',__('وصف بالانجليزية'). '*') !!}
{!! \Helper\Field::select('category_id', __('تابع لخدمة'), $departments->pluck('name'. '_' . app()->getLocale(), 'id')) !!}
{!! \Helper\Field::number('price',__('السعر'). '*') !!}
{!! \Helper\Field::fileWithPreview('img', __(' صورة')) !!}

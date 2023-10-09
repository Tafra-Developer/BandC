{{--@include('layouts.partials.validation-errors')--}}

{!! \Helper\Field::text('name_ar',__('الاسم بالعربية'). '*') !!}
{!! \Helper\Field::text('name_en',__('الاسم بالانجليزية'). '*') !!}
{!! \Helper\Field::text('desc_ar',__('الوصف بالعربية'). '*') !!}
{!! \Helper\Field::text('desc_en',__('الوصف بالانجليزية '). '*') !!}
{!! \Helper\Field::fileWithPreview('img', __(' صورة')) !!}

{{--@include('layouts.partials.validation-errors')--}}

{!! \Helper\Field::text('name_ar',__('الاسم بالعربية'). '*') !!}
{!! \Helper\Field::text('name_en',__('الاسم بالانجليزية'). '*') !!}
{!! \Helper\Field::text('desc_ar',__('الوصف بالعربية'). '*') !!}
{!! \Helper\Field::text('desc_en',__('الوصف بالانجليزية '). '*') !!}
{!! \Helper\Field::text('postion_ar',__('التخصص بالعربية '). '*') !!}
{!! \Helper\Field::text('postion_en',__('التخصص بالانجليزية '). '*') !!}
{!! \Helper\Field::text('facebook',__('facebook'). '*') !!}
{!! \Helper\Field::text('twitter',__('twitter'). '*') !!}
{!! \Helper\Field::text('insta',__('instagram'). '*') !!}
{!! \Helper\Field::fileWithPreview('img', __(' صورة')) !!}

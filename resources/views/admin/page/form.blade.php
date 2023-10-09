{{--@include('layouts.partials.validation-errors')--}}


{!! \Helper\Field::text('name_ar',__('الاسم بالعربية'). '*') !!}
{!! \Helper\Field::text('title_ar',__('عنوان عربي'). '*') !!}
{!! \Helper\Field::editor('content_ar',__('محتوى عربي'). '*') !!}

{!! \Helper\Field::text('name_en',__('الاسم بالانجليزية'). '*') !!}
{!! \Helper\Field::text('title_en',__('عنوان انجليزي'). '*') !!}
{!! \Helper\Field::editor('content_en',__('محتوى انجليزي'). '*') !!}

{!! \Helper\Field::number('number',__('ترتيب'). '*',1) !!}


{!! \Helper\Field::fileWithPreview('img', __(' صورة')) !!}

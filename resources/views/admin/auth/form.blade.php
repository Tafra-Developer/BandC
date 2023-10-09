{{--@include('layouts.partials.validation-errors')--}}


{!! \Helper\Field::text('name',__('الأسم'). '*') !!}
{!! \Helper\Field::email('email',__('البريد الالكترونى'). '*') !!}
{!! \Helper\Field::password('password',__(' كلمة السر الجديدة'). '*') !!}

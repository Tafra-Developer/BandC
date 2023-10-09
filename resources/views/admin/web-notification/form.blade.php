{{-- @include('layouts.partials.validation-errors') --}}
@include('flash::message')

{!! \Helper\Field::text('first_name', __('الاسم الاول') . '*') !!}
{!! \Helper\Field::text('last_name', __('الاسم الاخير') . '*') !!}
{!! \Helper\Field::text('phone', __(' رقم الهاتف') . '*') !!}
{!! \Helper\Field::email('email', __(' الأيميل') . '*') !!}
{!! \Helper\Field::password('password', __('كلمة المرور') . '*') !!}
{!! \Helper\Field::password('password_confirmation', __('تأكيد كلمة المرور') . '*') !!}

 @if(!isset($edit))
<label> {{ __(' الحالة') }}</label>
{!! Form::select('status', ['pending'=>'pending', 'accepted'=>'accepted', 'rejected'=>'rejected'], '  الحالة', [
    'class' => 'form-control',
    'placeholder' => 'الحالة ',
]) !!} </div>
@endif

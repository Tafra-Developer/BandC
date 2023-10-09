{{--@include('layouts.partials.validation-errors')--}}
@include('flash::message')

{!! \Helper\Field::text('name',__('الأسم'). '*') !!}
{!! \Helper\Field::text('phone', __(' رقم الهاتف') . '*') !!}
{!! \Helper\Field::email('email', __('الأيميل ') . '*') !!}
{!! \Helper\Field::password('password', __('كلمة المرور') . '*') !!}
{!! \Helper\Field::password('password_confirmation', __('تأكيد كلمة المرور') . '*') !!}

<br>
<div class="form-group" id="permissions_wrap">
    <label for="permissions">{{__('الرتب')}}</label>
    <div class="">
        <br>

        @foreach( $roles as $role)


                @if(in_array($role->id,[1,2]) && !auth()->user()->hasRole('super_admin'))
                    @continue
                @endif
                {!! Form::checkBox('roles[]',$role->id,(($record->hasRole($role->name))?true:false),[
                    'id'=>'role_'.$role->id
                ]) !!}
                <label for="role_{{$role->id}}">{{$role->name}}</label>
        @endforeach
    </div>


    <br>
    <br>

</div>
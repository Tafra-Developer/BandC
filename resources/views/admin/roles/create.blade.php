@extends('layouts.app',[
                                'page_header'       => __('الرتب'),
                                'page_description'  => __('رتبة جديدة'),
                                'link' => url('manager/role')
                                ])
@section('content')
        <!-- general form elements -->
<div class="ibox">
    <!-- form start -->
    {!! Form::model($model,[
                            'action'=>'Dashboard\RoleController@store',
                            'id'=>'myForm',
                            'role'=>'form',
                            'method'=>'POST',

                            ])!!}

    <div class="ibox-content">

        @include('admin.roles.form')

        <div class="ibox-footer">
            <button type="submit" class="btn btn-primary">{{ __('حفظ') }}</button>
        </div>

    </div>
    {!! Form::close()!!}

</div><!-- /.box -->

@endsection

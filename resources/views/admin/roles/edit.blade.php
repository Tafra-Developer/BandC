@extends('layouts.app',[
                                'page_header'       => __('الرتب'),
                                'page_description'  => __('تعديل الرتبة'),
                                'link' => url('manager/role')
                                ])
@section('content')
    <!-- general form elements -->
    <div class="ibox">
        <!-- form start -->
        {!! Form::model($model,[
                                'url'=>url('dashboard/role/'.$model->id),
                                'id'=>'myForm',
                                'role'=>'form',
                                'method'=>'PUT',
                                ])!!}

        <div class="ibox-content">
            <div class="clearfix"></div>
            <br>
            @include('admin.roles.form')

            <div class="ibox-footer">
                <button type="submit" class="btn btn-primary">{{ __('حفظ') }}</button>
            </div>

        </div>
        {!! Form::close()!!}

    </div><!-- /.box -->

@endsection



















@extends('layouts.app',[
'page_header' => '',
'page_description' => __('تعديل المستخدم ')
])

@section('content')
<div class="ibox">
    <!-- form start -->
    {!! Form::model($record, [
    'action' => ['Dashboard\AuthController@update', $record->id],
    'id' => 'myForm',
    'role' => 'form',
    'method' => 'POST',
    'files' => true,
    ]) !!}
    <div class="ibox-content">
        @include('admin.auth.form')
    </div>
    <div class="ibox-footer">
        <button type="submit" class="btn btn-primary">{{ __('حفظ') }}</button>
    </div>
    {!! Form::close() !!}
</div>
@stop

@extends('layouts.app')
@section('title', __('إضافة مدير'))

@section('content')

<div class="ibox">
    <!-- form start -->
    {!! Form::model($record, [
    'action' => 'Dashboard\AdminController@store',
    'id' => 'myForm',
    'role' => 'form',
    'method' => 'POST',
    'files' => true,
    ]) !!}
    <div class="ibox-content">
        @include('admin.admins.form')
    </div>
    <div class="ibox-footer">
        <button type="submit" class="btn btn-primary">{{ __('حفظ') }}</button>
    </div>
    {!! Form::close() !!}
</div>
@stop

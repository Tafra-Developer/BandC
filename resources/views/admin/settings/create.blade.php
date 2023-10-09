@extends('layouts.app')
@section('title', __('إضافة تصنيف'))

@section('content')

<div class="ibox">
    <!-- form start -->
    {!! Form::model($records, [
    'action' => 'Dashboard\SettingController@setSettings',
    'id' => 'myForm',
    'role' => 'form',
    'method' => 'Put',
    'files' => true,
    ]) !!}
    <div class="ibox-content">
        @include('admin.settings.form')
    </div>
    <div class="ibox-footer">
        <button type="submit" class="btn btn-primary">{{ __('حفظ') }}</button>
    </div>
    {!! Form::close() !!}
</div>
@stop

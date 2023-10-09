@extends('layouts.app')
@section('title', __('تعديل مدير'))

@section('content')
<div class="ibox">
    <!-- form start -->
    {!! Form::model($record, [
    'action' => ['Dashboard\AdminController@update', $record->id],
    'id' => 'myForm',
    'role' => 'form',
    'method' => 'PUT',
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

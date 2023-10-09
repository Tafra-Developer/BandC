
@extends('layouts.app')
@section('title', __('إضافة طالب'))

@section('content')

<div class="ibox">
    <!-- form start -->
    {!! Form::model($record, [
    'action' => 'Dashboard\StudentController@store',
    'id' => 'myForm',
    'role' => 'form',
    'method' => 'POST',
    'files' => true,
    ]) !!}
    <div class="ibox-content">
        @include('admin.students.form')
    </div>
    <div class="ibox-footer">
        <button type="submit" class="btn btn-primary">{{ __('حفظ') }}</button>
    </div>
    {!! Form::close() !!}
</div>
@stop

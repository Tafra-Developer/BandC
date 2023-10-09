
@extends('layouts.app')
@section('title', __('تعديل طالب'))

@section('content')
<div class="ibox">
    <!-- form start -->
    {!! Form::model($record, [
    'action' => ['Dashboard\StudentController@update', $record->id],
    'id' => 'myForm',
    'role' => 'form',
    'method' => 'PUT',
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

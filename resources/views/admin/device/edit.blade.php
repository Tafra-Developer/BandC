@extends('layouts.app',[
'page_header' => '',
'page_description' => __('الاطباء')
])

@section('content')
<div class="ibox">
    <!-- form start -->
    {!! Form::model($record, [
    'action' => ['Dashboard\DoctorController@update', $record->id],
    'id' => 'myForm',
    'role' => 'form',
    'method' => 'PUT',
    'files' => true,
    ]) !!}
    <div class="ibox-content">
        @include('admin.device.form')
    </div>
    <div class="ibox-footer">
        <button type="submit" class="btn btn-primary">{{ __('حفظ') }}</button>
    </div>
    {!! Form::close() !!}
</div>
@stop

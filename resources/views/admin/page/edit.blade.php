@extends('layouts.app',[
'page_header' => '',
'page_description' => __('تعديل صفحة خدمة ')
])

@section('content')
<div class="ibox">
    <!-- form start -->
    {!! Form::model($record, [
    'action' => ['Dashboard\PageController@update', $record->id],
    'id' => 'myForm',
    'role' => 'form',
    'method' => 'PUT',
    'files' => true,
    ]) !!}
    <div class="ibox-content">
        @include('admin.page.form')
    </div>
    <div class="ibox-footer">
        <button type="submit" class="btn btn-primary">{{ __('حفظ') }}</button>
    </div>
    {!! Form::close() !!}
</div>
@stop

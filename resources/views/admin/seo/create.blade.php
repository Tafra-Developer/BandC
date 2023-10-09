@extends('layouts.app',[
'page_header' => '',
'page_description' => __('أضف مدينة')
])

@section('content')

<div class="ibox">
    <!-- form start -->
    {!! Form::model($record, [
    'action' => 'Dashboard\CityController@store',
    'id' => 'myForm',
    'role' => 'form',
    'method' => 'POST',
    'files' => true,
    ]) !!}
    <div class="ibox-content">
        @include('admin.city.form')
    </div>
    <div class="ibox-footer">
        <button type="submit" class="btn btn-primary">{{ __('حفظ') }}</button>
    </div>
    {!! Form::close() !!}
</div>
@stop

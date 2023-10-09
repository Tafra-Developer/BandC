@extends('layouts.app',[
'page_header' => '',
'page_description' => 'إحصائيات عامة',
])
@section('content')

@push('styles')
{{-- ChartStyle --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>
@endpush

@endsection

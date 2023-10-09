<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--favicons -->
    <link rel="icon" type="image/png" href="{{ asset('photos/icon.png') }}" />
    <link href="{{ asset('photos/fav.png') }}" rel="apple-touch-icon">
    <title>
        {{ env('APP_NAME') }}
    </title>
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link href="{{ asset('inspina/css/bootstrap.min.css') }}" rel="stylesheet">


    <link href="{{ asset('inspina/font-awesome/css/font-awesome.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('inspina/Ionicons/css/ionicons.min.css') }}">
    <link href="{{ asset('inspina/css/animate.css') }}" rel="stylesheet">

    <link href="{{ asset('inspina/css/toastr.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('inspina/js/plugins/select2/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('inspina/js/plugins/selectize/selectize.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('inspina/js/plugins/sweetalert/sweetalert.css') }}">
    <link rel="stylesheet" href="{{ asset('inspina/js/plugins/bootstrap-fileinput/css/fileinput.min.css') }}">
    <link rel="stylesheet" href="{{ asset('inspina/js/plugins/lightbox2/css/lightbox.min.css') }}">
    <link href="{{ asset('inspina/css/datatables.min.css') }}" rel="stylesheet">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css">
    <link rel="stylesheet" href="{{ asset('css/summernote.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.7.0/switchery.min.css" rel="stylesheet" />
    {{-- <link rel="stylesheet" href="{{ asset('inspina/plugins/hijri-calender/css/jquery.calendars.picker.css') }}"> --}}
    @if (app()->getLocale() == 'en')
        <link href="{{ asset('inspina/css/style.css') }}" rel="stylesheet">
        <link href="{{ asset('inspina/css/custom.css') }}" rel="stylesheet">
    @else
        <link href="{{ asset('inspina/css/bootstrap-rtl.min.css') }}" rel="stylesheet">
        <link href="{{ asset('inspina/css/inspina-rtl.css') }}" rel="stylesheet">
        {{-- <link href="{{ asset('inspina/css/custom-rtl.css') }}" rel="stylesheet"> --}}
    @endif
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css"
        integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.2.1/css/flag-icon.min.css">


    <style>
        .ui-helper-hidden-accessible {
            border: 0;
            clip: rect(0 0 0 0);
            height: 1px;
            margin: -1px;
            overflow: hidden;
            padding: 0;
            position: absolute;
            width: 1px;
        }

    </style>
    <style>
        .html5buttons {
            float: left;
            clear: right;
        }

    </style>

    

    <script>
        window.laravelUrl = "{{ url('/') }}";
    </script>
    @stack('styles')
    
</head>

<body>

    <div id="wrapper">
        @include('layouts.sidebar')
        <div id="page-wrapper" class="gray-bg">

            @include('layouts.top-navbar')

            <section class="content-header">
                <h1 class="hidden-print">
                    {{ $page_header ?? '' }}
                    <small>{!! $page_description ?? '' !!}</small>
                </h1>
            </section>
            <div class="wrapper wrapper-content">
                <div class="row">
                    <div class="col-lg-12">
                        @yield('content')
                    </div>
                </div>
                <div class="footer hidden-print">
                    <div>
                        <strong>&copy;</strong> {{ __('جميع الحقوق محفوظة لدى' . env('APP_NAME')) }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Mainly scripts -->
    <script src="{{ asset('inspina/js/jquery-2.1.1.js') }}"></script>
    <script src="{{ asset('inspina/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('inspina/js/plugins/metisMenu/jquery.metisMenu.js') }}"></script>
    <script src="{{ asset('inspina/js/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>

    <script src="{{ asset('inspina/js/jquery.peity.min.js') }}"></script>

    <script src="{{ asset('inspina/js/toastr.min.js') }}"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/axios/0.18.0/axios.min.js'></script>

    <!-- Custom and plugin javascript -->
    <script src="{{ asset('inspina/js/inspinia.js') }}"></script>
    <script src="{{ asset('inspina/js/plugins/pace/pace.min.js') }}"></script>
    <script src="{{ asset('inspina/js/plugins/jquery-confirm/jquery.confirm.min.js') }}"></script>
    <script src="{{ asset('inspina/js/plugins/select2/select2.full.min.js') }}"></script>
    <script src="{{ asset('inspina/js/plugins/selectize/selectize.min.js') }}"></script>
    <script src="{{ asset('inspina/js/plugins/sweetalert/sweetalert.min.js') }}"></script>
    <script src="{{ asset('inspina/js/plugins/bootstrap-fileinput/js/fileinput.min.js') }}"></script>
    <script src="{{ asset('inspina/js/plugins/bootstrap-fileinput/js/fileinput_locale_ar.js') }}"></script>
    <script src="{{ asset('inspina/js/plugins/lightbox2/js/lightbox.min.js') }}"></script>


    <script src="{{ asset('jquery-ui-1.12.1/jquery-ui.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/4.5.0/socket.io.min.js"></script>

    <script src="https://momentjs.com/downloads/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.3/locale/ar-dz.min.js"
        integrity="sha512-kYlOGJBKmRZCjvWfRMPDKUBEStryFWxk0EHKTreqW7lN4eIxXGPV3dMFd2SIfCRuoz/6inFwEgimBGWvkHpGuA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ asset('js/notify.min.js') }}"></script>

    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.29.2/sweetalert2.all.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.7.0/switchery.min.js"></script>
    <script src="{{ asset('inspina/js/datatables.min.js') }}"></script>
    <script src="{{ asset('js/summernote.min.js') }}"></script>
    {{-- <script src="{{ asset('inspina/plugins/hijri-calender/js/jquery.plugin.js') }}"></script>
    <script src="{{ asset('inspina/plugins/hijri-calender/js/jquery.calendars.js') }}"></script>
    <script src="{{ asset('inspina/plugins/hijri-calender/js/jquery.calendars.plus.js') }}"></script>
    <script src="{{ asset('inspina/plugins/hijri-calender/js/jquery.calendars.picker.js') }}"></script>
    <script src="{{ asset('inspina/plugins/hijri-calender/js/jquery.calendars.ummalqura.js') }}"></script> --}}
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"
        integrity="sha512-d9xgZrVZpmmQlfonhQUvTR7lMPtO7NkZMkA0ABN3PHCbKA5nqylQ/yWlFAyY6hYgdF1Qh6nYiuADWwKB4C2WSw=="
        crossorigin="anonymous"></script> --}}
    <script src="{{ asset('js/MostafaSewidan.js') }}"></script>

    @include('layouts.scripts.delete')
    @include('layouts.scripts.plugins')
    @stack('print')
    @stack('scripts')
</body>

</html>

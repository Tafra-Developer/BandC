<head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>بيوتي أند كير</title>
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;500;600;700;800&display=swap"
                rel="stylesheet" />
        <link rel="stylesheet" href="{{ asset('front/css/bootstrap.min.css') }}">
        @if(Session::get('locale') == 'ar')
        <link rel="stylesheet" href="{{ asset('front/css/style-ar.css') }}" />
        @else
        <link rel="stylesheet" href="{{ asset('front/css/style-en.css') }}" />
        @endif
        <link rel="icon" href="{{asset('front/img/1%20(2).png')}}">

        <!-- Buttonizer -->
        <script type="text/javascript">
                (function (n, t, c, d) { if (t.getElementById(d)) { return; }; var o = t.createElement("script"); o.id = d; o.async = !0, o.src = "https://cdn.buttonizer.io/embed.js", o.onload = function () { window.Buttonizer.init(c) }, t.head.appendChild(o) })(window, document, "a3390001-c646-49f3-9bbc-21701287198b", "buttonizer_script");
        </script>
        <!-- End Buttonizer -->

</head>
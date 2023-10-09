@extends('layouts.website_app')

@section('title', __('المقالات'))

@section('content')
<meta property="og:title" content="{{ $artical->ogtitle }}" />
<meta name="description" content=" {{ $artical->meta_description }}">
<meta name="keywords" content=" {{ $artical->meta_keyword }}">
<meta name="author" content=" {{ $artical->author }}">

    <!-- Small Breadcrumb -->
    <div class="bread-2 page-header-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="header-page">
                        <h1>{{ __('المقالات') }}</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
















    <section class="banner-section">
    </section>
    <section class="post-content-section">
        <div class="container">

            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 post-title-block">

                    <h1 class="text-center">
                        {{ $artical->title }}
                    </h1>
                    <ul class="list-inline text-center">
                        <li>Author |{{ $artical->author }}</li>
                        <li>Date | {{ $artical->created_at }}</li>
                    </ul>
                </div>
                <div class="col-lg-9 col-md-9 col-sm-12">



                    <blockquote>
                        {!! $artical->description !!}
                    </blockquote>


                    <div class="image-block">
                        @if (count($artical->attachmentRelation))
                            <img src="https://hisham1.tryforsa.com/{{ $artical->attachmentRelation[0]->path }}"
                                class="img-responsive">
                        @endif
                    </div>


                </div>
                <div class="col-lg-3  col-md-3 col-sm-12">
                    @foreach (\App\Models\Advertsment::inRandomOrder()->limit(3)->get() as $ad)
                        <div class="well">
                            <h2><a href="{{ route('ahmed.adsDetails',$ad->id) }}">

                                اعلان
                            </a>
                            </h2>
                            <ul class="list-inline">
                                <p>{{ $ad->name_ar }}</p>

                                @php
                                    $fileArr = [];
                                    $media = explode('##', $ad->pic);
                                    foreach ($media as $file) {
                                        if (empty($file) || $file == 'm') {
                                            continue;
                                        }
                                        $fileArr[] = $file;
                                    }
                                @endphp

                                @foreach ($fileArr as $img)
                                    <img src="{{ asset('website/' . $img) }}" width="200">
                                @endforeach

                            </ul>
                        </div>
                    @endforeach


                </div>
            </div>


        </div> <!-- /container -->
    </section>





























@endsection

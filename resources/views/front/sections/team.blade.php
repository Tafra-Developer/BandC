@inject('doctorClass', 'App\Models\Doctor')

<!-- $$$$$$$$$$$$$$$$$$ start doctors $$$$$$$$$$$$ -->
<section id="doctors" class="py-3">
    <!-- ======== heading ====== -->
    <div class="doctors-heading heading mb-1">
        <h2>{{ __('خبرائنا') }}</h2>
        <p>{{ __('لقاء مع خبرائنا') }}</p>
    </div>
    <div class="container py-3">
        <!-- ######## start offer nav #######  -->
        <ul class="offers-nav nav nav-pills mb-3 d-flex justify-content-center " id="pills-tab" role="tablist">

        </ul>



        <div class="tab-content" id="pills-tabContent">
            <div class="row g-4 justify-content-center">
                @foreach ($doctorClass->get() as $doctor)

                <div class="col-lg-4 col-md-6">
                    <div class="offers-box">
                        <div class="offers-img">
                            <img src="{{ asset('storage/public/images/'.$doctor->img) }}" alt="hifu" class="w-100" />
                        </div>
                        <div class="offers-layer d-flex justify-content-center align-items-center">
                            <div class="offers-layer-cap d-flex flex-column justify-content-center align-items-center">
                                <h5 class="text-light fw-bolder">{{ $doctor->name }}</h5>
                                <p class="fs-6 fw-bold text-light">
                                    {{ $doctor->desc }}
                                </p>
                                <div class="offers-icon d-flex">
                                    <span class=" ">
                                        @if($doctor->facebook != NULL)
                                        <a class="fa fa-facebook" href="http://{{$doctor->facebook}}" target="_blank"></a>
                                        @endif
                                        @if($doctor->twitter != NULL)
                                        <a class="fa fa-twitter " href="http://{{$doctor->twitter}}" target="_blank"></a>
                                        @endif
                                        @if($doctor->insta != NULL)
                                        <a class="fa fa-instagram" href="http://{{$doctor->insta}}" target="_blank"></a>
                                        @endif
                                        
                                    </span>
                                </div>
                                <p class="salary fs-5">{{ $doctor->postion_ar }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                @endforeach

            </div>
        </div>
    </div>



</section>
<!-- $$$$$$$$$$$$$$$$$$ end doctors $$$$$$$$$$$$ -->
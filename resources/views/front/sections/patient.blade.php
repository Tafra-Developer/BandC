@inject('patientClass', 'App\Models\Patient')
<!-- ^^^^^^^^^^^^^^ start before & after  ^^^^^^^^^^^ -->
<section id="before-after" class=" py-5">
    <!-- ####### heading ############  -->
    <div class="about-heading heading">
        <h2>{{ __('حالات') }}</h2>
        <p class="fw-bold">{{ __('قبل &بعد') }}</p>
    </div>
    <div class="before-box py-5 d-flex">
        <div class="before-layer"></div>
        <div class="container">
            <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel ">
                <div class="carousel-inner">
                    @php
                        $i = 1;
                        $fr = 1;
                    @endphp
                    @foreach ($patientClass->get() as $patient)
                        @if ($i == 1)
                            <div class="carousel-item {{ $fr == 1 ? 'active' : '' }}">
                                <div class="row g-3 justify-content-center">
                        @endif
                        قبل &بعد
                        <div class="col-lg-4 col-md-6">
                            <div class="before-after-box">
                                <div class="before-after-img">
                                    <img src= "{{ asset('storage/public/images/'.$patient->img) }}" class="w-100">
                                </div>
                                <div class="before-after-layer d-flex justify-content-center align-items-center text-center">
                                    <h3 class="text-white fw-bold"> {{ $patient->name }} </h3>
                                </div>
                            </div>
                        </div>

                        @if ($i == 3)
                </div>
            </div>
            @endif
            @php
                $i++;
                $fr++;

                if ($i == 4) {
                    $i = 1;
                }
            @endphp
            @endforeach

            @if ($patientClass->get()->count() % 3 > 0)
        </div>
    </div>
    @endif
    </div>
    <button class="carousel-control-prev " type="button" data-bs-target="#carouselExampleControls"
        data-bs-slide="prev">
        <span class="carousel-control-prev-icon position-absolute" aria-hidden="true"></span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
        <span class="carousel-control-next-icon  aria-hidden="true"></span>
    </button>
    </div>

    </div>
    </div>
    <a href="{{ route('client.before-after') }}" class="btn before-btn  fw-bolder ">شاهد جميع الصور</a>
</section>
<!-- ^^^^^^^^^^^^^^ end before & after  ^^^^^^^^^^^ -->

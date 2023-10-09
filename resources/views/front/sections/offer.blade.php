@inject('categoryClass', 'App\Models\Category')
@inject('offerClass', 'App\Models\Offer')

<!-- ############### start offers ########## -->
<section id="offers" class="py-5 bg-light">
    <!-- ======== heading ====== -->
    <div class="offers-heading heading">
        <h2>{{ __('عروضنا') }}</h2>
        <p> {{ __('عروضنا') }}</p>
    </div>
    <div class="container py-3">
        <!-- ######## start offer nav #######  -->
        <ul class="offers-nav nav nav-pills mb-3 d-flex justify-content-center " id="pills-tab" role="tablist">
            @php
                $fr = 1;
                $fr2 = 1;
                $categoryGet = $categoryClass
                    ->whereHas('offers', function ($query) {
                        $query->where('id', '>', 0);
                    })
                    ->get();

            @endphp
            @foreach ($categoryGet as $category)
                <li class="offers-nav-item m-2 " role="presentation">
                    <button class="offers-nav-link btn btn-main fw-bold {{ $fr == 1 ? 'active' : '' }}"
                        id="cat-{{ $category->id }}-tab" data-bs-toggle="pill" data-bs-target="#cat-{{ $category->id }}"
                        type="button" role="tab" aria-controls="cat-{{ $category->id }}"
                        aria-selected="{{ $fr == 1 ? 'true' : 'false' }}">
                        {{ $category->name }}
                    </button>
                </li>


                @php

                    $fr++;

                @endphp
            @endforeach
        </ul>



        <div class="tab-content" id="pills-tabContent">
            @foreach ($categoryGet as $category)
                <div class="tab-pane fade {{ $fr2 == 1 ? 'active show' : '' }}" id="cat-{{ $category->id }}" role="tabpanel" aria-labelledby="cat-{{ $category->id }}-tab">
                    <div class="row g-4 justify-content-center">
                        @foreach ($category->offers as $offer)
                            @if($offer->is_active == 1)
                            <div class="col-lg-4 col-md-6">
                                <div class="offers-box">
                                    <div class="offers-img">
                                        <img src="{{ asset('storage/public/images/'.$offer->img) }}" alt="hifu" class="w-100" />
                                    </div>
                                    <div class="offers-layer d-flex justify-content-center align-items-center">
                                        <div
                                            class="offers-layer-cap d-flex flex-column justify-content-center align-items-center">
                                            <h5 class="text-light fw-bolder">{{ $offer->name }}</h5>
                                            <p class="fs-6 fw-bold text-light">
                                                {{ $offer->content }}
                                            </p>
                                            <div class="offers-icon d-flex">
                                                <span class=" ">
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                </span>
                                            </div>
                                            <p class="salary fs-5">{{ $offer->price }} ريال</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                        @endforeach

                    </div>
                </div>
                @php

                $fr2++;

            @endphp
            @endforeach
        </div>
    </div>
</section>
<!-- ############### end offers ########## -->

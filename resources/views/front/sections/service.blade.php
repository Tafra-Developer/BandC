@inject('pages', 'App\Models\Page')

<!-- =========== start our-services ============== -->
<section id="our-services" class="py-5">
    <div class="container-fluid m-0 p-0">
        <div class="row g-0">
            <div class="col-md-6 py-5 bg-body-secondary">
                <div class="card-box d-flex align-items-center justify-content-center">
                    <h3 class="text-center fw-bold">{{ __('خدماتنا المميزة') }}..</h3>
                </div>
            </div>

            @foreach ($pages->orderBy('number')->get() as $page)


                <div class="col-md-3">
                    <a href="{{ route('client.page', $page) }}" class="services-box position-relative">
                        <div class="services-img">
                            <img src="{{ asset($page->img) }}" alt="{{ $page->name }}" class="w-100" />
                        </div>
                        <div class="img-layer d-flex justify-content-center align-items-center">
                            <h3 class="text-white fw-bolder shadow">{{ $page->name }}</h3>
                        </div>
                    </a>
                </div>
            @endforeach


        </div>
    </div>
</section>
<!-- =========== end our-services ============== -->

@inject('pages', 'App\Models\Patient')
<br>
<br>
<br>
<h2 class="text-center text-dark">جميع الحالات</h2>

<!-- =========== start our-services ============== -->
    <section id="our-services" class="py-5">
        <div class="container-fluid m-0 p-0">
            <div class="row g-3 align-items-center">


                @foreach ($pages->get() as $page)

                    <div class="col-md-3">
                        <div class="services-box position-relative">
                            <div class="services-img">
                                <img src="{{ asset('storage/public/images/'.$page->img) }}" alt="{{ $page->name }}" class="w-100" />
                            </div>
                            <div class="img-layer d-flex justify-content-center align-items-center text-center">
                                <h3 class="text-white fw-bolder shadow">{{ $page->name }}</h3>
                            </div>
                        </div>
                    </div>
                @endforeach


            </div>
        </div>
    </section>
    <!-- =========== end our-services ============== -->

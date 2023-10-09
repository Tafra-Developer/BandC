@inject('deviceClass', 'App\Models\Device')
<!-- $$$$$$$$$$$$$$$$$$ start devices $$$$$$$$$$$$ -->
<section id="devices" class="py-5">
    <!-- ======== heading ====== -->
    <div class="devices-heading heading">
        <h2>أجهزتنا</h2>
        <p>أجهزتنا المميزة</p>
    </div>

    <div class="container">
        <div class="row g-4 justify-content-center align-items-center mt-3">
            @foreach ($deviceClass->get() as $device)
            <div class="devices-card col-lg-4 col-md-6">
                <div class="card-device shadow">
                    <div class="card-img overflow-hidden">
                        <img src="{{ asset('storage/public/images/'.$device->img) }}" class="w-100" alt="our devices" />
                    </div>
                    <div class="card-body d-flex justify-content-between align-items-center py-4 px-2 bg-light">
                        <div class="card-cap p-3">
                            <h5 class="card-title fw-bolder text-dark fs-5">
                            {{ $device->name }}
                            </h5>
                        </div>

                    </div>
                </div>
            </div>
            @endforeach

            <!-- ========== card 2 ========== -->

          
        </div>
    </div>
</section>
<!-- $$$$$$$$$$$$$$$$$$ end devices $$$$$$$$$$$$ -->
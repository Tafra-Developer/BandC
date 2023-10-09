    <!-- ================== hello ================= -->
    <section id="hello" class="py-4">
        <div class="hello-box d-flex flex-column justify-content-center align-items-center">
            <h2 class="text-center text-dark">
                {{ __('مرحبا بكم في عيادات بيوتي أند كير') }}
            </h2>
            <div class="hello-icon mt-4 d-flex justify-content-center align-items-center">
                <span class="facebook-icon ms-2 py-2 px-3 rounded-3 d-flex justify-content-center align-items-center">
                    <a  target="_blank" href="{{ Helper\Setting::settingKey('facebook') }}"> <i
                            class="fa-brands fa-facebook-f text-white"></i></a>
                </span>
                <span class="instagram-icon ms-2 py-2 px-3 rounded-3 d-flex justify-content-center align-items-center">
                    <a  target="_blank" href="{{ Helper\Setting::settingKey('instagram') }}"><i
                            class="fa-brands fa-instagram text-white"></i></a>
                </span>
                <span class="whatsapp-icon ms-2 py-2 px-3 rounded-3 d-flex justify-content-center align-items-center">
                    <a  target="_blank" href="https://wa.me/+966558585321"><i
                            class="fa-brands fa-whatsapp text-white"></i></a>
                </span>

                <span class="tiktok-icon  ms-2 py-2 px-3 rounded-3 d-flex justify-content-center align-items-center">
                    <a  target="_blank" href="{{ Helper\Setting::settingKey('tiktok') }}"><i
                            class="fa-brands fa-tiktok text-white"></i></a>
                </span>
                <span class="snap-icon  ms-2 py-2 px-3 rounded-3 d-flex justify-content-center align-items-center">
                    <a  target="_blank" href="{{ Helper\Setting::settingKey('snapchat') }}"><i class="fa-brands fa-snapchat"></i></a>
                </span>
            </div>
        </div>
    </section>
    <!-- ====================== end hello =============== -->

    <!-- ==================== start follow us =============== -->
    <section id="follow-us" class="py-5">
        <div class="follow-box">
            <h3 class="text-center fs-1 fw-bolder">
                {{ __('تابعنا علي مواقع التواصل') }}
            </h3>
            <div class="followUs-icon mt-4 d-flex justify-content-center align-items-center">
                <span class="follow-icon ms-2 py-2 px-3 rounded-3 d-flex justify-content-center align-items-center">
                    <a href="{{ \Helper\Setting::settingKey('facebook') }}"> <i class="fa-brands fa-facebook-f"></i></a>
                </span>
                <span class="follow-icon ms-2 py-2 px-3 rounded-3 d-flex justify-content-center align-items-center">
                    <a href="{{ \Helper\Setting::settingKey('instagram') }}"><i class="fa-brands fa-instagram"></i></a>
                </span>
                <span class="follow-icon ms-2 py-2 px-3 rounded-3 d-flex justify-content-center align-items-center">
                    <a href="https://wa.me/+966558585321"><i class="fa-brands fa-whatsapp"></i></a>
                </span>

            </div>
        </div>
    </section>
    <!-- ==================== end follow us =============== -->

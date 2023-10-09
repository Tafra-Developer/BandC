    <!-- ########################## -->
    <footer class="py-5 bg-white">
        <div class="footer-layer">
            <div class="container">
                <div class="row top-footer d-flex justify-content-between align-items-center">
                    <div class="col-lg-4">
                        <div class="footer-img py-3">
                            <img src="{{ asset('front/img/1.png') }}" class="w-75" alt="" />
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="footer-icons position-absolute d-flex">
                            <span class="ms-2 py-2 px-3 rounded-3 bg-dark d-flex justify-content-center align-items-center">
                                <a href="{{ \Helper\Setting::settingKey('facebook') }}"><i class="fa-brands fa-facebook-f text-white"></i></a>
                            </span>
                            <span class="ms-2 py-2 px-3 rounded-3 bg-dark d-flex justify-content-center align-items-center">
                                <a href="{{ \Helper\Setting::settingKey('instagram') }}"><i class="fa-brands fa-instagram text-white"></i></a>
                            </span>
                            <span class="ms-2 py-2 px-3 rounded-3 bg-dark d-flex justify-content-center align-items-center">
                                <a href="https://wa.me/+966558585321"><i class="fa-brands fa-whatsapp text-white"></i></a>
                            </span>

                        </div>
                    </div>
                </div>
            </div>

            <div class="container">
                <div class="row g-4 mt-5 down-footer justify-content-around">
                    <div class="col-lg-4">
                        <div class="contact bg-white py-3 px-3 rounded-4">
                            <h5 class="fw-bolder">{{ __('تواصل معنا') }}</h5>
                            <p>
                                {{ __('عيادات بيوتي أند كير المتخصصة في الجلدية والتجميل والليزر بأحدث التقنيات الطبية') }}
                            </p>
                            <ul>
                                <li>
                                    <i class="fa-solid fa-phone"></i>
                                    <a dir="ltr" href="tel:{{ \Helper\Setting::settingKey('phone') }}" class="text-dark me-1">+966920009149</a>
                                </li>
                                <li>
                                    <i class="fa-solid fa-envelope"></i>
                                    <span class="text-dark me-1">beautycare@beautyandcare.co</span>
                                </li>
                                <li class="py-1">
                                    <i class="fa-regular fa-clock"></i>
                                    <span class="text-dark me-1">{{ \Helper\Setting::settingKey('time') }}</span>
                                </li>
                                {{-- <li class="py-1">
                                    <i class="fa-regular fa-clock"></i>
                                    <span class="text-dark me-1">الخميس: 9:00AM - 9:00PM</span>
                                </li> --}}
                                <li class="py-1">
                                    <i class="fas fa-map-marker-alt"></i>
                                    <span class="text-dark me-1">{{ \Helper\Setting::settingKey('address') }}</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="footer-links text-white d-flex align-items-center">
                            <ul>
                                <h5 class="mb-4">{{ __('روابط سريعة') }}</h5>

                                <li>
                                    <i class="fas fa-caret-right ms-1"></i>
                                    <a href="#" class="text-white">{{ __('الرئيسية') }}</a>
                                </li>
                                <li class="my-2">
                                    <i class="fas fa-caret-right ms-1"></i>
                                    <a href="#our-services" class="text-white">{{ __('خدماتنا') }}</a>
                                </li>
                                <li>
                                    <i class="fas fa-caret-right ms-1"></i>
                                    <a href="#" class="text-white">{{ __('العـروض') }}</a>
                                </li>
                            </ul>
                            <ul>
                                <li class="my-2">
                                    <i class="fas fa-caret-right ms-1"></i>
                                    <a href="#" class="text-white">{{ __('الأجـهـزة') }}</a>
                                </li>
                                <li>
                                    <i class="fas fa-caret-right ms-1"></i>
                                    <a href="#" class="text-white">{{ __('الأطـباء') }}</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="lastfooter position-absolute start-0 bottom-0 end-0 text-center pt-2">
            <p class="text-white">
                Copyright <span  class="beautyWord"><a style="color:#ffa011;" href="https://www.tafraa.com/" target="_blank">@ tafra</a></span> - {{ date('Y') }}
            </p>
        </div>
    </footer>
    <script src="{{ asset('front/js/bootstrap.bundle.min.js') }}"></script>
    <script src="https://kit.fontawesome.com/4f8b7a1f5d.js" crossorigin="anonymous"></script>
    <script src="{{ asset('front/js/index.js') }}"></script>

<!-- ===========Nav============= -->
    <nav id="navbar-example" class="navbar fixed-top navbar-expand-lg">
        <div class="container">
            <a class="nav-nav navbar-brand fw-bold" href="#home"><img src="{{ asset('front/img/1 (2).png') }}"
                    alt="logo" class="main-logo w-75" /></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="navInfo collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item nav-style">
                        <a class="nav-link active fw-bold px-3" href="{{ route('client.home') }}#home">{{ __('الرئيسية') }}</a>
                    </li>
                    <li class="nav-item nav-style">
                        <a class="nav-link fw-bold fw-medium px-3"
                            href="{{ route('client.home') }}#our-services">{{ __('خدماتنا') }}</a>
                    </li>
                    <li class="nav-item nav-style">
                        <a class="nav-link fw-bold fw-medium px-3"
                            href="{{ route('client.home') }}#doctors">{{ __('الأطـباء') }}</a>
                    </li>
                    <li class="nav-item nav-style">
                        <a class="nav-link fw-bold fw-medium px-3" href="{{ route('client.before-after') }}">
                            {{ __('قبل &بعد') }}
                        </a>
                    </li>
                    <li class="nav-item nav-style">
                        <a class="nav-link fw-bold fw-medium px-3" href="{{ route('client.home') }}#offers">{{ __('العـروض') }}</a>
                    </li>

                    <li class="nav-item nav-style">
                        <a class="nav-link fw-bold fw-medium px-3"
                            href="{{ route('client.home') }}#devices">{{ __('الأجـهـزة') }}</a>
                    </li>

                    @if (app()->getLocale() == 'en')
                        <li class="nav-item nav-style">
                            <a class="nav-link fw-bold fw-medium px-3" style="height: 30px"
                                href="{{ url('/ar') }}">
                                <span href="sadasd" id="sauidiFlag" class="flag position-absolute">
                                    <img src="{{ asset('front/img/falg_ar.svg') }}" class="w-100" alt="" />
                                </span>
                            </a>
                        </li>
                    @elseif(app()->getLocale() == 'ar')
                        <li class="nav-item nav-style">
                            <a class="nav-link fw-bold fw-medium px-3" style="height: 30px"
                                href="{{ url('/en') }}">
                                <span href="" id="amircaFlag" class="flag position-absolute">
                                    <img src="{{ asset('front/img/amircaFlag.png') }}" class="w-100" alt="" />
                                </span>
                            </a>
                        </li>
                    @endif
                </ul>





                {{-- <a class="btn-main nav-btn btn text-center ms-3" href="#appointment">
                    احجز موعدك</a> --}}
            </div>
        </div>
    </nav>
    <!-- ===========end Nav============= -->
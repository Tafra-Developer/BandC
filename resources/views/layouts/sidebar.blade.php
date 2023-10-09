<style>
    body.mini-navbar .navbar-default .nav>li>a {
        font-size: 10px;
    }
</style>
<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element">
                    <div class="text-center">
                        <img alt="image" class="img-circle" style="max-width: 60px;"
                            src="{{ asset('inspina/img/default.png') }}" />
                    </div>
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <div class="clear text-center">
                            <span class="block m-t-xs">
                                <strong class="font-bold">{{ auth()->check() ? Auth::user()->name : null }}</strong>
                                {{-- @foreach (auth()->user()->roles as $role) --}}
                                {{-- <span class="label label-success">{{$role->display_name}}</span> --}}
                                {{-- @endforeach --}}
                            </span>
                        </div>
                    </a>

                    <ul class="dropdown-menu animated fadeInRight m-t-xs">


                    </ul>
                </div>
            </li>



            <li>
                <a href="{{ route('admin.index') }}">
                    <i class="fa fa-home"></i>
                    {{ __('الرئيسية') }}
                </a>
            </li>

            <li>
                <a href="{{ route('admin.contact.index') }}">
                    <i class="fa fa-calendar"></i>
                    {{ __('الحجوزات') }}
                </a>
            </li>
            <li>
                <a href="{{ route('admin.device.index') }}">
                    <i class="fa fa-stethoscope"></i>
                    {{ __('الاجهزة') }}
                </a>
            </li>
            <li>
                <a href="{{ route('admin.doctor.index') }}">
                    <i class="fa fa-user"></i>
                    {{ __('الاطباء') }}
                </a>
            </li>
            <li>
                <a href="{{ route('admin.category.index') }}">
                    <i class="fa fa-heartbeat" aria-hidden="true"></i>
                    {{ __('الخدمات') }}
                </a>
            </li>
            

            <li>
                <a href="{{ route('admin.page.index') }}">
                    <i class="fa fa-star" aria-hidden="true"></i>
                    {{ __('الخدمات المميزة') }}
                </a>
            </li>

            <li>
                <a href="{{ route('admin.patient.index') }}">
                    <i class="fa fa-child " aria-hidden="true"></i>
                    {{ __('الحالات') }}
                </a>
            </li>

            <li>
                <a href="{{ route('admin.offer.index') }}">
                    <i class="fa fa-bolt" aria-hidden="true"></i>
                    {{ __('العروض') }}
                </a>
            </li>





{{--
            <li>
                <a href="{{ route('admin.admins.index') }}">
                    <i class="fa fa-user-circle" aria-hidden="true"></i>
                    {{ __('مديرين النظام') }}
                </a>
            </li> --}}


{{--
            <li>
                <a href="{{ route('admin.role.index') }}">

                    <i class="fa fa-user-circle" aria-hidden="true"></i>
                    {{ __('الادوار و الصلاحيات') }}
                </a>
            </li> --}}


            <li>
                <a href="{{ route('admin.settings.create') }}">
                    <i class="fa fa-info" aria-hidden="true"></i>
                    {{ __('معلومات الموقع') }}
                </a>
            </li>


        <li>
            <a href="{{ route('admin.user.settings', auth()->user()->id) }}">
                <i class="fa fa-cog " aria-hidden="true"></i>
                {{ __('اعدادات الحساب') }}
            </a>
        </li>


        <li>
            <script type="">
                    function submitSignout() {
                        document.getElementById('signoutForm').submit();

                    }
                </script>
            {!! Form::open(['method' => 'post', 'url' => url('dashboard/logout'), 'id' => 'signoutForm']) !!}

            {!! Form::close() !!}

            <a href="#" onclick="submitSignout()">
                <i class="fa fa-lock"></i> {{ __('تسجيل الخروج') }}
            </a>
        </li>


    </ul>

</div>
</nav>

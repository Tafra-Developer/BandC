<div class="row border-bottom">
    <nav class="navbar navbar-static-top white-bg" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary pull-right" href="#"><i
                    class="fa fa-bars"></i> </a>
        </div>


        <ul class="nav navbar-top-links navbar-right">
            <li>
                @if(app()->getLocale() == 'en')
                <a class="nav-label" href="{{ url('/ar/dashboard') }}"><span class="flag-icon flag-icon-sa"> </span> العربية</a>
            @elseif(app()->getLocale() == 'ar')
                <a class="nav-label" href="{{ url('/en/dashboard') }}"><span class="flag-icon flag-icon-us"> </span> English</a>
            @endif
            </li>
        </ul>
    </nav>
</div>

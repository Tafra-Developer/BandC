@can('عرض الطلبات')
    <li>
        <a href="{{ route('order.index') }}">
            <i class="fa fa-shopping-cart"></i>
            <span class="nav-label">
                {{ __('الطلبات') }}
            </span>
            <span class="fa arrow"></span>
        </a>
        <ul class="nav nav-second-level collapse">
            <li>
                    <a href="{{ route('order.index') }}">
                        <span class="nav-label" style="display:block;">
                            {{ __('جميع الطلبات') }}
                        </span>
                    </a>
            </li>
            @php
            @endphp
            @foreach (config('order.AStatus') as $key => $value)
                <li>
                        <a href="{{ route('order.index', ['status' => $key.'?status='.$key]) }}">
                            <span class="nav-label" style="display:block;">
                                {{ $value }}
                            </span>
                        </a>
                </li>
            @endforeach
        </ul>
    </li>
@endcan

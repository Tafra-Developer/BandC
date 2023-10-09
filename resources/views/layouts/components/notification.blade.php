<ul class="nav navbar-top-links navbar-right">
    <li class="dropdown">
        <a class="dropdown-toggle count-info {{ $class }}" data-toggle="dropdown" href="#" aria-expanded="false">
            <i class="{{ $icon }}" style="font-size: 1.5em" data-toggle="tooltip"
                title="{{ __('اﻹستشارات') }}"></i>
            <span class="label label-danger"
                style="margin-top: -5px;margin-right: -2px">{{ $notification->count() }}</span>
        </a>
        <ul class="dropdown-menu dropdown-alerts" style="margin-right: -55px;">
            @if ($notification->count() > 0)
                @foreach ($notification as $record)
                    <li>
                        @if (isset($record->data['notype']))

                        @if ($record->data['usertype'] == 'manager')
                        <a href="{{ route('order.chat.admin',$record->data['id']) }}" class="dropdown-item">
                            <div>
                                
                                {{ $record->data['body'] }}
                            </div>
                            <span class="float-right text-muted small">
                                {{ \Carbon\Carbon::parse($record->created_at) }}
                            </span>
                        </a>
                        @else
                        <a href="{{ route('order.chat.markter',$record->data['id']) }}" class="dropdown-item">
                            <div>
                                {{ $record->data['body'] }}
                            </div>
                            <span class="float-right text-muted small">
                                {{ \Carbon\Carbon::parse($record->created_at) }}
                            </span>
                        </a>
                        @endif
                            
                        @else
                        <a href="#/" class="dropdown-item">
                            <div>
                               
                                {{ $record->data['body'] }}
                            </div>
                            <span class="float-right text-muted small">
                                {{ \Carbon\Carbon::parse($record->created_at) }}
                            </span>
                        </a>
                        @endif
                    </li>
                @endforeach
                <li class="dropdown-divider"></li>
                <li class="dropdown-divider"></li>
                <li>
                    <div class="text-center link-block">
                        <a href="{{ route("$route") }}" class="dropdown-item">
                            <strong>{{ __('مشاهدة الكل') }}</strong>
                            <i class="fa fa-angle-left"></i>
                        </a>
                    </div>
                </li>
            @else
                <li>
                    <div class="text-center link-block">
                        <strong>{{ __('لا توجد إشعارات جديدة') }}</strong>
                    </div>
                </li>
            @endif
        </ul>
    </li>
</ul>

@if(Auth::guard('markter')->check())
    @push('scripts')
    <script>
        $(document).on('click', '.{{ $class }}', function() {
            $.ajax({
                url: "{{ route('notification.show', $type) }}",
                type: 'get',
                success: function(data) {
                    console.log('done');
                }
            });
        });
    </script>
    @endpush
@elseif(Auth::guard('web')->check())
    @push('scripts')
    <script>
        $(document).on('click', '.{{ $class }}', function() {
            $.ajax({
                url: "{{ route('admin-notification.show', $type) }}",
                type: 'get',
                success: function(data) {
                    console.log('done');
                }
            });
        });
    </script>
    @endpush
@endif


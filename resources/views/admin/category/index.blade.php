@extends('layouts.app', [
    'page_header' => '',
    'page_description' => __('الخدمات'),
])

@section('content')
    <div class="ibox-content">

        <button type="button" class="btn  btn-primary btn-sm" style="margin-right: 10px">
            <a href="{{ route('admin.category.create') }}" class="btn btn-primary btn-sm">
                <i class="fa fa-plus"></i> {{ __('إضافة') }}
            </a>
        </button>

    </div>
    <div class="clearfix"></div>
    <br>
    @include('layouts.partials.results-count')
    <div class="ibox-content">
        
        <div class="table-responsive">
            @if (!empty($records) && count($records) > 0)
                <table class="table table-bordered">
                    <thead>
                        <th class="text-center">#</th>
                        <th class="text-center">{{ __('الأسم') }}</th>
                        <th class="text-center">{{ __('تعديل') }}</th>
                        <th class="text-center">{{ __('حذف') }}</th>

                    </thead>
                    <tbody>
                        @php $count = 1; @endphp
                        @foreach ($records as $record)
                            <tr id="removable{{ $record->id }}">
                                <td class="text-center">
                                    {{ $records->perPage() * ($records->currentPage() - 1) + $loop->iteration }}</td>
                                <td class="text-center">{{ $record->name }}</td>


                                <td class="text-center">
                                    <a href="{{ route('admin.category.edit', $record->id) }}"
                                        class="btn btn-xs btn-success"><i class="fa fa-edit"></i></a>
                                </td>
                                <td class="text-center">
                                    <form method="post" action="{{ route('admin.category.destroy', $record->id) }}">
                                        @method('delete')
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-xs"><i
                                                class="fa fa-trash"></i></button>
                                    </form>
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="text-center">
                    {!! $records->render() !!}
                </div>
            @else
                <div>
                    <h3 class="text-info" style="text-align: center">{{ __(' لا توجد بيانات للعرض ') }}</h3>
                </div>
            @endif
        </div>
    </div>
    </div>
@endsection

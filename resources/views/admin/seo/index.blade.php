@extends('layouts.app', [
    'page_header' => '',
    'page_description' => __('اضافة مدينة'),
])

@section('content')

    <div class="clearfix"></div>
    <br>
    @include('layouts.partials.results-count')
    <div class="ibox-content">
        @include('flash::message')
        <div class="table-responsive">
            @if (!empty($records) && count($records) > 0)
                <table class="table table-bordered">
                    <thead>
                        <th class="text-center">#</th>
                        <th class="text-center">{{ __('ogtitle') }}</th>
                        <th class="text-center">{{ __('meta_description') }}</th>
                        <th class="text-center">{{ __('meta_keyword') }}</th>
                        <th class="text-center">{{ __('author') }}</th>

                        <th class="text-center">{{ __('تعديل') }}</th>

                    </thead>
                    <tbody>
                        @php $count = 1; @endphp
                        @foreach ($records as $record)
                            <tr id="removable{{ $record->id }}">
                                <td class="text-center">
                                    {{ $records->perPage() * ($records->currentPage() - 1) + $loop->iteration }}</td>
                              
                                    <td class="text-center">{{ $record->ogtitle }}</td>
                                    <td class="text-center">{{ $record->description }}</td>
                                    <td class="text-center">{{ $record->keyword }}</td>
                                    <td class="text-center">{{ $record->author }}</td>


                                <td class="text-center">
                                    <a href="{{ route('admin.seo.edit', $record->id) }}" class="btn btn-xs btn-success"><i
                                            class="fa fa-edit"></i></a>
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

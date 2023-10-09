@extends('layouts.app')
@section('title', __('المرضى'))

@section('content')
<div class="ibox-content">
    <div class="pull-left">
        <a href="{{ route('admin.admins.create') }}" class="btn btn-primary btn-sm">
            <i class="fa fa-plus"></i> {{ __('إضافة') }}
        </a>
    </div>


    {{-- &ensp;--}}
    <div>

        <button type="button" class="btn  btn-primary btn-sm" data-toggle="modal" data-target="#myModal"
            style="margin-right: 10px">
            <i class="fa fa-search"></i>
            __('{{ __('بحث متقدم') }}')
        </button>
        <div class="modal inmodal" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content animated bounceInRight text-right">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span
                                aria-hidden="true">&times;</span><span class="sr-only">{{__('إغلاق')}}</span></button>
                        <h4 class="modal-title">{{__('بحث')}}</h4>
                    </div>
                    <div class="modal-body">
                        {!! Form::open([
                        'method' => 'GET',
                        'id' => 'myForm'
                        ]) !!}
                        <div class="row">
                            <div class="col-sm-4">
                                {!! \Helper\Field::text('name' ,__('اسم المدير'),request('name')) !!}
                            </div>

                            <div class="clearfix"></div>


                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary"><i class="fa fa-search"></i> {{__('بحث')}}</button>
                        <button onclick="clearName()" type="button" class="btn btn-warning" id="reset_form"><i
                                class="fa fa-recycle"></i> {{__('تفريغ الحقول')}}</button>
                        <button type="button" class="btn btn-white" data-dismiss="modal">{{__('إغلاق')}}</button>
                    </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>


<div class="clearfix"></div>
<br>
@include('layouts.partials.results-count')
<div class="ibox-content">

    @include('flash::message')
    <div class="table-responsive">
        @if (!empty($records) && count($records) > 0)
        <table class="data-table table table-bordered dataTables-example">
            <thead>
                <th class="text-center">#</th>
                <th class="text-center">{{ __(' الأسم') }}</th>
                <th class="text-center">{{ __(' الأيميل') }}</th>
                <th class="text-center">{{ __(' الهاتف') }}</th>
                <th class="text-center">{{ __(' تفعيل') }}</th>

                <th class="text-center">{{ __('تعديل') }}</th>

                <th class="text-center">{{ __('حذف') }}</th>

            </thead>
            <tbody>
                @php $count = 1; @endphp
                @foreach ($records as $record)
                <tr id="removable{{ $record->id }}">

                    <td class="text-center">
                        {{ $records->perPage() * ($records->currentPage() - 1) + $loop->iteration }}</td>
                    <td class="text-center">{{ $record->name }}
                    </td>

                    <td class="text-center">{{ $record->email }}</td>
                    <td class="text-center">{{ $record->phone }}</td>
                    <td>
                        <label class="switch">
                            <input type="checkbox" data-status="{{ $record->is_active }}" data-id="{{ $record->id }}"
                                class="switch-input update_status" {{ ($record->is_active == 1) ? "checked" : "" }} >
                            <span class="slider-switch round"></span>
                        </label>
                    </td>


                    {{-- <td class="text-center">
                        <a href="{{ route('ad.show',$record->id) }}" class="btn btn-xs btn-success"><i
                                class="fa fa-rocket"></i></a>
                    </td> --}}



                    <td class="text-center">
                        <a href="{{ route('admin.admins.edit',$record->id ) }}" class="btn btn-xs btn-success"><i
                                class="fa fa-edit"></i></a>
                    </td>
                    <td class="text-center">
                        <form method="post" action="{{route('admin.admins.destroy',$record->id)}}">
                            @method('delete')
                            @csrf
                            <button type="submit" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></button>
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
@endsection
@push('scripts')
<script>

 $('.update_status').change(function() {

    if($(this).is(":checked")) { var status = 1;}
    else{   var status = 2;  }

        var id= $(this).attr("data-id")
        //alert(id);
        $.ajax({
        url:"/dashboard/admins/update-status/" +id + "/" +status ,
        success: function(e) {
        }
        });
});
</script>
@endpush


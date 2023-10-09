@extends('layouts.app')
@section('title', __('الحجوزات'))

@section('content')

    <div>


        @include('layouts.partials.results-count')
    </div>

    <div class="clearfix"></div>

    <div class="ibox-content">
       
        <div class="table-responsive">
            @if (!empty($records) && count($records) > 0)
                <table id="" class="table align-middle table-row-bordered table-hover gy-5 gs-7">
                    <thead>
                        <th class="text-center">#</th>
                        <th class="text-center">{{ __(' الأسم') }}</th>
                        <th class="text-center">{{ __(' الهاتف') }}</th>
                        <th class="text-center">{{ __('ايميل') }}</th>
                        <th class="text-center">{{ __('الخدمة') }}</th>
                        <th class="text-center">{{ __('التاريخ') }}</th>
                        <th class="text-center">{{ __('ملاحظات') }}</th>
                        <th class="text-center">{{ __('حذف') }}</th>
                    </thead>
                    <tbody>
                        @php $count = 1; @endphp
                        @foreach ($records as $record)
                            <tr id="removable{{ $record->id }}">
                                <td class="text-center">
                                    {{ $record->id }}
                                </td>
                                <td class="text-center">
                                    {{ $record->name }}
                                </td>
                                <td class="text-center">
                                    {{ $record->phone }}
                                </td>
                                <td class="text-center">
                                    {{ $record->email }}
                                </td>
                                <td class="text-center">
                                    {{ $record->category->name }}
                                </td>
                                <td class="text-center">
                                    {{ $record->date }}
                                </td>
                                <td class="text-center">
                                    {{ $record->notes }}
                                </td>
                                <td class="text-center">
                                    <form method="post" action="{{ route('admin.contact.destroy', $record->id) }}">
                                        @method('delete')
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-xs"><i
                                                class="fa fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @php $count++; @endphp
                        @endforeach
                    </tbody>
                </table>
            @else
                <div>
                    <h3 class="text-info" style="text-align: center">{{ __(' لا توجد بيانات للعرض ') }}</h3>
                </div>
            @endif
        </div>
        <div class="text-center">
            {!! $records->appends(request()->all())->render() !!}
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        //  $('.update_status').change(function() {

        //     if($(this).is(":checked")) { var status = 1;}
        //     else{   var status = 2;  }

        //         var id= $(this).attr("data-id")
        //         //alert(id);
        //         $.ajax({
        //         url:"/dashboard/doctors/update-status/" +id + "/" +status ,
        //         success: function(e) {
        //         }
        //         });
        // });
    </script>

    <script>
        // Upgrade button class name
        // $.fn.dataTable.Buttons.defaults.dom.button.className = 'btn btn-white btn-sm';

        // $(document).ready(function() {
        //     $('.dataTables-example').DataTable({
        //         pageLength: 25,
        //         responsive: true,
        //         dom: '<"html5buttons"B>lTfgitp',
        //         buttons: [{
        //                 extend: 'copy'
        //             },
        //             {
        //                 extend: 'csv'
        //             },
        //             {
        //                 extend: 'excel',
        //                 title: 'ExampleFile'
        //             },
        //             {
        //                 extend: 'pdf',
        //                 title: 'ExampleFile'
        //             },

        //             {
        //                 extend: 'print',
        //                 customize: function(win) {
        //                     $(win.document.body).addClass('white-bg');
        //                     $(win.document.body).css('font-size', '10px');

        //                     $(win.document.body).find('table')
        //                         .addClass('compact')
        //                         .css('font-size', 'inherit');
        //                 }
        //             }
        //         ]

        //     });

        // });
    </script>
@endpush

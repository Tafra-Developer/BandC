@push('styles')
    <link href="{{asset('inspina/css/fullcalendar/ls-calendario-rtl.css')}}" rel="stylesheet">
    <link href="{{asset('inspina/css/fullcalendar/fullcalendar-rtl.css')}}" rel="stylesheet">
    <link href="{{asset('inspina/css/fullcalendar/fullcalendar.print-rtl.css')}}" rel='stylesheet' media='print'>
    <style>
        .fc-event-time {
            color: white;
        }

        .fc-event-title {
            color: white;
        }
    </style>
@endpush

@push('scripts')

    <script src="{{asset('inspina/js/fullcalendar/fullcalendar.min.js')}}"></script>
    <script src="{{asset('inspina/js/plugins/fullcalendar/moment.min.js')}}"></script>

    <script>

        $(document).ready(function () {

            /* initialize the external events
             -----------------------------------------------------------------*/


            $('#external-events div.external-event').each(function () {

                // store data so the calendar knows to render an event upon drop
                $(this).data('event', {
                    title: $.trim($(this).text()), // use the element's text as the event title
                    stick: true // maintain when user navigates (see docs on the renderEvent method)
                });

                // make the event draggable using jQuery UI
                $(this).draggable({
                    zIndex: 1111999,
                    revert: true,      // will cause the event to go back to its
                    revertDuration: 0  //  original position after the drag
                });

            });


            /* initialize the calendar
             -----------------------------------------------------------------*/
            $.ajax({
                url: '{{$get_res_url}}',
                type: 'get',
                cache: false,
                contentType: false,
                processData: false,
                success: function (data) {

                    $('#calendar').fullCalendar({
                        @if(!empty($default_view))
                        defaultView: '{{$default_view}}',
                        @endif
                        header: {
                            right: 'next,prev',
                            center: 'title',
                            left: 'month,agendaWeek,agendaDay',

                        },
                        monthNames: ['يناير', 'فبراير', 'مارس', 'إبريل', 'مايو', 'يونية',
		'يوليو', 'أغسطس', 'سبتمبر', 'أكتوبر', 'نوفمبر', 'ديسمبر'],
		dayNames:  ['الأحد', 'الاثنين', 'الثلاثاء', 'الأربعاء', 'الخميس', 'الجمعة', 'السبت'],
		dayNamesShort: ['أحد', 'اثنين', 'ثلاثاء', 'أربعاء', 'خميس', 'جمعة', 'سبت'],
		dayNamesMin: ['أحد', 'اثنين', 'ثلاثاء', 'أربعاء', 'خميس', 'جمعة', 'سبت'],
		digits: null,
		dateFormat: 'dd/mm/yyyy',
		firstDay: 6,
		isRTL: true,
                        editable: false,
                        droppable: false, // this allows things to be dropped onto the calendar

                        events: data.records
                    });
                }

            });


        });

    </script>
@endpush

<div class="ibox-content">
    <div id="calendar"></div>
</div>

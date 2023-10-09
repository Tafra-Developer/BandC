@extends('layouts.app')
@section('title', __('الطلاب'))

@section('content')
    <div class="ibox-content">
        <div class="row">
            <div class="card mt-3">
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form action="{{ route('admin.send.web-notification') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>{{ __('العنوان') }}</label>
                            <input type="text" class="form-control" name="title" required>
                        </div>
                        <div class="form-group">
                            <label>{{ __('المحتوى') }}</label>
                            <textarea class="form-control" name="body" required></textarea>
                        </div>
                        <div class="form-group" id="users_select">
                            <div class="row">
                                <div class="col-md-12">
                                    {!! \Helper\Field::select('fcm_token', __('تحديد المستخدمون') . '*', $users->pluck('full_name','fcm_token')) !!}
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>{{ __('إرسال للجميع') }}</label>
                            <input type="checkbox" name="all_users_check" id="check_all" onclick="checkAll()">
                        </div>
                        <div class="pull-left">
                            <button type="submit" class="btn btn-success btn-block">{{ __('إرسال الإشعار') }}</button>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- The core Firebase JS SDK is always required and must be listed first -->
    <script src="https://www.gstatic.com/firebasejs/8.3.2/firebase.js"></script>
    <script>
        function checkAll() {
            var checkBox = document.getElementById("check_all");
            var text = document.getElementById("fcm_token");

            // If the checkbox is checked, display the output text
            if (checkBox.checked == false) {
                text.style.display = "block";
            } else {

                // document.getElementById("shopping_cart").checked = false;
                // shoppingcart1Function();
                text.style.display = "none";
            }
        }


        var firebaseConfig = {
            apiKey: 'api-key',
            authDomain: 'project-id.firebaseapp.com',
            databaseURL: 'https://project-id.firebaseio.com',
            projectId: 'project-id',
            storageBucket: 'project-id.appspot.com',
            messagingSenderId: 'sender-id',
            appId: 'app-id',
            measurementId: 'G-measurement-id',
        };
        firebase.initializeApp(firebaseConfig);
        const messaging = firebase.messaging();

        function startFCM() {
            messaging
                .requestPermission()
                .then(function() {
                    return messaging.getToken()
                })
                .then(function(response) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: '{{ route('admin.store.token') }}',
                        type: 'POST',
                        data: {
                            token: response
                        },
                        dataType: 'JSON',
                        success: function(response) {
                            alert('Token stored.');
                        },
                        error: function(error) {
                            alert(error);
                        },
                    });
                }).catch(function(error) {
                    alert(error);
                });
        }
        messaging.onMessage(function(payload) {
            const title = payload.notification.title;
            const options = {
                body: payload.notification.body,
                icon: payload.notification.icon,
            };
            new Notification(title, options);
        });
    </script>
@endsection

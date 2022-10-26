@php
    $src = Auth::user()->profile_photo ? env('AWS_URL') . Auth::user()->profile_photo : asset('admin/images/no-user-image.png');
    $src_loader = asset('images/loader-animations.gif');
@endphp
<!DOCTYPE html>
<html lang="en-US">

<head>
    @include('includes.header')
    @stack('links')
</head>
@include('includes.header-section')
<section class="bodySec">
    <div class="dFlx">
        @include('includes.sidebar')


        @include('includes.message')
        @include('includes.err-msg')

        @yield('content')

        <!-- ===================== Admin Profile Update Modal Popup Start ===================== -->
        <div class="notification-modal-popup" id="myModalChangePassword">
            <div class="noti-popup-box">
                <button class="noti-close-btn" onclick="$('#myModalChangePassword').hide();">X</button>
                <div class="noti-pop-hdn">
                    <h2>Change Password</h2>
                </div>
                <div class="noti-pop-body">
                    <div class="create-form">
                        <form method="POST" action="{{ route('admin.profile.change_password') }}">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <label>Current Password</label>
                                        <input type="password" name="current_password" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <label>New Password</label>
                                        <input type="password" name="password" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12">
                                    <div class="form-group">
                                        <label>Password Confirmation</label>
                                        <input type="password" name="password_confirmation" class="form-control"
                                            required>
                                    </div>
                                </div>
                            </div>
                            <div class="category-submit">
                                <ul>
                                    <li>
                                        <button type="button" class="cancel-btn"
                                            onclick="$('#myModalChangePassword').hide();">
                                            Cancel
                                        </button>
                                    </li>
                                    <li>
                                        <button type="submit" class="submit-btn subbtn">Submit</button>
                                    </li>
                                    </li>
                                </ul>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
</section>

@include('includes.footer')

@stack('script')

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
    $('.multi-delete-confirm').on('click', function(event) {
        event.preventDefault();
        const url = $(this).attr('href');
        swal({
            title: 'Are you sure?',
            text: 'This record and related data will be deleted!',
            icon: 'warning',
            buttons: ["Cancel", "Yes!"],
        }).then(function(value) {
            if (value) {
                window.location.href = url;
            }
        });
    });
    $('.delete-confirm').on('click', function(event) {
        event.preventDefault();
        const url = $(this).attr('href');
        swal({
            title: 'Are you sure?',
            text: 'This record will be permanantly deleted!',
            icon: 'warning',
            buttons: ["Cancel", "Yes!"],
        }).then(function(value) {
            if (value) {
                window.location.href = url;
            }
        });
    });

    $('.status-confirm').on('click', function(event) {
        event.preventDefault();
        const url = $(this).attr('href');
        swal({
            title: 'Are you sure?',
            text: 'Do you really want to change this status!',
            icon: 'warning',
            buttons: ["Cancel", "Yes!"],
        }).then(function(value) {
            if (value) {
                window.location.href = url;
            }
        });
    });
</script>

</body>

</html>

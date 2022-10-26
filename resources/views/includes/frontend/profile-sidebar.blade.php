<div class="afterLoginProfileLeft">
    <div class="profileTitleArea">
        <div class="profilePic">
            @if (Auth::user()->image)
                <img class="profile_pic_left" src="{{ asset('storage/user_image/') . '/' . Auth::user()->image }}"
                    alt="">
            @else
                <img class="profile_pic_left" src="{{ asset('assets/images/no-user-image.png') }}" alt="">
            @endif
            {{-- <img src="{{ asset('assets/images/camera_icon.png') }}" alt=""> --}}
            <div class="cameraIcon">
                <i class="fa fa-camera" aria-hidden="true"></i>
                <input type="file" id="image" onChange="showMyImage(this)" name="profile_image" accept="image/*" />
            </div>
            <div class="loader" style="display: none;">
                <span class="loader_spin fa fa-spinner fa-spin"></span>
            </div>
        </div>

        <div class="profileTitle">
            <p>Hello,</p>
            <h2>{{ Auth::user()->getFullNameAttribute() }}</h2>
        </div>
    </div>
    <ul id="accordion" class="profileLeftAccordion">
        <li @if (Route::is('user.my.orders') || Route::is('user.online.training.orders')) class="open" @endif>
            <div class="link">My Orders<i class="fa fa-chevron-down"></i></div>
            <ul class="submenu" @if (Route::is('user.my.orders') || Route::is('user.my.orders')) style="display:block;" @endif>
                <li><a href="{{ route('user.my.orders') }}">Item Orders</a></li>
                <li><a href="{{ route('user.online.training.orders') }}">Online Training Orders</a></li>
            </ul>
        </li>
        <li @if (Route::is('user.profile.info') || Route::is('user.manage.address')) class="open" @endif>
            <div class="link">Account Settings<i class="fa fa-chevron-down"></i></div>
            <ul class="submenu" @if (Route::is('user.profile.info') || Route::is('user.manage.address')) style="display:block;" @endif>
                <li><a href="{{ route('user.profile.info') }}">Profile Information</a></li>
                <li><a href="{{ route('user.manage.address') }}">Manage Addresses</a></li>
            </ul>
        </li>
        {{-- <li>
            <div class="link">Payments<i class="fa fa-chevron-down"></i></div>
            <ul class="submenu">
                <li><a href="javascript:void(0)">Saved Cards</a></li>
            </ul>
        </li> --}}
        <li @if (Route::is('user.my.rating.review')) class="open" @endif>
            <div class="link">My Stuff<i class="fa fa-chevron-down"></i></div>
            <ul class="submenu" class="submenu" @if (Route::is('user.my.rating.review')) style="display:block;" @endif>
                <li><a href="{{ route('user.my.rating.review') }}">My Reviews & Ratings</a></li>
            </ul>
        </li>
        <li>
            <a class="link" onclick="window.location='{{ route('user.logout') }}'">Log Out</a>
        </li>
    </ul>
</div>

<script>
    const showMyImage = (fileInput) => {

        $('.loader').show();

        var ext = $('#image').val().split('.').pop().toLowerCase();
        if ($.inArray(ext, ['gif', 'png', 'jpg', 'jpeg']) == -1) {
            alert('Please select a jpg or png file!');
            $('.loader').hide();
        } else {
            var formData = new FormData();
            formData.append('_token', '{{ csrf_token() }}');
            formData.append('profile_pic', document.getElementById('image').files[0]);
            $.ajax({
                    url: '{{ route('user.update.image') }}',
                    type: 'POST',
                    dataType: 'json',
                    data: formData,
                    contentType: false,
                    processData: false
                })
                .done(function(response) {
                    if (response.result.success) {
                        $('.profile_pic_left').attr('src', response.result.profile_pic);
                        $('.headimage').attr('src', response.result.profile_pic);
                        $('.loader').hide();
                    } else {
                        Msg.error('Unable To Process Your Request', 3000);
                        alert("Something went wrong!");
                        $('.loader').hide();
                    }
                })
                .fail(function() {
                    alert("Something went wrong!");
                    $('.loader').hide();
                });
        }
    }
</script>

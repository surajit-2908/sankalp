<section class="headerSec">
    <div class="container-fluid">
        <div class="dFlx spaceBet alignCenter">
            <div class="hdrLogo"><a href="{{ route('admin.dashboard') }}"><img src="{{ asset('admin/images/logo.png') }}"
                        alt=""></a></div>
            <div class="hdrUser">
                <span class="userTitle">Hello, Sankalp</span>
                <span class="userPic"><a href="javascript:void(0);"><img src="{{ asset('admin/images/user-pic.jpg') }}"
                            alt=""></a></span>
            </div>
        </div>
        <div class="hdrProfileSetting">
            <ul>
                <li><a href="javascript:void(0);"><i class="fa fa-cog"></i> User Settings</a></li>
                <li><a href="javascript:void(0);" onclick="$('#myModalChangePassword').show();"><i
                            class="fa fa-pencil"></i> Change Password</a></li>
                <li><a href="{{ route('admin.logout') }}"><i class="fa fa-sign-out"></i> Logout</a></li>
            </ul>
        </div>
    </div>
</section>

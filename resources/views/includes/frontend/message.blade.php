<div class="msg-div">
    @if (Session::has('message'))
        @if (Session::get('message')['result'] == 'success')
            <div class="alert alert-success text-center"><span> <img
                        src="{{ asset('public/frontend/images/icon/tick.png') }}" alt=""></span>
                {{ Session::get('message')['msg'] }}</div>
        @else
            <div class="alert alert-danger text-center"><span> <img
                        src="{{ asset('public/frontend/images/icon/cross.png') }}" alt=""></span>
                {{ Session::get('message')['msg'] }}</div>
        @endif
    @endif
</div>

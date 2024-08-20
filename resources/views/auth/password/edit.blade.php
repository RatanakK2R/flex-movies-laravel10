@extends('layouts.layouts')

@section('content')

	<!-- Favicons -->
	<link rel="icon" type="image/png" href="assets/icon/favicon-32x32.png" sizes="32x32">
	<link rel="apple-touch-icon" href="assets/icon/favicon-32x32.png">

	<meta name="description" content="">
	<meta name="keywords" content="">
	<meta name="author" content="Dmitry Volkov">
	<title>K2RTV – Forget</title>

</head>
<!-- sign in -->
<div class="sign section--full-bg" data-bg={{asset('assets/img/bg.jpg')}}>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="sign__content">
                    <!-- authorization form -->
                    <form action="{{ route('password.update')}}" class="sign__form" method="POST">
                        @csrf
                        <a href="{{ route('login') }}" class="sign__logo">
                            <img src={{asset('assets/img/logo.svg')}} alt="">
                        </a>

                        <div class="sign__group">
                            <input type="text" class="sign__input" name="email" value="{{ request()->email }}">
                        </div>

                        <div class="sign__group">
                            <input type="password" class="sign__input" placeholder="New Password" name="password">
                        </div>

                        @error('password')
                        <span class="text-danger" style="color: red;"> {{ $message }} </span>
                        @enderror

                        <div class="sign__group">
                            <input type="password" class="sign__input" placeholder="Confirm Pasword" name="password_confirmation">
                            <input type="hidden" name="token" value="{{ request()->route('token') }}">
                        </div>

                        {{-- <div class="sign__group sign__group--checkbox">
                            <input id="remember" name="remember" type="checkbox" checked="checked" value="true">
                            <label for="remember">Remember Me</label>
                        </div> --}}
                        
                        <button class="sign__btn" type="submit">Reset Password</button>

                        <span class="sign__text" style="color: green;" >{{ Session('status') }}</span> 
                    </form>
                    <!-- end authorization form -->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end sign in -->
@endsection
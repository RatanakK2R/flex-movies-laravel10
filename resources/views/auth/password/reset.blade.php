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
<div class="sign section--full-bg" data-bg="assets/img/bg.jpg">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="sign__content">
                    <!-- authorization form -->
                    <form action="{{ route('password.email')}}" class="sign__form" method="POST">
                        @csrf
                        <a href="{{ route('login') }}" class="sign__logo">
                            <img src="assets/img/logo.svg" alt="">
                        </a>

                        <div class="sign__group">
                            <input type="text" class="sign__input" placeholder="Email" name="email">
                        </div>
                        @error('email')
							<span class="text-danger" style="color: red;"> {{ $message }} </span>
						@enderror

                        <div class="sign__group sign__group--checkbox">
                            <input id="remember" name="remember" type="checkbox" checked="checked">
                            <label for="remember">I agree to the <a href="{{ route('privacy') }}">Privacy Policy</a></label>
                        </div>
                        
                        <button class="sign__btn" type="submit">Send</button>

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
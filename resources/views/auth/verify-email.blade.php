@extends('layouts.layouts')

@section('content')

	<!-- Favicons -->
	<link rel="icon" type="image/png" href="assets/icon/favicon-32x32.png" sizes="32x32">
	<link rel="apple-touch-icon" href="assets/icon/favicon-32x32.png">

	<meta name="description" content="">
	<meta name="keywords" content="">
	<meta name="author" content="Dmitry Volkov">
	<title>K2RTV – Verify</title>

</head>
<!-- sign in -->
<div class="sign section--full-bg" data-bg="assets/img/bg.jpg">
    <div class="container">
        <h1 class="sign__text">
            Welcome
            <span class="sign__text"> {{ auth()->user()->name }} </span>
        </h1>
        <div class="row">
            <div class="col-12">
                <div class="sign__content">
                    <!-- authorization form -->
                    <form action="{{ route('verification.send')}}" class="sign__form" method="POST">
                        @csrf
                        <a href="{{ route('login') }}" class="sign__logo">
                            <img src="{{asset('assets/img/logo.svg')}}" alt="">
                        </a>

                        <div class="sign__group ">
                            <label for="remember">
                                <a href="{{ route('privacy') }}">
                                    Privacy Policy
                                </a>
                            </label>
                            <p style="color: white;">
                                <strong>Thanks for Sign Up!</strong> Befor getting started please verify your email address 
                                by clicking on the link we just email to you.
                            </p>
                        </div>
                        
                        <button class="sign__btn" type="submit">Resand Email Verification</button>

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
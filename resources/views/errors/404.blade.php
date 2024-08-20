<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicons -->
	<link rel="icon" type="image/png" href="{{asset('assets/icon/favicon-32x32.png')}}" sizes="32x32">
	<link rel="apple-touch-icon" href="{{asset('assets/icon/favicon-32x32.png')}}">
    <title>404</title>
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous"> -->
    <!--  <link rel="stylesheet" id="picostrap-styles-css" href="https://cdn.livecanvas.com/media/css/library/bundle.css" media="all"> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/livecanvas-team/ninjabootstrap/dist/css/bootstrap.min.css" media="all">

</head>

<body>


    <section class="d-flex align-items-center min-vh-100 py-5">
        <div class="container py-5">
            <div class="row align-items-center">
                <div class="col-md-6 order-md-2">
                    <div class="lc-block">
                        <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
                        <lottie-player src="https://assets9.lottiefiles.com/packages/lf20_kcsr6fcp.json" background="transparent" speed="1" loop="" autoplay=""></lottie-player>
                    </div><!-- /lc-block -->
                </div><!-- /col -->
                <div class="col-md-6 text-center text-md-start ">
                    <div class="lc-block mb-3">
                        <div editable="rich">
                            <h1 class="fw-bold h4">PAGE NOT FOUND!<br></h1>
                        </div>
                    </div>
                    <div class="lc-block mb-3">
                        <div editable="rich">
                            <h1 class="display-1 fw-bold text-muted">Error 404</h1>

                        </div>
                    </div><!-- /lc-block -->
                    <div class="lc-block mb-5">
                        <div editable="rich">
                            <p class="rfs-11 fw-light"> The page you are looking for was moved, removed or might never existed.</p>
                        </div>
                    </div><!-- /lc-block -->
                    <div class="lc-block">
                        <a class="btn btn-lg btn-primary" href="{{route('home')}}" role="button">Back to homepage</a>
                    </div><!-- /lc-block -->
                </div><!-- /col -->
            </div>
        </div>
    </section>
    </p>


    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</body>

</html>
<base href="/public">
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>HEALTHCARE | Login</title>

    <link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css">
    <link href="assets/vendor/fonts/circular-std/style.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/libs/css/style.css">
    <link rel="stylesheet" href="assets/vendor/fonts/fontawesome/css/fontawesome-all.css">
    <link href="
https://cdn.jsdelivr.net/npm/sweetalert2@11.10.5/dist/sweetalert2.min.css
" rel="stylesheet">
<link rel="shortcut icon" href="{{asset('assets/images/datamanagmentlogo.jpg')}}" type="image/x-icon">
    <style>
        html,
        body {
            height: 100%;
        }

        body {
            display: -ms-flexbox;
            display: flex;
            -ms-flex-align: center;
            align-items: center;
            padding-top: 40px;
            padding-bottom: 40px;
        }
    </style>
    <meta name="robots" content="noindex, nofollow">

</head>
<script type="text/javascript">
    window.history.forward();
    function noBack() {
        window.history.forward();
    }
</script>
<body onload="noBack();" onpageshow="if (event.persisted) noBack();" onunload="">


    <div class="splash-container">
        <div class="card ">
            <div class="card-header text-center"><a><img
                        class="logo-img" src="assets/images/logo.png" height="65" width="250"
                        alt="logo"></a><span class="splash-description">Please enter your information.</span></div>
            <div class="card-body">
                <form method="post" action="{{url('LoginUser')}}">
                    @csrf
                    <div class="form-group">
                        <input value="{{old('mail')}}" class="form-control form-control-lg" id="E-Mail" type="text" name="mail" value="{{old('mail')}}" placeholder="E - mail"
                            autocomplete="off" >
                            <span><small class="text-danger font-weight-light font-italic">@error('mail'){{ $message }} @enderror</small></span>
                    </div>
                    <div class="form-group">
                        <input class="form-control form-control-lg" id="password" type="password" name="password"
                            placeholder="Password">
                            <span><small class="text-danger font-weight-light font-italic">@error('password'){{ $message }} @enderror</small></span>
                    </div>
                    <button type="submit" class="btn btn-primary btn-lg btn-block">Sign in</button>
                </form>
            </div>
            <div class="card-footer bg-white p-0">
                <div class="card-footer-item card-footer-item-bordered">
                    <a href="{{url('forgetPassword')}}" class="footer-link">Forgot Password</a>
                </div>
            </div>
        </div>
    </div>




    <script src="https://colorlib.com//polygon/concept/assets/vendor/jquery/jquery-3.3.1.min.js"></script>
    <script src="https://colorlib.com//polygon/concept/assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
    <script src="
https://cdn.jsdelivr.net/npm/sweetalert2@11.10.5/dist/sweetalert2.all.min.js
"></script>
</body>


</html>
@if (Session::has('success'))
    <script>
  Swal.fire({
  title: "Success",
  text: "Saved Successfully",
  icon: "success"
});
</script>
              @endif
              @if (Session::has('fail'))
    <script>
  Swal.fire({
  title: "Error",
  text: "Invalid Credentials",
  icon: "error"
});

</script>
              @endif
                   @if (Session::has('Ban'))
    <script>
  Swal.fire({
  title: "Error",
  text: "Your Account is suspended!!!!",
  icon: "error"
});

</script>
              @endif

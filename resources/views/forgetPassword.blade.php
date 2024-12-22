<base href="/public">
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>HEALTHCARE | Forget Password</title>

    <link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css">
    <link href="assets/vendor/fonts/circular-std/style.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/libs/css/style.css">
    <link rel="stylesheet" href="assets/vendor/fonts/fontawesome/css/fontawesome-all.css">
    <link href="
https://cdn.jsdelivr.net/npm/sweetalert2@11.10.5/dist/sweetalert2.min.css
" rel="stylesheet">
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

<body>

    <div class="splash-container">
        <div class="card ">
            <div class="card-header text-center"><a><img
            class="logo-img" src="assets/images/logo.png" height="65" width="250"
                        alt="logo"></a><span class="splash-description">Please enter the E-mail.<br>You will Receive updated password on your mail</span></div>
            <div class="card-body">
                <form method="post" action="{{url('UpdatePassword')}}">
                    @csrf
                    <div class="form-group">
                        <input  class="form-control form-control-lg" id="E-Mail" type="mail" name="mail" required placeholder="E-mail"
                            autocomplete="off" >
                            <span><small class="text-danger font-weight-light font-italic">@error('mail'){{ $message }} @enderror</small></span>
                    </div>
                    <button type="submit" class="btn btn-primary btn-lg btn-block">Forget Password</button>
                </form>
            </div>
            <div class="card-footer bg-white p-0">
                <div class="card-footer-item card-footer-item-bordered">
                    <a href="{{url('Login')}}" class="footer-link">Already Have An Account? Sign In</a>
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
  text: "OTP Send Successfully",
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
              <script>
        $(document).ready(function() {
            logAction("Forget Password Page Loaded");
        });
    </script>

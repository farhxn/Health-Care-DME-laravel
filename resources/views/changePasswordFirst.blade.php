<base href="/public">
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>HEALTHCARE | Verify OTP</title>

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

                        alt="logo"></a><span class="splash-description">Please enter new Password.<br>Your previous password expires now you will log in with new password</span></div>
            <div class="card-body">
                <form method="post" action="{{url('UpdateChangePassword')}}">
                    @csrf
                    <div class="form-group">
                        <input  class="form-control form-control-lg" id="E-Mail" type="password" name="password" required min="8" placeholder="Enter New Password">
                             <div id="passwordHelp" class="text-danger"></div>
                            <span><small class="text-danger font-weight-light font-italic">@error('password'){{ $message }} @enderror</small></span>
                    </div>
                    <button type="submit" class="btn btn-primary btn-lg btn-block">Save</button>
                </form>
            </div>
        </div>
    </div>





</body>


</html>
    <script src="https://colorlib.com//polygon/concept/assets/vendor/jquery/jquery-3.3.1.min.js"></script>
    <script src="https://colorlib.com//polygon/concept/assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
    <script src="
https://cdn.jsdelivr.net/npm/sweetalert2@11.10.5/dist/sweetalert2.all.min.js
"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
@if (Session::has('success'))
    <script>
  Swal.fire({
  title: "Success",
  text: "Your Password Changed Successfully",
  icon: "success"
});
</script>
              @endif


<script>
$(document).ready(function() {
     $('input[name="password"]').on('keyup', function() {
        var password = $(this).val();
        var message = [];
        
        if (!/[A-Z]/.test(password)) {
            message.push("Must contain at least one uppercase letter.");
        }
        if (!/[0-9]/.test(password)) {
            message.push("Must contain at least one number.");
        }
        if (!/[@$!%*#?&]/.test(password)) {
            message.push("Must contain at least one special character.");
        }
        if (password.length < 8) {
            message.push("Must be at least 8 characters long.");
        }
        
        $('#passwordHelp').html(message.join('<br>'));
    });
});
</script>
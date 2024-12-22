@section('title', 'Change Password')
@include('layout.Head')
<div class="dashboard-wrapper">
    <div class="dashboard-ecommerce">
        <div class="container-fluid dashboard-content">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <br><br>
                </div>
            </div>

            <div class="ecommerce-widget">
                <div class="row offset-2">
                    <div class="col-8">
                        <div class="card">
                            <h5></h5>
                            <div class="card ">
                                <div class="card-header text-center"><a href='/'><img class="logo-img" src="assets/images/logo.png" height="65" width="250" alt="logo"></a><span class="splash-description">Enter New Password.</span></div>
                                <div class="card-body">
                                    <form method="post" action="{{url('UpdateChangePassword')}}">
                                        @csrf
                                      
                                       
                                       
                                       
                                        <div class="form-group">
                                            <input class="form-control form-control-lg" id="E-Mail" type="mail" name="password" required placeholder="New Password" autocomplete="off">
                                      <div id="passwordHelp" class="text-danger"></div>
                                            <span><small class="text-danger font-weight-light font-italic">@error('password'){{ $message }} @enderror</small></span>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-lg btn-block">Change Password</button>
                                    </form>
                                </div>
                                <div class="card-footer bg-white p-0">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    @include('layout.footer')
    <script>
        $(document).ready(function() {
            logAction("Change Password Page Loaded");
        });
    </script>

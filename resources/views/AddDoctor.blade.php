@section('title', 'Add Doctor')
@include('layout.Head')

<div class="dashboard-wrapper">
    <div class="dashboard-ecommerce">
        <div class="container-fluid dashboard-content">
            <div class="row">

                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="page-header">
                        <h2 class="pageheader-title ml-auto">Add Doctor</h2>
                        <div class="page-breadcrumb">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <!-- <li class="breadcrumb-item">
                        <a href="#" class="breadcrumb-link">Dashboard</a>
                      </li>
                      <li class="breadcrumb-item active" aria-current="page">
                        Home
                      </li> -->
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>

            <div class="ecommerce-widget">

                <div class="row">


                    <div class="col">
                        <form method="post" action="{{ url('RegisterDoctor') }}">
                            @csrf
                            <div class="card">
                                <h5 class="card-header">Add Doctor Details</h5>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label class="col-form-label">Dr. Office Name</label>
                                        <div class="input-group mb-3"><span class="input-group-prepend"><span
                                                    class="input-group-text"><i class="fa-solid fa-building"></i></span></span>
                                            <input type="text" required placeholder="User Name" name="name"
                                                class="form-control" value="{{ old('name') }}">
                                        </div>
                                        <span><small class="text-danger font-weight-light font-italic">
                                                @error('name')
                                                    {{ $message }}
                                                @enderror
                                            </small></span>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-form-label">Dr. Office Phone No</label>
                                        <div class="input-group mb-3"><span class="input-group-prepend"><span
                                                    class="input-group-text"><i class="fa-solid fa-square-phone"></i></span></span>
                                            <input type="number" min="1" required placeholder="Dr. Office Phone No" name="number"
                                                class="form-control" value="{{ old('number') }}">
                                        </div>
                                        <span><small class="text-danger font-weight-light font-italic">
                                                @error('number')
                                                    {{ $message }}
                                                @enderror
                                            </small></span>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-form-label">Dr. Office Fax No</label>
                                        <div class="input-group mb-3"><span class="input-group-prepend"><span
                                                    class="input-group-text"><i class="fa-solid fa-fax"></i></span></span>
                                            <input type="text" required placeholder="Dr. Office Fax No"
                                                name="fax" class="form-control" value="{{ old('fax') }}">
                                        </div>
                                        <span><small class="text-danger font-weight-light font-italic">
                                                @error('fax')
                                                    {{ $message }}
                                                @enderror
                                            </small></span>
                                    </div>

                                </div>

                                <div class="card-body border-top">
                                    <div class="form-group">
                                        <div class="input-group mb-3">
                                            <div class="input-group">
                                                <button type="submit" class="btn btn-block"
                                                    style="background-color: #427ed1; color: white;">Submit</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('layout.footer')

    <script>
        $(document).ready(function() {
            logAction("Add Doctor Page Loaded");
        });
    </script>

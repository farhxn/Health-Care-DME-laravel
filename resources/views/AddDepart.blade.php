@section('title', 'Add Department')
@include('layout.Head')


<div class="dashboard-wrapper">
    <div class="dashboard-ecommerce">
        <div class="container-fluid dashboard-content">
            <div class="row">

                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="page-header">
                        <h2 class="pageheader-title ml-auto">Add Department</h2>
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
                        <form method="post" action="{{ url('RegisterDepartment') }}">
                            @csrf
                            <div class="card">
                                <h5 class="card-header">Add Department Details</h5>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label class="col-form-label">Department</label>
                                        <div class="input-group mb-3"><span class="input-group-prepend"><span class="input-group-text"><i class="fa-solid fa-square-poll-vertical"></i></span></span>
                                            <input type="text" required placeholder="Department" name="Department" class="form-control" value="{{ old('Department') }}">
                                        </div>
                                        <span><small class="text-danger font-weight-light font-italic">
                                                @error('Department')
                                                {{ $message }}
                                                @enderror
                                            </small></span>
                                    </div>

                                </div>

                                <div class="card-body border-top">
                                    <div class="form-group">
                                        <div class="input-group mb-3">
                                            <div class="input-group">
                                                <button type="submit" class="btn btn-block" style="background-color: #427ed1; color: white;">Submit</button>
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
            logAction("Add Department Page Loaded");
        });
    </script>

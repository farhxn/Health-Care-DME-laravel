@section('title', 'backup&restore')
@include('layout.Head')

<div class="dashboard-wrapper">
    <div class="dashboard-ecommerce">
        <div class="container-fluid dashboard-content">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="page-header">
                        <h2 class="pageheader-title ml-auto">Backup & Restore </h2>
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
                        <h2>Backup</h2>
                        <br>
                        <a href="{{url('download-backup')}}" class="btn btn-primary btn-block">Create & Download Backup of database</a>

                    </div>
                    <!-- Restore Column -->

                </div>
            </div>
        </div>

    </div>
</div>
</div>

@include('layout.footer')
<script>
        $(document).ready(function() {
            logAction("Backup & Restored Page Loaded");
        });
    </script>

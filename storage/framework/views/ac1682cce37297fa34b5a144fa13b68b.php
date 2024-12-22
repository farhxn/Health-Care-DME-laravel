<?php $__env->startSection('title', 'backup&restore'); ?>
<?php echo $__env->make('layout.Head', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

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
                        <a href="<?php echo e(url('download-backup')); ?>" class="btn btn-primary btn-block">Create & Download Backup of database</a>

                    </div>
                    <!-- Restore Column -->

                </div>
            </div>
        </div>

    </div>
</div>
</div>

<?php echo $__env->make('layout.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<script>
        $(document).ready(function() {
            logAction("Backup & Restored Page Loaded");
        });
    </script>
<?php /**PATH D:\purana xammp\htdocs\ecommerce-laravel\data-mangment2\resources\views/backup&restore.blade.php ENDPATH**/ ?>
<?php $__env->startSection('title', 'Patient Detail'); ?>
<?php echo $__env->make('layout.Head', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php
use Carbon\Carbon;

$userR = Session::get('LoginRole');
$offName = \App\Models\Doctors::find($tp->Off_Name);
$primaryInsurance = $PatInsurance->last();
$secondaryInsurance = $PatInsurance->slice(-2, 1)->first();

$primaryInsurance = $primaryInsurance ? $primaryInsurance->Company : 'N/A';
$secondaryInsurance = $secondaryInsurance ? $secondaryInsurance->Company : 'N/A';
?>
<style>
    .small-text .custom-control-label {
        font-size: 0.6rem;
    }

    .small-text .custom-control {
        margin-bottom: 0.225rem;
    }
</style>
<div class="dashboard-wrapper">
    <div class="dashboard-ecommerce">
        <div class="container-fluid dashboard-content">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="page-header d-flex align-items-center justify-content-between">
                        <h2 class="pageheader-title">Patient Detail</h2>
                        <div class="ml-auto text-right">
                            <span class="txt-sm d-block">PATIENT ORDER DATE : <?php echo e($tp->created_at->format('m/d/Y h:i:s A')); ?></span>
                            <span class="d-block">Created&nbsp;By : <?php echo e($tp->listed); ?></span>
                        </div>
                    </div>
                </div>
            </div>


            <div class="ecommerce-widget">

                <div class="row">
                    <div class="offset col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="row">

                            <div class="col pl-lg-0 pl-md-0 border-left m-b-30">
                                <div class="product-details">
                                    <div class="border-bottom pb-3 mb-3 d-flex justify-content-between align-items-center">
                                        <div>
                                            <h2 class="mb-3"><?php echo e($tp->name); ?> <?php echo e($tp->last_Name); ?> Details</h2>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <a href="<?php echo e(url('EditPatient',$tp->id)); ?>" class="btn btn-primary">Edit Patient</a>
                                            &nbsp;<a href="/AddOrders/<?php echo e($tp->id); ?>/0" class="btn btn-primary">Add&nbsp;Order</a>
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col">
                                            <div class="row">
                                                <div class="col">
                                                    <h4 class="mb-0 txt-sm" style="font-size: 14px; white-space: nowrap;">PATIENT&nbsp;FIRST&nbsp;NAME</h4>
                                                    <p class="mb-0" style="font-size: 14px; white-space: nowrap;"><?php echo e($tp->name); ?></p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <h4 class="mb-0 txt-sm" style="font-size: 14px; white-space: nowrap;">PATIENT&nbsp;MIDDLE&nbsp;NAME</h4>
                                                    <p class="mb-0" style="font-size: 14px; white-space: nowrap;"><?php echo e($tp->middleName?? 'N/A'); ?></p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <h4 class="mb-0 txt-sm" style="font-size: 14px; white-space: nowrap;">PATIENT&nbsp;LAST&nbsp;NAME</h4>
                                                    <p class="mb-0" style="font-size: 14px; white-space: nowrap;"><?php echo e($tp->last_Name); ?></p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col  ">
                                                    <h4 class="mb-0 txt-sm" style="font-size: 14px; white-space: nowrap;">PATIENT&nbsp;DOB</h4>
                                                    <p class="mb-0" style="font-size: 14px; white-space: nowrap;"> <?php echo e(\Carbon\Carbon::parse($tp->Dob)->format('m-d-Y')); ?></p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col  ">
                                                    <h4 class="mb-0 txt-sm" style="font-size: 14px; white-space: nowrap;">PATIENT&nbsp;ADDRESS</h4>
                                                    <p class="mb-0" style="font-size: 14px; white-space: nowrap;"> <?php echo e($tp->Location); ?></p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col  align-items-center">
                                                    <h4 class="mb-0 txt-sm" style="font-size: 14px; white-space: nowrap;">PATIENT&nbsp;EMAIL</h4>
                                                    <p class="mb-0" style="font-size: 14px; white-space: nowrap;"> <?php echo e($tp->p_mail ?? 'N/A'); ?></p>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col  ">
                                                    <h4 class="mb-0 txt-sm" style="font-size: 14px; white-space: nowrap;">PATIENT&nbsp;GENDER</h4>
                                                    <p class="mb-0" style="font-size: 14px; white-space: nowrap;"> <?php echo e($tp->gender ?? 'N/A'); ?></p>
                                                </div>
                                            </div>


                                        </div>
                                        <div class="col">

                                            <div class="row">
                                                <div class="col  ">
                                                    <h4 class="mb-0" style="font-size: 14px; white-space: nowrap;">DR.&nbsp;Office</h4>
                                                    <p class="mb-0 ml-2" style="font-size: 14px; white-space: nowrap;"><?php echo e($offName->Office_Name ?? 'N/A'); ?></p>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col  ">
                                                    <h4 class="mb-0" style="font-size: 14px; white-space: nowrap;">PATIENT&nbsp;HEIGHT</h4>
                                                    <p class="mb-0 ml-2" style="font-size: 14px; white-space: nowrap;"><?php echo e($tp->height ?? 'N/A'); ?><?php echo e($tp->height ? ' ( Inches )' : ''); ?></p>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col  ">
                                                    <h4 class="mb-0" style="font-size: 14px; white-space: nowrap;">PATIENT&nbsp;WEIGHT</h4>
                                                    <p class="mb-0 ml-2" style="font-size: 14px; white-space: nowrap;"><?php echo e($tp->weight ?? 'N/A'); ?><?php echo e($tp->weight ? ' ( LB )' : ''); ?></p>

                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col  ">
                                                    <h4 class="mb-0" style="font-size: 14px; white-space: nowrap;">PATIENT&nbsp;PRIMARY&nbsp;INS</h4>
                                                    <p class="mb-0 ml-2" style="font-size: 14px; white-space: nowrap;"><?php echo e($primaryInsurance??'N/A'); ?></p>

                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col  ">
                                                    <h4 class="mb-0" style="font-size: 14px; white-space: nowrap;">PATIENT&nbsp;SECONDARY&nbsp;INS</h4>
                                                    <p class="mb-0 ml-2" style="font-size: 14px; white-space: nowrap;"><?php echo e($secondaryInsurance??'N/A'); ?></p>

                                                </div>
                                            </div>


                                            <div class="row">
                                                <div class="col  ">
                                                    <h4 class="mb-0" style="font-size: 14px; white-space: nowrap;">ACCOUNT&nbsp;#</h4>
                                                    <p class="mb-0" style="font-size: 14px; white-space: nowrap;"> <?php echo e($tp->AccNumber); ?></p>
                                                </div>
                                            </div>


                                        </div>
                                        <div class="col">
                                            <div style="border: 1px solid black; padding: 10px; box-sizing: border-box;">
                                                <form action="<?php echo e(url('updatePatientAmount',$tp->id)); ?>" method="post">
                                                    <?php echo csrf_field(); ?>
                                                    <div class="form-group">
                                                        <label class="col-form-label form-control-sm">Total Balance</label>
                                                        <div class="input-group mb-3">
                                                            <input type="text" required placeholder="Balance" name="Balance" class="form-control form-control-sm" value="<?php echo e(old('Balance',$tp->TotalBalance)); ?>" style="box-sizing: border-box;">
                                                        </div>
                                                        <span>
                                                            <small class="text-danger font-weight-light font-italic">
                                                                <?php $__errorArgs = ['Balance'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                                <?php echo e($message); ?>

                                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                            </small>
                                                        </span>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-form-label form-control-sm">Patient&nbsp;Balance</label>
                                                        <div class="input-group mb-3">
                                                            <input type="text" required placeholder="Customer" name="Customer" class="form-control form-control-sm" value="<?php echo e(old('Customer',$tp->PatientBalance)); ?>" style="box-sizing: border-box;">
                                                        </div>
                                                        <span>
                                                            <small class="text-danger font-weight-light font-italic">
                                                                <?php $__errorArgs = ['Customer'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                                <?php echo e($message); ?>

                                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                            </small>
                                                        </span>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-form-label form-control-sm">Ins.&nbsp;Balance</label>
                                                        <div class="input-group mb-3">
                                                            <input type="text" required placeholder="Ins. Balance" name="InsBalance" class="form-control form-control-sm" value="<?php echo e(old('InsBalance',$tp->InsBalance)); ?>" style="box-sizing: border-box;">
                                                        </div>
                                                        <span>
                                                            <small class="text-danger font-weight-light font-italic">
                                                                <?php $__errorArgs = ['InsBalance'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                                <?php echo e($message); ?>

                                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                            </small>
                                                        </span>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-form-label form-control-sm">Total</label>
                                                        <div class="input-group mb-3">
                                                            <input type="text" required placeholder="Total" name="Total" class="form-control form-control-sm" value="<?php echo e(old('Total',$tp->Total)); ?>" style="box-sizing: border-box;">
                                                        </div>
                                                        <span>
                                                            <small class="text-danger font-weight-light font-italic">
                                                                <?php $__errorArgs = ['Total'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                                <?php echo e($message); ?>

                                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                            </small>
                                                        </span>
                                                    </div>

                                                    <button type="submit" class=" ml-1 btn btn-primary btn-sm">Save</button>
                                                </form>
                                            </div>


                                        </div>
                                    </div>

                                    <div class="product-size border-bottom">

                                    </div>
                                    <div class="product-description">
                                        <div class="row">
                                            <div class="col">
                                                <div class="row">
                                                    <!-- <div class="col">
                                                        <button data-toggle="modal" data-target="#AddNote" class="btn btn-primary btn-block p-2">Add&nbsp;Notes</button>
                                                    </div>
                                                    <div class="col">
                                                        <button data-toggle="modal" data-target="#AddDocument" class="btn btn-primary btn-block p-2">Upload&nbsp;Documents</button>
                                                    </div> -->
                                                    <?php
                                                    $cancelPer = Session::get('LoginCancel');
                                                    ?>
                                                    <?php if($userR != "2" && $cancelPer != "on" && $tp->request != 1): ?>
                                                    <div class="col">
                                                        <a href="<?php echo e(url('CancelRequest',$tp->id)); ?>" class="btn btn-primary btn-block p-2">Request&nbsp;To&nbsp;Cancel</a>
                                                    </div>
                                                    <?php endif; ?>

                                                    <?php if($userR != "2" && $closePer != "on" && $tp->request != 3): ?>
                                                    <div class="col">
                                                        <a href="<?php echo e(url('CloseRequest',$tp->id)); ?>" class="btn btn-primary btn-block p-2">Request&nbsp;To&nbsp;Close</a>
                                                    </div>
                                                    <?php endif; ?>

                                                    <!-- Hold Scenario -->
                                                    <?php if($userR != "2" && $holdPer != "on" && $tp->request != 2): ?>
                                                    <div class="col">
                                                        <a href="<?php echo e(url('HoldRequest',$tp->id)); ?>" class="btn btn-primary btn-block p-2">Request&nbsp;To&nbsp;Hold</a>
                                                    </div>
                                                    <?php endif; ?>
                                                    <?php if($userR != "2" && $holdPer != "on" && ($tp->request == 2 || $tp->request == 1 || $tp->request == 3)): ?>
                                                    <div class="col">
                                                        <button class="btn btn-primary btn-block p-2 disabled">Requested&nbsp;To
                                                            <?php
                                                            if ($tp->request == 2) {
                                                                echo "Hold";
                                                            } elseif ($tp->request == 3) {
                                                                echo "Close";
                                                            } else {
                                                                echo "Cancel";
                                                            }
                                                            ?>
                                                        </button>

                                                    </div>
                                                    <?php endif; ?>

                                                    <?php if(($userR == "2" || $holdPer == "on") && ($tp->request == 2 || $tp->request == 1 || $tp->request == 3)): ?>
                                                    <div class="col">
                                                        <a href="<?php echo e(url('ApproveRequest',$tp->id)); ?>" class="btn btn-primary btn-block p-2">Approve&nbsp;To&nbsp;
                                                            <?php
                                                            if ($tp->request == 2) {
                                                                echo "Hold";
                                                            } elseif ($tp->request == 3) {
                                                                echo "Close";
                                                            } else {
                                                                echo "Cancel";
                                                            }
                                                            ?>
                                                        </a>
                                                    </div>
                                                    <div class="col">
                                                        <a href="<?php echo e(url('RejectRequest',$tp->id)); ?>" class="btn btn-primary btn-block p-2">Reject&nbsp;To&nbsp;
                                                            <?php
                                                            if ($tp->request == 2) {
                                                                echo "Hold";
                                                            } elseif ($tp->request == 3) {
                                                                echo "Close";
                                                            } else {
                                                                echo "Cancel";
                                                            }
                                                            ?></a>
                                                    </div>
                                                    <?php endif; ?>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>




                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 m-b-60 mt-3">
                                <div class="simple-card p-0">
                                    <div class="container-fluid p-0">
                                        <div style="overflow-x: auto; white-space: nowrap;">
                                            <ul class="nav nav-tabs" id="myTab5" role="tablist">
                                                <li class="nav-item d-inline-block">
                                                    <a class="nav-link" style="margin: 0; padding: 15px 15px; border: none;" id="product-tab-1" data-toggle="tab" href="#tab-1" role="tab" aria-controls="product-tab-1" aria-selected="false">History</a>
                                                </li>
                                                <li class="nav-item d-inline-block" style="margin: 0; padding: 0;">
                                                    <a class="nav-link border-left-0" style="margin: 0; padding: 15px 15px; border: none;" id="product-tab-2" data-toggle="tab" href="#tab-2" role="tab" aria-controls="product-tab-2" aria-selected="true">Notes</a>
                                                </li>
                                                <li class="nav-item d-inline-block" style="margin: 0; padding: 0;">
                                                    <a class="nav-link border-left-0" style="margin: 0; padding: 15px 15px; border: none;" id="product-tab-3" data-toggle="tab" href="#tab-4" role="tab" aria-controls="product-tab-4" aria-selected="false">Documents</a>
                                                </li>
                                                <li class="nav-item d-inline-block" style="margin: 0; padding: 0;">
                                                    <a class="nav-link border-left-0 active" style="margin: 0; padding: 15px 15px; border: none;" id="product-tab-10" data-toggle="tab" href="#tab-10" role="tab" aria-controls="product-tab-10" aria-selected="false">Orders</a>
                                                </li>
                                                <li class="nav-item d-inline-block" style="margin: 0; padding: 0;">
                                                    <a class="nav-link border-left-0" style="margin: 0; padding: 15px 15px; border: none;" id="product-tab-5" data-toggle="tab" href="#tab-5" role="tab" aria-controls="product-tab-5" aria-selected="false">Diagnoses</a>
                                                </li>
                                                <li class="nav-item d-inline-block" style="margin: 0; padding: 0;">
                                                    <a class="nav-link border-left-0" style="margin: 0; padding: 15px 15px; border: none;" id="product-tab-6" data-toggle="tab" href="#tab-6" role="tab" aria-controls="product-tab-6" aria-selected="false">Maintain Insurance</a>
                                                </li>
                                                <li class="nav-item d-inline-block" style="margin: 0; padding: 0;">
                                                    <a class="nav-link border-left-0" style="margin: 0; padding: 15px 15px; border: none;" id="product-tab-8" data-toggle="tab" href="#tab-8" role="tab" aria-controls="product-tab-8" aria-selected="false">CoPayments</a>
                                                </li>
                                                <?php if($tp->checks != null): ?>
                                                <li class="nav-item d-inline-block" style="margin: 0; padding: 0;">
                                                    <a class="nav-link" style="margin: 0; padding: 15px 15px; border: none;" id="product-tab-9" data-toggle="tab" href="#tab-3" role="tab" aria-controls="product-tab-9" aria-selected="false">CheckList</a>
                                                </li>
                                                <?php endif; ?>
                                            </ul>
                                        </div>
                                    </div>




                                    <div class="tab-content" id="myTabContent5">
                                        <div class="tab-pane fade" id="tab-1" role="tabpanel" aria-labelledby="product-tab-1">
                                            <ul class="list-unstyled arrow">
                                                <?php $__currentLoopData = $act; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ac): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <li>
                                                    <?php echo e($ac->message); ?>

                                                    <br> <span><small class="text-dark font-weight-normal font-italic">
                                                            by <?php echo e($ac->name); ?> at <?php echo e($ac->created_at->format('m/d/Y h:i:s A')); ?> ON ORDER# <?php echo e($ac?->OrderID); ?>

                                                </li>
                                                </small></span>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                            </ul>
                                        </div>

                                        <div class="tab-pane fade " id="tab-2" role="tabpanel" aria-labelledby="product-tab-2">
                                            <div class="review-block">
                                                <ul class="list-unstyled arrow">
                                                    <?php $__currentLoopData = $not; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $no): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <li>
                                                    <?php echo nl2br(e($no->note)); ?>

                                                         <br> <span><small class="text-dark font-weight-normal font-italic">
                                                                by <?php echo e($no->name); ?> at <?php echo e($no->created_at->format('m/d/Y h:i:s A')); ?> ON ORDER# <?php echo e($no->OrderID); ?>

                                                            </small></span>
                                                    </li>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </ul>
                                            </div>
                                        </div>

                                        <div class="tab-pane fade" id="tab-3" role="tabpanel" aria-labelledby="product-tab-3">
                                            <ul class="list-unstyled arrow">

                                                <?php if(!empty($tp->checks)): ?>
                                                <?php
                                                $checks = json_decode($tp->checks);
                                                ?>

                                                <?php if(is_array($checks) && !empty($checks)): ?>
                                                <?php $__currentLoopData = $checks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $check): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <li><?php echo e($check); ?></li>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php
                                                $usName = \App\Models\Users::find($tp->checksUser);
                                                ?>
                                                by <?php echo e($tp?->checksUser); ?> at <?php echo e(\Carbon\Carbon::parse($tp?->checksDate)->format('m/d/Y h:i:s A')); ?>


                                                <?php else: ?>
                                                <p>No checks selected.</p>
                                                <?php endif; ?>
                                                <?php endif; ?>
                                            </ul>
                                        </div>

                                        <div class="tab-pane fade" id="tab-4" role="tabpanel" aria-labelledby="product-tab-4">
                                            <table class="table display" id="myTable">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">S.No</th>
                                                        <th scope="col">ID#</th>
                                                        <th scope="col">Order#</th>
                                                        <th scope="col">PT First Name</th>
                                                        <th scope="col">PT Last Name</th>
                                                        <th scope="col">Account#</th>
                                                        <th scope="col">Document Type</th>
                                                        <th scope="col">Expiry</th>
                                                        <th scope="col">Uploaded By</th>
                                                        <th scope="col">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $__currentLoopData = $da; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $date): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <tr class="txt-sm " style="cursor: pointer;" data-toggle="modal" data-target="#ViewDocument" data-id="<?php echo e($date->id); ?>" data-name="<?php echo e($date->name); ?>">
                                                        <td class="txt-sm"><?php echo e($index + 1); ?></td>
                                                        <td class="txt-sm"><?php echo e($date->Order_No); ?></td>
                                                        <td class="txt-sm"><?php echo e($tp->Order_No); ?></td>
                                                        <td class="txt-sm"><?php echo e($tp->name); ?></td>
                                                        <td class="txt-sm"><?php echo e($tp->last_Name); ?></td>
                                                        <td class="txt-sm"><?php echo e($tp->AccNumber); ?></td>
                                                        <td class="txt-sm"><?php echo e($date->docType); ?></td>
                                                        <td class="txt-sm">
                                                            <?php if(is_null($date->toDate)): ?>
                                                            N/A
                                                            <?php elseif($date->toDate < now()): ?> Expired <?php else: ?> Valid <?php endif; ?> </td>
                                                        <td><?php echo e($date->upload); ?> at <?php echo e($date->created_at->format('m/d/Y h:i:s A')); ?></td>
                                                        <td class="text-center">
                                                            <div style="display: flex; justify-content: center; align-items: center;">
                                                                <button data-toggle="modal" style="padding: 0.25rem 0.5rem; font-size: 0.875rem; line-height: 1.5;" data-target="#ViewDocument" data-id="<?php echo e($date->id); ?>" data-name="<?php echo e($tp->name); ?>" class="btn btn-primary view-btn">
                                                                    <i class="fa-solid fa-eye"></i>
                                                                </button>

                                                                <?php if($userR =="2" || $editDocPer == "on"): ?>
                                                                <button data-toggle="modal" style="padding: 0.25rem 0.5rem; font-size: 0.875rem; line-height: 1.5;" data-target="#EditDocument" data-id="<?php echo e($date->id); ?>" data-name="<?php echo e($tp->name); ?>" class="btn btn-warning edit-btn">
                                                                    <i class="fa fa-pen-to-square"></i>
                                                                </button>
                                                                <?php endif; ?>
                                                                <?php if($userR =="2" || $deleteDocPer == "on"): ?>
                                                                <button data-url="<?php echo e(url('DeleteDocument', $date->id)); ?>" style="padding: 0.25rem 0.5rem; font-size: 0.875rem; line-height: 1.5;" class="btn btn-danger delete-btn" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete <?php echo e($tp->name); ?>'s document">
                                                                    <i class="fa fa-trash"></i>
                                                                </button>
                                                                <?php endif; ?>
                                                            </div>
                                                        </td>



                                                    </tr>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                                </tbody>
                                            </table>
                                        </div>

                                        <div class="tab-pane fade " id="tab-5" role="tabpanel" aria-labelledby="product-tab-4">
                                            <form action="<?php echo e(url('AddDiagnosis')); ?>" method="post">
                                                <?php echo csrf_field(); ?>
                                                <input type="hidden" name="Patient_ID" value="<?php echo e(old('Patient_ID', $tp->id)); ?>">
                                                <input type="hidden" name="DaignoseID" value="<?php echo e(old('DaignoseID',  isset($diagnosis) ? $diagnosis->id : '0')); ?>">
                                                <div class="col-12">
                                                    <div class="row">
                                                        <div class="col" style="border-right: 1px solid black;">
                                                            <div class="form-group">
                                                                <label class="col-form-label form-control-sm">Date of Injury</label>
                                                                <div class="input-group mb-3">
                                                                    <input type="date" required placeholder="Date of Injury" name="DateOfInjury" id="DateOfInjury" class="form-control form-control-sm"
                                                                        value="<?php echo e(old('DateOfInjury', isset($diagnosis) ? $diagnosis->DateOfInjury : '')); ?>">
                                                                </div>
                                                                <span>
                                                                    <small class="text-danger font-weight-light font-italic">
                                                                        <?php $__errorArgs = ['DateOfInjury'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                                        <?php echo e($message); ?>

                                                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                                    </small>
                                                                </span>
                                                            </div>

                                                            <div class="form-group">
                                                                <label class="col-form-label form-control-sm">Return to Work Date:</label>
                                                                <div class="input-group mb-3">
                                                                    <input type="date" required placeholder="Return to Return to Work Date:" id="WorkDate" name="WorkDate" class="form-control form-control-sm"
                                                                        value="<?php echo e(old('WorkDate', isset($diagnosis) ? $diagnosis->WorkDate : '')); ?>">
                                                                </div>
                                                                <span>
                                                                    <small class="text-danger font-weight-light font-italic">
                                                                        <?php $__errorArgs = ['WorkDate'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                                        <?php echo e($message); ?>

                                                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                                    </small>
                                                                </span>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="col-form-label form-control-sm">First Consult Date</label>
                                                                <div class="input-group mb-3">
                                                                    <input type="date" required placeholder="Consult Date" name="ConsultDate" id="ConsultDate" class="form-control form-control-sm"
                                                                        value="<?php echo e(old('ConsultDate', isset($diagnosis) ? $diagnosis->ConsultDate : '')); ?>">
                                                                </div>
                                                                <span>
                                                                    <small class="text-danger font-weight-light font-italic">
                                                                        <?php $__errorArgs = ['ConsultDate'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                                        <?php echo e($message); ?>

                                                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                                    </small>
                                                                </span>
                                                            </div>

                                                            <div class="form-group">
                                                                <label class="col-form-label form-control-sm">Accident</label>
                                                                <div class="input-group mb-3">
                                                                    <select class="form-control form-control-sm" required id="Accident" name="Accident">
                                                                        <option disabled <?php echo e(old('Accident', isset($diagnosis) ? $diagnosis->Accident : '') == '' ? 'selected' : ''); ?>>Accident</option>
                                                                        <?php $__currentLoopData = $st; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $drs): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                        <option value="<?php echo e($drs->Status); ?>" <?php echo e(old('Accident', isset($diagnosis) ? $diagnosis->Accident : '') == $drs->Status ? 'selected' : ''); ?>><?php echo e($drs->Status); ?></option>
                                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                    </select>
                                                                </div>
                                                                <span>
                                                                    <small class="text-danger font-weight-light font-italic">
                                                                        <?php $__errorArgs = ['Accident'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                                        <?php echo e($message); ?>

                                                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                                    </small>
                                                                </span>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="col-form-label form-control-sm">State of Injury</label>
                                                                <div class="input-group mb-3">
                                                                    <select class="form-control form-control-sm" id="StateInjury" required name="StateInjury">
                                                                        <option disabled <?php echo e(old('StateInjury', isset($diagnosis) ? $diagnosis->StateInjury : '') == '' ? 'selected' : ''); ?>>State of Injury</option>
                                                                        <?php $__currentLoopData = $st; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $drs): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                        <option value="<?php echo e($drs->Status); ?>" <?php echo e(old('StateInjury', isset($diagnosis) ? $diagnosis->StateInjury : '') == $drs->Status ? 'selected' : ''); ?>><?php echo e($drs->Status); ?></option>
                                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                    </select>
                                                                </div>
                                                                <span>
                                                                    <small class="text-danger font-weight-light font-italic">
                                                                        <?php $__errorArgs = ['StateInjury'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                                        <?php echo e($message); ?>

                                                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                                    </small>
                                                                </span>
                                                            </div>


                                                        </div>
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label class="col-form-label form-control-sm">ICD10 1</label>
                                                                <div class="input-group mb-3">
                                                                    <select class="form-control form-control-sm" id="ICD101" required name="ICD101">
                                                                        <option disabled <?php echo e(old('ICD101', isset($diagnosis) ? $diagnosis->ICD101 : '') == '' ? 'selected' : ''); ?>>ICD10 1</option>
                                                                        <?php $__currentLoopData = $icd10; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $drs): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                        <option value="<?php echo e($drs->Code); ?>" <?php echo e(old('ICD101', isset($diagnosis) ? $diagnosis->ICD101 : '') == $drs->Code ? 'selected' : ''); ?>><?php echo e($drs->Code); ?></option>
                                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                    </select>
                                                                </div>
                                                                <span>
                                                                    <small class="text-danger font-weight-light font-italic">
                                                                        <?php $__errorArgs = ['ICD101'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                                        <?php echo e($message); ?>

                                                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                                    </small>
                                                                </span>
                                                            </div>

                                                            <div class="form-group">
                                                                <label class="col-form-label form-control-sm">ICD10 2</label>
                                                                <div class="input-group mb-3">
                                                                    <select class="form-control form-control-sm" required id="ICD102" name="ICD102">
                                                                        <option disabled <?php echo e(old('ICD102', isset($diagnosis) ? $diagnosis->ICD102 : '') == '' ? 'selected' : ''); ?>>ICD10 2</option>
                                                                        <?php $__currentLoopData = $icd10; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $drs): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                        <option value="<?php echo e($drs->Code); ?>" <?php echo e(old('ICD102', isset($diagnosis) ? $diagnosis->ICD102 : '') == $drs->Code ? 'selected' : ''); ?>><?php echo e($drs->Code); ?></option>
                                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                    </select>
                                                                </div>
                                                                <span>
                                                                    <small class="text-danger font-weight-light font-italic">
                                                                        <?php $__errorArgs = ['ICD102'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                                        <?php echo e($message); ?>

                                                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                                    </small>
                                                                </span>
                                                            </div>

                                                            <div class="form-group">
                                                                <label class="col-form-label form-control-sm">ICD10 3</label>
                                                                <div class="input-group mb-3">
                                                                    <select class="form-control form-control-sm" required id="ICD103" name="ICD103">
                                                                        <option disabled <?php echo e(old('ICD103', isset($diagnosis) ? $diagnosis->ICD103 : '') == '' ? 'selected' : ''); ?>>ICD10 3</option>
                                                                        <?php $__currentLoopData = $icd10; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $drs): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                        <option value="<?php echo e($drs->Code); ?>" <?php echo e(old('ICD103', isset($diagnosis) ? $diagnosis->ICD103 : '') == $drs->Code ? 'selected' : ''); ?>><?php echo e($drs->Code); ?></option>
                                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                    </select>
                                                                </div>
                                                                <span>
                                                                    <small class="text-danger font-weight-light font-italic">
                                                                        <?php $__errorArgs = ['ICD103'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                                        <?php echo e($message); ?>

                                                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                                    </small>
                                                                </span>
                                                            </div>

                                                            <div class="form-group">
                                                                <label class="col-form-label form-control-sm">ICD10 4</label>
                                                                <div class="input-group mb-3">
                                                                    <select class="form-control form-control-sm" required id="ICD104" name="ICD104">
                                                                        <option disabled <?php echo e(old('ICD104', isset($diagnosis) ? $diagnosis->ICD104 : '') == '' ? 'selected' : ''); ?>>ICD10 4</option>
                                                                        <?php $__currentLoopData = $icd10; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $drs): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                        <option value="<?php echo e($drs->Code); ?>" <?php echo e(old('ICD104', isset($diagnosis) ? $diagnosis->ICD104 : '') == $drs->Code ? 'selected' : ''); ?>><?php echo e($drs->Code); ?></option>
                                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                    </select>
                                                                </div>
                                                                <span>
                                                                    <small class="text-danger font-weight-light font-italic">
                                                                        <?php $__errorArgs = ['ICD104'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                                        <?php echo e($message); ?>

                                                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                                    </small>
                                                                </span>
                                                            </div>

                                                            <div class="form-group">
                                                                <label class="col-form-label form-control-sm">ICD10 5</label>
                                                                <div class="input-group mb-3">
                                                                    <select class="form-control form-control-sm" required name="ICD105" id="ICD105">
                                                                        <option disabled <?php echo e(old('ICD105', isset($diagnosis) ? $diagnosis->ICD105 : '') == '' ? 'selected' : ''); ?>> ICD10 5</option>
                                                                        <?php $__currentLoopData = $icd10; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $drs): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                        <option value="<?php echo e($drs->Code); ?>" <?php echo e(old('ICD105', isset($diagnosis) ? $diagnosis->ICD105 : '') == $drs->Code ? 'selected' : ''); ?>><?php echo e($drs->Code); ?></option>
                                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                    </select>
                                                                </div>
                                                                <span>
                                                                    <small class="text-danger font-weight-light font-italic">
                                                                        <?php $__errorArgs = ['ICD105'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                                        <?php echo e($message); ?>

                                                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                                    </small>
                                                                </span>
                                                            </div>

                                                            <div class="form-group">
                                                                <label class="col-form-label form-control-sm">ICD10 6</label>
                                                                <div class="input-group mb-3">
                                                                    <select class="form-control form-control-sm" required name="ICD106" id="ICD106">
                                                                        <option disabled <?php echo e(old('ICD106', isset($diagnosis) ? $diagnosis->ICD106 : '') == '' ? 'selected' : ''); ?>>ICD10 6</option>
                                                                        <?php $__currentLoopData = $icd10; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $drs): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                        <option value="<?php echo e($drs->Code); ?>" <?php echo e(old('ICD106', isset($diagnosis) ? $diagnosis->ICD106 : '') == $drs->Code ? 'selected' : ''); ?>><?php echo e($drs->Code); ?></option>
                                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                    </select>
                                                                </div>
                                                                <span>
                                                                    <small class="text-danger font-weight-light font-italic">
                                                                        <?php $__errorArgs = ['ICD106'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                                        <?php echo e($message); ?>

                                                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                                    </small>
                                                                </span>
                                                            </div>

                                                            <div class="form-group">
                                                                <label class="col-form-label form-control-sm">ICD10 7</label>
                                                                <div class="input-group mb-3">
                                                                    <select class="form-control form-control-sm" required name="ICD107" id="ICD107">
                                                                        <option disabled <?php echo e(old('ICD107', isset($diagnosis) ? $diagnosis->ICD107 : '') == '' ? 'selected' : ''); ?>>ICD10 7</option>
                                                                        <?php $__currentLoopData = $icd10; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $drs): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                        <option value="<?php echo e($drs->Code); ?>" <?php echo e(old('ICD107', isset($diagnosis) ? $diagnosis->ICD107 : '') == $drs->Code ? 'selected' : ''); ?>><?php echo e($drs->Code); ?></option>
                                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                    </select>
                                                                </div>
                                                                <span>
                                                                    <small class="text-danger font-weight-light font-italic">
                                                                        <?php $__errorArgs = ['ICD107'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                                        <?php echo e($message); ?>

                                                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                                    </small>
                                                                </span>
                                                            </div>

                                                            <div class="form-group">
                                                                <label class="col-form-label form-control-sm">ICD10 8</label>
                                                                <div class="input-group mb-3">
                                                                    <select class="form-control form-control-sm" required name="ICD108" id="ICD108">
                                                                        <option disabled <?php echo e(old('ICD108', isset($diagnosis) ? $diagnosis->ICD108 : '') == '' ? 'selected' : ''); ?>>ICD10 8</option>
                                                                        <?php $__currentLoopData = $icd10; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $drs): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                        <option value="<?php echo e($drs->Code); ?>" <?php echo e(old('ICD108', isset($diagnosis) ? $diagnosis->ICD108 : '') == $drs->Code ? 'selected' : ''); ?>><?php echo e($drs->Code); ?></option>
                                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                    </select>
                                                                </div>
                                                                <span>
                                                                    <small class="text-danger font-weight-light font-italic">
                                                                        <?php $__errorArgs = ['ICD108'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                                        <?php echo e($message); ?>

                                                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                                    </small>
                                                                </span>
                                                            </div>

                                                            <div class="form-group">
                                                                <label class="col-form-label form-control-sm">ICD10 9</label>
                                                                <div class="input-group mb-3">
                                                                    <select class="form-control form-control-sm" required name="ICD109" id="ICD109">
                                                                        <option disabled <?php echo e(old('ICD109', isset($diagnosis) ? $diagnosis->ICD109 : '') == '' ? 'selected' : ''); ?>>ICD10 9</option>
                                                                        <?php $__currentLoopData = $icd10; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $drs): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                        <option value="<?php echo e($drs->Code); ?>" `<?php echo e(old('ICD109', isset($diagnosis) ? $diagnosis->ICD109 : '') == $drs->Code ? 'selected' : ''); ?>><?php echo e($drs->Code); ?></option>
                                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                    </select>
                                                                </div>
                                                                <span>
                                                                    <small class="text-danger font-weight-light font-italic">
                                                                        <?php $__errorArgs = ['ICD109'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                                        <?php echo e($message); ?>

                                                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                                    </small>
                                                                </span>
                                                            </div>

                                                            <div class="form-group">
                                                                <label class="col-form-label form-control-sm">ICD10 10</label>
                                                                <div class="input-group mb-3">
                                                                    <select class="form-control form-control-sm" required name="ICD1010" id="ICD1010">
                                                                        <option disabled <?php echo e(old('ICD1010', isset($diagnosis) ? $diagnosis->ICD1010 : '') == '' ? 'selected' : ''); ?>>ICD10 10</option>
                                                                        <?php $__currentLoopData = $icd10; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $drs): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                        <option value="<?php echo e($drs->Code); ?>" <?php echo e(old('ICD1010', isset($diagnosis) ? $diagnosis->ICD1010 : '') == $drs->Code ? 'selected' : ''); ?>><?php echo e($drs->Code); ?></option>
                                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                    </select>
                                                                </div>
                                                                <span>
                                                                    <small class="text-danger font-weight-light font-italic">
                                                                        <?php $__errorArgs = ['ICD1010'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                                        <?php echo e($message); ?>

                                                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                                    </small>
                                                                </span>
                                                            </div>

                                                            <div class="form-group">
                                                                <label class="col-form-label form-control-sm">ICD10 11</label>
                                                                <div class="input-group mb-3">
                                                                    <select class="form-control form-control-sm" required name="ICD1011" id="ICD1011">
                                                                        <option disabled <?php echo e(old('ICD1011', isset($diagnosis) ? $diagnosis->ICD1011 : '') == '' ? 'selected' : ''); ?>>ICD10 11</option>
                                                                        <?php $__currentLoopData = $icd10; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $drs): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                        <option value="<?php echo e($drs->Code); ?>" <?php echo e(old('ICD1011', isset($diagnosis) ? $diagnosis->ICD1011 : '') == $drs->Code ? 'selected' : ''); ?>><?php echo e($drs->Code); ?></option>
                                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                    </select>
                                                                </div>
                                                                <span>
                                                                    <small class="text-danger font-weight-light font-italic">
                                                                        <?php $__errorArgs = ['ICD1011'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                                        <?php echo e($message); ?>

                                                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                                    </small>
                                                                </span>
                                                            </div>

                                                            <div class="form-group">
                                                                <label class="col-form-label form-control-sm">ICD10 12</label>
                                                                <div class="input-group mb-3">
                                                                    <select class="form-control form-control-sm" required name="ICD1012" id="ICD1012">
                                                                        <option <?php echo e(old('ICD1012', isset($diagnosis) ? $diagnosis->ICD1012 : '') == '' ? 'selected' : ''); ?> disabled>ICD10 12</option>
                                                                        <?php $__currentLoopData = $icd10; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $drs): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                        <option value="<?php echo e($drs->Code); ?>" <?php echo e(old('ICD1012', isset($diagnosis) ? $diagnosis->ICD1012 : '') == $drs->Code ? 'selected' : ''); ?>><?php echo e($drs->Code); ?></option>
                                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                    </select>
                                                                </div>
                                                                <span>
                                                                    <small class="text-danger font-weight-light font-italic">
                                                                        <?php $__errorArgs = ['ICD1012'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                                        <?php echo e($message); ?>

                                                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                                    </small>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <br>
                                                    <div class="col">
                                                        <button type="submit" class="btn btn-primary btn-block">Save</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>

                                        <div class="tab-pane fade" id="tab-6" role="tabpanel" aria-labelledby="product-tab-4">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <h2 class="pageheader-title">Maintain Insurance</h2>
                                                        <a href="/AddPatientInsurance/<?php echo e($tp->id); ?>/0" class="btn btn-primary">Add&nbsp;Insurance</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <br>
                                            <table class="table display" id="myTable2">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">S.No</th>
                                                        <th scope="col">Insurance Company</th>
                                                        <th scope="col">Policy</th>
                                                        <th scope="col">Group</th>
                                                        <th scope="col">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $sno = 1;
                                                    ?>
                                                    <?php $__currentLoopData = $PatInsurance; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <tr class="txt-sm " style="cursor: pointer;">
                                                        <td class="txt-sm"><?php echo e($sno++); ?></td>
                                                        <td class="txt-sm"><?php echo e($index->Company); ?></td>
                                                        <td class="txt-sm"><?php echo e($index->Policy); ?></td>
                                                        <td class="txt-sm"><?php echo e($index->Group); ?></td>

                                                        <td class="text-center">
                                                            <div style="display: flex; justify-content: center; align-items: center;">
                                                                <a href="/AddPatientInsurance/<?php echo e($tp->id); ?>/<?php echo e($index->id); ?>" style="padding: 0.25rem 0.5rem; font-size: 0.875rem; line-height: 1.5;" class="btn btn-warning">
                                                                    <i class="fa fa-pen-to-square"></i>
                                                                </a>

                                                                <button data-url="<?php echo e(url('DeletePatientInsurance', $index->id)); ?>" style="padding: 0.25rem 0.5rem; font-size: 0.875rem; line-height: 1.5;" class="btn btn-danger delete-btn" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete <?php echo e($tp->name); ?>'s Insurance">
                                                                    <i class="fa fa-trash"></i>
                                                                </button>

                                                            </div>
                                                        </td>



                                                    </tr>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                                </tbody>
                                            </table>

                                        </div>

                                        <div class="tab-pane fade" id="tab-8" role="tabpanel" aria-labelledby="product-tab-4">

                                            <form method="post" action="<?php echo e(url('AddCoPayment')); ?>">
                                                <?php echo csrf_field(); ?>
                                                <input type="hidden" name="PatientID" value="<?php echo e(old('PatientID', $tp->id)); ?>">
                                                <input type="hidden" name="previous_url" value="<?php echo e(url()->previous()); ?>">
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label class="col-form-label">Signature on File </label>
                                                            <div class="input-group mb-3">
                                                                <input type="date" required placeholder="SignatureFile" name="SignatureFile" class="form-control form-control form-control-sm"
                                                                    value="<?php echo e(old('SignatureFile', isset($copayment) && $copayment->SignatureFile ? Carbon::parse($copayment->SignatureFile)->format('Y-m-d') : Carbon::parse($tp->created_at)->format('Y-m-d'))); ?>">

                                                            </div>
                                                            <span>
                                                                <small class="text-danger font-weight-light font-italic">
                                                                    <?php $__errorArgs = ['SignatureFile'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                                    <?php echo e($message); ?>

                                                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                                </small>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label class="col-form-label">Months Valid</label>
                                                            <div class="input-group mb-3">
                                                                <input type="number" required placeholder="Months Valid" name="MonthsValid" class="form-control form-control form-control-sm"
                                                                    value="<?php echo e(old('MonthsValid', isset($copayment) ? $copayment->MonthsValid : '')); ?>">

                                                            </div>
                                                            <span><small class="text-danger font-weight-light font-italic">
                                                                    <?php $__errorArgs = ['MonthsValid'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                                    <?php echo e($message); ?>

                                                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                                </small></span>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label class="col-form-label">Signature Type </label>
                                                            <div class="input-group mb-3">
                                                                <select class="form-control form-control form-control-sm" required name="SignatureType">
                                                                    <option value="Signature Generated by Provider/Patient not physically present" <?php echo e(old('SignatureType', isset($copayment) ? $copayment->SignatureType : '') == 'Signature Generated by Provider/Patient not physically present' ? 'selected' : ''); ?>>Signature Generated by Provider/Patient not physically present</option>

                                                                    <option value="Signed HCFA-1500 on file" <?php echo e(old('SignatureType', isset($copayment) ? $copayment->SignatureType : '') == 'Signed HCFA-1500 on file' ? 'selected' : ''); ?>>Signed HCFA-1500 on file</option>

                                                                    <option value="Signed signature Authorization form from block 12 on file" <?php echo e(old('SignatureType', isset($copayment) ? $copayment->SignatureType : '') == 'Signed signature Authorization form from block 12 on file' ? 'selected' : ''); ?>>Signed signature Authorization form from block 12 on file</option>

                                                                    <option value="Signed signature Authorization form from block 13 on file" <?php echo e(old('SignatureType', isset($copayment) ? $copayment->SignatureType : '') == 'Signed signature Authorization form from block 13 on file' ? 'selected' : ''); ?>>Signed signature Authorization form from block 13 on file</option>

                                                                    <option value="Signed signature Authorization form from block 12 & 13 on file" <?php echo e(old('SignatureType', isset($copayment) ? $copayment->SignatureType : '') == 'Signed signature Authorization form from block 12 & 13 on file' ? 'selected' : 'selected'); ?>>Signed signature Authorization form from block 12 & 13 on file</option>

                                                                </select>
                                                            </div>
                                                            <span>
                                                                <small class="text-danger font-weight-light font-italic">
                                                                    <?php $__errorArgs = ['SignatureType'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                                    <?php echo e($message); ?>

                                                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                                </small>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label class="col-form-label">CoPay %</label>
                                                            <div class="input-group mb-3">
                                                                <input type="text" required placeholder="CoPay %" name="CoPay" class="form-control form-control form-control-sm"
                                                                    value="<?php echo e(old('CoPay', isset($copayment) ? $copayment->CoPay : '')); ?>">
                                                            </div>
                                                            <span><small class="text-danger font-weight-light font-italic">
                                                                    <?php $__errorArgs = ['CoPay'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                                    <?php echo e($message); ?>

                                                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                                </small></span>
                                                        </div>
                                                    </div>

                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label class="col-form-label">Basis </label>
                                                            <div class="input-group mb-3">
                                                                <select class="form-control form-control form-control-sm" required name="Basis">
                                                                    <option disabled <?php echo e(old('Basis', isset($copayment) ? $copayment->Basis : '') == '' ? 'selected' : ''); ?>>Basis</option>

                                                                    <option value="Bill" <?php echo e(old('Basis', isset($copayment) ? $copayment->Basis : '') == 'Bill' ? 'selected' : ''); ?>>Bill</option>

                                                                    <option value="Allowed" <?php echo e(old('Basis', isset($copayment) ? $copayment->Basis : '') == 'Allowed' ? 'selected' : ''); ?>>Allowed</option>

                                                                </select>
                                                            </div>
                                                            <span>
                                                                <small class="text-danger font-weight-light font-italic">
                                                                    <?php $__errorArgs = ['Basis'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                                    <?php echo e($message); ?>

                                                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                                </small>
                                                            </span>
                                                        </div>
                                                    </div>

                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label class="col-form-label">Tax Rate </label>
                                                            <div class="input-group mb-3">
                                                                <select class="form-control form-control form-control-sm" required name="TaxRate">
                                                                    <option disabled <?php echo e(old('TaxRate', isset($copayment) ? $copayment->TaxRate : '') == '' ? 'selected' : ''); ?>>Tax Rate</option>
                                                                    <?php $__currentLoopData = $taxes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $drs): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <option value="<?php echo e($drs->TotalTax); ?>" <?php echo e(old('TaxRate', isset($copayment) ? $copayment->TaxRate : '') == $drs->Name ? 'selected' : ''); ?>><?php echo e($drs->Name . ' ( ' . $drs->TotalTax . ' )'); ?></option>
                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                </select>
                                                            </div>
                                                            <span>
                                                                <small class="text-danger font-weight-light font-italic">
                                                                    <?php $__errorArgs = ['TaxRate'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                                    <?php echo e($message); ?>

                                                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                                </small>
                                                            </span>
                                                        </div>
                                                    </div>

                                                    <div class="col m-3">
                                                        <label class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input" name="Block12" value="on" <?php echo e(isset($copayment) && $copayment->Block12 == 'on' ? 'checked' : ''); ?>>
                                                            <span class="custom-control-label">Block 12 on HCFA</span>
                                                        </label>

                                                    </div>

                                                </div>

                                                <div class="row">
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label class="col-form-label">CoPay $</label>
                                                            <div class="input-group mb-3">
                                                                <input type="text" required placeholder="CoPay %" name="CoPayDollar" class="form-control form-control form-control-sm"
                                                                    value="<?php echo e(old('CoPayDollar', isset($copayment) ? $copayment->CoPayDollar : '')); ?>">
                                                            </div>
                                                            <span><small class="text-danger font-weight-light font-italic">
                                                                    <?php $__errorArgs = ['CoPayDollar'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                                    <?php echo e($message); ?>

                                                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                                </small></span>
                                                        </div>
                                                    </div>

                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label class="col-form-label">Frequency </label>
                                                            <div class="input-group mb-3">
                                                                <select class="form-control form-control form-control-sm" required name="Frequency">
                                                                    <option disabled <?php echo e(old('Frequency', isset($copayment) ? $copayment->Frequency : '') == '' ? 'selected' : ''); ?>>Frequency</option>

                                                                    <option value="Per Visit" <?php echo e(old('Frequency', isset($copayment) ? $copayment->Frequency : '') == 'Per Visit' ? 'selected' : ''); ?>>Per Visit</option>

                                                                    <option value="Monthly" <?php echo e(old('Frequency', isset($copayment) ? $copayment->Frequency : '') == 'Monthly' ? 'selected' : ''); ?>>Monthly</option>

                                                                    <option value="Yearly" <?php echo e(old('Frequency', isset($copayment) ? $copayment->Frequency : '') == 'Yearly' ? 'selected' : ''); ?>>Yearly</option>

                                                                </select>
                                                            </div>
                                                            <span>
                                                                <small class="text-danger font-weight-light font-italic">
                                                                    <?php $__errorArgs = ['Frequency'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                                    <?php echo e($message); ?>

                                                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                                </small>
                                                            </span>
                                                        </div>
                                                    </div>

                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label class="col-form-label">Invoice Form </label>
                                                            <div class="input-group mb-3">
                                                                <select class="form-control form-control form-control-sm" required name="InvoiceForm">
                                                                    <option disabled <?php echo e(old('InvoiceForm', isset($copayment) ? $copayment->InvoiceForm : '') == '' ? 'selected' : ''); ?>>Invoice Form </option>
                                                                    <?php $__currentLoopData = $invoiceForm; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $drs): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <option value="<?php echo e($drs->name); ?>" <?php echo e(old('InvoiceForm', isset($copayment) ? $copayment->InvoiceForm : '') == $drs->name ? 'selected' : ''); ?>><?php echo e($drs->name); ?></option>
                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                </select>
                                                            </div>
                                                            <span>
                                                                <small class="text-danger font-weight-light font-italic">
                                                                    <?php $__errorArgs = ['InvoiceForm'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                                    <?php echo e($message); ?>

                                                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                                </small>
                                                            </span>
                                                        </div>
                                                    </div>

                                                    <div class="col m-3">
                                                        <label class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input" name="Block13" value="on" <?php echo e(isset($copayment) && $copayment->Block13 == 'on' ? 'checked' : ''); ?>>
                                                            <span class="custom-control-label">Block 13 on HCFA</span>
                                                        </label>
                                                        <label class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input" name="Hardship" value="on" <?php echo e(isset($copayment) && $copayment->Hardship == 'on' ? 'checked' : ''); ?>>
                                                            <span class="custom-control-label">Hardship</span>
                                                        </label>
                                                    </div>

                                                </div>

                                                <div class="row">
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label class="col-form-label">Deductible </label>
                                                            <div class="input-group mb-3">
                                                                <input type="text" required placeholder="CoPay %" name="Deductible" class="form-control form-control form-control-sm"
                                                                    value="<?php echo e(old('Deductible', isset($copayment) ? $copayment->Deductible : '')); ?>">
                                                            </div>
                                                            <span><small class="text-danger font-weight-light font-italic">
                                                                    <?php $__errorArgs = ['Deductible'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                                    <?php echo e($message); ?>

                                                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                                </small></span>
                                                        </div>
                                                    </div>

                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label class="col-form-label">Out of Pocket</label>
                                                            <div class="input-group mb-3">
                                                                <input type="text" required placeholder="Out of Pocket" name="OutPocket" class="form-control form-control form-control-sm"
                                                                    value="<?php echo e(old('OutPocket', isset($copayment) ? $copayment->OutPocket : '')); ?>">
                                                            </div>
                                                            <span><small class="text-danger font-weight-light font-italic">
                                                                    <?php $__errorArgs = ['OutPocket'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                                    <?php echo e($message); ?>

                                                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                                </small></span>
                                                        </div>
                                                    </div>

                                                    <div class="col m-3">
                                                        <label class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input" name="SupplierStandards" value="on" <?php echo e(isset($copayment) && $copayment->SupplierStandards == 'on' ? 'checked' : ''); ?>>
                                                            <span class="custom-control-label">Supplier Standards</span>
                                                        </label>
                                                        <label class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input" name="HIPPANote" value="on" <?php echo e(isset($copayment) && $copayment->HIPPANote == 'on' ? 'checked' : ''); ?>>
                                                            <span class="custom-control-label">HIPPA Note</span>
                                                        </label>
                                                    </div>

                                                </div>



                                                <div class="row">
                                                    <div class="col">
                                                        <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#paymentModal">
                                                            Pay Now
                                                        </button>
                                                    </div>
                                                    <div class="col">
                                                        <button class="btn btn-primary btn-block"> Send Bill to Patient </button>
                                                    </div>
                                                </div>

                                            </form>
                                        </div>

                                        <div class="tab-pane fade show active" id="tab-10" role="tabpanel" aria-labelledby="product-tab-4">
                                            <div class="table-responsive"> <!-- Add this responsive wrapper -->
                                                <table class="table display" id="myTable3">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">S.No</th>
                                                            <th scope="col">Item</th>
                                                            <th scope="col"> </th>
                                                            <th scope="col">Order&nbsp;Date</th>
                                                            <th scope="col">Delivery&nbsp;Date</th>
                                                            <th scope="col">Created&nbsp;By</th>
                                                            <th scope="col">Department</th>
                                                            <th scope="col">Order&nbsp;Status</th>
                                                            <th scope="col">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $sno = 1;
                                                        $deptIds = $Orders->pluck('Department')->filter()->unique();
                                                        $statusIds = $Orders->pluck('OrderStatus')->filter()->unique();
                                                        $itemsIds = $Orders->pluck('Items')->filter()->unique();

                                                        $departments = \App\Models\Departments::whereIn('id', $deptIds)->pluck('Department', 'id');
                                                        $status = \App\Models\Status::whereIn('id', $statusIds)->pluck('Status', 'id');
                                                        $items = \App\Models\OrderItems::whereIn('uniqueOrderId', $itemsIds)->get()->groupBy('uniqueOrderId')
                                                        ->map(function ($group) {
                                                        return $group->pluck('item');
                                                        });
                                                        ?>

                                                        <?php $__currentLoopData = $Orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <?php
                                                        $deptName = $departments->get($index?->Department);
                                                        $statusName = $status->get($index?->OrderStatus);
                                                        $orderItems = $items->get($index?->Items) ?? [];
                                                        ?>
                                                        <tr class="txt-sm"
                                                            onclick="window.location.href='/AddOrders/<?php echo e($index->id); ?>/1';"
                                                            style="cursor: pointer;"
                                                            data-toggle="tooltip"
                                                            data-placement="top"
                                                            title="Show <?php echo e($tp->name); ?>'s order details">

                                                            <td class="txt-sm"><?php echo e($sno++); ?></td>
                                                            <td class="txt-sm">
                                                                <ul class="list-unstyled mb-0">
                                                                    <?php $__currentLoopData = $orderItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $itemName): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <li><?php echo e($itemName); ?></li>
                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                </ul>
                                                            </td>
                                                            <td class="txt-sm" style="white-space: nowrap;">
                                                                <button data-toggle="modal" data-target="#AddNote" data-id="<?php echo e($index->id); ?>"
                                                                    class="btn btn-primary modal-button btn-sm"
                                                                    style="padding: 2px 6px; font-size: 12px;"
                                                                    onclick="event.stopPropagation(); openNoteModal(this);">
                                                                    Add Notes
                                                                </button>
                                                                <button data-toggle="modal" data-target="#AddDocument"
                                                                    class="btn btn-primary modal-button btn-sm"
                                                                    style="padding: 2px 6px; font-size: 12px;"
                                                                    data-id="<?php echo e($index->id); ?>"
                                                                    onclick="event.stopPropagation(); openDocumentModal(this);">
                                                                    Upload Documents
                                                                </button>
                                                            </td>
                                                            <td class="txt-sm"><?php echo e($index->created_at); ?></td>
                                                            <td class="txt-sm"><?php echo e($index->created_at); ?></td>
                                                            <td class="txt-sm"><?php echo e($index->CreatedBy); ?></td>
                                                            <td class="txt-sm"><?php echo e($deptName); ?></td>
                                                            <td class="txt-sm"><?php echo e($statusName); ?></td>
                                                            <td class="text-center">
                                                                <div class="d-flex justify-content-center align-items-center">
                                                                    <a href="/AddOrders/<?php echo e($tp->id); ?>/<?php echo e($index->id); ?>"
                                                                        class="btn btn-sm btn-warning mr-1"
                                                                        title="Edit Order">
                                                                        <i class="fa fa-pen-to-square"></i>
                                                                    </a>
                                                                    <a href="/AddOrders/<?php echo e($index->id); ?>/1"
                                                                        class="btn btn-sm btn-success mr-1"
                                                                        title="View Order">
                                                                        <i class="fa fa-eye"></i>
                                                                    </a>
                                                                    <button data-url="<?php echo e(url('DeleteOrders', $index->id)); ?>"
                                                                        class="btn btn-sm btn-danger delete-btn"
                                                                        title="Delete Order">
                                                                        <i class="fa fa-trash"></i>
                                                                    </button>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </tbody>
                                                </table>
                                            </div>

                                        </div>

                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>

                </div>
            </div>
        </div>

        <?php echo $__env->make('layout.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>



        <div class="modal fade" id="paymentModal" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="paymentModalLabel">Enter Payment Details</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="payment-form" method="POST" action="<?php echo e(route('handle.payment')); ?>">
                            <?php echo csrf_field(); ?>
                            <div class="form-group">
                                <label for="card-element">Card Number</label>
                                <div id="card-element" class="form-control">
                                    <!-- A Stripe Element will be inserted here. -->
                                </div>
                            </div>
                            <span id="errorMessage" class="alert alert-danger txt-sm" style="display: none;"></span>

                            <input type="text" name="amount" id="amount">
                            <input type="hidden" name="stripeToken" id="stripeToken">
                            <span id="spinner" class="dashboard-spinner spinner-success spinner-xl " style="display:none;"></span>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="submit-button">Pay</button>
                    </div>
                </div>
            </div>
        </div>


        <div class="modal fade" id="AddNote" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <style>
                .predefined-notes-bubbles {
                    display: flex;
                    flex-wrap: wrap;
                    gap: 10px;
                    margin-top: 10px;
                }

                .note-bubble {
                    background-color: #f1f1f1;
                    padding: 8px 12px;
                    border-radius: 20px;
                    cursor: pointer;
                    font-size: 14px;
                    white-space: nowrap;
                }

                .note-bubble:hover {
                    background-color: #007bff;
                    color: white;
                }
            </style>
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Notes</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="<?php echo e(url('AddNote', $tp->id)); ?>" id="NoteForm">
                            <?php echo csrf_field(); ?>
                            <div class="form-group">
                                <label for="message-text" class="col-form-label form-control-sm">Add Note:</label>
                                <textarea class="form-control" name="note" required id="message-text"></textarea>
                            </div>
                            <input type="hidden" id="note-id" name="OrderID" />
                            <div id="predefined-notes-container" style="display: none;">
                                <label class="col-form-label form-control-sm">Predefined Notes:</label>
                                <div class="predefined-notes-bubbles">
                                    <?php $__currentLoopData = $predefinedNotes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $note): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <span class="note-bubble" data-note="<?php echo e($note->Text); ?>"><?php echo e($note->Text); ?></span>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                    </div>
                    <div class="modal-footer d-flex justify-content-between">
                        <div>
                            <button type="button" class="btn btn-primary" id="show-predefined-notes">PREDEFINED NOTES</button>
                        </div>
                        <div>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Add Note</button>
                            </form>
                        </div>

                    </div>

                </div>

            </div>

        </div>

        <div class="modal fade" id="AddDocument" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Document</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <style>
                            .small-label {
                                font-size: 0.8rem;
                                margin-top: -10px;
                            }

                            .form-control-sm {
                                height: calc(1.5em + 0.5rem + 2px);
                                /* Adjust the height as needed */
                                font-size: 0.8rem;
                                /* Smaller font size for smaller controls */
                                margin-top: -5px;
                                /* width: 75%; Adjust width as needed */
                            }
                        </style>

                        <form method="post" action="<?php echo e(url('AddDocument')); ?>" id="DocumentForm" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="documnet" class="col-form-label form-control-sm text-sm small-label">Document Type:</label>
                                        <select name="docs" id="documnet" class="form-control form-control-sm" required>
                                            <option value="Prescription (RX)">Prescription (RX)</option>
                                            <option value="CMN">CMN</option>
                                            <option value="Authorization">Authorization</option>
                                            <?php if($tp->Dept == "5"): ?>
                                            <option value="Sleep Study">Sleep Study</option>
                                            <?php endif; ?>
                                            <option value="Office Notes/Medical Records">Office Notes/Medical Records</option>
                                            <option value="Demographics">Demographics</option>
                                            <option value="Manufacturer Order Form">Manufacturer Order Form</option>
                                            <?php if($tp->Dept == "4"): ?>
                                            <option value="Consignment Documents">Consignment Documents</option>
                                            <?php endif; ?>
                                            <option value="Home Assessment">Home Assessment</option>
                                            <option value="7 Element Form">7 Element Form</option>
                                            <option value="Proof of Delivery">Proof of Delivery</option>
                                            <option value="Pickup Ticket">Pickup Ticket</option>
                                            <option value="Exchange Form">Exchange Form</option>
                                            <option value="Claims">Claims</option>
                                            <option value="Other">Other</option>
                                        </select>
                                    </div>

                                    <div class="inputSmall" id="docType" style="display: none;">
                                        <select name="subDoc" id="SubDoc" class="form-control form-control-sm">
                                            <option value="EOB">EOB</option>
                                            <option value="Denial letter">Denial letter</option>
                                            <option value="Appeals level 1">Appeals level 1</option>
                                            <option value="Appeals level 2">Appeals level 2</option>
                                            <option value="Approval letter">Approval letter</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="title" class="col-form-label form-control-sm small-label">Title:</label>
                                        <input type="text" placeholder="Enter Title" class="form-control form-control-sm" id="title" name="title" required />
                                    </div>

                                    <div class="form-group">
                                        <label for="type" class="col-form-label form-control-sm small-label">Type:</label>
                                        <input type="text" placeholder="Enter Type" class="form-control form-control-sm" id="type" name="type" />
                                    </div>

                                    <div class="form-group">
                                        <label for="description" class="col-form-label form-control-sm small-label">Description:</label>
                                        <textarea placeholder="Enter Description" class="form-control form-control-sm" id="description" rows="2" cols="2" name="desc"></textarea>
                                    </div>

                                    <div class="form-group">
                                        <label for="ptName" class="col-form-label form-control-sm small-label">Patient Name:</label>
                                        <input type="text" value="<?php echo e($tp->name.' '.$tp->last_Name); ?>" disabled placeholder="Enter Type" class="form-control form-control-sm" id="ptName" />

                                        <input type="hidden" name="ptName" value="<?php echo e($tp->id); ?>">
                                        <input type="hidden" name="ptOrderId" id="document-id" value="">
                                    </div>

                                    <div class="form-group">
                                        <label for="drOff" class="col-form-label form-control-sm small-label">Dr Office:</label>
                                        <input type="text" value="<?php echo e($offName->Office_Name); ?>" disabled placeholder="Enter Type" class="form-control form-control-sm" id="drOff AddDocumentLabel" />

                                        <input type="hidden" name="drOff" id="drOff" value="<?php echo e($tp->Off_Name); ?>">
                                    </div>

                                    <div class="form-group">
                                        <label for="patientAcc" class="col-form-label form-control-sm small-label">Patient Acct#:</label>
                                        <input type="text" required class="form-control form-control-sm" id="patientAcc" value="<?php echo e($tp->AccNumber); ?>" readonly name="patientAcc" required />
                                    </div>

                                    <div class="form-group">
                                        <label for="patientOrder" class="col-form-label form-control-sm small-label">Patient Order#:</label>
                                        <input type="text" required class="form-control form-control-sm" id="patientOrder" value="<?php echo e($tp->Order_No); ?>" readonly name="patientOrder" required />
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="fileUpload" class="form-label small-label">Upload File:</label>
                                        <input type="file" required name="img" class="form-control form-control-sm" id="fileUpload" accept=".pdf, .heic, .jpeg, .jpg, .png, .tiff, .tif" />
                                    </div>
                                    <div class="form-group">
                                        <img id="previewImage" src="<?php echo e(asset('pdf.png')); ?>" alt="Image Preview" style="display: none; max-width: 100%; height: auto;" />
                                        <p id="fileMessage" style="display: none;"></p>
                                    </div>
                                    <div class="form-group" id="PFDAdd" style="display:none">
                                        <label for="FDateEdit" class="col-form-label form-control-sm small-label">Date of Service:</label>
                                        <input type="date" class="form-control form-control-sm" id="PFDate" name="PFDate" />
                                    </div>

                                    <div id="ConsDocAdd" style="display:none">
                                        <div class="form-group">
                                            <label for="TDate" class="col-form-label form-control-sm small-label">Date of Service:</label>
                                            <input type="date" class="form-control form-control-sm" id="DOS" name="DOS" />
                                        </div>
                                    </div>

                                    <div id="RX">
                                        <h4 class="small-label"><span id="DataeType">Prescription (RX) </span> Date:</h4>
                                        <div class="form-group">
                                            <label for="FDate" class="col-form-label form-control-sm small-label">From:</label>
                                            <input type="date" class="form-control form-control-sm" id="FDate" name="FDate" />
                                        </div>
                                        <div class="form-group">
                                            <label for="TDate" class="col-form-label form-control-sm small-label">TO:</label>
                                            <input type="date" class="form-control form-control-sm" id="TDate" name="TDate" />
                                        </div>
                                        <div class="form-group">
                                            <label for="duration" class="col-form-label form-control-sm small-label">Duration:</label>
                                            <select name="duration" id="duration" class="form-control form-control-sm">
                                                <option value="12">1 Year</option>
                                                <option value="6">6 Month</option>
                                                <option value="3">3 Month</option>
                                                <option value="1">1 Month</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save!</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="ViewDocument" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">View Document</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <style>
                            .small-label {
                                font-size: 0.8rem;
                                margin-top: -10px;
                            }

                            .form-control-sm {
                                height: calc(1.5em + 0.5rem + 2px);
                                /* Adjust the height as needed */
                                font-size: 0.8rem;
                                /* Smaller font size for smaller controls */
                                margin-top: -5px;
                                /* width: 75%; Adjust width as needed */
                            }
                        </style>

                        <div id="userDetailsContent">

                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="documnet" class="col-form-label text-sm small-label">Document Type:</label>
                                        <select name="docs" id="documnet" disabled class="form-control form-control-sm" required>
                                            <option value="Prescription (RX)">Prescription (RX)</option>
                                            <option value="CMN">CMN</option>
                                            <option value="Authorization">Authorization</option>
                                            <option value="Sleep Study">Sleep Study</option>
                                            <option value="Office Notes/Medical Records">Office Notes/Medical Records</option>
                                            <option value="Demographics">Demographics</option>
                                            <option value="Manufacturer Order Form">Manufacturer Order Form</option>
                                            <option value="Consignment Documents">Consignment Documents</option>
                                            <option value="Home Assessment">Home Assessment</option>
                                            <option value="7 Element Form">7 Element Form</option>
                                            <option value="Proof of Delivery">Proof of Delivery</option>
                                            <option value="Pickup Ticket">Pickup Ticket</option>
                                            <option value="Exchange Form">Exchange Form</option>
                                            <option value="Claims">Claims</option>
                                            <option value="Other">Other</option>
                                        </select>
                                    </div>

                                    <div class="inputSmall" id="docTypeView" style="display: none;">
                                        <select name="subDocView" id="subDocView" class="form-control form-control-sm" disabled>
                                            <option value="EOB">EOB</option>
                                            <option value="Denial letter">Denial letter</option>
                                            <option value="Appeals level 1">Appeals level 1</option>
                                            <option value="Appeals level 2">Appeals level 2</option>
                                            <option value="Approval letter">Approval letter</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="title" class="col-form-label small-label">Title:</label>
                                        <input type="text" readonly placeholder="Enter Title" class="form-control form-control-sm" id="title" name="title" required />
                                    </div>

                                    <div class="form-group">
                                        <label for="type" class="col-form-label small-label">Type:</label>
                                        <input readonly type="text" placeholder="Enter Type" class="form-control form-control-sm" id="type" name="type" required />
                                    </div>

                                    <div class="form-group">
                                        <label for="description" class="col-form-label small-label">Description:</label>
                                        <textarea readonly required placeholder="Enter Description" class="form-control form-control-sm" id="description" rows="2" cols="2" name="desc"></textarea>
                                    </div>

                                    <div class="form-group">
                                        <label for="ptName" class="col-form-label small-label">Patient Name:</label>
                                        <select required disabled name="ptName" id="ptName" class="form-control form-control-sm select2">
                                            <?php $__currentLoopData = $pati; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pa): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option <?php if($pa->id == $tp->id): ?>
                                                selected
                                                <?php endif; ?> value="<?php echo e($pa->id); ?>"><?php echo e($pa->name); ?>&nbsp;<?php echo e($pa->last_Name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="drOff" class="col-form-label small-label">Dr Office:</label>
                                        <select required id="drOff" disabled class="form-control form-control-sm">
                                            <?php $__currentLoopData = $doctor; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option <?php if($dr->id == $tp->Off_Name): ?>
                                                selected
                                                <?php endif; ?> disabled value="<?php echo e($dr->id); ?>" ><?php echo e($dr->Office_Name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="patientAcc" class="col-form-label small-label">Patient Acct#:</label>
                                        <input disabled type="text" required class="form-control form-control-sm" id="patientAcc" value="<?php echo e($tp->AccNumber); ?>" readonly name="patientAcc" required />
                                    </div>

                                    <div class="form-group">
                                        <label for="patientOrder" class="col-form-label small-label">Patient Order#:</label>
                                        <input disabled type="text" required class="form-control form-control-sm" id="patientOrder" value="<?php echo e($tp->Order_No); ?>" readonly name="patientOrder" required />
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="FDate" class="col-form-label small-label">ID#</label>
                                        <input readonly type="text" class="form-control form-control-sm" id="Order_IDView" />
                                    </div>
                                    <div class="form-group" style="display: flex; flex-direction: column; align-items: center; justify-content: center;">
                                        <img id="previewImageView" src="#" alt="Image Preview" style="max-width: 100%; height: auto;">
                                        <p id="fileMessage" style="display: none;"></p>
                                        <div style="margin-top: 10px; display: flex; justify-content: center; gap: 10px;">
                                            <a id="downloadButton" href="#" download class="btn btn-primary btn-sm" style="text-align: center;">Download</a>
                                            <button type="button" id="viewButton" class="btn btn-secondary btn-sm" style="text-align: center;">View</button>
                                            <button type="button" id="printButton" class="btn btn-success btn-sm" style="text-align: center;">Print</button>
                                        </div>
                                    </div>

                                    <div class="form-group" id="PFDView">
                                        <label for="FDateEdit" class="col-form-label small-label">Date of Service:</label>
                                        <input type="date" class="form-control form-control-sm" readonly id="PFDateView" readonly name="PFDateView" />
                                    </div>

                                    <div id="ConsDocView">
                                        <div class="form-group">
                                            <label for="TDate" class="col-form-label small-label">Date of Service:</label>
                                            <input type="date" class="form-control form-control-sm" readonly id="DOSView" name="DOSView" />
                                        </div>
                                    </div>

                                    <div id="RXD">
                                        <h4 class="small-label">Prescription (RX) Date:</h4>
                                        <div class="form-group">
                                            <label for="FDate" class="col-form-label small-label">From:</label>
                                            <input readonly type="date" class="form-control form-control-sm" id="FDate" name="FDate" />
                                        </div>
                                        <div class="form-group">
                                            <label for="TDate" class="col-form-label small-label">TO:</label>
                                            <input readonly type="date" class="form-control form-control-sm" id="TDate" name="TDate" />
                                        </div>
                                        <div class="form-group">
                                            <label for="duration" class="col-form-label small-label">Duration:</label>
                                            <select disabled name="duration" id="duration" class="form-control form-control-sm">
                                                <option value="1">1 Month</option>
                                                <option value="3">3 Month</option>
                                                <option value="6">6 Month</option>
                                                <option value="12">1 Year</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <ul class="list-unstyled arrow">
                                            <li class="text-sm" id="created">Created <span id="createdDate">loading...</span></li>
                                        </ul>
                                        <ul class="list-unstyled arrow" id="editList">
                                            <li class="text-sm" id="edit"><span id="editDate"></span></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="EditDocument" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Document</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <style>
                            .small-label {
                                font-size: 0.8rem;
                                margin-top: -10px;
                            }

                            .form-control-sm {
                                height: calc(1.5em + 0.5rem + 2px);
                                /* Adjust the height as needed */
                                font-size: 0.8rem;
                                /* Smaller font size for smaller controls */
                                margin-top: -5px;
                                /* width: 75%; Adjust width as needed */
                            }
                        </style>

                        <form method="post" id="EditDocumentForm" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <div class="row">
                                <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="documnet" class="col-form-label text-sm small-label">Document Type:</label>
                                        <select name="docs" id="documnetEdit" class="form-control form-control-sm" required>
                                            <option value="Prescription (RX)">Prescription (RX)</option>
                                            <option value="CMN">CMN</option>
                                            <option value="Authorization">Authorization</option>
                                            <?php if($tp->Dept == "5"): ?>
                                            <option value="Sleep Study">Sleep Study</option>
                                            <?php endif; ?>
                                            <option value="Office Notes/Medical Records">Office Notes/Medical Records</option>
                                            <option value="Demographics">Demographics</option>
                                            <option value="Manufacturer Order Form">Manufacturer Order Form</option>
                                            <?php if($tp->Dept == "4"): ?>
                                            <option value="Consignment Documents">Consignment Documents</option>
                                            <?php endif; ?>
                                            <option value="Home Assessment">Home Assessment</option>
                                            <option value="7 Element Form">7 Element Form</option>
                                            <option value="Proof of Delivery">Proof of Delivery</option>
                                            <option value="Pickup Ticket">Pickup Ticket</option>
                                            <option value="Exchange Form">Exchange Form</option>
                                            <option value="Claims">Claims</option>
                                            <option value="Other">Other</option>
                                        </select>
                                    </div>

                                    <div class="inputSmall" id="docTypeEdit" style="display: none;">
                                        <select name="subDocEdit" id="subDocEdit" class="form-control form-control-sm">
                                            <option value="EOB">EOB</option>
                                            <option value="Denial letter">Denial letter</option>
                                            <option value="Appeals level 1">Appeals level 1</option>
                                            <option value="Appeals level 2">Appeals level 2</option>
                                            <option value="Approval letter">Approval letter</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="title" class="col-form-label small-label">Title:</label>
                                        <input type="text" placeholder="Enter Title" class="form-control form-control-sm" id="title" name="title" required />
                                    </div>

                                    <div class="form-group">
                                        <label for="type" class="col-form-label small-label">Type:</label>
                                        <input type="text" placeholder="Enter Type" class="form-control form-control-sm" id="type" name="type" />
                                    </div>

                                    <div class="form-group">
                                        <label for="description" class="col-form-label small-label">Description:</label>
                                        <textarea placeholder="Enter Description" class="form-control form-control-sm" id="description" rows="2" cols="2" name="desc"></textarea>
                                    </div>

                                    <div class="form-group">
                                        <label for="ptName" class="col-form-label small-label">Patient Name:</label>
                                        <select required name="ptName" id="ptNameEdit" class="form-control form-control-sm">
                                            <?php $__currentLoopData = $pati; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pa): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option <?php if($pa->id == $tp->id): ?>
                                                selected
                                                <?php endif; ?> value="<?php echo e($pa->id); ?>"><?php echo e($pa->name); ?>&nbsp;<?php echo e($pa->last_Name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="drOff" class="col-form-label small-label">Dr Office:</label>
                                        <select required id="drOffEdit" name="drOffEdit" class="form-control form-control-sm">
                                            <?php $__currentLoopData = $doctor; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option <?php if($dr->id == $tp->Off_Name): ?>
                                                selected
                                                <?php endif; ?> disabled value="<?php echo e($dr->id); ?>" ><?php echo e($dr->Office_Name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                        <!-- <input type="hidden" name="drOff" id="drOffEdit" value="<?php echo e($tp->Off_Name); ?>"> -->
                                    </div>

                                    <div class="form-group">
                                        <label for="patientAcc" class="col-form-label small-label">Patient Acct#:</label>
                                        <input type="text" required class="form-control form-control-sm" id="patientAccEdit" value="<?php echo e($tp->AccNumber); ?>" readonly name="patientAcc" required />
                                    </div>

                                    <div class="form-group">
                                        <label for="patientOrder" class="col-form-label small-label">Patient Order#:</label>
                                        <input type="text" required class="form-control form-control-sm" id="patientOrderEdit" value="<?php echo e($tp->Order_No); ?>" readonly name="patientOrder" required />
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="fileUpload" class="form-label small-label">Upload File:</label>
                                        <input type="file" name="fileUploadEdit" class="form-control form-control-sm" id="fileUploadEdit" accept=".pdf, .heic, .jpeg, .jpg, .png, .tiff, .tif" />
                                    </div>
                                    <div class="form-group">
                                        <input type="hidden" name="ImgUploadEdit" class="form-control form-control-sm" id="ImgUploadEdit" />
                                        <img id="previewImageEdit" alt="Image Preview" style=" max-width: 100%; height: auto;" />
                                        <p id="fileMessageEdit" style="display: none;"></p>
                                    </div>

                                    <div class="form-group" id="PFDEdit">
                                        <label for="FDateEdit" class="col-form-label small-label">Date of Service:</label>
                                        <input type="date" class="form-control form-control-sm" id="PFDateEdit" name="PFDateEdit" />
                                    </div>
                                    <div id="ConsDocEdit">
                                        <div class="form-group">
                                            <label for="TDate" class="col-form-label small-label">Date of Service:</label>
                                            <input type="date" class="form-control form-control-sm" id="DOSEdit" name="DOSEdit" />
                                        </div>
                                    </div>

                                    <div id="RXEdit">
                                        <h4 class="small-label"><span id="DataeType">Prescription (RX) </span> Date:</h4>
                                        <div class="form-group">
                                            <label for="FDateEdit" class="col-form-label small-label">From:</label>
                                            <input type="date" class="form-control form-control-sm" id="FDateEdit" name="FDateEdit" />
                                        </div>
                                        <div class="form-group">
                                            <label for="TDateEdit" class="col-form-label small-label">TO:</label>
                                            <input type="date" class="form-control form-control-sm" id="TDateEdit" name="TDateEdit" />
                                        </div>
                                        <div class="form-group">
                                            <label for="duration" class="col-form-label small-label">Duration:</label>
                                            <select name="durationEdit" id="duration" class="form-control form-control-sm">
                                                <option value="1">1 Month</option>
                                                <option value="3">3 Month</option>
                                                <option value="6">6 Month</option>
                                                <option value="12">1 Year</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save!</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>


        <?php if(Session::has('fail')): ?>
        <script>
            Swal.fire({
                title: "Error",
                text: "No User Found in that department",
                icon: "error"
            });
        </script>
        <?php endif; ?>
        <?php if(Session::has('error')): ?>
        <script>
            Swal.fire({
                title: "Error",
                text: "<?php echo e(session('error')); ?>", // Make sure to enclose the PHP expression in quotes
                icon: "error"
            });
        </script>
        <?php endif; ?>

        <?php if(Session::has('payment')): ?>
        <script>
            Swal.fire({
                title: "Success",
                text: "<?php echo e(session('payment')); ?>", // Make sure to enclose the PHP expression in quotes
                icon: "success"
            });
        </script>
        <?php endif; ?>


        <script src="https://js.stripe.com/v3/"></script>

        <script>
            $('#NoteForm').on('submit', function(e) {
                this.submit();
            });

            function isPDF(url) {
                return url.match(/\.pdf$/i);
            }

            //Viewing document
            $(document).ready(function() {

                var table1 = $('#myTable').DataTable({
                    retrieve: true // Ensures DataTable does not reinitialize on subsequent tab switches
                });
                var table2 = $('#myTable2').DataTable({
                    retrieve: true
                });
                var table3 = $('#myTable3').DataTable({
                    retrieve: true
                });

                $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
                    var target = $(e.target).attr("href");
                    console.log("Switched to tab: " + target); // Debugging log

                    if (target === '#tab-4') {
                        table1.columns.adjust().draw(); // Adjust and redraw table1
                    } else if (target === '#tab-6') {
                        table2.columns.adjust().draw(); // Adjust and redraw table2
                    } else if (target === '#tab-10') {
                        table3.columns.adjust().draw(); // Adjust and redraw table3
                    }

                });



                $('.clickable-row').on('click', function() {
                    const modalId = $(this).data('target');
                    $(modalId).modal('show');
                });

                var userName = "";
                var userId = "";
                $('.edit-btn').on('click', function(event) {
                    event.stopPropagation(); // Stop the row click event
                    const modalId = $(this).data('target');
                    userId = $(this).data('id');
                    userName = $(this).data('name');
                    $('#ViewDocument').modal('hide');
                    $(modalId).modal('show');
                    console.log(modalId);
                });

                $('.delete-btn').on('click', function(event) {
                    event.stopPropagation();
                    const url = $(this).data('url');
                });


                $('#ViewDocument').on('show.bs.modal', function(event) {
                    var button = $(event.relatedTarget); // Button that triggered the modal
                    var userId = button.data('id'); // Extract info from data-* attributes
                    var userName = button.data('name');

                    var modal = $(this);
                    modal.find('.modal-title').text('View Details for ' + userName);

                    $.ajax({
                        url: '/getDocumentDetails/' + userId,
                        type: 'GET',
                        success: function(data) {
                            console.log("order id : " + data.Order_No);
                            // Now setting the fetched data into the modal fields
                            modal.find('#title').val(data.title);
                            modal.find('#type').val(data.type);
                            modal.find('#description').val(data.desc);
                            modal.find('#documnet').val(data.docType); // Adjust according to your actual JSON keys
                            modal.find('#ptName').val(data.ptName);
                            modal.find('#drOff').val(data.ptDr);
                            modal.find('#patientAcc').val(data.ptAcc);
                            modal.find('#patientOrder').val(data.ptOrder);
                            modal.find('#duration').val(data.freq);
                            modal.find('#FDate').val(data.fromDate);
                            modal.find('#TDate').val(data.toDate);
                            modal.find('#PFDateView').val(data.fromDate);
                            modal.find('#DOSView').val(data.DOS);
                            modal.find('#subDocView').val(data.subDocType);
                            modal.find('#Order_IDView').val(data.Order_No);

                            if (data.created_at) {
                                var date = new Date(data.created_at);
                                var formattedDate = "by " + data.upload + " at " + date.toLocaleString('en-US', {
                                    year: 'numeric',
                                    month: '2-digit',
                                    day: '2-digit',
                                    hour: '2-digit',
                                    minute: '2-digit',
                                    second: '2-digit',
                                    hour12: true
                                });
                                modal.find('#createdDate').text(formattedDate);
                            } else {
                                modal.find('#createdDate').text("Date not available");
                            }
                            const editList = modal.find('#editList');
                            editList.empty();
                            if (data.editName && data.editName.length > 0 && data.editTIme && data.editTIme.length > 0) {
                                for (let i = 0; i < data.editName.length; i++) {
                                    let editDate = new Date(data.editTIme[i]);
                                    let formattedDate = "Edited by " + data.editName[i] + " at " + editDate.toLocaleString('en-US', {
                                        year: 'numeric',
                                        month: '2-digit',
                                        day: '2-digit',
                                        hour: '2-digit',
                                        minute: '2-digit',
                                        second: '2-digit',
                                        hour12: true
                                    });
                                    // Append each edit as a list item
                                    editList.append('<li class="text-sm">' + formattedDate + '</li>');
                                }
                            } else {
                                // Optionally handle the case where there are no edits
                                editList.append();
                            }

                            var ViewUrl = "";
                            var imageUrl = "";

                            var documentsBaseUrl = "<?php echo e(url('documents')); ?>/";
                            var documentsViewBaseUrl = "<?php echo e(url('docs')); ?>/";
                            var documentIdentifier = data.img;
                            imageUrl = documentsBaseUrl + documentIdentifier;
                            ViewUrl = documentsViewBaseUrl + documentIdentifier;


                            if (isPDF(data.img)) {
                                renderImg = documentsBaseUrl + 'pdf.png';
                            } else {
                                renderImg = documentsBaseUrl + data.img;
                            }

                            modal.find('#previewImageView').attr('src', renderImg).attr('alt', 'File Preview');

                            var selectedDeptText1 = data.docType;
                            if (selectedDeptText1.includes("Prescription (RX)") || selectedDeptText1.includes("CMN") || selectedDeptText1.includes("Authorization")) { // Check if the text includes 'resupply'
                                $('#RXD').show();
                            } else {
                                $('#RXD').hide();
                            }
                            if (selectedDeptText1.includes("Claims")) { // Check if the text includes 'resupply'
                                $('#docTypeView').show();
                            } else {
                                $('#docTypeView').hide();
                            }
                            if (selectedDeptText1.includes("Proof of Delivery")) { // Check if the text includes 'resupply'
                                $('#PFDView').show();
                            } else {
                                $('#PFDView').hide();
                            }
                            if (selectedDeptText1.includes("Consignment Documents")) { // Check if the text includes 'resupply'
                                $('#ConsDocView').show();
                                $('#RXD').show();
                            } else {
                                // $('#RXD').hide();
                                $('#ConsDocView').hide();
                            }

                            var previewImage = document.getElementById('previewImageView');
                            var downloadButton = document.getElementById('downloadButton');
                            var printButton = document.getElementById('printButton');



                            // When the view button is clicked, perhaps just ensure it is visible or open in a new modal/window
                            document.getElementById('viewButton').addEventListener('click', function() {

                                $.ajax({
                                    url: '/getDocumentDetails/' + userId,
                                    type: 'GET',
                                    success: function(data) {
                                        var documentsViewBaseUrl = "<?php echo e(url('documents')); ?>/";
                                        var documentIdentifier = data.img;
                                        ViewUrl = documentsViewBaseUrl + documentIdentifier;

                                        if (data.img && previewImage.src !== '#') {
                                            window.open(ViewUrl, '_blank');
                                        } else {
                                            alert('No image to display.');
                                        }
                                    }
                                });
                            });

                            document.getElementById('printButton').addEventListener('click', function() {

                                $.ajax({
                                    url: '/getDocumentDetails/' + userId,
                                    type: 'GET',
                                    success: function(data) {
                                        var documentsViewBaseUrl = "<?php echo e(url('documents')); ?>/";
                                        var documentIdentifier = data.img;
                                        ViewUrl = documentsViewBaseUrl + documentIdentifier;
                                        var contentToPrint;
                                        if (data.img && previewImage.src !== '#') {
                                            if (isPDF(data.img)) {
                                                contentToPrint = '<iframe src="' + ViewUrl + '" frameborder="0" style="width:100%;height:100%;" onload="this.contentWindow.print();"></iframe>';
                                            } else {
                                                contentToPrint = '<img src="' + ViewUrl + '" style="width: 100%; height: auto;" onload="window.print();window.close();">';
                                            }
                                            var win = window.open('');
                                            win.document.write(contentToPrint);
                                            if (!isPDF(data.img)) {
                                                win.addEventListener('load', function() {
                                                    win.print();
                                                    win.close();
                                                });
                                            }
                                        } else {
                                            alert('No file to print.');
                                        }

                                    }
                                });

                            });


                            previewImage.addEventListener('load', function() {
                                if (data.img && previewImage.src !== '#') {
                                    downloadButton.href = imageUrl;
                                }
                            });

                        },
                        error: function() {
                            modal.find('#userDetailsContent').html('<p>An error occurred while fetching patient documents.</p>');
                        }
                    });
                });

                $('#EditDocument').on('show.bs.modal', function(event) {
                    var button = $(event.relatedTarget);
                    var form = $(this).find('#EditDocumentForm');
                    form.attr('action', "<?php echo e(url('EditDocument')); ?>/" + userId);
                    var modal = $(this);
                    modal.find('.modal-title').text('Edit Details for ' + userName);

                    $.ajax({
                        url: '/getDocumentDetails/' + userId,
                        type: 'GET',
                        success: function(data) {
                            modal.find('#title').val(data.title);
                            modal.find('#type').val(data.type);
                            modal.find('#description').val(data.desc);
                            modal.find('#documnetEdit').val(data.docType); // Adjust according to your actual JSON keys
                            modal.find('#ptName').val(data.ptName);
                            modal.find('#drOffEdit').val(data.ptDr);
                            modal.find('#patientAcc').val(data.ptAcc);
                            modal.find('#patientOrder').val(data.ptOrder);
                            modal.find('#durationEdit').val(data.freq);
                            modal.find('#FDateEdit').val(data.fromDate);
                            modal.find('#PFDateEdit').val(data.fromDate);
                            modal.find('#TDateEdit').val(data.toDate);
                            modal.find('#DOSEdit').val(data.DOS);
                            modal.find('#subDocEdit').val(data.subDocType);
                            modal.find('#ImgUploadEdit').val(data.img);
                            var documentsBaseUrl = "<?php echo e(asset('documents')); ?>/";
                            imageUrl = documentsBaseUrl + data.img;
                            if (isPDF(data.img)) {
                                renderImg = documentsBaseUrl + 'pdf.png';
                            } else {
                                renderImg = documentsBaseUrl + data.img;
                            }

                            modal.find('#previewImageEdit').attr('src', renderImg).attr('alt', 'File Preview');

                            console.log(data.subDocType);
                            var selectedDeptText1 = data.docType;
                            if (selectedDeptText1.includes("Prescription (RX)") || selectedDeptText1.includes("CMN") || selectedDeptText1.includes("Authorization")) { // Check if the text includes 'resupply'
                                $('#RXEdit').show();
                            } else {
                                $('#RXEdit').hide();
                            }


                            if (selectedDeptText1.includes("Proof of Delivery")) { // Check if the text includes 'resupply'
                                $('#PFDEdit').show();
                            } else {
                                $('#PFDEdit').hide();
                            }

                            if (selectedDeptText1.includes("Claims")) { // Check if the text includes 'resupply'
                                $('#docTypeEdit').show();
                            } else {
                                $('#docTypeEdit').hide();
                            }
                            if (selectedDeptText1.includes("Consignment Documents")) { // Check if the text includes 'resupply'
                                $('#ConsDocEdit').show();
                                $('#RXEdit').show();
                            } else {
                                // $('#RXEdit').hide();
                                $('#ConsDocEdit').hide();
                            }


                        },
                        error: function() {
                            // modal.find('#userDetailsContent').html('<p>An error occurred while fetching patient documents.</p>');
                        }
                    });
                });
            });


            $('#documnetEdit').change(function() {
                var selectedDeptText1 = $("#documnetEdit option:selected").text().toLowerCase(); // Get the text and convert to lowercase
                const Message = document.getElementById('DataeType');
                Message.textContent = 'Prescription (RX)';
                if (selectedDeptText1.includes("claims")) { // Check if the text includes 'resupply'
                    $('#docTypeEdit').show();
                } else {
                    $('#docTypeEdit').hide();
                }

                if (selectedDeptText1.includes("prescription (rx)") || selectedDeptText1.includes("cmn") || selectedDeptText1.includes("authorization")) { // Check if the text includes 'resupply'
                    $('#RXEdit').show();
                    if (selectedDeptText1.includes("authorization")) {
                        Message.textContent = 'Authorization';
                    }
                } else {
                    $('#RXEdit').hide();
                }
            });


            $('#documnet').change(function() {
                var selectedDeptText1 = $("#documnet option:selected").text().toLowerCase(); // Get the text and convert to lowercase
                const Message = document.getElementById('DataeType');
                Message.textContent = 'Prescription (RX)';
                if (selectedDeptText1.includes("prescription (rx)") || selectedDeptText1.includes("cmn") || selectedDeptText1.includes("authorization")) { // Check if the text includes 'resupply'
                    $('#RX').show();
                    if (selectedDeptText1.includes("authorization")) {
                        Message.textContent = 'Authorization';
                    }

                } else {
                    $('#RX').hide();
                }


                if (selectedDeptText1.includes("proof of delivery")) { // Check if the text includes 'resupply'
                    $('#PFDAdd').show();
                } else {
                    $('#PFDAdd').hide();
                }
                if (selectedDeptText1.includes("consignment documents")) { // Check if the text includes 'resupply'
                    $('#ConsDocAdd').show();
                    $('#RX').show();
                } else {
                    $('#ConsDocAdd').hide();
                }

                if (selectedDeptText1.includes("claims")) { // Check if the text includes 'resupply'
                    $('#docType').show();
                } else {
                    $('#docType').hide();
                }



            });


            document.addEventListener('DOMContentLoaded', function() {
                const form = document.getElementById('DocumentForm');
                const documentTypeSelect = document.getElementById('documnet');
                const subDocDiv = document.getElementById('docType');
                const subDocSelect = document.getElementById('SubDoc');
                const rxDateFrom = document.getElementById('FDate');
                const rxDateTo = document.getElementById('TDate');
                const DOS = document.getElementById('DOS');
                const RXDate = document.getElementById('RXDate');
                const ConsDocAdd = document.getElementById('ConsDocAdd');
                const PFDate = document.getElementById('PFDAdd');
                const PFDateIn = document.getElementById('PFDate');

                // Function to check and apply required attributes based on selected document type
                function updateRequiredFields() {
                    const docType = documentTypeSelect.value;
                    // Reset initial states
                    rxDateFrom.required = false;
                    rxDateTo.required = false;
                    RXDate.required = false;
                    DOS.required = false;
                    subDocSelect.required = false;
                    PFDateIn.required = false;
                    subDocDiv.style.display = 'none';
                    PFDate.style.display = 'none';
                    ConsDocAdd.style.display = 'none';

                    if (docType === 'Prescription (RX)' || docType === 'CMN' || docType === 'Authorization') {
                        rxDateFrom.required = true;
                        rxDateTo.required = true;
                    } else if (docType === 'Claims') {
                        subDocDiv.style.display = 'block';
                        subDocSelect.required = true;
                    } else if (docType === "Proof of Delivery") { // Check if the text includes 'resupply'
                        PFDate.style.display = 'block';
                        PFDateIn.required = true;
                    } else if (docType === "Consignment Documents") { // Check if the text includes 'resupply'
                        ConsDocAdd.style.display = 'block';
                        DOS.required = true;
                        rxDateFrom.required = true;
                        rxDateTo.required = true;
                    }
                }

                // Initial check on page load
                updateRequiredFields();
                // Event listener for change on document type select
                documentTypeSelect.addEventListener('change', updateRequiredFields);
            });

            document.getElementById('ptName').addEventListener('change', function() {
                var patientId = this.value;
                fetch(`/get-patient-details/${patientId}`)
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById('drOff').value = data.office_id;
                        document.getElementById('patientAcc').value = data.account_number;
                        document.getElementById('patientOrder').value = data.order_number;

                        // Select the dropdown
                        const select = document.getElementById('documnet');

                        // Convert options to an array and remove specific options
                        Array.from(select.options).forEach(option => {
                            if (option.value === "Sleep Study" || option.value === "Consignment Documents") {
                                select.removeChild(option);
                            }
                        });

                        // Append new options if department is 5
                        if (data.Dept === "5") {
                            const sleepStudyOption = new Option("Sleep Study", "Sleep Study");
                            select.add(sleepStudyOption);
                        }

                        if (data.Dept === "4") {
                            const sleepStudyOption = new Option("Consignment Documents", "Consignment Documents");
                            select.add(sleepStudyOption);
                        }

                        console.log('Office ID:', data.Dept);
                    })
                    .catch(error => console.error('Error fetching data: ', error));
            });

            document.getElementById('ptNameEdit').addEventListener('change', function() {
                var patientId = this.value;
                fetch(`/get-patient-details/${patientId}`)
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById('drOffEdit').value = data.office_id;
                        document.getElementById('patientAccEdit').value = data.account_number;
                        document.getElementById('patientOrderEdit').value = data.order_number;

                        // Select the dropdown
                        const select = document.getElementById('documnet');

                        // Convert options to an array and remove specific options
                        Array.from(select.options).forEach(option => {
                            if (option.value === "Sleep Study" || option.value === "Consignment Documents") {
                                select.removeChild(option);
                            }
                        });

                        // Append new options if department is 5
                        if (data.Dept === "5") {
                            const sleepStudyOption = new Option("Sleep Study", "Sleep Study");
                            select.add(sleepStudyOption);
                        }

                        if (data.Dept === "4") {
                            const sleepStudyOption = new Option("Consignment Documents", "Consignment Documents");
                            select.add(sleepStudyOption);
                        }

                        console.log('Office ID:', data.Dept);
                    })
                    .catch(error => console.error('Error fetching data: ', error));
            });

            document.getElementById('fileUploadEdit').addEventListener('change', function(event) {
                const file = event.target.files[0];
                const imgElement = document.getElementById('previewImageEdit');
                const fileMessage = document.getElementById('fileMessageEdit');
                const fileImg = document.getElementById('ImgUploadEdit');

                if (file) {
                    const fileType = file.type;
                    fileImg.value = file.name;
                    const validImageTypes = ['image/jpeg', 'image/png', 'image/tiff', 'image/heic'];
                    if (validImageTypes.includes(fileType)) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            imgElement.src = e.target.result;
                            imgElement.style.display = 'block';
                            fileMessage.style.display = 'none';
                            // fileImg.value = e.target.result;
                        };
                        reader.readAsDataURL(file);
                    } else {
                        var documentsBaseUrl = "<?php echo e(asset('documents')); ?>/";
                        var renderImg = documentsBaseUrl + 'pdf.png';
                        imgElement.src = renderImg;
                        imgElement.style.display = 'block'; // Hide the image element if not an image file
                        fileMessage.textContent = 'No preview available for PDFs.';
                        fileMessage.style.display = 'block'; // Show the message for non-image files
                    }
                }
            });


            $('select[name="durationEdit"], input[name="FDateEdit"]').on('change input', function() {
                var duration = parseInt($('select[name="durationEdit"]').val());
                var isYear = (duration === 12); // Check if the duration is in years

                var startDate = $('input[name="FDateEdit"]').val();

                if (!isNaN(duration) && startDate) {
                    var nextResupplyDate = new Date(startDate);

                    if (isYear) {
                        nextResupplyDate.setFullYear(nextResupplyDate.getFullYear() + 1);
                    } else {
                        nextResupplyDate.setMonth(nextResupplyDate.getMonth() + duration);
                    }

                    var nextResupplyDateFormatted = nextResupplyDate.toISOString().split('T')[0];
                    $('input[name="TDateEdit"]').val(nextResupplyDateFormatted);
                }
            });



            $(document).ready(function() {
                logAction("Patient Detail Page Loaded");
            });
        </script>





        <script>
            document.getElementById('fileUpload').addEventListener('change', function(event) {
                const file = event.target.files[0];
                const imgElement = document.getElementById('previewImage');
                const fileMessage = document.getElementById('fileMessage');

                if (file) {
                    const fileType = file.type;
                    const validImageTypes = ['image/jpeg', 'image/png', 'image/tiff', 'image/heic'];
                    if (validImageTypes.includes(fileType)) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            imgElement.src = e.target.result;
                            imgElement.style.display = 'block';
                            fileMessage.style.display = 'none';
                        };
                        reader.readAsDataURL(file);
                    } else {
                        var documentsBaseUrl = "<?php echo e(asset('documents')); ?>/";
                        var renderImg = documentsBaseUrl + 'pdf.png';
                        imgElement.src = renderImg;
                        imgElement.style.display = 'block'; // Hide the image element if not an image file
                        fileMessage.textContent = 'No preview available for PDFs.';
                        fileMessage.style.display = 'block'; // Show the message for non-image files
                    }
                }
            });


            $('select[name="duration"], input[name="FDate"]').on('change input', function() {
                var duration = parseInt($('select[name="duration"]').val());
                var isYear = (duration === 12);
                var startDate = $('input[name="FDate"]').val();
                if (!isNaN(duration) && startDate) {
                    var nextResupplyDate = new Date(startDate);
                    if (isYear) {
                        nextResupplyDate.setFullYear(nextResupplyDate.getFullYear() + 1);
                    } else {
                        nextResupplyDate.setMonth(nextResupplyDate.getMonth() + duration);
                    }
                    var nextResupplyDateFormatted = nextResupplyDate.toISOString().split('T')[0];
                    $('input[name="TDate"]').val(nextResupplyDateFormatted);
                }
            });



            $(document).ready(function() {


                var allValid = true;
                invalidDates = [];

                function checkDates() {
                    $('#dates').each(function() {
                        var label = $(this).attr('data-label'); // Get the label associated with the input
                        if (!$(this).val() && new Date($(this).val()) < new Date()) {
                            allValid = false;
                            console.log(label);
                        }
                    });
                }


                document.addEventListener('DOMContentLoaded', function() {

                    $('#updatePatientForm').on('submit', function(e) {
                        e.preventDefault();
                        var deptIsFive = $('#deptValue').val() == "5";

                        var sleepStudyChecked = $('#sleep-study-checkbox').is(':checked');
                        var nonSleepStudyChecked = $('#non-sleep-study-checkbox').is(':checked');
                        var AuthRequired = $('#AuthRequired').is(':checked');
                        var AuthNotRequired = $('#AuthNotRequired').is(':checked');

                        var atLeastOneSleepChecked = sleepStudyChecked || nonSleepStudyChecked;
                        var atLeastOneAuthChecked = AuthRequired || AuthNotRequired;

                        var allGeneralCheckboxesChecked = true;
                        $('#PatientDetail-checkboxes input[type="checkbox"]:not(#AuthRequired, #AuthNotRequired' + (deptIsFive ? ', #sleep-study-checkbox, #non-sleep-study-checkbox' : '') + ')').each(function() {
                            if (!$(this).is(':checked')) {
                                allGeneralCheckboxesChecked = false;
                            }
                        });


                        if ($('#status-dropdown').val() == '13') {

                            if (!allGeneralCheckboxesChecked || !atLeastOneAuthChecked) {
                                Swal.fire({
                                    title: "Error",
                                    text: "Please check all required checkboxes before submitting.",
                                    icon: "error"
                                });
                                return; // Stop form submission
                            }

                            if (deptIsFive) {
                                if (!atLeastOneSleepChecked) {
                                    Swal.fire({
                                        title: "Error",
                                        text: "Please select at least one sleep study option before submitting.",
                                        icon: "error"
                                    });
                                    return; // Stop form submission
                                }
                            }
                        }
                        this.submit(); // Proceed with form submission
                    });
                });


            });



            $(document).ready(function() {
                $('select[name="newfrequency"], input[name="redate"]').on('change input', function() {
                    var frequency = parseInt($('select[name="newfrequency"]').val());


                    var resupplyDate = $('input[name="redate"]').val();
                    if (!isNaN(frequency) && resupplyDate) {
                        var nextResupplyDate = new Date(resupplyDate);
                        nextResupplyDate.setDate(nextResupplyDate.getDate() + frequency);
                        var nextResupplyDateFormatted = nextResupplyDate.toISOString().split('T')[0];
                        $('input[name="newredate"]').val(nextResupplyDateFormatted);
                    }
                });





                $('#updatePatientForm').submit(function(e) {
                    if ($('#status-dropdown').val() == '5') {
                        let allFilled = true;
                        if (!$('input[name="redate"]').val()) {
                            allFilled = false;
                            Swal.fire({
                                title: "Error",
                                text: "Please Select the resupply date before submitting",
                                icon: "error"
                            });
                        }
                        if (!$('select[name="newfrequency"]').val()) {
                            allFilled = false;
                            Swal.fire({
                                title: "Error",
                                text: "Please Select the resupply date frequency before submitting",
                                icon: "error"
                            });
                        }
                        if (!allFilled) {
                            e.preventDefault(); // Prevent form submission
                        }
                    }
                });
            });



            var stripe = Stripe('pk_test_51Pg50ZRrLyBj0JJ2jRhqHYX0T1Q5McD0JlVwoXDLtXoOuhkYmXkobVIb9rBy2TavCxbEh5wKRbmG82J9VQq6kRKU00pQaQh3mW');
            var elements = stripe.elements();
            var style = {
                base: {
                    color: '#32325d',
                    fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                    fontSmoothing: 'antialiased',
                    fontSize: '16px',
                    '::placeholder': {
                        color: '#aab7c4'
                    }
                },
                invalid: {
                    color: '#fa755a',
                    iconColor: '#fa755a'
                }
            };

            $('#submit-button').on('click', function() {
                // Show the spinner
                $('#spinner').show();
                $(this).prop('disabled', true);
            });


            var cardElement = elements.create('card', {
                style: style
            });

            cardElement.mount('#card-element');

            var form = document.getElementById('payment-form');
            var errorMessage = document.getElementById('errorMessage');

            document.getElementById('submit-button').addEventListener('click', function(event) {
                event.preventDefault();

                stripe.createToken(cardElement).then(function(result) {
                    if (result.error) {
                        // Display the error in the UI
                        errorMessage.style.display = 'block';
                        errorMessage.textContent = result.error.message;
                    } else {
                        // Send the token to your server
                        var hiddenInput = document.getElementById('stripeToken');

                        hiddenInput.value = result.token.id;
                        form.submit();
                    }
                });
            });

            $('#show-predefined-notes').click(function() {
                var notesContainer = $('#predefined-notes-container');
                if (notesContainer.css('display') === 'none') {
                    notesContainer.css('display', 'block');
                } else {
                    notesContainer.css('display', 'none');
                }
            });

            $('.note-bubble').click(function() {
                var note = $(this).data('note');
                var currentText = $('#message-text').val();
                $('#message-text').val(currentText + (currentText ? ' ' : '') + note);
            });

            function openNoteModal(button) {
                var id = $(button).data('id'); // Get the ID from the data-id attribute
                console.log(id);
                $('#note-id').val(id);

                $('#AddNote').modal('show'); // Show the modal
            }

            function openDocumentModal(button) {
                var id = $(button).data('id'); // Get the ID from the data-id attribute
                $('#document-id').val(id); // Set the ID in the modal title or wherever necessary
                $('#AddDocument').modal('show'); // Show the modal
            }
        </script>



        <!-- $.ajax({
    url: '/your-payment-endpoint',
    method: 'POST',
    data: { token: result.token.id },
    success: function(response) {
        // Payment succeeded, redirect or show a success message
    },
    error: function(error) {
        // Handle error, hide the spinner, and re-enable the button
        $('#spinner').hide();
        $('#pay-button').prop('disabled', false);
        alert('Payment failed: ' + error.message);
    }
}); -->
<?php /**PATH D:\purana xammp\htdocs\ecommerce-laravel\data-mangment2\resources\views/PatientDetail.blade.php ENDPATH**/ ?>
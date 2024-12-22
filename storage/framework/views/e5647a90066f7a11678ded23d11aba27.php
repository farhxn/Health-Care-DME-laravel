<?php $__env->startSection('title', 'Invoice Detail'); ?>
<?php echo $__env->make('layout.Head', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<div class="dashboard-wrapper">
    <div class="dashboard-ecommerce">
        <div class="container-fluid dashboard-content">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="page-header d-flex align-items-center justify-content-between">
                        <h2 class="pageheader-title">Invoice Detail</h2>
                        <div class="ml-auto text-right">
                        </div>
                    </div>
                </div>
            </div>


            <div class="ecommerce-widget">

                <div class="row">
                    <div class="offset col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="row">


                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 m-b-60 mt-3">
                                <div class="simple-card">
                                    <ul class="nav nav-tabs" id="myTab5" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="product-tab-1" data-toggle="tab" href="#tab-1" role="tab" aria-controls="product-tab-1" aria-selected="false">Details</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link " id="product-tab-1" data-toggle="tab" href="#tab-2" role="tab" aria-controls="product-tab-1" aria-selected="false">Transaction</a>
                                        </li>
                                    </ul>

                                    <div class="tab-content" id="myTabContent5">
                                        <div class="tab-pane fade show  active" id="tab-1" role="tabpanel" aria-labelledby="product-tab-1">
                                            <div class="row">
                                                <div class="col">
                                                    <div>
                                                        <form action="<?php echo e(url('updateInvoiceDetail',isset($invoiceDetail) ? $invoiceDetail->id :0)); ?>" method="post">
                                                            <?php echo csrf_field(); ?>
                                                            <div class="row">
                                                                <div class="col">
                                                                    <div class="form-group">
                                                                        <label class="col-form-label form-control-sm">Inventory Item</label>
                                                                        <div class="input-group mb-3">
                                                                            <input type="text" required disabled class="form-control form-control-sm" value="<?php echo e(isset($invoiceDetail) ? $itemName : old('Item')); ?>" style="box-sizing: border-box;">
                                                                        </div>
                                                                        <span>
                                                                            <small class="text-danger font-weight-light font-italic">
                                                                                <?php $__errorArgs = ['Item'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                                                $message
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
                                                                        <label class="col-form-label form-control-sm">Total Balance</label>
                                                                        <div class="input-group mb-3">
                                                                            <input type="text" required placeholder="Balance" name="Balance" class="form-control form-control-sm" value="<?php echo e(isset($invoiceDetail) ? $invoiceDetail->Balance : old('Balance')); ?> " style="box-sizing: border-box;">
                                                                        </div>
                                                                        <span>
                                                                            <small class="text-danger font-weight-light font-italic">
                                                                                <?php $__errorArgs = ['Balance'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                                                $message
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
                                                                        <label class="col-form-label form-control-sm">Billing Code</label>
                                                                        <div class="input-group mb-3">
                                                                            <input type="text" required name="BillingCode" class="form-control form-control-sm" value="<?php echo e(isset($invoiceDetail) ? $invoiceDetail->BillingCode : old('BillingCode')); ?> " style="box-sizing: border-box;">
                                                                        </div>
                                                                        <span>
                                                                            <small class="text-danger font-weight-light font-italic">
                                                                                <?php $__errorArgs = ['BillingCode'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                                                $message
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
                                                                        <label class="col-form-label form-control-sm">Invoice Date</label>
                                                                        <div class="input-group mb-3">
                                                                            <input type="date" required placeholder="InvoiceDate" name="InvoiceDate"
                                                                                class="form-control form-control-sm"
                                                                                value="<?php echo e(isset($invoiceDetail) && $invoiceDetail->created_at ? $invoiceDetail->created_at->format('Y-m-d') : old('InvoiceDate')); ?>"
                                                                                style="box-sizing: border-box;">

                                                                        </div>
                                                                        <span>
                                                                            <small class="text-danger font-weight-light font-italic">
                                                                                <?php $__errorArgs = ['InvoiceDate'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                                                $message
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
                                                                    <!-- HAO Section -->
                                                                    <div class="form-group">
                                                                        <label class="col-form-label form-control-sm">HAO</label>
                                                                        <div class="input-group mb-3">
                                                                            <textarea name="HAO" class="form-control" rows="5" style="width: 100%;"><?php echo e(isset($invoiceDetail) ? $invoiceDetail->HAO : old('HAO')); ?></textarea>
                                                                        </div>
                                                                        <span>
                                                                            <small class="text-danger font-weight-light font-italic">
                                                                                <?php $__errorArgs = ['BillingCode'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <?php echo e($message); ?> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                                            </small>
                                                                        </span>
                                                                    </div>


                                                                    <div class="form-group">
                                                                        <label class="col-form-label form-control-sm">Modifiers</label>
                                                                        <div class="input-group mb-3">
                                                                            <input type="text" name="Modifier1" id="modifier1" maxlength="2" class="form-control form-control-sm requiredField mx-1" style="max-width: 50px;" required value="<?php echo e(isset($invoiceDetail) ? $invoiceDetail->Modifier1 : old('Modifier1')); ?>">

                                                                            <input type="text" name="Modifier2" id="modifier2" maxlength="2" class="form-control form-control-sm requiredField mx-1" style="max-width: 50px;" required value="<?php echo e(isset($invoiceDetail) ? $invoiceDetail->Modifier2 : old('Modifier2')); ?>">

                                                                            <input type="text" name="Modifier3" id="modifier3" maxlength="2" class="form-control form-control-sm requiredField mx-1" style="max-width: 50px;" required value="<?php echo e(isset($invoiceDetail) ? $invoiceDetail->Modifier3 : old('Modifier3')); ?>">

                                                                            <input type="text" name="Modifier4" id="modifier4" maxlength="2" class="form-control form-control-sm requiredField mx-1" style="max-width: 50px;" required value="<?php echo e(isset($invoiceDetail) ? $invoiceDetail->Modifier4 : old('Modifier4')); ?>">

                                                                        </div>
                                                                        <span>
                                                                            <small class="text-danger font-weight-light font-italic">
                                                                                <?php $__errorArgs = ['Modifier1'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <?php echo e($message); ?> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                                                <?php $__errorArgs = ['Modifier2'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <?php echo e($message); ?> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                                                <?php $__errorArgs = ['Modifier3'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <?php echo e($message); ?> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                                                <?php $__errorArgs = ['Modifier4'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <?php echo e($message); ?> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                                            </small>
                                                                        </span>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label class="col-form-label form-control-sm">Billable Amount</label>
                                                                        <div class="input-group mb-3">
                                                                            <input type="text" required placeholder="BillableAmount" name="BillableAmount" class="form-control form-control-sm" value=" <?php echo e(isset($invoiceDetail) ? $invoiceDetail->BillableAmount : old('BillableAmount')); ?> " style="box-sizing: border-box;">
                                                                        </div>
                                                                        <span>
                                                                            <small class="text-danger font-weight-light font-italic">
                                                                                <?php $__errorArgs = ['BillableAmount'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                                                $message
                                                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                                            </small>
                                                                        </span>
                                                                    </div>

                                                                </div>

                                                                <div class="col">
                                                                    <div class="card" style="border: 1px solid black;">
                                                                        <div class="card-body">
                                                                            <h5 class="card-title text-center">Date Of Service</h5>

                                                                            <!-- From Date -->
                                                                            <div class="form-group">
                                                                                <label class="col-form-label form-control-sm">From</label>
                                                                                <div class="input-group mb-3">
                                                                                    <input type="date" required placeholder="From" name="From"
                                                                                        class="form-control form-control-sm"
                                                                                        value="<?php echo e(isset($invoiceDetail) && $invoiceDetail->From ? date('Y-m-d', strtotime($invoiceDetail->From)) : old('From')); ?>"
                                                                                        style="box-sizing: border-box;">

                                                                                </div>
                                                                                <span>
                                                                                    <small class="text-danger font-weight-light font-italic">
                                                                                        <?php $__errorArgs = ['DOSFrom'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <?php echo e($message); ?> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                                                    </small>
                                                                                </span>
                                                                            </div>

                                                                            <div class="form-group">
                                                                                <label class="col-form-label form-control-sm">To</label>
                                                                                <div class="input-group mb-3">
                                                                                    <input type="date" required placeholder="To" name="To"
                                                                                        class="form-control form-control-sm"
                                                                                        value="<?php echo e(isset($invoiceDetail) && $invoiceDetail->To ? date('Y-m-d', strtotime($invoiceDetail->To)) : old('To')); ?>"
                                                                                        style="box-sizing: border-box;">

                                                                                </div>
                                                                                <span>
                                                                                    <small class="text-danger font-weight-light font-italic">
                                                                                        <?php $__errorArgs = ['To'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <?php echo e($message); ?> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                                                    </small>
                                                                                </span>
                                                                            </div>

                                                                            <!-- Billing Month -->
                                                                            <div class="form-group">
                                                                                <label class="col-form-label form-control-sm">Billing Month</label>
                                                                                <div class="input-group mb-3">
                                                                                    <input type="text" required placeholder="Billing Month" id="BillingMonth" name="BillingMonth" class="form-control form-control-sm requiredField" value="<?php echo e(isset($invoiceDetail) ? $invoiceDetail->BillingMonth : old('BillingMonth')); ?>">
                                                                                </div>
                                                                                <span>
                                                                                    <small class="text-danger font-weight-light font-italic">
                                                                                        <?php $__errorArgs = ['BillingMonth'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <?php echo e($message); ?> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                                                    </small>
                                                                                </span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col">
                                                                    <div class="form-group">
                                                                        <label class="col-form-label form-control-sm">Allowed Amount</label>
                                                                        <div class="input-group mb-3">
                                                                            <input type="text" required placeholder="Allowed Amount" name="AllowedAmount" class="form-control form-control-sm" value=" <?php echo e(isset($invoiceDetail) ? $invoiceDetail->AllowedAmount : old('AllowedAmount')); ?> " style="box-sizing: border-box;">
                                                                        </div>
                                                                        <span>
                                                                            <small class="text-danger font-weight-light font-italic">
                                                                                <?php $__errorArgs = ['AllowedAmount'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                                                $message
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
                                                                        <label class="col-form-label form-control-sm">Quantity</label>
                                                                        <div class="input-group mb-3">
                                                                            <input type="text" required placeholder="Quantity" name="Quantity" class="form-control form-control-sm" value=" <?php echo e(isset($invoiceDetail) ? $invoiceDetail->Quantity : old('Quantity')); ?> " style="box-sizing: border-box;">
                                                                        </div>
                                                                        <span>
                                                                            <small class="text-danger font-weight-light font-italic">
                                                                                <?php $__errorArgs = ['Quantity'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                                                $message
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
                                                                        <label class="col-form-label form-control-sm">Taxes</label>
                                                                        <div class="input-group mb-3">
                                                                            <input type="text" required placeholder="Taxes" name="Taxes" class="form-control form-control-sm" value=" <?php echo e(isset($invoiceDetail) ? $invoiceDetail->Taxes : old('Taxes')); ?> " style="box-sizing: border-box;">
                                                                        </div>
                                                                        <span>
                                                                            <small class="text-danger font-weight-light font-italic">
                                                                                <?php $__errorArgs = ['Taxes'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                                                $message
                                                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                                            </small>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="row m-3">
                                                                <label>Billing</label>
                                                                <div class="col">
                                                                    <label class="custom-control custom-checkbox">
                                                                        <div class="custom-control custom-checkbox">
                                                                            <input type="checkbox" class="custom-control-input" id="Ins1Checkbox" name="Ins1"
                                                                                <?php echo e(isset($invoiceDetail) && $invoiceDetail->Ins1 ? 'checked' : ''); ?>>
                                                                            <label class="custom-control-label" for="Ins1Checkbox">Ins 1</label>
                                                                        </div>

                                                                    </label>
                                                                </div>

                                                                <div class="col">
                                                                    <label class="custom-control custom-checkbox">
                                                                        <input type="checkbox" class="custom-control-input" name="Ins2" <?php echo e(isset($invoiceDetail) && $invoiceDetail->Ins2 ? 'checked' : ''); ?>>
                                                                        <span class="custom-control-label">Ins 2</span>
                                                                    </label>
                                                                </div>

                                                                <div class="col">
                                                                    <label class="custom-control custom-checkbox">
                                                                        <input type="checkbox" class="custom-control-input" name="Ins3" <?php echo e(isset($invoiceDetail) && $invoiceDetail->Ins3 ? 'checked' : ''); ?>>
                                                                        <span class="custom-control-label">Bill&nbsp;To&nbsp;Ins 3</span>
                                                                    </label>
                                                                </div>

                                                                <div class="col">
                                                                    <label class="custom-control custom-checkbox">
                                                                        <input type="checkbox" class="custom-control-input" name="Ins4" <?php echo e(isset($invoiceDetail) && $invoiceDetail->Ins4 ? 'checked' : ''); ?>>
                                                                        <span class="custom-control-label">Ins 4</span>
                                                                    </label>
                                                                </div>

                                                                <div class="col">
                                                                    <label class="custom-control custom-checkbox">
                                                                        <input type="checkbox" class="custom-control-input" name="NoPay" <?php echo e(isset($invoiceDetail) && $invoiceDetail->NoPay ? 'checked' : ''); ?>>
                                                                        <span class="custom-control-label">No Pay Ins 1</span>
                                                                    </label>
                                                                </div>
                                                            </div>


                                                            <div class="row">
                                                                <div class="col">
                                                                    <div class="form-group">
                                                                        <label class="col-form-label form-control-sm">DX Pointer 10</label>
                                                                        <div class="input-group mb-3">
                                                                            <input type="text" required placeholder="DX Pointer 10" id="DXPointer10" name="Dx10" class="form-control form-control-sm requiredField" value="<?php echo e(isset($invoiceDetail) ? $invoiceDetail->Dx10 : old('Dx10')); ?>">
                                                                        </div>
                                                                        <span><small class="text-danger font-weight-light font-italic">
                                                                                <?php $__errorArgs = ['Dx10'];
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
                                                                        <label class="col-form-label form-control-sm">Prior Auth Type</label>
                                                                        <div class="input-group mb-3">
                                                                            <select class="form-control form-control-sm requiredField" required id="PriorAuthType" name="PriorAuthType">

                                                                                <option value="P.O. Number" <?php echo e(old('PriorAuthType', $invoiceDetail->PriorAuthType ?? '') == 'P.O. Number' ? 'selected' : ''); ?>>P.O. Number</option>

                                                                                <option value="Prior Auth" <?php echo e(old('PriorAuthType', $invoiceDetail->PriorAuthType ?? '') == 'Prior Auth' ? 'selected' : ''); ?>>Prior Auth </option>
                                                                            </select>
                                                                        </div>
                                                                        <span>
                                                                            <small class="text-danger font-weight-light font-italic">
                                                                                <?php $__errorArgs = ['PriorAuthType'];
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
                                                                        <label class="col-form-label form-control-sm">Prior Auth #</label>
                                                                        <div class="input-group mb-3">
                                                                            <input type="text" required id="PriorAuthModal" name="PriorAuth" class="form-control form-control-sm requiredField" value="<?php echo e(isset($invoiceDetail) ? $invoiceDetail->PriorAuth : old('PriorAuth')); ?>">
                                                                        </div>
                                                                        <span><small class="text-danger font-weight-light font-italic">
                                                                                <?php $__errorArgs = ['PriorAuth'];
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
                                                            </div>

                                                            <div class="row">
                                                                <div class="col">
                                                                    <div class="form-group">
                                                                        <label class="col-form-label form-control-sm">Special Code</label>
                                                                        <div class="input-group mb-3">
                                                                            <input type="text" required placeholder="Special Code" name="SpecialCode" class="form-control form-control-sm" value=" <?php echo e(isset($invoiceDetail) ? $invoiceDetail->SpecialCode : old('SpecialCode')); ?> " style="box-sizing: border-box;">
                                                                        </div>
                                                                        <span>
                                                                            <small class="text-danger font-weight-light font-italic">
                                                                                <?php $__errorArgs = ['SpecialCode'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                                                $message
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
                                                                        <label class="col-form-label form-control-sm">Review Code</label>
                                                                        <div class="input-group mb-3">
                                                                            <input type="text" required placeholder="Review Code" name="ReviewCode" class="form-control form-control-sm" value=" <?php echo e(isset($invoiceDetail) ? $invoiceDetail->ReviewCode : old('ReviewCode')); ?> " style="box-sizing: border-box;">
                                                                        </div>
                                                                        <span>
                                                                            <small class="text-danger font-weight-light font-italic">
                                                                                <?php $__errorArgs = ['ReviewCode'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                                                $message
                                                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                                            </small>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <div class="col">
                                                                    <label>CMN/RX</label>
                                                                    <label class="custom-control custom-checkbox">
                                                                        <input type="checkbox" class="custom-control-input" id="invoice" name="CMNRX" <?php echo e(isset($invoiceDetail) && $invoiceDetail->CMNRX ? 'checked' : ''); ?>>
                                                                        <span class="custom-control-label">Send&nbsp;CMN/RX&nbsp;with&nbsp;this&nbsp;invoice</span>
                                                                    </label>
                                                                    <label class="custom-control custom-checkbox">
                                                                        <input type="checkbox" class="custom-control-input" name="AcceptAssignment" <?php echo e(isset($invoiceDetail) && $invoiceDetail->AcceptAssignment ? 'checked' : ''); ?>>
                                                                        <span class="custom-control-label">Accept&nbsp;Assignment</span>
                                                                    </label>
                                                                    <label class="custom-control custom-checkbox">
                                                                        <input type="checkbox" class="custom-control-input" checked disabled>
                                                                        <span class="custom-control-label">Hardship</span>
                                                                    </label>
                                                                </div>
                                                            </div>

                                                            <button type="submit" class=" ml-1 btn btn-primary btn-block">Save</button>
                                                        </form>
                                                    </div>


                                                </div>
                                            </div>

                                        </div>


                                        <div class="tab-pane fade " id="tab-2" role="tabpanel" aria-labelledby="product-tab-1">
                                            <div class="row">
                                                <div class="col">
                                                    <a href="/NewPayment/<?php echo e(isset($invoiceDetail) ? $invoiceDetail->id :0); ?>/0" class=" ml-1 btn btn-primary btn-block">Payment</a>
                                                </div>
                                                <div class="col">
                                                    <a href="/InvoiceTransaction/<?php echo e(isset($invoiceDetail) ? $invoiceDetail->id :0); ?>/0/1" class=" ml-1 btn btn-primary btn-block">Write Off</a>
                                                </div>
                                                <div class="col">
                                                    <a href="/InvoiceTransaction/<?php echo e(isset($invoiceDetail) ? $invoiceDetail->id :0); ?>/0/2" class=" ml-1 btn btn-primary btn-block">Change Payer</a>
                                                </div>
                                                <div class="col">
                                                    <a href="/InvoiceTransaction/<?php echo e(isset($invoiceDetail) ? $invoiceDetail->id :0); ?>/0/0" class=" ml-1 btn btn-primary btn-block">Transaction</a>
                                                </div>
                                            </div>
                                            <br>
                                            <table class="table display" id="myTable">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">S.No</th>
                                                        <th scope="col">Invoice#</th>
                                                        <th scope="col">Type</th>
                                                        <th scope="col">Ins Company</th>
                                                        <th scope="col">Date</th>
                                                        <th scope="col">Amount</th>
                                                        <th scope="col">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $sno = 1;
                                                    ?>
                                                    <?php $__currentLoopData = $transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tran): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <tr class="txt-sm ">
                                                        <td><?php echo e($sno++); ?></td>
                                                        <td><?php echo e($tran->InvoiceNumber); ?></td>
                                                        <td><?php echo e($tran->Tran); ?></td>
                                                        <td><?php echo e($tran->Company); ?></td>
                                                        <td><?php echo e($tran->created_at); ?></td>
                                                        <td><?php echo e($tran->Amount); ?></td>

                                                        <td class="text-center">
                                                            <div style="display: flex; justify-content: center; align-items: center;">

                                                                <a  style="padding: 0.25rem 0.5rem; font-size: 0.875rem; line-height: 1.5;"  class="btn btn-warning edit-btn" href="/NewPayment/<?php echo e(isset($invoiceDetail) ? $invoiceDetail->id :0); ?>/<?php echo e($tran->id); ?>">
                                                                    <i class="fa fa-pen-to-square"></i>
                                                                </a>
                                                                <button data-url="<?php echo e(url('DeleteDocument')); ?>" style="padding: 0.25rem 0.5rem; font-size: 0.875rem; line-height: 1.5;" class="btn btn-danger delete-btn" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete 's document">
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

        <?php echo $__env->make('layout.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\purana xammp\htdocs\ecommerce-laravel\data-mangment2\resources\views/InvoiceDetail.blade.php ENDPATH**/ ?>
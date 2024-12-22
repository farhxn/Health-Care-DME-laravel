<?php $__env->startSection('title', 'New Invoice Transaction'); ?>
<?php echo $__env->make('layout.Head', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


<div class="dashboard-wrapper">
    <div class="dashboard-ecommerce">
        <div class="container-fluid dashboard-content">
            <div class="row">

                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="page-header">
                        <h2 class="pageheader-title ml-auto">New Invoice Transaction</h2>
                        <div class="page-breadcrumb">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">

                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>

            <div class="ecommerce-widget">

                <div class="row">


                    <div class="col">
                        <form method="post" action="<?php echo e(url('StoreTransaction', isset($transaction) ? $transaction->id : 0 )); ?>">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="InvoiceNumber" value="<?php echo e($invNumber); ?>">
                            <div class="card">
                                <h5 class="card-header">New Invoice Transaction Details</h5>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label class="col-form-label">Ins. Company</label>
                                                <div class="input-group mb-3">
                                                    <select class="form-control" name="Company">
                                                        <option <?php echo e(old('Company', $transaction->Company ?? '') == 'Ins 1:' ? 'selected' : ''); ?>>Ins 1:</option>
                                                        <option <?php echo e(old('Company', $transaction->Company ?? '') == 'Patient' ? 'selected' : ''); ?>>Patient</option>
                                                    </select>
                                                </div>
                                                <span><small class="text-danger font-weight-light font-italic">
                                                        <?php $__errorArgs = ['Company'];
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
                                                <label class="col-form-label">Tran Type</label>
                                                <div class="input-group mb-3">
                                                    <select class="form-control" name="Tran" <?php if($for=='1' || $for=='2' ): echo 'disabled'; endif; ?>>
                                                        <option value="Adjust Allowable" <?php echo e(old('Tran', $transaction->Tran ?? '') == 'Adjust Allowable' ? 'selected' : ''); ?>>Adjust Allowable</option>

                                                        <option value="Adjust Balance" <?php echo e(old('Tran', $transaction->Tran ?? '') == 'Adjust Balance' ? 'selected' : ''); ?>>Adjust Balance</option>

                                                        <option value="Adjust Customary" <?php echo e(old('Tran', $transaction->Tran ?? '') == 'Adjust Customary' ? 'selected' : ''); ?>>Adjust Customary</option>

                                                        <option value="Adjust Quantity" <?php echo e(old('Tran', $transaction->Tran ?? '') == 'Adjust Quantity' ? 'selected' : ''); ?>>Adjust Quantity</option>

                                                        <option value="Adjust Tax" <?php echo e(old('Tran', $transaction->Tran ?? '') == 'Adjust Tax' ? 'selected' : ''); ?>>Adjust Tax</option>

                                                        <option value="Auto Submit" <?php echo e(old('Tran', $transaction->Tran ?? '') == 'Auto Submit' ? 'selected' : ''); ?>>Auto Submit</option>

                                                        <option value="Change Current Payee" <?php echo e(old('Tran', $transaction->Tran ?? '') == 'Change Current Payee' ? 'selected' : ''); ?> <?php if($for==2): echo 'selected'; endif; ?>>Change Current Payee</option>

                                                        <option value="Contractual Writeoff" <?php echo e(old('Tran', $transaction->Tran ?? '') == 'Contractual Writeoff' ? 'selected' : ''); ?>>Contractual Writeoff</option>

                                                        <option value="Denied" <?php echo e(old('Tran', $transaction->Tran ?? '') == 'Denied' ? 'selected' : ''); ?>>Denied</option>

                                                        <option value="DisAllowed" <?php echo e(old('Tran', $transaction->Tran ?? '') == 'DisAllowed' ? 'selected' : ''); ?>>DisAllowed</option>

                                                        <option value="Overpayment" <?php echo e(old('Tran', $transaction->Tran ?? '') == 'Overpayment' ? 'selected' : ''); ?>>Overpayment</option>

                                                        <option value="Payment" <?php echo e(old('Tran', $transaction->Tran ?? '') == 'Payment' ? 'selected' : ''); ?>>Payment</option>

                                                        <option value="Pending Submission" <?php echo e(old('Tran', $transaction->Tran ?? '') == 'Pending Submission' ? 'selected' : ''); ?>>Pending Submission</option>

                                                        <option value="Refund" <?php echo e(old('Tran', $transaction->Tran ?? '') == 'Refund' ? 'selected' : ''); ?>>Refund</option>

                                                        <option value="Submit" <?php echo e(old('Tran', $transaction->Tran ?? '') == 'Submit' ? 'selected' : ''); ?>>Submit</option>

                                                        <option value="Voided Submission" <?php echo e(old('Tran', $transaction->Tran ?? '') == 'Voided Submission' ? 'selected' : ''); ?>>Voided Submission</option>

                                                        <option value="Writeoff" <?php echo e(old('Tran', $transaction->Tran ?? '') == 'Writeoff' ? 'selected' : ''); ?> <?php if($for==1): echo 'selected'; endif; ?>>Writeoff</option>
                                                    </select>
                                                </div>

                                                <?php if($for == '1'): ?>
                                                <input type="hidden" name="Tran" value="Writeoff">
                                                <?php elseif($for == '2'): ?>
                                                <input type="hidden" name="Tran" value="Change Current Payee">
                                                <?php endif; ?>

                                                <span><small class="text-danger font-weight-light font-italic">
                                                        <?php $__errorArgs = ['Tran'];
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
                                                <label for="inputText3" class="col-form-label">Transaction Date</label>
                                                <input name="Transaction" type="date" class="form-control" value="<?php echo e(isset($transaction) ? $transaction->Transaction : old('Transaction', \Carbon\Carbon::now()->format('Y-m-d'))); ?>">

                                            </div>
                                        </div>

                                        <div class="col">
                                            <div class="form-group">
                                                <label for="inputText3" class="col-form-label">Amount</label>
                                                <input name="Amount" type="number" class="form-control" value="<?php echo e(isset($transaction) ? $transaction->Amount : old('Amount')); ?>">
                                            </div>
                                        </div>

                                        <div class="col">
                                            <div class="form-group">
                                                <label for="inputText3" class="col-form-label">Quantity</label>
                                                <input name="Quantity" type="text" class="form-control" value="<?php echo e(isset($transaction) ? $transaction->Quantity : old('Quantity')); ?>">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="inputText3" class="col-form-label">Taxes</label>
                                                <input name="Taxes" type="text" class="form-control" value="<?php echo e(isset($transaction) ? $transaction->Taxes : old('Taxes')); ?>">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="inputText3" class="col-form-label">Batches #</label>
                                                <input name="Batches" type="text" class="form-control" value="<?php echo e(isset($transaction) ? $transaction->Batches : old('Batches')); ?>">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleFormControlTextarea1">Comment</label>
                                        <textarea class="form-control" name="Comment" rows="3"><?php echo e(isset($transaction) ? $transaction->Comment : old('Comment')); ?></textarea>
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

    <?php echo $__env->make('layout.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <script>
        $(document).ready(function() {
            logAction("Write Off Page Loaded");
        });
    </script>
<?php /**PATH D:\purana xammp\htdocs\ecommerce-laravel\data-mangment2\resources\views/InvoiceTransaction.blade.php ENDPATH**/ ?>
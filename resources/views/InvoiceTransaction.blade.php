@section('title', 'New Invoice Transaction')
@include('layout.Head')


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
                        <form method="post" action="{{ url('StoreTransaction', isset($transaction) ? $transaction->id : 0 ) }}">
                            @csrf
                            <input type="hidden" name="InvoiceNumber" value="{{ $invNumber }}">
                            <div class="card">
                                <h5 class="card-header">New Invoice Transaction Details</h5>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label class="col-form-label">Ins. Company</label>
                                                <div class="input-group mb-3">
                                                    <select class="form-control" name="Company">
                                                        <option {{ old('Company', $transaction->Company ?? '') == 'Ins 1:' ? 'selected' : '' }}>Ins 1:</option>
                                                        <option {{ old('Company', $transaction->Company ?? '') == 'Patient' ? 'selected' : '' }}>Patient</option>
                                                    </select>
                                                </div>
                                                <span><small class="text-danger font-weight-light font-italic">
                                                        @error('Company')
                                                        {{ $message }}
                                                        @enderror
                                                    </small></span>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label class="col-form-label">Tran Type</label>
                                                <div class="input-group mb-3">
                                                    <select class="form-control" name="Tran" @disabled($for=='1' || $for=='2' )>
                                                        <option value="Adjust Allowable" {{ old('Tran', $transaction->Tran ?? '') == 'Adjust Allowable' ? 'selected' : '' }}>Adjust Allowable</option>

                                                        <option value="Adjust Balance" {{ old('Tran', $transaction->Tran ?? '') == 'Adjust Balance' ? 'selected' : '' }}>Adjust Balance</option>

                                                        <option value="Adjust Customary" {{ old('Tran', $transaction->Tran ?? '') == 'Adjust Customary' ? 'selected' : '' }}>Adjust Customary</option>

                                                        <option value="Adjust Quantity" {{ old('Tran', $transaction->Tran ?? '') == 'Adjust Quantity' ? 'selected' : '' }}>Adjust Quantity</option>

                                                        <option value="Adjust Tax" {{ old('Tran', $transaction->Tran ?? '') == 'Adjust Tax' ? 'selected' : '' }}>Adjust Tax</option>

                                                        <option value="Auto Submit" {{ old('Tran', $transaction->Tran ?? '') == 'Auto Submit' ? 'selected' : '' }}>Auto Submit</option>

                                                        <option value="Change Current Payee" {{ old('Tran', $transaction->Tran ?? '') == 'Change Current Payee' ? 'selected' : '' }} @selected($for==2)>Change Current Payee</option>

                                                        <option value="Contractual Writeoff" {{ old('Tran', $transaction->Tran ?? '') == 'Contractual Writeoff' ? 'selected' : '' }}>Contractual Writeoff</option>

                                                        <option value="Denied" {{ old('Tran', $transaction->Tran ?? '') == 'Denied' ? 'selected' : '' }}>Denied</option>

                                                        <option value="DisAllowed" {{ old('Tran', $transaction->Tran ?? '') == 'DisAllowed' ? 'selected' : '' }}>DisAllowed</option>

                                                        <option value="Overpayment" {{ old('Tran', $transaction->Tran ?? '') == 'Overpayment' ? 'selected' : '' }}>Overpayment</option>

                                                        <option value="Payment" {{ old('Tran', $transaction->Tran ?? '') == 'Payment' ? 'selected' : '' }}>Payment</option>

                                                        <option value="Pending Submission" {{ old('Tran', $transaction->Tran ?? '') == 'Pending Submission' ? 'selected' : '' }}>Pending Submission</option>

                                                        <option value="Refund" {{ old('Tran', $transaction->Tran ?? '') == 'Refund' ? 'selected' : '' }}>Refund</option>

                                                        <option value="Submit" {{ old('Tran', $transaction->Tran ?? '') == 'Submit' ? 'selected' : '' }}>Submit</option>

                                                        <option value="Voided Submission" {{ old('Tran', $transaction->Tran ?? '') == 'Voided Submission' ? 'selected' : '' }}>Voided Submission</option>

                                                        <option value="Writeoff" {{ old('Tran', $transaction->Tran ?? '') == 'Writeoff' ? 'selected' : '' }} @selected($for==1)>Writeoff</option>
                                                    </select>
                                                </div>

                                                @if($for == '1')
                                                <input type="hidden" name="Tran" value="Writeoff">
                                                @elseif($for == '2')
                                                <input type="hidden" name="Tran" value="Change Current Payee">
                                                @endif

                                                <span><small class="text-danger font-weight-light font-italic">
                                                        @error('Tran')
                                                        {{ $message }}
                                                        @enderror
                                                    </small></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">

                                        <div class="col">
                                            <div class="form-group">
                                                <label for="inputText3" class="col-form-label">Transaction Date</label>
                                                <input name="Transaction" type="date" class="form-control" value="{{ isset($transaction) ? $transaction->Transaction : old('Transaction', \Carbon\Carbon::now()->format('Y-m-d')) }}">

                                            </div>
                                        </div>

                                        <div class="col">
                                            <div class="form-group">
                                                <label for="inputText3" class="col-form-label">Amount</label>
                                                <input name="Amount" type="number" class="form-control" value="{{ isset($transaction) ? $transaction->Amount : old('Amount') }}">
                                            </div>
                                        </div>

                                        <div class="col">
                                            <div class="form-group">
                                                <label for="inputText3" class="col-form-label">Quantity</label>
                                                <input name="Quantity" type="text" class="form-control" value="{{ isset($transaction) ? $transaction->Quantity : old('Quantity') }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="inputText3" class="col-form-label">Taxes</label>
                                                <input name="Taxes" type="text" class="form-control" value="{{ isset($transaction) ? $transaction->Taxes : old('Taxes') }}">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="inputText3" class="col-form-label">Batches #</label>
                                                <input name="Batches" type="text" class="form-control" value="{{ isset($transaction) ? $transaction->Batches : old('Batches') }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleFormControlTextarea1">Comment</label>
                                        <textarea class="form-control" name="Comment" rows="3">{{ isset($transaction) ? $transaction->Comment : old('Comment') }}</textarea>
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
            logAction("Write Off Page Loaded");
        });
    </script>

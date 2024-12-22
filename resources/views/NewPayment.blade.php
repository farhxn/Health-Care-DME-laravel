@section('title', 'New Payment')
@include('layout.Head')


<div class="dashboard-wrapper">
    <div class="dashboard-ecommerce">
        <div class="container-fluid dashboard-content">
            <div class="row">

                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="page-header">
                        <h2 class="pageheader-title ml-auto">New Payment</h2>
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
                            <div class="card">
                                <h5 class="card-header">New Payment Details</h5>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label class="col-form-label">Payer</label>
                                        <div class="input-group mb-3">
                                            <select class="form-control" name="Payer" id="input-select">
                                                <?php
                                                    $no=1;
                                                    ?>
                                                @foreach ($patInsurance as $patIns)
                                                <option {{ old('Payer', $transaction->Payer ?? '') == 'Ins '.$no.' : ' . $patIns->Company ? 'selected' : '' }}>Ins {{ $no }} : {{ $patIns->Company }}</option>
                                                @endforeach
                                                <option {{ old('Payer', $transaction->Payer ?? '') == 'Patient' ? 'selected' : '' }}>Patient</option>
                                            </select>
                                        </div>
                                        <span><small class="text-danger font-weight-light font-italic">
                                                @error('Payer')
                                                {{ $message }}
                                                @enderror
                                            </small></span>
                                    </div>

                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="inputText3" class="col-form-label">Billable</label>
                                                <input name="Billable" readonly value="{{ isset($transaction) ? $transaction->Billable : old('Billable',isset($amounts) ? $amounts->Billable : '00')}}" type="text" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="inputText3" class="col-form-label">Allowable</label>
                                                <input name="Allowable" type="text" readonly value="{{ isset($transaction) ? $transaction->Allowable : old('Allowable',isset($amounts) ? $amounts->Allowable : '00')}}" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="inputText3" class="col-form-label">Balance</label>
                                                <input name="Balance" type="text" readonly value="{{ isset($transaction) ? $transaction->Balance : old('Balance',isset($amounts) ? $amounts->Balance : '00')}}" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="inputText3" class="col-form-label">Expected</label>
                                                <input name="Expected" type="text" class="form-control" readonly value="{{ isset($transaction) ? $transaction->Expected : old('Expected',isset($amounts) ? $amounts->Expected : '00')}}">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="inputText3" class="col-form-label">Allowed</label>
                                                <input name="Allowed" type="text" class="form-control" value="{{ isset($transaction) ? $transaction->Allowed : old('Allowed')}}">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="inputText3" class="col-form-label">Deductible</label>
                                                <input name="Deductible" type="text" class="form-control" value="{{ isset($transaction) ? $transaction->Deductible : old('Deductible')}}">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="inputText3" class="col-form-label">Coins</label>
                                                <input name="Coins" type="text" class="form-control" value="{{ isset($transaction) ? $transaction->Coins : old('Coins')}}">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="inputText3" class="col-form-label">Paid</label>
                                                <input name="Paid" type="text" class="form-control" value="{{ isset($transaction) ? $transaction->Paid : old('Paid')}}">
                                            </div>
                                        </div>
                                        <input type="hidden" name="InvoiceNumber" value="{{ $invNumber }}"> 
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="inputText3" class="col-form-label">Actual</label>
                                                <input name="Actual" type="text" class="form-control" readonly value="{{ isset($transaction) ? $transaction->Actual : old('Actual',isset($amounts) ? $amounts->Actual : '00')}}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="inputText3" class="col-form-label">Posting Date</label>
                                                <input type="date" name="PostingDate" class="form-control" value="{{ isset($transaction) ? $transaction->PostingDate : old('PostingDate', \Carbon\Carbon::now()->format('Y-m-d')) }}">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="inputText3" class="col-form-label">Check Date</label>
                                                <input type="date" class="form-control" name="CheckDate" value="{{ isset($transaction) ? $transaction->CheckDate : old('CheckDate', \Carbon\Carbon::now()->format('Y-m-d')) }}">

                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="inputText3" class="col-form-label">Check #</label>
                                                <input name="Check" type="text" class="form-control" value="{{ isset($transaction) ? $transaction->Check : old('Check')}}">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="inputText3" class="col-form-label">ICN/CCN</label>
                                                <input name="ICN" type="text" class="form-control" value="{{ isset($transaction) ? $transaction->ICN : old('ICN')}}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleFormControlTextarea1">Comment</label>
                                        <textarea class="form-control" name="PaymentComment" rows="3">{{ isset($transaction) ? $transaction->PaymentComment : old('PaymentComment')}}</textarea>
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
            logAction("New Payment Page Loaded");
        });
    </script>

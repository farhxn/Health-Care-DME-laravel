@section('title', 'Invoice Detail')
@include('layout.Head')

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
                                                        <form action="{{ url('updateInvoiceDetail',isset($invoiceDetail) ? $invoiceDetail->id :0) }}" method="post">
                                                            @csrf
                                                            <div class="row">
                                                                <div class="col">
                                                                    <div class="form-group">
                                                                        <label class="col-form-label form-control-sm">Inventory Item</label>
                                                                        <div class="input-group mb-3">
                                                                            <input type="text" required disabled class="form-control form-control-sm" value="{{ isset($invoiceDetail) ? $itemName : old('Item') }}" style="box-sizing: border-box;">
                                                                        </div>
                                                                        <span>
                                                                            <small class="text-danger font-weight-light font-italic">
                                                                                @error('Item')
                                                                                $message
                                                                                @enderror
                                                                            </small>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <div class="col">
                                                                    <div class="form-group">
                                                                        <label class="col-form-label form-control-sm">Total Balance</label>
                                                                        <div class="input-group mb-3">
                                                                            <input type="text" required placeholder="Balance" name="Balance" class="form-control form-control-sm" value="{{ isset($invoiceDetail) ? $invoiceDetail->Balance : old('Balance') }} " style="box-sizing: border-box;">
                                                                        </div>
                                                                        <span>
                                                                            <small class="text-danger font-weight-light font-italic">
                                                                                @error('Balance')
                                                                                $message
                                                                                @enderror
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
                                                                            <input type="text" required name="BillingCode" class="form-control form-control-sm" value="{{ isset($invoiceDetail) ? $invoiceDetail->BillingCode : old('BillingCode') }} " style="box-sizing: border-box;">
                                                                        </div>
                                                                        <span>
                                                                            <small class="text-danger font-weight-light font-italic">
                                                                                @error('BillingCode')
                                                                                $message
                                                                                @enderror
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
                                                                                value="{{ isset($invoiceDetail) && $invoiceDetail->created_at ? $invoiceDetail->created_at->format('Y-m-d') : old('InvoiceDate')}}"
                                                                                style="box-sizing: border-box;">

                                                                        </div>
                                                                        <span>
                                                                            <small class="text-danger font-weight-light font-italic">
                                                                                @error('InvoiceDate')
                                                                                $message
                                                                                @enderror
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
                                                                            <textarea name="HAO" class="form-control" rows="5" style="width: 100%;">{{ isset($invoiceDetail) ? $invoiceDetail->HAO : old('HAO') }}</textarea>
                                                                        </div>
                                                                        <span>
                                                                            <small class="text-danger font-weight-light font-italic">
                                                                                @error('BillingCode') {{ $message }} @enderror
                                                                            </small>
                                                                        </span>
                                                                    </div>


                                                                    <div class="form-group">
                                                                        <label class="col-form-label form-control-sm">Modifiers</label>
                                                                        <div class="input-group mb-3">
                                                                            <input type="text" name="Modifier1" id="modifier1" maxlength="2" class="form-control form-control-sm requiredField mx-1" style="max-width: 50px;" required value="{{ isset($invoiceDetail) ? $invoiceDetail->Modifier1 : old('Modifier1') }}">

                                                                            <input type="text" name="Modifier2" id="modifier2" maxlength="2" class="form-control form-control-sm requiredField mx-1" style="max-width: 50px;" required value="{{ isset($invoiceDetail) ? $invoiceDetail->Modifier2 : old('Modifier2') }}">

                                                                            <input type="text" name="Modifier3" id="modifier3" maxlength="2" class="form-control form-control-sm requiredField mx-1" style="max-width: 50px;" required value="{{ isset($invoiceDetail) ? $invoiceDetail->Modifier3 : old('Modifier3') }}">

                                                                            <input type="text" name="Modifier4" id="modifier4" maxlength="2" class="form-control form-control-sm requiredField mx-1" style="max-width: 50px;" required value="{{ isset($invoiceDetail) ? $invoiceDetail->Modifier4 : old('Modifier4') }}">

                                                                        </div>
                                                                        <span>
                                                                            <small class="text-danger font-weight-light font-italic">
                                                                                @error('Modifier1') {{ $message }} @enderror
                                                                                @error('Modifier2') {{ $message }} @enderror
                                                                                @error('Modifier3') {{ $message }} @enderror
                                                                                @error('Modifier4') {{ $message }} @enderror
                                                                            </small>
                                                                        </span>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label class="col-form-label form-control-sm">Billable Amount</label>
                                                                        <div class="input-group mb-3">
                                                                            <input type="text" required placeholder="BillableAmount" name="BillableAmount" class="form-control form-control-sm" value=" {{ isset($invoiceDetail) ? $invoiceDetail->BillableAmount : old('BillableAmount') }} " style="box-sizing: border-box;">
                                                                        </div>
                                                                        <span>
                                                                            <small class="text-danger font-weight-light font-italic">
                                                                                @error('BillableAmount')
                                                                                $message
                                                                                @enderror
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
                                                                                        value="{{ isset($invoiceDetail) && $invoiceDetail->From ? date('Y-m-d', strtotime($invoiceDetail->From)) : old('From') }}"
                                                                                        style="box-sizing: border-box;">

                                                                                </div>
                                                                                <span>
                                                                                    <small class="text-danger font-weight-light font-italic">
                                                                                        @error('DOSFrom') {{ $message }} @enderror
                                                                                    </small>
                                                                                </span>
                                                                            </div>

                                                                            <div class="form-group">
                                                                                <label class="col-form-label form-control-sm">To</label>
                                                                                <div class="input-group mb-3">
                                                                                    <input type="date" required placeholder="To" name="To"
                                                                                        class="form-control form-control-sm"
                                                                                        value="{{ isset($invoiceDetail) && $invoiceDetail->To ? date('Y-m-d', strtotime($invoiceDetail->To)) : old('To') }}"
                                                                                        style="box-sizing: border-box;">

                                                                                </div>
                                                                                <span>
                                                                                    <small class="text-danger font-weight-light font-italic">
                                                                                        @error('To') {{ $message }} @enderror
                                                                                    </small>
                                                                                </span>
                                                                            </div>

                                                                            <!-- Billing Month -->
                                                                            <div class="form-group">
                                                                                <label class="col-form-label form-control-sm">Billing Month</label>
                                                                                <div class="input-group mb-3">
                                                                                    <input type="text" required placeholder="Billing Month" id="BillingMonth" name="BillingMonth" class="form-control form-control-sm requiredField" value="{{ isset($invoiceDetail) ? $invoiceDetail->BillingMonth : old('BillingMonth') }}">
                                                                                </div>
                                                                                <span>
                                                                                    <small class="text-danger font-weight-light font-italic">
                                                                                        @error('BillingMonth') {{ $message }} @enderror
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
                                                                            <input type="text" required placeholder="Allowed Amount" name="AllowedAmount" class="form-control form-control-sm" value=" {{ isset($invoiceDetail) ? $invoiceDetail->AllowedAmount : old('AllowedAmount') }} " style="box-sizing: border-box;">
                                                                        </div>
                                                                        <span>
                                                                            <small class="text-danger font-weight-light font-italic">
                                                                                @error('AllowedAmount')
                                                                                $message
                                                                                @enderror
                                                                            </small>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <div class="col">
                                                                    <div class="form-group">
                                                                        <label class="col-form-label form-control-sm">Quantity</label>
                                                                        <div class="input-group mb-3">
                                                                            <input type="text" required placeholder="Quantity" name="Quantity" class="form-control form-control-sm" value=" {{ isset($invoiceDetail) ? $invoiceDetail->Quantity : old('Quantity') }} " style="box-sizing: border-box;">
                                                                        </div>
                                                                        <span>
                                                                            <small class="text-danger font-weight-light font-italic">
                                                                                @error('Quantity')
                                                                                $message
                                                                                @enderror
                                                                            </small>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <div class="col">
                                                                    <div class="form-group">
                                                                        <label class="col-form-label form-control-sm">Taxes</label>
                                                                        <div class="input-group mb-3">
                                                                            <input type="text" required placeholder="Taxes" name="Taxes" class="form-control form-control-sm" value=" {{ isset($invoiceDetail) ? $invoiceDetail->Taxes : old('Taxes') }} " style="box-sizing: border-box;">
                                                                        </div>
                                                                        <span>
                                                                            <small class="text-danger font-weight-light font-italic">
                                                                                @error('Taxes')
                                                                                $message
                                                                                @enderror
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
                                                                                {{ isset($invoiceDetail) && $invoiceDetail->Ins1 ? 'checked' : '' }}>
                                                                            <label class="custom-control-label" for="Ins1Checkbox">Ins 1</label>
                                                                        </div>

                                                                    </label>
                                                                </div>

                                                                <div class="col">
                                                                    <label class="custom-control custom-checkbox">
                                                                        <input type="checkbox" class="custom-control-input" name="Ins2" {{ isset($invoiceDetail) && $invoiceDetail->Ins2 ? 'checked' : '' }}>
                                                                        <span class="custom-control-label">Ins 2</span>
                                                                    </label>
                                                                </div>

                                                                <div class="col">
                                                                    <label class="custom-control custom-checkbox">
                                                                        <input type="checkbox" class="custom-control-input" name="Ins3" {{ isset($invoiceDetail) && $invoiceDetail->Ins3 ? 'checked' : '' }}>
                                                                        <span class="custom-control-label">Bill&nbsp;To&nbsp;Ins 3</span>
                                                                    </label>
                                                                </div>

                                                                <div class="col">
                                                                    <label class="custom-control custom-checkbox">
                                                                        <input type="checkbox" class="custom-control-input" name="Ins4" {{ isset($invoiceDetail) && $invoiceDetail->Ins4 ? 'checked' : '' }}>
                                                                        <span class="custom-control-label">Ins 4</span>
                                                                    </label>
                                                                </div>

                                                                <div class="col">
                                                                    <label class="custom-control custom-checkbox">
                                                                        <input type="checkbox" class="custom-control-input" name="NoPay" {{ isset($invoiceDetail) && $invoiceDetail->NoPay ? 'checked' : '' }}>
                                                                        <span class="custom-control-label">No Pay Ins 1</span>
                                                                    </label>
                                                                </div>
                                                            </div>


                                                            <div class="row">
                                                                <div class="col">
                                                                    <div class="form-group">
                                                                        <label class="col-form-label form-control-sm">DX Pointer 10</label>
                                                                        <div class="input-group mb-3">
                                                                            <input type="text" required placeholder="DX Pointer 10" id="DXPointer10" name="Dx10" class="form-control form-control-sm requiredField" value="{{ isset($invoiceDetail) ? $invoiceDetail->Dx10 : old('Dx10') }}">
                                                                        </div>
                                                                        <span><small class="text-danger font-weight-light font-italic">
                                                                                @error('Dx10')
                                                                                {{ $message }}
                                                                                @enderror
                                                                            </small></span>
                                                                    </div>
                                                                </div>
                                                                <div class="col">
                                                                    <div class="form-group">
                                                                        <label class="col-form-label form-control-sm">Prior Auth Type</label>
                                                                        <div class="input-group mb-3">
                                                                            <select class="form-control form-control-sm requiredField" required id="PriorAuthType" name="PriorAuthType">

                                                                                <option value="P.O. Number" {{ old('PriorAuthType', $invoiceDetail->PriorAuthType ?? '') == 'P.O. Number' ? 'selected' : '' }}>P.O. Number</option>

                                                                                <option value="Prior Auth" {{ old('PriorAuthType', $invoiceDetail->PriorAuthType ?? '') == 'Prior Auth' ? 'selected' : '' }}>Prior Auth </option>
                                                                            </select>
                                                                        </div>
                                                                        <span>
                                                                            <small class="text-danger font-weight-light font-italic">
                                                                                @error('PriorAuthType')
                                                                                {{ $message }}
                                                                                @enderror
                                                                            </small>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <div class="col">
                                                                    <div class="form-group">
                                                                        <label class="col-form-label form-control-sm">Prior Auth #</label>
                                                                        <div class="input-group mb-3">
                                                                            <input type="text" required id="PriorAuthModal" name="PriorAuth" class="form-control form-control-sm requiredField" value="{{ isset($invoiceDetail) ? $invoiceDetail->PriorAuth : old('PriorAuth') }}">
                                                                        </div>
                                                                        <span><small class="text-danger font-weight-light font-italic">
                                                                                @error('PriorAuth')
                                                                                {{ $message }}
                                                                                @enderror
                                                                            </small></span>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col">
                                                                    <div class="form-group">
                                                                        <label class="col-form-label form-control-sm">Special Code</label>
                                                                        <div class="input-group mb-3">
                                                                            <input type="text" required placeholder="Special Code" name="SpecialCode" class="form-control form-control-sm" value=" {{ isset($invoiceDetail) ? $invoiceDetail->SpecialCode : old('SpecialCode') }} " style="box-sizing: border-box;">
                                                                        </div>
                                                                        <span>
                                                                            <small class="text-danger font-weight-light font-italic">
                                                                                @error('SpecialCode')
                                                                                $message
                                                                                @enderror
                                                                            </small>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <div class="col">
                                                                    <div class="form-group">
                                                                        <label class="col-form-label form-control-sm">Review Code</label>
                                                                        <div class="input-group mb-3">
                                                                            <input type="text" required placeholder="Review Code" name="ReviewCode" class="form-control form-control-sm" value=" {{ isset($invoiceDetail) ? $invoiceDetail->ReviewCode : old('ReviewCode') }} " style="box-sizing: border-box;">
                                                                        </div>
                                                                        <span>
                                                                            <small class="text-danger font-weight-light font-italic">
                                                                                @error('ReviewCode')
                                                                                $message
                                                                                @enderror
                                                                            </small>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <div class="col">
                                                                    <label>CMN/RX</label>
                                                                    <label class="custom-control custom-checkbox">
                                                                        <input type="checkbox" class="custom-control-input" id="invoice" name="CMNRX" {{ isset($invoiceDetail) && $invoiceDetail->CMNRX ? 'checked' : '' }}>
                                                                        <span class="custom-control-label">Send&nbsp;CMN/RX&nbsp;with&nbsp;this&nbsp;invoice</span>
                                                                    </label>
                                                                    <label class="custom-control custom-checkbox">
                                                                        <input type="checkbox" class="custom-control-input" name="AcceptAssignment" {{ isset($invoiceDetail) && $invoiceDetail->AcceptAssignment ? 'checked' : '' }}>
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
                                                    <a href="/NewPayment/{{isset($invoiceDetail) ? $invoiceDetail->id :0}}/0" class=" ml-1 btn btn-primary btn-block">Payment</a>
                                                </div>
                                                <div class="col">
                                                    <a href="/InvoiceTransaction/{{isset($invoiceDetail) ? $invoiceDetail->id :0}}/0/1" class=" ml-1 btn btn-primary btn-block">Write Off</a>
                                                </div>
                                                <div class="col">
                                                    <a href="/InvoiceTransaction/{{isset($invoiceDetail) ? $invoiceDetail->id :0}}/0/2" class=" ml-1 btn btn-primary btn-block">Change Payer</a>
                                                </div>
                                                <div class="col">
                                                    <a href="/InvoiceTransaction/{{isset($invoiceDetail) ? $invoiceDetail->id :0}}/0/0" class=" ml-1 btn btn-primary btn-block">Transaction</a>
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
                                                    @foreach ($transactions as $tran)
                                                    <tr class="txt-sm ">
                                                        <td>{{$sno++}}</td>
                                                        <td>{{$tran->InvoiceNumber}}</td>
                                                        <td>{{$tran->Tran}}</td>
                                                        <td>{{$tran->Company}}</td>
                                                        <td>{{$tran->created_at}}</td>
                                                        <td>{{$tran->Amount}}</td>

                                                        <td class="text-center">
                                                            <div style="display: flex; justify-content: center; align-items: center;">

                                                                <a  style="padding: 0.25rem 0.5rem; font-size: 0.875rem; line-height: 1.5;"  class="btn btn-warning edit-btn" href="/NewPayment/{{isset($invoiceDetail) ? $invoiceDetail->id :0}}/{{$tran->id}}">
                                                                    <i class="fa fa-pen-to-square"></i>
                                                                </a>
                                                                <button data-url="{{ url('DeleteDocument') }}" style="padding: 0.25rem 0.5rem; font-size: 0.875rem; line-height: 1.5;" class="btn btn-danger delete-btn" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete 's document">
                                                                    <i class="fa fa-trash"></i>
                                                                </button>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    @endforeach
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

        @include('layout.footer')
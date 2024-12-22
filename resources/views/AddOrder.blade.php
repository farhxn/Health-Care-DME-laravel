@php
if (isset($order)) {
if ($mode == "view") {
$title = "View Order";
} else {
$title = "Edit Order";
}
} else {
$title = "Create New Order";
}
@endphp

@section('title', $title)
@include('layout.Head')

@php

$userR = Session::get('LoginRole');
$phoneData = $tp->p_phone !== 'N/A' ? $tp->p_phone : null;
$phoneNumbers = $phoneData ? json_decode($phoneData, true) : null;
$filteredPhoneNumbers = $phoneNumbers ? array_filter($phoneNumbers, function($value) {
return $value !== null;
}) : null;
if (empty($filteredPhoneNumbers)) {
$phoneNumbers = null;
}
$phone1 = "N/A";
$phone2 = "N/A";
if ($phoneNumbers) {
$formattedNumbers = array_map(function ($phoneNumber) {
$formatted = preg_replace('/[^0-9]/', '', $phoneNumber);
return strlen($formatted) == 10 ? '(' . substr($formatted, 0, 3) . ') ' . substr($formatted, 3, 3) . '-' . substr($formatted, 6) : null;
}, array_filter($phoneNumbers));
$phone1 = $formattedNumbers[0] ?? $phone1;
$phone2 = $formattedNumbers[1] ?? $phone2;
}

$offName = \App\Models\Doctors::find($tp->Off_Name);

@endphp

<div class="dashboard-wrapper">
    <div class="dashboard-ecommerce">
        <div class="container-fluid dashboard-content">
            <div class="row">
            </div>

            <div class="ecommerce-widget">
                <div class="row">
                    <div class="col-12">
                        <div class="d-flex justify-content-between align-items-center m-3">
                            <h2 class="pageheader-title">
                                @if (isset($order))
                                @if ($mode == "view")
                                View Order
                                @else
                                Edit Order
                                @endif
                                @else
                                Create New Order
                                @endif
                            </h2>

                            <div class="ml-auto">
                                @if ($mode != 'add')
                                <a href="#" class="btn btn-primary disabled">Created By: {{ $order->CreatedBy }}</a>
                                <a href="#" class="btn btn-primary disabled">Order # {{ $order->id }}</a>
                                <a href="#" class="btn btn-primary disabled">Order Date: {{ $order->created_at->format('m/d/Y') }}</a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @if ($mode == 'view')
                <div class="row">
                    <div class="col">
                        <div class="row">
                            <div class="col">
                                <button data-toggle="modal" data-target="#AddNote" class="btn btn-primary btn-block p-2">Add&nbsp;Notes</button>
                            </div>
                            <div class="col">
                                <button data-toggle="modal" data-target="#AddDocument" class="btn btn-primary btn-block p-2">Upload&nbsp;Documents</button>
                            </div>


                            @php
                            $cancelPer = Session::get('LoginCancel');
                            @endphp
                            @if($userR != "2" && $cancelPer != "on" && $tp->request != 1)
                            <div class="col">
                                <a href="{{url('CancelRequest',$tp->id)}}" class="btn btn-primary btn-block p-2">Request&nbsp;To&nbsp;Cancel</a>
                            </div>
                            @endif

                            @if($userR != "2" && $closePer != "on" && $tp->request != 3)
                            <div class="col">
                                <a href="{{url('CloseRequest',$tp->id)}}" class="btn btn-primary btn-block p-2">Request&nbsp;To&nbsp;Close</a>
                            </div>
                            @endif

                            <!-- Hold Scenario -->
                            @if($userR != "2" && $holdPer != "on" && $tp->request != 2)
                            <div class="col">
                                <a href="{{url('HoldRequest',$tp->id)}}" class="btn btn-primary btn-block p-2">Request&nbsp;To&nbsp;Hold</a>
                            </div>
                            @endif
                            @if($userR != "2" && $holdPer != "on" && ($tp->request == 2 || $tp->request == 1 || $tp->request == 3))
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
                            @endif

                            @if(($userR == "2" || $holdPer == "on") && ($tp->request == 2 || $tp->request == 1 || $tp->request == 3))
                            <div class="col">
                                <a href="{{url('ApproveRequest',$tp->id)}}" class="btn btn-primary btn-block p-2">Approve&nbsp;To&nbsp;
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
                                <a href="{{url('RejectRequest',$tp->id)}}" class="btn btn-primary btn-block p-2">Reject&nbsp;To&nbsp;
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
                            @endif

                        </div>
                    </div>
                </div>
                @endif
                <div class="col-12 m-b-60 mt-3">
                    <div class="simple-card">
                        <ul class="nav nav-tabs" id="myTab5" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="product-tab-1" style="margin: 0; padding: 15px 15px; border: none;" data-toggle="tab" href="#tab-6" role="tab" aria-controls="product-tab-1" aria-selected="false">Order</a>
                            </li>
                            @if ($mode == 'view')
                            <li class="nav-item">
                                <a class="nav-link " id="product-tab-1" style="margin: 0; padding: 15px 15px; border: none;" data-toggle="tab" href="#tab-1" role="tab" aria-controls="product-tab-1" aria-selected="false">History</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link border-left-0" id="product-tab-2" style="margin: 0; padding: 15px 15px; border: none;" data-toggle="tab" href="#tab-2" role="tab" aria-controls="product-tab-2" aria-selected="true">Notes</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link border-left-0" id="product-tab-2" style="margin: 0; padding: 15px 15px; border: none;" data-toggle="tab" href="#tab-4" role="tab" aria-controls="product-tab-4" aria-selected="false">Documents</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link border-left-0 " id="product-tab-2" style="margin: 0; padding: 15px 15px; border: none;" data-toggle="tab" href="#tab-5" role="tab" aria-controls="product-tab-4" aria-selected="false">Diagnoses</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link " id="product-tab-3" style="margin: 0; padding: 15px 15px; border: none;" data-toggle="tab" href="#tab-3" role="tab" aria-controls="product-tab-3" aria-selected="false">CheckList</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link " id="product-tab-3" style="margin: 0; padding: 15px 15px; border: none;" data-toggle="tab" href="#tab-7" role="tab" aria-controls="product-tab-3" aria-selected="false">Eligibility</a>
                            </li>
                            @endif

                        </ul>

                        <div class="tab-content" id="myTabContent5">
                            <div class="tab-pane fade" id="tab-1" role="tabpanel" aria-labelledby="product-tab-1">
                                <ul class="list-unstyled arrow">
                                    @foreach ($act as $ac)
                                    <li>
                                        {{ $ac->message }}
                                        <br> <span><small class="text-dark font-weight-normal font-italic">
                                                by {{ $ac->name }} at {{ $ac->created_at->format('m/d/Y h:i:s A') }} ON ORDER# {{ $ac->OrderID }}
                                    </li>
                                    </small></span>
                                    @endforeach

                                </ul>
                            </div>

                            <div class="tab-pane fade " id="tab-2" role="tabpanel" aria-labelledby="product-tab-2">
                                <div class="review-block">

                                    <ul class="list-unstyled arrow">


                                        @foreach ($not as $no)
                                        <li>
                                            {!! nl2br(e($no->note)) !!}

                                            <br> <span><small class="text-dark font-weight-normal font-italic">
                                                    by {{ $no->name }} at {{ $no->created_at->format('m/d/Y h:i:s A') }} ON ORDER# {{ $order->id }}
                                                </small></span>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="tab-3" role="tabpanel" aria-labelledby="product-tab-3">
                                <ul class="list-unstyled arrow">

                                    @if(!empty($tp->checks))
                                    @php
                                    $checks = json_decode($tp->checks);
                                    @endphp

                                    @if(is_array($checks) && !empty($checks))
                                    @foreach ($checks as $check)
                                    <li>{{ $check }}</li>
                                    @endforeach
                                    @php
                                    $usName = \App\Models\Users::find($tp->checksUser);
                                    @endphp
                                    by {{ $tp?->checksUser }} at {{ \Carbon\Carbon::parse($tp?->checksDate)->format('m/d/Y h:i:s A') }}

                                    @else
                                    <p>No checks selected.</p>
                                    @endif
                                    @endif
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
                                        @foreach ($da as $index => $date)
                                        <tr class="txt-sm " style="cursor: pointer;" data-toggle="modal" data-target="#ViewDocument" data-id="{{ $date->id }}" data-name="{{ $date->name }}">
                                            <td class="txt-sm">{{ $index + 1 }}</td>
                                            <td class="txt-sm">{{ $date->Order_No }}</td>
                                            <td class="txt-sm">{{$tp->Order_No}}</td>
                                            <td class="txt-sm">{{$tp->name}}</td>
                                            <td class="txt-sm">{{$tp->last_Name}}</td>
                                            <td class="txt-sm">{{$tp->AccNumber}}</td>
                                            <td class="txt-sm">{{ $date->docType }}</td>
                                            <td class="txt-sm">
                                                @if (is_null($date->toDate))
                                                N/A
                                                @elseif ($date->toDate < now()) Expired @else Valid @endif </td>
                                            <td>{{$date->upload}} at {{ $date->created_at->format('m/d/Y h:i:s A') }}</td>
                                            <td class="text-center">
                                                <div style="display: flex; justify-content: center; align-items: center;">
                                                    <button data-toggle="modal" style="padding: 0.25rem 0.5rem; font-size: 0.875rem; line-height: 1.5;" data-target="#ViewDocument" data-id="{{ $date->id }}" data-name="{{ $tp->name }}" class="btn btn-primary view-btn">
                                                        <i class="fa-solid fa-eye"></i>
                                                    </button>

                                                    @if($userR =="2" || $editDocPer == "on")
                                                    <button data-toggle="modal" style="padding: 0.25rem 0.5rem; font-size: 0.875rem; line-height: 1.5;" data-target="#EditDocument" data-id="{{ $date->id }}" data-name="{{ $tp->name }}" class="btn btn-warning edit-btn">
                                                        <i class="fa fa-pen-to-square"></i>
                                                    </button>
                                                    @endif
                                                    @if($userR =="2" || $deleteDocPer == "on")
                                                    <button data-url="{{ url('DeleteDocument', $date->id) }}" style="padding: 0.25rem 0.5rem; font-size: 0.875rem; line-height: 1.5;" class="btn btn-danger delete-btn" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete {{ $tp->name }}'s document">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                    @endif
                                                </div>
                                            </td>



                                        </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>

                            <div class="tab-pane fade " id="tab-5" role="tabpanel" aria-labelledby="product-tab-4">
                                <form action="{{url('AddDiagnosis')}}" method="post">
                                    @csrf
                                    <input type="hidden" name="previous_url" value="{{ url()->previous() }}">
                                    <input type="hidden" name="OrderID" value="{{ old('OrderID',isset($order) ? $order->id : '') }}">
                                    <input type="hidden" name="Patient_ID" value="{{ old('Patient_ID', $tp->id) }}">
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col" style="border-right: 1px solid black;">
                                                <div class="form-group">
                                                    <label class="col-form-label form-control-sm">Date of Injury</label>
                                                    <div class="input-group mb-3">
                                                        <input type="date" required placeholder="Date of Injury" name="DateOfInjury" id="DateOfInjury" class="form-control form-control-sm"
                                                            value="{{ old('DateOfInjury', isset($diagnosis) ? $diagnosis->DateOfInjury : '') }}">
                                                    </div>
                                                    <span>
                                                        <small class="text-danger font-weight-light font-italic">
                                                            @error('DateOfInjury')
                                                            {{ $message }}
                                                            @enderror
                                                        </small>
                                                    </span>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-form-label form-control-sm">Return to Work Date:</label>
                                                    <div class="input-group mb-3">
                                                        <input type="date" required placeholder="Return to Return to Work Date:" id="WorkDate" name="WorkDate" class="form-control form-control-sm"
                                                            value="{{ old('WorkDate', isset($diagnosis) ? $diagnosis->WorkDate : '') }}">
                                                    </div>
                                                    <span>
                                                        <small class="text-danger font-weight-light font-italic">
                                                            @error('WorkDate')
                                                            {{ $message }}
                                                            @enderror
                                                        </small>
                                                    </span>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-form-label form-control-sm">First Consult Date</label>
                                                    <div class="input-group mb-3">
                                                        <input type="date" required placeholder="Consult Date" name="ConsultDate" id="ConsultDate" class="form-control form-control-sm"
                                                            value="{{ old('ConsultDate', isset($diagnosis) ? $diagnosis->ConsultDate : '') }}">
                                                    </div>
                                                    <span>
                                                        <small class="text-danger font-weight-light font-italic">
                                                            @error('ConsultDate')
                                                            {{ $message }}
                                                            @enderror
                                                        </small>
                                                    </span>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-form-label form-control-sm">Accident</label>
                                                    <div class="input-group mb-3">
                                                        <select class="form-control form-control-sm" required id="Accident" name="Accident">
                                                            <option disabled {{ old('Accident', isset($diagnosis) ? $diagnosis->Accident : '') == '' ? 'selected' : '' }}>Accident</option>

                                                            <option value="Auto" {{ old('Accident', isset($diagnosis) ? $diagnosis->Accident : '') == 'Auto' ? 'selected' : '' }}>Auto</option>

                                                            <option value="No" {{ old('Accident', isset($diagnosis) ? $diagnosis->Accident : '') == 'No' ? 'selected' : '' }}>No</option>

                                                            <option value="Other" {{ old('Accident', isset($diagnosis) ? $diagnosis->Accident : '') == 'Other' ? 'selected' : '' }}>Other</option>

                                                        </select>
                                                    </div>
                                                    <span>
                                                        <small class="text-danger font-weight-light font-italic">
                                                            @error('Accident')
                                                            {{ $message }}
                                                            @enderror
                                                        </small>
                                                    </span>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-form-label form-control-sm">State of Injury</label>
                                                    <div class="input-group mb-3">
                                                        <input type="text" required placeholder="State Injury" name="StateInjury" id="StateInjury" class="form-control form-control-sm"
                                                            value="{{ old('StateInjury', isset($diagnosis) ? $diagnosis->StateInjury : '') }}">
                                                    </div>
                                                    <span>
                                                        <small class="text-danger font-weight-light font-italic">
                                                            @error('StateInjury')
                                                            {{ $message }}
                                                            @enderror
                                                        </small>
                                                    </span>
                                                </div>


                                            </div>

                                            <div class="col">
                                                <div class="row">
                                                    <div class="col">
                                                        <p class="text-center" style="font-size: 25px;"><strong>ICD10</strong></p>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-form-label form-control-sm"># 1</label>
                                                    <div class="input-group mb-3">
                                                        <select class="form-control form-control-sm" id="ICD101" required name="ICD101">
                                                            <option disabled {{ old('ICD101', isset($diagnosis) ? $diagnosis->ICD101 : '') == '' ? 'selected' : '' }}>ICD10 1</option>
                                                            <option value="N/A" {{ old('ICD101', isset($diagnosis) ? $diagnosis->ICD101 : '') == 'N/A' ? 'selected' : '' }}>N/A</option>
                                                            @foreach ($icd10 as $drs)
                                                            <option value="{{ $drs->Code }}" {{ old('ICD101', isset($diagnosis) ? $diagnosis->ICD101 : '') == $drs->Code ? 'selected' : '' }}>{{ $drs->Code }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <span>
                                                        <small class="text-danger font-weight-light font-italic">
                                                            @error('ICD101')
                                                            {{ $message }}
                                                            @enderror
                                                        </small>
                                                    </span>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-form-label form-control-sm"># 2</label>
                                                    <div class="input-group mb-3">
                                                        <select class="form-control form-control-sm" required id="ICD102" name="ICD102">
                                                            <option disabled {{ old('ICD102', isset($diagnosis) ? $diagnosis->ICD102 : '') == '' ? 'selected' : '' }}>ICD10 2</option>
                                                            <option value="N/A" {{ old('ICD102', isset($diagnosis) ? $diagnosis->ICD102 : '') == 'N/A' ? 'selected' : '' }}>N/A</option>
                                                            @foreach ($icd10 as $drs)
                                                            <option value="{{ $drs->Code }}" {{ old('ICD102', isset($diagnosis) ? $diagnosis->ICD102 : '') == $drs->Code ? 'selected' : '' }}>{{ $drs->Code }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <span>
                                                        <small class="text-danger font-weight-light font-italic">
                                                            @error('ICD102')
                                                            {{ $message }}
                                                            @enderror
                                                        </small>
                                                    </span>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-form-label form-control-sm"># 3</label>
                                                    <div class="input-group mb-3">
                                                        <select class="form-control form-control-sm" required id="ICD103" name="ICD103">
                                                            <option disabled {{ old('ICD103', isset($diagnosis) ? $diagnosis->ICD103 : '') == '' ? 'selected' : '' }}>ICD10 3</option>
                                                            <option value="N/A" {{ old('ICD103', isset($diagnosis) ? $diagnosis->ICD103 : '') == 'N/A' ? 'selected' : '' }}>N/A</option>
                                                            @foreach ($icd10 as $drs)
                                                            <option value="{{ $drs->Code }}" {{ old('ICD103', isset($diagnosis) ? $diagnosis->ICD103 : '') == $drs->Code ? 'selected' : '' }}>{{ $drs->Code }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <span>
                                                        <small class="text-danger font-weight-light font-italic">
                                                            @error('ICD103')
                                                            {{ $message }}
                                                            @enderror
                                                        </small>
                                                    </span>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-form-label form-control-sm"># 4</label>
                                                    <div class="input-group mb-3">
                                                        <select class="form-control form-control-sm" required id="ICD104" name="ICD104">
                                                            <option disabled {{ old('ICD104', isset($diagnosis) ? $diagnosis->ICD104 : '') == '' ? 'selected' : '' }}>ICD10 4</option>
                                                            <option value="N/A" {{ old('ICD104', isset($diagnosis) ? $diagnosis->ICD104 : '') == 'N/A' ? 'selected' : '' }}>N/A</option>
                                                            @foreach ($icd10 as $drs)
                                                            <option value="{{ $drs->Code }}" {{ old('ICD104', isset($diagnosis) ? $diagnosis->ICD104 : '') == $drs->Code ? 'selected' : '' }}>{{ $drs->Code }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <span>
                                                        <small class="text-danger font-weight-light font-italic">
                                                            @error('ICD104')
                                                            {{ $message }}
                                                            @enderror
                                                        </small>
                                                    </span>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-form-label form-control-sm"># 5</label>
                                                    <div class="input-group mb-3">
                                                        <select class="form-control form-control-sm" required name="ICD105" id="ICD105">
                                                            <option disabled {{ old('ICD105', isset($diagnosis) ? $diagnosis->ICD105 : '') == '' ? 'selected' : '' }}> ICD10 5</option>
                                                            <option value="N/A" {{ old('ICD105', isset($diagnosis) ? $diagnosis->ICD105 : '') == 'N/A' ? 'selected' : '' }}>N/A</option>
                                                            @foreach ($icd10 as $drs)
                                                            <option value="{{ $drs->Code }}" {{ old('ICD105', isset($diagnosis) ? $diagnosis->ICD105 : '') == $drs->Code ? 'selected' : '' }}>{{ $drs->Code }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <span>
                                                        <small class="text-danger font-weight-light font-italic">
                                                            @error('ICD105')
                                                            {{ $message }}
                                                            @enderror
                                                        </small>
                                                    </span>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-form-label form-control-sm"># 6</label>
                                                    <div class="input-group mb-3">
                                                        <select class="form-control form-control-sm" required name="ICD106" id="ICD106">
                                                            <option disabled {{ old('ICD106', isset($diagnosis) ? $diagnosis->ICD106 : '') == '' ? 'selected' : '' }}>ICD10 6</option>
                                                            <option value="N/A" {{ old('ICD106', isset($diagnosis) ? $diagnosis->ICD106 : '') == 'N/A' ? 'selected' : '' }}>N/A</option>
                                                            @foreach ($icd10 as $drs)
                                                            <option value="{{ $drs->Code }}" {{ old('ICD106', isset($diagnosis) ? $diagnosis->ICD106 : '') == $drs->Code ? 'selected' : '' }}>{{ $drs->Code }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <span>
                                                        <small class="text-danger font-weight-light font-italic">
                                                            @error('ICD106')
                                                            {{ $message }}
                                                            @enderror
                                                        </small>
                                                    </span>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-form-label form-control-sm"># 7</label>
                                                    <div class="input-group mb-3">
                                                        <select class="form-control form-control-sm" required name="ICD107" id="ICD107">
                                                            <option disabled {{ old('ICD107', isset($diagnosis) ? $diagnosis->ICD107 : '') == '' ? 'selected' : '' }}>ICD10 7</option>
                                                            <option value="N/A" {{ old('ICD107', isset($diagnosis) ? $diagnosis->ICD107 : '') == 'N/A' ? 'selected' : '' }}>N/A</option>
                                                            @foreach ($icd10 as $drs)
                                                            <option value="{{ $drs->Code }}" {{ old('ICD107', isset($diagnosis) ? $diagnosis->ICD107 : '') == $drs->Code ? 'selected' : '' }}>{{ $drs->Code }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <span>
                                                        <small class="text-danger font-weight-light font-italic">
                                                            @error('ICD107')
                                                            {{ $message }}
                                                            @enderror
                                                        </small>
                                                    </span>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-form-label form-control-sm"># 8</label>
                                                    <div class="input-group mb-3">
                                                        <select class="form-control form-control-sm" required name="ICD108" id="ICD108">
                                                            <option disabled {{ old('ICD108', isset($diagnosis) ? $diagnosis->ICD108 : '') == '' ? 'selected' : '' }}>ICD10 8</option>
                                                            <option value="N/A" {{ old('ICD108', isset($diagnosis) ? $diagnosis->ICD108 : '') == 'N/A' ? 'selected' : '' }}>N/A</option>
                                                            @foreach ($icd10 as $drs)
                                                            <option value="{{ $drs->Code }}" {{ old('ICD108', isset($diagnosis) ? $diagnosis->ICD108 : '') == $drs->Code ? 'selected' : '' }}>{{ $drs->Code }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <span>
                                                        <small class="text-danger font-weight-light font-italic">
                                                            @error('ICD108')
                                                            {{ $message }}
                                                            @enderror
                                                        </small>
                                                    </span>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-form-label form-control-sm"># 9</label>
                                                    <div class="input-group mb-3">
                                                        <select class="form-control form-control-sm" required name="ICD109" id="ICD109">
                                                            <option disabled {{ old('ICD109', isset($diagnosis) ? $diagnosis->ICD109 : '') == '' ? 'selected' : '' }}>ICD10 9</option>
                                                            <option value="N/A" {{ old('ICD109', isset($diagnosis) ? $diagnosis->ICD109 : '') == 'N/A' ? 'selected' : '' }}>N/A</option>
                                                            @foreach ($icd10 as $drs)
                                                            <option value="{{ $drs->Code }}" `{{ old('ICD109', isset($diagnosis) ? $diagnosis->ICD109 : '') == $drs->Code ? 'selected' : '' }}>{{ $drs->Code }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <span>
                                                        <small class="text-danger font-weight-light font-italic">
                                                            @error('ICD109')
                                                            {{ $message }}
                                                            @enderror
                                                        </small>
                                                    </span>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-form-label form-control-sm"># 10</label>
                                                    <div class="input-group mb-3">
                                                        <select class="form-control form-control-sm" required name="ICD1010" id="ICD1010">
                                                            <option disabled {{ old('ICD1010', isset($diagnosis) ? $diagnosis->ICD1010 : '') == '' ? 'selected' : '' }}>ICD10 10</option>
                                                            <option value="N/A" {{ old('ICD1010', isset($diagnosis) ? $diagnosis->ICD1010 : '') == 'N/A' ? 'selected' : '' }}>N/A</option>
                                                            @foreach ($icd10 as $drs)
                                                            <option value="{{ $drs->Code }}" {{ old('ICD1010', isset($diagnosis) ? $diagnosis->ICD1010 : '') == $drs->Code ? 'selected' : '' }}>{{ $drs->Code }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <span>
                                                        <small class="text-danger font-weight-light font-italic">
                                                            @error('ICD1010')
                                                            {{ $message }}
                                                            @enderror
                                                        </small>
                                                    </span>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-form-label form-control-sm"># 11</label>
                                                    <div class="input-group mb-3">
                                                        <select class="form-control form-control-sm" required name="ICD1011" id="ICD1011">
                                                            <option disabled {{ old('ICD1011', isset($diagnosis) ? $diagnosis->ICD1011 : '') == '' ? 'selected' : '' }}>ICD10 11</option>
                                                            <option value="N/A" {{ old('ICD1011', isset($diagnosis) ? $diagnosis->ICD1011 : '') == 'N/A' ? 'selected' : '' }}>N/A</option>
                                                            @foreach ($icd10 as $drs)
                                                            <option value="{{ $drs->Code }}" {{ old('ICD1011', isset($diagnosis) ? $diagnosis->ICD1011 : '') == $drs->Code ? 'selected' : '' }}>{{ $drs->Code }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <span>
                                                        <small class="text-danger font-weight-light font-italic">
                                                            @error('ICD1011')
                                                            {{ $message }}
                                                            @enderror
                                                        </small>
                                                    </span>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-form-label form-control-sm"># 12</label>
                                                    <div class="input-group mb-3">
                                                        <select class="form-control form-control-sm" required name="ICD1012" id="ICD1012">
                                                            <option {{ old('ICD1012', isset($diagnosis) ? $diagnosis->ICD1012 : '') == '' ? 'selected' : '' }} disabled>ICD10 12</option>
                                                            <option value="N/A" {{ old('ICD1012', isset($diagnosis) ? $diagnosis->ICD1012 : '') == 'N/A' ? 'selected' : '' }}>N/A</option>
                                                            @foreach ($icd10 as $drs)
                                                            <option value="{{ $drs->Code }}" {{ old('ICD1012', isset($diagnosis) ? $diagnosis->ICD1012 : '') == $drs->Code ? 'selected' : '' }}>{{ $drs->Code }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <span>
                                                        <small class="text-danger font-weight-light font-italic">
                                                            @error('ICD1012')
                                                            {{ $message }}
                                                            @enderror
                                                        </small>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <br>
                                    <div class="col">
                                        <button type="submit" class="btn btn-primary btn-block">Save</button>
                                    </div>
                                </form>
                            </div>

                            <div class="tab-pane fade show active" id="tab-6" role="tabpanel" aria-labelledby="product-tab-4">
                                @if($mode != "view")
                                <form method="post" action="/AddEditOrders/{{ $mode == 'edit' ? $order->id : 0 }}">
                                    @endif
                                    @csrf
                                    <div class="card">
                                        <br>
                                        <div class="card-body">
                                            @if ($errors->any())
                                            <div class="row">
                                                <div class="col">
                                                    <div class="alert alert-danger">
                                                        <ul>
                                                            @foreach ($errors->all() as $error)
                                                            <li>{{ $error }}</li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            @endif
                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label class="col-form-label form-control-sm form-control-sm">Patient Name</label>
                                                        <div class="input-group mb-3">
                                                            <input type="hidden" id="patient-id" name="Patient_ID" value="{{ old('Patient_ID', $tp->id) }}">

                                                            <input type="text" required placeholder="Patient Name" name="Patient_Name" class="form-control form-control-sm" value="{{ old('Patient_Name', isset($order) ? $order->Patient_Name : $tp->name) }}">
                                                        </div>
                                                        <span><small class="text-danger font-weight-light font-italic">
                                                                @error('Patient_Name')
                                                                {{ $message }}
                                                                @enderror
                                                            </small></span>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-form-label form-control-sm form-control-sm">Address</label>
                                                        <div class="input-group mb-3">
                                                            <input type="text" required placeholder="Address" name="Address" class="form-control form-control-sm"
                                                                value="{{ old('Address', isset($order) ? $order->Address : $tp->Location) }}">

                                                        </div>
                                                        <span><small class="text-danger font-weight-light font-italic">
                                                                @error('Address')
                                                                {{ $message }}
                                                                @enderror
                                                            </small></span>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-form-label form-control-sm">City</label>
                                                        <div class="input-group mb-3">
                                                            <input type="text" required placeholder="City" id="City" name="City" class="form-control form-control-sm"
                                                                value="{{ old('City', isset($order) ? $order->City : '') }}">

                                                        </div>
                                                        <span><small class="text-danger font-weight-light font-italic">
                                                                @error('City')
                                                                {{ $message }}
                                                                @enderror
                                                            </small></span>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-form-label form-control-sm">Account&nbsp;#</label>
                                                        <div class="input-group mb-3">
                                                            <input type="text" required placeholder="Account #" name="Account" class="form-control form-control-sm"
                                                                value="{{ old('Account', isset($order) ? $order->Account : $tp->AccNumber) }}">
                                                        </div>
                                                        <span><small class="text-danger font-weight-light font-italic">
                                                                @error('Account')
                                                                {{ $message }}
                                                                @enderror
                                                            </small></span>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-form-label form-control-sm">Phone&nbsp;1</label>
                                                        <div class="input-group mb-3">
                                                            <input type="text" required placeholder="Phone" name="Phone" class="form-control form-control-sm"
                                                                value="{{ old('Phone', isset($order) ? $order->Phone : $phone1) }}">
                                                        </div>
                                                        <span><small class="text-danger font-weight-light font-italic">
                                                                @error('Phone')
                                                                {{ $message }}
                                                                @enderror
                                                            </small></span>
                                                    </div>


                                                </div>
                                                <div class="col">

                                                    <div class="form-group">
                                                        <label class="col-form-label form-control-sm form-control-sm">Patient Last Name</label>
                                                        <div class="input-group mb-3">
                                                            <input type="text" required placeholder="Patient Last Name" name="Patient_Last_Name" class="form-control form-control-sm" value="{{ old('Patient_Last_Name', isset($order) ? $order->Patient_Last_Name : $tp->last_Name) }}">
                                                        </div>
                                                        <span><small class="text-danger font-weight-light font-italic">
                                                                @error('Patient_Last_Name')
                                                                {{ $message }}
                                                                @enderror
                                                            </small></span>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-form-label form-control-sm">State</label>
                                                        <div class="input-group mb-3">
                                                            <input type="text" required id="State" placeholder="State" name="State" class="form-control form-control-sm"
                                                                value="{{ old('State', isset($order) ? $order->State : '') }}">

                                                        </div>
                                                        <span><small class="text-danger font-weight-light font-italic">
                                                                @error('State')
                                                                {{ $message }}
                                                                @enderror
                                                            </small></span>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-form-label form-control-sm">ZIP</label>
                                                        <div class="input-group mb-3">
                                                            <input type="text" required placeholder="ZIP" name="ZIP" id="ZIP" class="form-control form-control-sm"
                                                                value="{{ old('ZIP', isset($order) ? $order->ZIP : '') }}">

                                                        </div>
                                                        <span><small class="text-danger font-weight-light font-italic">
                                                                @error('ZIP')
                                                                {{ $message }}
                                                                @enderror
                                                            </small></span>
                                                    </div>


                                                    <div class="form-group">
                                                        <label class="col-form-label form-control-sm">Patient DOB</label>
                                                        <div class="input-group mb-3">
                                                            <input type="text" required placeholder="Patient DOB" name="Patient_DOB" class="form-control form-control-sm" value="{{ old('Patient_DOB', isset($order) ? $order->Patient_DOB : $tp->Dob) }}">
                                                        </div>
                                                        <span><small class="text-danger font-weight-light font-italic">
                                                                @error('Patient_DOB')
                                                                {{ $message }}
                                                                @enderror
                                                            </small></span>
                                                    </div>



                                                    <div class="form-group">
                                                        <label class="col-form-label form-control-sm">Email</label>
                                                        <div class="input-group mb-3">
                                                            <input type="text" required placeholder="Email" name="Email" class="form-control form-control-sm"
                                                                value="{{ old('Email',isset($order) ? $order->Email : $tp->p_mail) }}">

                                                        </div>
                                                        <span><small class="text-danger font-weight-light font-italic">
                                                                @error('Email')
                                                                {{ $message }}
                                                                @enderror
                                                            </small></span>
                                                    </div>
                                                </div>
                                                <div class="col" style="border: 1px solid black; box-sizing: border-box; height: fit-content;">
                                                    @if($mode == "view")
                                                    <form action="{{url('UpdateOrder', $mode == 'view' ? $order->id : 0)}}" method="post" id="updatePatientForm">
                                                        @csrf
                                                        @endif
                                                        <input type="hidden" name="previous_url" value="{{ url()->previous() }}">
                                                        <input type="hidden" name="OrderID" value="{{ old('id',isset($order) ? $order->id : '') }}">
                                                        <span>&nbsp;</span>
                                                        <div class="form-group">
                                                            <label class="col-form-label form-control-sm">Order Status </label>
                                                            <div class="input-group mb-3">
                                                                <select class="form-control form-control-sm" required id="statusSelect" name="OrderStatus">
                                                                    @foreach ($st as $drs)
                                                                    <option value="{{ $drs->id }}" {{ old('OrderStatus', isset($order) ? $order->OrderStatus : '') == $drs->id ? 'selected' : '' }}>{{ $drs->Status }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <span>
                                                                <small class="text-danger font-weight-light font-italic">
                                                                    @error('OrderStatus')
                                                                    {{ $message }}
                                                                    @enderror
                                                                </small>
                                                            </span>
                                                        </div>

                                                        <div class="form-group">
                                                            <label class="col-form-label form-control-sm">Department</label>
                                                            <div class="input-group mb-3">
                                                                <select class="form-control form-control-sm" id="statusdept-dropdown" required name="Department">
                                                                    <option disabled {{ old('Department', isset($order) ? $order->Department : '') == '' ? 'selected' : '' }}>Department </option>
                                                                    @foreach ($department as $drs)
                                                                    <option value="{{ $drs->id }}" {{ old('Department', isset($order) ? $order->Department : '') == $drs->id ? 'selected' : '' }}>{{ $drs->Department }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <span>
                                                                <small class="text-danger font-weight-light font-italic">
                                                                    @error('Department')
                                                                    {{ $message }}
                                                                    @enderror
                                                                </small>
                                                            </span>
                                                        </div>

                                                        <div class="form-group">
                                                            <label class="col-form-label form-control-sm">Assign User</label>
                                                            <div class="input-group mb-3">
                                                                <select class="form-control form-control-sm" id="user-dropdown" required name="AssignUser">
                                                                    <option disabled {{ old('AssignUser', isset($order) ? $order->AssignUser : '') == '' ? 'selected' : '' }}>Assign User</option>
                                                                    @foreach ($user as $drs)
                                                                    <option value="{{ $drs->id }}" {{ old('AssignUser', isset($order) ? $order->AssignUser : '') == $drs->id ? 'selected' : '' }}>{{ $drs->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <span>
                                                                <small class="text-danger font-weight-light font-italic">
                                                                    @error('AssignUser')
                                                                    {{ $message }}
                                                                    @enderror
                                                                </small>
                                                            </span>
                                                        </div>
                                                        <input type="hidden" value="{{ isset($order) ? $order->OrderStatus : '' }}" id="StatusCheck">

                                                        <div class="row" id="PatientDetail-checkboxes" style="display: none;">

                                                            <?php $selectedOptions = json_decode($order->options ?? '[]', true); ?>

                                                            <div class="col pl-lg-0 pl-md-0 border-left m-b-30">
                                                                <div class="small-text">

                                                                    <label class="col-form-label">&nbsp;<strong>Checklist<span style="color:red;">*</span></strong></label>
                                                                    <div class="col">
                                                                        <label class="custom-control custom-checkbox">
                                                                            <input type="checkbox" class="custom-control-input" name="options[]" value="Rx" id="view-only-checkbox" {{ in_array("Rx", $selectedOptions) ? 'checked' : '' }}>
                                                                            <span class="custom-control-label small-text">Rx</span>
                                                                        </label>
                                                                    </div>

                                                                    <div class="col">
                                                                        <label class="custom-control custom-checkbox">
                                                                            <input type="checkbox" class="custom-control-input" name="options[]" value="Eligibility Check" {{ in_array("Eligibility Check", $selectedOptions) ? 'checked' : '' }}>
                                                                            <span class="custom-control-label small-text">Eligibility&nbsp;Check</span>
                                                                        </label>
                                                                    </div>

                                                                    <div class="col">
                                                                        <label class="custom-control custom-checkbox">
                                                                            <input type="checkbox" class="custom-control-input" name="options[]" value="Office Notes and Medical Records" {{ in_array("Office Notes and Medical Records", $selectedOptions) ? 'checked' : '' }}>
                                                                            <span class="custom-control-label small-text">Office&nbsp;Notes&nbsp;and&nbsp;Medical&nbsp;Records</span>
                                                                        </label>
                                                                    </div>
                                                                    <div class="col">
                                                                        <label class="custom-control custom-checkbox">
                                                                            <input type="checkbox" class="custom-control-input" name="options[]" id="sleep-study-checkbox" value="Sleep Study" {{ in_array("Sleep Study", $selectedOptions) ? 'checked' : '' }}>
                                                                            <span class="custom-control-label small-text">Sleep&nbsp;Study</span>
                                                                        </label>
                                                                    </div>

                                                                    <div class="col">
                                                                        <label class="custom-control custom-checkbox">
                                                                            <input type="checkbox" class="custom-control-input" name="options[]" id="non-sleep-study-checkbox" value="Non Sleep Study" {{ in_array("Non Sleep Study", $selectedOptions) ? 'checked' : '' }}>
                                                                            <span class="custom-control-label small-text">Non&nbsp;Sleep&nbsp;Study</span>
                                                                        </label>
                                                                    </div>
                                                                    <div class="col">
                                                                        <label class="custom-control custom-checkbox">
                                                                            <input type="checkbox" class="custom-control-input" name="options[]" value="Dr's NPI Verification" {{ in_array("Dr's NPI Verification", $selectedOptions) ? 'checked' : '' }}>
                                                                            <span class="custom-control-label small-text">Dr's&nbsp;NPI&nbsp;Verification</span>
                                                                        </label>
                                                                    </div>

                                                                    <div class="col">
                                                                        <label class="custom-control custom-checkbox">
                                                                            <input type="checkbox" class="custom-control-input" name="options[]" value="Dr's License Check" {{ in_array("Dr's License Check", $selectedOptions) ? 'checked' : '' }}>
                                                                            <span class="custom-control-label small-text">Dr's&nbsp;License&nbsp;Check</span>
                                                                        </label>
                                                                    </div>

                                                                    <div class="col">
                                                                        <label class="custom-control custom-checkbox">
                                                                            <input type="checkbox" class="custom-control-input" name="options[]" value="Pecos Check" {{ in_array("Pecos Check", $selectedOptions) ? 'checked' : '' }}>
                                                                            <span class="custom-control-label small-text">Pecos&nbsp;Check</span>
                                                                        </label>
                                                                    </div>

                                                                    <div class="col">
                                                                        <label class="custom-control custom-checkbox">
                                                                            <input type="checkbox" class="custom-control-input" name="options[]" value="Same &amp; Similar Check" {{ in_array("Same & Similar Check", $selectedOptions) ? 'checked' : '' }}>
                                                                            <span class="custom-control-label small-text">Same&nbsp;&amp;&nbsp;Similar&nbsp;Check</span>
                                                                        </label>
                                                                    </div>

                                                                    <div class="col">
                                                                        <label class="custom-control custom-checkbox">
                                                                            <input type="checkbox" class="custom-control-input" id="AuthRequired" name="options[]" value="Auth Required" {{ in_array("Auth Required", $selectedOptions) ? 'checked' : '' }}>
                                                                            <span class="custom-control-label small-text">Auth&nbsp;Required</span>
                                                                        </label>
                                                                    </div>

                                                                    <div class="col">
                                                                        <label class="custom-control custom-checkbox">
                                                                            <input type="checkbox" class="custom-control-input" id="AuthNotRequired" name="options[]" value="Auth Not Required" {{ in_array("Auth Not Required", $selectedOptions) ? 'checked' : '' }}>
                                                                            <span class="custom-control-label small-text">Auth&nbsp;Not&nbsp;Required</span>
                                                                        </label>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div id="resupplyDiv" style="display: none;">
                                                            @php
                                                            $statusName = \App\Models\Status::find($order?->Order_Status);
                                                            @endphp

                                                            <div class="form-group">
                                                                <label class="col-form-label form-control-sm">Initial Resupply Date </label>
                                                                <div class="input-group mb-3">
                                                                    <input type="date" name="resupplyDate" id="resupplyDate" class="form-control" value="{{ old('resupplyDate',isset($order) ? $order->resupplyDate : '') }}" />
                                                                </div>
                                                                <span>
                                                                    <small class="text-danger font-weight-light font-italic">
                                                                        @error('resupplyDate')
                                                                        {{ $message }}
                                                                        @enderror
                                                                    </small>
                                                                </span>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="col-form-label form-control-sm">Next Resupply Date </label>
                                                                <div class="input-group mb-3">
                                                                    <input type="date" id="newResupplyDate" name="newResupplyDate" class="form-control" value="{{ old('newResupplyDate',isset($order) ? $order->newResupplyDate : '') }}">
                                                                </div>
                                                                <span>
                                                                    <small class="text-danger font-weight-light font-italic">
                                                                        @error('newResupplyDate')
                                                                        {{ $message }}
                                                                        @enderror
                                                                    </small>
                                                                </span>
                                                            </div>

                                                            <div class="form-group">
                                                                <label class="col-form-label form-control-sm">Frequency </label>
                                                                <div class="input-group mb-3">
                                                                    <select class="form-control" id="newFrequency" name="newFrequency">

                                                                        <option value="30" {{ old('newFrequency', isset($order) ? $order->newFrequency : '') == '30' ? 'selected' : '' }}>30 Days</option>

                                                                        <option value="60" {{ old('newFrequency', isset($order) ? $order->newFrequency : '') == '60' ? 'selected' : '' }}>60 Days</option>

                                                                        <option value="90" {{ old('newFrequency', isset($order) ? $order->newFrequency : '') == '90' ? 'selected' : '' }}>90 Days</option>

                                                                        <option value="180" {{ old('newFrequency', isset($order) ? $order->newFrequency : '') == '180' ? 'selected' : '' }}>180 Days</option>

                                                                        <option {{ old('newFrequency', isset($order) ? $order->newFrequency : '') == '365' ? 'selected' : '' }} value="365">365 Days</option>
                                                                    </select>
                                                                </div>
                                                                <span>
                                                                    <small class="text-danger font-weight-light font-italic">
                                                                        @error('OrderStatus')
                                                                        {{ $message }}
                                                                        @enderror
                                                                    </small>
                                                                </span>
                                                            </div>

                                                            <div class="form-group">
                                                                <label class="col-form-label form-control-sm">Resupply Process Dept </label>
                                                                <div class="input-group mb-3">
                                                                    <select class="form-control " id="newDept" name="newDept">
                                                                        @foreach ($department as $sts)
                                                                        <option value="{{ $sts->id }}" {{ old('newDept', isset($order) ? $order->newDept : '') == $sts->id ? 'selected' : '' }}>{{ $sts->Department }}</option>
                                                                        @endforeach

                                                                    </select>
                                                                </div>
                                                                <span>
                                                                    <small class="text-danger font-weight-light font-italic">
                                                                        @error('OrderStatus')
                                                                        {{ $message }}
                                                                        @enderror
                                                                    </small>
                                                                </span>
                                                            </div>

                                                        </div>

                                                        @if ( $mode == "view" )
                                                        <button type="submit" class="btn btn-primary btn-sm m-1 btn-block">Save</button>
                                                        @endif
                                                    </form>

                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label class="col-form-label form-control-sm">Phone 2</label>
                                                        <div class="input-group mb-3">
                                                            <input type="text" required placeholder="Phone 2" name="Phone2" class="form-control form-control-sm" value="{{ old('Phone2',isset($order) ? $order->Phone2 : $phone2) }}">
                                                        </div>
                                                        <span><small class="text-danger font-weight-light font-italic">
                                                                @error('Phone2')
                                                                {{ $message }}
                                                                @enderror
                                                            </small></span>
                                                    </div>
                                                </div>

                                                <div class="col">
                                                    <!-- purpousely left -->
                                                </div>
                                                <div class="col">
                                                    <!-- purpousely left -->
                                                </div>
                                            </div>

                                            <hr>
                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label class="col-form-label form-control-sm">Dr Office</label>
                                                        <div class="input-group mb-3">
                                                            <input type="text" required placeholder="Dr Office" name="DrOffice" class="form-control form-control-sm" value="{{ old('DrOffice', isset($order) ? $order->DrOffice : $offName->Office_Name) }}">
                                                        </div>
                                                        <span><small class="text-danger font-weight-light font-italic">
                                                                @error('DrOffice')
                                                                {{ $message }}
                                                                @enderror
                                                            </small></span>
                                                    </div>
                                                </div>

                                                <div class="col">
                                                    <div class="form-group">
                                                        <label class="col-form-label form-control-sm">Dr Office Phone</label>
                                                        <div class="input-group mb-3">
                                                            <input type="text" required placeholder="Dr Office Phone" name="DrPhone" class="form-control form-control-sm"
                                                                value="{{ old('DrPhone', isset($order) ? $order->DrPhone : '(' . substr($offName->Phone_Num, 0, 3) . ') ' . substr($offName->Phone_Num, 3, 3) . '-' . substr($offName->Phone_Num, 6)) }}">

                                                        </div>
                                                        <span><small class="text-danger font-weight-light font-italic">
                                                                @error('DrPhone')
                                                                {{ $message }}
                                                                @enderror
                                                            </small></span>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label class="col-form-label form-control-sm">Dr Office Fax</label>
                                                        <div class="input-group mb-3">
                                                            <input type="text" required placeholder="Dr Office Fax" name="DrFax" class="form-control form-control-sm"
                                                                value="{{ old('DrFax', isset($order) ? $order->DrFax :'(' . substr($offName->Fax, 0, 3) . ') ' . substr($offName->Fax, 3, 3) . '-' . substr($offName->Fax, 6)) }}">

                                                        </div>
                                                        <span><small class="text-danger font-weight-light font-italic">
                                                                @error('DrFax')
                                                                {{ $message }}
                                                                @enderror
                                                            </small></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>

                                            <hr>

                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label class="col-form-label form-control-sm">Dr Name</label>
                                                        <div class="input-group mb-3">

                                                            <select class="form-control form-control-sm" id="NPIDoctorName" required name="DrName">
                                                                <option disabled {{ old('DrName', isset($order) ? $order->DrName : '') == '' ? 'selected' : '' }}>DrName </option>
                                                                @foreach ($DoctorsData as $drs)
                                                                <option value="{{ $drs->FirstName. ' '.$drs->LastName }}" {{ old('DrName', isset($order) ? $order->DrName : '') == $drs->FirstName. ' '.$drs->LastName ? 'selected' : '' }} data-phone="{{ $drs->Phone }}" data-npi="{{ $drs->NPI }}">{{ $drs->FirstName. ' '.$drs->LastName }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <span><small class="text-danger font-weight-light font-italic">
                                                                @error('DrName')
                                                                {{ $message }}
                                                                @enderror
                                                            </small></span>
                                                    </div>
                                                </div>

                                                <div class="col">
                                                    <div class="form-group">
                                                        <label class="col-form-label form-control-sm">Dr Phone</label>
                                                        <div class="input-group mb-3">
                                                            <input type="text" readonly id="NPIDoctorPhone" required placeholder="Dr Phone" name="DrPhone1" class="form-control form-control-sm"
                                                                value="{{ old('DrPhone1', isset($order) ? $order->DrPhone1 : '' ) }}">
                                                        </div>
                                                        <span><small class="text-danger font-weight-light font-italic">
                                                                @error('DrPhone1')
                                                                {{ $message }}
                                                                @enderror
                                                            </small></span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label class="col-form-label form-control-sm">Doctor&nbsp;NPI</label>
                                                        <div class="input-group mb-3">
                                                            <input type="text" required placeholder="Dr NPI" id="npiNumber" name="DrNPI" class="form-control form-control-sm" value="{{ old('DrNPI', isset($order) ? $order->DrNPI : '') }}">
                                                            <!-- 1538206818 -->
                                                        </div>
                                                        <span><small class="text-danger font-weight-light font-italic">
                                                                @error('DrNPI')
                                                                {{ $message }}
                                                                @enderror
                                                            </small></span>
                                                    </div>
                                                </div>

                                                <div class="col">
                                                    <div class="form-group">
                                                        <label class="col-form-label form-control-sm">Checked&nbsp;By</label>
                                                        <div class="input-group mb-3">
                                                            <input type="text" readonly name="LastCheckUser" id="LastCheckUser" class="form-control form-control-sm"
                                                                value="{{ old('LastCheckUser', isset($order) ? $order->LastCheckUser : '') }}">
                                                        </div>
                                                        <span><small class="text-danger font-weight-light font-italic">
                                                                @error('LastCheckUser')
                                                                {{ $message }}
                                                                @enderror
                                                            </small></span>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label class="col-form-label form-control-sm">Checked&nbsp;Date</label>
                                                        <div class="input-group mb-3">
                                                            <input type="date" name="CheckedDate" id="LastCheck" readonly class="form-control form-control-sm"
                                                                value="{{ old('CheckedDate', isset($order) ? $order->CheckedDate : '') }}">

                                                        </div>
                                                        <span><small class="text-danger font-weight-light font-italic">
                                                                @error('CheckedDate')
                                                                {{ $message }}
                                                                @enderror
                                                            </small></span>
                                                    </div>
                                                </div>
                                                @if ($mode != "view")
                                                <div class="col">
                                                    <button class="btn btn-primary" style="padding: 0.25rem 0.5rem; font-size: 0.875rem; line-height: 1.5;" id="checkNpiButton">Check NPI</button>
                                                </div>
                                                @endif
                                                <div class="col">
                                                    <div id="npiStatus"></div>
                                                </div>
                                            </div>


                                            <hr>


                                            <div class="col">
                                                <div class="form-group">
                                                    <label class="col-form-label form-control-sm">Order Type</label>
                                                    <div class="input-group mb-3">
                                                        <select class="form-control form-control-sm" id="Order-Type-dropdown" required name="OrderType">
                                                            <option disabled {{ old('OrderType', isset($order) ? $order->OrderType : '') == '' ? 'selected' : '' }}>Order Type</option>

                                                            <option value="Retail Sale" {{ old('OrderType', isset($order) ? $order->OrderType : '') == 'Retail Sale' ? 'selected' : '' }}>Retail Sale</option>

                                                            <option value="Retail Rental" {{ old('OrderType', isset($order) ? $order->OrderType : '') == 'Retail Rental' ? 'selected' : '' }}>Retail Rental</option>

                                                            <option value="Insurance" {{ old('OrderType', isset($order) ? $order->OrderType : '') == 'Insurance' ? 'selected' : '' }}>Insurance</option>

                                                            <option value="Insurance Rental" {{ old('OrderType', isset($order) ? $order->OrderType : '') == 'Insurance Rental' ? 'selected' : '' }}>Insurance Rental</option>
                                                        </select>
                                                    </div>
                                                    <span>
                                                        <small class="text-danger font-weight-light font-italic">
                                                            @error('OrderType')
                                                            {{ $message }}
                                                            @enderror
                                                        </small>
                                                    </span>
                                                </div>
                                            </div>

                                            <div id="policyFields">
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label class="col-form-label form-control-sm">Policy 1 </label>
                                                            <div class="input-group mb-3">
                                                                <input type="text" placeholder="Policy 1 " id="Policy1" name="Policy1" class="form-control form-control-sm policy-input" value="{{ old('Policy1') }}">
                                                            </div>
                                                            <span><small class="text-danger font-weight-light font-italic">
                                                                    @error('Policy1')
                                                                    {{ $message }}
                                                                    @enderror
                                                                </small></span>
                                                        </div>
                                                    </div>

                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label class="col-form-label form-control-sm">Policy 2</label>
                                                            <div class="input-group mb-3">
                                                                <input type="text" placeholder="Policy 2" name="Policy2" id="Policy2" class="form-control form-control-sm"
                                                                    value="{{ old('Policy2', isset($order) ? $order->Policy2 : '') }}">

                                                            </div>
                                                            <span><small class="text-danger font-weight-light font-italic">
                                                                    @error('Policy2')
                                                                    {{ $message }}
                                                                    @enderror
                                                                </small></span>
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="row">
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label class="col-form-label form-control-sm">Policy 3 </label>
                                                            <div class="input-group mb-3">
                                                                <input type="text" placeholder="Policy 3 " name="Policy3" id="Policy3" class="form-control form-control-sm" value="{{ old('Policy3', isset($order) ? $order->Policy3 : '') }}">
                                                            </div>
                                                            <span><small class="text-danger font-weight-light font-italic">
                                                                    @error('Policy3')
                                                                    {{ $message }}
                                                                    @enderror
                                                                </small></span>
                                                        </div>
                                                    </div>

                                                    <div class="col">
                                                        <div class="form-group">
                                                            <label class="col-form-label form-control-sm">Policy 4</label>
                                                            <div class="input-group mb-3">
                                                                <input type="text" placeholder="Policy 4" name="Policy4" id="Policy4" class="form-control form-control-sm"
                                                                    value="{{ old('Policy4', isset($order) ? $order->Policy4 : '') }}">

                                                            </div>
                                                            <span><small class="text-danger font-weight-light font-italic">
                                                                    @error('Policy4')
                                                                    {{ $message }}
                                                                    @enderror
                                                                </small></span>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <input type="hidden" id="diagnosis-codes" name="diagnosis_codes" value="{{old('diagnosis_codes')}}">
                                            <hr>
                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label class="col-form-label form-control-sm">Inventory&nbsp;Item </label>
                                                        <div class="input-group mb-3">
                                                            <select class="form-control form-control-sm" id="item-dropdown" required name="InventoryItem">
                                                                <option selected disabled>Inventory&nbsp;Item</option>
                                                                @foreach ($inventory as $drs)
                                                                <option value="{{ $drs->id }}" data-diagnosis="{{$drs->DiagnoseCode}}">{{ $drs->Item_Name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <span>
                                                            <small class="text-danger font-weight-light font-italic">
                                                                @error('InventoryItem')
                                                                {{ $message }}
                                                                @enderror
                                                            </small>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label class="col-form-label form-control-sm">Price&nbsp;Code</label>
                                                        <div class="input-group mb-3">
                                                            <select class="form-control form-control-sm select2" id="PriceCode-dropdown" required name="PriceCode">
                                                                <option selected disabled>Price Code </option>
                                                                @foreach ($priceCode as $drs)
                                                                <option value="{{ $drs->id }}">{{ $drs->Insurance }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <span>
                                                            <small class="text-danger font-weight-light font-italic">
                                                                @error('PriceCode')
                                                                {{ $message }}
                                                                @enderror
                                                            </small>
                                                        </span>
                                                    </div>
                                                </div>
                                                @if ($mode != "view")
                                                <div class="col">
                                                    <div class="row">
                                                        <div class="col">
                                                            <button type="button" id="AddItemButton" style="padding: 0.25rem 0.5rem; font-size: 0.875rem; line-height: 1.5;" class="btn btn-primary">Add Item</button>
                                                        </div>

                                                        <div class="col">
                                                            <button type="button" class="btn btn-primary" style="padding: 0.25rem 0.5rem; font-size: 0.875rem; line-height: 1.5;">Add Kit</button>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endif
                                            </div>
                                            <input type="hidden" id="unique-id" name="Items" value="{{ old('Items', isset($order) ? $order->Items : $code) }}">
                                            <div class="row">
                                                <div class="col">
                                                    <table class="table display">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col">S.No</th>
                                                                <th scope="col">Item</th>
                                                                <th scope="col">Warehouse</th>
                                                                <th scope="col">Price Code</th>
                                                                <th scope="col">Sale / Rental Type</th>
                                                                <th scope="col">Action</th>
                                                            </tr>
                                                        </thead>
                                                        <?php
                                                        $sno = 1;
                                                        ?>
                                                        <tbody id="ItemList" class="modal-blur-content">
                                                            @foreach ($OrderItems as $item)
                                                            <tr>
                                                                <td class="text-center">{{ $sno++ }}</td>
                                                                <td class="text-center">{{ $item->item }}</td>
                                                                <td class="text-center">{{ $item->warehouse }}</td>
                                                                <td class="text-center">{{ $item->priceCode }}</td>
                                                                <td class="text-center">{{ $item->Type }}</td>
                                                                <td class="text-center">
                                                                    <button type="button" data-toggle="modal" data-target="#ViewOrder"
                                                                        class="btn btn-success"
                                                                        data-id="{{ $item->id }}"
                                                                        style="padding: 0.25rem 0.5rem; font-size: 0.875rem; line-height: 1.5; border-radius: 0.2rem;"
                                                                        data-toggle="tooltip" data-placement="top" title=""
                                                                        data-original-title="View {{$item->item}}">
                                                                        <i class="fa fa-eye"></i>
                                                                    </button>

                                                                    @if($mode != "view")
                                                                    <button
                                                                        data-url="/deleteOrderItem/{{$item->id}}"
                                                                        data-id="{{$item->id}}"
                                                                        id="delete-item-{{ $item->id }}"
                                                                        class="btn btn-danger "
                                                                        style="padding: 0.25rem 0.5rem; font-size: 0.875rem; line-height: 1.5; border-radius: 0.2rem;"
                                                                        data-toggle="tooltip" data-placement="top" title=""
                                                                        data-original-title="Delete {{$item->item}}">
                                                                        <i class="fa fa-trash"></i>
                                                                    </button>
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>

                                                    <div id="modalLoader" class="modal-loader-overlay" style="display:none;">
                                                        <span class="dashboard-spinner spinner-primary spinner-sm"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>

                                            <div class="row w-100">
                                                <div class="col">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <h2 class="pageheader-title">Billing</h2>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label class="col-form-label form-control-sm">Signature on File</label>
                                                        <div class="input-group mb-3">
                                                            <input type="date" required placeholder="Signature on File" name="SignatureFile" class="form-control form-control-sm" value="{{ old('SignatureFile', isset($order) ? $order->SignatureFile : date('Y-m-d')) }}">
                                                        </div>
                                                        <span><small class="text-danger font-weight-light font-italic">
                                                                @error('SignatureFile')
                                                                {{ $message }}
                                                                @enderror
                                                            </small></span>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label class="col-form-label form-control-sm">Months Valid </label>
                                                        <div class="input-group mb-3">
                                                            <input type="text" required placeholder="Months Valid " name="MonthsValid" class="form-control form-control-sm" value="{{ old('MonthsValid',isset($order) ? $order->MonthsValid : '') }}">
                                                        </div>
                                                        <span><small class="text-danger font-weight-light font-italic">
                                                                @error('MonthsValid')
                                                                {{ $message }}
                                                                @enderror
                                                            </small></span>
                                                    </div>
                                                </div>
                                                <div class="col m-3">
                                                    <label class="custom-control custom-checkbox">
                                                        <input type="checkbox" required class="custom-control-input" readonly disabled checked name="block12">
                                                        <span class="custom-control-label">Block 12 on HCFA</span>
                                                    </label>
                                                </div>
                                                <div class="col m-3">
                                                    <label class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input" readonly disabled checked name="block13">
                                                        <span class="custom-control-label">Block 13 on HCFA</span>
                                                    </label>
                                                </div>
                                            </div>
                                            <!--<input id="eligibilityDetails" name="eligibilityDetails" type="" />-->
                                            <textarea style="display:none;" id="eligibilityDetails" name="eligibilityDetails" rows="20" cols="80">{{ old('eligibilityDetails') }}</textarea>

                                            <div id="eligibilityContainer" style="white-space: pre-wrap;display:none;"></div>



                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label class="col-form-label form-control-sm">Insurance Eligibility</label>
                                                        <div class="input-group mb-3">
                                                            <input
                                                                type="text"
                                                                required
                                                                placeholder="Insurance Eligibility"
                                                                name="InsuranceEligibility"
                                                                class="form-control form-control-sm"
                                                                value="{{ old('InsuranceEligibility', isset($order) ? $order->InsuranceEligibility : '') }}">
                                                            &nbsp;
                                                            &nbsp;
                                                            &nbsp;
                                                            <div class="input-group-append">
                                                                <button
                                                                    type="button"
                                                                    class="btn btn-primary"
                                                                    style="padding: 2px 10px; font-size: 12px;"
                                                                    onclick="checkEligibility()">
                                                                    Check Eligibility
                                                                </button>
                                                            </div>
                                                        </div>
                                                        <span>
                                                            <small class="text-danger font-weight-light font-italic">
                                                                @error('InsuranceEligibility')
                                                                {{ $message }}
                                                                @enderror
                                                            </small>
                                                        </span>
                                                    </div>
                                                </div>

                                                <div class="col">
                                                    <div class="form-group">
                                                        <label class="col-form-label form-control-sm">Tax Rate </label>
                                                        <div class="input-group mb-3">
                                                            <select class="form-control form-control-sm" required name="TaxRate">
                                                                <option disabled {{ old('TaxRate', isset($order) ? $order->TaxRate : '') == '' ? 'selected' : '' }}>Tax Rate</option>
                                                                @foreach ($taxes as $drs)
                                                                <option value="{{ $drs->Name .' ' .$drs->TotalTax }}" {{ old('TaxRate', isset($order) ? $order->TaxRate : '') == $drs->Name .' ' .$drs->TotalTax ? 'selected' : '' }}>{{ $drs->Name .' ' .$drs->TotalTax }}</option>
                                                                @endforeach

                                                                <option value="Tax Exempt 0%" {{ old('TaxRate', isset($order) ? $order->TaxRate : '') == 'Tax Exempt 0%' ? 'selected' : '' }}>Tax Exempt 0%</option>
                                                            </select>
                                                        </div>
                                                        <span>
                                                            <small class="text-danger font-weight-light font-italic">
                                                                @error('TaxRate')
                                                                {{ $message }}
                                                                @enderror
                                                            </small>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label class="col-form-label form-control-sm">Out of Pocket</label>
                                                        <div class="input-group mb-3">
                                                            <input type="text" required placeholder="Out of Pocket" name="OutPocket" class="form-control form-control-sm" value="{{ old('OutPocket', isset($order) ? $order->OutPocket : '') }}">
                                                        </div>
                                                        <span><small class="text-danger font-weight-light font-italic">
                                                                @error('OutPocket')
                                                                {{ $message }}
                                                                @enderror
                                                            </small></span>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label class="col-form-label form-control-sm">Basis</label>
                                                        <div class="input-group mb-3">
                                                            <select class="form-control" required name="Basis">

                                                                <option value="Bill" {{ old('Basis', isset($order) ? $order->Basis : '') == 'Bill' ? 'selected' : '' }}>Bill</option>

                                                                <option value="Allowed" {{ old('Basis', isset($order) ? $order->Basis : '') == 'Allowed' ? 'selected' : '' }}>Allowed</option>

                                                            </select>
                                                        </div>
                                                        <span>
                                                            <small class="text-danger font-weight-light font-italic">
                                                                @error('Basis')
                                                                {{ $message }}
                                                                @enderror
                                                            </small>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label class="col-form-label form-control-sm">Invoice Form: </label>
                                                        <div class="input-group mb-3">
                                                            <select class="form-control" required name="InvoiceForm">
                                                                @foreach ($invoiceForm as $drs)
                                                                <option value="{{ $drs->name }}" {{ old('InvoiceForm', isset($order) ? $order->InvoiceForm : '') == $drs->name ? 'selected' : '' }}>{{ $drs->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <span>
                                                            <small class="text-danger font-weight-light font-italic">
                                                                @error('InvoiceForm')
                                                                {{ $message }}
                                                                @enderror
                                                            </small>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="col m-3">
                                                    <label class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input" required checked name="SupplierStandards">
                                                        <span class="custom-control-label">Supplier Standards</span>
                                                    </label>
                                                </div>
                                                <div class="col m-3">
                                                    <label class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input" required checked name="HIPPANote">
                                                        <span class="custom-control-label">HIPPA Note</span>
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="form-group col ">
                                                    <label>POS</label>
                                                    <div class="input-group">
                                                        <select class="form-control form-control form-control-sm" required name="POS">
                                                            <option value="Home" {{ old('POS', isset($order) ? $order->POS : '') == 'Home' ? 'selected' : '' }}>Home</option>

                                                            <option value="Custodial Care Facility" {{ old('POS', isset($order) ? $order->POS : '') == 'Custodial Care Facility' ? 'selected' : '' }}>Custodial Care Facility</option>

                                                            <option value="Federal Qualified Health Center" {{ old('POS', isset($order) ? $order->POS : '') == 'Federal Qualified Health Center' ? 'selected' : '' }}>Federal Qualified Health Center</option>

                                                            <option value="Homeless Shelter" {{ old('POS', isset($order) ? $order->POS : '') == 'Homeless Shelter' ? 'selected' : '' }}>Homeless Shelter</option>

                                                            <option value="Hospice" {{ old('POS', isset($order) ? $order->POS : '') == 'Hospice' ? 'selected' : '' }}>Hospice</option>

                                                            <option value="Military Treatment Center" {{ old('POS', isset($order) ? $order->POS : '') == 'Military Treatment Center' ? 'selected' : '' }}>Military Treatment Center</option>

                                                            <option value="Mobile Unit" {{ old('POS', isset($order) ? $order->POS : '') == 'Mobile Unit' ? 'selected' : '' }}>Mobile Unit</option>

                                                            <option value="Nursing Facility" {{ old('POS', isset($order) ? $order->POS : '') == 'Nursing Facility' ? 'selected' : '' }}>Nursing Facility</option>

                                                            <option value="Office" {{ old('POS', isset($order) ? $order->POS : '') == 'Office' ? 'selected' : '' }}>Office</option>

                                                            <option value="Other Place of Service" {{ old('POS', isset($order) ? $order->POS : '') == 'Other Place of Service' ? 'selected' : '' }}>Other Place of Service</option>

                                                            <option value="Prison or Correctional Facility" {{ old('POS', isset($order) ? $order->POS : '') == 'Prison or Correctional Facility' ? 'selected' : '' }}>Prison or Correctional Facility</option>

                                                            <option value="Skilled Nursing Facility" {{ old('POS', isset($order) ? $order->POS : '') == 'Skilled Nursing Facility' ? 'selected' : '' }}>Skilled Nursing Facility</option>

                                                            <option value="Urgent Care" {{ old('POS', isset($order) ? $order->POS : '') == 'Urgent Care' ? 'selected' : '' }}>Urgent Care</option>
                                                        </select>
                                                    </div>
                                                    <span>
                                                        <small class="text-danger font-weight-light font-italic">
                                                            @error('POS')
                                                            {{ $message }}
                                                            @enderror
                                                        </small>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="row">
                                                @if($mode != "view")
                                                <div class="col">
                                                    <button type="submit" class="btn btn-primary btn-block">{{ $mode == "add" ? "Add" : "Edit" }} Order</button>
                                                </div>
                                                @elseif ($mode == "view")
                                                <div class="col">
                                                    <a href="{{url('orderPDF', $mode == 'view' ? $order->id : 0) }}" target="_blank" class="btn btn-primary btn-block">Print Order</a>
                                                </div>
                                                @if($order->OrderType == 'Retail Rental')
                                                <div class="col">
                                                    <a href="{{url('rentalAgreementPDF', $mode == 'view' ? $order->id : 0) }}" target="_blank" class="btn btn-primary btn-block">Print Rental Agreement</a>
                                                </div>
                                                @endif
                                                @if($order->OrderStatus == '12')
                                                <div class="col">
                                                    <a href="{{url('generateClaimForm', $mode == 'view' ? $tp->id : 0) }}" target="_blank" class="btn btn-primary btn-block">Generate Claim Form</a>
                                                </div>
                                                @endif
                                                <div class="col">
                                                    <a href="{{ url('pickupTicketPDF') }}" target="_blank" class="btn btn-primary btn-block">Print Pickup Ticket</a>
                                                </div>
                                                <div class="col">
                                                    <button type="button" class="btn btn-primary btn-block" id="generateReportBtn">Print Invoice</button>
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    @if($mode != "view")
                                </form>
                                @endif
                            </div>

                            <div class="tab-pane fade " id="tab-7" role="tabpanel">
                                <div class="review-block">

                                    <ul class="list-unstyled arrow">
                                        <li>
                                        {!! isset($order) ? nl2br(e($order->eligibilityDetails)) : '' !!}


                                            <br> <span><small class="text-dark font-weight-normal font-italic">
                                                    by {{ isset($order) ? $order->CreatedBy : '' }} at {{ isset($order) ? $order->created_at->format('m/d/Y h:i:s A') : '' }} ON ORDER# {{ isset($order) ? $order->id : '' }}
                                                </small></span>
                                        </li>
                                    </ul>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<div class="modal fade" id="ViewOrder" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-xl" role="document"> <!-- Added modal-xl class -->
        <div class="modal-content">
            <div class="modal-header">
                <div class="row w-100"> <!-- Ensure the row spans full width -->
                    <div class="col">
                        <div class="d-flex justify-content-between align-items-center">
                            <h2 class="pageheader-title">Item Details</h2>
                        </div>
                    </div>
                </div>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true ">&times;</span>
                </button>
            </div>
            <div class="modal-body " id="ViewModal-blur-content">
                <div id="ViewModalLoader" class="modal-loader-overlay" style="display:none;">
                    <span class="dashboard-spinner spinner-primary spinner-sm"></span>
                </div>
                <form>
                    @csrf
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label class="col-form-label form-control-sm">Inventory Item </label>
                                <div class="input-group mb-3">
                                    <input type="text" required placeholder="Inventory Item" id="InvItem" name="InventoryItem" class="form-control form-control-sm requiredField" readonly value="{{ old('InventoryItem') }}">
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label class="col-form-label form-control-sm">Sell/Rent Type </label>
                                <div class="input-group mb-3">
                                    <select class="form-control form-control-sm requiredField" id="SellType" required name="SellType">
                                        <option value="Medicare Oxygen Rental">Medicare Oxygen Rental</option>
                                        <option value="One Time Rental">One Time Rental</option>
                                        <option value="Monthly Rental">Monthly Rental</option>
                                        <option value="Capped Rental">Capped Rental</option>
                                        <option value="Parental Capped Rental">Parental Capped Rental</option>
                                        <option value="Rent to Purchase">Rent to Purchase</option>
                                        <option value="One Time Sale">One Time Sale</option>
                                        <option value="Re-occurring Sale">Re-occurring Sale</option>
                                    </select>
                                </div>
                                <span>
                                    <small class="text-danger font-weight-light font-italic">
                                        @error('RentalType')
                                        {{ $message }}
                                        @enderror
                                    </small>
                                </span>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label class="col-form-label form-control-sm">DX Pointer 10</label>
                                <div class="input-group mb-3">
                                    <input type="text" required placeholder="DX Pointer 10" id="DXPointer10" name="DXPointer10" class="form-control form-control-sm requiredField" value="{{ old('DXPointer10') }}">
                                </div>
                                <span><small class="text-danger font-weight-light font-italic">
                                        @error('DXPointer10')
                                        {{ $message }}
                                        @enderror
                                    </small></span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label class="col-form-label form-control-sm">Price Code </label>
                                <div class="input-group mb-3">
                                    <input type="text" required placeholder="PriceCode" id="priceCode" name="PriceCode" class="form-control form-control-sm requiredField" readonly value="{{ old('PriceCode') }}">
                                </div>

                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label class="col-form-label form-control-sm">Serial #</label>
                                <div class="input-group mb-3">
                                    <select class="form-control form-control-sm requiredField" required id="Serial" name="Serial">
                                        <option selected disabled>Serial #</option>

                                    </select>
                                </div>
                                <span>
                                    <small class="text-danger font-weight-light font-italic">
                                        @error('Serial')
                                        {{ $message }}
                                        @enderror
                                    </small>
                                </span>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label class="col-form-label form-control-sm">Prior Auth Type</label>
                                <div class="input-group mb-3">
                                    <select class="form-control form-control-sm requiredField" required id="PriorAuthType" name="PriorAuthType">
                                        <option value="P.O. Number">P.O. Number </option>
                                        <option value="Prior Auth">Prior Auth </option>
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
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label class="col-form-label form-control-sm">Billing Code</label>
                                <div class="input-group mb-3">
                                    <input type="text" required placeholder="Billing Code" name="BillingCode" id="BillingCode" class="form-control form-control-sm requiredField" value="{{ old('BillingCode') }}">
                                </div>
                                <span><small class="text-danger font-weight-light font-italic">
                                        @error('BillingCode')
                                        {{ $message }}
                                        @enderror
                                    </small></span>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label class="col-form-label form-control-sm">Warehouse </label>
                                <div class="input-group mb-3">
                                    <select class="form-control form-control-sm requiredField" required id="WarehouseName" name="Warehouse">
                                        @foreach ($warehouse as $drs)
                                        <option value="{{ $drs->Warehouse_Name }}">{{ $drs->Warehouse_Name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <span>
                                    <small class="text-danger font-weight-light font-italic">
                                        @error('Warehouse')
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
                                    <input type="text" required id="PriorAuthModal" name="PriorAuth" class="form-control form-control-sm requiredField" value="{{ old('PriorAuth') }}">
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
                                <label class="col-form-label form-control-sm">Modifiers</label>
                                <div class="input-group mb-3">
                                    <input type="text" name="modifier1" id="modifier1" maxlength="2" class="form-control form-control-sm requiredField" style="width: 50px;" required>
                                    <input type="text" name="modifier2" id="modifier2" maxlength="2" class="form-control form-control-sm requiredField" style="width: 50px;" required>
                                    <input type="text" name="modifier3" id="modifier3" maxlength="2" class="form-control form-control-sm requiredField" style="width: 50px;" required>
                                    <input type="text" name="modifier4" id="modifier4" maxlength="2" class="form-control form-control-sm requiredField" style="width: 50px;" required>
                                </div>
                                <span><small class="text-danger font-weight-light font-italic">
                                        @error('modifier1') {{ $message }} @enderror
                                        @error('modifier2') {{ $message }} @enderror
                                        @error('modifier3') {{ $message }} @enderror
                                        @error('modifier4') {{ $message }} @enderror
                                    </small></span>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label class="col-form-label form-control-sm">Billable</label>
                                <div class="input-group mb-3">
                                    <input type="text" required placeholder="Billable" name="Billable" id="Billable" class="form-control form-control-sm requiredField" value="{{ old('Billable') }}">
                                </div>
                                <span><small class="text-danger font-weight-light font-italic">
                                        @error('Billable')
                                        {{ $message }}
                                        @enderror
                                    </small></span>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label class="col-form-label form-control-sm">Prior Auth Exp.</label>
                                <div class="input-group mb-3">
                                    <input type="date" required placeholder="Prior Auth Exp" id="PriorAuthExp" name="PriorAuthExp" class="form-control form-control-sm requiredField" value="{{ old('PriorAuthExp') }}">
                                </div>
                                <span><small class="text-danger font-weight-light font-italic">
                                        @error('PriorAuthExp')
                                        {{ $message }}
                                        @enderror
                                    </small></span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label class="col-form-label form-control-sm">HAO</label>
                                <div class="input-group mb-3">
                                    <textarea rows="2" required name="HAO" id="HAO" class="form-control form-control-sm requiredField" value="{{ old('HAO') }}"></textarea>
                                </div>
                                <span><small class="text-danger font-weight-light font-italic">
                                        @error('HAO')
                                        {{ $message }}
                                        @enderror
                                    </small></span>
                            </div>

                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label class="col-form-label form-control-sm">Allowable</label>
                                <div class="input-group mb-3">
                                    <input type="text" required placeholder="Allowable" name="Allowable" id="Allowable" class="form-control requiredField form-control-sm" value="{{ old('Allowable') }}">
                                </div>
                                <span><small class="text-danger font-weight-light font-italic">
                                        @error('Allowable')
                                        {{ $message }}
                                        @enderror
                                    </small></span>
                            </div>
                            <div class="col">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="Taxable" name="Taxable">
                                    <label class="form-check-label">Taxable</label>
                                </div>

                            </div>


                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label class="col-form-label form-control-sm">RX Exp.</label>
                                <div class="input-group mb-3">
                                    <input type="date" required placeholder="RX Exp" name="RXExp" id="RXExp" class="form-control form-control-sm requiredField" value="{{ old('RXExp') }}">
                                </div>
                                <span><small class="text-danger font-weight-light font-italic">
                                        @error('RXExp')
                                        {{ $message }}
                                        @enderror
                                    </small></span>
                            </div>
                        </div>
                    </div>

                    <div class="row m-3">
                        <label>Billing</label>
                        <div class="col">
                            <label class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" name="Ins1">
                                <span class="custom-control-label">Ins 1</span>
                            </label>
                        </div>

                        <div class="col">
                            <label class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" name="Ins2">
                                <span class="custom-control-label">Ins 2</span>
                            </label>
                        </div>

                        <div class="col">
                            <label class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" name="Ins3">
                                <span class="custom-control-label">Bill&nbsp;To&nbsp;Ins 3</span>
                            </label>
                        </div>

                        <div class="col">
                            <label class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" name="Ins4">
                                <span class="custom-control-label">Ins 4</span>
                            </label>
                        </div>

                        <div class="col">
                            <label class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" name="NoPayIns1">
                                <span class="custom-control-label">No Pay Ins 1</span>
                            </label>
                        </div>
                    </div>

                    <hr>
                    <div class="row">
                        <div class="col">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label class="col-form-label form-control-sm">Quantity</label>
                                        <div class="input-group mb-3">
                                            <input type="text" name="Quantity" id="Quantity" class="form-control form-control-sm requiredField" style="width: 20px;" required>
                                        </div>
                                        <span><small class="text-danger font-weight-light font-italic">
                                                @error('Quantity') {{ $message }} @enderror
                                            </small></span>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label class="col-form-label form-control-sm">Units</label>
                                        <div class="input-group mb-3">
                                            <input type="text" name="Units" id="QuantityUnits" class="form-control form-control-sm requiredField" style="width: 20px;" required>
                                        </div>
                                        <span><small class="text-danger font-weight-light font-italic">
                                                @error('Units') {{ $message }} @enderror
                                            </small></span>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label class="col-form-label form-control-sm">When </label>
                                        <div class="input-group mb-3">
                                            <select class="form-control form-control-sm requiredField" id="QuantityOrderType" required name="OrderType">
                                                <option value="One Time">One Time</option>
                                                <option value="Daily">Daily</option>
                                                <option value="Weekly">Weekly</option>
                                                <option value="Monthly">Monthly</option>
                                                <option value="Quarterly">Quarterly</option>
                                                <option value="Semi-Annually">Semi-Annually</option>
                                                <option value="Annually">Annually</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label class="col-form-label form-control-sm">Billed</label>
                                        <div class="input-group mb-3">
                                            <input type="text" name="Billed" id="Billed" class="form-control form-control-sm requiredField" style="width: 20px;" required>
                                        </div>
                                        <span><small class="text-danger font-weight-light font-italic">
                                                @error('Billed') {{ $message }} @enderror
                                            </small></span>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label class="col-form-label form-control-sm">Units</label>
                                        <div class="input-group mb-3">
                                            <input type="text" name="Units" id="BilledUnits" class="form-control form-control-sm requiredField" style="width: 20px;" required>
                                        </div>
                                        <span><small class="text-danger font-weight-light font-italic">
                                                @error('Units') {{ $message }} @enderror
                                            </small></span>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label class="col-form-label form-control-sm">Order Type </label>
                                        <div class="input-group mb-3">
                                            <select class="form-control form-control-sm requiredField" id="BOrderType" required name="OrderType">
                                                <option value="One Time">One Time</option>
                                                <option value="Daily">Daily</option>
                                                <option value="Weekly">Weekly</option>
                                                <option value="Monthly">Monthly</option>
                                                <option value="Quarterly">Quarterly</option>
                                                <option value="Semi-Annually">Semi-Annually</option>
                                                <option value="Annually">Annually</option>
                                            </select>
                                        </div>
                                        <span>
                                            <small class="text-danger font-weight-light font-italic">
                                                @error('OrderType')
                                                {{ $message }}
                                                @enderror
                                            </small>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label class="col-form-label form-control-sm">Delivery</label>
                                        <div class="input-group mb-3">
                                            <input type="text" name="Delivery" id="Delivery" class="form-control form-control-sm requiredField" style="width: 20px;" required>
                                        </div>
                                        <span><small class="text-danger font-weight-light font-italic">
                                                @error('Delivery') {{ $message }} @enderror
                                            </small></span>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label class="col-form-label form-control-sm">Units</label>
                                        <div class="input-group mb-3">
                                            <input type="text" name="Units" id="DeliveryUnits" class="form-control form-control-sm requiredField" style="width: 20px;" required>
                                        </div>
                                        <span><small class="text-danger font-weight-light font-italic">
                                                @error('Units') {{ $message }} @enderror
                                            </small></span>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="card" style="border: 1px solid black;">
                                <div class="card-body">
                                    <h5 class="card-title txt-center">Date Of Service</h5>
                                    <div class="form-group">
                                        <label class="col-form-label form-control-sm">From</label>
                                        <div class="input-group mb-3">
                                            <input type="date" required placeholder="From" id="DOSFrom" name="DOSFrom" class="form-control form-control-sm requiredField" value="{{ old('From') }}">
                                        </div>
                                        <span><small class="text-danger font-weight-light font-italic">
                                                @error('From')
                                                {{ $message }}
                                                @enderror
                                            </small></span>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-form-label form-control-sm">To</label>
                                        <div class="input-group mb-3">
                                            <input type="date" required placeholder="To" name="DOSTo" id="DOSTo" class="form-control form-control-sm requiredField" value="{{ old('To') }}">
                                        </div>
                                        <span><small class="text-danger font-weight-light font-italic">
                                                @error('To')
                                                {{ $message }}
                                                @enderror
                                            </small></span>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-form-label form-control-sm">Billing Month</label>
                                        <div class="input-group mb-3">
                                            <input type="text" required placeholder="Billing Month" id="BillingMonth" name="BillingMonth" class="form-control form-control-sm requiredField" value="{{ old('BillingMonth') }}">
                                        </div>
                                        <span><small class="text-danger font-weight-light font-italic">
                                                @error('BillingMonth')
                                                {{ $message }}
                                                @enderror
                                            </small></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card" style="border: 1px solid black;">
                                <div class="card-body">
                                    <h5 class="card-title txt-center">Bill Item On:</h5>
                                    <label class="custom-control custom-radio">
                                        <input type="radio" value="DayDelivery" name="BillItem" checked class="custom-control-input"><span class="custom-control-label" id="DayDelivery">Day&nbsp;of&nbsp;Delivery</span>
                                    </label>
                                    <label class="custom-control custom-radio">
                                        <input type="radio" value="LastPeriod" name="BillItem" class="custom-control-input"><span class="custom-control-label" id="LastPeriod">Last&nbsp;day&nbsp;of&nbsp;the&nbsp;Period</span>
                                    </label>
                                    <label class="custom-control custom-radio">
                                        <input type="radio" value="BillPickUp" name="BillItem" class="custom-control-input"><span class="custom-control-label" id="BillPickUp">Bill&nbsp;at&nbsp;Pick-Up</span>
                                    </label>
                                    <label class="custom-control custom-radio">
                                        <input type="radio" value="LastMonth" name="BillItem" class="custom-control-input"><span class="custom-control-label" id="LastMonth">Last&nbsp;day&nbsp;of&nbsp;the&nbsp;month</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="OrderIDItem" id="OrderIDItem">
                        <div class="col">
                            <label>CMN/RX</label>
                            <label class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="invoice" checked name="invoice">
                                <span class="custom-control-label">Send&nbsp;CMN/RX&nbsp;with&nbsp;this&nbsp;invoice</span>
                            </label>
                            <label class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" checked disabled>
                                <span class="custom-control-label">Accept&nbsp;Assignment</span>
                            </label>
                        </div>
                    </div>
                    <hr>
            </div>
            <div class="modal-footer">
                @if($mode != "view")
                <button type="button" id="EditOrderItem" class="btn btn-primary">Save</button>
                @endif
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </form>
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
                <form method="post" action="{{url('AddNote', $tp->id)}}" id="NoteForm">
                    @csrf
                    <div class="form-group">
                        <label for="message-text" class="col-form-label form-control-sm">Add Note:</label>
                        <textarea class="form-control" name="note" required id="message-text"></textarea>
                    </div>
                    <input type="hidden" name="OrderID" value="{{ $mode == 'add' ? 0 : $order->id }}" />
                    <div id="predefined-notes-container" style="display: none;">
                        <label class="col-form-label form-control-sm">Predefined Notes:</label>
                        <div class="predefined-notes-bubbles">
                            @foreach($predefinedNotes as $note)
                            <span class="note-bubble" data-note="{{ $note->Text }}">{{ $note->Text }}</span>
                            @endforeach
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
                    @csrf
                    <div class="row">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="documnet" class="col-form-label form-control-sm text-sm small-label">Document Type:</label>
                                <select name="docs" id="documnetEdit" class="form-control form-control-sm" required>
                                    <option value="Prescription (RX)">Prescription (RX)</option>
                                    <option value="CMN">CMN</option>
                                    <option value="Authorization">Authorization</option>
                                    @if($tp->Dept == "5")
                                    <option value="Sleep Study">Sleep Study</option>
                                    @endif
                                    <option value="Office Notes/Medical Records">Office Notes/Medical Records</option>
                                    <option value="Demographics">Demographics</option>
                                    <option value="Manufacturer Order Form">Manufacturer Order Form</option>
                                    @if($tp->Dept == "4")
                                    <option value="Consignment Documents">Consignment Documents</option>
                                    @endif
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
                                <select required name="ptName" id="ptNameEdit" class="form-control form-control-sm">
                                    @foreach ($pati as $pa)
                                    <option @if ($pa->id == $tp->id)
                                        selected
                                        @endif value="{{$pa->id}}">{{$pa->name}}&nbsp;{{$pa->last_Name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="drOff" class="col-form-label form-control-sm small-label">Dr Office:</label>
                                <select required id="drOffEdit" name="drOffEdit" class="form-control form-control-sm">
                                    @foreach ($doctor as $dr)
                                    <option @if ($dr->id == $tp->Off_Name)
                                        selected
                                        @endif disabled value="{{$dr->id}}" >{{$dr->Office_Name}}</option>
                                    @endforeach
                                </select>
                                <!-- <input type="hidden" name="drOff" id="drOffEdit" value="{{$tp->Off_Name}}"> -->
                            </div>

                            <div class="form-group">
                                <label for="patientAcc" class="col-form-label form-control-sm small-label">Patient Acct#:</label>
                                <input type="text" required class="form-control form-control-sm" id="patientAccEdit" value="{{$tp->AccNumber}}" readonly name="patientAcc" required />
                            </div>

                            <div class="form-group">
                                <label for="patientOrder" class="col-form-label form-control-sm small-label">Patient Order#:</label>
                                <input type="text" required class="form-control form-control-sm" id="patientOrderEdit" value="{{$tp->Order_No}}" readonly name="patientOrder" required />
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
                                <label for="FDateEdit" class="col-form-label form-control-sm small-label">Date of Service:</label>
                                <input type="date" class="form-control form-control-sm" id="PFDateEdit" name="PFDateEdit" />
                            </div>
                            <div id="ConsDocEdit">
                                <div class="form-group">
                                    <label for="TDate" class="col-form-label form-control-sm small-label">Date of Service:</label>
                                    <input type="date" class="form-control form-control-sm" id="DOSEdit" name="DOSEdit" />
                                </div>
                            </div>

                            <div id="RXEdit">
                                <h4 class="small-label"><span id="DataeType">Prescription (RX) </span> Date:</h4>
                                <div class="form-group">
                                    <label for="FDateEdit" class="col-form-label form-control-sm small-label">From:</label>
                                    <input type="date" class="form-control form-control-sm" id="FDateEdit" name="FDateEdit" />
                                </div>
                                <div class="form-group">
                                    <label for="TDateEdit" class="col-form-label form-control-sm small-label">TO:</label>
                                    <input type="date" class="form-control form-control-sm" id="TDateEdit" name="TDateEdit" />
                                </div>
                                <div class="form-group">
                                    <label for="duration" class="col-form-label form-control-sm small-label">Duration:</label>
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

                <form method="post" action="{{ url('AddDocument') }}" id="DocumentForm" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="documnet" class="col-form-label form-control-sm text-sm small-label">Document Type:</label>
                                <select name="docs" id="documnet" class="form-control form-control-sm" required>
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
                                <input type="text" value="{{$tp->name.' '.$tp->last_Name}}" disabled placeholder="Enter Type" class="form-control form-control-sm" id="ptName" />

                                <input type="hidden" name="ptName" value="{{$tp->id}}">
                                <input type="hidden" name="ptOrderId" id="document-id" value="">
                            </div>

                            <div class="form-group">
                                <label for="drOff" class="col-form-label form-control-sm small-label">Dr Office:</label>
                                <input type="text" value="{{$offName->Office_Name}}" disabled placeholder="Enter Type" class="form-control form-control-sm" id="drOff AddDocumentLabel" />

                                <input type="hidden" name="drOff" id="drOff" value="{{$tp->Off_Name}}">
                            </div>

                            <div class="form-group">
                                <label for="patientAcc" class="col-form-label form-control-sm small-label">Patient Acct#:</label>
                                <input type="text" required class="form-control form-control-sm" id="patientAcc" value="{{$tp->AccNumber}}" readonly name="patientAcc" required />
                            </div>

                            <div class="form-group">
                                <label for="patientOrder" class="col-form-label form-control-sm small-label">Patient Order#:</label>
                                <input type="text" required class="form-control form-control-sm" id="patientOrder" value="{{$tp->Order_No}}" readonly name="patientOrder" required />
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="fileUpload" class="form-label small-label">Upload File:</label>
                                <input type="file" required name="img" class="form-control form-control-sm" id="fileUpload" accept=".pdf, .heic, .jpeg, .jpg, .png, .tiff, .tif" />
                            </div>
                            <div class="form-group">
                                <img id="previewImage" src="{{asset('pdf.png')}}" alt="Image Preview" style="display: none; max-width: 100%; height: auto;" />
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
                                    <input type="date" class="form-control form-control-sm" id="RXFDate" name="FDate" />
                                </div>
                                <div class="form-group">
                                    <label for="TDate" class="col-form-label form-control-sm small-label">TO:</label>
                                    <input type="date" class="form-control form-control-sm" id="RXTDate" name="TDate" />
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
                                <label for="documnet" class="col-form-label form-control-sm text-sm small-label">Document Type:</label>
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
                                <label for="title" class="col-form-label form-control-sm small-label">Title:</label>
                                <input type="text" readonly placeholder="Enter Title" class="form-control form-control-sm" id="title" name="title" required />
                            </div>

                            <div class="form-group">
                                <label for="type" class="col-form-label form-control-sm small-label">Type:</label>
                                <input readonly type="text" placeholder="Enter Type" class="form-control form-control-sm" id="type" name="type" required />
                            </div>

                            <div class="form-group">
                                <label for="description" class="col-form-label form-control-sm small-label">Description:</label>
                                <textarea readonly required placeholder="Enter Description" class="form-control form-control-sm" id="description" rows="2" cols="2" name="desc"></textarea>
                            </div>


                            <div class="form-group">
                                <label for="ptName" class="col-form-label form-control-sm small-label">Patient Name:</label>
                                <input type="text" value="{{$tp->name}}&nbsp;{{$tp->last_Name}}">
                                <input type="hidden" value="{{$tp->id}}" name="ptName">
                            </div>

                            <div class="form-group">
                                <label for="drOff" class="col-form-label form-control-sm small-label">Dr Office:</label>

                                <select required id="drOff" disabled class="form-control form-control-sm">
                                    @foreach ($doctor as $dr)
                                    <option @if ($dr->id == $tp->Off_Name)
                                        selected
                                        @endif disabled value="{{$dr->id}}" >{{$dr->Office_Name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="patientAcc" class="col-form-label form-control-sm small-label">Patient Acct#:</label>
                                <input disabled type="text" required class="form-control form-control-sm" id="patientAcc" value="{{$tp->AccNumber}}" readonly name="patientAcc" required />
                            </div>

                            <div class="form-group">
                                <label for="patientOrder" class="col-form-label form-control-sm small-label">Patient Order#:</label>
                                <input disabled type="text" required class="form-control form-control-sm" id="patientOrder" value="{{$tp->Order_No}}" readonly name="patientOrder" required />
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="FDate" class="col-form-label form-control-sm small-label">ID#</label>
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
                                <label for="FDateEdit" class="col-form-label form-control-sm small-label">Date of Service:</label>
                                <input type="date" class="form-control form-control-sm" readonly id="PFDateView" readonly name="PFDateView" />
                            </div>

                            <div id="ConsDocView">
                                <div class="form-group">
                                    <label for="TDate" class="col-form-label form-control-sm small-label">Date of Service:</label>
                                    <input type="date" class="form-control form-control-sm" readonly id="DOSView" name="DOSView" />
                                </div>
                            </div>

                            <div id="RXD">
                                <h4 class="small-label">Prescription (RX) Date:</h4>
                                <div class="form-group">
                                    <label for="FDate" class="col-form-label form-control-sm small-label">From:</label>
                                    <input readonly type="date" class="form-control form-control-sm" id="FDate" name="FDate" />
                                </div>
                                <div class="form-group">
                                    <label for="TDate" class="col-form-label form-control-sm small-label">TO:</label>
                                    <input readonly type="date" class="form-control form-control-sm" id="TDate" name="TDate" />
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label form-control-sm small-label">Duration:</label>
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


<div class="modal fade" id="generateReportModal" tabindex="-1" aria-labelledby="generateReportLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="generateReportLabel">Generate Report</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
            </div>
            <div class="modal-body text-center">
                <p>Select an option to generate the report:</p>
                <a href="{{ url('invoicePDF', $mode == 'view' ? $order->id : 0) }}" target="_blank" class="btn btn-primary mb-3">Patient</a>
                <a href="/AddBatch/{{ $mode == 'view' ? $order->id : 0 }}/{{ $tp->id }}" class="btn btn-primary mb-3">Insurance</a>
            </div>
        </div>
    </div>
</div>



@include('layout.footer')



<style>
    .modal-blur {
        filter: blur(5px);
        pointer-events: none;
    }

    .modal-loader-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(255, 255, 255, 0.7);

        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 1050;
    }
</style>

<script>
    $('#generateReportBtn').on('click', function() {
        $('#generateReportModal').modal('show');
    });

    function toggleFields() {
        var selectedValue = $('#Order-Type-dropdown').val();

        if (selectedValue === 'Retail Rental' || selectedValue === 'Retail Sale') {
            $('#Policy4, #Policy3, #Policy2, #Policy1').prop('readonly', true);
            $('#Policy4, #Policy3, #Policy2, #Policy1').prop('disabled', true);
            $('#Policy1').val(null);
            $('#Policy2').val('');
            $('#Policy3').val('');
            $('#Policy4').val('');
        } else {
            $('#Policy4, #Policy3, #Policy2, #Policy1').prop('readonly', false);
            $('#Policy4, #Policy3, #Policy2, #Policy1').prop('disabled', false);

            $('#Policy1').val('{{ isset($PatInsurance[0]) ? $PatInsurance[0]->Company : null }}');
            $('#Policy2').val('{{ isset($PatInsurance[1]) ? $PatInsurance[1]->Company : null }}');
            $('#Policy3').val('{{ isset($PatInsurance[2]) ? $PatInsurance[2]->Company : null }}');
            $('#Policy4').val('{{ isset($PatInsurance[3]) ? $PatInsurance[3]->Company : null }}');
        }
    }

    toggleFields();

    $('#Order-Type-dropdown').change(function() {
        toggleFields();
    });

    var mode = "{{ $mode }}";




    function checkEligibility() {
        $('#modalLoader').show();

        $.ajax({
            url: '/checkEligibility',
            type: 'GET',
            success: function(response) {
                $('#modalLoader').hide();

                if (response && response.data) {
                    const {
                        provider,
                        subscriber,
                        payer,
                        planStatus,
                        benefitsInformation
                    } = response.data;

                    // Format the data into HTML-like structure
                    const formattedData = `
Eligibility Details:
-----------------------
Plan Status: ${planStatus?.[0]?.status || 'Unknown'}

Provider Information:
-----------------------
Name: ${provider?.providerName || 'N/A'}
Entity Type: ${provider?.entityType || 'N/A'}
NPI: ${provider?.npi || 'N/A'}

Subscriber Information:
-----------------------
Member ID: ${subscriber?.memberId || 'N/A'}
Name: ${subscriber?.firstName || ''} ${subscriber?.middleName || ''} ${subscriber?.lastName || ''}
Gender: ${subscriber?.gender || 'N/A'}
DOB: ${subscriber?.dateOfBirth || 'N/A'}
Address: ${subscriber?.address?.address1 || ''}, ${subscriber?.address?.city || ''}, ${subscriber?.address?.state || ''} ${subscriber?.address?.postalCode || ''}

Payer Information:
-----------------------
Name: ${payer?.name || 'N/A'}
Identification: ${payer?.payorIdentification || 'N/A'}

Benefits:
-----------------------
${formatBenefits(benefitsInformation)}
`;

                    // Set the formatted data into the textarea
                    const eligibilityDetails = document.getElementById('eligibilityDetails');
                    if (eligibilityDetails) {
                        eligibilityDetails.value = formattedData; // Assign formatted plain text with newlines
                    } else {
                        console.warn('Eligibility input field not found.');
                    }

                    // Alternatively, to render HTML into a container:
                    const htmlContainer = document.getElementById('eligibilityContainer');
                    if (htmlContainer) {
                        htmlContainer.innerText = formattedData; // Render formatted text into a div (preserving line breaks)
                    }

                    // Update the insurance eligibility status (if needed)
                    const eligibilityField = document.querySelector('[name="InsuranceEligibility"]');
                    if (eligibilityField) {
                        eligibilityField.value = planStatus?.[0]?.status || 'Unknown';
                    }
                } else {
                    console.error('Invalid response structure.');
                }
            },
            error: function(error) {
                $('#modalLoader').hide();
                console.error('Error:', error);
            }
        });
    }

    // Helper function to format benefits
    function formatBenefits(benefits) {
        if (!benefits || benefits.length === 0) return 'No Benefits Available';

        return benefits
            .map(benefit => `
Code: ${benefit.code || 'N/A'}
Name: ${benefit.name || 'N/A'}
Service Types: ${benefit.serviceTypes?.join(', ') || 'N/A'}
Insurance Type: ${benefit.insuranceType || 'N/A'}
Benefit Amount: ${benefit.benefitAmount || 'N/A'}
-----------------------
`)
            .join('\n');
    }

    // function checkEligibility() {
    //     $('#modalLoader').show();

    //     $.ajax({
    //         url: '/checkEligibility',
    //         type: 'GET',
    //         success: function(response) {
    //             $('#modalLoader').hide();

    //             if (response && response.data) {
    //                 // Extract data
    //                 const {
    //                     provider,
    //                     subscriber,
    //                     payer,
    //                     planStatus,
    //                     benefitsInformation
    //                 } = response.data;

    //                 // Format the data into HTML
    //                 const formattedData = `
    //                 <h3>Eligibility Details</h3>
    //                 <div><strong>Plan Status:</strong> ${planStatus?.[0]?.status || 'Unknown'}</div>

    //                 <h4>Provider Information</h4>
    //                 <div><strong>Name:</strong> ${provider?.providerName || 'N/A'}</div>
    //                 <div><strong>Entity Type:</strong> ${provider?.entityType || 'N/A'}</div>
    //                 <div><strong>NPI:</strong> ${provider?.npi || 'N/A'}</div>

    //                 <h4>Subscriber Information</h4>
    //                 <div><strong>Member ID:</strong> ${subscriber?.memberId || 'N/A'}</div>
    //                 <div><strong>Name:</strong> ${subscriber?.firstName || ''} ${subscriber?.middleName || ''} ${subscriber?.lastName || ''}</div>
    //                 <div><strong>Gender:</strong> ${subscriber?.gender || 'N/A'}</div>
    //                 <div><strong>DOB:</strong> ${subscriber?.dateOfBirth || 'N/A'}</div>
    //                 <div><strong>Address:</strong> ${subscriber?.address?.address1 || ''}, ${subscriber?.address?.city || ''}, ${subscriber?.address?.state || ''} ${subscriber?.address?.postalCode || ''}</div>

    //                 <h4>Payer Information</h4>
    //                 <div><strong>Name:</strong> ${payer?.name || 'N/A'}</div>
    //                 <div><strong>Identification:</strong> ${payer?.payorIdentification || 'N/A'}</div>

    //                 <h4>Benefits</h4>
    //                 <div>${formatBenefits(benefitsInformation)}</div>
    //             `;

    //                 // Decode and display the formatted data
    //                 const tempDiv = document.createElement('div');
    //                 tempDiv.innerHTML = formattedData;

    //                 // Update the target element
    //                 const eligibilityDetails = document.getElementById('eligibilityDetails');
    //                 if (eligibilityDetails) {
    //                     eligibilityDetails.value = tempDiv.innerText; // Use innerText to decode and set plain text
    //                 } else {
    //                     console.warn('Eligibility input field not found.');
    //                 }

    //                 // Alternatively, to render the HTML directly into a container:
    //                 const htmlContainer = document.getElementById('eligibilityContainer');
    //                 if (htmlContainer) {
    //                     htmlContainer.innerHTML = formattedData; // Render the HTML directly
    //                 }

    //                 // Update Insurance Eligibility field
    //                 const eligibilityField = document.querySelector('[name="InsuranceEligibility"]');
    //                 if (eligibilityField) {
    //                     eligibilityField.value = planStatus?.[0]?.status || 'Unknown';
    //                 }
    //             } else {
    //                 console.error('Invalid response structure.');
    //             }
    //         },
    //         error: function(error) {
    //             $('#modalLoader').hide();
    //             console.error('Error:', error);
    //         }
    //     });
    // }

    // function formatBenefits(benefits) {
    //     if (!benefits || !benefits.length) return 'No benefits information available.';

    //     return benefits.map(benefit => `
    //     <div>
    //         <strong>Code:</strong> ${benefit.code || 'N/A'}<br>
    //         <strong>Name:</strong> ${benefit.name || 'N/A'}<br>
    //         <strong>Service Types:</strong> ${benefit.serviceTypes?.join(', ') || 'N/A'}<br>
    //         <strong>Insurance Type:</strong> ${benefit.insuranceType || 'N/A'}<br>
    //         <strong>Benefit Amount:</strong> ${benefit.benefitAmount || 'N/A'}
    //     </div>
    // `).join('<hr>');
    // }


    $(document).ready(function() {

        $('#PriceCode-dropdown').select2({
            placeholder: "Select Now",
            allowClear: true
        });

        //for viewing
        if (mode === 'view') {

            $('input, select, textarea').prop('disabled', true);
            $('input, select, textarea').prop('readonly', true);

            $('#PriorAuthModal,#WarehouseName,#duration, #RXTDate, #RXFDate, #DOS, #PFDate, #fileUpload, #description, #title, #type, #SubDoc, #documnet, #statusSelect, #statusdept-dropdown, #user-dropdown, #message-text, #StateInjury, #DateOfInjury, #WorkDate, #ConsultDate, #Accident, #ICD91, #ICD92, #ICD93, #ICD94, #ICD101, #SellType, #ICD102, #ICD103, #ICD104, #ICD105, #ICD106, #ICD107, #ICD108, #ICD109, #ICD1010, #ICD1011, #ICD1012, #InvItem, #priceCode, #BillingMonth, #DOSTo, #DOSFrom, #DeliveryUnits, #Delivery, #Billed, #BilledUnits, #BOrderType, #Quantity, #QuantityUnits, #QuantityOrderType, #RXExp, #HAO, #Allowable, #Billable, #PriorAuthExp, #modifier1, #modifier2, #modifier3, #modifier4, #Serial, #PriorAuthType, #BillingCode, #Warehouse, #PriorAuth, #DayDelivery, #LastPeriod, #BillPickUp, #LastMonth,#invoice, input[name="BillItem"], input[name="NoPayIns1"], input[name="Ins4"], input[name="Ins3"], input[name="Ins2"], input[name="Ins1"], input[name="Taxable"], input[name="DXPointer10"]').prop('disabled', false);

            $('#PriorAuthModal,#WarehouseName,#duration,#RXTDate,#RXFDate,#DOS,#PFDate,#fileUpload,#description,#title,#type,#SubDoc,#documnet,#statusSelect, #statusdept-dropdown,#user-dropdown,#message-text,#StateInjury,#DateOfInjury,#WorkDate,#ConsultDate,#Accident,#ICD91,#ICD92,#ICD93,#ICD94,#ICD101,#ICD102,#ICD103,#ICD104,#ICD105,#ICD106,#ICD107,#ICD108,#ICD109,#ICD1010,#ICD1011,#ICD1012,#SellType,#InvItem, #priceCode, #BillingMonth, #DOSTo, #DOSFrom, #DeliveryUnits, #Delivery, #Billed, #BilledUnits, #BOrderType, #Quantity, #QuantityUnits, #QuantityOrderType, #RXExp, #HAO, #Allowable, #Billable, #PriorAuthExp, #modifier1, #modifier2, #modifier3, #modifier4, #Serial, #PriorAuthType, #BillingCode, #Warehouse, #PriorAuth, #DayDelivery, #LastPeriod, #BillPickUp, #LastMonth, input[name="NoPayIns1"], input[name="Ins4"], input[name="Ins3"], input[name="Ins2"], input[name="Ins1"], input[name="Taxable"],#invoice, input[name="BillItem"], input[name="DXPointer10"]').prop('readonly', false);


            $(document).ready(function() {

                $('#updatePatientForm').on('submit', function(event) {
                    event.preventDefault();

                    $(this).find('input, select, textarea').prop('disabled', false);

                    const deptIsFive = $('#statusdept-dropdown').val() === "5";
                    const statusIsThirteen = $('#statusSelect').val() === '13';

                    const sleepStudyChecked = $('#sleep-study-checkbox').is(':checked');
                    const nonSleepStudyChecked = $('#non-sleep-study-checkbox').is(':checked');
                    const authRequired = $('#AuthRequired').is(':checked');
                    const authNotRequired = $('#AuthNotRequired').is(':checked');

                    const atLeastOneAuthChecked = authRequired || authNotRequired;
                    const atLeastOneSleepChecked = sleepStudyChecked || nonSleepStudyChecked;

                    const allGeneralCheckboxesChecked = $('#PatientDetail-checkboxes input[type="checkbox"]:not(#AuthRequired, #AuthNotRequired' + (deptIsFive ? ', #sleep-study-checkbox, #non-sleep-study-checkbox' : '') + ')')
                        .toArray()
                        .every(checkbox => $(checkbox).is(':checked'));

                    if (statusIsThirteen) {
                        if (!allGeneralCheckboxesChecked || !atLeastOneAuthChecked) {
                            Swal.fire({
                                title: "Error",
                                text: "Please check all required checkboxes before submitting.",
                                icon: "error"
                            });
                            return;
                        }

                        if (deptIsFive && !atLeastOneSleepChecked) {
                            Swal.fire({
                                title: "Error",
                                text: "Please select at least one sleep study option before submitting.",
                                icon: "error"
                            });
                            return;
                        }
                    }

                    if (deptIsFive) {
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
                            e.preventDefault();
                        }
                    }

                    this.submit();
                });

                $('form').on('submit', function(event) {
                    $(this).find('input, select, textarea').prop('disabled', false);
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

        }

        //Address Set
        var fullAddress = "{{ $tp->Location }}";
        var addressParts = fullAddress.split(',');

        if (addressParts.length === 2) {
            var cityStateZip = addressParts[1].trim();
            var cityStateZipParts = cityStateZip.split(' ');

            var city = addressParts[0].trim();
            var state = cityStateZipParts[0];
            var zip = cityStateZipParts[1];
            $('#City').val(city);
            $('#State').val(state);
            $('#ZIP').val(zip);
        } else {
            var addressParts = fullAddress.trim().split(' ');

            if (addressParts.length >= 3) {
                var zip = addressParts.pop();
                var state = addressParts.pop();
                var city = addressParts.join(' ');

                $('#City').val(city);
                $('#State').val(state);
                $('#ZIP').val(zip);
            }
        }

        if (mode != 'view') {
            document.getElementById('checkNpiButton').addEventListener('click', function() {
                event.preventDefault();
                var npiNumber = document.getElementById('npiNumber').value;

                if (!npiNumber) {
                    alert('Please enter an NPI number');
                    return;
                }
                var npiStatusDiv = document.getElementById('npiStatus');
                npiStatusDiv.innerHTML = '<span class="dashboard-spinner spinner-secondary spinner-xs"></span>';

                fetch('/check-npi-status', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            npi: npiNumber
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.status) {
                            npiStatusDiv.innerHTML = `<span class="${data.statusClass}">${data.status}</span>`;
                            if (data.statusClass == "text-success") {
                                var currentDate = new Date().toISOString().split('T')[0];
                                document.getElementById('LastCheck').value = currentDate;
                                document.getElementById('LastCheckUser').value = data.userName;
                                // document.getElementById('NPIDoctorName').value = data.name;
                                // document.getElementById('NPIDoctorPhone').value = data.phone;
                            } else {
                                document.getElementById('LastCheck').value = null;
                            }
                        } else {
                            npiStatusDiv.innerHTML = `<span class="text-danger">Invalid NPI number</span>`;
                        }
                    })
                    .catch(error => {
                        npiStatusDiv.innerHTML = `<span class="text-danger">Error: ${error.message}</span>`;
                    });
            });


            document.getElementById('NPIDoctorName').addEventListener('change', function() {
                var selectedOption = this.options[this.selectedIndex];

                var doctorPhone = selectedOption.getAttribute('data-phone');
                var doctorNPI = selectedOption.getAttribute('data-npi');
                document.getElementById('NPIDoctorPhone').value = doctorPhone ? doctorPhone : '';
                document.getElementById('npiNumber').value = doctorNPI ? doctorNPI : '';
            });

        }



        document.getElementById('statusSelect').addEventListener('change', function() {
            var selectedValue = this.value;
            var detailDiv = document.getElementById('PatientDetail-checkboxes');
            var checkboxes = detailDiv.querySelectorAll('input[type="checkbox"]');
            var resupplyDiv = document.getElementById('resupplyDiv');


            if (selectedValue === '13') {
                detailDiv.style.display = 'block';
                checkboxes.forEach(function(checkbox) {
                    checkbox.disabled = false;
                    checkbox.readOnly = false;
                });

            } else {
                detailDiv.style.display = 'none';
                checkboxes.forEach(function(checkbox) {
                    checkbox.disabled = true;
                    checkbox.readOnly = true;
                });
            }

            if (selectedValue === '5') {
                $('#newFrequency,#resupplyDate,#newDept,#newResupplyDate').prop('readonly', false);
                $('#newFrequency,#resupplyDate,#newDept,#newResupplyDate').prop('disabled', false);
                resupplyDiv.style.display = 'block';
            } else {
                resupplyDiv.style.display = 'none';
            }
        });


        $('select[name="newFrequency"], input[name="resupplyDate"]').on('change input', function() {
            var frequency = parseInt($('select[name="newFrequency"]').val());
            var resupplyDate = $('input[name="resupplyDate"]').val();
            if (!isNaN(frequency) && resupplyDate) {
                var nextResupplyDate = new Date(resupplyDate);
                nextResupplyDate.setDate(nextResupplyDate.getDate() + frequency);
                var nextResupplyDateFormatted = nextResupplyDate.toISOString().split('T')[0];
                $('input[name="newResupplyDate"]').val(nextResupplyDateFormatted);
            }
        });

        var currentStatus = document.getElementById('StatusCheck');

        var detailDiv = document.getElementById('PatientDetail-checkboxes');
        if (currentStatus && currentStatus.value === "13") { // Check if the value is "13"

            var checkboxes = detailDiv.querySelectorAll('input[type="checkbox"]');
            detailDiv.style.display = 'block';
            checkboxes.forEach(function(checkbox) {
                checkbox.disabled = false;
                checkbox.readOnly = false;
            });
        }

        if (currentStatus && currentStatus.value === "5") {
            var resupplyDiv = document.getElementById('resupplyDiv');
            $('#newFrequency,#resupplyDate,#newDept,#newResupplyDate').prop('readonly', false);
            $('#newFrequency,#resupplyDate,#newDept,#newResupplyDate').prop('disabled', false);
            resupplyDiv.style.display = 'block';
        }


        logAction("Add Order Page Loaded");
    });



    function updateSerialNumbers() {
        $('#ItemList tr').each(function(index) {
            $(this).find('.serial-number').text(index + 1);
        });
    }


    $('#ViewOrder').on('show.bs.modal', function(event) {
        $('.modal-blur-content').addClass('modal-blur');
        $('#ViewModalLoader').show();
        var button = $(event.relatedTarget);
        var userId = button.data('id');

        var modal = $(this);
        modal.find('.modal-title').text('Item Detail ');

        $.ajax({
            url: '/getOrderItemDetails/' + userId,
            type: 'GET',
            success: function(data) {
                console.log(data);
                $('.modal-blur-content').removeClass('modal-blur');
                $('#ViewModalLoader').hide();

                var serialSelect = $('#Serial');
                serialSelect.empty();
                serialSelect.append('<option selected disabled>Serial #</option>');

                if (data.serialNumbers && data.serialNumbers.length > 0) {
                    data.serialNumbers.forEach(function(serial) {
                        serialSelect.append('<option value="' + serial + '">' + serial + '</option>');
                    });
                } else {
                    serialSelect.append('<option disabled>No serial numbers available</option>');
                }

                modal.find('#SellType').val(data.orderItem.RentalType);
                modal.find('#InvItem').val(data.orderItem.item);
                modal.find('#priceCode').val(data.orderItem.priceCode);
                modal.find('#BillingMonth').val(data.orderItem.DOSBillingMonth);
                modal.find('#DOSTo').val(data.orderItem.DOSTo);
                modal.find('#DOSFrom').val(data.orderItem.DOSFrom);
                modal.find('#DeliveryUnits').val(data.orderItem.DUnits);
                modal.find('#Delivery').val(data.orderItem.DQuantity);
                modal.find('#Billed').val(data.orderItem.BQuantity);
                modal.find('#BilledUnits').val(data.orderItem.BUnits);
                modal.find('#BOrderType').val(data.orderItem.BWhen);
                modal.find('#Quantity').val(data.orderItem.Quantity);
                modal.find('#QuantityUnits').val(data.orderItem.Units);
                modal.find('#QuantityOrderType').val(data.orderItem.When);
                modal.find('#RXExp').val(data.orderItem.RXExp);
                modal.find('#HAO').val(data.orderItem.HAO);
                modal.find('#Allowable').val(data.orderItem.AllowablePrice);
                modal.find('#Billable').val(data.orderItem.Billable_Price);
                modal.find('#PriorAuthExp').val(data.orderItem.PriorAuthExpiry);
                modal.find('#modifier1').val(data.orderItem.modifier1);
                modal.find('#modifier2').val(data.orderItem.modifier2);
                modal.find('#modifier3').val(data.orderItem.modifier3);
                modal.find('#modifier4').val(data.orderItem.modifier4);
                modal.find('#Serial').val(data.orderItem.Serial);
                modal.find('#BillingCode').val(data.orderItem.Bill_Billable_Code);
                modal.find('#WarehouseName').val(data.orderItem.warehouse);
                modal.find('#PriorAuthModal').val(data.orderItem.PriorAuth);
                modal.find('#PriorAuthType').val(data.orderItem.PriorAuthType);
                modal.find('#OrderIDItem').val(data.orderItem.id);
                modal.find('#DXPointer10').val(data.orderItem.DXPointer10);
                modal.find('#QuantityOrderType').val(data.orderItem.QuantityOrderType);
                modal.find('#BOrderType').val(data.orderItem.BOrderType);


                if (data.orderItem.BillItem == 'DayDelivery') {
                    modal.find('#DayDelivery').closest('label').find('input').prop('checked', true);
                } else if (data.orderItem.BillItem == 'LastPeriod') {
                    modal.find('#LastPeriod').closest('label').find('input').prop('checked', true);
                } else if (data.orderItem.BillItem == 'BillPickUp') {
                    modal.find('#BillPickUp').closest('label').find('input').prop('checked', true);
                } else if (data.orderItem.BillItem == 'LastMonth') {
                    modal.find('#LastMonth').closest('label').find('input').prop('checked', true);
                }

                modal.find('input[name="NoPayIns1"]').prop('checked', data.orderItem.NoPayIns1);
                modal.find('input[name="Ins4"]').prop('checked', data.orderItem.ins4);
                modal.find('input[name="Ins3"]').prop('checked', data.orderItem.ins3);
                modal.find('input[name="Ins2"]').prop('checked', data.orderItem.ins2);
                modal.find('input[name="Ins1"]').prop('checked', data.orderItem.ins1);
                modal.find('input[name="Taxable"]').prop('checked', data.orderItem.Taxable);
            },
            error: function() {
                $('.modal-blur-content').removeClass('modal-blur');
                $('#ViewModalLoader').hide();
                modal.find('#userDetailsContent').html('<p>An error occurred while fetching Order Items Detail.</p>');
            }
        });


    });



    if (mode != 'view') {

        document.getElementById('AddItemButton').addEventListener('click', function(event) {
            event.preventDefault();

            var doctorTypeName = $('#item-dropdown').val();
            var PriceCode = $('#PriceCode-dropdown').val();
            var matchedDiagnosis = "";
            var PatientDiagnose = JSON.parse('{!! json_encode($comparingDiagnose) !!}');
            var selectedDiagnosis = $('#item-dropdown option:selected').data('diagnosis');
            selectedDiagnosis = Object.values(selectedDiagnosis);

            var patientICDs = [
                PatientDiagnose.ICD101,
                PatientDiagnose.ICD102,
                PatientDiagnose.ICD103,
                PatientDiagnose.ICD104,
                PatientDiagnose.ICD105,
                PatientDiagnose.ICD106,
                PatientDiagnose.ICD107,
                PatientDiagnose.ICD108,
                PatientDiagnose.ICD109,
                PatientDiagnose.ICD1010,
                PatientDiagnose.ICD1011,
                PatientDiagnose.ICD1012
            ];

            console.log("Selected Diagnosis:", selectedDiagnosis);
            console.log("Patient ICDs:", patientICDs);


            function validateForm() {
                if (!doctorTypeName && !PriceCode) {
                    alert('Both Inventory Item and Price Code must be selected!');
                    return false;
                }
                matchedDiagnosis = compareDiagnosis(selectedDiagnosis, patientICDs);
                if (!matchedDiagnosis) {
                    alert('The selected diagnosis does not match the current diagnosis list!');
                    return false;
                }
                return true;
            }

            function compareDiagnosis(selected, patientICDs) {
                const firstMatch = selected.find(function(diagnosis) {
                    return patientICDs.includes(diagnosis);
                });
                return firstMatch || false;
            }



            if (validateForm()) {
                $('.ViewModal-blur-content').addClass('modal-blur');
                $('#modalLoader').show();

                $.ajax({
                    url: '/add-item',
                    type: 'GET',
                    data: {
                        name: doctorTypeName
                    },
                    success: function(response) {
                        var formData = {
                            item: response.name,
                            itemId: response.id,
                            uniqueOrderId: $('#unique-id').val(),
                            patientID: $('#patient-id').val(),
                            warehouse: response.warehouse,
                            priceCode: PriceCode,
                            Type: response.type,
                            DXPointer10: matchedDiagnosis.toString(),
                        };


                        $.ajax({
                            url: '/saveOrderItem',
                            type: 'POST',
                            data: JSON.stringify(formData),
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            success: function(response) {
                                var rowCount = $('#ItemList tr').length + 1;
                                var newRow = `
                        <tr class="text-center">
                            <td>${rowCount++}</td>
                            <td>${response.item.item}</td>
                            <td>${response.item.warehouse}</td>
                            <td>${response.item.priceCode}</td>
                            <td>${response.item.Type}</td>
                            <td>
                                 <button type="button" data-toggle="modal" data-target="#ViewOrder"
                                        class="btn btn-sm btn-success"
                                        data-id="${response.item.id}"
                                        data-toggle="tooltip" data-placement="top" title=""
                                        data-original-title="View ${response.item.item}">
                                    <i class="fa fa-eye"></i>
                                </button>

                                <button data-url="/deleteOrderItem/${response.item.id}"
                                        class="btn btn-sm btn-danger"
                                        data-id="${response.item.id}"
                                        id="delete-item-${response.item.id}"
                                        data-toggle="tooltip" data-placement="top" title=""
                                        data-original-title="Delete ${response.item.item}">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    `;
                                $('#ItemList').append(newRow);
                                $('.modal-blur-content').removeClass('modal-blur');
                                $('#modalLoader').hide();

                                let diagnosisCodes = matchedDiagnosis.toString();
                                let existingCodes = $('#diagnosis-codes').val();
                                console.log(matchedDiagnosis + "     " + diagnosisCodes);
                                // $('#diagnosis-codes').val(' ');
                                $('#diagnosis-codes').val(existingCodes ? existingCodes + ',' + diagnosisCodes : diagnosisCodes);

                            },
                            error: function(xhr, status, error) {
                                $('.modal-blur-content').removeClass('modal-blur');
                                $('#modalLoader').hide();
                                alert('Something went wrong, please try again.');
                            },
                        });

                    },
                    error: function(xhr, status, error) {
                        $('.modal-blur-content').removeClass('modal-blur');
                        $('#modalLoader').hide();
                        alert('Something went wrong, please try again.');
                    },

                });
            }
        });

        $(document).on('click', '[id^=delete-item-]', function(e) {
            e.preventDefault();
            var deleteUrl = $(this).data('url');
            var row = $(this).closest('tr');
            var itemId = $(this).data('id');

            if (confirm('Are you sure you want to delete this item?')) {
                $('.modal-blur-content').addClass('modal-blur');
                $('#modalLoader').show();

                $.ajax({
                    url: '/getOrderItemDetails/' + itemId,
                    type: 'GET',
                    success: function(response) {
                        var dxCodeToRemove = response.orderItem.DXPointer10;
                        if (dxCodeToRemove) {
                            $.ajax({
                                url: deleteUrl,
                                type: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                },
                                success: function(deleteResponse) {
                                    if (deleteResponse.success) {
                                        $('.modal-blur-content').removeClass('modal-blur');
                                        $('#modalLoader').hide();
                                        row.remove();

                                        // Remove the diagnosis code from the hidden input
                                        let currentCodes = $('#diagnosis-codes').val().split(',');
                                        let updatedCodes = currentCodes.filter(code => code !== dxCodeToRemove);
                                        $('#diagnosis-codes').val(updatedCodes.join(','));
                                    } else {
                                        $('.modal-blur-content').removeClass('modal-blur');
                                        $('#modalLoader').hide();
                                        alert('Error: Unable to delete item.');
                                    }
                                },
                                error: function(xhr, status, error) {
                                    console.error('Error:', error);
                                    $('.modal-blur-content').removeClass('modal-blur');
                                    $('#modalLoader').hide();
                                    alert('Something went wrong, please try again.');
                                }
                            });
                        } else {
                            $('.modal-blur-content').removeClass('modal-blur');
                            $('#modalLoader').hide();
                            alert('Diagnosis code not found for this item.');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching item details:', error);
                        $('.modal-blur-content').removeClass('modal-blur');
                        $('#modalLoader').hide();
                        alert('Failed to retrieve item details.');
                    }
                });
            }
        });
    }

    $('#EditOrderItem').on('click', function(e) {
        e.preventDefault();
        let valid = true;

        // Validate the form fields
        $('.requiredField').each(function() {
            if ($(this).val() == '' || $(this).val() == null) {
                valid = false;
                $(this).addClass('is-invalid');
            } else {
                $(this).removeClass('is-invalid');
            }
        });

        if (valid) {
            let formData = {
                SellType: $('#SellType').val(),
                InvItem: $('#InvItem').val(),
                priceCode: $('#priceCode').val(),
                BillingMonth: $('#BillingMonth').val(),
                DOSTo: $('#DOSTo').val(),
                DOSFrom: $('#DOSFrom').val(),
                DeliveryUnits: $('#DeliveryUnits').val(),
                Delivery: $('#Delivery').val(),
                Billed: $('#Billed').val(),
                BilledUnits: $('#BilledUnits').val(),
                BOrderType: $('#BOrderType').val(),
                Quantity: $('#Quantity').val(),
                QuantityUnits: $('#QuantityUnits').val(),
                QuantityOrderType: $('#QuantityOrderType').val(),
                RXExp: $('#RXExp').val(),
                HAO: $('#HAO').val(),
                Allowable: $('#Allowable').val(),
                Billable: $('#Billable').val(),
                PriorAuthExp: $('#PriorAuthExp').val(),
                modifier1: $('#modifier1').val(),
                modifier2: $('#modifier2').val(),
                modifier3: $('#modifier3').val(),
                modifier4: $('#modifier4').val(),
                Serial: $('#Serial').val(),
                PriorAuthType: $('#PriorAuthType').val(),
                BillingCode: $('#BillingCode').val(),
                Warehouse: $('#WarehouseName').val(),
                PriorAuth: $('#PriorAuthModal').val(),
                BillItem: $('input[name="BillItem"]:checked').val(),
                NoPayIns1: $('input[name="NoPayIns1"]').is(':checked') ? 1 : 0,
                Ins4: $('input[name="Ins4"]').is(':checked') ? 1 : 0,
                Ins3: $('input[name="Ins3"]').is(':checked') ? 1 : 0,
                Ins2: $('input[name="Ins2"]').is(':checked') ? 1 : 0,
                Ins1: $('input[name="Ins1"]').is(':checked') ? 1 : 0,
                Taxable: $('input[name="Taxable"]').is(':checked') ? 1 : 0,
                invoice: $('#invoice').val(),
                DXPointer10: $('input[name="DXPointer10"]').val(),
                Serial: $('#Serial').val(),
                SellType: $('#SellType').val(),
                QuantityOrderType: $('#QuantityOrderType').val(),
                BOrderType: $('#BOrderType').val(),
            };

            var orderId = $('#OrderIDItem').val();

            $.ajax({
                url: '/updateOrderItem/' + orderId,
                type: 'POST',
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    console.log(response.item);
                    $('#ViewOrder').modal('hide');
                    Swal.fire({
                        title: "Success",
                        text: "Saved Successfully",
                        icon: "success"
                    });
                },
                error: function(xhr, status, error) {
                    console.error('Form submission failed:', error);
                    alert('Failed to submit the form');
                }
            });
        } else {
            alert('Please fill out all required fields.');
        }
    });


    function isPDF(url) {
        return url.match(/\.pdf$/i);
    }

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


    $('#EditDocument').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget);
        var form = $(this).find('#EditDocumentForm');
        form.attr('action', "{{ url('EditDocument') }}/" + userId);
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
                var documentsBaseUrl = "{{ asset('documents') }}/";
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

                var documentsBaseUrl = "{{ url('documents') }}/";
                var documentsViewBaseUrl = "{{ url('docs') }}/";
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
                            var documentsViewBaseUrl = "{{ url('documents') }}/";
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
                            var documentsViewBaseUrl = "{{ url('documents') }}/";
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

        function updateRequiredFields() {
            if (!documentTypeSelect) return; // Exit if document type select is missing

            const docType = documentTypeSelect.value;

            // Reset all fields
            if (rxDateFrom) rxDateFrom.required = false;
            if (rxDateTo) rxDateTo.required = false;
            if (RXDate) RXDate.required = false;
            if (DOS) DOS.required = false;
            if (subDocSelect) subDocSelect.required = false;
            if (PFDateIn) PFDateIn.required = false;
            if (subDocDiv) subDocDiv.style.display = 'none';
            if (PFDate) PFDate.style.display = 'none';
            if (ConsDocAdd) ConsDocAdd.style.display = 'none';

            // Apply conditions
            if (docType === 'Prescription (RX)' || docType === 'CMN' || docType === 'Authorization') {
                if (rxDateFrom) rxDateFrom.required = true;
                if (rxDateTo) rxDateTo.required = true;
            } else if (docType === 'Claims') {
                if (subDocDiv) subDocDiv.style.display = 'block';
                if (subDocSelect) subDocSelect.required = true;
            } else if (docType === "Proof of Delivery") {
                if (PFDate) PFDate.style.display = 'block';
                if (PFDateIn) PFDateIn.required = true;
            } else if (docType === "Consignment Documents") {
                if (ConsDocAdd) ConsDocAdd.style.display = 'block';
                if (DOS) DOS.required = true;
                if (rxDateFrom) rxDateFrom.required = true;
                if (rxDateTo) rxDateTo.required = true;
            }
        }

        // Initial check on page load
        if (documentTypeSelect) {
            updateRequiredFields();
            // Event listener for changes in the document type select
            documentTypeSelect.addEventListener('change', updateRequiredFields);
        }
    });

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
                var documentsBaseUrl = "{{ asset('documents') }}/";
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
            console.log(nextResupplyDateFormatted);
            $('input[name="TDate"]').val(nextResupplyDateFormatted);
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

    function openViewModal(button) {
        var id = button.data('id'); // Get the ID from the data-id attribute
        $('#note-id').val(id);

        $('#ViewOrder').modal('show'); // Show the modal
    }
</script>
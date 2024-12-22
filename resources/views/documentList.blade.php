@section('title', 'Document List')
@include('layout.Head')
<div class="dashboard-wrapper">
    <div class="dashboard-ecommerce">
        <div class="container-fluid dashboard-content">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="page-header">
                        <h2 class="pageheader-title ml-auto">Documents List</h2>
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
                        <div class="card">
                            <h5></h5>
                            <div class="container card-header">
                                <div class="row">
                                    <div class="col">
                                        <button data-toggle="modal" data-target="#AddDocument" class="btn btn-primary btn-block p-2">Upload&nbsp;Documents</button>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table display" id="myTable">
                                        <thead>
                                            <tr>
                                                <th scope="col">S.No</th>
                                                <th scope="col">ID#</th>
                                                <th scope="col">PT First Name</th>
                                                <th scope="col">PT Last Name</th>
                                                <th scope="col">Account#</th>
                                                <th scope="col">Order#</th>
                                                <th scope="col">Document Type</th>
                                                <th scope="col">Expiry</th>
                                                <th scope="col">Uploaded By</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                            $userR = Session::get('LoginRole');
                                            $deleteDocPer = Session::get('LoginDeleteDoc');
                                            $editDocPer = Session::get('LoginEditDoc');
                                            @endphp

                                            @foreach ($documents as $index => $date)
                                            @php
                                            $UserName = $patients->get($date->ptName);
                                            @endphp
                                            <tr class="txt-sm" style="cursor: pointer;" data-toggle="modal" data-target="#ViewDocument" data-id="{{ $date->id }}" data-name="{{ $UserName?->name }}">
                                                <td class="txt-sm">{{ $index + 1 }}</td>
                                                <td class="txt-sm">{{ $date->Order_No }}</td>
                                                <td class="txt-sm">{{ $UserName?->name }}</td>
                                                <td class="txt-sm">{{ $UserName?->last_Name }}</td>
                                                <td class="txt-sm">{{ $UserName?->AccNumber }}</td>
                                                <td class="txt-sm">{{ $UserName?->Order_No }}</td>
                                                <td class="txt-sm">{{ $date->docType }}</td>
                                                <td class="txt-sm">
                                                    @if (is_null($date->toDate))
                                                    N/A
                                                    @elseif ($date->toDate < now())
                                                        Expired
                                                        @else
                                                        Valid
                                                        @endif
                                                        </td>
                                                <td>{{ $date->upload }} at {{ $date->created_at->format('m/d/Y h:i:s A') }}</td>
                                                <td class="text-center">
                                                    <div style="display: flex; justify-content: center; align-items: center;">
                                                        <button data-toggle="modal" style="padding: 0.25rem 0.5rem; font-size: 0.875rem; line-height: 1.5;" data-target="#ViewDocument" data-id="{{ $date->id }}" data-name="{{ $UserName?->name }}" class="btn btn-primary view-btn">
                                                            <i class="fa-solid fa-eye"></i>
                                                        </button>

                                                        @if($userR == "2" || $editDocPer == "on")
                                                        <button data-toggle="modal" style="padding: 0.25rem 0.5rem; font-size: 0.875rem; line-height: 1.5;" data-target="#EditDocument" data-id="{{ $date->id }}" data-name="{{ $UserName?->name }}" class="btn btn-warning edit-btn">
                                                            <i class="fa fa-pen-to-square"></i>
                                                        </button>
                                                        @endif

                                                        @if($userR == "2" || $deleteDocPer == "on")
                                                        <button data-url="{{ url('DeleteDocument', $date->id) }}" style="padding: 0.25rem 0.5rem; font-size: 0.875rem; line-height: 1.5;" class="btn btn-danger delete-btn" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete {{ $UserName?->name }}'s document">
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
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    @include('layout.footer')



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
                                    <label for="documnet" class="col-form-label text-sm small-label">Document Type:</label>
                                    <select name="docs" id="documnet" class="form-control form-control-sm" required>
                                        <option value="Prescription (RX)">Prescription (RX)</option>
                                        <option value="CMN">CMN</option>
                                        <option value="Authorization">Authorization</option>

                                        <option value="Office Notes/Medical Records">Office Notes/Medical Records</option>
                                        <option value="Demographics">Demographics</option>
                                        <option value="Manufacturer Order Form">Manufacturer Order Form</option>
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
                                    <select required name="ptName" id="ptNameAdd" class="form-control form-control-sm select2">
                                        <option selected disabled>Select Patient Name</option>
                                        @foreach ($drs as $pa)
                                        <option value="{{$pa->id}}">{{$pa->name}}&nbsp;{{$pa->last_Name}} </option>
                                        @endforeach
                                    </select>
                                </div>


                                <div class="form-group">
                                    <label for="drOff" class="col-form-label small-label">Dr Office:</label>
                                    <select required id="drOffAdd" class="form-control form-control-sm">
                                        @foreach ($doctor as $dr)
                                        <option disabled value="{{$dr->id}}">{{$dr->Office_Name}}</option>
                                        @endforeach
                                    </select>
                                    <input type="hidden" name="drOff" id="drOffAdd1">
                                </div>

                                <div class="form-group">
                                    <label for="patientAcc" class="col-form-label small-label">Patient Acct#:</label>
                                    <input type="text" required class="form-control form-control-sm" id="patientAccAdd" readonly name="patientAcc" required />
                                </div>

                                <div class="form-group">
                                    <label for="patientOrder" class="col-form-label small-label">Patient Order#:</label>
                                    <input type="text" required class="form-control form-control-sm" id="patientOrderAdd" readonly name="patientOrder" required />
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

                                <div class="form-group" id="PFDAdd" style="display:none;">
                                    <label for="FDateEdit" class="col-form-label small-label">Date of Service:</label>
                                    <input type="date" class="form-control form-control-sm" id="PFDate" name="PFDate" />
                                </div>

                                <div id="ConsDocAdd" style="display:none;">

                                    <div class="form-group">
                                        <label for="TDate" class="col-form-label small-label">Date of Service:</label>
                                        <input type="date" class="form-control form-control-sm" id="DOS" name="DOS" />
                                    </div>
                                </div>

                                <div id="RX">
                                    <h4 class="small-label">Prescription (RX) Date:</h4>
                                    <div class="form-group">
                                        <label for="FDate" class="col-form-label small-label">From:</label>
                                        <input type="date" class="form-control form-control-sm" id="FDateAdd" name="FDate" />
                                    </div>
                                    <div class="form-group">
                                        <label for="TDate" class="col-form-label small-label">TO:</label>
                                        <input type="date" class="form-control form-control-sm" id="TDateAdd" name="TDate" />
                                    </div>
                                    <div class="form-group">
                                        <label for="duration" class="col-form-label small-label">Duration:</label>
                                        <select name="duration" id="durationAdd" class="form-control form-control-sm">
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
                                    <select required disabled name="patName" id="patName" class="form-control form-control-sm">
                                        @foreach ($drs as $pa)
                                        <option value="{{$pa->id}}">{{$pa->name}}&nbsp;{{$pa->last_Name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="drOff" class="col-form-label small-label">Dr Office:</label>
                                    <select required id="docOff" disabled class="form-control form-control-sm">
                                        @foreach ($doctor as $dr)
                                        <option disabled value="{{$dr->id}}">{{$dr->Office_Name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="patientAcc" class="col-form-label small-label">Patient Acct#:</label>
                                    <input disabled type="text" required class="form-control form-control-sm" id="patientAcc" readonly name="patientAcc" required />
                                </div>

                                <div class="form-group">
                                    <label for="patientOrder" class="col-form-label small-label">Patient Order#:</label>
                                    <input disabled type="text" required class="form-control form-control-sm" id="patientOrder" readonly name="patientOrder" required />
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
                        @csrf
                        <div class="row">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="documnet" class="col-form-label text-sm small-label">Document Type:</label>
                                    <select name="docs" id="documnetEdit" class="form-control form-control-sm" required>
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
                                        @foreach ($drs as $pa)
                                        <option value="{{$pa->id}}">{{$pa->name}}&nbsp;{{$pa->last_Name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="drOff" class="col-form-label small-label">Dr Office:</label>
                                    <select required id="drOffEdit" name="drOffEdit" class="form-control form-control-sm">
                                        @foreach ($doctor as $dr)
                                        <option disabled value="{{$dr->id}}">{{$dr->Office_Name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="patientAcc" class="col-form-label small-label">Patient Acct#:</label>
                                    <input type="text" required class="form-control form-control-sm" id="patientAccEdit" readonly name="patientAcc" required />
                                </div>

                                <div class="form-group">
                                    <label for="patientOrder" class="col-form-label small-label">Patient Order#:</label>
                                    <input type="text" required class="form-control form-control-sm" id="patientOrderEdit" readonly name="patientOrder" required />
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
                                    <h4 class="small-label">Prescription (RX) Date:</h4>
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





    <script>
        function isPDF(url) {
            return url.match(/\.pdf$/i);
        }
        $(document).ready(function() {

            $('.clickable-row').on('click', function() {
                const modalId = $(this).data('target');
                $(modalId).modal('show');
                // Optional: Add any dynamic data into the modal
                // $(modalId).find('.modal-body').text('Data or action for ' + $(this).data('name'));
            });

            $('.delete-btn').on('click', function(event) {
                event.stopPropagation(); // Stop the row click event
                const url = $(this).data('url');
                // Optionally, handle the delete action here
                // Example: window.location.href = url;
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

            // $('.select2').select2({
            //     dropdownParent: $('#AddDocument'),
            //     placeholder: "Select User",
            //     allowClear: true,
            //     width: '100%' // or specify a fixed width, e.g., '200px'
            //     // Optionally specify the dropdown parent
            // });


            $('.select2').select2({
                dropdownParent: $('#AddDocument'),
                placeholder: "Select User",
                allowClear: true,
                width: '100%'
            });

            $('#AddDocument').on('shown.bs.modal', function() {
                // Event listener for ptName dropdown
                $('#ptNameAdd').on('change', function() {
                    var patientId = this.value;
                    fetch(`/get-patient-details/${patientId}`)
                        .then(response => response.json())
                        .then(data => {
                            console.log(data);
                            document.getElementById('drOffAdd').value = data.office_id;
                            document.getElementById('patientAccAdd').value = data.account_number;
                            document.getElementById('patientOrderAdd').value = data.order_number;

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
            });


            logAction("Document List Page Loaded");

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

                        console.log("Patient id : " + data.ptName);
                        // Now setting the fetched data into the modal fields
                        modal.find('#title').val(data.title);
                        modal.find('#type').val(data.type);
                        modal.find('#description').val(data.desc);
                        modal.find('#documnet').val(data.docType); // Adjust according to your actual JSON keys
                        modal.find('#patName').val(data.ptName);
                        modal.find('#docOff').val(data.ptDr);
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
                        var documentsViewBaseUrl = "{{ url('documents') }}/";
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
                            $('#ConsDocView').hide();
                            $('#RXD').hide();
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
            $('#EditDocument').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget); // Button that triggered the modal
                // var userId = button.data('id'); // Extract info from data-* attributes
                // var userName = button.data('name');
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
                        modal.find('#patientAccEdit').val(data.ptAcc);
                        modal.find('#patientOrderEdit').val(data.ptOrder);
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
                            $('#RXEdit').hide();
                            $('#ConsDocEdit').hide();
                        }


                    },
                    error: function() {
                        // modal.find('#userDetailsContent').html('<p>An error occurred while fetching patient documents.</p>');
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
                        rxDateFrom.required = true;
                        rxDateTo.required = true;
                        DOS.required = true;
                    }
                }

                // Initial check on page load
                updateRequiredFields();
                // Event listener for change on document type select
                documentTypeSelect.addEventListener('change', updateRequiredFields);
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
                // Get the selected duration in months or years
                var duration = parseInt($('select[name="duration"]').val());
                var isYear = (duration === 12); // Check if the duration is in years

                // Get the current start date from the FDate input
                var startDate = $('input[name="FDate"]').val();

                if (!isNaN(duration) && startDate) {
                    var nextResupplyDate = new Date(startDate);

                    if (isYear) {
                        // Add one year to the start date
                        nextResupplyDate.setFullYear(nextResupplyDate.getFullYear() + 1);
                    } else {
                        // Add the number of months to the start date
                        nextResupplyDate.setMonth(nextResupplyDate.getMonth() + duration);
                    }

                    // Format the date as YYYY-MM-DD
                    var nextResupplyDateFormatted = nextResupplyDate.toISOString().split('T')[0];
                    $('input[name="TDate"]').val(nextResupplyDateFormatted);
                }
            });

            $('#documnetEdit').change(function() {
                var selectedDeptText1 = $("#documnetEdit option:selected").text().toLowerCase(); // Get the text and convert to lowercase
                if (selectedDeptText1.includes("claims")) { // Check if the text includes 'resupply'
                    $('#docTypeEdit').show();
                } else {
                    $('#docTypeEdit').hide();
                }

                if (selectedDeptText1.includes("prescription (rx)") || selectedDeptText1.includes("cmn") || selectedDeptText1.includes("authorization")) { // Check if the text includes 'resupply'
                    $('#RXEdit').show();
                } else {
                    $('#RXEdit').hide();
                }
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
                        var documentsBaseUrl = "{{ asset('documents') }}/";
                        var renderImg = documentsBaseUrl + 'pdf.png';
                        imgElement.src = renderImg;
                        imgElement.style.display = 'block'; // Hide the image element if not an image file
                        fileMessage.textContent = 'No preview available for PDFs.';
                        fileMessage.style.display = 'block'; // Show the message for non-image files
                    }
                }
            });

            $('select[name="durationEdit"], input[name="FDateEdit"]').on('change input', function() {
                // Get the selected duration in months or years
                var duration = parseInt($('select[name="durationEdit"]').val());
                var isYear = (duration === 12); // Check if the duration is in years

                // Get the current start date from the FDate input
                var startDate = $('input[name="FDateEdit"]').val();

                if (!isNaN(duration) && startDate) {
                    var nextResupplyDate = new Date(startDate);

                    if (isYear) {
                        // Add one year to the start date
                        nextResupplyDate.setFullYear(nextResupplyDate.getFullYear() + 1);
                    } else {
                        // Add the number of months to the start date
                        nextResupplyDate.setMonth(nextResupplyDate.getMonth() + duration);
                    }

                    // Format the date as YYYY-MM-DD
                    var nextResupplyDateFormatted = nextResupplyDate.toISOString().split('T')[0];
                    $('input[name="TDateEdit"]').val(nextResupplyDateFormatted);
                }
            });

            // document.getElementById('ptName').addEventListener('change', function() {
            //     var patientId = this.value;
            //     fetch(`/get-patient-details/${patientId}`)
            //         .then(response => response.json())
            //         .then(data => {
            //             console.log(data);
            //             document.getElementById('drOffAdd').value = data.office_id;
            //             document.getElementById('patientAccAdd').value = data.account_number;
            //             document.getElementById('patientOrderAdd').value = data.order_number;

            //             // Select the dropdown
            //             const select = document.getElementById('documnet');

            //             // Convert options to an array and remove specific options
            //             Array.from(select.options).forEach(option => {
            //                 if (option.value === "Sleep Study" || option.value === "Consignment Documents") {
            //                     select.removeChild(option);
            //                 }
            //             });

            //             // Append new options if department is 5
            //             if (data.Dept === "5") {
            //                 const sleepStudyOption = new Option("Sleep Study", "Sleep Study");
            //                 select.add(sleepStudyOption);
            //             }

            //             if (data.Dept === "4") {
            //                 const sleepStudyOption = new Option("Consignment Documents", "Consignment Documents");
            //                 select.add(sleepStudyOption);
            //             }

            //             console.log('Office ID:', data.Dept);
            //         })
            //         .catch(error => console.error('Error fetching data: ', error));
            // });


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

            $('#documnet').change(function() {
                var selectedDeptText1 = $("#documnet option:selected").text().toLowerCase(); // Get the text and convert to lowercase
                if (selectedDeptText1.includes("claims")) { // Check if the text includes 'resupply'
                    $('#docType').show();
                } else {
                    $('#docType').hide();
                }

                if (selectedDeptText1.includes("prescription (rx)") || selectedDeptText1.includes("cmn") || selectedDeptText1.includes("authorization")) { // Check if the text includes 'resupply'
                    $('#RX').show();
                } else {
                    $('#RX').hide();
                }
                if (selectedDeptText1.includes("consignment documents")) { // Check if the text includes 'resupply'
                    $('#ConsDocAdd').show();
                    $('#RX').show();
                } else {
                    $('#RX').hide();
                    $('#ConsDocAdd').hide();
                }

                if (selectedDeptText1.includes("proof of delivery")) { // Check if the text includes 'resupply'
                    $('#PFDAdd').show();
                } else {
                    $('#PFDAdd').hide();
                }
            });
        });
    </script>
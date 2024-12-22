@section('title', 'Edit User')
@include('layout.Head')

<div class="dashboard-wrapper">
    <div class="dashboard-ecommerce">
        <div class="container-fluid dashboard-content">
            <div class="row">

                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="page-header">
                        <h2 class="pageheader-title ml-auto">Edit {{ $user->name }}'s Detail</h2>
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
                        <form method="post" action="{{ url('EditUser', $user->id) }}">
                            @csrf
                            <div class="card">
                                <h5 class="card-header">Edit {{ $user->name }}'s Detail</h5>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label class="col-form-label">User Name</label>
                                        <div class="input-group mb-3"><span class="input-group-prepend"><span class="input-group-text"><i class="fa fa-user"></i></span></span>
                                            <input type="text" required placeholder="User Name" name="name" class="form-control" value="{{ $user->name }}">
                                        </div>
                                        <span><small class="text-danger font-weight-light font-italic">
                                                @error('name')
                                                {{ $message }}
                                                @enderror
                                            </small></span>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-form-label">User Mail</label>
                                        <div class="input-group mb-3"><span class="input-group-prepend"><span class="input-group-text"><i class="fa fa-envelope"></i></span></span>
                                            <input type="mail" required placeholder="User Email" name="mail" class="form-control" value="{{ $user->email }}">
                                        </div>
                                        <span><small class="text-danger font-weight-light font-italic">
                                                @error('mail')
                                                {{ $message }}
                                                @enderror
                                            </small></span>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-form-label">User Password</label>
                                        <div class="input-group mb-3"><span class="input-group-prepend"><span class="input-group-text"><i class="fa fa-lock"></i></span></span>
                                            <input type="password" placeholder="create new User Password" name="password" class="form-control">
                                        </div>
                                        <div id="passwordHelp" class="text-danger"></div>
                                        <span><small class="text-danger font-weight-light font-italic">
                                                @error('password')
                                                {{ $message }}
                                                @enderror
                                            </small></span>
                                    </div>


                                    <div class="form-group">
                                        <label class="col-form-label">User Role</label>
                                        <div class="input-group mb-3"><span class="input-group-prepend"><span class="input-group-text"><i class="fa fa-user-secret"></i></span></span>
                                            <select class="form-control" required name="role" id="role-dropdown">
                                                <option disabled>Select User Role</option>
                                                <option value="0" @if ($user->role === '0') selected @endif>User</option>
                                                <option value="1" @if ($user->role === '1') selected @endif>Manager</option>
                                                <option value="2" @if ($user->role === '2') selected @endif>Admin</option>
                                            </select>

                                        </div>
                                        <span><small class="text-danger font-weight-light font-italic">
                                                @error('role')
                                                {{ $message }}
                                                @enderror
                                            </small></span>
                                    </div>

                                    <div class="row" id="Doc-container" style="{{ $user->role != '1' ? 'display: none;' : '' }}">
                                        <div class="col">
                                            <label class="custom-control custom-checkbox">
                                                <input type="checkbox" @if($user->progress == 'on') checked="" @endif class="custom-control-input" name="progressCheck">
                                                <span class="custom-control-label">View Progress Permission</span>
                                            </label>
                                        </div>
                                        <div class="col">
                                            <label class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" @if($user->editDocs == 'on') checked="" @endif name="editDoc">
                                                <span class="custom-control-label">Edit Document</span>
                                            </label>
                                        </div>

                                        <div class="col">
                                            <label class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" name="deleteDoc" @if($user->deleteDocs == 'on') checked="" @endif>
                                                <span class="custom-control-label">Delete Document</span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="row" id="pat-container" style="{{ $user->role != '1' ? 'display: none;' : '' }}">
                                        <div class="col">
                                            <label class="custom-control custom-checkbox">
                                                <input type="checkbox" @if($user->add == 'on') checked="" @endif class="custom-control-input" name="addPt">
                                                <span class="custom-control-label">Add Patient</span>
                                            </label>
                                        </div>

                                        <div class="col">
                                            <label class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" @if($user->edit == 'on') checked="" @endif name="editPt">
                                                <span class="custom-control-label">Edit Patient</span>
                                            </label>
                                        </div>

                                        <div class="col">
                                            <label class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" @if($user->delete == 'on') checked="" @endif name="deletePt">
                                                <span class="custom-control-label">Delete Patient</span>
                                            </label>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col">
                                            <label class="custom-control custom-checkbox">
                                                <input type="checkbox" @if($user->cancel == 'on') checked="" @endif class="custom-control-input" name="cancelPt" >
                                                <span class="custom-control-label">Cancel Status Permission</span>
                                            </label>
                                        </div>
                                        <div class="col">
                                            <label class="custom-control custom-checkbox">
                                                <input type="checkbox" @if($user->hold == 'on') checked="" @endif class="custom-control-input" name="holdPt" >
                                                <span class="custom-control-label">Hold Status Permission</span>
                                            </label>
                                        </div>
                                        <div class="col">
                                            <label class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" @if($user->close == 'on') checked="" @endif name="closePt" >
                                                <span class="custom-control-label">Closed Status Permission</span>
                                            </label>
                                        </div>



                                    </div>
                                    <div class="row">
                                        <div class="col" id="checkboxes-container" style="display: none;">
                                            <label class="custom-control custom-checkbox">
                                                <input type="checkbox" @if($user->viewOnly == 'on') checked="" @endif class="custom-control-input" name="viewCheck" id="view-only-checkbox">
                                                <span class="custom-control-label">View Only User</span>
                                            </label>
                                        </div>
                                        <div class="col">
                                            <label class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="viewUser" @if($user->userViewPermisiion == 'on') checked="" @endif name="viewUser">
                                                <span class="custom-control-label">View as User</span>
                                            </label>
                                        </div>
                                        <div class="col">
                                            <label class="custom-control custom-checkbox">
                                                <!-- <input type="checkbox" class="custom-control-input" name="deletePt">
                                                <span class="custom-control-label">Resupply Patient</span> -->
                                            </label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <label class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" @if($user->permission != null && $user->permission != []) checked="" @endif id="permissionCheckbox" name="permissionCheckbox">
                                                <span class="custom-control-label">Notification Permission</span>
                                            </label>
                                        </div>
                                                                                <div class="col">
                                            <label class="custom-control custom-checkbox">
                                                 <input type="checkbox" class="custom-control-input" name="bulkPer"  @if($user->BulkPer == 'on') checked="" @endif>
                                                <span class="custom-control-label">Change Bulk Patient Permission</span>
                                            </label>
                                        </div>
                                        <div class="col">
                                            <!--<label class="custom-control custom-checkbox">-->
                                            <!--     <input type="checkbox" class="custom-control-input" name="bulkPer">-->
                                            <!--    <span class="custom-control-label">Change Bulk Patiemt Permission</span>-->
                                            <!--</label>-->
                                        </div>
                                    </div>
                                    @php
                                    $userPermissions = json_decode($user->permission, true) ?? [];
                                    $showPermissionsDiv = !empty($userPermissions);
                                    @endphp

                                    <div id="permissionsDiv" style="background-color: #f0f0f0; padding: 20px; border: 1px solid #ddd; border-radius: 5px; {{ $showPermissionsDiv ? '' : 'display: none;' }}">
                                        <hr>
                                        <div class="row">
                                            <div class="col">
                                                <label class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" name="permission[]" value="New Patient Added" @if(in_array('New Patient Added', $userPermissions)) checked @endif>
                                                    <span class="custom-control-label">Add New Patient</span>
                                                </label>
                                            </div>

                                            <div class="col">
                                                <label class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" name="permission[]" value="Patient User Change" @if(in_array('Patient User Change', $userPermissions)) checked @endif>
                                                    <span class="custom-control-label">From one user to another user patient transfer</span>
                                                </label>
                                            </div>

                                            <div class="col">
                                                <label class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" name="permission[]" value="Patient Department Change" @if(in_array('Patient Department Change', $userPermissions)) checked @endif>
                                                    <span class="custom-control-label">From one department to another department patient transfer</span>
                                                </label>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col">
                                                <label class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" name="permission[]" value="Patient Status Change" @if(in_array('Patient Status Change', $userPermissions)) checked @endif>
                                                    <span class="custom-control-label">Patient status change </span>
                                                </label>
                                            </div>

                                            <div class="col">
                                                <label class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" name="permission[]" value="New Document Added" @if(in_array('New Document Added', $userPermissions)) checked @endif>
                                                    <span class="custom-control-label">Document upload by user in the patient</span>
                                                </label>
                                            </div>

                                            <div class="col">
                                                <label class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" name="permission[]" value="Doctor Added" @if(in_array('Doctor Added', $userPermissions)) checked @endif>
                                                    <span class="custom-control-label">Add new doctor</span>
                                                </label>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col">
                                                <label class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" name="permission[]" value="Doctor Edit" @if(in_array('Doctor Edit', $userPermissions)) checked @endif>
                                                    <span class="custom-control-label">Edit doctor</span>
                                                </label>
                                            </div>

                                            <div class="col">
                                                <label class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" name="permission[]" value="Doctor Deleted" @if(in_array('Doctor Deleted', $userPermissions)) checked @endif>
                                                    <span class="custom-control-label">Delete doctor </span>
                                                </label>
                                            </div>

                                            <div class="col">
                                                <label class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" name="permission[]" value="User Added" @if(in_array('User Added', $userPermissions)) checked @endif>
                                                    <span class="custom-control-label">Add New user</span>
                                                </label>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col">
                                                <label class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" name="permission[]" value="User Deleted" @if(in_array('User Deleted', $userPermissions)) checked @endif>
                                                    <span class="custom-control-label">Delete user</span>
                                                </label>
                                            </div>

                                            <div class="col">
                                                <label class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" name="permission[]" value="User Editeded" @if(in_array('User Editeded', $userPermissions)) checked @endif>
                                                    <span class="custom-control-label">Edit user </span>
                                                </label>
                                            </div>

                                            <div class="col">
                                                <label class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" name="permission[]" value="Document Edited" @if(in_array('Document Edited', $userPermissions)) checked @endif>
                                                    <span class="custom-control-label">Edit Document</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <label class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" name="permission[]" value="Document Deleted" @if(in_array('Document Deleted', $userPermissions)) checked @endif>
                                                    <span class="custom-control-label">Delete Document</span>
                                                </label>
                                            </div>

                                            <div class="col">
                                                <label class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" name="permission[]" value="Authentication" @if(in_array('Authentication', $userPermissions)) checked @endif>
                                                    <span class="custom-control-label">User login or logout</span>
                                                </label>
                                            </div>

                                            <div class="col">
                                                <label class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" name="permission[]" value="User Banned" @if(in_array('User Banned', $userPermissions)) checked @endif>
                                                    <span class="custom-control-label">Ban User</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <label class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" name="permission[]" value="User Password Changed" @if(in_array('User Password Changed', $userPermissions)) checked @endif>
                                                    <span class="custom-control-label">User Password Change</span>
                                                </label>
                                            </div>

                                            <div class="col">
                                                <label class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" name="permission[]" value="Resupply Patient" @if(in_array('Resupply Patient', $userPermissions)) checked @endif>
                                                    <span class="custom-control-label">Resupply Patient</span>
                                                </label>
                                            </div>

                                            <div class="col">
                                                <label class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" name="permission[]" value="Patient Edited" @if(in_array('Patient Edited', $userPermissions)) checked @endif>
                                                    <span class="custom-control-label">Edit patient </span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="form-group" id="view-only-dropdown-container" style="{{ $user->viewOnly != 'on' ? 'display: none;' : '' }}">
                                        <label class="col-form-label">View Only Departments</label>
                                        <div class="input-group mb-3">
                                            <span class="input-group-prepend">
                                                <span class="input-group-text"><i class="fa-solid fa-building-user"></i></span>
                                            </span>
                                            <select class="form-control select2" name="Vdept[]" multiple="multiple">
                                                <option disabled>Select User Department</option>
                                                @php
                                                $selectedDepts = json_decode($user->ViewDept, true);

                                                if (!is_array($selectedDepts)) {
                                                $selectedDepts = [];
                                                }
                                                @endphp
                                                @foreach ($dep as $dept)
                                                <option value="{{ $dept->id }}" {{ in_array($dept->id, $selectedDepts) ? 'selected' : '' }}>
                                                    {{ $dept->Department }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <span><small class="text-danger font-weight-light font-italic">
                                                @error('dept')
                                                {{ $message }}
                                                @enderror
                                            </small></span>
                                    </div>




                                    <div class="form-group" id="max-order-container" style="display: none;">
                                        <label class="col-form-label">User Max New Order</label>
                                        <div class="input-group mb-3"><span class="input-group-prepend"><span class="input-group-text"><i class="fa fa-cart-flatbed"></i></span></span>
                                            <input type="number" placeholder="User Max New Order" name="max_order" class="form-control" value="{{ $user->max_pending_order }}">
                                        </div>
                                        <span><small class="text-danger font-weight-light font-italic">
                                                @error('max_order')
                                                {{ $message }}
                                                @enderror
                                            </small></span>
                                    </div>

                                    <div class="form-group" id="Dept-container" style="display: none; width: 100%;">
                                        <label class="col-form-label">User Department</label>
                                        <div class="input-group mb-3">
                                            <span class="input-group-prepend">
                                                <span class="input-group-text"><i class="fa-solid fa-building-user"></i></span>
                                            </span>
                                            <select class="form-control select2" name="dept[]" multiple="multiple">
                                                <option disabled>Select User Department</option>
                                                @php
                                                // Decode the Dept JSON string into a PHP array, ensuring it's always an array
                                                $selectedDepts = json_decode($user->Dept, true);
                                                // If $selectedDepts is not an array, set it to an empty array
                                                if (!is_array($selectedDepts)) {
                                                $selectedDepts = [];
                                                }
                                                @endphp
                                                @foreach ($dep as $dept)
                                                <option value="{{ $dept->id }}" {{ in_array($dept->id, $selectedDepts) ? 'selected' : '' }}>
                                                    {{ $dept->Department }}
                                                </option>
                                                @endforeach
                                            </select>

                                        </div>
                                        <span><small class="text-danger font-weight-light font-italic">
                                                @error('dept')
                                                {{ $message }}
                                                @enderror
                                            </small></span>
                                    </div>


                                </div>
                                <div class="card-body border-top">
                                    <div class="form-group">
                                        <div class="input-group mb-3">
                                            <div class="input-group">
                                                <button type="submit" class="btn btn-block" style="background-color: #427ed1; color: white;">Submit</button>
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
            logAction("Edit User Page Loaded");
        });
    </script>
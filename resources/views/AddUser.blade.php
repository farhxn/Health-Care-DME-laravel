@section('title', 'Add User')
@include('layout.Head')


<div class="dashboard-wrapper">
    <div class="dashboard-ecommerce">
        <div class="container-fluid dashboard-content">
            <div class="row">

                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="page-header">
                        <h2 class="pageheader-title ml-auto">Add User</h2>
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
                        <form method="post" action="{{ url('RegisterUser') }}">
                            @csrf
                            <div class="card">
                                <h5 class="card-header">Add User Details</h5>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label class="col-form-label">User Name</label>
                                        <div class="input-group mb-3"><span class="input-group-prepend"><span class="input-group-text"><i class="fa fa-user"></i></span></span>
                                            <input type="text" required placeholder="User Name" name="name" class="form-control" value="{{ old('name') }}">
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
                                            <input type="mail" required placeholder="User Email" name="mail" class="form-control" value="{{ old('mail') }}">
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
                                            <input type="password" required placeholder="User Password" name="password" class="form-control" value="{{ old('password') }}">

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
                                                <option selected disabled>Select User Role</option>
                                                <option value="0">User</option>
                                                <option value="1">Manager</option>
                                                <option value="2">Admin</option>
                                            </select>
                                        </div>
                                        <span><small class="text-danger font-weight-light font-italic">
                                                @error('role')
                                                {{ $message }}
                                                @enderror
                                            </small></span>
                                    </div>
                                    <div class="row" id="Doc-container" style="display: none;">
                                        <div class="col">
                                            <label class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" name="progressCheck">
                                                <span class="custom-control-label">View Progress Permission</span>
                                            </label>
                                        </div>
                                        <div class="col">
                                            <label class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" name="editDoc">
                                                <span class="custom-control-label">Edit Document</span>
                                            </label>
                                        </div>

                                        <div class="col">
                                            <label class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" name="deleteDoc">
                                                <span class="custom-control-label">Delete Document</span>
                                            </label>
                                        </div>


                                    </div>


                                    <div class="row" id="pat-container" style="display: none;">
                                        <div class="col">
                                            <label class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" name="addPt">
                                                <span class="custom-control-label">Add Patient</span>
                                            </label>
                                        </div>

                                        <div class="col">
                                            <label class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" name="editPt">
                                                <span class="custom-control-label">Edit Patient</span>
                                            </label>
                                        </div>

                                        <div class="col">
                                            <label class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" name="deletePt">
                                                <span class="custom-control-label">Delete Patient</span>
                                            </label>
                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="col">
                                            <label class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" name="cancelPt">
                                                <span class="custom-control-label">Cancel Status Permission</span>
                                            </label>
                                        </div>
                                        <div class="col">
                                            <label class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" name="holdPt">
                                                <span class="custom-control-label">Hold Status Permission</span>
                                            </label>
                                        </div>
                                        <div class="col">
                                            <label class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" name="closePt">
                                                <span class="custom-control-label">Closed Status Permission</span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col" id="checkboxes-container" style="display: none;">
                                            <label class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" name="viewCheck" id="view-only-checkbox">
                                                <span class="custom-control-label">View Only User</span>
                                            </label>
                                        </div>

                                        <div class="col">
                                            <label class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="viewUser" name="viewUser">
                                                <span class="custom-control-label">View as User</span>
                                            </label>
                                        </div>
                                        
                                        <div class="col">
                                            <!--<label class="custom-control custom-checkbox">-->
                                            <!--     <input type="checkbox" class="custom-control-input" name="bulkPer">-->
                                            <!--    <span class="custom-control-label">Change Bulk Patiemt Permission</span>-->
                                            <!--</label>-->
                                        </div>
                                        
                                        
                                        
                                    </div>

                                    <div class="row">
                                        <div class="col">
                                            <label class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="permissionCheckbox" name="permissionCheckbox">
                                                <span class="custom-control-label">Notification Permission</span>
                                            </label>
                                        </div>
                                        <div class="col">
                                            <label class="custom-control custom-checkbox">
                                                 <input type="checkbox" class="custom-control-input" name="bulkPer">
                                                <span class="custom-control-label">Change Bulk Patiemt Permission</span>
                                            </label>
                                        </div>
                                        <div class="col">
                                            <!--<label class="custom-control custom-checkbox">-->
                                            <!--     <input type="checkbox" class="custom-control-input" name="bulkPer">-->
                                            <!--    <span class="custom-control-label">Change Bulk Patiemt Permission</span>-->
                                            <!--</label>-->
                                        </div>
                                        
                                    </div>
                                    <div id="permissionsDiv" style="display: none; background-color: #f0f0f0; padding: 20px; border: 1px solid #ddd; border-radius: 5px;">
                                        <hr>
                                        <div class="row">
                                            <div class="col">
                                                <label class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" name="permission[]" value="New Patient Added">
                                                    <span class="custom-control-label">Add New Patient</span>
                                                </label>
                                            </div>

                                            <div class="col">
                                                <label class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" name="permission[]" value="Patient User Change">
                                                    <span class="custom-control-label">From one user to another user patient transfer</span>
                                                </label>
                                            </div>

                                            <div class="col">
                                                <label class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" name="permission[]" value="Patient Department Change">
                                                    <span class="custom-control-label">From one department to another department patient transfer</span>
                                                </label>
                                            </div>

                                        </div>

                                        <div class="row">
                                            <div class="col">
                                                <label class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" name="permission[]" value="Patient Status Change">
                                                    <span class="custom-control-label">Patient status change </span>
                                                </label>
                                            </div>

                                            <div class="col">
                                                <label class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" name="permission[]" value="New Document Added">
                                                    <span class="custom-control-label">Document upload by user in the patient</span>
                                                </label>
                                            </div>

                                            <div class="col">
                                                <label class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" name="permission[]" value="Doctor Added">
                                                    <span class="custom-control-label">Add new doctor</span>
                                                </label>
                                            </div>

                                        </div>

                                        <div class="row">
                                            <div class="col">
                                                <label class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" name="permission[]" value="Doctor Edit">
                                                    <span class="custom-control-label">Edit doctor</span>
                                                </label>
                                            </div>

                                            <div class="col">
                                                <label class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" name="permission[]" value="Doctor Deleted">
                                                    <span class="custom-control-label">Delete doctor </span>
                                                </label>
                                            </div>

                                            <div class="col">
                                                <label class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" name="permission[]" value="User Added">
                                                    <span class="custom-control-label">Add New user</span>
                                                </label>
                                            </div>

                                        </div>

                                        <div class="row">
                                            <div class="col">
                                                <label class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" name="permission[]" value="User Deleted">
                                                    <span class="custom-control-label">Delete user</span>
                                                </label>
                                            </div>

                                            <div class="col">
                                                <label class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" name="permission[]" value="User Editeded">
                                                    <span class="custom-control-label">Edit user </span>
                                                </label>
                                            </div>

                                            <div class="col">
                                                <label class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" name="permission[]" value="Document Edited">
                                                    <span class="custom-control-label">Edit Document</span>
                                                </label>
                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <label class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" name="permission[]" value="Document Deleted">
                                                    <span class="custom-control-label">Delete Document</span>
                                                </label>
                                            </div>

                                            <div class="col">
                                                <label class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" name="permission[]" value="Authentication">
                                                    <span class="custom-control-label">User login or logout</span>
                                                </label>
                                            </div>

                                            <div class="col">
                                                <label class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" name="permission[]" value="User Banned">
                                                    <span class="custom-control-label">Ban User</span>
                                                </label>
                                            </div>

                                        </div>
                                        <div class="row">

                                            <div class="col">
                                                <label class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" name="permission[]" value="User Password Changed">
                                                    <span class="custom-control-label">User Password Change</span>
                                                </label>
                                            </div>

                                            <div class="col">
                                                <label class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" name="permission[]" value="Resupply Patient">
                                                    <span class="custom-control-label">Resupply Patient</span>
                                                </label>
                                            </div>

                                            <div class="col">
                                                <label class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" name="permission[]" value="Patient Edited">
                                                    <span class="custom-control-label">Edit patient </span>
                                                </label>
                                            </div>


                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <label class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" name="permission[]" value="Patient Deleted">
                                                    <span class="custom-control-label">Delete Patient</span>
                                                </label>
                                            </div>
                                            <div class="col">
                                                <label class="custom-control custom-checkbox">
                                                    <!-- <input type="checkbox" class="custom-control-input" name="deletePt">
                                                <span class="custom-control-label">Resupply Patient</span> -->
                                                </label>
                                            </div>
                                            <div class="col">
                                                <label class="custom-control custom-checkbox">
                                                    <!--<input type="checkbox" class="custom-control-input" name="permission[]" value="Document Edited">-->
                                                    <!--<span class="custom-control-label">Reminder </span>-->
                                                </label>
                                            </div>


                                        </div>
                                        <hr />
                                    </div>

                                    <div class="form-group" id="view-only-dropdown-container">
                                        <label class="col-form-label">View Only Departments</label>
                                        <div class="input-group mb-3">
                                            <span class="input-group-prepend">
                                                <span class="input-group-text"><i class="fa-solid fa-building-user"></i></span>
                                            </span>
                                            <select class="form-control select2" name="Vdept[]" multiple="multiple">
                                                <option disabled>Select User Department</option>
                                                @foreach($dep as $dept)
                                                <option value="{{$dept->id}}">{{$dept->Department}}</option>
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
                                            <input type="number" min="1" placeholder="User Max New Order" name="max_order" class="form-control" value="{{ old('max_order') }}">
                                        </div>
                                        <span><small class="text-danger font-weight-light font-italic">
                                                @error('max_order')
                                                {{ $message }}
                                                @enderror
                                            </small></span>
                                    </div>
                                    <div class="form-group" id="Dept-container" style="display: none; width: 100%">
                                        <label class="col-form-label">User Department</label>
                                        <div class="input-group mb-3">
                                            <span class="input-group-prepend">
                                                <span class="input-group-text"><i class="fa-solid fa-building-user"></i></span>
                                            </span>
                                            <select class="form-control select2" name="dept[]" multiple="multiple">
                                                <option disabled>Select User Department</option>
                                                @foreach($dep as $dept)
                                                <option value="{{$dept->id}}">{{$dept->Department}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <span><small class="text-danger font-weight-light font-italic">
                                                @error('dept')
                                                {{ $message }}
                                                @enderror
                                            </small></span>
                                    </div>
                                    <div class="form-group" id="view-only-dropdown-container" style="display: none; width: 100%;">
                                        <label class="col-form-label">View Only Departments Department</label>
                                        <div class="input-group mb-3">
                                            <span class="input-group-prepend">
                                                <span class="input-group-text"><i class="fa-solid fa-building-user"></i></span>
                                            </span>
                                            <select class="form-control select2" name="dept[]" multiple="multiple">
                                                <option disabled>Select User Department</option>
                                                @foreach($dep as $dept)
                                                <option value="{{$dept->id}}">{{$dept->Department}}</option>
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

    @if (Session::has('fail'))
    <script>
        Swal.fire({
            title: "Error",
            text: "No User Found in that department",
            icon: "Error"
        });
    </script>
    @endif



    <script>
        $(document).ready(function() {
            logAction("Account Created Page Loaded");


            $('input[name="password"]').on('keyup', function() {
                var password = $(this).val();
                var message = [];

                if (!/[A-Z]/.test(password)) {
                    message.push("Must contain at least one uppercase letter.");
                }
                if (!/[0-9]/.test(password)) {
                    message.push("Must contain at least one number.");
                }
                if (!/[@$!%*#?&]/.test(password)) {
                    message.push("Must contain at least one special character.");
                }
                if (password.length < 8) {
                    message.push("Must be at least 8 characters long.");
                }

                $('#passwordHelp').html(message.join('<br>'));
            });
        });
    </script>
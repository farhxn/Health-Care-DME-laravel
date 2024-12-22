@section('title', 'Users List')
@include('layout.Head')

<div class="dashboard-wrapper">
    <div class="dashboard-ecommerce">
        <div class="container-fluid dashboard-content">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="page-header">
                        <h2 class="pageheader-title ml-auto">Users List</h2>
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
                                <div class="d-flex">
                                    <a href="{{ url('UserAdd') }}" class="btn btn-primary ml-auto" style="width: 200px;">Add User</a>
                                </div>

                            </div>
                            <br>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table display" id="myTableUser">
                                        <thead class="bg-light">
                                            <tr class="border-0">
                                                <th class="border-0">No.</th>
                                                <th class="border-0">Name</th>
                                                <th class="border-0">E-Mail</th>
                                                <th class="border-0">Role</th>
                                                <th class="border-0">Department</th>

                                                <th class="border-0">Status</th>
                                                <th class="border-0">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                            $userR = Session::get('LoginRole');
                                            $ViewAsUserPer = Session::get('LoginviewUser');
                                            $BulkChangePer = Session::get('LoginBulkPer');
                                            $sno = 1;
                                            @endphp

                                            @foreach ($users as $user)
                                            @if ($user->id != 3 && $user->id != 7)

                                            <tr data-href="{{ url('userDetail', $user->id) }}" style="cursor: pointer;" data-toggle="tooltip" data-placement="top" title="" data-original-title="Show {{ $user->name }}'s Details">

                                                <td>{{ $sno++ }}</td>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>
                                                    @if ($user->role == '2')
                                                    Admin
                                                    @elseif($user->role == '1')
                                                    Manager
                                                    @else
                                                    User
                                                    @endif
                                                </td>

                                                <td>
                                                    @if($user->Dept)
                                                    @php
                                                    $deptIds = json_decode($user->Dept, true);
                                                    @endphp

                                                    @if(is_array($deptIds) && !empty($deptIds))
                                                    <ol>
                                                        @foreach ($deptIds as $deptId)
                                                        @php
                                                        $department = \App\Models\Departments::find($deptId);
                                                        @endphp

                                                        <li>{{ $department ? $department->Department : 'Department not found' }}</li>
                                                        @endforeach
                                                    </ol>
                                                    @endif
                                                    @endif

                                                </td>
                                                <td>
                                                    @if ($user->status == '1')
                                                    <span class="badge-dot badge-danger mr-1"></span>Close
                                                    @else
                                                    <span class="badge-dot badge-success mr-1"></span>Open
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        @if($userR =="2" || $ViewAsUserPer == "on")
                                                        <a href="{{ url('viewUser', $user->id) }}" class="btn btn-sm btn-dark" data-toggle="tooltip" data-placement="top" title="" data-original-title="View as {{ $user->name }}"><i class="fa fa-eye"></i></a>
                                                        @endif
                                                        @if($userR =="2" || $BulkChangePer == "on")
                                                        <button type="button" data-toggle="modal" data-user-id="{{ $user->id }}" data-target="#PatientBulkChange" class="btn btn-success  mx-1 modal-btn" style="font-size: 0.875rem; padding: 0.25rem 0.5rem;">
                                                            <i class="fa-solid fa-dice"></i>
                                                        </button>
                                                        @endif
                                                        @if($userR =="2" )

                                                        <a href="{{ url('Useredit', $user->id) }}" class="btn btn-sm btn-warning mx-1" data-toggle="tooltip" data-placement="top" title="Edit {{ $user->name }}'s details">
                                                            <i class="fa fa-pen-to-square"></i>
                                                        </a>
                                                        <button data-url="{{ url('DeleteUser', $user->id) }}" class="btn btn-sm btn-danger delete-btn mx-1" data-toggle="tooltip" data-placement="top" title="Delete {{ $user->name }}'s account">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                        <button data-url="{{ url('BanUser', $user->id) }}" class="btn btn-sm btn-primary ban-btn mx-1" data-toggle="tooltip" data-placement="top" title="Ban {{ $user->name }}'s account">
                                                            <i class="fa fa-ban"></i>
                                                        </button>

                                                        @endif
                                                    </div>
                                                </td>
                                            </tr>
                                            @endif
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

    <div class="modal fade" id="PatientBulkChange" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Bulk Patient Change</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ url('BulkPatientChange',) }}" method="POST">
                        <div class="form-group">
                            @csrf
                            <input type="hidden" name="userId" id="userId" value=""> <!-- Hidden input to store user ID -->
                            <label for="startDate">Status:</label>
                        </div>
                        <div class="row">
                            @foreach($st as $sat)
                            <div class="col-6">
                                <label class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" value="{{$sat->id}}" name="status[]">
                                    <span class="custom-control-label">{{$sat->Status}}</span>
                                </label>
                            </div>
                            @endforeach
                        </div>


                        <div class="form-group">
                            <label class="col-form-label">Department</label>
                            <div class="input-group mb-3">
                                <span class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                                </span>
                                <select class="form-control" required name="AssigningDept" id="dept-dropdown">
                                    <option selected disabled>Select Department</option>
                                    <!-- Departments will be dynamically loaded here -->
                                </select>
                            </div>
                        </div>

                        <div class="form-group" id="Patient_user" style="display:none;">
                            <label class="col-form-label">Assign User</label>
                            <div class="input-group mb-3">
                                <span class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa-solid fa-user"></i></span>
                                </span>
                                <select class="form-control" required name="AssigningUser" id="user-dropdown">
                                    <option selected disabled>Assign User</option>
                                    <!-- Users will be dynamically loaded here -->
                                </select>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Apply Changes!</button>
                    </form>
                </div>
            </div>
        </div>
    </div>



    @if (Session::has('error'))
    <script>
        Swal.fire({
            title: "Error",
            text: "{{ session('error') }}", // Make sure to enclose the PHP expression in quotes
            icon: "error"
        });
    </script>
    @endif


    <script>
        $(document).ready(function() {
            logAction("Users List Page Loaded");
        });






        document.addEventListener('DOMContentLoaded', function() {
            // Prevent row click event when button is clicked
            document.querySelectorAll('.modal-btn').forEach(function(button) {
                button.addEventListener('click', function(event) {
                    event.stopPropagation(); // Prevent the row click
                    const modalId = this.getAttribute('data-target');
                    const userId = this.getAttribute('data-user-id'); // Get user id from data attribute
                    document.getElementById('userId').value = userId; // Set the user ID in the hidden input field

                    $(modalId).modal('show');
                    console.log(userId);

                    $.ajax({
                        url: '/GetUserDepart/' + userId,
                        type: 'GET',
                        success: function(data) {
                            console.log('data:', data);
                            var deptDropdown = $('#dept-dropdown'); // Assuming there's a dropdown with this ID
                            deptDropdown.empty();
                            deptDropdown.append('<option selected disabled>Select Department</option>');
                            $.each(data, function(key, deptName) {
                                deptDropdown.append('<option value="' + deptName + '">' + key + '</option>');
                            });
                        },
                        error: function(error) {
                            console.log('Error fetching users:', error);
                        }
                    });
                });
            });


            // Enable row click to redirect
            document.querySelectorAll('tr[data-href]').forEach(function(row) {
                row.addEventListener('click', function() {
                    window.location.href = this.dataset.href;
                });
            });


        });

        $('#dept-dropdown').on('change', function() {
            var deptId = $(this).val();
            $.ajax({
                url: '/GetPatientsUser/' + deptId, // Adjust the URL to your endpoint
                type: 'GET',
                success: function(data) {
                    console.log(data);
                    var userDropdown = $('#user-dropdown');
                    userDropdown.empty();
                    userDropdown.append('<option selected disabled>Assign User</option>');
                    $.each(data, function(key, user) {
                        userDropdown.append('<option value="' + user.id + '">' + user.name + '</option>');
                    });
                    $('#Patient_user').show(); // Show the user dropdown
                },
                error: function(error) {
                    console.log('Error fetching users:', error);
                }
            });
        });




        $(document).ready(function() {
            // $('tbody').on('click', '.delete-btn, .ban-btn, .btn-warning', function(event) {
            //     event.stopPropagation();
            //     // Your code here (e.g., AJAX calls for delete or ban actions)
            // });

            $('tbody').on('click', 'tr', function() {
                var url = $(this).data('href'); // Make sure your tr has a data-href attribute
                if (url) {
                    window.location = url;
                }
            });
        });
    </script>
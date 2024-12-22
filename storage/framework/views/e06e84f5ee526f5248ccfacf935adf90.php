<div class="footer">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                HealthCare DME &copy; All Rights Reserved.
                <!--Created by <a >M.Farhan Atif & Kamran Arain</a> with <i class="fa fa-heart"></i>-->
            </div>
            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                <div class="text-md-right footer-links d-none d-sm-block">
                    <a href="<?php echo e(url('terms')); ?>" target="_blank">Terms&nbsp;&&nbsp;Conditions</a>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>

</body>

<!--<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyACwkCu5UFCldAig3UqVu_n6g3L53fCc9k&libraries=places&callback=initAutocomplete" async defer></script>-->
<script src="
https://cdn.jsdelivr.net/npm/sweetalert2@11.10.5/dist/sweetalert2.all.min.js
"></script>
<script src="https://colorlib.com//polygon/concept/assets/vendor/jquery/jquery-3.3.1.min.js"></script>
<script src="https://colorlib.com//polygon/concept/assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
<script src="https://colorlib.com//polygon/concept/assets/vendor/slimscroll/jquery.slimscroll.js"></script>
<script src="https://colorlib.com//polygon/concept/assets/libs/js/main-js.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCFKxQdDWrNyUS9hG7feVakC8tUaNjhIQs&libraries=places&callback=initAutocomplete" async defer></script>


<div class="modal fade" id="dateRangeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Select Date Range</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="dateRangeForm" action="<?php echo e(url('MainReport')); ?>" method="GET" target="_blank">
                    <div class="form-group">
                        <label for="startDate">Start Date:</label>
                        <input type="date" class="form-control" id="startDate" name="startDate" required>
                    </div>
                    <div class="form-group">
                        <label for="endDate">End Date:</label>
                        <input type="date" class="form-control" id="endDate" name="endDate" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Generate Report</button>
                </form>
            </div>
        </div>
    </div>
</div>




<div class="modal fade" id="PatientReport" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Select Date Range For Patient Report</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="dateRangeForm" action="<?php echo e(url('PatientReport')); ?>" method="GET" target="_blank">
                    <div class="form-group">
                        <label for="startDate">Start Date:</label>
                        <input type="date" class="form-control" id="startDate" name="startDate" required>
                    </div>
                    <div class="form-group">
                        <label for="endDate">End Date:</label>
                        <input type="date" class="form-control" id="endDate" name="endDate" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Generate Report</button>
                </form>
            </div>
        </div>
    </div>
</div>




<script>
    function initAutocomplete() {
        // Create the autocomplete object, restricting the search predictions to
        // geographical location types.
        var autocomplete = new google.maps.places.Autocomplete(
            document.getElementById('patientAddress'), {
                types: ['geocode']
            }
        );

        // Optional: Add a listener for the place_changed event
        autocomplete.addListener('place_changed', function() {
            var place = autocomplete.getPlace();
            console.log(place.formatted_address); // Example action: logging the address
        });
    }
</script>







</html>
<?php if(Session::has('success')): ?>
<script>
    Swal.fire({
        title: "Success",
        text: "Saved Successfully",
        icon: "success"
    });
</script>
<?php endif; ?>
<?php if(Session::has('fail')): ?>
<script>
    Swal.fire({
        title: "Error",
        text: "Invalid Credentials",
        icon: "Error"
    });
</script>
<?php endif; ?>
<?php if(Session::has('Ban')): ?>
<script>
    Swal.fire({
        title: "Error",
        text: "Your Account is suspended!!!!",
        icon: "Error"
    });
</script>
<?php endif; ?>


<script>
    $(document).ready(function() {
        var table = $('#myTable').DataTable({
            ordering: false, // Disable DataTables sorting if needed
            pageLength: 25 // Set the default number of rows to 25
        });

        $('#myTableUser').DataTable({

            pageLength: 25 // Set the default number of rows to 25

        });

        // Column-specific search functionality
        $(".column-search").on("keyup change", function() {
            var columnNumber = $(this).data("column");
            var searchTerm = $(this).val();

            // Show/hide clear icon based on input
            if (searchTerm) {
                $(this).siblings('.clear-icon').show();
            } else {
                $(this).siblings('.clear-icon').hide();
            }

            table.column(columnNumber).search(searchTerm).draw();
        });

        // Clear input and search functionality
        $(".clear-icon").click(function() {
            $(this).siblings('.search-input').val('');
            $(this).hide();
            var columnNumber = $(this).siblings('.search-input').data("column");
            table.column(columnNumber).search('').draw();
        });
    });




    $(document).ready(function() {

        $('#permissionCheckbox').change(function() {
            if ($(this).is(':checked')) {
                $('#permissionsDiv').show();
            } else {
                $('#permissionsDiv').hide();
            }
        });

        function toggleMaxOrderField() {
            var selectedRole = $('#role-dropdown').val();

            if (selectedRole === '0' || selectedRole == '1') {
                $('#Doc-container').show();
                $('#pat-container').show();
            } else {
                $('#pat-containerr').hide();
                $('#Doc-container').hide();
            }

            if (selectedRole === '0') { // User role
                $('#checkboxes-container').show();
                $('#max-order-container').show();
                $('#Dept-container').show();


                // Listen for changes in the "View Only User" checkbox
                $('#view-only-checkbox').change(function() {
                    if ($(this).is(':checked')) {
                        $('#view-only-dropdown-container').show();
                        $('.select2').select2({
                            placeholder: "Select User Department",
                            allowClear: true
                        });
                    } else {
                        $('#view-only-dropdown-container').hide();
                    }
                });

                // Initialize or re-initialize the select2 component
                $('.select2').select2({
                    placeholder: "Select User Department",
                    allowClear: true
                });

            } else {
                $('#Dept-container').hide();
                $('#max-order-container').hide();
                $('#checkboxes-container').hide(); // Hide all checkboxes if not User role
                $('#view-only-dropdown-container').hide(); // Also hide the "Select View Only Department" dropdown
            }

            $('#status-dropdown').change(function() {
                var selectedDeptText = $("#status-dropdown option:selected").text().toLowerCase(); // Get the text and convert to lowercase
                if (selectedDeptText.includes("resupply")) { // Check if the text includes 'resupply'
                    $('#resupplyDate-container').show();
                    $('#newresupplyDate-container').show();
                    $('#newDept1-container').show();
                    $('#newfrequency-container').show();
                } else {
                    $('#resupplyDate-container').hide();
                    $('#newresupplyDate-container').hide();
                    $('#newDept1-container').hide();
                    $('#newfrequency-container').hide();
                }

                if (selectedDeptText.includes("ready for dispense")) {
                    $('#PatientDetail-checkboxes').show();
                } else {
                    $('#PatientDetail-checkboxes').hide();
                }


            });



            $('#statusdept-dropdown').change(function() {
                var selectedDeptText1 = $("#statusdept-dropdown option:selected").text().toLowerCase(); // Get the text and convert to lowercase
                if (selectedDeptText1.includes("resupply")) { // Check if the text includes 'resupply'
                    $('#subdept-container').show();
                } else {
                    $('#subdept-container').hide();
                }
                var selectedDept = $(this).val(); // Get the selected department's value
                if (selectedDept != null) {
                    $('#user-container').show(); // Show the user container
                } else {
                    $('#user-container').hide(); // Hide the user container
                }
            });




            $('#status_id').change(function() {
                var selectedDeptText1 = $("#status_id option:selected").text().toLowerCase(); // Get the text and convert to lowercase
                if (selectedDeptText1.includes("resupply")) { // Check if the text includes 'resupply'
                    $('#resupplyDate-container').show();
                } else {
                    $('#resupplyDate-container').hide();
                }
            });

        }


        toggleMaxOrderField();
        $('#role-dropdown').change(toggleMaxOrderField);

        $('.btn-sm').on('click', function(event) {
            event.stopPropagation();
        });


        $('#statusdept-dropdown').change(function() {
            var deptId = $(this).val(); // Get selected department ID
            $.ajax({
                url: '/DepartmentUser/' + deptId,
                type: 'GET',
                success: function(data) {
                    var userDropdown = $('#user-dropdown');
                    userDropdown.empty();
                    userDropdown.append('<option selected disabled>Assign User</option>');
                    $.each(data, function(key, user) {
                        userDropdown.append('<option value="' + user.id + '">' +
                            user.name + '</option>');
                    });
                },
                error: function(error) {
                    console.log('Error fetching users:', error);
                }
            });
        });




        //Creating Logs
        //    logAction("Page Loaded: " + window.location.pathname);
    });

    $('.delete-btn').on('click', function() {
        var deleteUrl = $(this).data('url'); // Get the URL from the data attribute
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
        }).then((result) => {
            if (result.isConfirmed) {
                // Send AJAX request to the delete URL
                $.ajax({
                    url: deleteUrl,
                    type: 'POST', // Match the method expected by your Laravel route
                    data: {
                        _token: "<?php echo e(csrf_token()); ?>", // CSRF token for Laravel
                    },
                    success: function(response) {
                        Swal.fire({
                            title: "Deleted!",
                            text: "deleted Successfully.",
                            icon: "success"
                        }).then(() => {
                            window.location.reload(); // Reload the page or redirect
                        });
                    },
                    error: function(xhr, status, error) {
                        // Handle error
                        console.error(error);
                    }
                });

                console.log(deleteUrl);
            } else {
                swalWithBootstrapButtons.fire({
                    title: "Cancelled",
                    text: "It is safe :)",
                    icon: "error"
                });
            }

        });
    });

    $('.ban-btn').on('click', function() {
        var deleteUrl = $(this).data('url'); // Get the URL from the data attribute
        Swal.fire({
            title: "Are you sure?",
            text: "You will be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, Do it!"
        }).then((result) => {
            if (result.isConfirmed) {
                // Send AJAX request to the delete URL
                $.ajax({
                    url: deleteUrl,
                    type: 'POST', // Match the method expected by your Laravel route
                    data: {
                        _token: "<?php echo e(csrf_token()); ?>", // CSRF token for Laravel
                    },
                    success: function(response) {
                        Swal.fire({
                            title: "Success!",
                            text: "Saved Successfully.",
                            icon: "success"
                        }).then(() => {
                            window.location.reload(); // Reload the page or redirect
                        });
                    },
                    error: function(xhr, status, error) {
                        // Handle error
                        console.error(error);
                    }
                });

            } else {
                swalWithBootstrapButtons.fire({
                    title: "Cancelled",
                    text: "It is safe :)",
                    icon: "error"
                });
            }

        });
    });


    function logAction(action) {
        $.ajax({
            url: '/log',
            type: 'POST',
            data: {
                action: action,
                _token: '<?php echo e(csrf_token()); ?>', // CSRF token for Laravel POST requests
            },
            success: function(response) {
                console.log('Action logged successfully:', action);
            },
            error: function(error) {
                console.log('Error logging action:', error);
            }
        });
    }








    $(document).ready(function() {

        orderProcessing();



        let functionsCalledToday = localStorage.getItem("functionsCalledToday");

        const now = new Date();
        const currentTime = now.getHours();
        const todayDate = now.toDateString();

        if (currentTime >= 12 && (!functionsCalledToday || functionsCalledToday !== todayDate)) {
            sendUpdateReminder();
            sendReminders();
            AssignToUserFromResupply();
            sendResupplyReminder();
            CheckUserLogin();
            // orderProcessing();
            localStorage.setItem("functionsCalledToday", todayDate);
        }
        if (functionsCalledToday && functionsCalledToday !== todayDate) {
            localStorage.removeItem("functionsCalledToday");
        }

        // sendUpdateReminder();
        // sendReminders();
        // AssignToUserFromResupply();
        // sendResupplyReminder();
        // CheckUserLogin();

        var actualSelectedDeptId = $('#dept-dropdown').val();

        $('#dept-dropdown').change(function() {
            var selectedDeptText = $("#dept-dropdown option:selected").text().toLowerCase(); // Get the text and convert to lowercase
            console.log(selectedDeptText);
            if (selectedDeptText.includes("resupply")) { // Check if the text includes 'resupply'
                $('#subdept-container').show();
            } else {
                $('#subdept-container').hide();
            }
            actualSelectedDeptId = $(this).val();
            updateUsersBasedOnDepartmentOrStatus(actualSelectedDeptId); // Pass the current department ID
        });

        $('#status_id').change(function() {
            updateUsersBasedOnDepartmentOrStatus(actualSelectedDeptId); // Pass the current department ID
        });

        function updateUsersBasedOnDepartmentOrStatus(currentDeptId) {
            var selectedStatus = $('#status_id').find(":selected").text().toLowerCase();
            var deptId;

            if (selectedStatus === "pending") {
                deptId = 1; // Special identifier for "pending" handling
            } else {
                deptId = currentDeptId; // Use the actual selected department ID
            }


            // If no department is selected and status is not pending, hide the user container and exit the function
            if (!deptId) {
                $('#user-container').hide();
                return;
            }

            $.ajax({
                url: '/DepartmentUser/' + deptId,
                type: 'GET',
                data: {
                    actualDeptId: currentDeptId, // Always pass the actual department ID
                    selectedStatus: selectedStatus // Optionally pass the status to make server logic more explicit
                }, // Pass the actual selected department ID
                success: function(data) {
                    console.log('Status:', selectedStatus);
                    console.log('actualDeptId:', currentDeptId);
                    console.log('data:', data);
                    var userDropdown = $('#user-dropdown');
                    userDropdown.empty();
                    userDropdown.append('<option selected disabled>Assign User</option>');
                    $.each(data, function(key, user) {
                        userDropdown.append('<option value="' + user.id + '">' + user.name + '</option>');
                    });
                    $('#user-container').show();
                },
                error: function(error) {
                    console.log('Error fetching users:', error);
                }
            });
        }
    });



    function orderProcessing() {
        $.ajax({
            url: '/orderProcessing',
            type: 'GET',
            success: function(response) {
                console.log('Order Processed');
            },
            error: function(error) {
                console.log('Error Processing Order :', error);
            }
        });
    }



    function CheckUserLogin() {
        $.ajax({
            url: '/CheckUserLogin',
            type: 'GET',
            success: function(response) {
                console.log('Loged in user Stays');
            },
            error: function(error) {
                console.log('Error Checking User Login :', error);
            }
        });
    }

    function sendUpdateReminder() {
        $.ajax({
            url: '/send-update-reminder', // Adjusted to match the new route
            type: 'POST',
            data: {
                _token: '<?php echo e(csrf_token()); ?>', // CSRF token for Laravel POST requests
            },
            success: function(response) {
                console.log('Follow Up Reminder sent successfully:', response.message);
            },
            error: function(error) {
                console.log(' Follow Up  Error sending reminder:', error);
            }
        });
    }

    function AssignToUserFromResupply() {
        $.ajax({
            url: '/assignToResupplyUser', // Adjusted to match the new route
            type: 'POST',
            data: {
                _token: '<?php echo e(csrf_token()); ?>', // CSRF token for Laravel POST requests
            },
            success: function(response) {
                console.log(response);
                console.log('User Re-Assign set successfully:', response.message);
            },
            error: function(error) {
                console.log('User Re-Assign  Error sending reminder:', error);
            }
        });
    }

    function sendResupplyReminder() {
        $.ajax({
            url: '/mailToResupplyUser', // Adjusted to match the new route
            type: 'POST',
            data: {
                _token: '<?php echo e(csrf_token()); ?>', // CSRF token for Laravel POST requests
            },
            success: function(response) {
                console.log('Resupply Reminder sent successfully:', response.message);
            },
            error: function(error) {
                console.log('Error sending resupply reminder:', error);
            }
        });
    }



    function sendReminders() {
        $.ajax({
            url: '/send-reminder', // Adjusted to match the new route
            type: 'POST',
            data: {
                _token: '<?php echo e(csrf_token()); ?>', // CSRF token for Laravel POST requests
            },
            success: function(response) {
                console.log('Reminder sent successfully:', response.message);
            },
            error: function(error) {
                console.log('Error sending reminder:', error);
            }
        });
    }



    $(document).ready(function() {
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

<?php if(!Session::get('functions_called_after_login')): ?>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            sendUpdateReminder();
            sendReminders();
            AssignToUserFromResupply();
            sendResupplyReminder();
            CheckUserLogin();
        });
    </script>
    <?php
        session(['functions_called_after_login' => true]);
    ?>
<?php endif; ?>
<?php /**PATH D:\purana xammp\htdocs\ecommerce-laravel\data-mangment2\resources\views/layout/footer.blade.php ENDPATH**/ ?>
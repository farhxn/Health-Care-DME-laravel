@section('title', 'Doctor List')
@include('layout.Head')

<div class="dashboard-wrapper">
    <div class="dashboard-ecommerce">
        <div class="container-fluid dashboard-content">
            <div class="row">
                <div class="col-12">
                    <div class="d-flex justify-content-between align-items-center">
                        <h2 class="pageheader-title">Doctor</h2>
                        <a href="{{url('AddNewDoctor',0)}}" class="btn btn-primary">
                            Add New Doctor</a>
                    </div>
                </div>
            </div>
            <br>

            <div class="ecommerce-widget">
                <div class="row">
                    <div class="col">
                        <div class="card">
                            <br>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table display" id="myTable">
                                        <thead class="bg-light text-center">
                                            <tr class="border-0 text-center">
                                                <th class="border-0 text-center">No.</th>
                                                <th class="border-0 text-center">Name</th>
                                                <th class="border-0 text-center">NPI</th>
                                                <th class="border-0 text-center">License</th>
                                                <th class="border-0 text-center">License Expiry</th>
                                                <th class="border-0 text-center">Last Check</th>
                                                <th class="border-0 text-center">Status</th>
                                                <th class="border-0 text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $sno = 1;
                                            ?>
                                            @foreach ($doctor as $dr)
                                            <tr>
                                                <td class="text-center">{{ $sno++ }}</td>
                                                <td class="text-center">{{ $dr->FirstName.' '.$dr->LastName }}</td>
                                                <td class="text-center">{{ $dr->NPI }}</td>
                                                <td class="text-center">{{ $dr->License }}</td>
                                                <td class="text-center">{{ $dr->Expiry }}</td>
                                                <td class="text-center">{{ $dr->LastCheck }}</td>
                                                <td class="text-center"><span class="badge-dot badge-{{ $dr->LastCheck ? "success":"danger" }} mr-1"></span> {{ $dr->LastCheck ? "Active":"Not Active"}}</td>
                                                <td class="text-center">
                                                    <button class="btn btn-sm btn-primary"
                                                        data-toggle="tooltip"
                                                        data-placement="top"
                                                        title="Update {{ $dr->FirstName.' '.$dr->LastName }}'s NPI Status"
                                                        data-doctor-id="{{ $dr->id }}"
                                                        id="checkNpiButton">
                                                        <i class="fa fa-refresh"></i>
                                                    </button>
                                                    <a href="{{ url('AddNewDoctor', $dr->id) }}"
                                                        class="btn btn-sm btn-warning" data-toggle="tooltip"
                                                        data-placement="top" title=""
                                                        data-original-title="Edit {{ $dr->FirstName.' '.$dr->LastName }}"><i
                                                            class="fa fa-pen-to-square"></i></a>
                                                    <button data-url="{{ url('DeleteDoctorData', $dr->id) }}"
                                                        class="btn btn-sm btn-danger delete-btn"
                                                        data-toggle="tooltip" data-placement="top" title=""
                                                        data-original-title="Delete {{ $dr->FirstName.' '.$dr->LastName }}'s Status"><i
                                                            class="fa fa-trash"></i></button>

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



    <script>
        $(document).ready(function() {
            logAction("Doctors Page Loaded");
        });

        document.getElementById('checkNpiButton').addEventListener('click', function() {
            var doctorId = this.getAttribute('data-doctor-id');
            fetch('/check-npi-status', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}' // Include CSRF token
                    },
                    body: JSON.stringify({
                        doctorId: doctorId // Include doctor ID in the request body
                    })
                })
                .then(response => response.json())
                .then(data => {
                    console.log("Updated Successfully");
                    window.location.reload();
                })
                .catch(error => {
                    console.log(error);
                    // npiStatusDiv.innerHTML = `<span class="text-danger">Error: ${error.message}</span>`;
                });
        });
    </script>

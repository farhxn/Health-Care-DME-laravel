@section('title', 'Tax List')
@include('layout.Head')

<div class="dashboard-wrapper">
    <div class="dashboard-ecommerce">
        <div class="container-fluid dashboard-content">
            <div class="row">
                <div class="col-12">
                    <div class="d-flex justify-content-between align-items-center m-3">
                        <!-- Heading aligned to the left -->
                        <h2 class="pageheader-title">Tax</h2>
                        <a href="{{url('AddTax',0)}}" class="btn btn-primary">Add Tax</a>
                    </div>
                </div>
            </div>

            <div class="ecommerce-widget">

                <div class="row">
                    <div class="col">
                        <div class="card">
                            <h5></h5>
                            <div class="container card-header">

                            </div>
                            <br>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table display" id="myTable">
                                        <thead class="bg-light text-center">
                                            <tr class="border-0 text-center">
                                                <th class="border-0 text-center">No.</th>
                                                <th class="border-0 text-center">Name</th>
                                                <th class="border-0 text-center">State Tax</th>
                                                <th class="border-0 text-center">County Tax</th>
                                                <th class="border-0 text-center">City Tax</th>
                                                <th class="border-0 text-center">Other Tax</th>
                                                <th class="border-0 text-center">Total Tax</th>
                                                <th class="border-0 text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $sno = 1;
                                            ?>
                                            @foreach ($tax as $user)
                                            <tr>
                                                <td class="text-center">{{ $sno++ }}</td>
                                                <td class="text-center">{{ $user->Name }}</td>
                                                <td class="text-center">{{ $user->StatesTax }}</td>
                                                <td class="text-center">{{ $user->CountyTax }}</td>
                                                <td class="text-center">{{ $user->CityTax }}</td>
                                                <td class="text-center">{{ $user->OtherTax }}</td>
                                                <td class="text-center">{{ $user->TotalTax }}</td>
                                                <td class="text-center">
                                                    <a href="{{ url('AddTax', $user->id) }}"
                                                        class="btn btn-sm btn-warning" data-toggle="tooltip"
                                                        data-placement="top" title=""
                                                        data-original-title="Edit {{ $user->Name }}"><i
                                                            class="fa fa-pen-to-square"></i></a>
                                                    <button data-url="{{ url('DeleteTax', $user->id) }}"
                                                        class="btn btn-sm btn-danger delete-btn"
                                                        data-toggle="tooltip" data-placement="top" title=""
                                                        data-original-title="Delete {{ $user->Name }}"><i
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
            logAction("Status wise patient List Page Loaded");
        });
    </script>

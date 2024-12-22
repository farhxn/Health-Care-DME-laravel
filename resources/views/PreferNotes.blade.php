@section('title', 'Preferred Notes List')
@include('layout.Head')

<div class="dashboard-wrapper">
    <div class="dashboard-ecommerce">
        <div class="container-fluid dashboard-content">
            <div class="row">
                <div class="col-12">
                    <div class="d-flex justify-content-between align-items-center">
                        <h2 class="pageheader-title">Preferred Notes</h2>
                        <a href="{{url('AddEditNotesPage',0)}}" class="btn btn-primary">
                            Add New Preferred Notes</a>
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
                                                <th class="border-0 text-center">Type</th>
                                                <th class="border-0 text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $sno = 1;
                                            ?>
                                            @foreach ($preNotes as $dr)
                                            <tr>
                                                <td class="text-center">{{ $sno++ }}</td>
                                                <td class="text-center">{{ $dr->Name }}</td>
                                                <td class="text-center">{{ $dr->Type }}</td>
                                                <td class="text-center">
                                                    <a href="{{ url('AddEditNotesPage', $dr->id) }}"
                                                        class="btn btn-sm btn-warning" data-toggle="tooltip"
                                                        data-placement="top" title=""
                                                        data-original-title="Edit {{ $dr->Name }}"><i
                                                            class="fa fa-pen-to-square"></i></a>
                                                    <button data-url="{{ url('DeletePreferredNotes', $dr->id) }}"
                                                        class="btn btn-sm btn-danger delete-btn"
                                                        data-toggle="tooltip" data-placement="top" title=""
                                                        data-original-title="Delete {{ $dr->Name }}'s Status"><i
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
    </script>
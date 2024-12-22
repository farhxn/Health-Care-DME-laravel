@section('title', 'Reminders List')
@include('layout.Head')

<div class="dashboard-wrapper">
    <div class="dashboard-ecommerce">
        <div class="container-fluid dashboard-content">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="page-header">
                        <h2 class="pageheader-title ml-auto">Reminders</h2>
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
                        <div class="card">
                            <h5></h5>
 <div class="container card-header">
                                <div class="row">
                                    <div class="col">
<button data-toggle="modal" data-target="#AddNote" class="btn btn-primary btn-block p-2">Add Reminder</button>
                                    </div>
                                </div>
                            <br>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table display" id="myTable">
                                        <thead class="bg-light">
                                            <tr class="border-0">
                                                <th class="border-0">No.</th>
                                                <th class="border-0">Name</th>
                                                <th class="border-0">Reminder</th>
                                                <th class="border-0">Remind On</th>
                                                <th class="border-0">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $sno = 1;
                                            ?>
                                            @foreach ($log as $lo)
                                            <tr>
                                                <td>{{$sno++}}</td>
                                                <td>{{$lo->name}}</td>
                                                <td>{{$lo->Reminder}}</td>
                                                <td>{{ $lo->date }}</td>
                                                <td class="text-center">
                                                        <a href="{{ url('editReminder', $lo->id) }}"
                                                            class="btn btn-sm btn-warning" data-toggle="tooltip"
                                                            data-placement="top" title=""
                                                            data-original-title="Edit {{ $lo->Reminder }}"><i
                                                                class="fa fa-pen-to-square"></i></a>
                                                        <button data-url="{{ url('DeleteReminder', $lo->id) }}"
                                                            class="btn btn-sm btn-danger delete-btn"
                                                            data-toggle="tooltip" data-placement="top" title=""
                                                            data-original-title="Delete {{ $lo->Reminder }}'s Status"><i
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
            logAction("Reminders List Page Loaded");
        });
    </script>
 <div class="modal fade" id="AddNote" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Reminder</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="{{url('AddReminders')}}">
                            @csrf
                            <div class="form-group">
                                <label for="message-text" class="col-form-label">Add Reminder:</label>
                                <textarea class="form-control" name="Reminder" required id="message-text"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="message-text" class="col-form-label">Add Date to Remind:</label>
                                <!--<textarea class="form-control" name="note" required id="message-text"></textarea>-->
                            <input type="date" name = "date" class="form-control" required />
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add Reminder</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
        
        
        
        
<script>
    $(document).ready(function() {
        // logAction("Home Page Loaded");
                // sendUpdateReminder();
                sendReminders();
    });
</script>
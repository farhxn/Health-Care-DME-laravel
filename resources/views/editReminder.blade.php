@section('title', 'Edit Reminder')
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
                        <form method="post" action="{{ url('EditReminderDetail',$log->id) }}">
                            @csrf
                            <div class="card">
                                <h5 class="card-header">Edit {{ $log->Reminder }} Details</h5>
                                <div class="card-body">
                                    
                                                                <div class="form-group">
                                <label for="message-text" class="col-form-label">Add Reminder:</label>
                                <textarea class="form-control" name="Reminder" required id="message-text">{{$log->Reminder}}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="message-text" class="col-form-label">Add Date to Remind:</label>
                    
                            <input type="date" name = "date" class="form-control" required value="{{$log->date}}" />
                            </div>
                                    

                                </div>

                                <div class="card-body border-top">
                                    <div class="form-group">
                                        <div class="input-group mb-3">
                                            <div class="input-group">
                                                <button type="submit" class="btn btn-block"
                                                    style="background-color: #427ed1; color: white;">Submit</button>
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
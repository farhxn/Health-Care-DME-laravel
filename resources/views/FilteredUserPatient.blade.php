@section('title', 'Users Detail')
@include('layout.Head')

<div class="dashboard-wrapper">
    <div class="dashboard-ecommerce">
        <div class="container-fluid dashboard-content">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="page-header">
                        <h2 class="pageheader-title ml-auto">{{ $user->name }}'s Detail</h2>
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
                    <div class="offset col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="row">

                            <div class="col pl-lg-0 pl-md-0 border-left m-b-30">
                                <div class="product-details">
                                    <div class="border-bottom pb-3 mb-3">
                                        <h2 class="mb-3">User Details </h2>
                                    </div>
                                    <div class="row">
                                        <div class="col">


                                            <div class="row">
                                                <div class="col d-flex align-items-center">
                                                    <h4 class="mb-0">NAME</h4>
                                                    <p class="mb-0 ml-2">: {{ $user->name }}</p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col d-flex align-items-center">
                                                    <h4 class="mb-0">E-Mail</h4>
                                                    <p class="mb-0 ml-2">: {{ $user->email }}</p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col d-flex align-items-center">
                                                    <h4 class="mb-0">Role</h4>
                                                    <p class="mb-0 ml-2">:
                                                        @if ($user->role == '2')
                                                            Admin
                                                        @elseif($user->role == '1')
                                                            Manager
                                                        @else
                                                            User
                                                        @endif
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col d-flex align-items-center">
                                                    <h4 class="mb-0">Status</h4>
                                                    <p class="mb-0 ml-2">: @if ($user->status == '1')
                                                            <span class="badge-dot badge-danger mr-1"></span>Close
                                                        @else
                                                            <span class="badge-dot badge-success mr-1"></span>Open
                                                        @endif
                                                    </p>
                                                </div>
                                            </div>

                                        </div>
                                        
                                    
                                    
                                    
                                    <div class="product-size border-bottom">
                                    </div>
                                </div>
                            </div>

<div class="container">
    <div class="row">
        <!-- Status List Column -->
        <div class="col-8">
            <div class="row">
@php
$colors = ['#427ed1', '#32a852', '#a83232', '#a88232', '#3284a8']; // Add more colors as needed
$colorIndex = 0;
$total = 0; // Initialize total counter
@endphp

@foreach ($st as $sts)
    @php
    $counter = 0; // Initialize counter for each status
    @endphp
    @foreach ($ds as $pt)
        @if($pt->Order_Status == $sts->id)
            @php 
            $counter++;
            $total++; 
            @endphp
        @endif
    @endforeach
    
    <!-- Display the status and the count with dynamic background color -->
    <div class="col p-2">
        <a class="btn btn-block btn-sm p-2" style="background-color: {{ $colors[$colorIndex % count($colors)] }}; color: white;">
            {{$sts?->Status}} <span>( {{$counter}} )</span>
        </a>
    </div>
    
    @php
    $colorIndex++; // Move to the next color for the next iteration
    @endphp
@endforeach

            </div>
        </div>
        
        <!-- Total Column -->
              <div class="col d-flex align-items-center justify-content-center">
            <div class="w-100">
                <a class="btn btn-block btn-sm p-2 bg-success" style=" color: white;">
                                Total Assigned Patients <span>( {{$total+$hc}} )</span>
                </a>
            </div>
        </div>

    </div>
</div>



                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 m-b-60">
                                <div class="simple-card">
                                    <ul class="nav nav-tabs" id="myTab5" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active border-left-0" id="product-tab-1"
                                                data-toggle="tab"  role="tab"
                                                aria-controls="product-tab-1" aria-selected="true">All Orders</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content" id="myTabContent5">
                                        <div class="tab-pane fade show active" id="tab-1" role="tabpanel"
                                            aria-labelledby="product-tab-1">
                             
                        <div class="table-responsive">
                                <table class="table display" id="myTable">
                                    <thead class="bg-light">
                                        <tr class="border-0">
                                            <th class="border-0">No.</th>
                                            <th class="border-0">PT&nbsp;Name</th>
                                            <th class="border-0">Item</th>
                                            <th class="border-0">DOB</th>
                                            <th class="border-0">Account</th>
                                            <th class="border-0">Department</th>
                                            <th class="border-0">User</th>
                                            <th class="border-0">Status</th>
                                            <th class="border-0">Order&nbsp;Date</th>
                                        </tr>
                                                                     <tr>
                                        <th></th>
                                        <td>
                                            <div class="search-box">
                                                <input type="text" class="column-search search-input" data-column="1" placeholder="First name" id="searchInput" onclick="event.stopPropagation();" oninput="toggleClearIcon(this)">
                                                <i class="fas fa-search search-icon"></i>
                                                <i class="fas fa-times clear-icon" onclick="clearInput()"></i>
                                            </div>
                                        </td> 
                                        
                                                                                <td>
                                            <div class="search-box">
                                                <input type="text" class="column-search search-input" data-column="2" placeholder="Last name" id="searchInput" onclick="event.stopPropagation();" oninput="toggleClearIcon(this)">
                                                <i class="fas fa-search search-icon"></i>
                                                <i class="fas fa-times clear-icon" onclick="clearInput()"></i>
                                            </div>
                                        </td> 
    
                                            <td>
                                            <div class="search-box">
                                                <input type="text" class="column-search search-input" data-column="3" placeholder="Item" id="searchInput" onclick="event.stopPropagation();" oninput="toggleClearIcon(this)">
                                                <i class="fas fa-search search-icon"></i>
                                                <i class="fas fa-times clear-icon" onclick="clearInput()"></i>
                                            </div>
                                        </td> 
    
                                            <td>
                                            <div class="search-box">
                                                <input type="text" class="column-search search-input" data-column="4" placeholder="DOB" id="searchInput" onclick="event.stopPropagation();" oninput="toggleClearIcon(this)">
                                                <i class="fas fa-search search-icon"></i>
                                                <i class="fas fa-times clear-icon" onclick="clearInput()"></i>
                                            </div>
                                        </td> 
                                        
                                        <td>
                                            <div class="search-box">
                                                <input type="text" class="column-search search-input" data-column="5" placeholder="Account" id="searchInput" onclick="event.stopPropagation();" oninput="toggleClearIcon(this)">
                                                <i class="fas fa-search search-icon"></i>
                                                <i class="fas fa-times clear-icon" onclick="clearInput()"></i>
                                            </div>
                                        </td> 
                                        
                                        <td>
                                            <div class="search-box">
                                                <input type="text" class="column-search search-input" data-column="6" placeholder="Listed By" id="searchInput" onclick="event.stopPropagation();" oninput="toggleClearIcon(this)">
                                                <i class="fas fa-search search-icon"></i>
                                                <i class="fas fa-times clear-icon" onclick="clearInput()"></i>
                                            </div>
                                        </td> 
                                        
                                        <td>
                                            <div class="search-box">
                                                <input type="text" class="column-search search-input" data-column="7" placeholder="Department" id="searchInput" onclick="event.stopPropagation();" oninput="toggleClearIcon(this)">
                                                <i class="fas fa-search search-icon"></i>
                                                <i class="fas fa-times clear-icon" onclick="clearInput()"></i>
                                            </div>
                                        </td> 
    
                                        <td>
                                            <div class="search-box">
                                                <input type="text" class="column-search search-input" data-column="8" placeholder="User" id="searchInput" onclick="event.stopPropagation();" oninput="toggleClearIcon(this)">
                                                <i class="fas fa-search search-icon"></i>
                                                <i class="fas fa-times clear-icon" onclick="clearInput()"></i>
                                            </div>
                                        </td> 

                                     </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sno = 1;
                                        ?>
                                        @foreach ($pat as $pt)
                                        @php
                                        $userName = \App\Models\Users::find($pt->User);
                                        $deptName = \App\Models\Departments::find($pt->Dept);
                                        $statusName = \App\Models\Status::find($pt?->Order_Status);
                                        @endphp

                                        <tr onclick="window.location='/PatientDetail/{{ $pt->id }}';" style="cursor: pointer;" data-toggle="tooltip" data-placement="top" title="" data-original-title="Show {{ $pt->name }}'s Details">
                                            <td>{{ $sno++ }}</td>
                                            <td>{{ $pt->name }}</td>
                                            <td>
                                            @php
                                                $listedText = $pt->Item;
                                                $wordArray = explode(' ', $listedText);
                                        
                                                if(count($wordArray) > 8) {
                                                    // If there are more than ten words, slice the array to get the first ten
                                                    $trimmedText = implode(' ', array_slice($wordArray, 0, 10)) . '...';
                                                } elseif(strlen($listedText) > 10 && !str_contains($listedText, ' ')) {
                                                    $trimmedText = substr($listedText, 0, 5) . '...';
                                                } else {
                                                    // If none of the above conditions are met, display the text as is
                                                    $trimmedText = $listedText;
                                                }
                                            @endphp
                                        
                                            {{ $trimmedText }}
                                        </td>
                                            <td>{{ $pt->Dob }}</td>
                                            <td>{{ $pt->AccNumber }}</td>
                                            <td>{{ $deptName?->Department }}</td>
                                            <td>{{ $userName?->name }}</td>

                                            <td>{{ $statusName?->Status }}
                                            </td>

                                            <td>{{ $pt->created_at->format('m/d/Y H:i:s') }}</td>

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

            </div>
        </div>
    </div>

    @include('layout.footer')
    <script>
        $(document).ready(function() {
            logAction("User Detail  Page Loaded");
        });
    </script>

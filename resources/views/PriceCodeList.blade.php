@section('title', 'Price Code List Page')
@include('layout.Head')

<div class="dashboard-wrapper">
    <div class="dashboard-ecommerce">
        <div class="container-fluid dashboard-content">
            <div class="row">
                <div class="col-12">
                    <div class="d-flex justify-content-between align-items-center m-3">
                        <h2 class="pageheader-title">Price Code </h2>
                        <a href="{{url('AddPriceCode',0)}}" class="btn btn-primary ">Add New Price Code</a>
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
                                        <button id="bulkEditBtn" class="btn btn-primary btn-block ">Bulk Edits</button>
                                    </div>
                                    <div class="col">
                                        <button type="button" class="btn btn-primary btn-block " data-toggle="modal" data-target="#importModal">Import File </button>
                                    </div>
                                </div>
                            </div>
                            <br>



                            <!-- Spinner -->
                            <div id="spinner" style="
    display: none;
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    z-index: 1000;
    background-color: rgba(255, 255, 255, 0.8);
    padding: 20px;
    border-radius: 50%;
    box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);">
                                <i class="fas fa-spinner fa-spin" style="font-size: 40px; color: #6a11cb;"></i>
                            </div>

                            <div id="toast" style="display: none; position: absolute;top: 20px; right: 20px; background-color: #4caf50;
                                                    color: white;
                                                    padding: 15px 20px;
                                                    border-radius: 8px;
                                                    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
                                                    font-size: 14px;
                                                    font-family: 'Arial', sans-serif;
                                                    z-index: 1000;">
                                <i class="fas fa-check-circle"></i>Updated successfully!
                            </div>

                            <div class="card-body p-0">

                                <div class="table-responsive">
                                    <table class="table display" id="myTable">
                                        <thead class="bg-light text-center">
                                            <tr class="border-0 text-center">
                                                <th class="border-0 text-center">No.</th>
                                                <th class="border-0 text-center">ID</th>
                                                <th class="border-0 text-center">Inventory Item</th>
                                                <th class="border-0 text-center">Insurance Name</th>
                                                <th class="border-0 text-center">Sale Price</th>
                                                <th class="border-0 text-center">Sale Billable Price</th>
                                                <th class="border-0 text-center">Rental Price</th>
                                                <th class="border-0 text-center">Rental Billable Price</th>
                                                <th class="border-0 text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $sno = 1;
                                            $inventoryItemID = $priceCode->pluck('Item')->filter()->unique();
                                            $inventoryItem = \App\Models\Inventory::whereIn('id', $inventoryItemID)->pluck('Item_Name', 'id');
                                            ?>
                                            @foreach ($priceCode as $user)
                                            @php
                                            $inventoryItemName = $inventoryItem->get($user?->Item);
                                            @endphp
                                            <tr>
                                                <td class="text-center">{{ $sno++ }}</td>
                                                <td class="text-center">{{ $user->id }}</td>
                                                <td class="text-center editable-cell" data-name="Item" data-id="{{ $user->id }}">
                                                    {{ $inventoryItemName }}
                                                </td>
                                                <td class="text-center editable-cell" data-name="Insurance" data-id="{{ $user->id }}">
                                                    {{ $user->Insurance }}
                                                </td>
                                                <td class="text-center editable-cell" data-name="AllowablePrice" data-id="{{ $user->id }}">
                                                    {{ $user->AllowablePrice }}
                                                </td>
                                                <td class="text-center editable-cell" data-name="Billable_Price" data-id="{{ $user->id }}">
                                                    {{ $user->Billable_Price }}
                                                </td>
                                                <td class="text-center editable-cell" data-name="RentalAllowablePrice" data-id="{{ $user->id }}">
                                                    {{ $user->RentalAllowablePrice }}
                                                </td>
                                                <td class="text-center editable-cell" data-name="Rental_Billable_Price" data-id="{{ $user->id }}">
                                                    {{ $user->Rental_Billable_Price }}
                                                </td>
                                                <td class="text-center">
                                                    <a href="{{ url('AddPriceCode', $user->id) }}" class="btn btn-sm btn-warning" data-toggle="tooltip" data-placement="top" title="Edit {{ $user->Item }}">
                                                        <i class="fa fa-pen-to-square"></i>
                                                    </a>
                                                    <button data-url="{{ url('DeletePriceCode', $user->id) }}" class="btn btn-sm btn-danger delete-btn" data-toggle="tooltip" data-placement="top" title="Delete {{ $user->Item }}'s Status">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
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
            logAction("Price Code List Page Loaded");
        });


        let isEditingEnabled = false; // Default state is "not editing"

        document.getElementById('bulkEditBtn').addEventListener('click', function() {
            const editableCells = document.querySelectorAll('.editable-cell');

            if (isEditingEnabled) {
                editableCells.forEach(cell => {
                    cell.setAttribute('contenteditable', 'false');
                    cell.classList.remove('editable');
                    cell.style.backgroundColor = "";
                    cell.style.border = "";

                });
                showToast('Editing disabled.', false);
                isEditingEnabled = false;

                setTimeout(() => {
                    location.reload();
                }, 2000);
            } else {
                // Enable editing
                editableCells.forEach(cell => {
                    cell.setAttribute('contenteditable', 'true');
                    cell.classList.add('editable');
                    cell.style.backgroundColor = "#fdf4ff"; // Soft lavender
                    cell.style.border = "2px solid #a29bfe"; // Light purple
                    cell.style.transition = "all 0.3s ease";
                });
                showToast('Editing enabled.', false);
                isEditingEnabled = true;
            }

            // Save edits on blur
            editableCells.forEach(cell => {
                cell.addEventListener('blur', function() {
                    if (!isEditingEnabled) return; // Skip if editing is disabled

                    const id = cell.getAttribute('data-id');
                    const name = cell.getAttribute('data-name');
                    const value = cell.textContent;

                    // Show spinner
                    showSpinner();

                    fetch(`/updatePriceCode/${id}`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                            },
                            body: JSON.stringify({
                                [name]: value
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            hideSpinner();
                            if (data.success) {
                                // Success Feedback
                                cell.classList.remove('edited-error');
                                cell.classList.add('edited-success');
                                showToast('Value updated successfully!', false);
                                setTimeout(() => cell.classList.remove('edited-success'), 1500);
                            } else {
                                // Error Feedback
                                cell.classList.remove('edited-success');
                                cell.classList.add('edited-error');
                                showToast('Failed to update value!', true);
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            hideSpinner();
                            cell.classList.remove('edited-success');
                            cell.classList.add('edited-error');
                            showToast('An error occurred while updating!', true);
                        });
                });
            });
        });


        // Spinner functions
        function showSpinner() {
            const spinner = document.getElementById('spinner');
            spinner.style.display = 'block';
        }

        function hideSpinner() {
            const spinner = document.getElementById('spinner');
            spinner.style.display = 'none';
        }

        // Toast Notification
        function showToast(message, isError = false) {
            const toast = document.getElementById('toast');
            toast.textContent = message;
            toast.style.backgroundColor = isError ? '#f44336' : '#4caf50'; // Red for error, green for success
            toast.style.display = 'block';
            setTimeout(() => toast.style.display = 'none', 3000);
        }
    </script>


    <div class="modal fade" id="importModal" tabindex="-1" role="dialog" aria-labelledby="importModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document"> <!-- Added modal-lg for larger modal -->
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="importModalLabel">Import Price Codes</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ url('import-users') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="file">Upload Excel File</label>
                            <input type="file" name="file" class="form-control" required accept=".xlsx, .xls">
                        </div>

                        <div class="form-group">
                            <label>Expected Data Structure:</label>
                            <div style="overflow-x: auto;">
                                <table class="table table-bordered table-sm">
                                    <thead>
                                        <tr>
                                            <th>Warehouse_Name</th>
                                            <th>Item</th>
                                            <th>Insurance</th>
                                            <th>OrderType</th>
                                            <th>PredefinedText</th>
                                            <th>Billable_Price</th>
                                            <th>AllowablePrice</th>
                                            <th>Rental_Billable_Price</th>
                                            <th>RentalAllowablePrice</th>
                                            <th>RentalType</th>
                                            <th>Bill_Billable_Code</th>
                                            <th>DMNRX</th>
                                            <th>modifier1</th>
                                            <th>modifier2</th>
                                            <th>modifier3</th>
                                            <th>modifier4</th>
                                            <th>PriorAuth</th>
                                            <th>Quantity</th>
                                            <th>Units</th>
                                            <th>When</th>
                                            <th>Converter</th>
                                            <th>BQuantity</th>
                                            <th>BUnits</th>
                                            <th>BWhen</th>
                                            <th>BConverter</th>
                                            <th>DQuantity</th>
                                            <th>DUnits</th>
                                            <th>DWhen</th>
                                            <th>DConverter</th>
                                            <th>ReoccuringSale</th>
                                            <th>AcceptAssignment</th>
                                            <th>SpanDates</th>
                                            <th>Taxable</th>
                                            <th>DayDelivery</th>
                                            <th>LastPeriod</th>
                                            <th>BillPickUp</th>
                                            <th>LastMonth</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Warehouse1</td>
                                            <td>1007</td>
                                            <td>INS123</td>
                                            <td>New</td>
                                            <td>Text</td>
                                            <td>100.00</td>
                                            <td>90.00</td>
                                            <td>80.00</td>
                                            <td>75.00</td>
                                            <td>Rental</td>
                                            <td>Code1</td>
                                            <td>DMN456</td>
                                            <td>Mod1</td>
                                            <td>Mod2</td>
                                            <td>Mod3</td>
                                            <td>Mod4</td>
                                            <td>Auth123</td>
                                            <td>10</td>
                                            <td>Units</td>
                                            <td>2023-11-09</td>
                                            <td>1.5</td>
                                            <td>5</td>
                                            <td>Box</td>
                                            <td>2023-12-01</td>
                                            <td>2.0</td>
                                            <td>3</td>
                                            <td>Pcs</td>
                                            <td>2023-12-15</td>
                                            <td>2.5</td>
                                            <td>Yes</td>
                                            <td>No</td>
                                            <td>2023-12-25</td>
                                            <td>Yes</td>
                                            <td>2023-11-10</td>
                                            <td>2023-11-01</td>
                                            <td>Yes</td>
                                            <td>2023-10-01</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-primary">Import</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Table Styling */
        #myTable {
            border-collapse: collapse;
            width: 100%;
            font-family: 'Arial', sans-serif;
        }

        #myTable th,
        #myTable td {
            text-align: center;
            padding: 12px;
            vertical-align: middle;
        }


        #myTable tbody tr {
            transition: all 0.3s;
            background-color: #f7f8fc;
        }

        #myTable tbody tr:hover {
            background-color: #e9f7ff;
            cursor: pointer;
        }

        .editable-cell {
            transition: background-color 0.3s, border 0.3s;
            position: relative;
        }

        .editable-cell:focus {
            outline: none;
            background-color: #fff5d7;
            border: 2px dashed #ffb74d;
        }

        /* Editable Feedback */
        .editable-cell.edited-success {
            background-color: #d4f7dc !important;
            border: 2px solid #4caf50 !important;
        }

        .editable-cell.edited-error {
            background-color: #ffe6e6 !important;
            border: 2px solid #ff4d4d !important;
        }

        /* Button Styling */
        .btn {
            border-radius: 5px;
            padding: 8px 12px;
            font-size: 14px;
        }

        .btn-warning {
            background-color: #ffa726;
            color: white;
            border: none;
            transition: background-color 0.3s;
        }

        .btn-warning:hover {
            background-color: #ff7043;
        }

        .btn-danger {
            background-color: #f44336;
            color: white;
            border: none;
            transition: background-color 0.3s;
        }

        .btn-danger:hover {
            background-color: #d32f2f;
        }

        /* Tooltip */
        [data-toggle="tooltip"] {
            position: relative;
        }

        [data-toggle="tooltip"]:hover::after {
            content: attr(data-original-title);
            position: absolute;
            top: -30px;
            left: 50%;
            transform: translateX(-50%);
            padding: 6px 12px;
            background-color: black;
            color: white;
            border-radius: 4px;
            font-size: 12px;
            white-space: nowrap;
            z-index: 1000;
        }
    </style>

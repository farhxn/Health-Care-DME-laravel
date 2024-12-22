<?php
$title =  isset($PO) ? 'Update Purchase Order' : 'Add Purchase Order';
?>
@section('title', $title)
@include('layout.Head')

<div class="dashboard-wrapper">
    <div class="dashboard-ecommerce">
        <div class="container-fluid dashboard-content">
            <div class="row">
                <div class="col-12">
                    <div class="d-flex justify-content-between align-items-center">
                        <!-- Heading aligned to the left -->
                        <h2 class="pageheader-title">{{ isset($PO) ? 'Update Purchase Order' : 'Add Purchase Order'}}</h2>

                    </div>
                </div>
            </div> <br>

            <div class="ecommerce-widget">
                <div class="row">
                    <div class="col">
                        <form method="post" action="{{ url('purchaseOrderAddEdit',isset($PO) ? $PO->id : 0) }}">
                            @csrf
                            <div class="card">
                                <br>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="d-flex justify-content-between align-items-center m-3">
                                            <h2 class="pageheader-title">{{ isset($PO) ? 'Update' : 'Create new'}} P.O.</h2>
                                            <a href="#" class="btn btn-primary disabled">P.O. # {{ isset($price) ? $price->id : $Pid }}</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    @if ($errors->any())
                                    <div class="row">
                                        <div class="col">
                                            <div class="alert alert-danger">
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    <input type="hidden" value="{{ $code }}" name="Items" />
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label class="col-form-label">Order Date:</label>
                                                <div class="input-group mb-3">
                                                    <input type="date" required placeholder="date" name="date" class="form-control form-control-sm"
                                                        value="{{ isset($PO) ? $PO->date : old('date', date('Y-m-d')) }}">

                                                </div>
                                                <span><small class="text-danger font-weight-light font-italic">
                                                        @error('date')
                                                        {{ $message }}
                                                        @enderror
                                                    </small></span>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-form-label">Cost</label>
                                                <div class="input-group mb-3">
                                                    <input type="number" required placeholder="Cost" name="Cost"
                                                        class="form-control form-control-sm" value="{{ isset($PO) ? $PO->Cost : old('Cost') }}">
                                                </div>
                                                <span><small class="text-danger font-weight-light font-italic">
                                                        @error('Cost')
                                                        {{ $message }}
                                                        @enderror
                                                    </small></span>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-form-label">Freight</label>
                                                <div class="input-group mb-3">
                                                    <input type="number" required placeholder="Freight" name="Freight"
                                                        class="form-control form-control-sm" value="{{ isset($PO) ? $PO->Freight : old('Freight') }}">
                                                </div>
                                                <span><small class="text-danger font-weight-light font-italic">
                                                        @error('Freight')
                                                        {{ $message }}
                                                        @enderror
                                                    </small></span>
                                            </div>


                                            <!-- Vendor Dropdown -->
                                            <div class="form-group">
                                                <label class="col-form-label">Vendor</label>
                                                <div class="input-group mb-3">
                                                    <select class="form-control form-control-sm" required name="Vendor" id="vendorSelect">
                                                        <option disabled selected>Vendor</option>
                                                        @foreach ($vendor as $vend)
                                                        <option value="{{ $vend->id }}" data-account="{{ $vend->Account }}">{{ $vend->Vendor_Name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <span><small class="text-danger font-weight-light font-italic">
                                                        @error('Vendor')
                                                        {{ $message }}
                                                        @enderror
                                                    </small></span>
                                            </div>

                                            <!-- Vendor Account Field -->
                                            <div class="form-group">
                                                <label class="col-form-label">Vendor Account #</label>
                                                <div class="input-group mb-3">
                                                    <input type="number" readonly required placeholder="Vendor Account #" name="Vendor_Account"
                                                        id="vendorAccount" class="form-control form-control-sm"
                                                        value="{{ isset($PO) ? $PO->Vendor_Account : old('Vendor_Account') }}">
                                                </div>
                                                <span><small class="text-danger font-weight-light font-italic">
                                                        @error('Vendor_Account')
                                                        {{ $message }}
                                                        @enderror
                                                    </small></span>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-form-label">Confirm #</label>
                                                <div class="input-group mb-3"><span class="input-group-prepend"><span
                                                            class="input-group-text"><i class="fa-solid fa-square-poll-vertical"></i></span></span>
                                                    <input type="text" required placeholder="Confirm #" name="Confirm"
                                                        class="form-control form-control-sm" value="{{ isset($PO) ? $PO->Confirm : old('Confirm') }}">
                                                </div>
                                                <span><small class="text-danger font-weight-light font-italic">
                                                        @error('Confirm')
                                                        {{ $message }}
                                                        @enderror
                                                    </small></span>
                                            </div>

                                            <div class="col">

                                                <div class="form-group form-check">
                                                    <input type="checkbox" class="form-check-input" id="dropShipCheckbox" name="dropShip" {{ old('dropShip', isset($PO) ? $PO->dropShip : '') ? 'checked' : '' }}>
                                                    <span class="form-check-label">Drop Ship To Customer </span>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="col-6">
                                            <div class="row">
                                                <div class="col">
                                                    <label class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input" checked value="Approved" name="status">
                                                        <span class="custom-control-label">Approved</span>
                                                    </label>
                                                </div>

                                                <div class="col">
                                                    <label class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input" name="status" value="Rejected">
                                                        <span class="custom-control-label">Rejected</span>
                                                    </label>
                                                </div>

                                                <div class="col">
                                                    <label class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input" name="status" value="Reoccuring">
                                                        <span class="custom-control-label">Reoccuring</span>
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-form-label">Tax</label>
                                                <div class="input-group mb-3">
                                                    <input type="number" required placeholder="Tax" name="Tax"
                                                        class="form-control form-control-sm" value="{{ isset($PO) ? $PO->Tax : old('Tax') }}">
                                                </div>
                                                <span><small class="text-danger font-weight-light font-italic">
                                                        @error('Tax')
                                                        {{ $message }}
                                                        @enderror
                                                    </small></span>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-form-label">Total Due</label>
                                                <div class="input-group mb-3">
                                                    <input type="number" required placeholder="Total Due" name="Total_Due"
                                                        class="form-control form-control-sm" value="{{ isset($PO) ? $PO->Total_Due : old('Total_Due') }}">
                                                </div>
                                                <span><small class="text-danger font-weight-light font-italic">
                                                        @error('Total_Due')
                                                        {{ $message }}
                                                        @enderror
                                                    </small></span>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-form-label">Billing Address</label>
                                                <div class="input-group mb-3">
                                                    <select class="form-control form-control-sm" required name="Billing_Address">
                                                        <option {{ old('Billing_Address', isset($PO) ? $PO->Billing_Address : '') == '' ? 'selected' : '' }} disabled>Billing Address</option>
                                                        @foreach ($Location as $loc)
                                                        <option value="{{$loc->address}}" {{ old('Billing_Address', isset($PO) ? $PO->Billing_Address : '') == $loc->address ? 'selected' : '' }}>{{ $loc->address }}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <span><small class="text-danger font-weight-light font-italic">
                                                        @error('Billing_Address')
                                                        {{ $message }}
                                                        @enderror
                                                    </small></span>
                                            </div>


                                            <div class="form-group">
                                                <label class="col-form-label">Shipping Address</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" required placeholder="Shipping Address" name="Shipping_Address" id="shipping-address"
                                                        class="form-control form-control-sm" value="{{ isset($PO) ? $PO->Shipping_Address : old('Shipping_Address') }}">
                                                </div>
                                                <span><small class="text-danger font-weight-light font-italic">
                                                        @error('Shipping_Address')
                                                        {{ $message }}
                                                        @enderror
                                                    </small></span>
                                            </div>


                                            <div class="form-group">
                                                <label class="col-form-label">Order for Patient (Optional)</label>
                                                <div class="input-group mb-3">
                                                    <select class="form-control form-control-sm select2" name="Order_Patient" id="orderPatientDropdown">
                                                        <option disabled selected>Select Patient</option>
                                                        @foreach ($patients as $drs)
                                                        <option value="{{ $drs->name.' '.$drs->last_Name }}"
                                                            data-location="{{ $drs->Location }}">
                                                            {{ $drs->name.' '.$drs->last_Name.' ('.$drs->Dob.')' }}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <span><small class="text-danger font-weight-light font-italic">
                                                        @error('Order_Patient')
                                                        {{ $message }}
                                                        @enderror
                                                    </small></span>
                                            </div>

                                        </div>

                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="d-flex justify-content-between align-items-center ">
                                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#AddItem">Add Item</button>

                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="table-responsive">
                                        <table class="table display" id="items">
                                            <thead class="bg-light text-center">
                                                <tr class="border-0 text-center">
                                                    <th class="border-0 text-center">No.</th>
                                                    <th class="border-0 text-center">Backorder</th>
                                                    <th class="border-0 text-center">Customer</th>
                                                    <th class="border-0 text-center">Ordered Item</th>
                                                    <th class="border-0 text-center">Date of Received</th>
                                                    <th class="border-0 text-center">Ordered Qty</th>
                                                    <th class="border-0 text-center">Received Qty</th>
                                                    <th class="border-0 text-center">Price</th>
                                                    <th class="border-0 text-center">Order Status</th>
                                                    <th class="border-0 text-center">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if($POI != [] || $POI != null)
                                                <?php
                                                $sno = 1;
                                                ?>
                                                @foreach ($POI as $items)
                                                <tr class="border-0 text-center">
                                                    <td class="border-0 text-center">{{ $sno++ }}</td>
                                                    <td class="border-0 text-center">{{ $items->backOrder}}</td>
                                                    <td class="border-0 text-center">{{ $items->customer }}</td>
                                                    <td class="border-0 text-center">{{ $items->item }}</td>
                                                    <td class="border-0 text-center">{{ $items->dateReceived }}</td>
                                                    <td class="border-0 text-center">{{ $items->orderedQty }}</td>
                                                    <td class="border-0 text-center">{{ $items->receivedQty }}</td>
                                                    <td class="border-0 text-center">{{ $items->price }}</td>
                                                    <td class="border-0 text-center">{{ $items->status }}</td>
                                                    <td class="border-0 text-center">
                                                        <button data-url="/delete-item/{{$items->id}}"
                                                            id="delete-item-{{ $items->id }}"
                                                            class="btn btn-danger "
                                                            style="padding: 0.25rem 0.5rem; font-size: 0.875rem; line-height: 1.5; border-radius: 0.2rem;"
                                                            data-toggle="tooltip" data-placement="top" title=""
                                                            data-original-title="Delete {{$items->item}}">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                                @endforeach
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>


                                </div>
                                <!-- Loader -->
                                <div id="modalDeleteLoader" class="modal-loader-overlay" style="display:none;">
                                    <span class="dashboard-spinner spinner-primary spinner-sm"></span>
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
    </div>




    @include('layout.footer')
    <div class="modal fade" id="AddItem" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered ">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Item</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger alert-dismissible fade show" role="alert" id="form-error-alert" style="display: none;">
                        Please fill out all required fields before submitting.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <form id="add-item-form">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Customer</label>
                            <div class="col-sm-8 w-full">
                                <select id="customer-select" class="form-control form-control-sm" name="Customer" required></select>
                            </div>
                        </div>
                        <input type="hidden" value="{{ $code }}" name="UniqueId" id="unique-id" />

                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Item:</label>
                            <div class="col-sm-8">
                                <div class="input-group mb-3">
                                    <select class="form-control form-control-sm" required name="Item" id="item-select">
                                        <option disabled selected>Items</option>
                                        @foreach ($inventory as $drs)
                                        <option value="{{$drs->Item_Name}}">{{ $drs->Item_Name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="price" class="col-sm-4 col-form-label">Price:</label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control form-control-sm" id="price" name="price" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="Ordered_Qty" class="col-sm-4 col-form-label">Ordered Qty:</label>
                            <div class="col-sm-8">
                                <input type="number" value="1" class="form-control form-control-sm" id="Ordered_Qty" required name="Ordered_Qty">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="Received_Qty" class="col-sm-4 col-form-label">Received Qty:</label>
                            <div class="col-sm-8">
                                <input type="number" required value="1" class="form-control form-control-sm" id="Received_Qty" name="Received_Qty">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="Back_Order" class="col-sm-4 col-form-label">Back Order:</label>
                            <div class="col-sm-8">
                                <input type="number" required value="0" class="form-control form-control-sm" id="Back_Order" name="Back_Order">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="Date_Received" class="col-sm-4 col-form-label">Date of Received:</label>
                            <div class="col-sm-8">
                                <input type="date" required class="form-control form-control-sm" id="Date_Received" name="Date_Received">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-sm-4">Warehouse</label>
                            <div class="input-group mb-3 col-sm-8">
                                <select class="form-control form-control-sm" required name="Warehouse" id="warehouse-select">
                                    <option value="" disabled selected>Select Warehouse</option>
                                    @foreach ($Warehouse as $drs)
                                    <option value="{{ $drs->Warehouse_Name }}" data-address="{{ $drs->Address }}">
                                        {{ $drs->Warehouse_Name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- Loader -->
                <div id="modalLoader" class="modal-loader-overlay" style="display:none;">
                    <span class="dashboard-spinner spinner-primary spinner-sm"></span>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" id="add-item-btn" class="btn btn-primary">Add Item</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            $('.select2').select2({
                placeholder: "Select Patient",
                allowClear: true,
                width: '100%'
            });

            var warehouseSelect = document.getElementById('warehouse-select');
            var shippingAddressInput = document.getElementById('shipping-address');
            warehouseSelect.addEventListener('change', function() {
                var selectedOption = warehouseSelect.options[warehouseSelect.selectedIndex];
                var selectedAddress = selectedOption.getAttribute('data-address');
                shippingAddressInput.value = selectedAddress;
            });

            var dropShipCheckbox = document.getElementById('dropShipCheckbox');
            var orderPatientDropdown = document.getElementById('orderPatientDropdown');

            function toggleRequired() {
                if (dropShipCheckbox.checked) {
                    orderPatientDropdown.setAttribute('required', 'required');
                    orderPatientDropdown.disabled = false;
                } else {
                    orderPatientDropdown.disabled = true;
                    orderPatientDropdown.removeAttribute('required');
                }
            }
            toggleRequired();
            dropShipCheckbox.addEventListener('change', function() {
                toggleRequired();
            });


            $('#orderPatientDropdown').on('change', function() {
                var selectedOption = this.options[this.selectedIndex];
                var location = selectedOption.getAttribute('data-location');
                console.log('Selected Patient Location:', location);
                $('#shipping-address').val(location || '');
            });

        });




        document.getElementById('vendorSelect').addEventListener('change', function() {
            var selectedVendor = this.options[this.selectedIndex];
            var accountNumber = selectedVendor.getAttribute('data-account');
            document.getElementById('vendorAccount').value = accountNumber;
        });

        $(document).ready(function() {

            $(document).on('click', '[id^=delete-item-]', function(e) {
                e.preventDefault();
                var deleteUrl = $(this).data('url');
                var row = $(this).closest('tr');

                if (confirm('Are you sure you want to delete this item?')) {
                    $('.modal-blur-content').addClass('modal-blur');
                    $('#modalDeleteLoader').show();
                    $.ajax({
                        url: deleteUrl,
                        type: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            if (response.success) {
                                $('.modal-blur-content').removeClass('modal-blur');
                                $('#modalDeleteLoader').hide();
                                row.remove();
                            } else {
                                $('.modal-blur-content').removeClass('modal-blur');
                                $('#modalDeleteLoader').hide();
                                alert('Error: Unable to delete item.');
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error('Error:', error);
                            $('.modal-blur-content').removeClass('modal-blur');
                            $('#modalDeleteLoader').hide();
                            alert('Something went wrong, please try again.');
                        }
                    });
                }
            });

            logAction("Add Purchase Order Page Loaded");

        });



        $(document).ready(function() {

            var rowCount = $('#items tbody tr').length + 1;



            function validateForm() {
                var formValid = true;

                $('#add-item-form').find('input, select').each(function() {
                    if ($(this).prop('required') && ($(this).val() === '' || $(this).val() === null)) {
                        $(this).addClass('is-invalid');
                        formValid = false;
                        console.log('Required field missing:', $(this).attr('name') || $(this).attr('id'));
                    } else {
                        $(this).removeClass('is-invalid');
                    }
                });

                return formValid;
            }

            $('#add-item-form').find('input, select').on('change', function() {
                if ($(this).val() !== '') {
                    $(this).removeClass('is-invalid');
                }
            });

            $('#add-item-btn').click(function() {

                if (validateForm()) {
                    $('.modal-blur-content').addClass('modal-blur');
                    $('#modalLoader').show();
                    $('#form-error-alert').hide();

                    var formData = {
                        customer: $('#customer-select').val(),
                        uniqueId: $('#unique-id').val(),
                        item: $('#item-select').val(),
                        price: $('#price').val(),
                        orderedQty: $('#Ordered_Qty').val(),
                        receivedQty: $('#Received_Qty').val(),
                        backOrder: $('#Back_Order').val(),
                        dateReceived: $('#Date_Received').val(),
                        warehouse: $('#warehouse-select').val(),
                        status: 'temporary' // Set status as temporary
                    };

                    $.ajax({
                        url: '/save-item',
                        type: 'POST',
                        data: JSON.stringify(formData),
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            $('#add-item-form')[0].reset();
                            $('#AddItem').modal('hide');
                            console.log(response.item);
                            var newRow = `
                        <tr class="text-center">
                            <td>${rowCount++}</td>
                            <td>${response.item.backOrder}</td>
                            <td>${response.item.customer}</td>
                            <td>${response.item.item}</td>
                            <td>${response.item.dateReceived}</td>
                            <td>${response.item.orderedQty}</td>
                            <td>${response.item.receivedQty}</td>
                            <td>${response.item.price}</td>
                            <td>${response.item.status}</td>
                            <td>
                                <button data-url="/delete-item/${response.item.id}"
                                        class="btn btn-sm btn-danger"
                                        id="delete-item-${response.item.id}"
                                        data-toggle="tooltip" data-placement="top" title=""
                                        data-original-title="Delete ${response.item.item}">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    `;
                            $('#items tbody').append(newRow);

                            // Hide loader and remove blur effect
                            $('.modal-blur-content').removeClass('modal-blur');
                            $('#modalLoader').hide();
                        },
                        error: function(xhr, status, error) {
                            console.error('Error:', xhr.responseJSON);
                            $('.modal-blur-content').removeClass('modal-blur');
                            $('#modalLoader').hide();
                            alert('There was an error. Please check the console.');
                        }
                    });
                } else {
                    // Validation failed, show error alert
                    $('.modal-blur-content').removeClass('modal-blur');
                    $('#modalLoader').hide();
                    $('#form-error-alert').show();
                }
            });
        });







        $('#AddItem').on('shown.bs.modal', function() {
            $('#customer-select').select2({
                dropdownParent: $('#AddItem'), // Ensure dropdown renders within the modal
                tags: true,
                placeholder: 'Select or type customer',
                ajax: {
                    url: '/get-customers',
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            q: params.term // Search term
                        };
                    },
                    processResults: function(data) {
                        return {
                            results: data.items
                        };
                    },
                    cache: true
                }
            });
        });
    </script>

    <style>
        .modal-blur {
            filter: blur(5px);
            pointer-events: none;
        }

        .modal-loader-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.7);

            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 1050;
        }
    </style>

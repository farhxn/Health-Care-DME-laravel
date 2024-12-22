@php
$username = Session::get('LoginName');
@endphp
@section('title', 'Retail Sale')
@include('layout.Head')


<div class="dashboard-wrapper">
    <div class="dashboard-ecommerce">
        <div class="container-fluid dashboard-content">
            <div class="row">

                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="page-header">
                        <h2 class="pageheader-title ml-auto">Retail Sale</h2>
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
                        <form method="post" action="{{ url('AddRetailSale') }}">
                            @csrf
                            <div class="card">
                                <h5 class="card-header">Retail Sale</h5>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-4">
                                            <div class="card">
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
                                                <div class="card-body">
                                                    <h5 class="card-title txt-center"></h5>
                                                    <div class="form-group">
                                                        <label class="col-form-label">Date</label>
                                                        <div class="input-group mb-3">
                                                            <input type="date" required placeholder="Date" name="Date" class="form-control form-control-sm" value="{{ old('Date', now()->format('Y-m-d')) }}">
                                                        </div>
                                                        <span><small class="text-danger font-weight-light font-italic">
                                                                @error('Date')
                                                                {{ $message }}
                                                                @enderror
                                                            </small></span>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-form-label">Sold By</label>
                                                        <div class="input-group mb-3">
                                                            <input type="text" required placeholder="Sold By" name="SoldBy" readonly class="form-control form-control-sm" value="{{ old('SoldBy',$username ) }}">
                                                        </div>
                                                        <span><small class="text-danger font-weight-light font-italic">
                                                                @error('SoldBy')
                                                                {{ $message }}
                                                                @enderror
                                                            </small></span>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-form-label">Discount %</label>
                                                        <div class="input-group mb-3">
                                                            <input type="text" required placeholder="Discount" name="DiscountPer" class="form-control form-control-sm" value="{{ old('DiscountPer') }}">
                                                        </div>
                                                        <span><small class="text-danger font-weight-light font-italic">
                                                                @error('DiscountPer')
                                                                {{ $message }}
                                                                @enderror
                                                            </small></span>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="card">
                                                <div class="card-body">
                                                    <h5 class="card-title txt-center">Customer</h5>

                                                    <div class="row">
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label class="col-form-label">Customer</label>
                                                                <select id="customer-select" class="form-control form-control-sm" name="Customer" required></select>
                                                                <span><small class="text-danger font-weight-light font-italic">
                                                                        @error('Customer')
                                                                        {{ $message }}
                                                                        @enderror
                                                                    </small></span>
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label class="col-form-label">Address</label>
                                                                <div class="input-group mb-3">
                                                                    <input type="text" required placeholder="Address" id="address" name="Address" class="form-control form-control-sm" value="{{ old('Address') }}">
                                                                </div>
                                                                <span><small class="text-danger font-weight-light font-italic">
                                                                        @error('Address')
                                                                        {{ $message }}
                                                                        @enderror
                                                                    </small></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label class="col-form-label">City</label>
                                                                <div class="input-group mb-3">
                                                                    <input type="text" required placeholder="City" id="city" name="City" class="form-control form-control-sm" value="{{ old('City') }}">
                                                                </div>
                                                                <span><small class="text-danger font-weight-light font-italic">
                                                                        @error('City')
                                                                        {{ $message }}
                                                                        @enderror
                                                                    </small></span>
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label class="col-form-label">State</label>
                                                                <div class="input-group mb-3">
                                                                    <input type="text" required placeholder="State" id="state" name="State" class="form-control form-control-sm" value="{{ old('State') }}">
                                                                </div>
                                                                <span><small class="text-danger font-weight-light font-italic">
                                                                        @error('State')
                                                                        {{ $message }}
                                                                        @enderror
                                                                    </small></span>
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label class="col-form-label">ZIP</label>
                                                                <div class="input-group mb-3">
                                                                    <input type="text" required placeholder="ZIP" id="zip" name="ZIP" class="form-control form-control-sm" value="{{ old('ZIP') }}">
                                                                </div>
                                                                <span><small class="text-danger font-weight-light font-italic">
                                                                        @error('ZIP')
                                                                        {{ $message }}
                                                                        @enderror
                                                                    </small></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label class="col-form-label">Phone</label>
                                                                <div class="input-group mb-3">
                                                                    <input type="text" required placeholder="Phone" id="phone" name="Phone" class="form-control form-control-sm" value="{{ old('Phone') }}">
                                                                </div>
                                                                <span><small class="text-danger font-weight-light font-italic">
                                                                        @error('Phone')
                                                                        {{ $message }}
                                                                        @enderror
                                                                    </small></span>
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label class="col-form-label">Tax Rate</label>
                                                                <div class="input-group mb-3">
                                                                    <input type="text" required placeholder="Tax" name="TaxRate" class="form-control form-control-sm" value="{{ old('TaxRate') }}">
                                                                </div>
                                                                <span><small class="text-danger font-weight-light font-italic">
                                                                        @error('TaxRate')
                                                                        {{ $message }}
                                                                        @enderror
                                                                    </small></span>
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label class="col-form-label">%</label>
                                                                <div class="input-group mb-3">
                                                                    <input type="text" required placeholder="%" name="per" class="form-control form-control-sm" value="{{ old('per') }}">
                                                                </div>
                                                                <span><small class="text-danger font-weight-light font-italic">
                                                                        @error('per')
                                                                        {{ $message }}
                                                                        @enderror
                                                                    </small></span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label class="col-form-label">Item</label>
                                                <div class="input-group mb-3">
                                                    <select class="form-control form-control-sm" id="item-dropdown" required name="item">
                                                        <option selected disabled>item</option>
                                                        @foreach ($inventory as $drs)
                                                        <option value="{{ $drs->id }}">{{ $drs->Item_Name }}</option>
                                                        @endforeach
                                                        </option>
                                                    </select>
                                                </div>
                                                <span><small class="text-danger font-weight-light font-italic">
                                                        @error('item')
                                                        {{ $message }}
                                                        @enderror
                                                    </small></span>
                                                <input type="hidden" id="ItemsInput" name="Items[]">

                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <button type="button" id="AddItemButton" class="btn btn-primary btn-block mt-4">Add</button>
                                        </div>
                                    </div>

                                    <div class="table-responsive">
                                        <table class="table display">
                                            <thead class="bg-light text-center">
                                                <tr class="border-0 text-center">
                                                    <th class="border-0 text-center">No.</th>
                                                    <th class="border-0 text-center">Inventory&nbsp;Item</th>
                                                    <th class="border-0 text-center">Price&nbsp;Code</th>
                                                    <th class="border-0 text-center">Sale/Rent</th>
                                                    <th class="border-0 text-center">Delivery QTY</th>
                                                    <th class="border-0 text-center">Billable</th>
                                                    <th class="border-0 text-center">Allowable</th>
                                                    <th class="border-0 text-center">Taxable</th>
                                                    <th class="border-0 text-center">Amount</th>
                                                    <th class="border-0 text-center">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody id="ItemList" class="modal-blur-content">

                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- Loader -->
                                    <div id="modalLoader" class="modal-loader-overlay" style="display:none;">
                                        <span class="dashboard-spinner spinner-primary spinner-sm"></span>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label class="col-form-label">Sub-total</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" required placeholder="Sub-total" name="Sub_total" class="form-control form-control-sm" value="{{ old('Sub_total') }}">
                                                </div>
                                                <span><small class="text-danger font-weight-light font-italic">
                                                        @error('Sub_total')
                                                        {{ $message }}
                                                        @enderror
                                                    </small></span>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label class="col-form-label">Discount</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" required placeholder="Discount" name="Discount" class="form-control form-control-sm" value="{{ old('Discount') }}">
                                                </div>
                                                <span><small class="text-danger font-weight-light font-italic">
                                                        @error('Discount')
                                                        {{ $message }}
                                                        @enderror
                                                    </small></span>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label class="col-form-label">Tax Total</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" required placeholder="Tax" name="Tax" class="form-control form-control-sm" value="{{ old('Tax') }}">
                                                </div>
                                                <span><small class="text-danger font-weight-light font-italic">
                                                        @error('Tax')
                                                        {{ $message }}
                                                        @enderror
                                                    </small></span>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label class="col-form-label">Total Due</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" required placeholder="Total" name="Total" class="form-control form-control-sm" value="{{ old('Total') }}">
                                                </div>
                                                <span><small class="text-danger font-weight-light font-italic">
                                                        @error('Total')
                                                        {{ $message }}
                                                        @enderror
                                                    </small></span>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="card">

                                        <div class="card-body border-top">
                                            <div class="form-group">
                                                <div class="input-group mb-3">
                                                    <div class="input-group">
                                                        <button type="submit" class="btn btn-block" style="background-color: #427ed1; color: white;">Submit</button>
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


    <script>
        $(document).ready(function() {
            logAction("Add Department Page Loaded");
        });

        $('#customer-select').select2({
            tags: true,
            placeholder: 'Select or type customer',
            ajax: {
                url: '/get-customers',
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        q: params.term
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


        $('#customer-select').on('select2:select', function(e) {
            var customerId = e.params.data.id;

            $.ajax({
                url: '/get-customer-details/' + customerId,
                type: 'GET',
                success: function(response) {
                    if (response) {
                        $('#phone').val(response.phone);
                        $('#address').val(response.address);

                        var fullAddress = response.address;
                        var addressParts = fullAddress.split(',');

                        if (addressParts.length === 2) {
                            var cityStateZip = addressParts[1].trim();
                            var cityStateZipParts = cityStateZip.split(' ');

                            var city = addressParts[0].trim();
                            var state = cityStateZipParts[0];
                            var zip = cityStateZipParts[1];

                            $('#city').val(city);
                            $('#state').val(state);
                            $('#zip').val(zip);
                        }
                    }
                },
                error: function(xhr, status, error) {
                    $('#phone').val(null);
                    $('#address').val(null);
                    $('#city').val(null);
                    $('#state').val(null);
                    $('#zip').val(null);
                }
            });
        });



        function updateSerialNumbers() {
            $('#ItemList tr').each(function(index) {
                $(this).find('.serial-number').text(index + 1);
            });
        }

        document.getElementById('AddItemButton').addEventListener('click', function(event) {
            event.preventDefault();
            $('.modal-blur-content').addClass('modal-blur');
            $('#modalLoader').show();

            var doctorTypeName = $('#item-dropdown').val();
            var doctorTypeText = $('#item-dropdown option:selected').text();
            var uniqueId = new Date().getTime();
            $.ajax({
                url: '/add-item',
                type: 'GET',
                data: {
                    name: doctorTypeName
                },
                success: function(response) {
                    let newRow = `
                <tr id="row-${uniqueId}">
                    <td class="text-center serial-number"></td>
                    <td class="text-center">${doctorTypeText}</td>
                    <td class="text-center">${response.name}</td>
                    <td class="text-center">${response.name}</td>
                    <td class="text-center">${response.name}</td>
                    <td class="text-center">${response.name}</td>
                    <td class="text-center">${response.name}</td>
                    <td class="text-center">${response.name}</td>
                    <td class="text-center">${response.name}</td>
                    <td class="text-center">
                        <button data-id="${uniqueId}" class="btn btn-sm btn-danger remove-btn" data-toggle="tooltip" data-placement="top" title="Delete Item"><i class="fa fa-trash"></i></button>
                    </td>
                </tr>`;

                    $('#ItemList').append(newRow);

                    var currentItems = $('#ItemsInput').val();
                    var itemsArray = currentItems ? JSON.parse(currentItems) : [];
                    itemsArray.push({
                        id: doctorTypeName,
                        uniqueId: uniqueId
                    });
                    $('#ItemsInput').val(JSON.stringify(itemsArray));

                    updateSerialNumbers(); // Update serial numbers
                },
                error: function(xhr, status, error) {
                    $('.modal-blur-content').removeClass('modal-blur');
                    $('#modalLoader').hide();
                    alert('Something went wrong, please try again.');
                },
                complete: function() {
                    $('.modal-blur-content').removeClass('modal-blur');
                    $('#modalLoader').hide();
                }
            });
        });


        $(document).on('click', '.remove-btn', function(event) {
            event.preventDefault();

            let uniqueId = $(this).data('id');
            $(`#row-${uniqueId}`).remove();
            var currentItems = $('#ItemsInput').val();
            var itemsArray = currentItems ? JSON.parse(currentItems) : [];
            var updatedArray = itemsArray.filter(function(item) {
                return item.uniqueId != uniqueId;
            });

            $('#ItemsInput').val(JSON.stringify(updatedArray));

            updateSerialNumbers();
        });
    </script>

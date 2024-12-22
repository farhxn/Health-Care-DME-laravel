<?php
$title =  isset($manufacture) ? 'Update Manufacturer'  : 'Add Manufacturer';
?>
@section('title', $title)
@include('layout.Head')
<style>
    .tickmark-list {
        list-style: none;
        padding-left: 0;
    }

    .tickmark-list li {
        display: flex;
        align-items: center;
        margin-bottom: 10px;
    }

    .tickmark-list .tickmark-icon {
        margin-right: 10px;
        color: green;
        /* Adjust color as needed */
    }
</style>

<div class="dashboard-wrapper">
    <div class="dashboard-ecommerce">
        <div class="container-fluid dashboard-content">
            <div class="row">
                <div class="col-12">
                    <div class="d-flex justify-content-between align-items-center">
                        <!-- Heading aligned to the left -->
                        <h2 class="pageheader-title">{{ isset($manufacture) ? 'Update Manufacturer' : 'Add Manufacturer' }}</h2>
                    </div>
                </div>
            </div>
            <br>

            <div class="ecommerce-widget">
                <div class="row">
                    <div class="col">
                        <form method="post" action="{{ url('AddEditManufacturer',isset($manufacture) ? $manufacture->id : 0) }}">
                            @csrf
                            <div class="card">
                                <br>
                                <div class="card-body">

                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label class="col-form-label">Manufacture Name</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" required placeholder="Manufacture Name" name="Manufacture_Name" class="form-control"
                                                        value="{{ isset($manufacture) ? $manufacture->Manufacture_Name : old('Manufacture_Name') }}">

                                                </div>
                                                <span><small class="text-danger font-weight-light font-italic">
                                                        @error('Manufacture_Name')
                                                        {{ $message }}
                                                        @enderror
                                                    </small></span>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label class="col-form-label">Contact</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" required placeholder="Contact" name="Contact" class="form-control"
                                                        value="{{ isset($manufacture) ? $manufacture->Contact : old('Contact') }}">
                                                </div>
                                                <span><small class="text-danger font-weight-light font-italic">
                                                        @error('Contact')
                                                        {{ $message }}
                                                        @enderror
                                                    </small></span>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label class="col-form-label">Account</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" required placeholder="Account" name="Account" class="form-control"
                                                        value="{{ isset($manufacture) ? $manufacture->Account : old('Account') }}">
                                                </div>
                                                <span><small class="text-danger font-weight-light font-italic">
                                                        @error('Account')
                                                        {{ $message }}
                                                        @enderror
                                                    </small></span>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label class="col-form-label">Address</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" required placeholder="Address" name="Address" class="form-control"
                                                        value="{{ isset($manufacture) ? $manufacture->Address : old('Address') }}">
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
                                                    <input type="text" required placeholder="City" name="City" class="form-control"
                                                        value="{{ isset($manufacture) ? $manufacture->City : old('City') }}">
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
                                                    <input type="text" required placeholder="State" name="State" class="form-control"
                                                        value="{{ isset($manufacture) ? $manufacture->State : old('State') }}">
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
                                                <label class="col-form-label">Zip</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" required placeholder="Zip" name="Zip" class="form-control"
                                                        value="{{ isset($manufacture) ? $manufacture->Zip : old('Zip') }}">
                                                </div>
                                                <span><small class="text-danger font-weight-light font-italic">
                                                        @error('Zip')
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
                                                    <input type="text" required placeholder="Phone" name="Phone" class="form-control"
                                                        value="{{ isset($manufacture) ? $manufacture->Phone : old('Phone') }}">
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
                                                <label class="col-form-label">Phone 2</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" required placeholder="Phone 2" name="Phone2" class="form-control"
                                                        value="{{ isset($manufacture) ? $manufacture->Phone2 : old('Phone2') }}">
                                                </div>
                                                <span><small class="text-danger font-weight-light font-italic">
                                                        @error('Phone2')
                                                        {{ $message }}
                                                        @enderror
                                                    </small></span>
                                            </div>

                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label class="col-form-label">Fax</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" required placeholder="Fax" name="Fax" class="form-control"
                                                        value="{{ isset($manufacture) ? $manufacture->Fax : old('Fax') }}">
                                                </div>
                                                <span><small class="text-danger font-weight-light font-italic">
                                                        @error('Fax')
                                                        {{ $message }}
                                                        @enderror
                                                    </small></span>
                                            </div>

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
    </div>



    @include('layout.footer')
    <script>
        $(document).ready(function() {
            logAction("Add Manufacturer Page Loaded");
        });
    </script>
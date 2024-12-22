<?php
$title =  isset($tax) ? 'Update Tax' : 'Add Tax';
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
                        <h2 class="pageheader-title">{{ isset($tax) ? 'Update Tax' : 'Add Tax'}}</h2>

                    </div>
                </div>
            </div>
            <br>

            <div class="ecommerce-widget">

                <div class="row">


                    <div class="col">
                        <form method="post" action="{{ url('AddEditTax',isset($tax) ? $tax->id : 0) }}">
                            @csrf
                            <div class="card">
                                <br>
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

                                <div class="row">
                                    <div class="col-12">
                                        <div class="d-flex justify-content-between align-items-center m-3">
                                            <!-- Heading aligned to the left -->
                                            <h2 class="pageheader-title">{{ isset($tax) ? 'Edit Tax' : 'Create Tax' }}</h2>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label class="col-form-label">Name</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" required placeholder="Name" name="Name"
                                                        class="form-control form-control-sm" value="{{ isset($tax) ? $tax->Name : old('Name') }}">
                                                </div>
                                                <span><small class="text-danger font-weight-light font-italic">
                                                        @error('Name')
                                                        {{ $message }}
                                                        @enderror
                                                    </small></span>
                                            </div>

                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-6">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label class="col-form-label">States Tax</label>
                                                    <div class="input-group mb-3">
                                                        <input type="number" required placeholder="States Tax" name="StatesTax"
                                                            class="form-control form-control-sm" id="StatesTax" value="{{ isset($tax) ? $tax->StatesTax : old('StatesTax') }}">
                                                    </div>
                                                    <span><small class="text-danger font-weight-light font-italic">
                                                            @error('StatesTax')
                                                            {{ $message }}
                                                            @enderror
                                                        </small></span>
                                                </div>
                                            </div>

                                            <div class="col">
                                                <div class="form-group">
                                                    <label class="col-form-label">County Tax</label>
                                                    <div class="input-group mb-3">
                                                        <input type="number" required placeholder="County Tax" name="CountyTax"
                                                            class="form-control form-control-sm" id="CountyTax" value="{{ isset($tax) ? $tax->CountyTax : old('CountyTax') }}">
                                                    </div>
                                                    <span><small class="text-danger font-weight-light font-italic">
                                                            @error('CountyTax')
                                                            {{ $message }}
                                                            @enderror
                                                        </small></span>
                                                </div>

                                            </div>

                                        </div>
                                        <div class="col-6">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label class="col-form-label">City Tax</label>
                                                    <div class="input-group mb-3">
                                                        <input type="text" required placeholder="City Tax" name="CityTax"
                                                            class="form-control form-control-sm" id="CityTax" value="{{ isset($tax) ? $tax->CityTax : old('CityTax') }}">
                                                    </div>
                                                    <span><small class="text-danger font-weight-light font-italic">
                                                            @error('CityTax')
                                                            {{ $message }}
                                                            @enderror
                                                        </small></span>
                                                </div>

                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label class="col-form-label">Other Tax</label>
                                                    <div class="input-group mb-3">
                                                        <input type="text" required placeholder="Other Tax" name="OtherTax"
                                                            class="form-control form-control-sm" id="OtherTax" value="{{ isset($tax) ? $tax->OtherTax : old('OtherTax') }}">
                                                    </div>
                                                    <span><small class="text-danger font-weight-light font-italic">
                                                            @error('OtherTax')
                                                            {{ $message }}
                                                            @enderror
                                                        </small></span>
                                                </div>

                                            </div>

                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label class="col-form-label">Total Tax</label>
                                                <div class="input-group mb-3">
                                                    <input type="number" readonly required placeholder="Total Tax" name="TotalTax"
                                                        class="form-control form-control-sm" id="TotalTax" value="{{ isset($tax) ? $tax->TotalTax : old('TotalTax') }}">
                                                </div>
                                                <span><small class="text-danger font-weight-light font-italic">
                                                        @error('TotalTax')
                                                        {{ $message }}
                                                        @enderror
                                                    </small></span>
                                            </div>

                                        </div>
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
        logAction("Add Tax Page Loaded");
    });

    function calculateTotalTax() {
        const statesTax = parseFloat(document.getElementById('StatesTax').value) || 0;
        const countyTax = parseFloat(document.getElementById('CountyTax').value) || 0;
        const cityTax = parseFloat(document.getElementById('CityTax').value) || 0;
        const otherTax = parseFloat(document.getElementById('OtherTax').value) || 0;
        const totalTax = statesTax + countyTax + cityTax + otherTax;

        document.getElementById('TotalTax').value = totalTax.toFixed(2);
    }

    document.getElementById('StatesTax').addEventListener('input', calculateTotalTax);
    document.getElementById('CountyTax').addEventListener('input', calculateTotalTax);
    document.getElementById('CityTax').addEventListener('input', calculateTotalTax);
    document.getElementById('OtherTax').addEventListener('input', calculateTotalTax);

    // Calculate total tax on page load (in case values are pre-filled)
    window.onload = calculateTotalTax;

</script>

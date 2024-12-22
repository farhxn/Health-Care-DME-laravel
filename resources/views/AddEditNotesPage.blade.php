<?php
$title =  isset($preNotes) ? 'Update ' . $preNotes->FirstName  : 'Add Note';
?>
@section('title', $title)
@include('layout.Head')

<div class="dashboard-wrapper">
    <div class="dashboard-ecommerce">
        <div class="container-fluid dashboard-content">
            <div class="row">

                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="page-header">
                        <h2 class="pageheader-title ml-auto">{{ isset($preNotes) ? 'Update Note' : 'Add Note' }} </h2>
                        <div class="page-breadcrumb">
                            <nav aria-label="breadcrumb">
                            </nav>
                        </div>
                    </div>
                </div>
            </div>

            <div class="ecommerce-widget">

                <div class="row">


                    <div class="col">
                        <form method="post" action="{{ url('AddEditNotes',isset($preNotes) ? $preNotes->id : 0) }}" id="myForm">
                            @csrf
                            <div class="card">
                                <h5 class="card-header">
                                    {{ isset($preNotes) ? 'Update  ' . $preNotes->Name : 'Add Note' }} Details
                                </h5>

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
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label class="col-form-label form-control-sm text-sm">Name</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" placeholder="Name" name="Name"
                                                        class="form-control form-control-sm" value="{{ isset($preNotes) ? $preNotes->Name : old('Name') }}">
                                                </div>
                                                <span><small class="text-danger font-weight-light font-italic">
                                                        @error('Name')
                                                        {{ $message }}
                                                        @enderror
                                                    </small></span>
                                            </div>
                                        </div>

                                        <div class="col">
                                            <div class="form-group">
                                                <label class="col-form-label form-control-sm">Type</label>
                                                <div class="input-group">
                                                    <select class="form-control form-control-sm" id="status-dropdown" required name="Type">
                                                        <option disabled {{ old('Type', isset($preNotes) ? $preNotes->Type : '') == '' ? 'selected' : '' }}>Type</option>
                                                        <option value="Document Text" {{ old('Type', isset($preNotes) ? $preNotes->Type : '') == 'Document Text' ? 'selected' : '' }}>Document Text</option>
                                                        <option value="Account Statement" {{ old('Type', isset($preNotes) ? $preNotes->Type : '') == 'Account Statement' ? 'selected' : '' }}>Account Statement</option>
                                                        <option value="Compliance Notes" {{ old('Type', isset($preNotes) ? $preNotes->Type : '') == 'Compliance Notes' ? 'selected' : '' }}>Compliance Notes</option>
                                                        <option value="Customer Notes" {{ old('Type', isset($preNotes) ? $preNotes->Type : '') == 'Customer Notes' ? 'selected' : '' }}>Customer Notes</option>
                                                        <option value="Customer Notes" {{ old('Type', isset($preNotes) ? $preNotes->Type : '') == 'Invoice Notes' ? 'selected' : '' }}>Invoice Notes</option>
                                                        <option value="HAO" {{ old('Type', isset($preNotes) ? $preNotes->Type : '') == 'HAO' ? 'selected' : '' }}>HAO</option>
                                                    </select>
                                                </div>
                                                <span><small class="text-danger font-weight-light font-italic">
                                                        @error('Courtesy')
                                                        {{ $message }}
                                                        @enderror
                                                    </small></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label class="col-form-label form-control-sm text-sm">Text</label>
                                                <div class="input-group mb-3">
                                                    <textarea placeholder="Text" required name="Text" rows="3" col="5" class="form-control form-control-sm">{{ isset($preNotes) ? $preNotes->Text : old('Text') }}</textarea>
                                                </div>
                                                <span>
                                                    <small class="text-danger font-weight-light font-italic">
                                                        @error('Text')
                                                        {{ $message }}
                                                        @enderror
                                                    </small>
                                                </span>
                                            </div>
                                        </div>

                                    </div>

                                </div>



                                <div class="card-body border-top">
                                    <div class="form-group">
                                        <div class="input-group mb-3">
                                            <div class="input-group">
                                                <button type="submit" class="btn btn-block"
                                                    style="background-color: #427ed1; color: white;"> {{ isset($preNotes) ? 'Update Notes' : 'Add Notes' }}
                                                </button>
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
            logAction("Add Notes Page Loaded");
        });
    </script>

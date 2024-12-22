<?php
$title =  isset($insurance) ? 'Update Form POS Type'  : 'Add New Form POS Type';
?>
@section('title', $title)
@include('layout.Head')

<div class="dashboard-wrapper">
    <div class="dashboard-ecommerce">
        <div class="container-fluid dashboard-content">
            <div class="row">

                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="page-header">
                        <h2 class="pageheader-title ml-auto">{{ isset($insurance) ? 'Update Form POS Type' : 'Add New Form POS Type' }} </h2>
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
                        <form method="post" action="{{ url('AddEditFormPOSType',isset($insurance) ? $insurance->id : 0) }}" id="myForm">
                            @csrf
                            <div class="card">
                                <h5 class="card-header">
                                    {{ isset($insurance) ? 'Update Form POS Type' : 'Add Form POS Type' }} Details
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
                                                <label for="recipient-name" class="col-form-label">Code:</label>
                                                <input required type="text" class="form-control"  placeholder="Code" name="Code" value="{{ isset($insurance) ? $insurance->Code : old('Code') }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="recipient-name" class="col-form-label">Description:</label>
                                                <input required type="text" class="form-control"  placeholder="Description" name="Description" value="{{ isset($insurance) ? $insurance->Description : old('Description') }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body border-top">
                                    <div class="form-group">
                                        <div class="input-group mb-3">
                                            <div class="input-group">
                                                <button type="submit" class="btn btn-block"
                                                    style="background-color: #427ed1; color: white;"> {{ isset($insurance) ? 'Update Form POS Type' : 'Add Form POS Type' }}
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
            logAction("Add Form POS Type Page Loaded");
        });
    </script>

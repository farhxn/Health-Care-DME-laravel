<?php
$title =  isset($insurance) ? 'Update Invoice Form'  : 'Add New Invoice Form';
?>
@section('title', $title)
@include('layout.Head')

<div class="dashboard-wrapper">
    <div class="dashboard-ecommerce">
        <div class="container-fluid dashboard-content">
            <div class="row">

                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="page-header">
                        <h2 class="pageheader-title ml-auto">{{ isset($insurance) ? 'Update Invoice Form' : 'Add New Invoice Form                            ' }} </h2>
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
                        <form method="post" action="{{ url('AddEditInvoiceForm',isset($insurance) ? $insurance->id : 0) }}" id="myForm">
                            @csrf
                            <div class="card">
                                <h5 class="card-header">
                                    {{ isset($insurance) ? 'Update Invoice Form' : 'Add Invoice Form' }} Details
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
                                                <label for="recipient-name" class="col-form-label">Name:</label>
                                                <input required type="text" class="form-control"  placeholder="Name" name="name" value="{{ isset($insurance) ? $insurance->name : old('name') }}">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="recipient-name" class="col-form-label">CR File Name:</label>
                                                <input required type="text" class="form-control"  placeholder="CR File Name" name="CR_File_Name" value="{{ isset($insurance) ? $insurance->CR_File_Name : old('CR_File_Name') }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="recipient-name" class="col-form-label">Special Coding:</label>
                                                <input required type="text" class="form-control"  placeholder="Special Coding" name="Special_Coding" value="{{ isset($insurance) ? $insurance->Special_Coding : old('Special_Coding') }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card m-2 mr-auto" style="border: 0.5px solid grey;">
                                    <div class="card-body">
                                        <h5 class="card-title text-left">Margin </h5>
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="recipient-name" class="col-form-label">Top:</label>
                                                    <input required type="text" class="form-control"  placeholder="Top" name="Top" value="{{ isset($insurance) ? $insurance->Top : old('Top') }}">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="recipient-name" class="col-form-label">Bottom:</label>
                                                    <input required type="text" class="form-control"  placeholder="Bottom" name="Bottom" value="{{ isset($insurance) ? $insurance->Bottom : old('Bottom') }}">
                                                </div>
                                            </div>
                                        </div>            <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="recipient-name" class="col-form-label">Left:</label>
                                                    <input required type="text" class="form-control"  placeholder="Left" name="Left" value="{{ isset($insurance) ? $insurance->Left : old('Left') }}">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="recipient-name" class="col-form-label">Right:</label>
                                                    <input required type="text" class="form-control" placeholder="Right" name="Right" value="{{ isset($insurance) ? $insurance->Right : old('Right') }}">
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
                                                    style="background-color: #427ed1; color: white;"> {{ isset($insurance) ? 'Update Invoice Form' : 'Add Invoice Form' }}
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
            logAction("Add Invoice Form Page Loaded");
        });
    </script>
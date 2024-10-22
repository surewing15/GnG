@extends('user.theme.layout')

@section('content')

<div class="row">
    <!-- Left Column -->
    <div class="col-md-7">
        <div class="card">
            <div class="card-body">
                <!-- Product Category and Count Selection -->
                <div class="row">
                    <!-- Product Category -->
                    <div class="col-md-6">
                        <div class="form-control-wrap">
                            <label class="form-label" for="p_category">Product Category</label>
                            <div class="input-group">
                                <select class="form-select" name="p_category" id="p_category" required>
                                    <option disabled selected>Select Category</option>
                                    <option value="lobot">Feet</option>
                                    <option value="sampot">Wings</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Product Count -->
                    <div class="col-md-6">
                        <div class="form-control-wrap">
                            <label class="form-label" for="p_count">Product Count</label>
                            <div class="input-group">
                                <select class="form-select" name="p_count" id="p_count" required>
                                    <option disabled selected>Select Count</option>
                                    <option value="10">10 Products</option>
                                    <option value="20">20 Products</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-xxl-3 col-lg-4 col-sm-6">
                        <div class="card card-bordered product-card">
                            <div class="product-thumb">
                                <a>
                                    <img class="card-img-top" src="./images/product/lg-a.jpg" alt="Product Image">
                                </a>
                                <ul class="product-badges">
                                    <li><span class="badge bg-success">Stock: 17</span></li>
                                </ul>
                            </div>
                            <div class="card-inner text-center">
                                <ul class="product-tags">
                                    <li><a href="#">P1</a></li>
                                </ul>
                                <h5 class="product-title"><a href="#">P1</a></h5>
                                <div class="product-price text-primary h5">₱0123</div>
                                <!-- Add Button -->
                                <a href="#" class="btn btn-primary mt-2">Add</a> <!-- Button to add the product -->
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>

  <!-- Right Column -->
<div class="col-md-5">
    <div class="card">
        <div class="card-body">


            <div class="table-responsive mt-3">
                <table class="table">
                    <thead>
                        <tr class="text-center">
                            <th class="align-middle">Product</th>
                            <th class="align-middle">Price</th>
                            <th class="align-middle">Quantity</th>
                            <th class="align-middle">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="4" class="text-center">
                                <span class="text-danger">Please search & select products!</span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="table-responsive mt-3">
                <table class="table table-striped">
                    <tbody>

                        <tr class="text-primary">
                            <th>Total Amount</th>
                            <td>(=) ₱0.00</td>
                        </tr>
                    </tbody>
                </table>
            </div>


            <div class="d-flex justify-content-center flex-wrap mb-0 mt-3">
                <button wire:click="resetCart" type="button" class="btn btn-danger me-3">
                    <i class="bi bi-x"></i> Reset
                </button>
                <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#checkoutModal">Check Out</button>

            </div>
        </div>
    </div>
</div>
@include('user.forms.checkout')
@endsection

@extends('clerk.theme.layout')

@section('content')
    <div class="nk-block nk-block-lg">
        <div class="nk-block-head d-flex justify-content-between align-items-center">
            <div class="nk-block-head-content">
                <h4 class="nk-block-title">Stocks</h4>
            </div>
        </div>

        <div class="card card-bordered card-preview">
            <div class="card-inner">
                <table class="datatable-init-export nowrap table" data-export-title="Export">
                    <thead>
                        <tr>
                            <th>Product Code (SKU)</th>
                            <th>Description</th>
                            <th>Bags</th>
                            <th>Heads</th>
                            <th>Kilos</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr>
                                <!-- Start Form for Each Row -->
                                <form action="/stocks" method="POST">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->product_id }}">

                                    <td>{{ $product->product_sku }}</td>
                                    <td>{{ $product->p_description }}</td>
                                    <td>
                                        <input type="number" name="bags" class="form-control" min="0"
                                            value="0" required>
                                    </td>
                                    <td>
                                        <input type="number" name="heads" class="form-control" min="0"
                                            value="0" required>
                                    </td>
                                    <td>
                                        <input type="number" name="kilos" class="form-control" min="0"
                                            value="0" required>
                                    </td>
                                    <td>
                                        <button class="btn btn-icon btn-primary d-flex align-items-center" type="submit"
                                            title="Save">
                                            <em class="icon ni ni-save me-1"></em>
                                        </button>
                                    </td>
                                </form>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @include('clerk.modal.stock-in-modal')
@endsection

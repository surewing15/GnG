@extends('cashier.theme.layout')
@section('content')
    <div class="row">

        <div class="col-md-7">
            <div class="card">
                <div class="card-body">

                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-control-wrap">
                                <label class="form-label" for="category">Filter by Category</label>
                                <div class="input-group">
                                    <form method="GET" action="{{ route('cashier.index') }}">
                                        <select class="form-select" name="category" id="category"
                                            onchange="this.form.submit()">
                                            <option value="">All Categories</option>
                                            @foreach ($categories as $cat)
                                                <option value="{{ $cat }}"
                                                    {{ $category == $cat ? 'selected' : '' }}>
                                                    {{ $cat }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </form>
                                </div>
                            </div>
                        </div>

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
                        <div class="row">
                            <div class="col-12 mb-3">
                                <div class="form-control-wrap">
                                    <input type="text" id="product-search" class="form-control form-control-lg"
                                        placeholder="Search products...">
                                </div>
                            </div>
                        </div>
                        @foreach ($products as $product)
                            <div class="col-xxl-3 col-lg-4 col-sm-6">
                                <div class="card card-bordered product-card">
                                    <ul class="product-badges">
                                        <li>
                                            <span
                                                class="badge {{ $product->total_stock > 0 ? 'bg-success' : 'bg-danger' }}">
                                                {{ $product->total_stock > 0 ? $product->total_stock . ' In Stock' : 'Out of Stock' }}
                                            </span>
                                        </li>


                                    </ul>

                                    <div class="card-inner text-center">
                                        <div>&nbsp;</div>

                                        <ul class="product-tags">
                                            <li><a href="#">SKU</a></li>
                                        </ul>
                                        <h5 class="product-title">{{ $product->product_sku }}</h5>
                                        <div style="padding: 10px;"></div>

                                        <a class="btn btn-primary mt-2"
                                            onclick="addToCart({{ $product->product_id }})">Add</a>

                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>





                </div>
            </div>
        </div>

        <div class="col-md-5">
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <label for="customer_id">Customer <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <a href="http://127.0.0.1:8000/customers/create" class="btn btn-primary">
                                <i class="bi bi-person-plus"></i>
                            </a>
                            <select wire:model.live="customer_id" id="customer_id" class="form-select">
                                <option value="" selected>Select Customer</option>
                                <option value="1">antony Anton</option>
                            </select>
                        </div>
                    </div>

                    <div class="table-responsive mt-3">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                </tr>
                            </thead>
                            <tbody id="cart-table-body">
                                @foreach ($cartItems as $itemId => $item)
                                    <tr id="cart-item-{{ $itemId }}">
                                        <td>{{ $item['name'] }}</td>
                                        <td>
                                            <input type="number" class="form-control" id="quantity-{{ $itemId }}"
                                                value="{{ $item['quantity'] }}"
                                                style="width: 80px; padding: 5px; text-align: center;"
                                                onchange="updateCart({{ $itemId }})">
                                        </td>
                                        <td>
                                            <input type="number" class="form-control" id="price-{{ $itemId }}"
                                                value="{{ $item['price'] }}"
                                                style="width: 100px; padding: 5px; text-align: right;"
                                                onchange="updateCart({{ $itemId }})">
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>

                            <tfoot>
                                <tr>
                                    <tfoot>
                                        <tr>
                                            <td colspan="2" class="text-end"><strong>Grand Total:</strong></td>
                                            <td id="grand-total"><strong>{{ number_format($grandTotal, 2) }}</strong></td>
                                        </tr>
                                    </tfoot>

                                </tr>
                            </tfoot>



                        </table>
                    </div>

                    <div class="table-responsive mt-3">
                        <table class="table table-striped">
                            <tbody id="cart-table-body">

                            </tbody>
                        </table>
                    </div>



                    <div class="d-flex justify-content-center flex-wrap mb-0 mt-3">
                        <button onclick="resetCart()" type="button" class="btn btn-danger me-3">
                            <i class="bi bi-x"></i> Reset
                        </button>

                        <button type="button" class="btn btn-secondary" data-bs-toggle="modal"
                            data-bs-target="#invoiceModal">Place Order</button>


                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function addToCart(productId) {
            $.ajax({
                url: '{{ route('cart.add') }}',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    product_id: productId
                },
                success: function(response) {
                    loadCart();
                },
                error: function(xhr) {
                    console.error("Error adding product to cart:", xhr.responseText);
                }
            });
        }


        function resetCart() {
            $.ajax({
                url: '{{ route('cart.reset') }}',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    $('#cart-table-body').empty(); // Clear cart items from the table
                    $('#grand-total').text('0.00'); // Reset grand total to zero
                    alert(response.success);
                },
                error: function(response) {
                    console.error("Error resetting cart:", response);
                }
            });
        }


        function loadCart() {
            $.ajax({
                url: '{{ route('cart.show') }}',
                method: 'GET',
                success: function(response) {
                    let cartTableContent = '';
                    let grandTotal = 0;

                    $.each(response.cart, function(id, product) {
                        let itemTotal = product.quantity * product.price;
                        grandTotal += itemTotal;

                        cartTableContent += `
                    <tr id="cart-item-${id}">
                        <td>${product.name}</td>
                        <td>
                            <input type="number" class="form-control" id="quantity-${id}" value="${product.quantity}" style="width: 80px; padding: 5px; text-align: center;"
                                onchange="updateCart(${id})">
                        </td>
                        <td>
                            <input type="number" class="form-control" id="price-${id}" value="${product.price}" style="width: 100px; padding: 5px; text-align: right;"

                                onchange="updateCart(${id})">
                        </td>
                    </tr>
                `;
                    });

                    $('#cart-table-body').html(cartTableContent);
                    $('#grand-total').text(grandTotal.toFixed(2)); // Update grand total in HTML
                },
                error: function(xhr) {
                    console.error("Error loading cart:", xhr.responseText);
                }
            });
        }

        function updateCart(itemId) {
            let quantity = document.getElementById(`quantity-${itemId}`).value;
            let price = document.getElementById(`price-${itemId}`).value;

            $.ajax({
                url: '{{ route('cart.update') }}',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    id: itemId,
                    quantity: quantity,
                    price: price
                },
                success: function(response) {
                    loadCart(); // Refresh the cart table content including the updated grand total
                },
                error: function(xhr) {
                    console.error("Error updating cart:", xhr.responseText);
                }
            });
        }
    </script>
    @include('cashier.modal.cashier-modal')
@endsection

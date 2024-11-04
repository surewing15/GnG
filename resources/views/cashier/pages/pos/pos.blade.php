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
                                            <span id="product-kilos-{{ $product->product_id }}"
                                                class="badge {{ $product->total_kilos > 0 ? 'bg-success' : 'bg-danger' }}">
                                                {{ $product->total_kilos > 0 ? $product->total_kilos . ' In Kilos' : 'Out of Kilos' }}
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
                                            onclick="addToCart({{ $product->product_id }}, {{ $product->total_kilos }})">Add</a>


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
                        <label class="form-label" for="full-name">Customer Name</label>
                        <div class="form-control-wrap">
                            <input type="text" class="form-control" id="cus-name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="full-name">Phone Number</label>
                        <div class="form-control-wrap">
                            <input type="text" class="form-control" id="cus-phone">
                        </div>
                    </div>
                    {{-- <div class="form-group">
                        <label class="form-label" for="full-name">Date</label>
                        <div class="form-control-wrap">
                            <input type="date" class="form-control" id="cus-date">
                        </div>
                    </div> --}}

                    <div class="table-responsive mt-3">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Kilos</th>
                                    <th>Price</th>
                                </tr>
                            </thead>
                            <tbody id="cart-table-body">
                                @foreach ($cartItems as $itemId => $item)
                                    <tr id="cart-item-{{ $itemId }}" data-product-id="{{ $itemId }}">
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
                            data-bs-target="#invoiceModal" onclick="prepareReceipt()">Invoice</button>



                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function addToCart(productId, kilos) {
            $.ajax({
                url: '{{ route('cart.add') }}',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    product_id: productId,
                    kilos: kilos
                },
                success: function(response) {
                    if (response.success) {
                        loadCart(); // Force reloading the cart to update the UI
                        // Update the badge as needed
                        const kiloBadge = document.querySelector(`#product-kilos-${productId}`);
                        if (kiloBadge) {
                            kiloBadge.textContent = response.updatedTotalKilos > 0 ?
                                `${response.updatedTotalKilos} In Kilos` : 'Out of Kilos';
                            kiloBadge.classList.toggle('bg-success', response.updatedTotalKilos > 0);
                            kiloBadge.classList.toggle('bg-danger', response.updatedTotalKilos <= 0);
                        }
                    }
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

                    $('#cart-table-body').empty();
                    $('#grand-total').text('0.00');

                    $('#cus-name').val('');
                    $('#cus-phone').val('');

                    alert(response.success);
                },
                error: function(xhr) {
                    console.error("Error resetting cart:", xhr.responseText);
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
                    $('#grand-total').text(grandTotal.toFixed(2));
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
                    loadCart();
                },
                error: function(xhr) {
                    console.error("Error updating cart:", xhr.responseText);
                }
            });
        }

        function prepareReceipt() {
            let receiptContent = '';
            let grandTotal = 0;
            const receiptID = generateReceiptID();
            $('#cart-table-body tr').each(function() {
                const productName = $(this).find('td:nth-child(1)').text();
                const quantity = $(this).find('input[id^="quantity-"]').val();
                const price = $(this).find('input[id^="price-"]').val();
                const total = (quantity * price).toFixed(2);

                grandTotal += parseFloat(total);

                receiptContent += `
            <tr>
                <td>${productName}</td>
                <td class="text-end">${quantity}</td>
                <td class="text-end">$${parseFloat(price).toFixed(2)}</td>
                <td class="text-end">$${total}</td>
            </tr>
        `;
            });


            $('.receipt-info').html(`
        <p><strong>Date:</strong> ${new Date().toLocaleDateString()}</p>
        <p><strong>Receipt #ID:</strong> ${receiptID}</p>
    `);
            $('.receipt-items tbody').html(receiptContent);
            $('.receipt-total p').html(`<strong>Total:</strong> $${grandTotal.toFixed(2)}`);

            $('#invoiceModal').modal('show');
        }


        function generateReceiptID() {
            const date = new Date();
            const year = date.getFullYear().toString().slice(-2);
            const month = ('0' + (date.getMonth() + 1)).slice(-2);
            const day = ('0' + date.getDate()).slice(-2);
            const randomPart = Math.random().toString(36).substring(2, 6).toUpperCase();

            return `${year}${month}${day}-${randomPart}`;
        }
    </script>


    {{-- fixing bugs soon --}}

    @include('cashier.modal.cashier-modal')
@endsection

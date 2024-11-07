<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>

<div class="modal fade" id="invoiceModal" tabindex="-1" aria-labelledby="invoiceModalLabel" aria-hidden="true">
    <div class="modal-dialog custom-receipt-width">
        <div class="modal-content receipt-style" id="receiptContent">
            <div class="modal-header">
                <h5 class="modal-title" id="invoiceModalLabel">Receipt</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body receipt-print-content">
                <div class="nk-block">
                    <div class="receipt text-center">
                        <div class="receipt-brand mb-2">
                            <img src="./images/logo-dark.png" srcset="./images/logo-dark2x.png 2x" alt="Logo"
                                style="max-width: 100px;">
                        </div>
                        <div class="receipt-header text-center mb-3">
                            <h4>Thank you for your purchase!</h4>
                            <p class="small-text">Jhong Pax</p>
                            <p class="small-text">Phone: +012 8764 556</p>
                        </div>
                        <div class="receipt-info text-start mb-3">
                            <p><strong>Date:</strong> <span id="receiptDate"></span></p>
                            <p><strong>Receipt #ID:</strong> <span id="receiptID"></span></p>
                        </div>
                        <div class="receipt-items">
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th>SKU</th>
                                        <th class="text-end">Kilos</th>
                                        <th class="text-end">Price</th>
                                        <th class="text-end">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Items will be injected here -->
                                </tbody>
                            </table>
                        </div>

                        <div class="receipt-total text-end mt-3">
                            <p><strong>Total:</strong> <span id="grandTotal">₱0.00</span></p>
                        </div>
                        <p class="receipt-footer small-text mt-2 text-muted">This receipt was generated electronically
                            and is valid without a signature or seal.</p>
                    </div>
                </div>
            </div>

            <div class="modal-footer no-print">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success" onclick="confirmPayment()">Confirm Payment</button>
                <button type="button" class="btn btn-primary" onclick="printReceipt()">Print</button>
                <button type="button" class="btn btn-info" onclick="downloadPDF()">Download PDF</button>
            </div>
        </div>
    </div>
</div>

<script>
    function confirmPayment() {
        const receiptID = document.getElementById('receiptID').innerText;
        const customerName = document.querySelector('.receipt-header .small-text:nth-child(2)').innerText;
        const customerPhone = document.querySelector('.receipt-header .small-text:nth-child(3)').innerText.replace(
            'Phone: ', '');
        const date = new Date().toISOString().split('T')[0];
        const totalAmount = parseFloat($('#grandTotal').text().replace('₱', ''));

        let items = [];
        $('#cart-table-body tr').each(function() {
            const rowId = $(this).attr('id');
            const productId = rowId ? rowId.replace('cart-item-', '') : null;
            const quantity = parseFloat($(this).find('input[id^="quantity-"]').val());
            const price = parseFloat($(this).find('input[id^="price-"]').val());
            const total = quantity * price;

            if (productId && !isNaN(quantity) && !isNaN(price) && !isNaN(total)) {
                items.push({
                    product_id: parseInt(productId),
                    kilos: quantity,
                    price_per_kilo: price,
                    total: total
                });
            }
        });

        if (items.length === 0) {
            alert("No items found for the transaction. Please add items to proceed.");
            return;
        }

        $.ajax({
            url: '/transactions',
            type: 'POST',
            data: {
                date: date,
                receipt_id: receiptID,
                customer_name: customerName,
                phone: customerPhone,
                total_amount: totalAmount,
                items: items,
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                // First print the receipt
                printReceipt();

                // Close the modal
                $('#invoiceModal').modal('hide');

                // Clear the cart data from the session and UI
                $.ajax({
                    url: '/cart/reset',
                    method: 'POST',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        isPaymentConfirmed: true
                    },
                    success: function() {
                        // Clear UI elements
                        clearCartUI();

                        // Show success message and reload page
                        alert('Payment confirmed and transaction saved successfully.');
                        window.location.href = window.location.pathname; // Force a clean reload
                    },
                    error: function() {
                        alert('Error clearing cart. Please refresh the page.');
                    }
                });
            },
            error: function(xhr, status, error) {
                console.error('Failed to save transaction:', error);
                alert('Failed to save transaction. Please try again.');
            }
        });
    }

    // New function to handle UI clearing
    function clearCartUI() {
        // Clear cart table
        $('#cart-table-body').empty();

        // Reset grand total
        $('#grand-total').html('<strong>₱0.00</strong>');

        // Clear customer information
        $('#cus-name').val('');
        $('#cus-phone').val('');

        // Clear any error messages or notifications
        $('.alert').remove();
    }

    // Update the reset cart function
    function resetCart() {
        if (confirm('Are you sure you want to reset the cart?')) {
            $.ajax({
                url: '/cart/reset',
                method: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    isPaymentConfirmed: false
                },
                success: function(response) {
                    clearCartUI();
                    window.location.reload(); // Reload to refresh product stock display
                },
                error: function(xhr) {
                    console.error("Error resetting cart:", xhr.responseText);
                    alert('Error resetting cart. Please try again.');
                }
            });
        }
    }

    function resetCart() {
        $.ajax({
            url: '/cart/reset',
            method: 'POST',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                // Clear cart UI
                $('#cart-table-body').empty();
                $('#grand-total').html('<strong>₱0.00</strong>');
                $('#cus-name').val('');
                $('#cus-phone').val('');

                // Only reload if stocks were updated
                if (response.stocksUpdated) {
                    window.location.reload();
                }
            },
            error: function(xhr) {
                console.error("Error resetting cart:", xhr.responseText);
            }
        });
    }

    function resetCart() {
        $.ajax({
            url: '/cart/reset',
            method: 'POST',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                // Clear the cart table
                $('#cart-table-body').empty();
                $('#grand-total').html('<strong>₱0.00</strong>');

                // Clear customer information
                $('#cus-name').val('');
                $('#cus-phone').val('');

                // Reload the page to refresh product stock display
                window.location.reload();
            },
            error: function(xhr) {
                console.error("Error resetting cart:", xhr.responseText);
            }
        });
    }

    // Rest of the existing functions remain the same...
    function generateReceiptID() {
        return Math.random().toString(36).substr(2, 9).toUpperCase();
    }

    function prepareReceipt() {
        const receiptID = generateReceiptID();
        document.getElementById('receiptID').innerText = receiptID;

        const date = new Date().toLocaleDateString();
        document.getElementById('receiptDate').innerText = date;

        const customerName = document.getElementById('cus-name').value || 'Unknown Customer';
        const customerPhone = document.getElementById('cus-phone').value || 'N/A';

        document.querySelector('.receipt-header .small-text:nth-child(2)').innerText = customerName;
        document.querySelector('.receipt-header .small-text:nth-child(3)').innerText = `Phone: ${customerPhone}`;

        let receiptContent = '';
        let grandTotal = 0;

        $('#cart-table-body tr').each(function() {
            const productName = $(this).find('td:nth-child(1)').text();
            const quantity = parseFloat($(this).find('input[id^="quantity-"]').val()) || 0;
            const price = parseFloat($(this).find('input[id^="price-"]').val()) || 0;
            const total = (quantity * price).toFixed(2);

            grandTotal += parseFloat(total);

            receiptContent += `
                <tr>
                    <td>${productName}</td>
                    <td class="text-end">${quantity}</td>
                    <td class="text-end">₱${price.toFixed(2)}</td>
                    <td class="text-end">₱${total}</td>
                </tr>
            `;
        });

        $('.receipt-items tbody').html(receiptContent);
        $('#grandTotal').text(`₱${grandTotal.toFixed(2)}`);

        $('#invoiceModal').modal('show');
    }

    function printReceipt() {
        const receiptContent = document.getElementById('receiptContent').cloneNode(true);
        const printWindow = window.open('', '_blank');

        const modalFooter = receiptContent.querySelector('.modal-footer');
        if (modalFooter) {
            modalFooter.remove();
        }

        printWindow.document.write(`
            <html>
                <head>
                    <title>Print Receipt</title>
                    <style>
                        body { font-family: Arial, sans-serif; margin: 0; padding: 0; }
                        .receipt-style { width: 100%; margin: 0 auto; padding: 20px; }
                        .receipt-header, .receipt-total { text-align: center; }
                        .receipt-items, .receipt-items th, .receipt-items td {
                            border-collapse: collapse;
                            width: 100%;
                            border: none;
                            padding: 8px;
                        }
                        .receipt-items th { text-align: left; }
                        .receipt-footer { text-align: center; font-size: 0.9em; color: #555; margin-top: 20px; }
                        img { max-width: 100px; }
                    </style>
                </head>
                <body>
                    <div class="receipt-style">${receiptContent.innerHTML}</div>
                </body>
            </html>
        `);

        printWindow.document.close();

        setTimeout(() => {
            printWindow.print();
            printWindow.close();
        }, 500);
    }
</script>

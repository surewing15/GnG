<!-- Include html2pdf.js Library -->
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
                <button type="button" class="btn btn-success" onclick="confirmPayment()"  onclick="resetCart()">Confirm Payment</button>
                <button type="button" class="btn btn-primary" onclick="printReceipt()">Print</button>
                <button type="button" class="btn btn-info" onclick="downloadPDF()">Download PDF</button>
            </div>
        </div>
    </div>
</div>

<script>
function generateReceiptID() {
    return Math.random().toString(36).substr(2, 9).toUpperCase(); // Example receipt ID generation
}

function prepareReceipt() {
    const receiptID = generateReceiptID();
    document.getElementById('receiptID').innerText = receiptID;

    const date = new Date().toLocaleDateString(); // Format date to be more readable
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

// Update the confirmPayment function to display ₱ sign and reset data after payment
function confirmPayment() {
    const receiptID = generateReceiptID();
    const customerName = document.querySelector('.receipt-header .small-text:nth-child(2)').innerText;
    const customerPhone = document.querySelector('.receipt-header .small-text:nth-child(3)').innerText.replace('Phone: ', '');
    const date = new Date().toISOString().split('T')[0];
    const totalAmount = parseFloat($('.receipt-total p').text().replace('Total: ₱', ''));

    let items = [];
    $('#cart-table-body tr').each(function() {
        const product_id = $(this).data('product-id');
        const kilos = parseFloat($(this).find('input[id^="quantity-"]').val());
        const pricePerKilo = parseFloat($(this).find('input[id^="price-"]').val());
        const total = kilos * pricePerKilo;

        if (product_id && !isNaN(kilos) && !isNaN(pricePerKilo) && !isNaN(total)) {
            items.push({
                product_id: product_id,
                kilos: kilos,
                price_per_kilo: pricePerKilo,
                total: total
            });
        }
    });

    function downloadPDF() {
    // Define the element you want to capture
    const element = document.getElementById('receiptContent');

    // Define PDF options
    const options = {
        margin:       0.5, // Margin in inches
        filename:     `Receipt_${new Date().toLocaleDateString().replace(/\//g, '-')}.pdf`,
        image:        { type: 'jpeg', quality: 0.98 },
        html2canvas:  { scale: 2 },
        jsPDF:        { unit: 'in', format: 'a4', orientation: 'portrait' }
    };

    // Generate the PDF and download
    html2pdf().set(options).from(element).save();
}



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
            printReceipt();
            alert('Payment confirmed and transaction saved successfully.');

            // Reset the receipt data
            resetReceiptData();
        },
        error: function(xhr, status, error) {
            console.error('Failed to save transaction:', error);
            alert('Failed to save transaction. Please try again.');
        }
    });
}

// Function to reset the receipt data

function resetReceiptData() {
    $.ajax({
        url: '{{ route('cart.reset') }}',
        method: 'POST',
        data: {
            _token: '{{ csrf_token() }}'
        },
        success: function(response) {
            // Clear the cart table
            $('#cart-table-body').empty();
            $('#grand-total').text('0.00'); // Reset grand total

            // Reset customer fields
            $('#cus-name').val('');
            $('#cus-phone').val('');
            $('#invoiceModal').modal('hide');

            // Notify the user
            alert(response.success);
        },
        error: function(xhr) {
            console.error("Error resetting cart:", xhr.responseText);
        }
    });
}




</script>

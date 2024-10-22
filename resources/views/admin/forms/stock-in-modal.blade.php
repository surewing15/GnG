<div class="modal fade" id="stockinModal" tabindex="-1" aria-labelledby="stockinModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="stockinModalLabel">Create Stocks</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">
                <form>
                    <!-- Customer Name -->
                    <div class="form-group mb-3">
                        <label class="form-label" for="full-name">Stock name</label>
                        <input type="text" name="cus_name" class="form-control" id="full-name" required>
                    </div>

                    <!-- Customer Address -->
                    <div class="form-group mb-3">
                        <label class="form-label" for="cus-address">Stock Category</label>
                        <input type="text" name="cus_address" class="form-control" id="cus-address" required>
                    </div>

                    <!-- Customer Email -->
                    <div class="form-group mb-3">
                        <label class="form-label" for="email">Stock Quantity</label>
                        <input type="email" name="cus_email" class="form-control" id="email" required>
                    </div>





                    <!-- Save Button -->
                    <div class="form-group">
                        <button type="submit" class="btn btn-lg btn-primary">Save Information</button>
                    </div>
                </form>
            </div>

            <!-- Modal Footer -->
            <div class="modal-footer bg-light">
                <span class="sub-text">Modal Footer Text</span>
            </div>
        </div>
    </div>
</div>

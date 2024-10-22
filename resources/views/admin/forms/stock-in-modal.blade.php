<div class="modal fade" id="stockinModal" tabindex="-1" aria-labelledby="stockinModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="stockinModalLabel">Create Stocks</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>


            <div class="modal-body">
                <form>
                    <div class="form-group mb-3">
                        <label class="form-label" for="stock-name">Stock name</label>
                        <select name="cus_name" class="form-control" id="stock-name" required>
                            <option value="">Select stock</option>
                            <option value="stock1">Stock 1</option>
                            <option value="stock2">Stock 2</option>
                            <option value="stock3">Stock 3</option>
                            <!-- Add more stock options here -->
                        </select>
                    </div>


                    {{-- <div class="form-group mb-3">
                        <label class="form-label" for="cus-address">Stock Category</label>
                        <input type="text" name="cus_address" class="form-control" id="cus-address" required>
                    </div> --}}

                    <div class="form-group mb-3">
                        <label class="form-label" for="email">Stock Quantity</label>
                        <input type="email" name="cus_email" class="form-control" id="email" required>
                    </div>

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

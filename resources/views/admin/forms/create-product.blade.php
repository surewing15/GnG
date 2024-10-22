<div class="nk-add-product toggle-slide toggle-slide-right" data-content="addProduct" data-toggle-screen="any" data-toggle-overlay="true" data-toggle-body="true" data-simplebar>
    <div class="nk-block-head">
        <div class="nk-block-head-content">
            <h5 class="nk-block-title">New Product</h5>
            <div class="nk-block-des">
                <p>Add information to create a new product.</p>
            </div>
        </div>
    </div>
    <!-- .nk-block-head -->
    <div class="nk-block">
        <form action="" method="">

            <div class="row g-3">
                <!-- Product Name -->
                <div class="col-12">
                    <div class="form-group">
                        <label class="form-label" for="p_name">Product Name</label>
                        <div class="form-control-wrap">
                            <input type="text" name="p_name" class="form-control" id="p_name" required>
                        </div>
                    </div>
                </div>


                <div class="col-md-12">
                    <div class="form-control-wrap">
                        <label class="form-label" for="p_category">SKU</label>
                        <div class="input-group">
                            <select class="form-select" name="p_category" id="p_category" required>
                                <option disabled selected>Select Category</option>

                            </select>
                            <div class="input-group-append">
                                <!-- Button to open modal to add SKU -->
                                <button type="button" data-bs-toggle="modal" data-bs-target="#skuModal" class="btn btn-outline-primary btn-dim">Add</button>
                                <button type="button"  class="btn btn-outline-primary btn-dim" id="deleteSkuBtn">Delete</button>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- Price -->
                <div class="col-mb-6">
                    <div class="form-group">
                        <label class="form-label" for="p_price">Price</label>
                        <div class="form-control-wrap">
                            <input type="number" step="0.01" name="p_price" class="form-control" id="p_price" required>
                        </div>
                    </div>
                </div>

                <!-- Quantity -->
                <div class="col-12">
                    <div class="form-group">
                        <label class="form-label" for="p_quantity">Quantity</label>
                        <div class="form-control-wrap">
                            <input type="number" name="p_quantity" class="form-control" id="p_quantity" required>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-control-wrap">
                        <label class="form-label" for="p_unit">Unit</label>
                        <div class="input-group">
                            <select class="form-select" name="p_unit" id="p_unit" required>
                                <option disabled selected>Select Unit</option>
                                <option value="">Bags</option>
                                <option value="">Heads</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Stock Alert -->
                <div class="col-12">
                    <div class="form-group">
                        <label class="form-label" for="p_stock_alert">Stock Alert</label>
                        <div class="form-control-wrap">
                            <input type="number" name="p_stock_alert" class="form-control" id="p_stock_alert" required>
                        </div>
                    </div>
                </div>

                <!-- Note -->
                <div class="col-12">
                    <div class="form-group">
                        <label class="form-label" for="p_note">Note</label>
                        <div class="form-control-wrap">
                            <textarea name="p_note" class="form-control" id="p_note"></textarea>
                        </div>
                    </div>
                </div>

                <!-- Image Upload -->
                <div class="col-12">
                    <div class="form-group">
                        <label class="form-label" for="p_image">Product Image</label>
                        <div class="upload-zone small bg-lighter my-2">
                            <input type="file" name="p_image" class="form-control" id="p_image" accept="image/*">
                            <div class="dz-message">
                                <span class="dz-message-text">Drag and drop a file or click to upload.</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="col-12">
                    <button type="submit" class="btn btn-primary"><em class="icon ni ni-plus"></em><span>Add New</span></button>
                </div>
            </div>
        </form>
    </div>
    <!-- .nk-block -->
</div>

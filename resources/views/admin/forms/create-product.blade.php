<div class="nk-add-product toggle-slide toggle-slide-right" data-content="addProduct" data-toggle-screen="any"
    data-toggle-overlay="true" data-toggle-body="true" data-simplebar>
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
        <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row g-3">

                <!-- Category Dropdown -->
                <!-- Category Dropdown -->
                <div class="col-12">
                    <div class="form-group">
                        <label class="form-label" for="p_category">Category</label>
                        <div class="form-control-wrap">
                            <select name="category" class="form-control" id="p_category" required>
                                @foreach ($categoryOptions as $category)
                                    <option value="{{ $category }}">{{ ucfirst(str_replace('_', ' ', $category)) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <!-- SKU Field -->
                <div class="col-12">
                    <div class="form-group">
                        <label class="form-label" for="p_sku">SKU</label>
                        <div class="form-control-wrap">
                            <input type="text" name="p_sku" class="form-control" id="p_sku" required>
                        </div>
                    </div>
                </div>
                @error('p_sku')
                    <span class="text-danger">{{ $message }}</span>
                @enderror


                @error('p_category')
                    <span class="text-danger">{{ $message }}</span>
                @enderror

                <!-- Product Image Upload -->
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
                    @error('p_image')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div class="col-12">
                    <button type="submit" class="btn btn-primary">
                        <em class="icon ni ni-plus"></em><span>Add New</span>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

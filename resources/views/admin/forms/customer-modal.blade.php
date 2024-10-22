  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="exampleModalLabel">Customer Info</h5>


                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

            </div>
            <!-- Modal Body -->
            <div class="modal-body">
                <form action="" method="" class="form-validate is-alter" novalidate="novalidate">
                    {{-- @csrf --}}
                    <!-- Full Name Field -->
                    <div class="form-group">
                        <label class="form-label" for="full-name">Customer Name</label>
                        <div class="form-control-wrap">
                            <input type="text" name="cus_name" class="form-control" id="full-name" required>
                        </div>
                    </div>
                    <!-- Customer Address Field -->
                    <div class="form-group">
                        <label class="form-label">Customer Address</label>
                        <div class="form-control-wrap">
                            <input type="text" name="cus_address" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                       <label class="form-label" for="email">Customer Email</label>
                       <div class="form-control-wrap">
                           <input type="email" name="cus_email" class="form-control" id="email" required>
                       </div>
                   </div>

                    <!-- Phone Number Field -->
                    <div class="form-group">
                        <label class="form-label" for="phone-no">Phone Number</label>
                        <div class="form-control-wrap">
                            <input type="text" name="cus_phonenumber" class="form-control" id="phone-no" required>
                        </div>
                    </div>
                           <!-- Phone Number Field -->


                    <!-- Save Button -->
                    <div class="form-group">
                        <button type="submit" class="btn btn-lg btn-primary">Save Information</button>&ensp;
                    </div>
                </form>
            </div>

            <!-- Modal Footer -->
            <div class="modal-footer bg-light">
                <span class="sub-text">Modal Footer Text</span>
            </div>

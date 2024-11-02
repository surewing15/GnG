<!-- Modal -->
<div class="modal fade" id="truckModal" tabindex="-1" role="dialog" aria-labelledby="truckModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">New Truck</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form action="">
                <div class="modal-body">
                    <div class="row mt-2 align-items-center">
                        <div class="col-lg-5">
                            <label class="form-label" for="truck_name">Truck Name <b class="text-danger">*</b></label>
                            <span class="form-note">Specify the Truck Name here.</span>
                        </div>
                        <div class="col-lg-7">
                            <div class="form-control-wrap">
                                <div class="form-icon form-icon-right">
                                    <em class="icon ni ni-info"></em>
                                </div>
                                <input type="text" class="form-control" id="truck_name" name="truck_name" placeholder="Enter Truck Name..">
                            </div>
                        </div>
                    </div>

                    <div class="row mt-2 align-items-center">
                        <div class="col-lg-5">
                            <label class="form-label" for="truck_type">Truck Type <b class="text-danger">*</b></label>
                            <span class="form-note">Specify the Truck Type here.</span>
                        </div>
                        <div class="col-lg-7">
                            <select class="form-select" id="truck_type" name="truck_type">
                                <option value="" style="text-transform: uppercase !important;">-- SELECT TRUCK TYPE --</option>
                                <!-- Add truck type options here -->
                                <option>Refrigerated Truck (Reefer)</option>
                                <option>Flatbed Truck</option>
                                <option>Box Truck</option>
                                <option>Tanker Truck</option>
                                <option>Pickup Truck</option>
                                <option>Car Carrier</option>
                                <option>Garbage Truck</option>
                                <option>Concrete Mixer</option>
                                <option>Logging Truck</option>
                                <option>Lowboy Trailer</option>
                                <option>Heavy Hauler</option>
                                <option>Tow Truck</option>
                                <option>In Maintenance</option>
                                <option>Utility Truck</option>
                                <option>Panel Truck</option>

                            </select>
                        </div>
                    </div>
                    <div class="row mt-2 align-items-center">
                        <div class="col-lg-5">
                            <label class="form-label" for="truck_type">Status<b class="text-danger">*</b></label>
                            <span class="form-note">Specify the Truck Type here.</span>
                        </div>
                        <div class="col-lg-7">
                            <select class="form-select" id="truck_type" name="truck_type">
                                <option value="" style="text-transform: uppercase !important;">-- SELECT TRUCK TYPE --</option>
                                <!-- Add truck type options here -->
                                <option>Available</option>
                                <option>Not Available</option>
                                <option>In Maintenance</option>

                            </select>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="reset" class="btn btn-light bg-white">
                        <em class="icon ni ni-repeat"></em> Reset
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <em class="icon ni ni-save"></em> Submit Record
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

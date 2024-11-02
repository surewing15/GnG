@extends('cashier.theme.layout')
@section('content')

<div class="card card-bordered w-100">
    <iframe src="https://www.google.com/maps/cagayan" class="google-map border-0" allowfullscreen="" loading="lazy"></iframe>
</div>;



<div class="card">
    <div class="card-inner">
        <div class="card-head">
            <h5 class="card-title">Trucking Info</h5>
        </div>
        {{-- <form action="{{ route('trucking.store') }}" method="POST"> --}}
            {{-- @csrf --}}
            <div class="row g-4">

                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="form-label">Select Driver</label>
                        <div class="form-control-wrap">
                            <select class="form-select js-select2">
                            <option selected>Select</option>
                            <option>Ernest</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="form-label">Select Helper</label>
                        <div class="form-control-wrap">
                            <select class="form-select js-select2">
                            <option selected>Select</option>
                            <option>Ernest</option>
                            </select>
                        </div>
                    </div>
                </div>


                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="form-label" for="pay-amount-1">Allowance</label>
                        <div class="form-control-wrap">
                            <input type="text" class="form-control" id="truck_allowance">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="form-label" for="pay-amount-1">Destination</label>
                        <div class="form-control-wrap">
                            <input type="text" class="form-control" id="truck_destination">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="form-label" for="pay-amount-1">Receipt ID#</label>
                        <div class="form-control-wrap">
                            <input type="text" class="form-control" id="cus_name">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="form-label" for="pay-amount-1">Customer Name</label>
                        <div class="form-control-wrap">
                            <input type="text" class="form-control" id="cus_name">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="form-label" for="pay-amount-1">Total Price</label>
                        <div class="form-control-wrap">
                            <input type="text" class="form-control" id="total_price">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="form-label" for="pay-amount-1">Total Kilo</label>
                        <div class="form-control-wrap">
                            <input type="text" class="form-control" id="total_kilo">
                        </div>
                    </div>
                </div>


              <!-- Trigger Button -->
              <div class="modal-footer">
                <button type="reset" class="btn btn-light bg-white">
                    <em class="icon ni ni-repeat"></em> Reset
                </button>
                <button type="submit" class="btn btn-primary">
                    <em class="icon ni ni-save"></em> Submit Record
                </button>
            </div>
            </div>
        {{-- </form> --}}
    </div>
</div>

@endsection

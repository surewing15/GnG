@extends('admin.theme.layout')
@section('content')
    <div class="nk-content">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title">Customers</h3>
                            </div><!-- .nk-block-head-content -->

                            <div class="nk-block-head-content">
                                <ul class="nk-block-tools g-3">
                                    <li class="nk-block-tools-opt">
                                        <!-- Buttons to trigger the modal -->
                                        <a href="#" class="btn btn-icon btn-primary d-md-none" data-bs-toggle="modal"
                                            data-bs-target="#exampleModal">
                                            <em class="icon ni ni-plus"></em>
                                        </a>
                                        <a href="#" class="btn btn-primary d-none d-md-inline-flex"
                                            data-bs-toggle="modal" data-bs-target="#exampleModal">
                                            <em class="icon ni ni-plus"></em><span>Add</span>
                                        </a>
                                        @include('admin.forms.customer-modal')
                                    </li>
                                </ul>
                                <div class="toggle-wrap nk-block-tools-toggle">
                                    <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1"
                                        data-bs-toggle="collapse" data-bs-target="#more-options">
                                        <em class="icon ni ni-more-v"></em>
                                    </a>
                                    <div class="collapse" id="more-options">
                                        <!-- Additional options can be added here -->
                                    </div>
                                </div>
                            </div><!-- .nk-block-head-content -->
                        </div><!-- .nk-block-between -->
                    </div><!-- .nk-block-head -->

                    <div class="nk-block nk-block-lg">
                        <div class="card card-bordered card-preview">
                            <div class="card-inner">
                                <table class="datatable-init-export nowrap table" data-export-title="Export">
                                    <thead>
                                        <tr>
                                            <th>Customer Name</th>
                                            <th>Customer Address</th>
                                            <th>Phone Number</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($customers as $customer)
                                            <tr>
                                                <td>{{ $customer->Cust_name }}</td>
                                                <td>{{ $customer->Cust_address }}</td>
                                                <td>{{ $customer->phone_number }}</td>
                                                <td>
                                                    <div class="dropdown">
                                                        <a href="#" class="dropdown-toggle btn btn-icon btn-trigger"
                                                            data-bs-toggle="dropdown" aria-expanded="false">
                                                            <em class="icon ni ni-more-h"></em>
                                                        </a>
                                                        <div class="dropdown-menu dropdown-menu-end"
                                                            style="position: absolute; inset: 0px 0px auto auto; margin: 0px;"
                                                            data-popper-placement="bottom-end">
                                                            <ul class="link-list-opt no-bdr">
                                                                <li><a href="{{ route('customers.edit', $customer->id) }}"><em
                                                                            class="icon ni ni-edit"></em><span>Edit
                                                                            Customer</span></a></li>
                                                                <li><a href="{{ route('customers.show', $customer->id) }}"><em
                                                                            class="icon ni ni-eye"></em><span>View
                                                                            Customer</span></a></li>
                                                                <li>
                                                                    <form
                                                                        action="{{ route('customers.destroy', $customer->id) }}"
                                                                        method="POST" style="display: inline;">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="submit" class="btn btn-link"><em
                                                                                class="icon ni ni-trash"></em><span>Delete
                                                                                Customer</span></button>
                                                                    </form>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div><!-- .card-preview -->
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h5 class="modal-title fw-bold" id="exampleModalLabel">Customer Info</h5>


                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>

                                </div>
                                <!-- Modal Body -->
                                <div class="modal-body">
                                    <form action="{{ route('customers.store') }}" method="POST"
                                        class="form-validate is-alter">
                                        @csrf
                                        <!-- Full Name Field -->
                                        <div class="form-group">
                                            <label class="form-label" for="full-name">Customer Name</label>
                                            <div class="form-control-wrap">
                                                <input type="text" name="cus_name" class="form-control" id="full-name"
                                                    required>
                                            </div>
                                        </div>
                                        <!-- Customer Address Field -->
                                        <div class="form-group">
                                            <label class="form-label">Customer Address</label>
                                            <div class="form-control-wrap">
                                                <input type="text" name="cus_address" class="form-control" required>
                                            </div>
                                        </div>

                                        <!-- Phone Number Field -->
                                        <div class="form-group">
                                            <label class="form-label" for="phone-no">Phone Number</label>
                                            <div class="form-control-wrap">
                                                <input type="text" name="cus_phonenumber" class="form-control"
                                                    id="phone-no" required>
                                            </div>
                                        </div>
                                        <!-- Save Button -->
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-lg btn-primary">Save
                                                Information</button>&ensp;
                                        </div>
                                    </form>

                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

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
                                        <a href="#" class="btn btn-icon btn-primary d-md-none" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                            <em class="icon ni ni-plus"></em>
                                        </a>
                                        <a href="#" class="btn btn-primary d-none d-md-inline-flex" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                            <em class="icon ni ni-plus"></em><span>Add</span>
                                        </a>
                                        @include('admin.forms.customer-modal')
                                    </li>
                                </ul>
                                <div class="toggle-wrap nk-block-tools-toggle">
                                    <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1" data-bs-toggle="collapse" data-bs-target="#more-options">
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
                                            <th>Customer Email</th>
                                            <th>Phone Number</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Ernestor</td>
                                            <td>jasaan Canada</td>
                                            <td>Ernestor@gamail.com</td>
                                            <td>09128884281</td>
                                            <td>
                                                <div class="dropdown">
                                                    <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <em class="icon ni ni-more-h"></em>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-end" style="position: absolute; inset: 0px 0px auto auto; margin: 0px;" data-popper-placement="bottom-end">
                                                        <ul class="link-list-opt no-bdr">
                                                            <li><a href="#"><em class="icon ni ni-edit"></em><span>Edit Customer</span></a></li>
                                                            <li><a href="#"><em class="icon ni ni-eye"></em><span>View Customer</span></a></li>
                                                            <li><a href="#"><em class="icon ni ni-trash"></em><span>Delete Customer</span></a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <!-- Additional rows can be added here -->
                                    </tbody>
                                </table>
                            </div>
                        </div><!-- .card-preview -->
                    </div> <!-- nk-block -->
                </div>
            </div>
        </div>
    </div>
@endsection

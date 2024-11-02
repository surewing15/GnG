@extends('cashier.theme.layout')

@section('content')
    <div class="nk-content">
        <div class="container-fluid">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="nk-block-head nk-block-head-sm">
                        <div class="nk-block-between">
                            <div class="nk-block-head-content">
                                <h3 class="nk-block-title page-title">Trucking List</h3>
                            </div>

                            {{-- <div class="nk-block-head-content">
                                <ul class="nk-block-tools g-3">
                                    <li class="nk-block-tools-opt">
                                        <!-- Buttons to navigate to another page -->
                                        <a href="/cashier/trucking/create" class="btn btn-icon btn-primary d-md-none">
                                            <em class="icon ni ni-plus"></em>
                                        </a>
                                        <a href="/cashier/trucking/create" class="btn btn-primary d-none d-md-inline-flex">
                                            <em class="icon ni ni-plus"></em><span>Create Trucking</span>
                                        </a>
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
                            </div> --}}
                        </div>
                    </div>

                    <div class="nk-block nk-block-lg">
                        <div class="card card-bordered card-preview">
                            <div class="card-inner">
                                <table class="datatable-init-export nowrap table" data-export-title="Export">
                                    <thead>
                                        <tr>
                                            <th>ID #</th>
                                            <th>Truck Name</th>
                                            <th>Truck Type</th>
                                            <th>Status</th>



                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>02103</td>
                                            <td>Thomas</td>
                                            <td>Truck (Ref)</td>
                                            <td>Available</td>


                                            <td>
                                                <div class="dropdown">
                                                    <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <em class="icon ni ni-more-h"></em>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <ul class="link-list-opt no-bdr">
                                                            <li>
                                                                <a href="#" data-bs-toggle="modal" data-bs-target="#truckModal">
                                                                    <em class="icon ni ni-file"></em><span>Invoice</span>
                                                                </a>
                                                            </li>

                                                            <li><a href="/cashier/trucking/create"><em class="icon ni ni-pen"></em><span>Assign</span></a></li>

                                                        </ul>
                                                    </div>
                                                </div>

                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('cashier.modal.trucking-receipt')
@endsection

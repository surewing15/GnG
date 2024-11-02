@extends('admin.theme.layout')
@section('content')

<div class="nk-content">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between d-flex justify-content-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Truck List</h3>
                        </div>
                       <!-- Add Driver Button -->
<div class="nk-block-tools ms-auto d-flex align-items-center">
    <ul class="nk-block-tools g-3 mb-0">
        <li class="nk-block-tools-opt">
            <a href="#" data-bs-toggle="modal" data-bs-target="#truckModal" class="btn btn-icon btn-primary d-md-none">
                <em class="icon ni ni-plus"></em>
            </a>
            <a href="#" data-bs-toggle="modal" data-bs-target="#truckModal" class="btn btn-primary d-none d-md-inline-flex">
                <em class="icon ni ni-plus"></em><span>Add Truck</span>
            </a>
        </li>
    </ul>
</div>
@include('admin.forms.create-truck-modal')
                    </div><!-- .nk-block-between -->
                </div><!-- .nk-block-head -->

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
                                        <td>#1231</td>
                                        <td>Ramini</td>
                                        <td>Forward</td>
                                        <td>Available</td>
                                        <td>
                                            <div class="dropdown">
                                                <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <em class="icon ni ni-more-h"></em>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <ul class="link-list-opt no-bdr">
                                                        <li><a href="#"><em class="icon ni ni-eye"></em><span>View</span></a></li>
                                                        <li><a href="#"><em class="icon ni ni-pen"></em><span>Edit</span></a></li>
                                                        <li><a href="#"><em class="icon ni ni-trash"></em><span>Delete</span></a></li>
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

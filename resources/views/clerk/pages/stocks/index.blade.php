@extends('clerk.theme.layout')
@section('content')


<div class="nk-block nk-block-lg">
    <div class="nk-block-head d-flex justify-content-between align-items-center">
        <div class="nk-block-head-content">
            <h4 class="nk-block-title">Stocks</h4>
        </div>


        <div class="nk-block-tools-opt">
            <a href="#" data-bs-toggle="modal" data-bs-target="#stockinModal" class="toggle btn btn-icon btn-primary d-md-none">
                <em class="icon ni ni-plus"></em>
            </a>
            <a href="#" data-bs-toggle="modal" data-bs-target="#stockinModal" class="toggle btn btn-primary d-none d-md-inline-flex">
                <em class="icon ni ni-plus"></em><span>Stock In</span>
            </a>
        </div>


    </div>

    <div class="card card-bordered card-preview">
        <div class="card-inner">
            <table class="datatable-init-export nowrap table" data-export-title="Export">

                <thead>
                    <tr>
                        <th>Item Code (SKU)</th>
                        <th>Description</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Action</th>


                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>00321</td>
                        <td>00321</td>
                        <td>00223</td>
                        <td>00223</td>
                        <td> <div class="dropdown">
                            <a href="#" class="dropdown-toggle btn btn-icon btn-trigger" data-bs-toggle="dropdown"><em class="icon ni ni-more-h"></em></a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <ul class="link-list-opt no-bdr">
                                    <li><a href="#"><em class="icon ni ni-eye"></em><span>View</span></a></li>
                                    <li><a href="#"><em class="icon ni ni-edit"></em><span>Edit</span></a></li>


                                </ul>
                            </div>
                        </div></td>


                    </tr>

                </tbody>
            </table>
        </div>
    </div><!-- .card-preview -->
</div> <!-- nk-block -->
@include('clerk.modal.stock-in-modal');
@endsection


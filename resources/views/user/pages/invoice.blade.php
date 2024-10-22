@extends('user.theme.layout')

@section('content')

<div class="nk-content-inner">
    <div class="nk-content-body">
        <div class="nk-block-head">
            <div class="nk-block-between g-3">
                <div class="nk-block-head-content">
                    <h3 class="nk-block-title page-title">Invoice <strong class="text-primary small">#746F5K2</strong></h3>
                    <div class="nk-block-des text-soft">
                        <ul class="list-inline">
                            <li>Created At: <span class="text-base">18 Dec, 2019 01:02 PM</span></li>
                        </ul>
                    </div>
                </div>
                <div class="nk-block-head-content">
                    <a href="html/invoice-list.html" class="btn btn-outline-light bg-white d-none d-sm-inline-flex"><em class="icon ni ni-arrow-left"></em><span>Back</span></a>
                    <a href="html/invoice-list.html" class="btn btn-icon btn-outline-light bg-white d-inline-flex d-sm-none"><em class="icon ni ni-arrow-left"></em></a>
                </div>
            </div>
        </div><!-- .nk-block-head -->
        <div class="nk-block">
            <div class="invoice">
                <div class="invoice-action">
                    <a class="btn btn-icon btn-lg btn-white btn-dim btn-outline-primary" href="html/invoice-print.html" target="_blank"><em class="icon ni ni-printer-fill"></em></a>
                </div><!-- .invoice-actions -->
                <div class="invoice-wrap">
                    <div class="invoice-brand text-center">
                        <img src="./images/logo-dark.png" srcset="./images/logo-dark2x.png 2x" alt="">
                    </div>
                    <div class="invoice-head">
                        <div class="invoice-contact">
                            <span class="overline-title">Invoice To</span>
                            <div class="invoice-contact-info">
                                <h4 class="title">Ernestor</h4>
                                <ul class="list-plain">
                                    <li><em class="icon ni ni-map-pin-fill"></em><span>House #65, 4328 Marion Street<br>Newbury, VT 05051</span></li>
                                    <li><em class="icon ni ni-call-fill"></em><span>+012 8764 556</span></li>
                                </ul>
                            </div>
                        </div>
                        <div class="invoice-desc">
                            <h3 class="title">Invoice</h3>
                            <ul class="list-plain">
                                <li class="invoice-id"><span>Invoice ID</span>:<span>66K5W3</span></li>
                                <li class="invoice-date"><span>Date</span>:<span>26 Jan, 2020</span></li>
                            </ul>
                        </div>
                    </div><!-- .invoice-head -->
                    <div class="invoice-bills">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th class="w-150px">Item Code (SKU)</th>
                                        <th class="w-60">Description</th>
                                        <th>Price</th>
                                        <th>Qty</th>
                                        <th>Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>P1</td>
                                        <td>Chicken Breast</td>
                                        <td>$40.00</td>
                                        <td>5</td>
                                        <td>$200.00</td>
                                    </tr>
                                    <tr>
                                        <td>24108054</td>
                                        <td>Chicken Legs</td>
                                        <td>$25.00</td>
                                        <td>1</td>
                                        <td>$25.00</td>
                                    </tr>
                                    <tr>
                                        <td>P2</td>
                                        <td>Chicken Head</td>
                                        <td>$131.25</td>
                                        <td>1</td>
                                        <td>$131.25</td>
                                    </tr>
                                    <tr>
                                        <td>P3</td>
                                        <td>Eggs</td>
                                        <td>$78.75</td>
                                        <td>1</td>
                                        <td>$78.75</td>
                                    </tr>
                                </tbody>
                                <tfoot>


                                    <tr>
                                        <td colspan="2"></td>
                                        <td colspan="2">Total Amount</td>
                                        <td>$478.50</td>
                                    </tr>
                                </tfoot>
                            </table>
                            <div class="nk-notes ff-italic fs-12px text-soft"> Invoice was created on a computer and is valid without the signature and seal. </div>
                        </div>
                    </div><!-- .invoice-bills -->
                </div><!-- .invoice-wrap -->
            </div><!-- .invoice -->
        </div><!-- .nk-block -->
    </div>
</div>
@endsection

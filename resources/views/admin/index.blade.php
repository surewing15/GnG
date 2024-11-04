@extends('admin.theme.layout')
@section('content')
    <div class="nk-content-inner">
        <div class="nk-content-body">
            <div class="nk-block-head nk-block-head-sm">
                <div class="nk-block-between">
                    <div class="nk-block-head-content">
                        <h3 class="nk-block-title page-title">Dashboard</h3>
                    </div>
                    <div class="nk-block-head-content">
                        <div class="toggle-wrap nk-block-tools-toggle">
                            <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1" data-target="pageMenu">
                                <em class="icon ni ni-more-v"></em>
                            </a>
                            <div class="toggle-expand-content" data-content="pageMenu"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="nk-block">
                <div class="row g-gs">

                    <!-- Total Sales Card -->
                    <div class="col-xxl-4 col-md-6">
                        <div class="card is-dark h-100">
                            <div class="nk-ecwg nk-ecwg1">
                                <div class="card-inner">
                                    <div class="card-title-group">
                                        <div class="card-title">
                                            <h6 class="title">Total Sales</h6>
                                        </div>
                                    </div>
                                    <div class="data">
                                        <div class="amount" id="total-sales-amount">₱{{ number_format($totalSales, 2) }}</div>
                                        <div class="info">
                                            <strong>₱{{ number_format($salesData['last_month_sales'], 2) }}</strong> in last month
                                        </div>
                                    </div>
                                    <div class="data">
                                        <h6 class="sub-title">This week so far</h6>
                                        <div class="data-group">
                                            <div class="amount" id="this-week-sales">₱{{ number_format($salesData['this_week_sales'], 2) }}</div>
                                            <div class="info text-end">
                                                <span class="change up text-danger" id="percentage-change">
                                                    <em class="icon ni ni-arrow-long-up"></em>{{ number_format($salesData['percentage_change'], 2) }}%
                                                </span><br>
                                                <span>vs. last week</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="nk-ecwg1-ck">
                                    <canvas class="ecommerce-line-chart-s1 chartjs-render-monitor" id="totalSales" width="479" height="110"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>




                    <!-- Customers Card -->
                    <div class="col-xxl-4">
                        <div class="row g-gs">
                            <div class="col-xxl-12 col-md-6">
                                <div class="card">
                                    <div class="nk-ecwg nk-ecwg3">
                                        <div class="card-inner pb-0">
                                            <div class="card-title-group">
                                                <div class="card-title">
                                                    <h6 class="title">Customers</h6>
                                                </div>
                                            </div>
                                            <div class="data">
                                                <div class="data-group">
                                                    <div class="amount">{{ $totalCustomerCount }}</div>
                                                    <div class="info text-end">
                                                        <span class="change up text-danger">
                                                            <em class="icon ni ni-arrow-long-up"></em>{{ $percentageChange }}%
                                                        </span><br>
                                                        <span>vs. last week</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="nk-ecwg3-ck">
                                            <canvas class="ecommerce-line-chart-s1 chartjs-render-monitor" id="totalCustomers" width="1054" height="132"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

<!-- Less Card -->
<div class="col-xxl-3 col-md-6">
    <div class="card h-100">
        <div class="card-inner">
            <div class="card-title-group mb-2">
                <div class="card-title">
                    <h6 class="title">Less</h6>
                </div>
            </div>
            <ul class="nk-store-statistics">
                <li class="item">
                    <div class="info">
                        <div class="title">Deposit Truchef Partial</div>
                        <div class="count">1,795</div>
                    </div>
                    <em class="icon bg-primary-dim ni ni-bag"></em>
                </li>
                <li class="item">
                    <div class="info">
                        <div class="title">Credit/Bal</div>
                        <div class="count">674</div>
                    </div>
                    <em class="icon bg-pink-dim ni ni-box"></em>
                </li>
                <li class="item">
                    <div class="info">
                        <div class="title">Total Less</div>
                        <div class="count">10200</div>
                    </div>
                    <em class="icon bg-purple-dim ni ni-server"></em>
                </li>
            </ul>
        </div>
    </div>
</div>


                    <!-- Expenses Card -->
                    <div class="col-xxl-4 col-md-8 col-lg-6">
                        <div class="card h-100">
                            <div class="card-inner">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h6 class="title">Expenses</h6>
                                    <a href="#" class="text-decoration-none">Amount</a>
                                </div>
                                <div class="mb-3">
                                    <a href="#" class="text-decoration-none">Description</a>
                                </div>
                                <ul class="list-unstyled">
                                    @foreach ($expenses as $expense)
                                        <li class="d-flex justify-content-between align-items-center py-2 border-bottom">
                                            <div class="info">
                                                <div class="fw-bold">{{ $expense->e_description }}</div>
                                            </div>
                                            <div class="total text-end">
                                                <div class="fw-bold">₱{{ number_format($expense->e_amount, 2) }}</div>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>


                    <!-- Sales Table -->
                    <div class="col-xxl-8">
                        <div class="card card-full">
                            <div class="card-inner">
                                <div class="card-title-group">
                                    <div class="card-title">
                                        <h6 class="title">Sales</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive mt-2">
                                <table class="table table-hover align-middle">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Customer Name</th>
                                            <th>Series #</th>
                                            <th>Cash Sales</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($customers as $customer)
                                            <tr>
                                                <td>{{ $customer->customer_name }}</td>
                                                <td>{{ $customer->receipt_id ?? 'N/A' }}</td>
                                                <td>{{ number_format($customer->total_amount ?? 0, 2) }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

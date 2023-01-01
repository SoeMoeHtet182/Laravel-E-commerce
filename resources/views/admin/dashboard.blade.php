@extends('admin.layout.master')
{{-- For Page titles --}}
@section('pageTitle', 'Dashboard')
{{-- For Main View --}}
@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-uppercase font-weight-bold text-nowrap">
                                        Today's Income
                                    </p>
                                    <h5 class="font-weight-bolder">${{ $todayIncome }}</h5>
                                    <p class="mb-0">
                                        @if ($incomePercent > 0)
                                            <span
                                                class="text-success text-sm font-weight-bolder">+{{ $incomePercent }}%</span>
                                        @else
                                            <span
                                                class="text-danger text-sm font-weight-bolder">{{ $incomePercent }}%</span>
                                        @endif
                                        since yesterday
                                    </p>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                                    <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-uppercase font-weight-bold text-nowrap">
                                        Today's Outcome
                                    </p>
                                    <h5 class="font-weight-bolder">${{ $todayOutcome }}</h5>
                                    <p class="mb-0">
                                        @if ($outcomePercent > 0)
                                            <span class="text-danger text-sm font-weight-bolder">+
                                                {{ $outcomePercent }}%</span>
                                        @else
                                            <span class="text-success text-sm font-weight-bolder">
                                                {{ $outcomePercent }}%</span>
                                        @endif
                                        than yesterday
                                    </p>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-danger shadow-primary text-center rounded-circle">
                                    <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">
                                        Today's Users
                                    </p>
                                    <h5 class="font-weight-bolder">{{ $currentWeekUsers }}</h5>
                                    <p class="mb-0">
                                        @if ($usersPercent > 0)
                                            <span
                                                class="text-success text-sm font-weight-bolder">+{{ $usersPercent }}%</span>
                                        @else
                                            <span
                                                class="text-danger text-sm font-weight-bolder">-{{ $usersPercent }}%</span>
                                        @endif
                                        since last week
                                    </p>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-success shadow-danger text-center rounded-circle">
                                    <i class="ni ni-world text-lg opacity-10" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">
                                        Sales
                                    </p>
                                    <h5 class="font-weight-bolder">${{ $sale }}</h5>
                                    <p class="mb-0">
                                        @if ($salePercent > 0)
                                            <span
                                                class="text-success text-sm font-weight-bolder">+{{ $salePercent }}%</span>
                                        @else
                                            <span
                                                class="text-danger text-sm font-weight-bolder">-{{ $salePercent }}%</span>
                                        @endif
                                        than last month
                                    </p>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-warning shadow-warning text-center rounded-circle">
                                    <i class="ni ni-cart text-lg opacity-10" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-lg-6 mb-lg-0 mb-4">
                <div class="card z-index-2 h-100">
                    <div class="card-header pb-0 pt-3 bg-transparent">
                        <h6 class="text-capitalize">Sales overview</h6>
                        <p class="text-sm mb-0">
                            @if ($lastSixMonthsAgoPercent > 0)
                                <i class="fa fa-arrow-up text-success"></i>
                                <span class="font-weight-bold text-success">{{ $lastSixMonthsAgoPercent }}% more</span>
                                than last 6
                                months
                            @else
                                <i class='fa fa-arrow-down text-danger'></i>
                                <span class="font-weight-bold text-danger">{{ $lastSixMonthsAgoPercent }}% less</span> than
                                last 6
                                months
                            @endif
                        </p>
                    </div>
                    <div class="card-body p-3">
                        <div class="chart">
                            <canvas id="saleChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 mb-lg-0 mb-4">
                <div class="card z-index-2 h-100">
                    <div class="card-header pb-0 pt-3 bg-transparent">
                        <h6 class="text-capitalize">Income/Outcome overview</h6>
                        <p class="text-sm mb-0"></p>
                    </div>
                    <div class="card-body p-3">
                        <div class="chart">
                            <canvas id="income-outcomeChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-lg-7 mb-lg-0 mb-4">
                <div class="card">
                    <div class="card-header pb-0 p-3">
                        <div class="d-flex justify-content-between">
                            <h6 class="mb-2">Products Sale</h6>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="chart">
                            <canvas id="categoryChart"></canvas>
                        </div>
                    </div>
                </div>
                <div class="chart">
                    <canvas id="productChart"></canvas>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="card">
                    <div class="card-header pb-0 p-3">
                        <h6 class="mb-0">Categories</h6>
                    </div>
                    <div class="card-body p-3">
                        <ul class="list-group">
                            @foreach ($categories as $category)
                                <a href="{{ url('/admin?category_id=' . $category->id) }}">
                                    <li
                                        class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                                        <div class="d-flex align-items-center">
                                            <div class="icon icon-shape icon-sm me-3 bg-gradient-dark shadow text-center">
                                                <i class="ni ni-mobile-button text-white opacity-10"></i>
                                            </div>
                                            <div class="d-flex flex-column">
                                                <h6 class="mb-1 text-dark text-sm">{{ $category->name }}</h6>
                                                <span class="text-xs">{{ $category->product_count }} in stock,
                                                    <span class="font-weight-bold">
                                                        @foreach ($category->product as $p)
                                                            <?php $soldItems[] = intval($p->soldAmount); ?>
                                                        @endforeach
                                                        + {{ array_sum($soldItems) }} sold
                                                        <?php $soldItems = []; ?>
                                                    </span>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="d-flex">
                                            <button
                                                class="btn btn-link btn-icon-only btn-rounded btn-sm text-dark icon-move-right my-auto">
                                                <i class="ni ni-bold-right" aria-hidden="true"></i>
                                            </button>
                                        </div>
                                    </li>
                                </a>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        //sale chart starts
        const ctx = document.getElementById('saleChart');

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: @json($months),
                datasets: [{
                    label: '# Sales in one month',
                    data: @json($saleData),
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
        //end here saleChart
        //income-outcome Chart starts
        const icChart = document.getElementById('income-outcomeChart');

        new Chart(icChart, {
            type: 'bar',
            data: {
                labels: @json($days),
                datasets: [{
                    label: '# Income',
                    data: @json($incomeData),
                    borderWidth: 1
                }, {
                    label: '# Outcome',
                    data: @json($outcomeData),
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
        //end here income-coutcome Chart
        //productChart starts
        const cChart = document.getElementById('categoryChart');

        new Chart(cChart, {
            type: 'line',
            data: {
                labels: @json($months),
                datasets: [{
                    label: @if (request()->category_id)
                        @foreach ($categories as $c)
                            @if ($c->id == request()->category_id)
                                "# " + JSON.stringify(@json($c->name)) +
                                    " sale in one month"
                            @endif
                        @endforeach
                    @else
                        "# Product sale in one month"
                    @endif ,
                    data: @json($productData),
                    backgroundColor: '#07f507',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
            }
        });
        const pChart = document.getElementById('productChart');

        new Chart(pChart, {
            type: 'pie',
            data: {
                labels: @json($products).map(k => k.name),
                datasets: [{
                    label: 'Sale in current month',
                    data: @json($dataForProducts),
                }]
            },
        });
        console.log(@json($dataForProducts))
    </script>
@endsection

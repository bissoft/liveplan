@php
use Carbon\Carbon;
@endphp
@extends('layouts.admin')
@section('content')
    <div class="container-fluid">
        <div class="card">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="card-header page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0">Create Direct Cost</h4>
                    </div>
                </div>
            </div>
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            <div class="card-body">
                <div class="revanu">
                    <div class="mt-4">
                        <div class="wizard">
                            <form role="form" id="quickForm" action="{{ route('admin.direct-cost.store') }}" method="post"
                                enctype="multipart/form-data" class="login-box">
                                @csrf
                                <div class="tab-content" id="main_form">
                                    <div class="tab-pane active" role="tabpanel" id="step1">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1" class="mb-2">What do you want to call
                                                it?</label>
                                            <input type="text" name="name" value="{{ old('name') }}"
                                                class="form-control" id="" aria-describedby="emailHelp"
                                                placeholder="Enter Name or discription" required>

                                        </div>
                                    </div>
                                    <div class="mt-3">
                                        <h6 class="font-weight-bold">What sort of cost is this?</h6>
                                        <p>If you break down your direct costs by revenue stream, rather than just entering
                                            them as overall costs, you can see how profitable each revenue stream is.</p>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" checked name="cost" value="0"
                                                onclick="Cost()">
                                            <label class="form-check-label" for="inlineRadio1">General Cost</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" onclick="Cost1()" name="cost"
                                                value="1">
                                            <label class="form-check-label" for="inlineRadio2">Cost for a specific revenue
                                                stream</label>
                                        </div>
                                    </div>
                                    {{-- Revenue Cost Tab --}}
                                    <div class="mt-3" id="revenue_cost_tab">
                                        <h6 class="font-weight-bold">Which revenue stream?</h6>
                                        <div class="form-check form-check-inline">
                                            <select name="revenue_id" class="form-control" id="">
                                                @foreach ($revenue as $item)
                                                    <option value="{{ $item->id ?? '' }}">{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    {{-- General_cost_tab --}}
                                    <div class="mt-3" id="general_cost_tab">
                                        <h6 class="font-weight-bold">How much will it cost?</h6>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" checked name="constant" value="0"
                                                onclick="step1_constant()">
                                            <label class="form-check-label" for="inlineRadio1">Constant
                                                amount</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" onclick="step1_varying()"
                                                name="constant" value="1">
                                            <label class="form-check-label" for="inlineRadio2">Varying amounts over
                                                time</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" onclick="step1_overall()"
                                                name="constant" value="2">
                                            <label class="form-check-label" for="inlineRadio2">% of overall revenue</label>
                                        </div>
                                        <div id="step1_constant">
                                            <div class="row align-items-center mt-3">
                                                <div class="col-12 col-md-6 ">
                                                    <input class="form-control" type="number" name="cost_amount"
                                                        value="{{ old('cost_amount') }}" placeholder="$">
                                                </div>
                                                <div class="col-12 col-md-2 text-center">Per</div>
                                                <div class="col-12 col-md-4">
                                                    <div class="form-group">
                                                        <select class="form-control" name="cost_amount_type"
                                                            id="exampleFormControlSelect1">
                                                            <option value="0">Month</option>
                                                            <option value="1">Year</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-12 col-md-6">
                                                    <label for="exampleFormControlSelect1"><b>When will it
                                                            start?</b></label>
                                                    <select class="form-control" name="cost_amount_start"
                                                        id="exampleFormControlSelect1">
                                                        @for ($i = 0; $i < 12; $i++)
                                                            <option
                                                                value="{{ Carbon::now()->addMonth($i)->format('M Y') }}">
                                                                {{ Carbon::now()->addMonth($i)->format('M Y') }}</option>
                                                        @endfor
                                                        @for ($i = 2; $i < 6; $i++)
                                                            <option value="{{ Carbon::now()->addYear($i)->format('Y') }}">
                                                                FY{{ Carbon::now()->addYear($i)->format('Y') }}</option>
                                                        @endfor
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="varning-amount mt-3" id="step1_varying">
                                            <h4>FY{{ Carbon::now()->format('Y') }}</h4>
                                            <canvas id="cost_month_chart" style="max-height:350px;"></canvas>
                                            <div class="cahrt-value">
                                                @for ($i = 0; $i < 12; $i++)
                                                    <div class="input-filed">
                                                        <label
                                                            for="">{{ Carbon::now()->addMonth($i)->format('M Y') }}</label>
                                                        <input type="number" class="form-control"
                                                            name="cost_month{{ $i }}"
                                                            id="cost_month{{ $i }}">
                                                    </div>
                                                @endfor
                                                <div class="input-filed">
                                                    <label for="">Total</label>
                                                    <input type="number" class="form-control" name="cost_month_total"
                                                        id="cost_month_total">
                                                </div>
                                            </div>
                                            <div class="cahrt-value">
                                                @for ($i = 2; $i < 6; $i++)
                                                    <div class="input-filed">
                                                        <label
                                                            for="">FY{{ Carbon::now()->addYear($i)->format('Y') }}</label>
                                                        <input type="number" class="form-control"
                                                            name="cost_year{{ $i }}">
                                                    </div>
                                                @endfor
                                            </div>
                                        </div>
                                        <div id="step1_overall">
                                            <div class="row align-items-center mt-3">
                                                <div class="col-12 col-md-6 ">
                                                    <label for="">What percentage of overall revenue?</label>
                                                    <input class="form-control" type="number"
                                                        name="constant_overall_amount"
                                                        value="{{ old('constant_overall_amount') }}" placeholder="%">
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <label for="exampleFormControlSelect1"><b>When will it
                                                            start?</b></label>
                                                    <select class="form-control" name="constant_overall_start"
                                                        id="exampleFormControlSelect1">
                                                        @for ($i = 0; $i < 12; $i++)
                                                            <option
                                                                value="{{ Carbon::now()->addMonth($i)->format('M Y') }}">
                                                                {{ Carbon::now()->addMonth($i)->format('M Y') }}</option>
                                                        @endfor
                                                        @for ($i = 2; $i < 6; $i++)
                                                            <option
                                                                value="{{ Carbon::now()->addYear($i)->format('Y') }}">
                                                                FY{{ Carbon::now()->addYear($i)->format('Y') }}</option>
                                                        @endfor
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 text-center">
                    <button type="submit" class="btn btn-primary mt-4"> SAVE</button>
                </div>
            </div>
            </form>
        </div>
    </div>
    <!-- end page title -->
@endsection
@section('scripts')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
    <script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>


    <script type="text/javascript">
        function step1_constant() {
            document.getElementById('step1_constant').style.display = 'block';
            document.getElementById('step1_varying').style.display = 'none';
            document.getElementById('step1_overall').style.display = 'none';

        }

        function step1_varying() {
            document.getElementById('step1_constant').style.display = 'none';
            document.getElementById('step1_varying').style.display = 'block';
            document.getElementById('step1_overall').style.display = 'none';

        }

        function step1_overall() {
            document.getElementById('step1_constant').style.display = 'none';
            document.getElementById('step1_varying').style.display = 'none';
            document.getElementById('step1_overall').style.display = 'block';

        }

        function step2_constant() {
            document.getElementById('step2_constant').style.display = 'block';
            document.getElementById('step2_varying').style.display = 'none';

        }

        function step2_varying() {
            document.getElementById('step2_constant').style.display = 'none';
            document.getElementById('step2_varying').style.display = 'block';

        }


        function Cost() {
            document.getElementById('general_cost_tab').style.display = 'block';
            document.getElementById('revenue_cost_tab').style.display = 'none';

        }

        function Cost1() {
            document.getElementById('revenue_cost_tab').style.display = 'block';

        }
    </script>
    @php
    $varying_month = [];
    $varying_month[] = 'Data';
    for ($i = 0; $i < 12; $i++) {
        $varying_month[] = Carbon::now()
            ->addMonth($i)
            ->format('M Y');
    }
    @endphp
    <script type="text/javascript">
        // ------------step-wizard-------------
        $(document).ready(function() {

            document.getElementById('revenue_cost_tab').style.display = 'none';


            document.getElementById('step1_varying').style.display = 'none';
            document.getElementById('step1_overall').style.display = 'none';
            document.getElementById('step2_varying').style.display = 'none';
        });
        //Cost Month calculate

        $("#cost_month0,#cost_month1,#cost_month2,#cost_month3,#cost_month4,#cost_month5,#cost_month6,#cost_month7,#cost_month8,#cost_month9,#cost_month10,#cost_month11")
            .keyup(function() {
                var cost_month0 = $('#cost_month0').val();
                var cost_month1 = $('#cost_month1').val();
                var cost_month2 = $('#cost_month2').val();
                var cost_month3 = $('#cost_month3').val();
                var cost_month4 = $('#cost_month4').val();
                var cost_month5 = $('#cost_month5').val();
                var cost_month6 = $('#cost_month6').val();
                var cost_month7 = $('#cost_month7').val();
                var cost_month8 = $('#cost_month8').val();
                var cost_month9 = $('#cost_month9').val();
                var cost_month10 = $('#cost_month10').val();
                var cost_month11 = $('#cost_month11').val();
                $('#cost_month_total').val((cost_month0 * 1) + (cost_month1 * 1) + (
                        cost_month2 * 1) + (cost_month3 * 1) +
                    (cost_month4 * 1) + (cost_month5 * 1) + (cost_month6 * 1) + (
                        cost_month7 * 1) + (cost_month8 * 1) + (cost_month9 * 1) + (
                        cost_month10 * 1) + (cost_month11 * 1));

                // cost Month Chart
                var ctx = document.getElementById('cost_month_chart').getContext("2d");
                var myChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: <?php echo json_encode($varying_month); ?>,
                        datasets: [{
                            label: "Data",
                            borderColor: "#80b6f4",
                            pointBorderColor: "#80b6f4",
                            pointBackgroundColor: "#80b6f4",
                            pointHoverBackgroundColor: "#80b6f4",
                            pointHoverBorderColor: "#80b6f4",
                            pointBorderWidth: 10,
                            pointHoverRadius: 10,
                            pointHoverBorderWidth: 1,
                            pointRadius: 3,
                            fill: false,
                            borderWidth: 4,
                            data: [0, $('#cost_month0').val(), $('#cost_month1').val(),
                                $('#cost_month2').val(), $('#cost_month3').val(),
                                $('#cost_month4').val(), $('#cost_month5').val(),
                                $('#cost_month6').val(), $('#cost_month7').val(),
                                $('#cost_month8').val(), $('#cost_month9').val(),
                                $('#cost_month10').val(), $('#cost_month11').val()
                            ]
                        }]
                    },
                    options: {
                        legend: {
                            position: "bottom"
                        },
                        scales: {
                            yAxes: [{
                                ticks: {
                                    fontColor: "rgba(0,0,0,0.5)",
                                    fontStyle: "bold",
                                    beginAtZero: true,
                                    maxTicksLimit: 5,
                                    padding: 20
                                },
                                gridLines: {
                                    drawTicks: false,
                                    display: false
                                }

                            }],
                            xAxes: [{
                                gridLines: {
                                    zeroLineColor: "transparent"
                                },
                                ticks: {
                                    padding: 20,
                                    fontColor: "rgba(0,0,0,0.5)",
                                    fontStyle: "bold"
                                }
                            }]
                        }
                    }
                });
            });
    </script>
@endsection

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
                        <h4 class="mb-0">Create Personnel</h4>
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
                            <form role="form" id="quickForm" action="{{ route('admin.personnel.store') }}" method="post"
                                enctype="multipart/form-data" class="login-box">
                                @csrf
                                <div class="tab-content" id="main_form">
                                    <div class="tab-pane active" role="tabpanel" id="step1">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1" class="mb-2">What do you want to call them?</label>
                                            <input type="text" name="name" value="{{ old('name') }}"
                                                class="form-control" id="" aria-describedby="emailHelp"
                                                placeholder="Enter Name or discription" required>

                                        </div>
                                    <div class="mt-3">
                                        <h6 class="font-weight-bold">Is this an individual employee or a group?</h6>
                                        <p>Use the group option only for similar employees with the same start date. If you are filling the same role at multiple points in time, enter those hires individually with their own start dates.</p>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" checked name="employee_type" value="0"
                                                onclick="Employee_type1()">
                                            <label class="form-check-label" for="inlineRadio1">Individual
                                            </label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" onclick="Employee_type2()" name="employee_type"
                                                value="1">
                                            <label class="form-check-label" for="inlineRadio2">Group of employees</label>
                                        </div>
                                    </div>
                                    
                                    </div>
                                    
                                    {{-- Group Employee Tab --}}
                                    <div class="mt-3" id="group_employee_tab">
                                        <h6 class="font-weight-bold">How many employees are in this group?</h6>
                                        <p>Enter the quantity in full-time equivalents (FTEs).</p>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" checked name="group_constant" value="0"
                                                onclick="step1_constant()">
                                            <label class="form-check-label" for="inlineRadio1">Constant
                                                numbers</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" onclick="step1_varying()"
                                                name="group_constant" value="1">
                                            <label class="form-check-label" for="inlineRadio2">Varying numbers                                            </label>
                                        </div>
                                        <div id="step1_constant">
                                            <div class="row align-items-center mt-3">
                                                <div class="col-12 col-md-6 ">
                                                    <input class="form-control" type="number" name="group_employee"
                                                        value="{{ old('	group_employee') }}" placeholder="$">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="varning-amount mt-3" id="step1_varying">
                                            <h4>FY{{ Carbon::now()->format('Y') }}</h4>
                                            <canvas id="group_month_chart" style="max-height:350px;"></canvas>
                                            <div class="cahrt-value">
                                                @for ($i = 0; $i < 12; $i++)
                                                    <div class="input-filed">
                                                        <label
                                                            for="">{{ Carbon::now()->addMonth($i)->format('M Y') }}</label>
                                                        <input type="number" class="form-control"
                                                            name="group_month{{ $i }}"
                                                            id="group_month{{ $i }}">
                                                    </div>
                                                @endfor
                                                <div class="input-filed">
                                                    <label for="">Total</label>
                                                    <input type="number" class="form-control" name="group_month_total"
                                                        id="group_month_total">
                                                </div>
                                            </div>
                                            <div class="cahrt-value">
                                                @for ($i = 2; $i < 6; $i++)
                                                    <div class="input-filed">
                                                        <label
                                                            for="">FY{{ Carbon::now()->addYear($i)->format('Y') }}</label>
                                                        <input type="number" class="form-control"
                                                            name="group_year{{ $i }}">
                                                    </div>
                                                @endfor
                                            </div>
                                        </div>
                                    </div>
                                    {{-- Labor Type  Tab --}}
                                    <div class="mt-3">
                                        <h6 class="font-weight-bold">Do you want to treat them as direct labor?</h6>
                                        <p>Use the direct labor option only for personnel whose expenses are directly related to revenue. For example, a factory worker who is paid to assemble products for sale would be direct labor. So would a freelance designer hired to take on contract work from a design agency. The key distinction here is whether you want to treat an employee's expenses as direct groups.</p>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" checked name="labor_type" value="0">
                                            <label class="form-check-label" for="inlineRadio1">Regular labor
                                            </label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="labor_type"
                                                value="1">
                                            <label class="form-check-label" for="inlineRadio2">Direct labor</label>
                                        </div>
                                    </div>
                                    {{-- Salary Amount Tab --}}
                                    <div class="mt-3">
                                        <h6 class="font-weight-bold">How do you want to enter their salaries?</h6>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" onclick="Constant1()" checked name="constant" value="0">
                                            <label class="form-check-label" for="inlineRadio1">Constant Amount
                                            </label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio"  onclick="Constant2()" name="constant"
                                                value="1">
                                            <label class="form-check-label" for="inlineRadio2">Varying amounts over time</label>
                                        </div>
                                    </div>
                                    {{-- Salary constant amount --}}
                                    <div id="constant_amount_tab">
                                        <div class="row align-items-center mt-3">
                                            <div class="col-12 col-md-6 ">
                                                <input class="form-control" type="number" name="constant_amount"
                                                    value="{{ old('constant_amount') }}" placeholder="$">
                                            </div>
                                            <div class="col-12 col-md-2 text-center">Per</div>
                                            <div class="col-12 col-md-4">
                                                <div class="form-group">
                                                    <select class="form-control" name="constant_amount_type"
                                                        id="exampleFormControlSelect1">
                                                        <option value="0">Month</option>
                                                        <option value="1">Year</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-12 col-md-6">
                                                <label for="exampleFormControlSelect1"><b>When will it
                                                        start?</b></label>
                                                <select class="form-control" name="constant_amount_start"
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
                                            <div class="mt-3">
                                                <label for="exampleFormControlSelect1"><b>Do you want to include annual raises?</b></label>
                                            <p>Successful employees typically earn pay raises over time. To build in annual raises, enter the annual percentage increase here. Otherwise, leave it at zero.</p>
                                            <div class="col-2 col-md-4">
                                                <input type="number" name="annual" class="form-control" placeholder="%">
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="varning-amount mt-3" id="varying_amount_tab">
                                        <h4>FY{{ Carbon::now()->format('Y') }}</h4>
                                        <canvas id="constant_month_chart" style="max-height:350px;"></canvas>
                                        <div class="cahrt-value">
                                            @for ($i = 0; $i < 12; $i++)
                                                <div class="input-filed">
                                                    <label
                                                        for="">{{ Carbon::now()->addMonth($i)->format('M Y') }}</label>
                                                    <input type="number" class="form-control"
                                                        name="constant_month{{ $i }}"
                                                        id="constant_month{{ $i }}">
                                                </div>
                                            @endfor
                                            <div class="input-filed">
                                                <label for="">Total</label>
                                                <input type="number" class="form-control" name="constant_month_total"
                                                    id="constant_month_total">
                                            </div>
                                        </div>
                                        <div class="cahrt-value">
                                            @for ($i = 2; $i < 6; $i++)
                                                <div class="input-filed">
                                                    <label
                                                        for="">FY{{ Carbon::now()->addYear($i)->format('Y') }}</label>
                                                    <input type="number" class="form-control"
                                                        name="constant_year{{ $i }}">
                                                </div>
                                            @endfor
                                        </div>
                                    </div>
                                    {{-- Labor Type  Tab --}}
                                    <div class="mt-3">
                                        <h6 class="font-weight-bold">Are these on-staff roles?</h6>
                                        <p>The burden rate (which covers payroll taxes and benefits) will not be applied to contract workers.</p>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" checked name="employee_role" value="0">
                                            <label class="form-check-label" for="inlineRadio1">On-staff employees
                                            </label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="employee_role"
                                                value="1">
                                            <label class="form-check-label" for="inlineRadio2">Contract workers</label>
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


        function Constant1() {
            document.getElementById('constant_amount_tab').style.display = 'block';
            document.getElementById('varying_amount_tab').style.display = 'none';

        }

        function Constant2() {
            document.getElementById('constant_amount_tab').style.display = 'none';
            document.getElementById('varying_amount_tab').style.display = 'block';

        }
        function Employee_type1() {
            document.getElementById('group_employee_tab').style.display = 'none';

        }

        function Employee_type2() {
            document.getElementById('group_employee_tab').style.display = 'block';

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

            document.getElementById('group_employee_tab').style.display = 'none';
            document.getElementById('varying_amount_tab').style.display = 'none';


            document.getElementById('step1_varying').style.display = 'none';
        });
        //group Month calculate

        $("#group_month0,#group_month1,#group_month2,#group_month3,#group_month4,#group_month5,#group_month6,#group_month7,#group_month8,#group_month9,#group_month10,#group_month11")
            .keyup(function() {
                var group_month0 = $('#group_month0').val();
                var group_month1 = $('#group_month1').val();
                var group_month2 = $('#group_month2').val();
                var group_month3 = $('#group_month3').val();
                var group_month4 = $('#group_month4').val();
                var group_month5 = $('#group_month5').val();
                var group_month6 = $('#group_month6').val();
                var group_month7 = $('#group_month7').val();
                var group_month8 = $('#group_month8').val();
                var group_month9 = $('#group_month9').val();
                var group_month10 = $('#group_month10').val();
                var group_month11 = $('#group_month11').val();
                $('#group_month_total').val((group_month0 * 1) + (group_month1 * 1) + (
                        group_month2 * 1) + (group_month3 * 1) +
                    (group_month4 * 1) + (group_month5 * 1) + (group_month6 * 1) + (
                        group_month7 * 1) + (group_month8 * 1) + (group_month9 * 1) + (
                        group_month10 * 1) + (group_month11 * 1));

                // group Month Chart
                var ctx = document.getElementById('group_month_chart').getContext("2d");
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
                            data: [0, $('#group_month0').val(), $('#group_month1').val(),
                                $('#group_month2').val(), $('#group_month3').val(),
                                $('#group_month4').val(), $('#group_month5').val(),
                                $('#group_month6').val(), $('#group_month7').val(),
                                $('#group_month8').val(), $('#group_month9').val(),
                                $('#group_month10').val(), $('#group_month11').val()
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
    //constant Month calculate

    $("#constant_month0,#constant_month1,#constant_month2,#constant_month3,#constant_month4,#constant_month5,#constant_month6,#constant_month7,#constant_month8,#constant_month9,#constant_month10,#constant_month11")
            .keyup(function() {
                var constant_month0 = $('#constant_month0').val();
                var constant_month1 = $('#constant_month1').val();
                var constant_month2 = $('#constant_month2').val();
                var constant_month3 = $('#constant_month3').val();
                var constant_month4 = $('#constant_month4').val();
                var constant_month5 = $('#constant_month5').val();
                var constant_month6 = $('#constant_month6').val();
                var constant_month7 = $('#constant_month7').val();
                var constant_month8 = $('#constant_month8').val();
                var constant_month9 = $('#constant_month9').val();
                var constant_month10 = $('#constant_month10').val();
                var constant_month11 = $('#constant_month11').val();
                $('#constant_month_total').val((constant_month0 * 1) + (constant_month1 * 1) + (
                        constant_month2 * 1) + (constant_month3 * 1) +
                    (constant_month4 * 1) + (constant_month5 * 1) + (constant_month6 * 1) + (
                        constant_month7 * 1) + (constant_month8 * 1) + (constant_month9 * 1) + (
                        constant_month10 * 1) + (constant_month11 * 1));

                // constant Month Chart
                var ctx = document.getElementById('constant_month_chart').getContext("2d");
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
                            data: [0, $('#constant_month0').val(), $('#constant_month1').val(),
                                $('#constant_month2').val(), $('#constant_month3').val(),
                                $('#constant_month4').val(), $('#constant_month5').val(),
                                $('#constant_month6').val(), $('#constant_month7').val(),
                                $('#constant_month8').val(), $('#constant_month9').val(),
                                $('#constant_month10').val(), $('#constant_month11').val()
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

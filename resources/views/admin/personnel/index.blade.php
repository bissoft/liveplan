@extends('layouts.admin')
@section('content')
    <div class="revanu">
        @include('layouts.forcost')
        <div class="tab-content">
            <div class="tab-pane fade show active" id="success-pills-home" role="tabpanel">
                <h4 class="mb-2">Personnel</h4>
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                <div class="row">
                    <div class="col-12 col-md-8">
                        <div class="card">
                            <canvas class="small-cahrt" id="chartVerticalBar1"></canvas>
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="card">
                            <canvas class="small-cahrt" id="chartVerticalBar"></canvas>
                        </div>
                    </div>
                </div>
                <div class="">
                    <a class="btn btn-primary my-3" href="{{route('admin.personnel.create')}}">Add Personnel</a>
                </div>
                {{-- Personnel --}}
                <div class="row mx-0">
                    <div class="card">
                        <div class="card-body table-responsive">
                            <table id="total" cellspacing="0" width="100%" class="table table-bordered mb-0">
                                <thead>
                                    <tr>
                                        <th>
                                            <button class="btn bg-transparent p-1"><i class="fa fa-angle-down"></i></button>
                                        </th>
                                        <th class="sub-title">Personnel</th>
                                        @php
                                            use Carbon\Carbon;
                                        @endphp
                                        @for ($i = 0; $i < 12; $i++)
                                            <th scope="col">{{ Carbon::now()->addMonth($i)->format('M Y') }}</th>
                                        @endfor
                                        @for ($i = 2; $i < 6; $i++)
                                            <th scope="col">FY{{ Carbon::now()->addYear($i)->format('Y') }}</th>
                                        @endfor
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($personnel as $item)
                                        <tr id="id_row">
                                            <td>
                                                
                                            </td>
                                            <td class="sub-title"> {{ $item->name ?? '' }}
                                                <div class="icons">
                                                    <a href="{{ route('admin.personnel.edit', $item->id) }}"
                                                        class="btn bg-transparent p-0"><i class="fa fa-edit"></i></a>
                                                    <a href="#" class="btn bg-transparent p-0"><i
                                                            class="fa fa-copy"></i></a>
                                                    <a class="btn bg-transparent p-0"
                                                        onclick="personnelDelete{{ $item->id }}({{ $item->id }})">
                                                        <i class="fa fa-trash">
                                                        </i>
                                                    </a>
                                                </div>
                                            </td>

                                            {{-- Employee Type individual --}}
                                            @if ($item->employee_type == 0)
                                                {{-- if constant --}}
                                                @if ($item->constant == 0)
                                                    @for ($i = 0; $i < 12; $i++)
                                                        <td>{{ $item->constant_amount??'' }}
                                                        </td>
                                                    @endfor
                                                    @for ($i = 2; $i < 6; $i++)
                                                            <td>{{ $item->constant_amount * 12 }}
                                                            </td>
                                                    @endfor
                                                
                                                    {{-- if varying --}}
                                                @elseif ($item->constant == 1)
                                                    @php
                                                        $arr = json_decode($item->constant_amount, true);
                                                    @endphp
                                                    @foreach ($arr as $item1)
                                                        <td>
                                                            {{ $item1??'' }}
                                                        </td>
                                                    @endforeach
                                                    @endif
                                            @endif
                                            {{-- Employee type group --}}
                                                @if ($item->employee_type == 1)
                                                    {{-- if constant --}}
                                                    @if($item->group_constant==0 && $item->constant==0)
                                                            @for ($i = 0; $i < 12; $i++)
                                                                <td>{{ $item->constant_amount * $item->group_employee }}
                                                                </td>
                                                            @endfor
                                                            @for ($i = 2; $i < 6; $i++)
                                                                    <td>{{ ($item->constant_amount * $item->group_employee)* 12 }}
                                                                    </td>
                                                            @endfor
                                                    @elseif($item->group_constant==1 && $item->constant==0)
                                                        @php
                                                            $arr = json_decode($item->group_employee, true);
                                                        @endphp
                                                            @for ($i = 0; $i < 12; $i++)
                                                                <td>{{ $item->constant_amount * $arr[$i] }}
                                                                </td>
                                                            @endfor
                                                            @for ($i = 2; $i < 6; $i++)
                                                                    <td>{{ ($item->constant_amount * $arr[10+$i])* 12 }}
                                                                    </td>
                                                            @endfor
                                                    @elseif($item->group_constant==0 && $item->constant==1)
                                                        @php
                                                            $arr = json_decode($item->constant_amount, true);
                                                        @endphp
                                                            @for ($i = 0; $i < 12; $i++)
                                                                <td>{{ $arr[$i] * $item->group_employee }}
                                                                </td>
                                                            @endfor
                                                            @for ($i = 2; $i < 6; $i++)
                                                                    <td>{{ ($arr[10+$i] * $item->group_employee)* 12 }}
                                                                    </td>
                                                            @endfor
                                                    @elseif($item->group_constant==1 && $item->constant==1)
                                                        @php
                                                            $arr = json_decode($item->constant_amount, true);
                                                            $arr1 = json_decode($item->group_employee, true);
                                                        @endphp
                                                        @for ($i = 0; $i < 12; $i++)
                                                            <td>{{ $arr[$i] * $arr1[$i] }}
                                                            </td>
                                                        @endfor
                                                        @for ($i = 2; $i < 6; $i++)
                                                                <td>{{ ($arr[10+$i] * $arr1[10+$i])* 12 }}
                                                                </td>
                                                        @endfor
                                                    @endif
                                                @endif
                                        </tr>
                                        
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th></th>
                                        <th>Total</th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="success-pills-profile" role="tabpanel">
                <p>Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee accusamus tattooed echo
                    park.</p>
            </div>
            <div class="tab-pane fade" id="success-pills-contact" role="tabpanel">
                <p>Etsy mixtape wayfalocavore carles etsy salvia banksy hoodie helvetic.</p>
            </div>
            <div class="tab-pane fade" id="success-pills-contact1" role="tabpanel">
                <p>Etsy mixtape wayfalocavore carles etsy salvia banksy hoodie helvetic.</p>
            </div>
            <div class="tab-pane fade" id="success-pills-contact2" role="tabpanel">
                <p>Etsy carles etsy salvia banksy hoodie .</p>
            </div>
            <div class="tab-pane fade" id="success-pills-contact3" role="tabpanel">
                <p>Etsy mixtape wayfalocavore salvia banksy hoodie helvetic.</p>
            </div>
            <div class="tab-pane fade" id="success-pills-contact4" role="tabpanel">
                <p>Etsyksy hoodie helvetic.</p>
            </div>
            <div class="tab-pane fade" id="success-pills-contact5" role="tabpanel">
                <p>Etsy mixta etsy salvia banksy hoodie helvetic.</p>
            </div>
            <div class="tab-pane fade" id="success-pills-contact6" role="tabpanel">
                <p>Etsy mixtape carles etsy salvia banksy hoodie helvetic.</p>
            </div>
        </div>
        <!--Add Modal -->
        <div class="modal fade  varing-ammount-modal" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tell us about this direct cost</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mt-4">
                            <div class="wizard">
                                <div class="wizard-inner">
                                    <div class="connecting-line"></div>
                                    <ul class="nav nav-tabs" role="tablist" style="flex-wrap: initial;">
                                        <li role="presentation" class="active"> <a href="#step1" data-toggle="tab"
                                                aria-controls="step1" role="tab" aria-expanded="true"><span
                                                    class="round-tab">1 </span>
                                                <i>Name</i></a> </li>
                                        <li role="presentation" class="disabled"> <a href="#step2" data-toggle="tab"
                                                aria-controls="step2" role="tab" aria-expanded="false"><span
                                                    class="round-tab">2</span>
                                                <i>Type</i></a> </li>
                                        <li id="type1_1" role="presentation" class="disabled"> <a href="#step3"
                                                data-toggle="tab" aria-controls="step3" role="tab"><span
                                                    class="round-tab">3</span>
                                                <i>Unit sales</i></a> </li>
                                        <li id="type1_2" role="presentation" class="disabled"> <a href="#step4"
                                                data-toggle="tab" aria-controls="step4" role="tab"><span
                                                    class="round-tab">4</span>
                                                <i>Unit price </i></a> </li>
                                        <li id="type2_1" role="presentation" class="disabled"> <a href="#step5"
                                                data-toggle="tab" aria-controls="step5" role="tab"><span
                                                    class="round-tab">3</span>
                                                <i>Billable Hours</i></a> </li>
                                        <li id="type2_2" role="presentation" class="disabled"> <a href="#step6"
                                                data-toggle="tab" aria-controls="step6" role="tab"><span
                                                    class="round-tab">4</span>
                                                <i>Hourly Rate </i></a> </li>
                                        <li id="type3_1" role="presentation" class="disabled"> <a href="#step7"
                                                data-toggle="tab" aria-controls="step7" role="tab"><span
                                                    class="round-tab">3</span>
                                                <i>Signups </i></a> </li>
                                        <li id="type3_2" role="presentation" class="disabled"> <a href="#step8"
                                                data-toggle="tab" aria-controls="step8" role="tab"><span
                                                    class="round-tab">4</span>
                                                <i>Charges</i></a> </li>
                                        <li id="type3_3" role="presentation" class="disabled"> <a href="#step9"
                                                data-toggle="tab" aria-controls="step9" role="tab"><span
                                                    class="round-tab">5</span>
                                                <i>Churn Rate </i></a> </li>
                                        <li id="type4_1" role="presentation" class="disabled"> <a href="#step10"
                                                data-toggle="tab" aria-controls="step6" role="tab"><span
                                                    class="round-tab">3</span>
                                                <i>Revenue </i></a> </li>
                                    </ul>
                                </div>
                                <form role="form" id="quickForm" action="{{ route('admin.revenue.store') }}"
                                    method="post" enctype="multipart/form-data" class="login-box">
                                    @csrf
                                    <div class="tab-content" id="main_form">
                                        <div class="tab-pane active" role="tabpanel" id="step1">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1" class="mb-2">What do you
                                                    want
                                                    to call it?</label>
                                                <input type="text" name="name" value="{{ old('name') }}"
                                                    class="form-control" id="" aria-describedby="emailHelp"
                                                    placeholder="Enter Name">

                                            </div>
                                            <ul class="list-inline float-end mt-4 w-100">
                                                <li>
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <button type="button" class="btn-sm btn btn-danger">Delete
                                                        </button>

                                                        <button type="button" class="btn-sm next-step btn btn-primary">Next
                                                        </button>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="tab-pane" role="tabpanel" id="step2">
                                            <h6 class="font-weight-bold">What type of revenue stream is this?</h6>
                                            <div class="form-check mb-3">
                                                <input class="form-check-input" type="radio" name="type"
                                                    onclick="javascript:Type1();" value="1">
                                                <label class="form-check-label" for="exampleRadios1">
                                                    Unit sales
                                                </label>
                                                <small class="d-block">Best for products that are sold in
                                                    individual
                                                    units or set quantities</small>
                                            </div>
                                            <div class="form-check mb-3">
                                                <input class="form-check-input" type="radio" name="type"
                                                    onclick="javascript:Type2();" value="2">
                                                <label class="form-check-label" for="exampleRadios2">
                                                    Billable hours
                                                </label>
                                                <small class="d-block">Best for products that are sold in
                                                    individual
                                                    units or s products that are sold in individual units or set
                                                    quantities</small>
                                            </div>
                                            <div class="form-check mb-3">
                                                <input class="form-check-input" type="radio" name="type"
                                                    onclick="javascript:Type3();" value="3">
                                                <label class="form-check-label" for="exampleRadios3">
                                                    Recurring charges
                                                </label>
                                                <small class="d-block">Best for products that are sold in
                                                    individual
                                                    units or s products that are sold in individual units or set
                                                    quantities</small>
                                            </div>
                                            <div class="form-check mb-3">
                                                <input class="form-check-input" type="radio" name="type"
                                                    onclick="javascript:Type4();" value="4">
                                                <label class="form-check-label" for="exampleRadios4">
                                                    Revenue only
                                                </label>
                                                <small class="d-block">Best for products that are sold in
                                                    individual
                                                    units or s products that are sold in individual units or set
                                                    quantities</small>
                                            </div>
                                            <ul class="list-inline float-end mt-4 w-100">
                                                <li>
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <button type="button" class="btn-sm btn btn-danger">Delete
                                                        </button>
                                                        <div>
                                                            <button type="button"
                                                                class="btn-sm btn btn-primary  prev-step">Back</button>

                                                            <button type="button"
                                                                class="btn-sm next-step btn btn-primary">Next </button>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                        {{-- Unit Sale step3 --}}
                                        <div class="tab-pane" role="tabpanel" id="step3">
                                            <h6 class="font-weight-bold">How many units will you sell?</h6>
                                            <p><small>How best to define a 'unit' depends on what you sell. If you offer
                                                    widgets, just enter the quantity of those widgets (shirts or
                                                    computers
                                                    or whatever) you think you'll sell. For other offerings, you might
                                                    want
                                                    to use units to mean consulting engagements or fixed-price contracts
                                                    or
                                                    pallets of low-value materials. Do what makes sense for your
                                                    business.</small></p>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" checked name="constant"
                                                    value="0" onclick="step1_constant()">
                                                <label class="form-check-label" for="inlineRadio1">Constant
                                                    amount</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" onclick="step1_varying()"
                                                    name="constant" value="1">
                                                <label class="form-check-label" for="inlineRadio2">Varying amounts over
                                                    time</label>
                                            </div>
                                            <div id="step1_constant">
                                                <div class="row align-items-center mt-3">
                                                    <div class="col-12 col-md-6 ">
                                                        <input class="form-control" type="text" name="constant_amount"
                                                            value="{{ old('constant_amount') }}" placeholder="$">
                                                    </div>
                                                    <div class="col-12 col-md-2 text-center">Per</div>
                                                    <div class="col-12 col-md-4">
                                                        <div class="form-group">
                                                            <select class="form-control" name="constant_type"
                                                                id="exampleFormControlSelect1">
                                                                <option value="0">Month</option>
                                                                <option value="1">Year</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group mt-3">
                                                    <label for="exampleFormControlSelect1"> When will this revenue
                                                        start?</label>
                                                    <select class="form-control" name="constant_start"
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
                                            <div class="varning-amount mt-3" id="step1_varying">
                                                <h4>FY{{ Carbon::now()->format('Y') }}</h4>
                                                <canvas id="unit_month_chart" style="max-height:350px;"></canvas>
                                                <div class="cahrt-value">
                                                    @for ($i = 0; $i < 12; $i++)
                                                        <div class="input-filed">
                                                            <label
                                                                for="">{{ Carbon::now()->addMonth($i)->format('M Y') }}</label>
                                                            <input type="number" class="form-control"
                                                                name="unit_month{{ $i }}"
                                                                id="unit_month{{ $i }}">
                                                        </div>
                                                    @endfor
                                                    <div class="input-filed">
                                                        <label for="">Total</label>
                                                        <input type="number" class="form-control" name="unit_month_total"
                                                            id="unit_month_total">
                                                    </div>
                                                </div>
                                                <div class="cahrt-value">
                                                    @for ($i = 2; $i < 6; $i++)
                                                        <div class="input-filed">
                                                            <label
                                                                for="">FY{{ Carbon::now()->addYear($i)->format('Y') }}</label>
                                                            <input type="number" class="form-control"
                                                                name="unit_year{{ $i }}">
                                                        </div>
                                                    @endfor
                                                </div>
                                            </div>

                                            <ul class="list-inline float-end mt-4 w-100">
                                                <li>
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <button type="button" class="btn-sm btn btn-danger">Delete
                                                        </button>
                                                        <div>
                                                            <button type="button"
                                                                class="btn-sm btn btn-primary  prev-step">Back</button>

                                                            <button type="button"
                                                                class="btn-sm next-step btn btn-primary">Next </button>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                        {{-- Unit Rate Step 4 --}}
                                        <div class="tab-pane" role="tabpanel" id="step4">
                                            <h6 class="font-weight-bold">What price will you charge for each unit?</h6>
                                            <p><small>Enter your average selling price (excluding sales tax) for each
                                                    unit
                                                    of this product or service. You can vary prices over time, if
                                                    necessary,
                                                    to reflect seasonal changes in demand, planned increases, or
                                                    scheduled
                                                    discount promotions.</small></p>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="sale_constant"
                                                    id="inlineRadio11" value="0" checked onclick="step2_constant()">
                                                <label class="form-check-label" for="inlineRadio11">Constant
                                                    amount</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="sale_constant"
                                                    id="inlineRadio21" value="1" onclick="step2_varying()">
                                                <label class="form-check-label" for="inlineRadio21">Varying amounts
                                                    over
                                                    time</label>
                                            </div>
                                            <div id="step2_constant">
                                                <div class="col-12 col-md-6 mt-3 position-relative">
                                                    <input class="form-control  pl-2" placeholder="$" type="number"
                                                        name="sale_constant_price">
                                                    <i class="fa fa-dollar-sign"
                                                        style="position: absolute;top: 12px;left: 3px;"></i>
                                                </div>
                                            </div>
                                            <div class="varning-amount mt-3" id="step2_varying">
                                                <h4>FY{{ Carbon::now()->format('Y') ?? '' }}</h4>
                                                <canvas id="sale_month_chart" style="max-height:350px;"></canvas>
                                                <div class="cahrt-value">
                                                    @for ($i = 0; $i < 12; $i++)
                                                        <div class="input-filed">
                                                            <label
                                                                for="">{{ Carbon::now()->addMonth($i)->format('M Y') }}</label>
                                                            <input type="number" class="form-control"
                                                                name="sale_month{{ $i }}"
                                                                id="sale_month{{ $i }}">
                                                        </div>
                                                    @endfor
                                                </div>
                                                <div class="cahrt-value">
                                                    @for ($i = 1; $i < 6; $i++)
                                                        <div class="input-filed">
                                                            <label
                                                                for="">FY{{ Carbon::now()->addYear($i)->format('Y') }}</label>
                                                            <input type="number" class="form-control"
                                                                name="sale_year{{ $i }}">
                                                        </div>
                                                    @endfor



                                                </div>
                                            </div>
                                            <ul class="list-inline float-end mt-4 w-100">
                                                <li>
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <button type="button" class="btn-sm btn btn-danger">Delete
                                                        </button>
                                                        <div>
                                                            <button type="button"
                                                                class="btn-sm btn btn-primary  prev-step">Back</button>

                                                            <button type="submit" class="btn-sm btn btn-success">Save
                                                            </button>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                        {{-- Billable Hours step 5 --}}
                                        <div class="tab-pane" role="tabpanel" id="step5">
                                            <h6 class="font-weight-bold">How many hours will you bill for?</h6>
                                            <p><small>Estimate how many billing hours you will have in each period. You can
                                                    set this as a flat amount or vary the count over time to reflect growth,
                                                    seasonality, added resources, and so on.</small></p>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="billable_constant"
                                                    id="inlineRadio1" value="0" checked onclick="step5_constant()">
                                                <label class="form-check-label" for="inlineRadio1">Constant
                                                    amount</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="billable_constant"
                                                    id="inlineRadio2" value="1" onclick="step5_varying()">
                                                <label class="form-check-label" for="inlineRadio2">Varying amounts over
                                                    time</label>
                                            </div>
                                            <div id="step5_constant">
                                                <div class="row align-items-center mt-3">
                                                    <div class="col-12 col-md-6 ">
                                                        <input class="form-control" type="number" placeholder="$"
                                                            name="billable_constant_amount">
                                                    </div>
                                                    <div class="col-12 col-md-2 text-center">Per</div>
                                                    <div class="col-12 col-md-4">
                                                        <div class="form-group">
                                                            <select class="form-control" name="billable_constant_type"
                                                                id="exampleFormControlSelect1">
                                                                <option value="0">Month</option>
                                                                <option value="1">Year</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group mt-3">
                                                    <label for="exampleFormControlSelect1"> When will this revenue
                                                        start?</label>
                                                    <select class="form-control" name="billable_start"
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
                                            <div class="varning-amount mt-3" id="step5_varying">
                                                <h4>FY{{ Carbon::now()->format('Y') }}</h4>
                                                <canvas id="billable_month_chart" style="max-height:350px;"></canvas>
                                                <div class="cahrt-value">
                                                    @for ($i = 0; $i < 12; $i++)
                                                        <div class="input-filed">
                                                            <label
                                                                for="">{{ Carbon::now()->addMonth($i)->format('M Y') }}</label>
                                                            <input type="number" class="form-control"
                                                                name="billable_month{{ $i }}"
                                                                id="billable_month{{ $i }}">
                                                        </div>
                                                    @endfor
                                                    <div class="input-filed">
                                                        <label for="">Total</label>
                                                        <input type="number" class="form-control"
                                                            name="billable_month_total" id="billable_month_total">
                                                    </div>
                                                </div>
                                                <div class="cahrt-value">
                                                    @for ($i = 2; $i < 6; $i++)
                                                        <div class="input-filed">
                                                            <label
                                                                for="">FY{{ Carbon::now()->addYear($i)->format('Y') }}</label>
                                                            <input type="number" class="form-control"
                                                                name="billable_year{{ $i }}">
                                                        </div>
                                                    @endfor
                                                </div>
                                            </div>
                                            <ul class="list-inline float-end mt-4 w-100">
                                                <li>
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <button type="button" class="btn-sm btn btn-danger">Delete
                                                        </button>
                                                        <div>
                                                            <button type="button"
                                                                class="btn-sm btn btn-primary  prev-step">Back</button>

                                                            <button type="button"
                                                                class="btn-sm next-step btn btn-primary">Next </button>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                        {{-- Billable hourly rate step6 --}}
                                        <div class="tab-pane" role="tabpanel" id="step6">
                                            <h6 class="font-weight-bold">What will you charge per hour?</h6>
                                            <p><small>Enter your hourly rate (excluding sales tax) below. You can set a
                                                    constant rate or vary it over time to reflect planned rate changes,
                                                    different mixes of billable work, and so on.</small></p>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="billable_hour_constant"
                                                    id="inlineRadio11" value="0" checked onclick="step6_constant()">
                                                <label class="form-check-label" for="inlineRadio11">Constant
                                                    amount</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="billable_hour_constant"
                                                    id="inlineRadio21" value="1" onclick="step6_varying()">
                                                <label class="form-check-label" for="inlineRadio21">Varying amounts
                                                    over
                                                    time</label>
                                            </div>
                                            <div id="step6_constant">
                                                <div class="col-12 col-md-6 mt-3 position-relative">
                                                    <input class="form-control  pl-2" type="number" placeholder="$"
                                                        name="billable_hour_amount">
                                                    <i class="fa fa-dollar-sign"
                                                        style="position: absolute;top: 12px;left: 3px;"></i>
                                                </div>
                                            </div>
                                            {{-- Billable Hourly Rate varying --}}
                                            <div class="varning-amount mt-3" id="step6_varying">
                                                <h4>FY{{ Carbon::now()->format('Y') ?? '' }}</h4>
                                                <canvas id="rate_month_chart" style="max-height:350px;"></canvas>
                                                <div class="cahrt-value">
                                                    @for ($i = 0; $i < 12; $i++)
                                                        <div class="input-filed">
                                                            <label
                                                                for="">{{ Carbon::now()->addMonth($i)->format('M Y') }}</label>
                                                            <input type="number" class="form-control"
                                                                name="rate_month{{ $i }}"
                                                                id="rate_month{{ $i }}">
                                                        </div>
                                                    @endfor
                                                </div>
                                                <div class="cahrt-value">
                                                    @for ($i = 1; $i < 6; $i++)
                                                        <div class="input-filed">
                                                            <label
                                                                for="">FY{{ Carbon::now()->addYear($i)->format('Y') }}</label>
                                                            <input type="number" class="form-control"
                                                                name="rate_year{{ $i }}">
                                                        </div>
                                                    @endfor
                                                </div>
                                            </div>
                                            <ul class="list-inline float-end mt-4 w-100">
                                                <li>
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <button type="button" class="btn-sm btn btn-danger">Delete
                                                        </button>
                                                        <div>
                                                            <button type="button"
                                                                class="btn-sm btn btn-primary  prev-step">Back</button>

                                                            <button type="submit" class="btn-sm  btn btn-success">Save
                                                            </button>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                        {{-- Recurring charges step7 --}}
                                        <div class="tab-pane" role="tabpanel" id="step7">
                                            <div class="form-group mt-3">
                                                <h6 class="font-weight-bold">When will this revenue start?</h6>
                                                <p><small>Let us know when you plan to start signing up customers or if you
                                                        have
                                                        already started before the forecast period.</small></p>
                                                <select class="form-control" name="recurring_start"
                                                    id="exampleFormControlSelect1">
                                                    @for ($i = 0; $i < 12; $i++)
                                                        <option value="{{ Carbon::now()->addMonth($i)->format('M Y') }}">
                                                            {{ Carbon::now()->addMonth($i)->format('M Y') }}</option>
                                                    @endfor
                                                    @for ($i = 2; $i < 6; $i++)
                                                        <option value="{{ Carbon::now()->addYear($i)->format('Y') }}">
                                                            FY{{ Carbon::now()->addYear($i)->format('Y') }}</option>
                                                    @endfor
                                                </select>
                                            </div>
                                            <div class="form-group mt-3">
                                                <h6 class="font-weight-bold">How many new customers do you expect to sign
                                                    up?</h6>
                                                <p><small>Estimate the number of new customers that you will sign up in each
                                                        period of your forecast. Don't worry about existing customer or
                                                        cancellations here, just new signups.</small></p>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" checked
                                                        name="signup_constant" value="0" onclick="step7_constant()">
                                                    <label class="form-check-label" for="inlineRadio1">Constant
                                                        amount</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" onclick="step7_varying()"
                                                        name="signup_constant" value="1">
                                                    <label class="form-check-label" for="inlineRadio2">Varying amounts over
                                                        time</label>
                                                </div>
                                            </div>
                                            <div id="step7_constant">
                                                <div class="row align-items-center mt-3">
                                                    <div class="col-12 col-md-6 ">
                                                        <input class="form-control" type="text"
                                                            name="signup_constant_amount"
                                                            value="{{ old('signup_constant_amount') }}" placeholder="$">
                                                    </div>
                                                    <div class="col-12 col-md-2 text-center">Per</div>
                                                    <div class="col-12 col-md-4">
                                                        <div class="form-group">
                                                            <select class="form-control" name="signup_constant_type"
                                                                id="exampleFormControlSelect1">
                                                                <option value="0">Month</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="varning-amount mt-3" id="step7_varying">
                                                <h4>FY{{ Carbon::now()->format('Y') }}</h4>
                                                <canvas id="signup_month_chart" style="max-height:350px;"></canvas>
                                                <div class="cahrt-value">
                                                    @for ($i = 0; $i < 12; $i++)
                                                        <div class="input-filed">
                                                            <label
                                                                for="">{{ Carbon::now()->addMonth($i)->format('M Y') }}</label>
                                                            <input type="number" class="form-control"
                                                                name="signup_month{{ $i }}"
                                                                id="signup_month{{ $i }}"
                                                                id="signup_month{{ $i }}">
                                                        </div>
                                                    @endfor
                                                    <div class="input-filed">
                                                        <label for="">Total</label>
                                                        <input type="number" class="form-control"
                                                            name="signup_month_total" id="signup_month_total">
                                                    </div>
                                                </div>
                                                <div class="cahrt-value">
                                                    @for ($i = 2; $i < 6; $i++)
                                                        <div class="input-filed">
                                                            <label
                                                                for="">FY{{ Carbon::now()->addYear($i)->format('Y') }}</label>
                                                            <input type="number" class="form-control"
                                                                name="signup_year{{ $i }}">
                                                        </div>
                                                    @endfor
                                                </div>
                                            </div>

                                            <ul class="list-inline float-end mt-4 w-100">
                                                <li>
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <button type="button" class="btn-sm btn btn-danger">Delete
                                                        </button>
                                                        <div>
                                                            <button type="button"
                                                                class="btn-sm btn btn-primary  prev-step">Back</button>

                                                            <button type="button"
                                                                class="btn-sm next-step btn btn-primary">Next </button>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                        {{-- Recurring charges step8 --}}
                                        <div class="tab-pane" role="tabpanel" id="step8">
                                            <div class="form-group mt-3">
                                                <div class="form-group mt-3">
                                                    <h6 class="font-weight-bold">Do you charge an up-front fee?</h6>
                                                    <p><small>If you have a setup fee or one-time charge at signup, include
                                                            it here. Be sure to indicate whether you will always charge the
                                                            same fee or will change the fee amount for signups in different
                                                            periods.</small></p>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" checked
                                                            name="up_front_constant" value="2" onclick="step8_nofee()">
                                                        <label class="form-check-label" for="inlineRadio1">No fee</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio"
                                                            name="up_front_constant" value="0" onclick="step8_constant()">
                                                        <label class="form-check-label" for="inlineRadio1">Constant
                                                            amount</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio"
                                                            onclick="step8_varying()" name="up_front_constant" value="1">
                                                        <label class="form-check-label" for="inlineRadio2">Varying amounts
                                                            over
                                                            time</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="step8_constant">
                                                <div class="row align-items-center mt-3">
                                                    <div class="col-12 col-md-6 ">
                                                        <input class="form-control" type="text"
                                                            name=" up_front_constant_amount"
                                                            value="{{ old('up_front_constant_amount') }}"
                                                            placeholder="$">
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="varning-amount mt-3" id="step8_varying">
                                                <h4>FY{{ Carbon::now()->format('Y') }}</h4>
                                                <canvas id="up_front_month_chart" style="max-height:350px;"></canvas>
                                                <div class="cahrt-value">
                                                    @for ($i = 0; $i < 12; $i++)
                                                        <div class="input-filed">
                                                            <label
                                                                for="">{{ Carbon::now()->addMonth($i)->format('M Y') }}</label>
                                                            <input type="number" class="form-control"
                                                                name="up_front_month{{ $i }}"
                                                                id="up_front_month{{ $i }}">
                                                        </div>
                                                    @endfor
                                                </div>
                                                <div class="cahrt-value">
                                                    @for ($i = 1; $i < 6; $i++)
                                                        <div class="input-filed">
                                                            <label
                                                                for="">FY{{ Carbon::now()->addYear($i)->format('Y') }}</label>
                                                            <input type="number" class="form-control"
                                                                name="up_front_year{{ $i }}">
                                                        </div>
                                                    @endfor
                                                </div>
                                            </div>
                                            <div class="form-group mt-3">
                                                <h6 class="font-weight-bold">How much is the recurring charge?</h6>
                                                <p><small>Enter your standard charge (excluding sales tax) for each period.
                                                        If you plan to change your pricing or do more discounting at certain
                                                        times of year, use the varying option to enter individual
                                                        values.</small></p>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" checked
                                                        name="recurring_constant" value="0" onclick="step8_2_constant()">
                                                    <label class="form-check-label" for="inlineRadio1">Constant
                                                        amount</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio"
                                                        onclick="step8_2_varying()" name="recurring_constant" value="1">
                                                    <label class="form-check-label" for="inlineRadio2">Varying amounts over
                                                        time</label>
                                                </div>
                                            </div>
                                            <div id="step8_2_constant">
                                                <div class="row align-items-center mt-3">
                                                    <div class="col-12 col-md-6 ">
                                                        <input class="form-control" type="text"
                                                            name="recurring_constant_amount"
                                                            value="{{ old('recurring_constant_amount') }}"
                                                            placeholder="$">
                                                    </div>
                                                    <div class="col-12 col-md-2 text-center">Per Month</div>
                                                </div>
                                            </div>
                                            <div class="varning-amount mt-3" id="step8_2_varying">
                                                <h4>FY{{ Carbon::now()->format('Y') }}</h4>
                                                <canvas id="recurring_month_chart" style="max-height:350px;"></canvas>
                                                <div class="cahrt-value">
                                                    @for ($i = 0; $i < 12; $i++)
                                                        <div class="input-filed">
                                                            <label
                                                                for="">{{ Carbon::now()->addMonth($i)->format('M Y') }}</label>
                                                            <input type="number" class="form-control"
                                                                name="recurring_month{{ $i }}"
                                                                id="recurring_month{{ $i }}">
                                                        </div>
                                                    @endfor
                                                </div>
                                                <div class="cahrt-value">
                                                    @for ($i = 1; $i < 6; $i++)
                                                        <div class="input-filed">
                                                            <label
                                                                for="">FY{{ Carbon::now()->addYear($i)->format('Y') }}</label>
                                                            <input type="number" class="form-control"
                                                                name="recurring_year{{ $i }}">
                                                        </div>
                                                    @endfor
                                                </div>
                                            </div>

                                            <ul class="list-inline float-end mt-4 w-100">
                                                <li>
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <button type="button" class="btn-sm btn btn-danger">Delete
                                                        </button>
                                                        <div>
                                                            <button type="button"
                                                                class="btn-sm btn btn-primary  prev-step">Back</button>

                                                            <button type="button"
                                                                class="btn-sm next-step btn btn-primary">Next </button>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                        {{-- Recurring charges step9 --}}
                                        <div class="tab-pane" role="tabpanel" id="step9">
                                            <div class="form-group mt-3">
                                                <h6 class="font-weight-bold">What is your churn rate?</h6>
                                                <p><small>What percentage of your existing customers will cancel before
                                                        their next payment is due? We will apply this rate to the count of
                                                        customers who are due for renewal at the start of each period —
                                                        before new signups are added. If you plan to reduce your churn rate
                                                        over time (a great goal), use the varying option to enter a separate
                                                        rate for each period.</small></p>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" checked
                                                        name="churn_constant" value="0" onclick="step9_constant()">
                                                    <label class="form-check-label" for="inlineRadio1">Constant
                                                        amount</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" onclick="step9_varying()"
                                                        name="churn_constant" value="1">
                                                    <label class="form-check-label" for="inlineRadio2">Varying amounts over
                                                        time</label>
                                                </div>
                                            </div>
                                            <div id="step9_constant">
                                                <div class="row align-items-center mt-3">
                                                    <div class="col-12 col-md-6 ">
                                                        <input class="form-control" type="text"
                                                            name="churn_constant_amount"
                                                            value="{{ old('churn_constant_amount') }}" placeholder="$">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="varning-amount mt-3" id="step9_varying">
                                                <h4>FY{{ Carbon::now()->format('Y') }}</h4>
                                                <canvas id="churn_month_chart" style="max-height:350px;"></canvas>
                                                <div class="cahrt-value">
                                                    @for ($i = 0; $i < 12; $i++)
                                                        <div class="input-filed">
                                                            <label
                                                                for="">{{ Carbon::now()->addMonth($i)->format('M Y') }}</label>
                                                            <input type="number" class="form-control"
                                                                name="churn_month{{ $i }}"
                                                                id="churn_month{{ $i }}">
                                                        </div>
                                                    @endfor
                                                </div>
                                                <div class="cahrt-value">
                                                    @for ($i = 1; $i < 6; $i++)
                                                        <div class="input-filed">
                                                            <label
                                                                for="">FY{{ Carbon::now()->addYear($i)->format('Y') }}</label>
                                                            <input type="number" class="form-control"
                                                                name="churn_year{{ $i }}">
                                                        </div>
                                                    @endfor
                                                </div>
                                            </div>

                                            <ul class="list-inline float-end mt-4 w-100">
                                                <li>
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <button type="button" class="btn-sm btn btn-danger">Delete
                                                        </button>
                                                        <div>
                                                            <button type="button"
                                                                class="btn-sm btn btn-primary  prev-step">Back</button>

                                                            <button type="submit"
                                                                class="btn-sm next-step btn btn-success">Save </button>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                        {{-- Revenue only --}}
                                        <div class="tab-pane" role="tabpanel" id="step10">
                                            <h6 class="font-weight-bold">How much will you make from this revenue stream?
                                            </h6>
                                            <p><small>You have chosen to enter revenue totals only for this revenue stream,
                                                    rather than building up those totals from unit sales, signups, or other
                                                    details. Just enter the projected revenue amount below.</small></p>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="revenue_constant"
                                                    id="inlineRadio1" value="0" onclick="step10_constant()" checked>
                                                <label class="form-check-label" for="inlineRadio1">Constant
                                                    amount</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="revenue_constant"
                                                    id="inlineRadio2" value="1" onclick="step10_varying()">
                                                <label class="form-check-label" for="inlineRadio2">Varying amounts over
                                                    time</label>
                                            </div>
                                            <div id="step10_constant">
                                                <div class="row align-items-center mt-3">
                                                    <div class="col-12 col-md-6 ">
                                                        <input class="form-control" type="number" placeholder="$"
                                                            name="revenue_constant_amount">
                                                    </div>
                                                    <div class="col-12 col-md-2 text-center">Per</div>
                                                    <div class="col-12 col-md-4">
                                                        <div class="form-group">
                                                            <select class="form-control" name="revenue_constant_type"
                                                                id="exampleFormControlSelect1">
                                                                <option value="0">Month</option>
                                                                <option value="1">Year</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group mt-3">
                                                    <label for="exampleFormControlSelect1"> When will this revenue
                                                        start?</label>
                                                    <select class="form-control" name="revenue_start"
                                                        id="exampleFormControlSelect1">
                                                        @for ($i = 0; $i < 12; $i++)
                                                            <option
                                                                value="{{ Carbon::now()->addMonth($i)->format('M Y') }}">
                                                                {{ Carbon::now()->addMonth($i)->format('M Y') }}
                                                            </option>
                                                        @endfor
                                                        @for ($i = 2; $i < 6; $i++)
                                                            <option
                                                                value="{{ Carbon::now()->addYear($i)->format('Y') }}">
                                                                FY{{ Carbon::now()->addYear($i)->format('Y') }}</option>
                                                        @endfor
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="varning-amount mt-3" id="step10_varying">
                                                <h4>FY{{ Carbon::now()->format('Y') }}</h4>
                                                <canvas id="revenue_month_chart" style="max-height:350px;"></canvas>
                                                <div class="cahrt-value">
                                                    @for ($i = 0; $i < 12; $i++)
                                                        <div class="input-filed">
                                                            <label
                                                                for="">{{ Carbon::now()->addMonth($i)->format('M Y') }}</label>
                                                            <input type="number" class="form-control"
                                                                name="revenue_month{{ $i }}"
                                                                id="revenue_month{{ $i }}">
                                                        </div>
                                                    @endfor
                                                    <div class="input-filed">
                                                        <label for="">Total</label>
                                                        <input type="number" class="form-control"
                                                            name="revenue_month_total" id="revenue_month_total">
                                                    </div>
                                                </div>
                                                <div class="cahrt-value">
                                                    @for ($i = 2; $i < 6; $i++)
                                                        <div class="input-filed">
                                                            <label
                                                                for="">FY{{ Carbon::now()->addYear($i)->format('Y') }}</label>
                                                            <input type="number" class="form-control"
                                                                name="revenue_year{{ $i }}">
                                                        </div>
                                                    @endfor
                                                </div>
                                            </div>
                                            <ul class="list-inline float-end mt-4 w-100">
                                                <li>
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <button type="button" class="btn-sm btn btn-danger">Delete
                                                        </button>
                                                        <div>
                                                            <button type="button"
                                                                class="btn-sm btn btn-primary  prev-step">Back</button>

                                                            <button type="submit"
                                                                class="btn-sm next-step btn btn-success">Save </button>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                            </div>
                        </div>
                    </div>
                    </form>
                    <!-- <div class="modal-footer">
                                                                                                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                                                                                            <button type="button" class="btn btn-primary">Save changes</button>
                                                                                                                                        </div> -->
                </div>
            </div>
        </div>

    </div>
@endsection
@section('scripts')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
    <script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    @php
    $month = [];
    for ($i = 0; $i < 12; $i++) {
        $month[] = Carbon::now()
            ->addMonth($i)
            ->format('M Y');
    }

    @endphp
    <script type="text/javascript">
        var table = document.getElementById("total"),
            col1 = 0,
            col2 = 0,
            col3 = 0,
            col4 = 0,
            col5 = 0,
            col6 = 0,
            col7 = 0,
            col8 = 0,
            col9 = 0,
            col10 = 0,
            col11 = 0,
            col12 = 0;

        for (var i = 1; i < table.rows.length - 1; i++) {
            col1 = col1 + parseInt(table.rows[i].cells[2].innerHTML);
            col2 = col2 + parseInt(table.rows[i].cells[3].innerHTML);
            col3 = col3 + parseInt(table.rows[i].cells[4].innerHTML);
            col4 = col4 + parseInt(table.rows[i].cells[5].innerHTML);
            col5 = col5 + parseInt(table.rows[i].cells[6].innerHTML);
            col6 = col6 + parseInt(table.rows[i].cells[7].innerHTML);
            col7 = col7 + parseInt(table.rows[i].cells[8].innerHTML);
            col8 = col8 + parseInt(table.rows[i].cells[9].innerHTML);
            col9 = col9 + parseInt(table.rows[i].cells[10].innerHTML);
            col10 = col10 + parseInt(table.rows[i].cells[11].innerHTML);
            col11 = col11 + parseInt(table.rows[i].cells[12].innerHTML);
            col12 = col12 + parseInt(table.rows[i].cells[13].innerHTML);
        }

        window.addEventListener('load', function() {
            var ctx = document.getElementById('chartVerticalBar1').getContext('2d');
            var chart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: <?php echo json_encode($month, true); ?>,
                    datasets: [{
                        label: false,
                        backgroundColor: '#18c1f6',
                        borderColor: 'rgba(245,34,34,1)',
                        data: [col1, col2, col3, col4, col5, col6, col7, col8, col9, col10, col11,
                            col12
                        ],
                    }]
                },
                options: {
                    responsive: true,
                    title: {
                        display: false,
                        text: 'Chart type: Vertical bar simple'
                    },
                    tooltips: {
                        mode: 'index',
                        intersect: false,
                    },
                    hover: {
                        mode: 'nearest',
                        intersect: true,
                    },
                    scales: {
                        xAxes: [{
                            display: true,
                            scaleLabel: {
                                display: false,
                                labelString: 'Mois'
                            }
                        }],
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            },
                            display: true,
                            scaleLabel: {
                                display: true,
                                labelString: 'Eur/1000L'
                            }
                        }]
                    }
                }
            });
            var mediaQuery = window.matchMedia('(min-width: 768px)');

            function toggleAspectRatio(mq) {
                chart.options.maintainAspectRatio = mq.matches;
                chart.resize();
            }
            toggleAspectRatio(mediaQuery);
            mediaQuery.addListener(toggleAspectRatio);
        })
    </script>
    @php
    $year = [];
    for ($i = 1; $i < 4; $i++) {
        $year[] =
            'FY' .
            Carbon::now()
                ->addYear($i)
                ->format('Y');
    }

    @endphp
    <script type="text/javascript">
        var table = document.getElementById("total"),
            col13 = 0,
            col14 = 0,
            col15 = 0;

        for (var i = 1; i < table.rows.length - 1; i++) {
            col13 = col13 + parseInt(table.rows[i].cells[14].innerHTML);
            col14 = col14 + parseInt(table.rows[i].cells[15].innerHTML);
            col15 = col15 + parseInt(table.rows[i].cells[16].innerHTML);
        }

        window.addEventListener('load', function() {
            var ctx = document.getElementById('chartVerticalBar').getContext('2d');
            var chart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: <?php echo json_encode($year, true); ?>,
                    datasets: [{
                        label: false,
                        backgroundColor: '#18c1f6',
                        borderColor: 'rgba(245,34,34,1)',
                        data: [col13, col14, col15],
                    }]
                },
                options: {
                    responsive: true,
                    title: {
                        display: false,
                        text: 'Chart type: Vertical bar simple'
                    },
                    tooltips: {
                        mode: 'index',
                        intersect: false,
                    },
                    hover: {
                        mode: 'nearest',
                        intersect: true,
                    },
                    scales: {
                        xAxes: [{
                            display: true,
                            scaleLabel: {
                                display: false,
                                labelString: 'Mois'
                            }
                        }],
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            },
                            display: true,
                            scaleLabel: {
                                display: true,
                                labelString: 'Eur/1000L'
                            }
                        }]
                    }
                }
            });
            var mediaQuery = window.matchMedia('(min-width: 768px)');

            function toggleAspectRatio(mq) {
                chart.options.maintainAspectRatio = mq.matches;
                chart.resize();
            }
            toggleAspectRatio(mediaQuery);
            mediaQuery.addListener(toggleAspectRatio);
        })
    </script>
    <script>
        function step1_constant() {
            document.getElementById('step1_constant').style.display = 'block';
            document.getElementById('step1_varying').style.display = 'none';

        }

        function step1_varying() {
            document.getElementById('step1_constant').style.display = 'none';
            document.getElementById('step1_varying').style.display = 'block';

        }

        function step2_constant() {
            document.getElementById('step2_constant').style.display = 'block';
            document.getElementById('step2_varying').style.display = 'none';

        }

        function step2_varying() {
            document.getElementById('step2_constant').style.display = 'none';
            document.getElementById('step2_varying').style.display = 'block';

        }

        function step5_constant() {
            document.getElementById('step5_constant').style.display = 'block';
            document.getElementById('step5_varying').style.display = 'none';

        }

        function step5_varying() {
            document.getElementById('step5_constant').style.display = 'none';
            document.getElementById('step5_varying').style.display = 'block';

        }

        function step6_constant() {
            document.getElementById('step6_constant').style.display = 'block';
            document.getElementById('step6_varying').style.display = 'none';

        }

        function step6_varying() {
            document.getElementById('step6_constant').style.display = 'none';
            document.getElementById('step6_varying').style.display = 'block';

        }

        function step7_constant() {
            document.getElementById('step7_constant').style.display = 'block';
            document.getElementById('step7_varying').style.display = 'none';

        }

        function step7_varying() {
            document.getElementById('step7_constant').style.display = 'none';
            document.getElementById('step7_varying').style.display = 'block';

        }

        function step8_nofee() {
            document.getElementById('step8_constant').style.display = 'none';
            document.getElementById('step8_varying').style.display = 'none';

        }

        function step8_constant() {
            document.getElementById('step8_constant').style.display = 'block';
            document.getElementById('step8_varying').style.display = 'none';

        }

        function step8_varying() {
            document.getElementById('step8_constant').style.display = 'none';
            document.getElementById('step8_varying').style.display = 'block';

        }

        function step8_2_constant() {
            document.getElementById('step8_2_constant').style.display = 'block';
            document.getElementById('step8_2_varying').style.display = 'none';

        }

        function step8_2_varying() {
            document.getElementById('step8_2_constant').style.display = 'none';
            document.getElementById('step8_2_varying').style.display = 'block';

        }

        function step9_constant() {
            document.getElementById('step9_constant').style.display = 'block';
            document.getElementById('step9_varying').style.display = 'none';

        }

        function step9_varying() {
            document.getElementById('step9_constant').style.display = 'none';
            document.getElementById('step9_varying').style.display = 'block';

        }

        function step10_constant() {
            document.getElementById('step10_constant').style.display = 'block';
            document.getElementById('step10_varying').style.display = 'none';

        }

        function step10_varying() {
            document.getElementById('step10_constant').style.display = 'none';
            document.getElementById('step10_varying').style.display = 'block';

        }


        function Type1() {
            document.getElementById('type1_1').style.display = 'block';
            document.getElementById('type1_2').style.display = 'block';
            document.getElementById('type2_1').style.display = 'none';
            document.getElementById('type2_2').style.display = 'none';
            document.getElementById('type3_1').style.display = 'none';
            document.getElementById('type3_2').style.display = 'none';
            document.getElementById('type3_3').style.display = 'none';
            document.getElementById('type4_1').style.display = 'none';

        }

        function Type2() {
            document.getElementById('type1_1').style.display = 'none';
            document.getElementById('type1_2').style.display = 'none';
            document.getElementById('type2_1').style.display = 'block';
            document.getElementById('type2_2').style.display = 'block';
            document.getElementById('type3_1').style.display = 'none';
            document.getElementById('type3_2').style.display = 'none';
            document.getElementById('type3_3').style.display = 'none';
            document.getElementById('type4_1').style.display = 'none';

        }

        function Type3() {
            document.getElementById('type1_1').style.display = 'none';
            document.getElementById('type1_2').style.display = 'none';
            document.getElementById('type2_1').style.display = 'none';
            document.getElementById('type2_2').style.display = 'none';
            document.getElementById('type3_1').style.display = 'block';
            document.getElementById('type3_2').style.display = 'block';
            document.getElementById('type3_3').style.display = 'block';
            document.getElementById('type4_1').style.display = 'none';

        }

        function Type4() {
            document.getElementById('type1_1').style.display = 'none';
            document.getElementById('type1_2').style.display = 'none';
            document.getElementById('type2_1').style.display = 'none';
            document.getElementById('type2_2').style.display = 'none';
            document.getElementById('type3_1').style.display = 'none';
            document.getElementById('type3_2').style.display = 'none';
            document.getElementById('type3_3').style.display = 'none';
            document.getElementById('type4_1').style.display = 'block';

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

            $(".toggler").click(function(e) {
                e.preventDefault();
                $('.cat' + $(this).attr('data-prod-cat')).toggle();
            });
            document.getElementById('type1_1').style.display = 'none';
            document.getElementById('type1_2').style.display = 'none';
            document.getElementById('type2_1').style.display = 'none';
            document.getElementById('type2_2').style.display = 'none';
            document.getElementById('type3_1').style.display = 'none';
            document.getElementById('type3_2').style.display = 'none';
            document.getElementById('type3_3').style.display = 'none';
            document.getElementById('type4_1').style.display = 'none';



            document.getElementById('step1_varying').style.display = 'none';
            document.getElementById('step2_varying').style.display = 'none';
            document.getElementById('step5_varying').style.display = 'none';
            document.getElementById('step6_varying').style.display = 'none';
            document.getElementById('step7_varying').style.display = 'none';
            document.getElementById('step8_constant').style.display = 'none';
            document.getElementById('step8_varying').style.display = 'none';
            document.getElementById('step8_2_varying').style.display = 'none';
            document.getElementById('step9_varying').style.display = 'none';
            document.getElementById('step10_varying').style.display = 'none';

            //Unit Month calculate

            $("#unit_month0,#unit_month1,#unit_month2,#unit_month3,#unit_month4,#unit_month5,#unit_month6,#unit_month7,#unit_month8,#unit_month9,#unit_month10,#unit_month11")
                .keyup(function() {
                    var unit_month0 = $('#unit_month0').val();
                    var unit_month1 = $('#unit_month1').val();
                    var unit_month2 = $('#unit_month2').val();
                    var unit_month3 = $('#unit_month3').val();
                    var unit_month4 = $('#unit_month4').val();
                    var unit_month5 = $('#unit_month5').val();
                    var unit_month6 = $('#unit_month6').val();
                    var unit_month7 = $('#unit_month7').val();
                    var unit_month8 = $('#unit_month8').val();
                    var unit_month9 = $('#unit_month9').val();
                    var unit_month10 = $('#unit_month10').val();
                    var unit_month11 = $('#unit_month11').val();
                    $('#unit_month_total').val((unit_month0 * 1) + (unit_month1 * 1) + (unit_month2 * 1) + (
                            unit_month3 * 1) +
                        (unit_month4 * 1) + (unit_month5 * 1) + (unit_month6 * 1) + (unit_month7 * 1) + (
                            unit_month8 * 1) + (unit_month9 * 1) + (unit_month10 * 1) + (unit_month11 * 1));
                    // Unit Month Chart
                    var ctx = document.getElementById('unit_month_chart').getContext("2d");
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
                                data: [0, $('#unit_month0').val(), $('#unit_month1').val(), $(
                                    '#unit_month2').val(), $('#unit_month3').val(), $(
                                    '#unit_month4').val(), $('#unit_month5').val(), $(
                                    '#unit_month6').val(), $('#unit_month7').val(), $(
                                    '#unit_month8').val(), $('#unit_month9').val(), $(
                                    '#unit_month10').val(), $('#unit_month11').val()]
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
            // Unit Month Chart
            $("#sale_month0,#sale_month1,#sale_month2,#sale_month3,#sale_month4,#sale_month5,#sale_month6,#sale_month7,#sale_month8,#sale_month9,#sale_month10,#sale_month11")
                .keyup(function() {
                    var ctx = document.getElementById('sale_month_chart').getContext("2d");
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
                                data: [0, $('#sale_month0').val(), $('#sale_month1').val(), $(
                                    '#sale_month2').val(), $('#sale_month3').val(), $(
                                    '#sale_month4').val(), $('#sale_month5').val(), $(
                                    '#sale_month6').val(), $('#sale_month7').val(), $(
                                    '#sale_month8').val(), $('#sale_month9').val(), $(
                                    '#sale_month10').val(), $('#sale_month11').val()]
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
            //Billable Month calculate

            $("#billable_month0,#billable_month1,#billable_month2,#billable_month3,#billable_month4,#billable_month5,#billable_month6,#billable_month7,#billable_month8,#billable_month9,#billable_month10,#billable_month11")
                .keyup(function() {
                    var billable_month0 = $('#billable_month0').val();
                    var billable_month1 = $('#billable_month1').val();
                    var billable_month2 = $('#billable_month2').val();
                    var billable_month3 = $('#billable_month3').val();
                    var billable_month4 = $('#billable_month4').val();
                    var billable_month5 = $('#billable_month5').val();
                    var billable_month6 = $('#billable_month6').val();
                    var billable_month7 = $('#billable_month7').val();
                    var billable_month8 = $('#billable_month8').val();
                    var billable_month9 = $('#billable_month9').val();
                    var billable_month10 = $('#billable_month10').val();
                    var billable_month11 = $('#billable_month11').val();
                    $('#billable_month_total').val((billable_month0 * 1) + (billable_month1 * 1) + (
                            billable_month2 * 1) + (billable_month3 * 1) +
                        (billable_month4 * 1) + (billable_month5 * 1) + (billable_month6 * 1) + (
                            billable_month7 * 1) + (billable_month8 * 1) + (billable_month9 * 1) + (
                            billable_month10 * 1) + (billable_month11 * 1));

                    // Billable Month Chat

                    var ctx = document.getElementById('billable_month_chart').getContext("2d");

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
                                data: [0, $('#billable_month0').val(), $('#billable_month1')
                                    .val(), $('#billable_month2').val(), $(
                                        '#billable_month3').val(), $('#billable_month4')
                                    .val(), $('#billable_month5').val(), $(
                                        '#billable_month6').val(), $('#billable_month7')
                                    .val(), $('#billable_month8').val(), $(
                                        '#billable_month9').val(), $('#billable_month10')
                                    .val(), $('#billable_month11').val()
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
            //Billable Hour Month Chart

            $("#rate_month0,#rate_month1,#rate_month2,#rate_month3,#rate_month4,#rate_month5,#rate_month6,#rate_month7,#rate_month8,#rate_month9,#rate_month10,#rate_month11")
                .keyup(function() {
                    var ctx = document.getElementById('rate_month_chart').getContext("2d");

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
                                data: [0, $('#rate_month0').val(), $('#rate_month1').val(), $(
                                    '#rate_month2').val(), $('#rate_month3').val(), $(
                                    '#rate_month4').val(), $('#rate_month5').val(), $(
                                    '#rate_month6').val(), $('#rate_month7').val(), $(
                                    '#rate_month8').val(), $('#rate_month9').val(), $(
                                    '#rate_month10').val(), $('#rate_month11').val()]
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
            //Revenue Only Month calculate

            
            //Recurring Signup calculate

            $("#signup_month0,#signup_month1,#signup_month2,#signup_month3,#signup_month4,#signup_month5,#signup_month6,#signup_month7,#signup_month8,#signup_month9,#signup_month10,#signup_month11")
                .keyup(function() {
                    var signup_month0 = $('#signup_month0').val();
                    var signup_month1 = $('#signup_month1').val();
                    var signup_month2 = $('#signup_month2').val();
                    var signup_month3 = $('#signup_month3').val();
                    var signup_month4 = $('#signup_month4').val();
                    var signup_month5 = $('#signup_month5').val();
                    var signup_month6 = $('#signup_month6').val();
                    var signup_month7 = $('#signup_month7').val();
                    var signup_month8 = $('#signup_month8').val();
                    var signup_month9 = $('#signup_month9').val();
                    var signup_month10 = $('#signup_month10').val();
                    var signup_month11 = $('#signup_month11').val();
                    $('#signup_month_total').val((signup_month0 * 1) + (signup_month1 * 1) + (
                            signup_month2 * 1) + (signup_month3 * 1) +
                        (signup_month4 * 1) + (signup_month5 * 1) + (signup_month6 * 1) + (
                            signup_month7 * 1) + (signup_month8 * 1) + (signup_month9 * 1) + (
                            signup_month10 * 1) + (signup_month11 * 1));

                    // Signup Month Chart
                    var ctx = document.getElementById('signup_month_chart').getContext("2d");

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
                                data: [0, $('#signup_month0').val(), $('#signup_month1').val(),
                                    $('#signup_month2').val(), $('#signup_month3').val(),
                                    $('#signup_month4').val(), $('#signup_month5').val(),
                                    $('#signup_month6').val(), $('#signup_month7').val(),
                                    $('#signup_month8').val(), $('#signup_month9').val(),
                                    $('#signup_month10').val(), $('#signup_month11').val()]
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

            //Up Front Month Caht

            $("#up_front_month0,#up_front_month1,#up_front_month2,#up_front_month3,#up_front_month4,#up_front_month5,#up_front_month6,#up_front_month7,#up_front_month8,#up_front_month9,#up_front_month10,#up_front_month11")
                .keyup(function() {
                    var ctx = document.getElementById('up_front_month_chart').getContext("2d");

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
                                data: [0, $('#up_front_month0').val(), $('#up_front_month1')
                                    .val(), $(
                                        '#up_front_month2').val(), $('#up_front_month3')
                                    .val(), $(
                                        '#up_front_month4').val(), $('#up_front_month5')
                                    .val(), $(
                                        '#up_front_month6').val(), $('#up_front_month7')
                                    .val(), $(
                                        '#up_front_month8').val(), $('#up_front_month9')
                                    .val(), $(
                                        '#up_front_month10').val(), $('#up_front_month11')
                                    .val()
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
            
            //Recurring Month Chart

            $("#recurring_month0,#recurring_month1,#recurring_month2,#recurring_month3,#recurring_month4,#recurring_month5,#recurring_month6,#recurring_month7,#recurring_month8,#recurring_month9,#recurring_month10,#recurring_month11")
                .keyup(function() {
                    var ctx = document.getElementById('recurring_month_chart').getContext("2d");

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
                                data: [0, $('#recurring_month0').val(), $('#recurring_month1')
                                    .val(), $(
                                        '#recurring_month2').val(), $('#recurring_month3')
                                    .val(), $(
                                        '#recurring_month4').val(), $('#recurring_month5')
                                    .val(), $(
                                        '#recurring_month6').val(), $('#recurring_month7')
                                    .val(), $(
                                        '#recurring_month8').val(), $('#recurring_month9')
                                    .val(), $(
                                        '#recurring_month10').val(), $('#recurring_month11')
                                    .val()
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

                //Churn Month Chart

            $("#churn_month0,#churn_month1,#churn_month2,#churn_month3,#churn_month4,#churn_month5,#churn_month6,#churn_month7,#churn_month8,#churn_month9,#churn_month10,#churn_month11")
                .keyup(function() {
                    var ctx = document.getElementById('churn_month_chart').getContext("2d");

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
                                data: [0, $('#churn_month0').val(), $('#churn_month1')
                                    .val(), $(
                                        '#churn_month2').val(), $('#churn_month3')
                                    .val(), $(
                                        '#churn_month4').val(), $('#churn_month5')
                                    .val(), $(
                                        '#churn_month6').val(), $('#churn_month7')
                                    .val(), $(
                                        '#churn_month8').val(), $('#churn_month9')
                                    .val(), $(
                                        '#churn_month10').val(), $('#churn_month11')
                                    .val()
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
            
                //Only Revenue Month calculate

            $("#revenue_month0,#revenue_month1,#revenue_month2,#revenue_month3,#revenue_month4,#revenue_month5,#revenue_month6,#revenue_month7,#revenue_month8,#revenue_month9,#revenue_month10,#revenue_month11")
                .keyup(function() {
                    var revenue_month0 = $('#revenue_month0').val();
                    var revenue_month1 = $('#revenue_month1').val();
                    var revenue_month2 = $('#revenue_month2').val();
                    var revenue_month3 = $('#revenue_month3').val();
                    var revenue_month4 = $('#revenue_month4').val();
                    var revenue_month5 = $('#revenue_month5').val();
                    var revenue_month6 = $('#revenue_month6').val();
                    var revenue_month7 = $('#revenue_month7').val();
                    var revenue_month8 = $('#revenue_month8').val();
                    var revenue_month9 = $('#revenue_month9').val();
                    var revenue_month10 = $('#revenue_month10').val();
                    var revenue_month11 = $('#revenue_month11').val();
                    $('#revenue_month_total').val((revenue_month0 * 1) + (revenue_month1 * 1) + (
                            revenue_month2 * 1) + (revenue_month3 * 1) +
                        (revenue_month4 * 1) + (revenue_month5 * 1) + (revenue_month6 * 1) + (
                            revenue_month7 * 1) + (revenue_month8 * 1) + (revenue_month9 * 1) + (
                            revenue_month10 * 1) + (revenue_month11 * 1));

                    // Only Revenue Month Chat

                    var ctx = document.getElementById('revenue_month_chart').getContext("2d");

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
                                data: [0, $('#revenue_month0').val(), $('#revenue_month1')
                                    .val(), $('#revenue_month2').val(), $(
                                        '#revenue_month3').val(), $('#revenue_month4')
                                    .val(), $('#revenue_month5').val(), $(
                                        '#revenue_month6').val(), $('#revenue_month7')
                                    .val(), $('#revenue_month8').val(), $(
                                        '#revenue_month9').val(), $('#revenue_month10')
                                    .val(), $('#revenue_month11').val()
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
            

            // DataTable initialisation
            $('#total').DataTable({
                "paging": false,
                "autoWidth": true,
                "order": [],
                "footerCallback": function(row) {
                    var api = this.api();
                    nb_cols = api.columns().nodes().length;
                    var j = 2;
                    while (j <= nb_cols) {
                        var pageTotal = api
                            .column(j, {
                                page: 'current'
                            })
                            .data()
                            .reduce(function(a, b) {
                                return Number(a) + Number(b);
                            }, 0);
                        // Update footer
                        $(api.column(j).footer()).html(pageTotal);
                        j++;
                    }
                }
            });
            $('.nav-tabs > li a[title]').tooltip();
            //Wizard
            $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
                var target = $(e.target);
                if (target.parent().hasClass('disabled')) {
                    return false;
                }
            });
            $(".next-step").click(function(e) {
                var active = $('.wizard .nav-tabs li.active');
                active.next().removeClass('disabled');
                nextTab(active);
            });
            $(".prev-step").click(function(e) {
                var active = $('.wizard .nav-tabs li.active');
                prevTab(active);
            });
        });

        function nextTab(elem) {
            $(elem).next().find('a[data-toggle="tab"]').click();
        }

        function prevTab(elem) {
            $(elem).prev().find('a[data-toggle="tab"]').click();
        }
        $('.nav-tabs').on('click', 'li', function() {
            $('.nav-tabs li.active').removeClass('active');
            $(this).addClass('active');
        });
    </script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/izitoast@1.4.0/dist/js/iziToast.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/5.10.0/tinymce.min.js"></script>
    @foreach ($personnel as $item)
        <script>
            function personnelDelete{{ $item->id }}(id) {
                swal({
                    title: "Are You Sure Want To Delete?",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                }).then((willDelete) => {
                    if (willDelete) {
                        var url = '{{ route('admin.deletePersonnel', ':id') }}';
                        url = url.replace(':id', id);
                        $.ajax({
                            type: "POST",
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            url: url,
                            dataType: "json",
                            data: {
                                id: id
                            },
                            success: function(data) {
                                console.log(data);
                                //var data = JSON.parse(response);
                                iziToast.success({
                                    message: data.message,
                                    position: 'topRight'
                                });
                                //Reload page
                                window.location.reload();

                            }
                        });
                    }
                });

            }
        </script>
    @endforeach
@endsection

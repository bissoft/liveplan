@extends('layouts.admin')
@section('content')
    <div class="revanu">
        <ul class="nav nav-pills nav-pills-success mb-3" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link active" data-bs-toggle="pill" href="#success-pills-home" role="tab" aria-selected="true">
                    <div class="tab-title">Revenue</div>
                </a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" data-bs-toggle="pill" href="#success-pills-profile" role="tab"
                    aria-selected="false">
                    <div class="tab-title">Direct Costs</div>
                </a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" data-bs-toggle="pill" href="#success-pills-contact" role="tab"
                    aria-selected="false">
                    <div class="tab-title">Expenses</div>
                </a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" data-bs-toggle="pill" href="#success-pills-contact1" role="tab"
                    aria-selected="false">
                    <div class="tab-title">Assets</div>
                </a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" data-bs-toggle="pill" href="#success-pills-contact2" role="tab"
                    aria-selected="false">
                    <div class="tab-title">Taxes</div>
                </a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" data-bs-toggle="pill" href="#success-pills-contact3" role="tab"
                    aria-selected="false">
                    <div class="tab-title">Dividends</div>
                </a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" data-bs-toggle="pill" href="#success-pills-contact4" role="tab"
                    aria-selected="false">
                    <div class="tab-title">Cash Flow Assumptions</div>
                </a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" data-bs-toggle="pill" href="#success-pills-contact5" role="tab"
                    aria-selected="false">
                    <div class="tab-title">Financing</div>
                </a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane fade show active" id="success-pills-home" role="tabpanel">
                <h4 class="mb-2">Renvue</h4>
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
                    <button class="btn btn-primary my-3" data-bs-toggle="modal" data-bs-target="#exampleModal">Add Revenue
                        Stream</button>
                </div>
                <div class="row mx-0">
                    <div class="card">
                        <div class="card-body table-responsive">
                            <table id="total" cellspacing="0" width="100%" class="table table-bordered mb-0">
                                <thead>
                                    <tr>
                                        <th>
                                            <button class="btn bg-transparent p-1"><i class="fa fa-angle-down"></i></button>
                                        </th>
                                        <th class="sub-title">Revenue</th>
                                        @php
                                            use Carbon\Carbon;
                                        @endphp
                                        @for ($i = 0; $i < 11; $i++)
                                            <th scope="col">{{ Carbon::now()->addMonth($i)->format('M Y') }}</th>
                                        @endfor
                                        @for ($i = 1; $i < 6; $i++)
                                            <th scope="col">FY{{ Carbon::now()->addYear($i)->format('Y') }}</th>
                                        @endfor
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($revenue as $item)
                                        <tr id="id_row">
                                            <td>
                                                <button class="btn bg-transparent p-1"><i
                                                        class="fa fa-angle-down"></i></button>
                                            </td>
                                            <td class="sub-title"> {{ $item->name ?? '' }}
                                                <div class="icons"> <a href="#" class="btn bg-transparent p-0"><i
                                                            class="fa fa-edit"></i></a> <a href="#"
                                                        class="btn bg-transparent p-0"><i class="fa fa-copy"></i></a>
                                                </div>
                                            </td>
                                            @if ($item->type == 4)
                                                @if ($item->constant == 0)
                                                    @for ($i = 0; $i < 11; $i++)
                                                        <td>{{ $item->amount ?? '' }}</td>
                                                    @endfor
                                                    @for ($i = 1; $i < 6; $i++)
                                                        @if ($i == 1)
                                                            <td>{{ $item->amount * 10 }}</td>
                                                        @else
                                                            <td>{{ $item->amount * 10 + $item->amount }}</td>
                                                        @endif
                                                    @endfor
                                                @else
                                                    @php
                                                        $arr = json_decode($item->amount, true);
                                                    @endphp
                                                    @foreach ($arr as $item1)
                                                        <td>
                                                            {{ $item1 }}
                                                        </td>
                                                    @endforeach
                                                @endif
                                            @endif
                                            @if ($item->type == 1 || $item->type == 2 || $item->type == 3)
                                                @if ($item->constant == 0 && $item->unit_price_constant == 0)
                                                    @for ($i = 0; $i < 11; $i++)
                                                        <td>{{ $item->amount * $item->unit_price }}
                                                        </td>
                                                    @endfor
                                                    @for ($i = 1; $i < 6; $i++)
                                                        @if ($i == 1)
                                                            <td>{{ $item->amount * $item->unit_price }}
                                                            </td>
                                                        @else
                                                            <td>{{ $item->amount * $item->unit_price * 12 }}</td>
                                                        @endif
                                                    @endfor
                                                @elseif ($item->constant == 1 && $item->unit_price_constant == 0)
                                                    @php
                                                        $arr = json_decode($item->amount, true);
                                                    @endphp
                                                    @foreach ($arr as $item1)
                                                        <td>
                                                            {{ $item1 * $item->unit_price }}
                                                        </td>
                                                    @endforeach
                                                @elseif ($item->constant == 0 && $item->unit_price_constant == 1)
                                                    @php
                                                        $arr1 = json_decode($item->unit_price_constant, true);
                                                    @endphp
                                                    @foreach ($arr1 as $item1)
                                                        <td>
                                                            {{ $item1 * $item->amount }}
                                                        </td>
                                                    @endforeach
                                                @elseif ($item->constant == 1 && $item->unit_price_constant == 1)
                                                    @php
                                                        $arr = json_decode($item->amount, true);
                                                        $arr1 = json_decode($item->unit_price, true);
                                                    @endphp

                                                    @for ($i = 0; $i < 16; $i++)
                                                        {{-- {{dd($arr1)}} --}}
                                                        <td>
                                                            {{ $arr[$i] * $arr1[$i] }}
                                                        </td>
                                                    @endfor
                                                @else
                                                @endif
                                            @endif
                                        </tr>
                                        @if ($item->type == 1)
                                            <tr>
                                                <td></td>
                                                <td class="sub-title">Unit Sales</td>

                                                @if ($item->constant == 0)
                                                    @for ($i = 0; $i < 11; $i++)
                                                        <td>{{ $item->amount ?? '' }}</td>
                                                    @endfor
                                                    @for ($i = 1; $i < 6; $i++)
                                                        @if ($i == 1)
                                                            <td>{{ $item->amount }}</td>
                                                        @else
                                                            <td>{{ $item->amount * 12 }}</td>
                                                        @endif
                                                    @endfor
                                                @else
                                                    @php
                                                        $arr = json_decode($item->amount, true);
                                                    @endphp
                                                    @foreach ($arr as $item1)
                                                        <td>
                                                            {{ $item1 }}
                                                        </td>
                                                    @endforeach
                                                @endif
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td class="sub-title">Unit Prices</td>
                                                @if ($item->unit_price_constant == 0)
                                                    @for ($i = 0; $i < 11; $i++)
                                                        <td>{{ $item->unit_price ?? '' }}</td>
                                                    @endfor
                                                    @for ($i = 1; $i < 6; $i++)
                                                        @if ($i == 1)
                                                            <td>{{ $item->unit_price }}</td>
                                                        @else
                                                            <td>{{ $item->unit_price * 12 }}</td>
                                                        @endif
                                                    @endfor
                                                @else
                                                    @php
                                                        $arr = json_decode($item->unit_price, true);
                                                    @endphp
                                                    @foreach ($arr as $item1)
                                                        <td>
                                                            {{ $item1 }}
                                                        </td>
                                                    @endforeach
                                                @endif
                                            </tr>
                                        @endif
                                        @if ($item->type == 2)
                                            <tr>
                                                <td></td>
                                                <td class="sub-title">Billable Hours</td>

                                                @if ($item->constant == 0)
                                                    @for ($i = 0; $i < 11; $i++)
                                                        <td>{{ $item->amount ?? '' }}</td>
                                                    @endfor
                                                    @for ($i = 1; $i < 6; $i++)
                                                        @if ($i == 1)
                                                            <td>{{ $item->amount }}</td>
                                                        @else
                                                            <td>{{ $item->amount * 12 }}</td>
                                                        @endif
                                                    @endfor
                                                @else
                                                    @php
                                                        $arr = json_decode($item->amount, true);
                                                    @endphp
                                                    @foreach ($arr as $item1)
                                                        <td>
                                                            {{ $item1 }}
                                                        </td>
                                                    @endforeach
                                                @endif
                                            </tr>
                                            <tr>
                                                <td></td>
                                                <td class="sub-title">Hourly Rate</td>
                                                @if ($item->unit_price_constant == 0)
                                                    @for ($i = 0; $i < 11; $i++)
                                                        <td>{{ $item->unit_price ?? '' }}</td>
                                                    @endfor
                                                    @for ($i = 1; $i < 6; $i++)
                                                        @if ($i == 1)
                                                            <td>{{ $item->unit_price }}</td>
                                                        @else
                                                            <td>{{ $item->unit_price * 12 }}</td>
                                                        @endif
                                                    @endfor
                                                @else
                                                    @php
                                                        $arr = json_decode($item->unit_price, true);
                                                    @endphp
                                                    @foreach ($arr as $item1)
                                                        <td>
                                                            {{ $item1 }}
                                                        </td>
                                                    @endforeach
                                                @endif
                                            </tr>
                                        @endif
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
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tell us about this revenue stream</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mt-4">
                            <div class="wizard">
                                <div class="wizard-inner">
                                    <div class="connecting-line"></div>
                                    <ul class="nav nav-tabs" role="tablist">
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
                                                <i>Unit scale</i></a> </li>
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
                                            <form>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1" class="mb-2">What do you
                                                        want
                                                        to call it?</label>
                                                    <input type="text" name="name" value="{{ old('name') }}"
                                                        class="form-control" id="" aria-describedby="emailHelp"
                                                        placeholder="Enter Name">

                                                </div>
                                            </form>
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
                                                    id="inlineRadio1" value="0" checked>
                                                <label class="form-check-label" for="inlineRadio1">Constant
                                                    amount</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="constant"
                                                    id="inlineRadio2" value="1">
                                                <label class="form-check-label" for="inlineRadio2">Varying amounts over
                                                    time</label>
                                            </div>
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
                                                    @for ($i = 0; $i < 11; $i++)
                                                        <option value="{{ Carbon::now()->addMonth($i)->format('M Y') }}">
                                                            {{ Carbon::now()->addMonth($i)->format('M Y') }}</option>
                                                    @endfor
                                                    @for ($i = 2; $i < 6; $i++)
                                                        <option value="{{ Carbon::now()->addYear($i)->format('Y') }}">
                                                            FY{{ Carbon::now()->addYear($i)->format('Y') }}</option>
                                                    @endfor
                                                </select>
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
                                                <input class="form-check-input" type="radio" name="unit_constant"
                                                    id="inlineRadio11" value="0" checked>
                                                <label class="form-check-label" for="inlineRadio11">Constant
                                                    amount</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="unit_constant"
                                                    id="inlineRadio21" value="1">
                                                <label class="form-check-label" for="inlineRadio21">Varying amounts
                                                    over
                                                    time</label>
                                            </div>
                                            <div class="col-12 col-md-6 mt-3 position-relative">
                                                <input class="form-control  pl-2" placeholder="$" type="number"
                                                    name="unit_constant_price">
                                                <i class="fa fa-dollar-sign"
                                                    style="position: absolute;top: 12px;left: 3px;"></i>
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
                                        <div class="tab-pane" role="tabpanel" id="step5">
                                            <h6 class="font-weight-bold">How many hours will you bill for?</h6>
                                            <p><small>Estimate how many billing hours you will have in each period. You can
                                                    set this as a flat amount or vary the count over time to reflect growth,
                                                    seasonality, added resources, and so on.</small></p>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="billable_constant"
                                                    id="inlineRadio1" value="0" checked>
                                                <label class="form-check-label" for="inlineRadio1">Constant
                                                    amount</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="billable_constant"
                                                    id="inlineRadio2" value="1">
                                                <label class="form-check-label" for="inlineRadio2">Varying amounts over
                                                    time</label>
                                            </div>
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
                                                    @for ($i = 0; $i < 11; $i++)
                                                        <option value="{{ Carbon::now()->addMonth($i)->format('M Y') }}">
                                                            {{ Carbon::now()->addMonth($i)->format('M Y') }}</option>
                                                    @endfor
                                                    @for ($i = 2; $i < 6; $i++)
                                                        <option value="{{ Carbon::now()->addYear($i)->format('Y') }}">
                                                            FY{{ Carbon::now()->addYear($i)->format('Y') }}</option>
                                                    @endfor
                                                </select>
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
                                        <div class="tab-pane" role="tabpanel" id="step6">
                                            <h6 class="font-weight-bold">What will you charge per hour?</h6>
                                            <p><small>Enter your hourly rate (excluding sales tax) below. You can set a
                                                    constant rate or vary it over time to reflect planned rate changes,
                                                    different mixes of billable work, and so on.</small></p>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="billable_hour_constant"
                                                    id="inlineRadio11" value="0" checked>
                                                <label class="form-check-label" for="inlineRadio11">Constant
                                                    amount</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="billable_hour_constant"
                                                    id="inlineRadio21" value="1">
                                                <label class="form-check-label" for="inlineRadio21">Varying amounts
                                                    over
                                                    time</label>
                                            </div>
                                            <div class="col-12 col-md-6 mt-3 position-relative">
                                                <input class="form-control  pl-2" type="number" placeholder="$"
                                                    name="billable_hour_amount">
                                                <i class="fa fa-dollar-sign"
                                                    style="position: absolute;top: 12px;left: 3px;"></i>
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

                                        {{-- Step 10 --}}
                                        <div class="tab-pane" role="tabpanel" id="step10">
                                            <h6 class="font-weight-bold">How much will you make from this revenue stream?</h6>
                                            <p><small>You have chosen to enter revenue totals only for this revenue stream, rather than building up those totals from unit sales, signups, or other details. Just enter the projected revenue amount below.</small></p>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="revenue_constant"
                                                    id="inlineRadio1" value="0" checked>
                                                <label class="form-check-label" for="inlineRadio1">Constant
                                                    amount</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="revenue_constant"
                                                    id="inlineRadio2" value="1">
                                                <label class="form-check-label" for="inlineRadio2">Varying amounts over
                                                    time</label>
                                            </div>
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
                                                    @for ($i = 0; $i < 11; $i++)
                                                        <option value="{{ Carbon::now()->addMonth($i)->format('M Y') }}">
                                                            {{ Carbon::now()->addMonth($i)->format('M Y') }}</option>
                                                    @endfor
                                                    @for ($i = 2; $i < 6; $i++)
                                                        <option value="{{ Carbon::now()->addYear($i)->format('Y') }}">
                                                            FY{{ Carbon::now()->addYear($i)->format('Y') }}</option>
                                                    @endfor
                                                </select>
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
                                </form>
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
    <script type="text/javascript">
        window.addEventListener('load', function() {
            var ctx = document.getElementById('chartVerticalBar1').getContext('2d');
            var chart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ["Jan", "fav", "Mar", "Apr", "Mai", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov",
                        "Dec"
                    ],
                    datasets: [{
                        label: false,
                        backgroundColor: '#18c1f6',
                        borderColor: 'rgba(245,34,34,1)',
                        data: [801, 892, 874, 862, 874, 907, 932, 929, 924, 953, 1031, 987],
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
    <script type="text/javascript">
        window.addEventListener('load', function() {
            var ctx = document.getElementById('chartVerticalBar').getContext('2d');
            var chart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ["Jan", "fav", "Mar", "Nov", "Dec"],
                    datasets: [{
                        label: false,
                        backgroundColor: '#18c1f6',
                        borderColor: 'rgba(245,34,34,1)',
                        data: [801, 892, 874, 862, 874],
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
        function Type1() {
            document.getElementById('type1_1').style.display = 'block';
            document.getElementById('type1_2').style.display = 'block';
            document.getElementById('type2_1').style.display = 'none';
            document.getElementById('type2_2').style.display = 'none';
            document.getElementById('type4_1').style.display = 'none';

        }

        function Type2() {
            document.getElementById('type1_1').style.display = 'none';
            document.getElementById('type1_2').style.display = 'none';
            document.getElementById('type2_1').style.display = 'block';
            document.getElementById('type2_2').style.display = 'block';
            document.getElementById('type4_1').style.display = 'none';

        }

        function Type3() {
            document.getElementById('type1_1').style.display = 'none';
            document.getElementById('type1_2').style.display = 'none';
            document.getElementById('type2_1').style.display = 'none';
            document.getElementById('type2_2').style.display = 'none';
            document.getElementById('type4_1').style.display = 'none';

        }

        function Type4() {
            document.getElementById('type1_1').style.display = 'none';
            document.getElementById('type1_2').style.display = 'none';
            document.getElementById('type2_1').style.display = 'none';
            document.getElementById('type2_2').style.display = 'none';
            document.getElementById('type4_1').style.display = 'block';

        }
    </script>
    <script type="text/javascript">
        // ------------step-wizard-------------
        $(document).ready(function() {
            document.getElementById('type1_1').style.display = 'none';
            document.getElementById('type1_2').style.display = 'none';
            document.getElementById('type2_1').style.display = 'none';
            document.getElementById('type2_2').style.display = 'none';
            document.getElementById('type4_1').style.display = 'none';
            // DataTable initialisation
            $('#total').DataTable({
                "paging": false,
                "autoWidth": true,
                "order": [],
                "footerCallback": function(row) {
                    var api = this.api();
                    nb_cols = api.columns().nodes().length;
                    var j = 2;
                    while (j < nb_cols) {
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
@endsection

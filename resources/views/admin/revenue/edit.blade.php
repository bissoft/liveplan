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
                        <h4 class="mb-0">Update Revenue</h4>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form role="form" action="{{ route('admin.revenue.update', $revenue->id) }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-12 col-md-12 mt-3">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Name <small style="color:red;">*</small></label>
                                <input type="text" name="name" value="{{ $revenue->name ?? old('name') }}"
                                    class="form-control" required>
                                {!! $errors->first('name', "<span class='text-danger'>:message</span>") !!}
                            </div>
                        </div>
                        <div class="col-12 col-md-6 mt-3">
                            <div class="form-group">
                                <label for="exampleInputEmail1">What type of revenue stream is this? <small
                                        style="color:red;">*</small></label>
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="radio" name="type" onclick="Type1();"
                                        value="1" required @if ($revenue->type == 1) checked @endif>
                                    <label class="form-check-label" for="exampleRadios1">
                                        Unit sales
                                    </label>
                                    <small class="d-block">Best for products that are sold in
                                        individual
                                        units or set quantities</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 mt-3">
                            <div class="form-check mb-3">
                                <input class="form-check-input" type="radio" name="type" onclick="Type2();"
                                    value="2" required @if ($revenue->type == 2) checked @endif>
                                <label class="form-check-label" for="exampleRadios2">
                                    Billable hours
                                </label>
                                <small class="d-block">Best for products that are sold in
                                    individual
                                    units or s products that are sold in individual units or set
                                    quantities</small>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 mt-3">
                            <div class="form-check mb-3">
                                <input class="form-check-input" type="radio" name="type" onclick="Type3();"
                                    value="3" required @if ($revenue->type == 3) checked @endif>
                                <label class="form-check-label" for="exampleRadios3">
                                    Recurring charges
                                </label>
                                <small class="d-block">Best for products that are sold in
                                    individual
                                    units or s products that are sold in individual units or set
                                    quantities</small>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 mt-3">
                            <div class="form-check mb-3">
                                <input class="form-check-input" type="radio" name="type" onclick="Type4();"
                                    value="4" required @if ($revenue->type == 4) checked @endif>
                                <label class="form-check-label" for="exampleRadios4">
                                    Revenue only
                                </label>
                                <small class="d-block">Best for products that are sold in
                                    individual
                                    units or s products that are sold in individual units or set
                                    quantities</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-12 mt-3">
                        <div class="form-group">
                            {{-- Unit Sale step3 --}}
                            <div id="step3">
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
                                    <input class="form-check-input" type="radio" checked name="constant" value="0"
                                        onclick="step1_constant()" @if($revenue->constant==0) selected @endif>
                                    <label class="form-check-label" for="inlineRadio1">Constant
                                        amount</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" onclick="step1_varying()" name="constant"
                                        value="1" @if($revenue->constant==1) selected @endif>
                                    <label class="form-check-label" for="inlineRadio2">Varying amounts over
                                        time</label>
                                </div>
                                <div id="step1_constant">
                                    <div class="row align-items-center mt-3">
                                        <div class="col-12 col-md-6 ">
                                            <input class="form-control" type="text" name="constant_amount"
                                                value="@if($revenue->constant==0){{ $revenue->amount??'' }} @else @endif" placeholder="$">
                                        </div>
                                        <div class="col-12 col-md-2 text-center">Per</div>
                                        <div class="col-12 col-md-4">
                                            <div class="form-group">
                                                <select class="form-control" name="constant_type"
                                                    id="exampleFormControlSelect1">
                                                    <option value="0" @if($revenue->amount_type==0) selected @endif>Month</option>
                                                    <option value="1" @if($revenue->amount_type==1) selected @endif>Year</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group mt-3">
                                        <label for="exampleFormControlSelect1"> When will this revenue
                                            start?</label>
                                        <select class="form-control" name="constant_start" id="exampleFormControlSelect1">
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
                                </div>
                                <div class="varning-amount mt-3" id="step1_varying">
                                    <h4>FY{{ Carbon::now()->format('Y') }}</h4>
                                    <canvas id="line-Chart" style="max-height:350px;"></canvas>
                                    @if($revenue->constant==1)
                                    @php
                                        $arr = json_decode($revenue->amount,true);
                                    @endphp
                                    @endif
                                    <div class="cahrt-value">
                                        @for ($i = 0; $i < 12; $i++)
                                            <div class="input-filed">
                                                <label for="">{{ Carbon::now()->addMonth($i)->format('M Y') }}</label>
                                                <input type="number" class="form-control"
                                                    name="unit_month{{ $i }}"
                                                    id="unit_month{{ $i }}" value="{{$arr[$i]??''}}">
                                            </div>
                                        @endfor
                                        
                                        <div class="input-filed">
                                            <label for="">Total</label>
                                            <input type="number" class="form-control" name="unit_month_total"
                                                id="unit_month_total" value="{{$arr[12]??''}}" >
                                        </div>
                                    </div>
                                    <div class="cahrt-value">
                                        @for ($i = 2; $i < 6; $i++)
                                            <div class="input-filed">
                                                <label for="">FY{{ Carbon::now()->addYear($i)->format('Y') }}</label>
                                                <input type="number" class="form-control"
                                                    name="unit_year{{ $i }}" value="{{$arr[11+$i]??''}}">
                                            </div>
                                        @endfor
                                    </div>
                                </div>

                                
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
                                    <input class="form-check-input" type="radio" name="sale_constant" id="inlineRadio11"
                                        value="0" checked onclick="step2_constant()" @if($revenue->constant==0) selected @endif>
                                    <label class="form-check-label" for="inlineRadio11">Constant
                                        amount</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="sale_constant" id="inlineRadio21"
                                        value="1" onclick="step2_varying()" @if($revenue->constant==1) selected @endif>
                                    <label class="form-check-label" for="inlineRadio21">Varying amounts
                                        over
                                        time</label>
                                </div>
                                <div id="step2_constant">
                                    <div class="col-12 col-md-6 mt-3 position-relative">
                                        <input class="form-control  pl-2" placeholder="$" type="number"
                                            name="sale_constant_price" value="">
                                        <i class="fa fa-dollar-sign" style="position: absolute;top: 12px;left: 3px;"></i>
                                    </div>
                                </div>
                                <div class="varning-amount mt-3" id="step2_varying">
                                    <h4>FY{{ Carbon::now()->format('Y') ?? '' }}</h4>
                                    <canvas id="line-Chart1" style="max-height:350px;"></canvas>
                                    <div class="cahrt-value">
                                        @for ($i = 0; $i < 12; $i++)
                                            <div class="input-filed">
                                                <label for="">{{ Carbon::now()->addMonth($i)->format('M Y') }}</label>
                                                <input type="number" class="form-control"
                                                    name="sale_month{{ $i }}">
                                            </div>
                                        @endfor
                                    </div>
                                    <div class="cahrt-value">
                                        @for ($i = 1; $i < 6; $i++)
                                            <div class="input-filed">
                                                <label for="">FY{{ Carbon::now()->addYear($i)->format('Y') }}</label>
                                                <input type="number" class="form-control"
                                                    name="sale_year{{ $i }}">
                                            </div>
                                        @endfor



                                    </div>
                                </div>
                                
                            </div>
                            {{-- Billable Hours step 5 --}}
                            <div class="tab-pane" role="tabpanel" id="step5">
                                <h6 class="font-weight-bold">How many hours will you bill for?</h6>
                                <p><small>Estimate how many billing hours you will have in each period. You can
                                        set this as a flat amount or vary the count over time to reflect growth,
                                        seasonality, added resources, and so on.</small></p>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="billable_constant" id="inlineRadio1"
                                        value="0" checked onclick="step5_constant()">
                                    <label class="form-check-label" for="inlineRadio1">Constant
                                        amount</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="billable_constant" id="inlineRadio2"
                                        value="1" onclick="step5_varying()">
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
                                                <option value="{{ Carbon::now()->addMonth($i)->format('M Y') }}">
                                                    {{ Carbon::now()->addMonth($i)->format('M Y') }}</option>
                                            @endfor
                                            @for ($i = 2; $i < 6; $i++)
                                                <option value="{{ Carbon::now()->addYear($i)->format('Y') }}">
                                                    FY{{ Carbon::now()->addYear($i)->format('Y') }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                                <div class="varning-amount mt-3" id="step5_varying">
                                    <h4>FY{{ Carbon::now()->format('Y') }}</h4>
                                    <canvas id="line-Chart3" style="max-height:350px;"></canvas>
                                    <div class="cahrt-value">
                                        @for ($i = 0; $i < 12; $i++)
                                            <div class="input-filed">
                                                <label for="">{{ Carbon::now()->addMonth($i)->format('M Y') }}</label>
                                                <input type="number" class="form-control"
                                                    name="billable_month{{ $i }}"
                                                    id="billable_month{{ $i }}">
                                            </div>
                                        @endfor
                                        <div class="input-filed">
                                            <label for="">Total</label>
                                            <input type="number" class="form-control" name="billable_month_total"
                                                id="billable_month_total">
                                        </div>
                                    </div>
                                    <div class="cahrt-value">
                                        @for ($i = 2; $i < 6; $i++)
                                            <div class="input-filed">
                                                <label for="">FY{{ Carbon::now()->addYear($i)->format('Y') }}</label>
                                                <input type="number" class="form-control"
                                                    name="billable_year{{ $i }}">
                                            </div>
                                        @endfor
                                    </div>
                                </div>
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
                                        <i class="fa fa-dollar-sign" style="position: absolute;top: 12px;left: 3px;"></i>
                                    </div>
                                </div>
                                {{-- Billable Hourly Rate varying --}}
                                <div class="varning-amount mt-3" id="step6_varying">
                                    <h4>FY{{ Carbon::now()->format('Y') ?? '' }}</h4>
                                    <canvas id="line-Chart4" style="max-height:350px;"></canvas>
                                    <div class="cahrt-value">
                                        @for ($i = 0; $i < 12; $i++)
                                            <div class="input-filed">
                                                <label for="">{{ Carbon::now()->addMonth($i)->format('M Y') }}</label>
                                                <input type="number" class="form-control"
                                                    name="rate_month{{ $i }}">
                                            </div>
                                        @endfor
                                    </div>
                                    <div class="cahrt-value">
                                        @for ($i = 1; $i < 6; $i++)
                                            <div class="input-filed">
                                                <label for="">FY{{ Carbon::now()->addYear($i)->format('Y') }}</label>
                                                <input type="number" class="form-control"
                                                    name="rate_year{{ $i }}">
                                            </div>
                                        @endfor
                                    </div>
                                </div>
                            </div>
                            {{-- Recurring charges step7 --}}
                            <div class="tab-pane" role="tabpanel" id="step7">
                                <div class="form-group mt-3">
                                    <h6 class="font-weight-bold">When will this revenue start?</h6>
                                    <p><small>Let us know when you plan to start signing up customers or if you
                                            have
                                            already started before the forecast period.</small></p>
                                    <select class="form-control" name="recurring_start" id="exampleFormControlSelect1">
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
                                        <input class="form-check-input" type="radio" checked name="signup_constant"
                                            value="0" onclick="step7_constant()">
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
                                            <input class="form-control" type="text" name="signup_constant_amount"
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
                                    <canvas id="line-Chart7" style="max-height:350px;"></canvas>
                                    <div class="cahrt-value">
                                        @for ($i = 0; $i < 12; $i++)
                                            <div class="input-filed">
                                                <label for="">{{ Carbon::now()->addMonth($i)->format('M Y') }}</label>
                                                <input type="number" class="form-control"
                                                    name="signup_month{{ $i }}"
                                                    id="signup_month{{ $i }}">
                                            </div>
                                        @endfor
                                        <div class="input-filed">
                                            <label for="">Total</label>
                                            <input type="number" class="form-control" name="signup_month_total"
                                                id="signup_month_total">
                                        </div>
                                    </div>
                                    <div class="cahrt-value">
                                        @for ($i = 2; $i < 6; $i++)
                                            <div class="input-filed">
                                                <label for="">FY{{ Carbon::now()->addYear($i)->format('Y') }}</label>
                                                <input type="number" class="form-control"
                                                    name="signup_year{{ $i }}">
                                            </div>
                                        @endfor
                                    </div>
                                </div>
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
                                            <input class="form-check-input" type="radio" checked name="up_front_constant"
                                                value="2" onclick="step8_nofee()">
                                            <label class="form-check-label" for="inlineRadio1">No fee</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="up_front_constant" value="0"
                                                onclick="step8_constant()">
                                            <label class="form-check-label" for="inlineRadio1">Constant
                                                amount</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" onclick="step8_varying()"
                                                name="up_front_constant" value="1">
                                            <label class="form-check-label" for="inlineRadio2">Varying amounts
                                                over
                                                time</label>
                                        </div>
                                    </div>
                                </div>
                                <div id="step8_constant">
                                    <div class="row align-items-center mt-3">
                                        <div class="col-12 col-md-6 ">
                                            <input class="form-control" type="text" name=" up_front_constant_amount"
                                                value="{{ old('up_front_constant_amount') }}" placeholder="$">
                                        </div>

                                    </div>
                                </div>
                                <div class="varning-amount mt-3" id="step8_varying">
                                    <h4>FY{{ Carbon::now()->format('Y') }}</h4>
                                    <canvas id="line-Chart8" style="max-height:350px;"></canvas>
                                    <div class="cahrt-value">
                                        @for ($i = 0; $i < 12; $i++)
                                            <div class="input-filed">
                                                <label for="">{{ Carbon::now()->addMonth($i)->format('M Y') }}</label>
                                                <input type="number" class="form-control"
                                                    name="up_front_month{{ $i }}">
                                            </div>
                                        @endfor
                                    </div>
                                    <div class="cahrt-value">
                                        @for ($i = 1; $i < 6; $i++)
                                            <div class="input-filed">
                                                <label for="">FY{{ Carbon::now()->addYear($i)->format('Y') }}</label>
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
                                        <input class="form-check-input" type="radio" checked name="recurring_constant"
                                            value="0" onclick="step8_2_constant()">
                                        <label class="form-check-label" for="inlineRadio1">Constant
                                            amount</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" onclick="step8_2_varying()"
                                            name="recurring_constant" value="1">
                                        <label class="form-check-label" for="inlineRadio2">Varying amounts over
                                            time</label>
                                    </div>
                                </div>
                                <div id="step8_2_constant">
                                    <div class="row align-items-center mt-3">
                                        <div class="col-12 col-md-6 ">
                                            <input class="form-control" type="text" name="recurring_constant_amount"
                                                value="{{ old('recurring_constant_amount') }}" placeholder="$">
                                        </div>
                                        <div class="col-12 col-md-2 text-center">Per Month</div>
                                    </div>
                                </div>
                                <div class="varning-amount mt-3" id="step8_2_varying">
                                    <h4>FY{{ Carbon::now()->format('Y') }}</h4>
                                    <canvas id="line-Chart8_2" style="max-height:350px;"></canvas>
                                    <div class="cahrt-value">
                                        @for ($i = 0; $i < 12; $i++)
                                            <div class="input-filed">
                                                <label for="">{{ Carbon::now()->addMonth($i)->format('M Y') }}</label>
                                                <input type="number" class="form-control"
                                                    name="recurring_month{{ $i }}">
                                            </div>
                                        @endfor
                                    </div>
                                    <div class="cahrt-value">
                                        @for ($i = 1; $i < 6; $i++)
                                            <div class="input-filed">
                                                <label for="">FY{{ Carbon::now()->addYear($i)->format('Y') }}</label>
                                                <input type="number" class="form-control"
                                                    name="recurring_year{{ $i }}">
                                            </div>
                                        @endfor
                                    </div>
                                </div>
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
                                        <input class="form-check-input" type="radio" checked name="churn_constant"
                                            value="0" onclick="step9_constant()">
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
                                            <input class="form-control" type="text" name="churn_constant_amount"
                                                value="{{ old('churn_constant_amount') }}" placeholder="$">
                                        </div>
                                    </div>
                                </div>
                                <div class="varning-amount mt-3" id="step9_varying">
                                    <h4>FY{{ Carbon::now()->format('Y') }}</h4>
                                    <canvas id="line-Chart9" style="max-height:350px;"></canvas>
                                    <div class="cahrt-value">
                                        @for ($i = 0; $i < 12; $i++)
                                            <div class="input-filed">
                                                <label for="">{{ Carbon::now()->addMonth($i)->format('M Y') }}</label>
                                                <input type="number" class="form-control"
                                                    name="churn_month{{ $i }}">
                                            </div>
                                        @endfor
                                    </div>
                                    <div class="cahrt-value">
                                        @for ($i = 1; $i < 6; $i++)
                                            <div class="input-filed">
                                                <label for="">FY{{ Carbon::now()->addYear($i)->format('Y') }}</label>
                                                <input type="number" class="form-control"
                                                    name="churn_year{{ $i }}">
                                            </div>
                                        @endfor
                                    </div>
                                </div>

                                
                            </div>
                            {{-- Revenue only --}}
                            <div class="tab-pane" role="tabpanel" id="step10">
                                <h6 class="font-weight-bold">How much will you make from this revenue stream?
                                </h6>
                                <p><small>You have chosen to enter revenue totals only for this revenue stream,
                                        rather than building up those totals from unit sales, signups, or other
                                        details. Just enter the projected revenue amount below.</small></p>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="revenue_constant" id="inlineRadio1"
                                        value="0" onclick="step10_constant()" checked>
                                    <label class="form-check-label" for="inlineRadio1">Constant
                                        amount</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="revenue_constant" id="inlineRadio2"
                                        value="1" onclick="step10_varying()">
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
                                        <select class="form-control" name="revenue_start" id="exampleFormControlSelect1">
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
                                </div>
                                <div class="varning-amount mt-3" id="step10_varying">
                                    <h4>FY{{ Carbon::now()->format('Y') }}</h4>
                                    <canvas id="line-Chart10" style="max-height:350px;"></canvas>
                                    <div class="cahrt-value">
                                        @for ($i = 0; $i < 12; $i++)
                                            <div class="input-filed">
                                                <label for="">{{ Carbon::now()->addMonth($i)->format('M Y') }}</label>
                                                <input type="number" class="form-control"
                                                    name="revenue_month{{ $i }}"
                                                    id="revenue_month{{ $i }}">
                                            </div>
                                        @endfor
                                        <div class="input-filed">
                                            <label for="">Total</label>
                                            <input type="number" class="form-control" name="revenue_month_total"
                                                id="revenue_month_total">
                                        </div>
                                    </div>
                                    <div class="cahrt-value">
                                        @for ($i = 2; $i < 6; $i++)
                                            <div class="input-filed">
                                                <label for="">FY{{ Carbon::now()->addYear($i)->format('Y') }}</label>
                                                <input type="number" class="form-control"
                                                    name="revenue_year{{ $i }}">
                                            </div>
                                        @endfor
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>

            </div>
            <div class="col-12 text-center">
                <button type="submit" class="btn btn-primary mt-4"> UPDATE</button>
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
                });
            //Revenue Only Month calculate

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
                });

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
    <!-- <line cahrt js-->
    <script type="text/javascript">
        var ctx = document.getElementById('line-Chart').getContext("2d");

        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ["JAN", "FEB", "MAR", "APR", "MAY", "JUN", "APR", "MAY", "JUN", "JUL"],
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
                    data: [100, 120, 150, 170, 180, 170, 170, 180, 170, 160]
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
    </script>
    <script type="text/javascript">
        var ctx = document.getElementById('line-Chart1').getContext("2d");

        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ["JAN", "FEB", "MAR", "APR", "MAY", "JUN", "APR", "MAY", "JUN", "JUL"],
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
                    data: [100, 120, 150, 170, 180, 170, 170, 180, 170, 160]
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
    </script>
    <script type="text/javascript">
        var ctx = document.getElementById('line-Chart3').getContext("2d");

        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ["JAN", "FEB", "MAR", "APR", "MAY", "JUN", "APR", "MAY", "JUN", "JUL"],
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
                    data: [100, 120, 150, 170, 180, 170, 170, 180, 170, 160]
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
    </script>
    <script type="text/javascript">
        var ctx = document.getElementById('line-Chart4').getContext("2d");

        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ["JAN", "FEB", "MAR", "APR", "MAY", "JUN", "APR", "MAY", "JUN", "JUL"],
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
                    data: [100, 120, 150, 170, 180, 170, 170, 180, 170, 160]
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
    </script>
    <script type="text/javascript">
        var ctx = document.getElementById('line-Chart7').getContext("2d");

        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ["JAN", "FEB", "MAR", "APR", "MAY", "JUN", "APR", "MAY", "JUN", "JUL"],
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
                    data: [100, 120, 150, 170, 180, 170, 170, 180, 170, 160]
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
    </script>
    <script type="text/javascript">
        var ctx = document.getElementById('line-Chart8').getContext("2d");

        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ["JAN", "FEB", "MAR", "APR", "MAY", "JUN", "APR", "MAY", "JUN", "JUL"],
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
                    data: [100, 120, 150, 170, 180, 170, 170, 180, 170, 160]
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
    </script>
    <script type="text/javascript">
        var ctx = document.getElementById('line-Chart8_2').getContext("2d");

        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ["JAN", "FEB", "MAR", "APR", "MAY", "JUN", "APR", "MAY", "JUN", "JUL"],
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
                    data: [100, 120, 150, 170, 180, 170, 170, 180, 170, 160]
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
    </script>
    <script type="text/javascript">
        var ctx = document.getElementById('line-Chart9').getContext("2d");

        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ["JAN", "FEB", "MAR", "APR", "MAY", "JUN", "APR", "MAY", "JUN", "JUL"],
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
                    data: [100, 120, 150, 170, 180, 170, 170, 180, 170, 160]
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
    </script>
    <script type="text/javascript">
        var ctx = document.getElementById('line-Chart10').getContext("2d");

        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ["JAN", "FEB", "MAR", "APR", "MAY", "JUN", "APR", "MAY", "JUN", "JUL"],
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
                    data: [100, 120, 150, 170, 180, 170, 170, 180, 170, 160]
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
    </script>
@endsection

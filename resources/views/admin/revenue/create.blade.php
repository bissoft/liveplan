@extends('layouts.admin')
@section('content')
    <div class="container-fluid">
        <!-- start page title -->

        <div class="card">
            <div class="row">
                <div class="col-12">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h4 class="mb-0">Create Revenue</h4>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="col-12">
                    <form role="form" id="quickForm" action="{{ route('admin.revenue.store') }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-12 col-md-6 mt-3">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Name</label>
                                    <input type="text" name="name" class="form-control" value="{{ old('name') }}"
                                        id="name" placeholder="Enter Name">
                                        {!! $errors->first('name', "<span class='text-danger'>:message</span>") !!}
                                </div>
                            </div>
                            <div class="col-12 col-md-6 mt-3">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Type</label>
                                    <select name="type" class="form-control" id="">
                                        <option disabled>What type of revenue stream is this?</option>
                                        <option value="1">Unit Sales</option>
                                        <option value="2">Billable Hours</option>
                                        <option value="3">Recurring Charges</option>
                                        <option value="4">Revenue Only</option>
                                    </select>
                                    {!! $errors->first('type', "<span class='text-danger'>:message</span>") !!}
                                </div>
                            </div>
                            <div class="col-12 col-md-6 mt-3">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">How much will you make from this revenue
                                        stream?</label><br>
                                    <input type="radio" name="constant" value="0" checked> <label for="">Constant
                                        Amount</label>
                                        {!! $errors->first('constant', "<span class='text-danger'>:message</span>") !!}
                                    
                                </div>
                            </div>
                            <div class="col-12 col-md-6 mt-3">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Amount</label>
                                    <input type="number" name="constant_amount" class="form-control"
                                        value="{{ old('constant_amount') }}" id="constant_amount"
                                        placeholder="$">
                                    <b>per</b>
                                    <select name="constant_type" class="form-control" id="">
                                        <option value="0">Month</option>
                                        <option value="1">Year</option>
                                    </select>
                                    <label for="exampleInputEmail1">When will this revenue start?</label>
                                    <select name="constant_start" class="form-control">
                                        @php
                                            use Carbon\Carbon;
                                        @endphp
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
                            </div>
                            <div class="col-12 col-md-12 mt-3">
                                <div class="form-group">
                                    <input type="radio" name="constant" value="1"> <label for="">Varying amount over
                                        time</label>
                                </div>
                            </div>
                            <div class="col-12 col-md-12 mt-3">
                                <div class="form-group">
                                    @for ($i = 0; $i < 11; $i++)
                                    <label for="exampleInputEmail1">{{ Carbon::now()->addMonth($i)->format('M Y') }}</label>
                                    <input type="text" name="month{{$i}}" id="image">
                                    @endfor
                                    @for ($i = 1; $i < 6; $i++)
                                    <label for="exampleInputEmail1">FY{{ Carbon::now()->addYear($i)->format('Y') }}</label>
                                    <input type="text" name="year{{$i}}" id="image">
                                    @endfor
                                    
                                </div>
                            </div>
                            <div class="col-12 col-md-6 mt-3">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">What price will you charge for each unit?</label><br>
                                    <input type="radio" name="unit_constant" value="0" checked> <label for="">Constant
                                        Amount</label>
                                        {!! $errors->first('unit_constant', "<span class='text-danger'>:message</span>") !!}
                                    
                                </div>
                            </div>
                            <div class="col-12 col-md-6 mt-3">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Amount</label>
                                    <input type="text" name="unit_constant_price" class="form-control" value="{{ old('unit_constant_price') }}"
                                        id="amount" placeholder="$">
                                </div>
                            </div>
                            <div class="col-12 col-md-12 mt-3">
                                <div class="form-group">
                                    <input type="radio" name="unit_constant" value="1"> <label for="">Varying amount over
                                        time</label>
                                </div>
                            </div>
                            <div class="col-12 col-md-12 mt-3">
                                <div class="form-group">
                                    @for ($i = 0; $i < 11; $i++)
                                    <label for="exampleInputEmail1">{{ Carbon::now()->addMonth($i)->format('M Y') }}</label>
                                    <input type="text" name="unit_month{{$i}}" id="image">
                                    @endfor
                                    @for ($i = 2; $i < 6; $i++)
                                    <label for="exampleInputEmail1">FY{{ Carbon::now()->addYear($i)->format('Y') }}</label>
                                    <input type="text" name="unit_year{{$i}}" id="image">
                                    @endfor
                                    
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
    </div>
@endsection

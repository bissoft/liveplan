@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            <h3>Cash Flow Statements</h3>
            <form action="{{ route('admin.cashflow') }}" method="POST">
                @csrf
                <input type="hidden" name="id" value="{{ $id }}">
                <div class="row">
                    <div class="col-12 col-md-4 mt-3">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Period start <small style="color:red;">*</small></label>
                            <input type="month" name="startMonth" class="form-control" value="{{ old('startMonth') }}"
                                id="startMonth" required>
                        </div>
                    </div>
                    <div class="col-12 col-md-4 mt-3">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Period length <small style="color:red;">*</small></label>
                            <select name="periodLength" class="form-control" id="">
                                <option value="1">01 Month</option>
                                <option value="2">02 Month</option>
                                <option value="3" selected>03 Month</option>
                                <option value="6">06 Month</option>
                                <option value="12">12 Month</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-12 col-md-2 mt-3">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Periods to compare <small style="color:red;">*</small></label>
                            <input type="number" name="periodsToCompare" class="form-control"
                                value="{{ old('periodsToCompare') }}" id="periodsToCompare" required>
                        </div>
                    </div>
                    <div class="col-12 col-md-2 mt-3">
                        <div class="form-group mt-3">
                            <button type="submit" class="btn btn-dark">Generate</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <div class="card-body">
            <div class="form-group">
                <b>Currency:</b><span>{{ $cashflow['currency'] ?? '' }}</span><br>
                <hr>

                <div class="form-group">
                    <a class="btn btn-default" href="{{ url('admin/companies') }}">
                        Back
                    </a>
                </div>
            </div>
        </div>
    @endsection

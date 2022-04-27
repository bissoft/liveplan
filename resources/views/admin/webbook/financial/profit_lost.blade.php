@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            <h3>Profit & Loss</h3>
            <form action="{{ route('admin.profit_lost') }}" method="POST">
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
                <b>Currency:</b><span>{{ $profit_lost['currency'] ?? '' }}</span><br>
                <hr>


                <table class="table table-bordered table-striped">
                    <tbody>
                        <thead>
                            <th>
                                <h5>Profit & Loss</h5>
                            </th>
                            @foreach ($profit_lost['reports'] as $item)
                                <th>
                                    <h6>{{ date('M Y', strtotime($item['toDate']??'')) }}</h6>
                                </th>
                            @endforeach
                        </thead>
                        <tr>
                            <th><b>Income</b></th>
                        </tr>
                        <tr>
                            <th>Sales</th>
                            @foreach ($profit_lost['reports'] as $item)
                                {{-- {{dd($item)}} --}}
                                @foreach ($item['income']['items'] as $item1)
                                    {{-- {{dd($item1)}} --}}
                                        {{-- {{dd($item2)}} --}}
                                        @if ($item1['name'] == 'Sales')
                                            <td>{{ number_format($item1['value'] ?? '0', 2) }}</td>
                                        @endif
                                @endforeach
                            @endforeach
                        </tr>
                        <tr>
                            <th><b>Total Income</b></th>
                            @foreach ($profit_lost['reports'] as $item)
                                {{-- {{dd($item)}} --}}
                                    @if ($item['income']['name'] == 'Income')
                                        <td>{{ number_format($item['income']['value'] ?? '0', 2) }}</td>
                                    @endif
                            @endforeach
                        </tr>
                        <tr>
                            <th><b>Cost of Sales</b></th>
                        </tr>
                        <tr>
                            <th>Purchases</th>
                            @foreach ($profit_lost['reports'] as $item)
                                {{-- {{dd($item)}} --}}
                                @foreach ($item['costOfSales']['items'] as $item1)
                                    {{-- {{dd($item1)}} --}}
                                        {{-- {{dd($item2)}} --}}
                                        @if ($item1['name'] == 'Purchases')
                                            <td>{{ number_format($item1['value'] ?? '0', 2) }}</td>
                                        @endif
                                @endforeach
                            @endforeach
                        </tr>
                        <tr>
                            <th><b>Total Cost of Sales</b></th>
                            @foreach ($profit_lost['reports'] as $item)
                                {{-- {{dd($item)}} --}}
                                    @if ($item['costOfSales']['name'] == 'Cost of Sales')
                                        <td>{{ number_format($item['costOfSales']['value'] ?? '0', 2) }}</td>
                                    @endif
                            @endforeach
                        </tr>
                        <thead>
                            <th>
                                <h5>Gross Profit</h5>
                            </th>
                            @foreach ($profit_lost['reports'] as $item)
                                <th>
                                    <h6>{{ number_format($item['grossProfit']??'0',2) }}</h6>
                                </th>
                            @endforeach
                        </thead>
                        <tr>
                            <th><b>Expenses</b></th>
                        </tr>
                        <tr>
                            <th>Advertising & Marketing</th>
                            @foreach ($profit_lost['reports'] as $item)
                                {{-- {{dd($item)}} --}}
                                @foreach ($item['expenses']['items'] as $item1)
                                    {{-- {{dd($item1)}} --}}
                                        {{-- {{dd($item2)}} --}}
                                        @if ($item1['name'] == 'Advertising & Marketing')
                                            <td>{{ number_format($item1['value'] ?? '0', 2) }}</td>
                                        @endif
                                @endforeach
                            @endforeach
                        </tr>
                        <tr>
                            <th>Entertainment-100% business</th>
                            @foreach ($profit_lost['reports'] as $item)
                                {{-- {{dd($item)}} --}}
                                @foreach ($item['expenses']['items'] as $item1)
                                    {{-- {{dd($item1)}} --}}
                                        {{-- {{dd($item2)}} --}}
                                        @if ($item1['name'] == 'Entertainment-100% business')
                                            <td>{{ number_format($item1['value'] ?? '0', 2) }}</td>
                                        @endif
                                @endforeach
                            @endforeach
                        </tr>
                        <tr>
                            <th>General Expenses</th>
                            @foreach ($profit_lost['reports'] as $item)
                                {{-- {{dd($item)}} --}}
                                @foreach ($item['expenses']['items'] as $item1)
                                    {{-- {{dd($item1)}} --}}
                                        {{-- {{dd($item2)}} --}}
                                        @if ($item1['name'] == 'General Expenses')
                                            <td>{{ number_format($item1['value'] ?? '0', 2) }}</td>
                                        @endif
                                @endforeach
                            @endforeach
                        </tr>
                        <tr>
                            <th>Light, Power, Heating</th>
                            @foreach ($profit_lost['reports'] as $item)
                                {{-- {{dd($item)}} --}}
                                @foreach ($item['expenses']['items'] as $item1)
                                    {{-- {{dd($item1)}} --}}
                                        {{-- {{dd($item2)}} --}}
                                        @if ($item1['name'] == 'Light, Power, Heating')
                                            <td>{{ number_format($item1['value'] ?? '0', 2) }}</td>
                                        @endif
                                @endforeach
                            @endforeach
                        </tr>
                        <tr>
                            <th>Motor Vehicle Expenses</th>
                            @foreach ($profit_lost['reports'] as $item)
                                {{-- {{dd($item)}} --}}
                                @foreach ($item['expenses']['items'] as $item1)
                                    {{-- {{dd($item1)}} --}}
                                        {{-- {{dd($item2)}} --}}
                                        @if ($item1['name'] == 'Motor Vehicle Expenses')
                                            <td>{{ number_format($item1['value'] ?? '0', 2) }}</td>
                                        @endif
                                @endforeach
                            @endforeach
                        </tr>
                        <tr>
                            <th>Postage, Freight & Courier</th>
                            @foreach ($profit_lost['reports'] as $item)
                                {{-- {{dd($item)}} --}}
                                @foreach ($item['expenses']['items'] as $item1)
                                    {{-- {{dd($item1)}} --}}
                                        {{-- {{dd($item2)}} --}}
                                        @if ($item1['name'] == 'Postage, Freight & Courier')
                                            <td>{{ number_format($item1['value'] ?? '0', 2) }}</td>
                                        @endif
                                @endforeach
                            @endforeach
                        </tr>
                        <tr>
                            <th>Printing & Stationery</th>
                            @foreach ($profit_lost['reports'] as $item)
                                {{-- {{dd($item)}} --}}
                                @foreach ($item['expenses']['items'] as $item1)
                                    {{-- {{dd($item1)}} --}}
                                        {{-- {{dd($item2)}} --}}
                                        @if ($item1['name'] == 'Printing & Stationery')
                                            <td>{{ number_format($item1['value'] ?? '0', 2) }}</td>
                                        @endif
                                @endforeach
                            @endforeach
                        </tr>
                        <tr>
                            <th>Rent</th>
                            @foreach ($profit_lost['reports'] as $item)
                                {{-- {{dd($item)}} --}}
                                @foreach ($item['expenses']['items'] as $item1)
                                    {{-- {{dd($item1)}} --}}
                                        {{-- {{dd($item2)}} --}}
                                        @if ($item1['name'] == 'Rent')
                                            <td>{{ number_format($item1['value'] ?? '0', 2) }}</td>
                                        @endif
                                @endforeach
                            @endforeach
                        </tr>
                        <tr>
                            <th>Repairs & Maintenance</th>
                            @foreach ($profit_lost['reports'] as $item)
                                {{-- {{dd($item)}} --}}
                                @foreach ($item['expenses']['items'] as $item1)
                                    {{-- {{dd($item1)}} --}}
                                        {{-- {{dd($item2)}} --}}
                                        @if ($item1['name'] == 'Repairs & Maintenance')
                                            <td>{{ number_format($item1['value'] ?? '0', 2) }}</td>
                                        @endif
                                @endforeach
                            @endforeach
                        </tr>
                        <tr>
                            <th>Subscriptions</th>
                            @foreach ($profit_lost['reports'] as $item)
                                {{-- {{dd($item)}} --}}
                                @foreach ($item['expenses']['items'] as $item1)
                                    {{-- {{dd($item1)}} --}}
                                        {{-- {{dd($item2)}} --}}
                                        @if ($item1['name'] == 'Subscriptions')
                                            <td>{{ number_format($item1['value'] ?? '0', 2) }}</td>
                                        @endif
                                @endforeach
                            @endforeach
                        </tr>
                        <tr>
                            <th>Telephone & Internet</th>
                            @foreach ($profit_lost['reports'] as $item)
                                {{-- {{dd($item)}} --}}
                                @foreach ($item['expenses']['items'] as $item1)
                                    {{-- {{dd($item1)}} --}}
                                        {{-- {{dd($item2)}} --}}
                                        @if ($item1['name'] == 'Telephone & Internet')
                                            <td>{{ number_format($item1['value'] ?? '0', 2) }}</td>
                                        @endif
                                @endforeach
                            @endforeach
                        </tr>
                        <tr>
                            <th>Travel - National</th>
                            @foreach ($profit_lost['reports'] as $item)
                                {{-- {{dd($item)}} --}}
                                @foreach ($item['expenses']['items'] as $item1)
                                    {{-- {{dd($item1)}} --}}
                                        {{-- {{dd($item2)}} --}}
                                        @if ($item1['name'] == 'Travel - National')
                                            <td>{{ number_format($item1['value'] ?? '0', 2) }}</td>
                                        @endif
                                @endforeach
                            @endforeach
                        </tr>
                        <tr>
                            <th>Audit & Accountancy fees</th>
                            @foreach ($profit_lost['reports'] as $item)
                                {{-- {{dd($item)}} --}}
                                @foreach ($item['expenses']['items'] as $item1)
                                    {{-- {{dd($item1)}} --}}
                                        {{-- {{dd($item2)}} --}}
                                        @if ($item1['name'] == 'Audit & Accountancy fees')
                                            <td>{{ number_format($item1['value'] ?? '0', 2) }}</td>
                                        @endif
                                @endforeach
                            @endforeach
                        </tr>
                        <tr>
                            <th>Bank Fees</th>
                            @foreach ($profit_lost['reports'] as $item)
                                {{-- {{dd($item)}} --}}
                                @foreach ($item['expenses']['items'] as $item1)
                                    {{-- {{dd($item1)}} --}}
                                        {{-- {{dd($item2)}} --}}
                                        @if ($item1['name'] == 'Bank Fees')
                                            <td>{{ number_format($item1['value'] ?? '0', 2) }}</td>
                                        @endif
                                @endforeach
                            @endforeach
                        </tr>
                        <tr>
                            <th>Cleaning</th>
                            @foreach ($profit_lost['reports'] as $item)
                                {{-- {{dd($item)}} --}}
                                @foreach ($item['expenses']['items'] as $item1)
                                    {{-- {{dd($item1)}} --}}
                                        {{-- {{dd($item2)}} --}}
                                        @if ($item1['name'] == 'Cleaning')
                                            <td>{{ number_format($item1['value'] ?? '0', 2) }}</td>
                                        @endif
                                @endforeach
                            @endforeach
                        </tr>
                        <thead>
                            <th>
                                <h5>Net Operating Profit</h5>
                            </th>
                            @foreach ($profit_lost['reports'] as $item)
                                <th>
                                    <h6>{{ number_format($item['netOperatingProfit']??'0',2) }}</h6>
                                </th>
                            @endforeach
                        </thead>
                        <tr>
                            <th><b>Other Income</b></th>
                        </tr>
                        <tr>
                            <th><b>Total Other Income</b></th>
                            @foreach ($profit_lost['reports'] as $item)
                                {{-- {{dd($item)}} --}}
                                    @if ($item['otherIncome']['name'] == 'Other Income')
                                        <td>{{ number_format($item['otherIncome']['value'] ?? '0', 2) }}</td>
                                    @endif
                            @endforeach
                        </tr>
                        <tr>
                            <th><b>Other Expenses</b></th>
                        </tr>
                        <tr>
                            <th><b>Total Other Expenses</b></th>
                            @foreach ($profit_lost['reports'] as $item)
                                {{-- {{dd($item)}} --}}
                                    @if ($item['otherExpenses']['name'] == 'Other Expenses')
                                        <td>{{ number_format($item['otherExpenses']['value'] ?? '0', 2) }}</td>
                                    @endif
                            @endforeach
                        </tr>
                        <thead>
                            <th>
                                <h5>Net Other Income</h5>
                            </th>
                            @foreach ($profit_lost['reports'] as $item)
                                <th>
                                    <h6>{{ number_format($item['netOtherIncome']??'0',2) }}</h6>
                                </th>
                            @endforeach
                        </thead>
                        <thead>
                            <th>
                                <h5>Net Profit</h5>
                            </th>
                            @foreach ($profit_lost['reports'] as $item)
                                <th>
                                    <h6>{{ number_format($item['netProfit']??'0',2) }}</h6>
                                </th>
                            @endforeach
                        </thead>
                    </tbody>
                </table>
                <div class="form-group">
                    <a class="btn btn-default" href="{{ url('admin/companies') }}">
                        Back
                    </a>
                </div>
            </div>
        </div>
    @endsection

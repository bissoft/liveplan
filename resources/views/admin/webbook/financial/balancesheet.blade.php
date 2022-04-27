@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            <h3>Balance Sheet</h3>
            <form action="{{ route('admin.balancesheet') }}" method="POST">
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
                <b>Currency:</b><span>{{ $balancesheet['currency'] ?? '' }}</span><br>
                <hr>


                <table class="table table-bordered table-striped">
                    <tbody>
                        <thead>
                            <th>
                                <h5>Assets</h5>
                            </th>
                            @foreach ($balancesheet['reports'] as $item)
                                <th>
                                    <h6>{{ date('M Y', strtotime($item['date'])) }}</h6>
                                </th>
                            @endforeach
                        </thead>
                        <tr>
                            <th><b>Fixed Assets</b></th>
                        </tr>
                        <tr>
                            <th>Office Equipment</th>
                            @foreach ($balancesheet['reports'] as $item)
                                {{-- {{dd($item)}} --}}
                                @foreach ($item['assets']['items'] as $item1)
                                    {{-- {{dd($item1)}} --}}
                                    @foreach ($item1['items'] as $item2)
                                        {{-- {{dd($item2)}} --}}
                                        @if ($item2['name'] == 'Office Equipment')
                                            <td>{{ number_format($item2['value'] ?? '0', 2) }}</td>
                                        @endif
                                    @endforeach
                                @endforeach
                            @endforeach
                        </tr>
                        <tr>
                            <th>Computer Equipment</th>
                            @foreach ($balancesheet['reports'] as $item)
                                {{-- {{dd($item)}} --}}
                                @foreach ($item['assets']['items'] as $item1)
                                    {{-- {{dd($item1)}} --}}
                                    @foreach ($item1['items'] as $item2)
                                        {{-- {{dd($item2)}} --}}
                                        @if ($item2['name'] == 'Computer Equipment')
                                            <td>{{ number_format($item2['value'] ?? '0', 2) }}</td>
                                        @endif
                                    @endforeach
                                @endforeach
                            @endforeach
                        </tr>
                        <tr>
                            <th><b>Total Fixed Assets</b></th>
                            @foreach ($balancesheet['reports'] as $item)
                                {{-- {{dd($item)}} --}}
                                @foreach ($item['assets']['items'] as $item1)
                                    {{-- {{dd($item1)}} --}}
                                    {{-- {{dd($item2)}} --}}
                                    @if ($item1['name'] == 'Fixed Assets')
                                        <td>{{ number_format($item1['value'] ?? '0', 2) }}</td>
                                    @endif
                                @endforeach
                            @endforeach
                        </tr>
                        <tr>
                            <th><b>Current Assets</b></th>
                        </tr>
                        <tr>
                            <th>Accounts Receivable</th>
                            @foreach ($balancesheet['reports'] as $item)
                                {{-- {{dd($item)}} --}}
                                @foreach ($item['assets']['items'] as $item1)
                                    {{-- {{dd($item1)}} --}}
                                    @foreach ($item1['items'] as $item2)
                                        {{-- {{dd($item2)}} --}}
                                        @if ($item2['name'] == 'Accounts Receivable')
                                            <td>{{ number_format($item2['value'] ?? '0', 2) }}</td>
                                        @endif
                                    @endforeach
                                @endforeach
                            @endforeach
                        </tr>
                        <tr>
                            <th>Bank</th>
                            @foreach ($balancesheet['reports'] as $item)
                                {{-- {{dd($item)}} --}}
                                @foreach ($item['assets']['items'] as $item1)
                                    {{-- {{dd($item1)}} --}}
                                    @foreach ($item1['items'] as $item2)
                                        {{-- {{dd($item2)}} --}}
                                        @if ($item2['name'] == 'Bank')
                                            <td>{{ number_format($item2['value'] ?? '0', 2) }}</td>
                                        @endif
                                    @endforeach
                                @endforeach
                            @endforeach
                        </tr>
                        <tr>
                            <th><b>Total Bank</b></th>
                            @foreach ($balancesheet['reports'] as $item)
                                {{-- {{dd($item)}} --}}
                                @foreach ($item['assets']['items'] as $item1)
                                    {{-- {{dd($item1)}} --}}
                                    @foreach ($item1['items'] as $item2)
                                        {{-- {{dd($item2)}} --}}
                                        @if ($item2['name'] == 'Bank')
                                            <td>{{ number_format($item2['value'] ?? '0', 2) }}</td>
                                        @endif
                                    @endforeach
                                @endforeach
                            @endforeach
                        </tr>
                        <tr>
                            <th><b>Total Current Assets</b></th>
                            @foreach ($balancesheet['reports'] as $item)
                                {{-- {{dd($item)}} --}}
                                @foreach ($item['assets']['items'] as $item1)
                                    {{-- {{dd($item1)}} --}}
                                    {{-- {{dd($item2)}} --}}
                                    @if ($item1['name'] == 'Current Assets')
                                        <td>{{ number_format($item1['value'] ?? '0', 2) }}</td>
                                    @endif
                                @endforeach
                            @endforeach
                        </tr>
                        <thead>
                            <th>
                                <h5>Total Assets</h5>
                            </th>
                            @foreach ($balancesheet['reports'] as $item)
                                {{-- {{dd($item)}} --}}
                                {{-- {{dd($item1)}} --}}
                                {{-- {{dd($item2)}} --}}
                                @if ($item['assets']['name'] == 'Assets')
                                    <th>{{ number_format($item['assets']['value'] ?? '0', 2) }}</th>
                                @endif
                            @endforeach
                        </thead>
                        <tr>
                            <td></td>
                        </tr>
                        <thead>
                            <th>
                                <h5>Liabilities</h5>
                            </th>
                            @foreach ($balancesheet['reports'] as $item)
                                <th>
                                    <h6>{{ date('M Y', strtotime($item['date'])) }}</h6>
                                </th>
                            @endforeach
                        </thead>
                        <tr>
                            <th><b>Current Liabilities</b></th>
                        </tr>
                        <tr>
                            <th>VAT</th>
                            @foreach ($balancesheet['reports'] as $item)
                                {{-- {{dd($item)}} --}}
                                @foreach ($item['liabilities']['items'] as $item1)
                                    {{-- {{dd($item1)}} --}}
                                    @foreach ($item1['items'] as $item2)
                                        {{-- {{dd($item2)}} --}}
                                        @if ($item2['name'] == 'VAT')
                                            <td>{{ number_format($item2['value'] ?? '0', 2) }}</td>
                                        @endif
                                    @endforeach
                                @endforeach
                            @endforeach
                        </tr>
                        <tr>
                            <th>Rounding</th>
                            @foreach ($balancesheet['reports'] as $item)
                                {{-- {{dd($item)}} --}}
                                @foreach ($item['liabilities']['items'] as $item1)
                                    {{-- {{dd($item1)}} --}}
                                    @foreach ($item1['items'] as $item2)
                                        {{-- {{dd($item2)}} --}}
                                        @if ($item2['name'] == 'Rounding')
                                            <td>{{ number_format($item2['value'] ?? '0', 2) }}</td>
                                        @endif
                                    @endforeach
                                @endforeach
                            @endforeach
                        </tr>
                        <tr>
                            <th>Historical Adjustment</th>
                            @foreach ($balancesheet['reports'] as $item)
                                {{-- {{dd($item)}} --}}
                                @foreach ($item['liabilities']['items'] as $item1)
                                    {{-- {{dd($item1)}} --}}
                                    @foreach ($item1['items'] as $item2)
                                        {{-- {{dd($item2)}} --}}
                                        @if ($item2['name'] == 'Historical Adjustment')
                                            <td>{{ number_format($item2['value'] ?? '0', 2) }}</td>
                                        @endif
                                    @endforeach
                                @endforeach
                            @endforeach
                        </tr>
                        <tr>
                            <th>Accounts Payable</th>
                            @foreach ($balancesheet['reports'] as $item)
                                {{-- {{dd($item)}} --}}
                                @foreach ($item['liabilities']['items'] as $item1)
                                    {{-- {{dd($item1)}} --}}
                                    @foreach ($item1['items'] as $item2)
                                        {{-- {{dd($item2)}} --}}
                                        @if ($item2['name'] == 'Accounts Payable')
                                            <td>{{ number_format($item2['value'] ?? '0', 2) }}</td>
                                        @endif
                                    @endforeach
                                @endforeach
                            @endforeach
                        </tr>
                        <tr>
                            <th><b>Total Current Liabilities</b></th>
                            @foreach ($balancesheet['reports'] as $item)
                                {{-- {{dd($item)}} --}}
                                @foreach ($item['liabilities']['items'] as $item1)
                                    {{-- {{dd($item1)}} --}}
                                    {{-- {{dd($item2)}} --}}
                                    @if ($item1['name'] == 'Current Liabilities')
                                        <td>{{ number_format($item1['value'] ?? '0', 2) }}</td>
                                    @endif
                                @endforeach
                            @endforeach
                        </tr>
                        <thead>
                            <th>
                                <h5>Total Liabilities</h5>
                            </th>
                            @foreach ($balancesheet['reports'] as $item)
                                {{-- {{dd($item)}} --}}
                                {{-- {{dd($item1)}} --}}
                                {{-- {{dd($item2)}} --}}
                                @if ($item['liabilities']['name'] == 'Liabilities')
                                    <th>{{ number_format($item['liabilities']['value'] ?? '0', 2) }}</th>
                                @endif
                            @endforeach
                        </thead>
                        <thead>
                            <th>
                                <h5>Net Assets</h5>
                            </th>
                            @foreach ($balancesheet['reports'] as $item)
                                {{-- {{dd($item)}} --}}
                                {{-- {{dd($item1)}} --}}
                                {{-- {{dd($item2)}} --}}
                                <th>{{ number_format($item['netAssets'] ?? '0', 2) }}</th>
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

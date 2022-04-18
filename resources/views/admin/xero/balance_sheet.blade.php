@extends('layouts.admin')

@section('content')

    <div class="container-fluid search-filed">
        <div class="page-title-box pt-2 pb-3">
            <h4 class="mb-4 d-inline-block">Xero Balance Sheets</h4>
            <a href="{{ route('admin.xero.fetchBalanceSheets') }}" class="btn btn-primary float-right">Fetch From Xero</a>
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            @if (session()->has('message'))
                <div class="alert alert-success">{{ session()->get('message') }}</div>
            @endif

            @if ($balanceSheet->count())
                <table class="table table-striped table-responsive my-table">
                    <thead>
                        <tr>
                            <th scope="col">ReportID</th>
                            <th scope="col">ReportName</th>
                            <th scope="col">ReportType</th>
                            <th scope="col">ReportTitles</th>
                            <th scope="col">ReportDate</th>
                            <th scope="col">UpdatedDateUTC</th>
                            <th scope="col">Rows</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($balanceSheet as $item)

                            <tr>
                                <td>{{ $item->ReportID }}</td>
                                <td>{{ $item->ReportName }}</td>
                                <td>{{ $item->ReportType }}</td>
                                <td>{{ collect(json_decode($item->ReportTitles, true))->implode(',') }}</td>
                                <td>{{ $item->ReportDate }}</td>
                                <td>{{ $item->UpdatedDateUTC }}</td>
                                <td>{{$item->Rows}}</td>
                            </tr>

                        @endforeach

                    </tbody>
                </table>
                <div>{{ $balanceSheet->links() }}</div>

            @else
                <p class="text-center">No Balance Sheet found!</p>
            @endif

        </div>
    </div>

@endsection

@extends('layouts.admin')

@section('content')

<div class="container-fluid search-filed">
    <div class="page-title-box pt-2 pb-3">
        <h4 class="mb-4 d-inline-block">Xero Payments</h4>
        <a href="{{ route('admin.xero.fetchPrePayments') }}" class="btn btn-primary float-right">Fetch From Xero</a>
        @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
        @if(session()->has('message'))
            <div class="alert alert-success">{{ session()->get('message') }}</div>
        @endif
        
        @if($payments->count())
            <table class="table table-striped table-responsive my-table">
                <thead>
                    <tr>
                        <th scope="col">Currency Rate</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Status</th>
                        <th scope="col">Payment Type</th>
                        <th scope="col">Payment ID</th>
                    </tr>
                </thead>
                <tbody>

                @foreach($payments as $item)

                    <tr>
                        <td>{{ $item->CurrencyRate }}</td>
                        <td>{{ $item->Amount }}</td>
                        <td>{{ $item->Status }}</td>
                        <td>{{ $item->PaymentType }}</td>
                        <td>{{ $item->PaymentID }}</td>
                    </tr>

                @endforeach

                </tbody>
            </table>

        @else
            <p class="text-center">No Payment found!</p>
        @endif
        
    </div>
</div>

@endsection
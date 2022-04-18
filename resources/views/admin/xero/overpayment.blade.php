@extends('layouts.admin')

@section('content')

<div class="container-fluid search-filed">
    <div class="page-title-box pt-2 pb-3">
        <h4 class="mb-4 d-inline-block">Xero Over Payments</h4>
        <a href="{{ route('admin.xero.fetchOverPayments') }}" class="btn btn-primary float-right">Fetch From Xero</a>
        @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
        @if(session()->has('message'))
            <div class="alert alert-success">{{ session()->get('message') }}</div>
        @endif
        
        @if($overpayments->count())
            <table class="table table-striped table-responsive my-table">
                <thead>
                    <tr>
                        <th scope="col">Type</th>
                        <th scope="col">Contact</th>
                        <th scope="col">Date</th>
                        <th scope="col">Status</th>
                        <th scope="col">Line Amount Types</th>
                        <th scope="col">Line Items</th>
                        <th scope="col">SubTotal</th>
                        <th scope="col">Total Tax</th>
                        <th scope="col">Total</th>
                        <th scope="col">Updated Date UTC</th>
                        <th scope="col">Currency Code</th>
                        <th scope="col">Overpayment ID</th>
                        <th scope="col">Currency Rate</th>
                        <th scope="col">Remaining Credit</th>
                        <th scope="col">Allocations</th>
                        <th scope="col">Payments</th>
                        <th scope="col">HasAttachments</th>
                    </tr>
                </thead>
                <tbody>

                @foreach($overpayments as $item)

                    <tr>
                        <td>{{ $item->Type }}</td>
                        <td>{{ $item->Contact }}</td>
                        <td>{{ $item->Date }}</td>
                        <td>{{ $item->Status }}</td>
                        <td>{{ $item->LineAmountTypes }}</td>
                        <td>{{ $item->LineItems }}</td>
                        <td>{{ $item->SubTotal }}</td>
                        <td>{{ $item->TotalTax }}</td>
                        <td>{{ $item->Total }}</td>
                        <td>{{ $item->UpdatedDateUTC }}</td>
                        <td>{{ $item->CurrencyCode }}</td>
                        <td>{{ $item->OverpaymentID }}</td>
                        <td>{{ $item->CurrencyRate }}</td>
                        <td>{{ $item->RemainingCredit }}</td>
                        <td>{{ $item->Allocations }}</td>
                        <td>{{ $item->Payments }}</td>
                        <td>{{ $item->HasAttachments }}</td>
                    </tr>

                @endforeach

                </tbody>
            </table>
            <div>{{ $overpayments->links() }}</div>

        @else
            <p class="text-center">No Over Payment found!</p>
        @endif
        
    </div>
</div>

@endsection
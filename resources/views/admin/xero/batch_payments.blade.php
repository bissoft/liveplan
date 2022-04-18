@extends('layouts.admin')

@section('content')

<div class="container-fluid search-filed">
    <div class="page-title-box pt-2 pb-3">
        <h4 class="mb-4 d-inline-block">Xero Batch Payments</h4>
        <a href="{{ route('admin.xero.fetchBatch') }}" class="btn btn-primary float-right">Fetch From Xero</a>
        @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
        @if(session()->has('message'))
            <div class="alert alert-success">{{ session()->get('message') }}</div>
        @endif
        
        @if($BatchPayments->count())
            <table class="table table-striped table-responsive my-table">
                <thead>
                    <tr>
                        <th scope="col">Account ID</th>
                        <th scope="col">Details</th>
                        <th scope="col">Narrative</th>
                        <th scope="col">Batch Payment ID</th>
                        <th scope="col">Date</th>
                        <th scope="col">Payments</th>
                        <th scope="col">Type</th>
                        <th scope="col">Status</th>
                        <th scope="col">Total Amounts</th>
                        <th scope="col">Is Reconciled</th>
                        <th scope="col">Updated Date UTC</th>
                        <th scope="col">Elements</th>
                        <th scope="col">Invoice</th>
                        <th scope="col">Payment ID</th>
                        <th scope="col">Bank Account Number</th>
                        <th scope="col">Particulars, Code & Reference</th>
                        <th scope="col">Amount</th>
                    </tr>
                </thead>
                <tbody>

                @foreach($BatchPayments as $item)

                    <tr>
                        <td>{{ $item->AccountID }}</td>
                        <td>{{ $item->Details }}</td>
                        <td>{{ $item->Narrative }}</td>
                        <td>{{ $item->BatchPaymentID }}</td>
                        <td>{{ $item->Date }}</td>
                        <td>{{--{{ $item->Payments }}--}}</td>
                        <td>{{ $item->Type }}</td>
                        <td>{{ $item->Status }}</td>
                        <td>{{ $item->TotalAmount }}</td>
                        <td>{{ $item->IsReconciled }}</td>
                        <td>{{ $item->UpdatedDateUTC }}</td>
                        <td>{{ $item->Elements }}</td>
                        <td>{{ $item->Invoice }}</td>
                        <td>{{ $item->PaymentID }}</td>
                        <td>{{ $item->BankAccountNumber }}</td>
                        <td>{{ $item->Particulars_Code_Reference }}</td>
                        <td>{{ $item->Amount }}</td>
                    </tr>

                @endforeach

                </tbody>
            </table>
            <div>{{ $BatchPayments->links() }}</div>

        @else
            <p class="text-center">No Batch Payment found!</p>
        @endif
        
    </div>
</div>

@endsection
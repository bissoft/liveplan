@extends('layouts.admin')

@section('content')

<div class="container-fluid search-filed">
    <div class="page-title-box pt-2 pb-3">
        <h4 class="mb-4 d-inline-block">Xero Bank Transactions</h4>
        <a href="{{ url('admin/fetch/bank-transactions') }}" class="btn btn-primary float-right">Fetch From Xero</a>
        @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
        @if(session()->has('message'))
            <div class="alert alert-success">{{ session()->get('message') }}</div>
        @endif
        
        @if($bank_transactions->count())
            <table class="table table-striped table-responsive my-table">
                <thead>
                    <tr>
                        <th scope="col">Bank Transaction ID</th>
                        <th scope="col">Type</th>
                        <th scope="col">Contact ID</th>
                        <th scope="col">Bank Account</th>
                        <th scope="col">Total</th>
                    </tr>
                </thead>
                <tbody>

                @foreach($bank_transactions as $bank_transaction)

                    <tr>
                        <td>{{ $bank_transaction->BankTransactionID }}</td>
                        <td>{{ $bank_transaction->Type }}</td>
                        <td>{{ $bank_transaction->ContactID }}</td>
                        <td>{{ $bank_transaction->BankAccount }}</td>
                        <td>{{ $bank_transaction->Total }}</td>
                    </tr>

                @endforeach

                </tbody>
            </table>
            <div>{{ $bank_transactions->links() }}</div>

        @else
            <p class="text-center">No Bank Transactions found!</p>
        @endif
        
    </div>
</div>

@endsection
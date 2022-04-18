@extends('layouts.admin')

@section('content')

<div class="container-fluid search-filed">
    <div class="page-title-box pt-2 pb-3">
        <h4 class="mb-4 d-inline-block">Xero Bank Transfers</h4>
        <a href="{{ url('admin/fetch/bank-transfers') }}" class="btn btn-primary float-right">Fetch From Xero</a>
        @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
        @if(session()->has('message'))
            <div class="alert alert-success">{{ session()->get('message') }}</div>
        @endif
        
        @if($bank_transfers->count())
            <table class="table table-striped table-responsive my-table">
                <thead>
                    <tr>
                        <th scope="col">Bank Transfer ID</th>
                        <th scope="col">From Bank Account</th>
                        <th scope="col">To Bank Account</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Date</th>
                    </tr>
                </thead>
                <tbody>

                @foreach($bank_transfers as $bank_transfer)

                    <tr>
                        <td>{{ $bank_transfer->BankTransferID }}</td>
                        <td>{{ $bank_transfer->FromBankAccount }}</td>
                        <td>{{ $bank_transfer->ToBankAccount }}</td>
                        <td>{{ $bank_transfer->Amount }}</td>
                        <td>{{ $bank_transfer->Date }}</td>
                    </tr>

                @endforeach

                </tbody>
            </table>
            <div>{{ $bank_transfers->links() }}</div>

        @else
            <p class="text-center">No Bank Transfers found!</p>
        @endif
        
    </div>
</div>

@endsection
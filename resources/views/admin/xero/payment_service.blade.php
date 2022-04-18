@extends('layouts.admin')

@section('content')

<div class="container-fluid search-filed">
    <div class="page-title-box pt-2 pb-3">
        <h4 class="mb-4 d-inline-block">Xero Payment Services</h4>
        <a href="{{ route('admin.xero.fetchPaymentServices') }}" class="btn btn-primary float-right">Fetch From Xero</a>
        @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
        @if(session()->has('message'))
            <div class="alert alert-success">{{ session()->get('message') }}</div>
        @endif
        
        @if($paymentservice->count())
            <table class="table table-striped table-responsive my-table">
                <thead>
                    <tr>
                        <th scope="col">Payment Service ID</th>
                        <th scope="col">Payment Service Name</th>
                        <th scope="col">Payment Service Url</th>
                        <th scope="col">PayNow Text</th>
                        <th scope="col">Payment Service Type</th>
                    </tr>
                </thead>
                <tbody>

                @foreach($paymentservice as $item)

                    <tr>
                        <td>{{ $item->PaymentServiceID }}</td>
                        <td>{{ $item->PaymentServiceName }}</td>
                        <td>{{ $item->PaymentServiceUrl }}</td>
                        <td>{{ $item->PayNowText }}</td>
                        <td>{{ $item->PaymentServiceType }}</td>
                    </tr>

                @endforeach

                </tbody>
            </table>
            <div>{{ $paymentservice->links() }}</div>

        @else
            <p class="text-center">No Payment Service found!</p>
        @endif
        
    </div>
</div>

@endsection
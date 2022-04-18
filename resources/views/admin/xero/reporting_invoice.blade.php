@extends('layouts.admin')

@section('content')

<div class="container-fluid search-filed">
    <div class="page-title-box pt-2 pb-3">
        <h4 class="mb-4 d-inline-block">Xero Reporting Invoices</h4>
        <a href="{{ route('admin.xero.fetchReportingInvoices') }}" class="btn btn-primary float-right">Fetch From Xero</a>
        @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
        @if(session()->has('message'))
            <div class="alert alert-success">{{ session()->get('message') }}</div>
        @endif
        
        @if($reportinginvoice->count())
            <table class="table table-striped table-responsive my-table">
                <thead>
                    <tr>
                        <th scope="col">Type</th>
                        <th scope="col">Contacts</th>
                        <th scope="col">Schedule</th>
                        <th scope="col">Line Items</th>
                        <th scope="col">Line Amount Types</th>
                        <th scope="col">Reference</th>
                        <th scope="col">Branding Theme ID</th>
                        <th scope="col">Currency Code</th>
                        <th scope="col">Status</th>
                        <th scope="col">SubTotal</th>
                        <th scope="col">Total Tax</th>
                        <th scope="col">Total</th>
                        <th scope="col">Repeating Invoice ID</th>
                        <th scope="col">Has Attachments</th>
                    </tr>
                </thead>
                <tbody>

                @foreach($reportinginvoice as $item)

                    <tr>
                        <td>{{ $item->Type }}</td>
                        <td>{{--{{ $item->Contacts }}--}}</td>
                        <td>{{--{{ $item->Schedule }}--}}</td>
                        <td>{{--{{ $item->LineItems }}--}}</td>
                        <td>{{ $item->LineAmountTypes }}</td>
                        <td>{{ $item->Reference }}</td>
                        <td>{{ $item->BrandingThemeID }}</td>
                        <td>{{ $item->CurrencyCode }}</td>
                        <td>{{ $item->Status }}</td>
                        <td>{{ $item->SubTotal }}</td>
                        <td>{{ $item->TotalTax }}</td>
                        <td>{{ $item->Total }}</td>
                        <td>{{ $item->RepeatingInvoiceID }}</td>
                        <td>{{ $item->HasAttachments }}</td>
                    </tr>

                @endforeach

                </tbody>
            </table>
            <div>{{ $reportinginvoice->links() }}</div>

        @else
            <p class="text-center">No Reporting Invoice found!</p>
        @endif
        
    </div>
</div>

@endsection
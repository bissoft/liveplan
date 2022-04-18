@extends('layouts.admin')

@section('content')

<div class="container-fluid search-filed">
    <div class="page-title-box pt-2 pb-3">
        <h4 class="mb-4 d-inline-block">Xero Purchase Orders</h4>
        <a href="{{ route('admin.xero.fetchPurchaseOrders') }}" class="btn btn-primary float-right">Fetch From Xero</a>
        @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
        @if(session()->has('message'))
            <div class="alert alert-success">{{ session()->get('message') }}</div>
        @endif
        
        @if($purchaseorder->count())
            <table class="table table-striped table-responsive my-table">
                <thead>
                    <tr>
                        <th scope="col">Contact</th>
                        <th scope="col">Date</th>
                        <th scope="col">Delivery Date</th>
                        <th scope="col">Line Amount Types</th>
                        <th scope="col">Purchase Order Number</th>
                        <th scope="col">Reference</th>
                        <th scope="col">Line Items</th>
                        <th scope="col">Branding Theme ID</th>
                        <th scope="col">Currency Code</th>
                        <th scope="col">Status</th>
                        <th scope="col">Sent To Contact</th>
                        <th scope="col">Delivery Address</th>
                        <th scope="col">Attention To</th>
                        <th scope="col">Telephone</th>
                        <th scope="col">Delivery Instructions</th>
                        <th scope="col">Expected Arrival Date</th>
                        <th scope="col">Purchase Order ID</th>
                        <th scope="col">Currency Rate</th>
                        <th scope="col">SubTotal</th>
                        <th scope="col">Total Tax</th>
                        <th scope="col">Total</th>
                        <th scope="col">Total Discount</th>
                        <th scope="col">Has Attachments</th>
                        <th scope="col">Updated Date UTC</th>
                    </tr>
                </thead>
                <tbody>

                @foreach($purchaseorder as $item)

                    <tr>
                        <td>{{ $item->Contact }}</td>
                        <td>{{ $item->Date }}</td>
                        <td>{{ $item->DeliveryDate }}</td>
                        <td>{{ $item->LineAmountTypes }}</td>
                        <td>{{ $item->PurchaseOrderNumber }}</td>
                        <td>{{ $item->Reference }}</td>
                        <td>{{ $item->LineItems }}</td>
                        <td>{{ $item->BrandingThemeID }}</td>
                        <td>{{ $item->CurrencyCode }}</td>
                        <td>{{ $item->Status }}</td>
                        <td>{{ $item->SentToContact }}</td>
                        <td>{{ $item->DeliveryAddress }}</td>
                        <td>{{ $item->AttentionTo }}</td>
                        <td>{{ $item->Telephone }}</td>
                        <td>{{ $item->DeliveryInstructions }}</td>
                        <td>{{ $item->ExpectedArrivalDate }}</td>
                        <td>{{ $item->PurchaseOrderID }}</td>
                        <td>{{ $item->CurrencyRate }}</td>
                        <td>{{ $item->SubTotal }}</td>
                        <td>{{ $item->TotalTax }}</td>
                        <td>{{ $item->Total }}</td>
                        <td>{{ $item->TotalDiscount }}</td>
                        <td>{{ $item->HasAttachments }}</td>
                        <td>{{ $item->UpdatedDateUTC }}</td>
                    </tr>

                @endforeach

                </tbody>
            </table>
            <div>{{ $purchaseorder->links() }}</div>

        @else
            <p class="text-center">No Purchase Order found!</p>
        @endif
        
    </div>
</div>

@endsection
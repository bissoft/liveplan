@extends('layouts.admin')

@section('content')

<div class="container-fluid search-filed">
    <div class="page-title-box pt-2 pb-3">
        <h4 class="mb-4 d-inline-block">Xero Items</h4>
        <a href="{{ route('admin.xero.fetchItems') }}" class="btn btn-primary float-right">Fetch From Xero</a>
        @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
        @if(session()->has('message'))
            <div class="alert alert-success">{{ session()->get('message') }}</div>
        @endif
        
        @if($items->count())
            <table class="table table-striped table-responsive my-table">
                <thead>
                    <tr>
                        <th scope="col">Item ID</th>
                        <th scope="col">Code</th>
                        <th scope="col">Name</th>
                        <th scope="col">Is Sold</th>
                        <th scope="col">Is Purchased</th>
                        <th scope="col">Description</th>
                        <th scope="col">Purchase Description</th>
                        <th scope="col">Purchase Details</th>
                        <th scope="col">Sales Details</th>
                        <th scope="col">Is Tracked As Inventory</th>
                        <th scope="col">Inventory Asset Account Code</th>
                        <th scope="col">Total Cost Pool</th>
                        <th scope="col">Quantity On Hand</th>
                        <th scope="col">Updated Date UTC</th>
                    </tr>
                </thead>
                <tbody>

                @foreach($items as $item)

                    <tr>
                        <td>{{ $item->ItemID }}</td>
                        <td>{{ $item->Code }}</td>
                        <td>{{ $item->Name }}</td>
                        <td>{{ $item->IsSold }}</td>
                        <td>{{ $item->IsPurchased }}</td>
                        <td>{{ $item->Description }}</td>
                        <td>{{ $item->PurchaseDescription }}</td>
                        <td>{{ $item->PurchaseDetails }}</td>
                        <td>{{ $item->SalesDetails }}</td>
                        <td>{{ $item->IsTrackedAsInventory }}</td>
                        <td>{{ $item->InventoryAssetAccountCode }}</td>
                        <td>{{ $item->TotalCostPool }}</td>
                        <td>{{ $item->QuantityOnHand }}</td>
                        <td>{{ $item->UpdatedDateUTC }}</td>
                    </tr>

                @endforeach

                </tbody>
            </table>
            <div>{{ $items->links() }}</div>

        @else
            <p class="text-center">No Items found!</p>
        @endif
        
    </div>
</div>

@endsection
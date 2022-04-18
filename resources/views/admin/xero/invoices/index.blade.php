@extends('layouts.admin')

@section('content')

<div class="container-fluid search-filed">
    <div class="page-title-box pt-2 pb-3">
        <h4 class="mb-4 d-inline-block">Xero Invoices</h4>
        <a href="{{ url('admin/fetch/invoices') }}" class="btn btn-primary float-right">Fetch From Xero</a>
        @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
        @if(session()->has('message'))
            <div class="alert alert-success">{{ session()->get('message') }}</div>
        @endif
        
        @if($invoices->count())
            <table class="table table-striped table-responsive my-table">
                <thead>
                    <tr>
                        <th scope="col">Type</th>
                        <th scope="col">Contact</th>
                        <th scope="col">LineItems</th>
                        <th scope="col">Date</th>
                        <th scope="col">DueDate</th>
                        <th scope="col">LineAmountTypes</th>
                        <th scope="col">InvoiceNumber</th>
                        <th scope="col">CurrencyCode</th>
                        <th scope="col">Status</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($invoices as $invoice)

                        <tr>
                            <td>{{ $invoice->Type }}</td>
                            <td>{{ $invoice->Contact }}</td>
                            <td>{{ $invoice->LineItems }}</td>
                            <td>{{ $invoice->Date }}</td>
                            <td>{{ $invoice->DueDate }}</td>
                            <td>{{ $invoice->LineAmountTypes }}</td>
                            <td>{{ $invoice->InvoiceNumber }}</td>
                            <td>{{ $invoice->CurrencyCode }}</td>
                            <td>{{ $invoice->Status }}</td>
                            <td>
                                <a href="{{url('admin/xero/Sendinvoice/'.$invoice->id)}}" class="btn btn-info">Email</a>
                            </td>
                        </tr>

                    @endforeach

                </tbody>
            </table>
            <div>{{ $invoices->links() }}</div>

        @else
            <p class="text-center">No Invoices found!</p>
        @endif
                    

                </tbody>
            </table>
            

        
    </div>
</div>

@endsection
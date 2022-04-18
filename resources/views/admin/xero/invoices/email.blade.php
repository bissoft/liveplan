@extends('layouts.admin')

@section('content')

<div class="container-fluid search-filed">
    <div class="page-title-box pt-2 pb-3">
        <h4 class="mb-4 d-inline-block">Email Invoice</h4>
        @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
        <form action="{{url('admin/xero/Sendinvoice/'.$invoice->id)}}" method="post">
            @csrf
        <div class="row">
            <div class="col-md-4 offset-md-6">
                <input type="email" class="form-control" required name="email" placeholder="Enter Email Address" id="">
            </div>
            <div class="col-md-2">
                <button class="btn btn-primary">Send Email</button>
            </div>
        </div>
        </form>
        <div class="row">
            <div class="col-md-12 mt-5">
                <table border="1" style="width: 100%;">
                    <tr>
                        <td><b>Invoice Number:</b></td>
                        <td>{{$invoice->InvoiceNumber}}</td>
                        <td><b>Type:</b></td>
                        <td>{{$invoice->Type}}</td>
                        <td><b>Currency Code:</b></td>
                        <td>{{$invoice->CurrencyCode}}</td>
                    </tr>
                    <tr>
                        <td><b>Date:</b></td>
                        <td>{{$invoice->Date}}</td>
                        <td><b>Due Date:</b></td>
                        <td>{{$invoice->DueDate}}</td>
                        <td><b>Status:</b></td>
                        <td>{{$invoice->Status}}</td>
                    </tr>
                </table>
            </div>
        </div>
        
    </div>
</div>

@endsection
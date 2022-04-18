@extends('layouts.admin')

@section('content')

<div class="container-fluid search-filed">
    <div class="page-title-box pt-2 pb-3">
        <h4 class="mb-4 d-inline-block">Xero Accounts</h4>
        @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
        <form   action="{{route('admin.xeroaccount.xeroupdate',$edit_account->id )}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="">Code</label>
                <input type="text" class="form-control" name="Code" placeholder="Enter Code" value="{{ $edit_account->Code }}" >
            </div>
            <div class="form-group">
                <label for="">Name</label>
                <input type="text" class="form-control" name="Name" placeholder="Enter Name" value="{{ $edit_account->Name }}" >
            </div>
            <div class="form-group">
                <label for="">BankAccountNumber</label>
                <input type="text" class="form-control" name="BankAccountNumber" placeholder="Enter BankAccountNumber" value="{{ $edit_account->BankAccountNumber }}" >
            </div>
            <div class="form-group">
                <label for="">Status </label>
                <input type="text" class="form-control" name="Status" placeholder="Enter Status " value="{{ $edit_account->Status  }}" >
            </div>
            
            <div class="form-group">
                <label for="">BankAccountType</label>
                <input type="text" class="form-control" name="BankAccountType" placeholder="Enter BankAccountType" value="{{ $edit_account->BankAccountType }}" >
            </div>
            <div class="form-group">
                <label for="">CurrencyCode</label>
                <input type="text" class="form-control" name="CurrencyCode" placeholder="Enter CurrencyCode" value="{{ $edit_account->CurrencyCode }}" >
            </div>
            <div class="form-group">
                <label for="">TaxType</label>
                <input type="text" class="form-control" name="TaxType" placeholder="Enter TaxType" value="{{ $edit_account->TaxType }}" >
            </div>
            <div class="form-group">
                <label for="">AccountID</label>
                <input type="text" class="form-control" name="AccountID" placeholder="Enter AccountID" value="{{ $edit_account->AccountID }}" >
            </div>
            <div class="form-group">
                <label for="">Class</label>
                <input type="text" class="form-control" name="Class" placeholder="Enter Class" value="{{ $edit_account->Class }}" >
            </div>
            <div class="form-group">
                <label for="">SystemAccount</label>
                <input type="text" class="form-control" name="SystemAccount" placeholder="Enter SystemAccount" value="{{ $edit_account->SystemAccount }}" >
            </div>
            <div class="form-group">
                <label for="">ReportingCode</label>
                <input type="text" class="form-control" name="ReportingCode" placeholder="Enter ReportingCode" value="{{ $edit_account->ReportingCode }}" >
            </div>

            <div class="form-group">
                <label for="">ReportingCodeName</label>
                <input type="text" class="form-control" name="ReportingCodeName" placeholder="Enter ReportingCodeName" value="{{ $edit_account->ReportingCodeName }}" >
            </div>
            
            <!-- <div class="form-group">
                <label for="">Name</label>
                <input type="text" class="form-control" name="name" placeholder="Enter name" value="{{ $edit_account->name }}">
            </div>
            <div class="form-group">
                <label for="">BankAccountNumber</label>
                <input type="text" class="form-control" name="BankAccountNumber" placeholder="Enter BankAccountNumber" value="{{ $edit_account->BankAccountNumber }}">
            </div> -->
            <button class="btn btn-linear px-5 py-2 mt-4" type="submit">Save</button>
        </form>
    </div>
</div>

@endsection
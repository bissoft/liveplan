@extends('layouts.admin')

@section('content')

    <div class="container-fluid search-filed">
        <div class="page-title-box pt-2 pb-3">
            <h4 class="mb-4 d-inline-block">Xero Manual Journal</h4>
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            @if (session()->has('success'))
                <div class="alert alert-success">{{ session()->get('success') }}</div>
            @endif
            <form action="{{ route('admin.xero.StoreManualJournal') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="">Narration</label>
                    <input type="text" class="form-control" name="Narration" placeholder="Enter Narration"
                        value="{{ old('Narration') }}">
                </div>
                <div class="form-group">
                    <label for="">Date</label>
                    <input type="date" class="form-control date" name="Date" placeholder="Enter Date"
                        value="{{ old('Date') }}">
                </div>
                <div class="form-group">
                    <label for="">Status</label>
                    <select name="Status" class="form-control" id="">
                        <option disabled>--Select Status--</option>
                        <option value="DRAFT">DRAFT</option>
                        <option value="POSTED">POSTED</option>
                        <option value="DELETED">DELETED</option>
                        <option value="VOIDED">VOIDED</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Line Amount Types </label>
                    <select name="LineAmountTypes" class="form-control" id="">
                        <option disabled>--Select Line Amount Types--</option>
                        <option value="Exclusive">Exclusive</option>
                        <option value="Inclusive">Inclusive</option>
                        <option value="NoTax">NoTax</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Show On Cash Basis Reports </label>
                    <select name="ShowOnCashBasisReports" class="form-control" id="">
                        <option disabled>--Select Show On Cash Basis Reports--</option>
                        <option value="1">True</option>
                        <option value="0">False</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="" style="color: #000;">Journal Line</label>
                    <hr>
                </div>
                <div class="form-group">
                    <label for="">Line Amount</label>
                    <input type="number" class="form-control" name="LineAmount" placeholder="Enter LineAmount"
                        value="{{ old('LineAmount') }}">
                </div>
                <div class="form-group">
                    <label for="">Account Code</label>
                    <input type="number" class="form-control" name="AccountCode" placeholder="Enter AccountCode"
                        value="{{ old('AccountCode') }}">
                </div>
                <div class="form-group">
                    <label for="">Description</label>
                    <input type="text" class="form-control" name="Description" placeholder="Enter Description"
                        value="{{ old('Description') }}">
                </div>
                <div class="form-group">
                    <label for="">TaxType</label>
                    <select name="TaxType" class="form-control" id="">
                        <option disabled>--Select TaxType--</option>
                        <option value="INPUT">INPUT</option>
                        <option value="NONE">NONE</option>
                        <option value="OUTPUT">OUTPUT</option>
                        <option value="GSTONIMPORTS">GSTONIMPORTS</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="" style="color: #000;">Tracking</label>
                    <hr>
                </div>
                <div class="form-group">
                    <label for="">Name</label>
                    <input type="text" class="form-control" name="Name" placeholder="Enter Name"
                        value="{{ old('Name') }}">
                </div>
                <div class="form-group">
                    <label for="">Option</label>
                    <input type="text" class="form-control" name="Option" placeholder="Enter Option"
                        value="{{ old('Option') }}">
                </div>
                <button class="btn btn-primary px-5 py-2 mt-4" type="submit">Save</button>
            </form>
        </div>
    </div>

@endsection
@section('script')
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js">
    </script>

    <script>
        $(document).ready(function() {
                    $('.date').datetimepicker({
                        format: 'YYYY/MM/DD',
                        locale: 'en'
                    });
    </script>
@endsection

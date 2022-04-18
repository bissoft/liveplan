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
        <a class="btn btn-primary btn-sm" href="{{ route('admin.xeroaccountref.refreshAccessTokenIfNecessary') }}" >
                            <i class="fas fa-pencil-alt">
                            </i>
                            Refres Token
                        </a>
        <a href="{{ url('admin/fetch/accounts') }}" class="btn btn-primary float-right">Fetch From Xero</a>
        <form action="" method="GET">
                    <div class="col-12 filters my-3">
                <div class="row w-100">
                    <div class="col-12 col-md-2 px-md-1 form-group ">
                        <label>Name</label>
                        <input class="form-control" style="border-radius: 10px;"name="name" value="{{$_REQUEST['name'] ?? ''}}">
                    </div>
                    <div class="col-12 col-md-2 px-md-1 form-group">
                        <label>Account ID</label>
                        <input class="form-control"style="border-radius: 10px;" name="account_id" value="{{$_REQUEST['account_id'] ?? ''}}">
                    </div>
                    <div class="col-12 col-md-2 px-md-1 form-group">
                        <label>Reporting Code</label>
                        <input class="form-control"style="border-radius: 10px;" name="reporting_code" value="{{$_REQUEST['reporting_code'] ?? ''}}">
                    </div> 
                    <div class="col-12 col-md-2 px-md-1 form-group">
                        <label>Class</label>
                        <select class="form-control" name="class" style="border-radius: 10px;">
                        <option value="">--SELECT--</option>
                        @php
                        $opts = ['ASSET','EQUITY','EXPENSE','LIABILITY','REVENUE'];
                        $content = '';
                        foreach($opts as $opt){
                            $content .= "<option";
                            if(isset($_REQUEST['class']) && $opt == $_REQUEST['class'])
                            $content.= ' selected';
                            $content .= '>'.$opt.'</option>';
                        }
                        echo $content;
                        @endphp
                        </select>
                    </div>
                    <div class="col-12 col-md-2 px-md-1">
                        <label>System Account</label>
                        <select class="form-control" name="system_account" style="border-radius: 10px;">
                        <option value="">--SELECT--</option>
                        @php
                        $opts = ['BANKCURRENCYGAIN','CREDITORS','DEBTORS','GST','HISTORICAL','REALISEDCURRENCYGAIN','RETAINEDEARNINGS','ROUNDING','TRACKINGTRANSFERS','UNPAIDEXPCLM','UNREALISEDCURRENCYGAIN'];
                        $content = '';
                        foreach($opts as $opt){
                            $content .= "<option";
                            if(isset($_REQUEST['class']) && $opt == $_REQUEST['system_account'])
                            $content.= ' selected';
                            $content .= '>'.$opt.'</option>';
                        }
                        echo $content;
                        @endphp
                        </select>
                    </div>

                    <div class="col-12 col-md-2 px-md-1 ">
                        
                        <button class="btn btn-info mt-md-4 w-100"style="border-radius: 10px;" type="submit">Apply Filters</button>
                    </div>
                </div>
                    </form>
            </div>
        @if(session()->has('message'))
        <div class="alert alert-success">{{ session()->get('message') }}</div>
        @endif

        @if($accounts->count())
            <table class="my-table table table-striped table-responsive ">
                <thead>
                    <tr>
                        <th scope="col">Organization ID</th>
                        <th scope="col">Code</th>
                        <th scope="col">Name</th>
                        <th scope="col">Bank Account Number</th>
                        <th scope="col">Status</th>
                        <th scope="col">Bank Account Type</th>
                        <th scope="col">Currency Code</th>
                        <th scope="col">Tax Type</th>
                        <th scope="col">Account ID</th>
                        <th scope="col">Class</th>
                        <th scope="col">System Account</th>
                        <th scope="col">Reporting Code</th>
                        <th scope="col">Reporting Code Name</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>

                @foreach($accounts as $account)
                        <tr>
                            <td>{{ $account->OrganizationID }}</td>
                            <td>{{ $account->Code }}</td>
                            <td>{{ $account->Name }}</td>
                            <td>{{ $account->BankAccountNumber }}</td>
                            <td>{{ $account->Status }}</td>
                            <td>{{ $account->BankAccountNumber }}</td>
                            <td>{{ $account->BankAccountType }}</td>
                            <td>{{ $account->CurrencyCode }}</td>
                            <td>{{ $account->TaxType }}</td>
                            <td>{{ $account->AccountID }}</td>
                            <td>{{ $account->Class }}</td>
                            <td>{{ $account->SystemAccount }}</td>
                            <td>{{ $account->ReportingCode }}</td>
                            <td>{{ $account->ReportingCodeName }}</td>
                            <td>
                            <!-- <a class="btn btn-info btn-sm" href="{{url('admin/account/edit',$account->id)}}"> -->
                            <a class="btn btn-primary btn-sm" style=" border-radius: 5px;padding: 5px 11px;" href="{{ route('admin.xeroaccounts.edit',$account->id) }}" >
                            <i class="fa fa-pencil">
                            </i>
                            Edit
                        </a>
                        <form id="delete-form-{{ $account->id }}" action="{{ route('admin.xeroaccountdel.delete',$account->id) }}" method="post" style="display: none;">
                            @csrf()
                            @method('POST')
                        </form>
                        <a href="" onclick="if(confirm('Are you sure, you want to delete this?'))

                        {event.preventDefault(); document.getElementById('delete-form-{{$account->id}}').submit();}
                        else{
                            event.preventDefault();
                        }" class="btn btn-primary btn-sm" style="border-radius: 5px;padding: 5px 11px;"><i class="fa fa-trash"></i> Delete </a>


                    </td>
                </tr>

                @endforeach

            </tbody>
        </table>
        <div>{{ $accounts->links() }}</div>

        @else
        <p class="text-center">No accounts found</p>
        @endif
    </div>
</div>

@endsection
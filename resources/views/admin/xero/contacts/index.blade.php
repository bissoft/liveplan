@extends('layouts.admin')

@section('content')

<div class="container-fluid search-filed">
    <div class="page-title-box pt-2 pb-3">
        <h4 class="mb-4 d-inline-block">Xero Contacts</h4>
        <!--<a class="btn btn-primary btn-sm" href="{{ route('admin.xeroaccountref.refreshAccessTokenIfNecessary') }}" >-->
        <!--                    <i class="fas fa-pencil-alt">-->
        <!--                    </i>-->
        <!--                    Refres Token-->
        <!--                </a>-->
        <a href="{{ url('admin/fetch/contacts') }}" class="btn btn-primary float-right">Fetch From Xero</a>
        @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
        @if(session()->has('message'))
            <div class="alert alert-success">{{ session()->get('message') }}</div>
        @endif

        
        @if($accounts->count())
            <table class="table table-striped table-responsive my-table">
                <thead>
                    <tr>
                        <th scope="col">ContactID</th>
                        <th scope="col">ContactNumber</th>
                        <th scope="col">AccountNumber</th>
                        <th scope="col">ContactStatus</th>
                        <th scope="col">Name</th>
                        <th scope="col">FirstName</th>
                        <th scope="col">LastName</th>
                        <th scope="col">EmailAddress</th>
                        <th scope="col">SkypeUserName</th>
                        <th scope="col">BankAccountDetails</th>
                        <th scope="col">CompanyNumber</th>
                        <th scope="col">TaxNumber</th>
                        <th scope="col">AccountsReceivableTaxType</th>
                        <th scope="col">AccountsPayableTaxType</th>
                        <th scope="col">Addresses</th>
                        <th scope="col">Phones</th>
                        <th scope="col">action</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($accounts as $account)

                        <tr>
                            <td>{{ $account->ContactID }}</td>
                            <td>{{ $account->ContactNumber }}</td>
                            <td>{{ $account->AccountNumber }}</td>
                            <td>{{ $account->ContactStatus }}</td>
                            <td>{{ $account->Name }}</td>
                            <td>{{ $account->FirstName }}</td>
                            <td>{{ $account->LastName }}</td>
                            <td>{{ $account->EmailAddress }}</td>
                            <td>{{ $account->SkypeUserName }}</td>
                            <td>{{ $account->BankAccountDetails }}</td>
                            <td>{{ $account->CompanyNumber }}</td>
                            <td>{{ $account->TaxNumber }}</td>
                            <td>{{ $account->AccountsReceivableTaxType }}</td>
                            <td>{{ $account->AccountsPayableTaxType }}</td>
                            <td>{{ $account->Addresses }}</td>
                            <td>{{ $account->Phones }}</td>
                            <td>
                            <!-- <a class="btn btn-info btn-sm" href="{{url('admin/account/edit',$account->id)}}"> -->
                            <a class="btn btn-primary btn-sm" style=" border-radius: 5px;padding: 5px 11px;" href="{{ route('admin.xeroaccounts.edit',$account->id) }}" >
                            <i class="fa fa-pencil">
                            </i>
                            Edit
                        </a>
                            <form id="delete-form-{{ $account->id }}" action="{{ route('admin.xeroaccountdel.delete',$account->id) }}" method="post"  style="display: none;">
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
            <p class="text-center">No Contacts found!</p>
        @endif
                    

                </tbody>
            </table>
            

        
    </div>
</div>

@endsection
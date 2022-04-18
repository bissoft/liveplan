@extends('layouts.admin')

@section('content')

<div class="container-fluid search-filed">
    <div class="page-title-box pt-2 pb-3">
        <h4 class="mb-4 d-inline-block">Xero Organisations</h4>
        <a href="{{ route('admin.xero.organisations') }}" class="btn btn-primary float-right">Fetch From Xero</a>
        @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
        @if(session()->has('message'))
            <div class="alert alert-success">{{ session()->get('message') }}</div>
        @endif
        
        @if($data_organization->count())
            <table class="table table-striped table-responsive my-table">
                <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Legal Name</th>
                        <th scope="col">Pays Tax</th>
                        <th scope="col">Organisation Type</th>
                        <th scope="col">Base Currency</th>
                        {{-- <th scope="col">Country Code</th>
                        <th scope="col">Is Demo Company</th>
                        <th scope="col">Organisation Status</th>
                        <th scope="col">Organisation Entity Type</th> --}}
                        <th scope="col">Registration Number</th>
                        <th scope="col">Tax Number</th>
                        <th scope="col">Financial Year End Day</th>
                        <th scope="col">Financial Year End Month</th>
                        <th scope="col">Sales Tax Basis</th>
                        <th scope="col">Sales Tax Period</th>
                        {{-- <th scope="col">Default Sales Tax</th>
                        <th scope="col">Default Purchases Tax</th>
                        <th scope="col">Created Date UTC</th>
                        <th scope="col">Timezone</th>
                        <th scope="col">Short Code</th>
                        <th scope="col">Organisation ID</th> --}}
                        <th scope="col">Period Lock Date</th>
                        {{-- <th scope="col">Addresses</th>
                        <th scope="col">External Links</th> --}}
                    </tr>
                </thead>
                <tbody>

                @foreach($data_organization as $item)

                    <tr>
                        <td>{{ $item->Name }}</td>
                        <td>{{ $item->LegalName }}</td>
                        <td>{{ $item->PaysTax }}</td>
                        <td>{{ $item->OrganisationType }}</td>
                        <td>{{ $item->BaseCurrency }}</td>
                        {{-- <td>{{$item->CountryCode}}</td>
                        <td>{{$item->IsDemoCompany}}</td>
                        <td>{{$item->OrganisationStatus}}</td>
                        <td>{{$item->OrganisationEntityType}}</td> --}}
                        <td>{{$item->RegistrationNumber}}</td>
                        <td>{{ $item->TaxNumber }}</td>
                        <td>{{ $item->FinancialYearEndDay }}</td>
                        <td>{{ $item->FinancialYearEndMonth }}</td>
                        <td>{{ $item->SalesTaxBasis }}</td>
                        <td>{{ $item->SaleTaxPeriod }}</td>
                        {{-- <td>{{$item->DefaultSalesTax}}</td>
                        <td>{{$item->DefaultPurchasesTax}}</td>
                        <td>{{$item->CreatedDateUTC}}</td>
                        <td>{{$item->Timezone}}</td>
                        <td>{{$item->ShortCode}}</td>
                        <td>{{$item->OrganisationID}}</td> --}}
                        <td>{{$item->PeriodLockDate}}</td>
                        {{-- <td>{{$item->Addresses}}</td>
                        <td>{{$item->ExternalLinks}}</td> --}}
                    </tr>

                @endforeach

                </tbody>
            </table>
            <div>{{ $data_organization->links() }}</div>

        @else
            <p class="text-center">No Organization found!</p>
        @endif
        
    </div>
</div>

@endsection
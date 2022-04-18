@extends('layouts.admin')

@section('content')

<div class="container-fluid search-filed">
    <div class="page-title-box pt-2 pb-3">
        <h4 class="mb-4 d-inline-block">Xero Tax Rates</h4>
        <a href="{{ url('admin/fetch/tax-rates') }}" class="btn btn-primary float-right">Fetch From Xero</a>
        @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
        @if(session()->has('message'))
            <div class="alert alert-success">{{ session()->get('message') }}</div>
        @endif
        
        @if($tax_rates->count())
            <table class="table table-striped table-responsive my-table">
                <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">TaxType</th>
                    </tr>
                </thead>
                <tbody>

                @foreach($tax_rates as $tax_rate)

                    <tr>
                        <td>{{ $tax_rate->Name }}</td>
                        <td>{{ $tax_rate->TaxType }}</td>
                    </tr>

                @endforeach

                </tbody>
            </table>
            <div>{{ $tax_rates->links() }}</div>

        @else
            <p class="text-center">No Tax Types found!</p>
        @endif
                    

                </tbody>
            </table>
            

        
    </div>
</div>

@endsection
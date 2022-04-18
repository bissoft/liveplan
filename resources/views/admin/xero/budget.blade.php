@extends('layouts.admin')

@section('content')

<div class="container-fluid search-filed">
    <div class="page-title-box pt-2 pb-3">
        <h4 class="mb-4 d-inline-block">Xero Budgets</h4>
        <a href="{{ route('admin.xero.fetchBudgets') }}" class="btn btn-primary float-right">Fetch From Xero</a>
        @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
        @if(session()->has('message'))
            <div class="alert alert-success">{{ session()->get('message') }}</div>
        @endif
        
        @if($budget->count())
            <table class="table table-striped table-responsive my-table">
                <thead>
                    <tr>
                        <th scope="col">BudgetID</th>
                        <th scope="col">Type</th>
                        <th scope="col">Description</th>
                        <th scope="col">Updated Date UTC</th>
                        <th scope="col">Tracking</th>
                        <th scope="col">BudgetLines</th>
                    </tr>
                </thead>
                <tbody>

                @foreach($budget as $item)

                    <tr>
                        <td>{{ $item->BudgetID }}</td>
                        <td>{{ $item->Type }}</td>
                        <td>{{ $item->Description }}</td>
                        <td>{{ $item->UpdatedDateUTC }}</td>
                        <td>{{ $item->Tracking }}</td>
                        <td>{{--{{ $item->BudgetLines }}--}}</td>
                    </tr>

                @endforeach

                </tbody>
            </table>
            <div>{{ $budget->links() }}</div>

        @else
            <p class="text-center">No Budget found!</p>
        @endif
        
    </div>
</div>

@endsection
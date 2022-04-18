@extends('layouts.admin')

@section('content')

<div class="container-fluid search-filed">
    <div class="page-title-box pt-2 pb-3">
        <h4 class="mb-4 d-inline-block">Xero Employees</h4>
        <a href="{{ route('admin.xero.fetchEmployee') }}" class="btn btn-primary float-right">Fetch From Xero</a>
        @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
        @if(session()->has('message'))
            <div class="alert alert-success">{{ session()->get('message') }}</div>
        @endif
        
        @if($employee->count())
            <table class="table table-striped table-responsive my-table">
                <thead>
                    <tr>
                        <th scope="col">Employee ID</th>
                        <th scope="col">Status</th>
                        <th scope="col">First Name</th>
                        <th scope="col">Last Name</th>
                        <th scope="col">External Link</th>
                    </tr>
                </thead>
                <tbody>

                @foreach($employee as $item)

                    <tr>
                        <td>{{ $item->EmployeeID }}</td>
                        <td>{{ $item->Status }}</td>
                        <td>{{ $item->FirstName }}</td>
                        <td>{{ $item->LastName }}</td>
                        <td>{{ $item->External_Link }}</td>
                    </tr>

                @endforeach

                </tbody>
            </table>
            <div>{{ $employee->links() }}</div>

        @else
            <p class="text-center">No Employee found!</p>
        @endif
        
    </div>
</div>

@endsection
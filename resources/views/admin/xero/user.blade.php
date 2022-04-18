@extends('layouts.admin')

@section('content')

    <div class="container-fluid search-filed">
        <div class="page-title-box pt-2 pb-3">
            <h4 class="mb-4 d-inline-block">Xero Users</h4>
            <a href="{{ route('admin.xero.fetchUsers') }}" class="btn btn-primary float-right">Fetch From Xero</a>
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            @if (session()->has('message'))
                <div class="alert alert-success">{{ session()->get('message') }}</div>
            @endif

            @if ($user->count())
                <table class="table table-striped table-responsive my-table">
                    <thead>
                        <tr>
                            <th scope="col">UserID</th>
                            <th scope="col">EmailAddress</th>
                            <th scope="col">FirstName</th>
                            <th scope="col">LastName</th>
                            <th scope="col">Updated Date UTC</th>
                            <th scope="col">IsSubscriber</th>
                            <th scope="col">OrganisationRole</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($user as $item)

                            <tr>
                                <td>{{ $item->UserID }}</td>
                                <td>{{ $item->EmailAddress }}</td>
                                <td>{{ $item->FirstName }}</td>
                                <td>{{ $item->LastName }}</td>
                                <td>{{ $item->UpdatedDateUTC }}</td>
                                <td>{{ $item->IsSubscriber }}</td>
                                <td>{{ $item->OrganisationRole }}</td>
                            </tr>

                        @endforeach

                    </tbody>
                </table>
                <div>{{ $user->links() }}</div>

            @else
                <p class="text-center">No User found!</p>
            @endif

        </div>
    </div>

@endsection

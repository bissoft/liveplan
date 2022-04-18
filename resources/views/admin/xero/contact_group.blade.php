@extends('layouts.admin')

@section('content')

<div class="container-fluid search-filed">
    <div class="page-title-box pt-2 pb-3">
        <h4 class="mb-4 d-inline-block">Xero Contact Group</h4>
        <a href="{{ route('admin.xero.fetchContactGroups') }}" class="btn btn-primary float-right">Fetch From Xero</a>
        @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
        @if(session()->has('message'))
            <div class="alert alert-success">{{ session()->get('message') }}</div>
        @endif
        
        @if($contactGroup->count())
            <table class="table table-striped table-responsive my-table">
                <thead>
                    <tr>
                        <th scope="col">ContactGroupID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>

                @foreach($contactGroup as $item)

                    <tr>
                        <td>{{ $item->ContactGroupID }}</td>
                        <td>{{ $item->Name }}</td>
                        <td>{{ $item->Status }}</td>
                    </tr>

                @endforeach

                </tbody>
            </table>
            <div>{{ $contactGroup->links() }}</div>

        @else
            <p class="text-center">No Contact Group found!</p>
        @endif
        
    </div>
</div>

@endsection
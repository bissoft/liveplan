@extends('layouts.admin')

@section('content')

<div class="container-fluid search-filed">
    <div class="page-title-box pt-2 pb-3">
        <h4 class="mb-4 d-inline-block">Xero Tracking Categories</h4>
        <a href="{{ route('admin.xero.fetchTrackingCategories') }}" class="btn btn-primary float-right">Fetch From Xero</a>
        @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
        @if(session()->has('message'))
            <div class="alert alert-success">{{ session()->get('message') }}</div>
        @endif
        
        @if($trackingcategory->count())
            <table class="table table-striped table-responsive my-table">
                <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Status</th>
                        <th scope="col">TrackingCategoryID</th>
                        <th scope="col">Options</th>
                    </tr>
                </thead>
                <tbody>

                @foreach($trackingcategory as $item)

                    <tr>
                        <td>{{ $item->Name }}</td>
                        <td>{{ $item->Status }}</td>
                        <td>{{ $item->TrackingCategoryID }}</td>
                        <td>{{--{{ $item->Options }}--}}</td>
                    </tr>

                @endforeach

                </tbody>
            </table>
            <div>{{ $trackingcategory->links() }}</div>

        @else
            <p class="text-center">No Tracking Category found!</p>
        @endif
        
    </div>
</div>

@endsection
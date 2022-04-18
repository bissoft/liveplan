@extends('layouts.admin')

@section('content')

<div class="container-fluid search-filed">
    <div class="page-title-box pt-2 pb-3">
        <h4 class="mb-4 d-inline-block">Xero Currencies</h4>
        <a href="{{ route('admin.xero.fetchCurrencies') }}" class="btn btn-primary float-right">Fetch From Xero</a>
        @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
        @if(session()->has('message'))
            <div class="alert alert-success">{{ session()->get('message') }}</div>
        @endif
        
        @if($currencies->count())
            <table class="table table-striped table-responsive my-table">
                <thead>
                    <tr>
                        <th scope="col">Code</th>
                        <th scope="col">Description</th>
                    </tr>
                </thead>
                <tbody>

                @foreach($currencies as $item)

                    <tr>
                        <td>{{ $item->Code }}</td>
                        <td>{{ $item->Description }}</td>
                    </tr>

                @endforeach

                </tbody>
            </table>
            <div>{{ $currencies->links() }}</div>

        @else
            <p class="text-center">No Currency found!</p>
        @endif
        
    </div>
</div>

@endsection
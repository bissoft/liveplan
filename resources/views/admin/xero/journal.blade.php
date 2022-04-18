@extends('layouts.admin')

@section('content')

<div class="container-fluid search-filed">
    <div class="page-title-box pt-2 pb-3">
        <h4 class="mb-4 d-inline-block">Xero Journals</h4>
        <a href="{{ route('admin.xero.fetchJournals') }}" class="btn btn-primary float-right">Fetch From Xero</a>
        @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
        @if(session()->has('message'))
            <div class="alert alert-success">{{ session()->get('message') }}</div>
        @endif
        
        @if($journal->count())
            <table class="table table-striped table-responsive my-table">
                <thead>
                    <tr>
                        <th scope="col">Journal ID</th>
                        <th scope="col">Journal Date</th>
                        <th scope="col">Journal Number</th>
                        <th scope="col">Created Date UTC</th>
                        <th scope="col">Reference</th>
                        <th scope="col">Source ID</th>
                        <th scope="col">Source Type</th>
                        <th scope="col">Journal Lines</th>
                    </tr>
                </thead>
                <tbody>

                @foreach($journal as $item)

                    <tr>
                        <td>{{ $item->JournalID }}</td>
                        <td>{{ $item->JournalDate }}</td>
                        <td>{{ $item->JournalNumber }}</td>
                        <td>{{ $item->CreatedDateUTC }}</td>
                        <td>{{ $item->Reference }}</td>
                        <td>{{ $item->SourceID }}</td>
                        <td>{{ $item->SourceType }}</td>
                        <td>{{ $item->JournalLines }}</td>
                    </tr>

                @endforeach

                </tbody>
            </table>
            <div>{{ $journal->links() }}</div>

        @else
            <p class="text-center">No Journal found!</p>
        @endif
        
    </div>
</div>

@endsection
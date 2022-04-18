@extends('layouts.admin')

@section('content')

<div class="container-fluid search-filed">
    <div class="page-title-box pt-2 pb-3">
        <h4 class="mb-4 d-inline-block">Xero BrandingTheme</h4>
        <a href="{{ route('admin.xero.fetchBrandingThemes') }}" class="btn btn-primary float-right">Fetch From Xero</a>
        @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
        @if(session()->has('message'))
            <div class="alert alert-success">{{ session()->get('message') }}</div>
        @endif
        
        @if($brandingTheme->count())
            <table class="table table-striped table-responsive my-table">
                <thead>
                    <tr>
                        <th scope="col">BrandingTheme ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Logo Url</th>
                        <th scope="col">Type</th>
                        <th scope="col">Sort Order</th>
                        <th scope="col">Created Date UTC</th>
                    </tr>
                </thead>
                <tbody>

                @foreach($brandingTheme as $item)

                    <tr>
                        <td>{{ $item->BrandingThemeID }}</td>
                        <td>{{ $item->Name }}</td>
                        <td>{{ $item->LogoUrl }}</td>
                        <td>{{ $item->Type }}</td>
                        <td>{{ $item->SortOrder }}</td>
                        <td>{{ $item->CreatedDateUTC }}</td>
                    </tr>

                @endforeach

                </tbody>
            </table>
            <div>{{ $brandingTheme->links() }}</div>

        @else
            <p class="text-center">No BrandingTheme found!</p>
        @endif
        
    </div>
</div>

@endsection
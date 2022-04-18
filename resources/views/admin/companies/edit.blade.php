@extends('layouts.admin')

@section('content')

<div class="container-fluid search-filed">
    <div class="page-title-box pt-2 pb-3">
        <h4 class="mb-4">Edit Company</h4>
        <form action="{{ route('admin.companies.update', $company->id) }}" method="POST">
            @csrf
            <input type="hidden" name="_method" value="PATCH">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="form-group">
                <label for="">Name</label>
                <input type="text" class="form-control" name="name" placeholder="Enter name" value="{{ $company->name }}">
            </div>
            <div class="form-group">
                <label for="">Location</label>
                <select class="form-control" name="country_id">
                    @foreach($countries as $country)
                        <option value="{{ $country->id }}" @if($country->id == $company->country_id) selected @endif>{{ $country->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="">Industry</label>
                <select class="form-control" name="industry_id">
                    @foreach($industries as $industry)
                        <option value="{{ $industry->id }}" @if($industry->id == $company->industry_id) selected @endif>{{ $industry->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="">Keywords</label>
                <input type="text" class="form-control" name="keywords" placeholder="Enter comma separated keywords" value="{{ $company->keywords }}">
            </div>
            <button class="btn btn-linear px-5 py-2 mt-4" type="submit">Save</button>
        </form>
    </div>
</div>

@endsection

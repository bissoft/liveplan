@extends('layouts.admin')

@section('content')

<div class="container-fluid search-filed">
    <div class="page-title-box pt-2 pb-3">
        <h4 class="mb-4">Edit Account</h4>
        <form action="{{ route('admin.accounts.update', $account->id) }}" method="POST">
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
                <input type="text" class="form-control" name="name" placeholder="Enter name" value="{{ $account->name }}">
            </div>
            <div class="form-group">
                <label for="">Email</label>
                <input type="email" class="form-control" name="email" placeholder="Enter email" value="{{ $account->email }}">
            </div>
            <div class="form-group">
                <label for="">Job Title</label>
                <input type="text" class="form-control" name="job title" placeholder="Enter job title" value="{{ $account->title }}">
            </div>
            <div class="form-group">
                <label for="">Company</label>
                <select class="form-control" name="company_id">
                    @foreach($companies as $company)
                        <option value="{{ $company->id }}" @if($company->id == $account->company_id) selected @endif>{{ $company->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="">Location</label>
                <select class="form-control" name="country_id">
                    @foreach($countries as $country)
                        <option value="{{ $country->id }}" @if($country->id == $account->country_id) selected @endif>{{ $country->name }}</option>
                    @endforeach
                </select>
            </div>
            <button class="btn btn-linear px-5 py-2 mt-4" type="submit">Save</button>
        </form>
    </div>
</div>

@endsection

@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Company
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.companies.index') }}">
                    Back
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            ID
                        </th>
                        <td>
                            {{ $company['id']??'' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Name
                        </th>
                        <td>
                            {{ $company['name']??'' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            User Name
                        </th>
                        <td>
                            {{ $company['createdByUserName']??'' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Redirect Link
                        </th>
                        <td>
                            {{ $company['redirect']??'' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Created At
                        </th>
                        <td>
                            {{ $company['created']??'' }}
                        </td>
                    </tr>
                    
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.companies.index') }}">
                    Back
                </a>
            </div>
        </div>
    </div>
</div>



@endsection
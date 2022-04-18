@extends('layouts.admin')

@section('content')

<div class="container-fluid search-filed">
    <div class="page-title-box pt-2 pb-3">
        <h4 class="mb-4">Company Details</h4>

        <table class="table table-striped table-responsive" width="100%">
            <thead>
                <tr>
                    <th>Name</th>
                    <td>{{ $company->name }}</td>
                </tr>
                <tr>
                    <th>Country</th>
                    <td>{{ $company->country->name }}</td>
                </tr>
                <tr>
                    <th>Phone</th>
                    <td>{{ $company->phone }}</td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>{{ $company->email }}</td>
                </tr>
                <tr>
                    <th>Category</th>
                    <td>{{ $company->category }}</td>
                </tr>
                <tr>
                    <th>Facebook</th>
                    <td>{{ $company->facebook }}</td>
                </tr>
                <tr>
                    <th>Twitter</th>
                    <td>{{ $company->twitter }}</td>
                </tr>
                <tr>
                    <th>Pinterest</th>
                    <td>{{ $company->pinterest }}</td>
                </tr>
                <tr>
                    <th>Linkedin</th>
                    <td>{{ $company->linkedin }}</td>
                </tr>
                <tr>
                    <th>Instagram</th>
                    <td>{{ $company->instagram }}</td>
                </tr>
                <tr>
                    <th>Youtube</th>
                    <td>{{ $company->youtube }}</td>
                </tr>
                <tr>
                    <th>Employees</th>
                    <td>{{ $company->employees }}</td>
                </tr>
                <tr>
                    <th>Industry</th>
                    <td>{{ @$company->industry->name }}</td>
                </tr>
                <tr>
                    <th>Keywords</th>
                    <td>{{ $company->keywords }}</td>
                </tr>
            </thead>
        </table>
    </div>
</div>

@endsection
@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Connection
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ url('admin/connection/'.$company) }}">
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
                            {{ $connection['id']??'' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Integration Id
                        </th>
                        <td>
                            {{ $connection['integrationId']??'' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Source Id
                        </th>
                        <td>
                            {{ $connection['sourceId']??'' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Platform Name
                        </th>
                        <td>
                            {{ $connection['platformName']??'' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Link Url
                        </th>
                        <td>
                            {{ $connection['linkUrl']??'' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Status
                        </th>
                        <td>
                            {{ $connection['status']??'' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Last Sync
                        </th>
                        <td>
                            {{ $connection['lastSync']??'' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Created
                        </th>
                        <td>
                            {{ $connection['created']??'' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            sourceType
                        </th>
                        <td>
                            {{ $connection['sourceType']??'' }}
                        </td>
                    </tr>
                    
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ url('admin/connection/'.$company) }}">
                    Back
                </a>
            </div>
        </div>
    </div>
</div>



@endsection
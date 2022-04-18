@extends('layouts.admin')
@section('content')
<div class="main-content">
    <div class="container-fluid">
        <div class="card-body">
            <div class="table ">
                <table class=" table table-bordered table-striped  datatable datatable-Role">
                    <thead>
                        <tr>
                        <th>Ticket No.</th>
                        <th>Name</th>
                        <th width="50%">Topic</th>
                        <th>Action</th>

                        </tr>
                    </thead>
                    <tbody>
                    @foreach (\App\Models\Admin\Support\Issue::orderBy('id', 'DESC')->get() as $issue)
                    <tr>
                    <td>
                            {{$issue->id}}
                        </td>
                        <td>
                            {{$issue->name}}
                        </td>
                        <td>
                            {{$issue->issue}}
                        </td>
                        <td>
                            <a class="btn btn-info" href="{{route('admin.support.resolve', ['id' => $issue->id])}}">Resolve</a>
                        </td>
                    </tr>                      
                    @endforeach
                    </tbody>
</table>
            </div>
        </div>
</div>
</div>
        @endsection
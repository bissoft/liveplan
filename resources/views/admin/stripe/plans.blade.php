@extends('layouts.admin')
@section('content')
<div class="main-content">
    <div class="container">
        <div class="card-body">
            <a href="{{ url('plans/create') }}" class="btn btn-primary mb-3">Create New</a>
            <div class="table table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-Role">
                    <thead>
                        <tr>
                            <th>Plan ID</th>
                            <th>Amount</th>
                            <th>Created At</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($plans as $plan)
                                <tr>
                                    <td>
                                        {{$plan->id}}
                                    </td>
                                    <td>
                                        {{ ($plan->amount / 100) . ' ' . $plan->currency . '/' . $plan->interval}}
                                    </td>
                                    <td>
                                        {{date('m/d/Y h:m:i', $plan->created)}}
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
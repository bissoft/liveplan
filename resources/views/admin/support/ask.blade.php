@extends('layouts.admin')
@section('content')
<div class="container-fluid">
    <!-- Add Project -->
    <div class="modal fade" id="addProjectSidebar">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Create Project</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label class="text-black font-w500">Project Name</label>
                            <input type="text" class="form-control">
                        </div>
                        <div class="form-group">
                            <label class="text-black font-w500">Deadline</label>
                            <input type="date" class="form-control">
                        </div>
                        <div class="form-group">
                            <label class="text-black font-w500">Client Name</label>
                            <input type="text" class="form-control">
                        </div>
                        <div class="form-group">
                            <button type="button" class="btn btn-primary">CREATE</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="header-left mb-3">
        <div class="dashboard_bar">
            Support & Help
        </div>
    </div>
    @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if (\Session::has('success'))
    <div class="alert alert-success">
        <ul>
            <li>{!! \Session::get('success') !!}</li>
        </ul>
    </div>
@endif
    <form method="post" action="{{route('admin.support.ask')}}">
    @csrf
        <div class="row">
            <div class="col-12 col-md-6">
                <div class="form-group">
                    <label for="exam">Name</label>
                    <input type="text" value="{{auth()->user()->name}}" class="form-control" id="exam" name="name" aria-describedby="emailHelp" placeholder="Enter email">
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="form-group">
                    <label for="exampleFormControlSelect1">Catgory</label>
                    <select class="form-control" name="category" id="exampleFormControlSelect1">
                        <option>Bank Account</option>
                        <option>Profile</option>
                        <option>User</option>
                    </select>
                </div>
            </div>
            <div class="col-12 mt-3">
                <div class="bg-white mw9 shadow-5">
                    <textarea class="form-control" rows="10" name="issue"></textarea>
                </div>
            </div>
            <div class="col-12 d-flex p-2 justify-content-end">
                <button type="submit" class="btn btn-info">Submit</button>
            </div>
        </div>
    </form>
</div>
@endsection
@section('scripts')
@endsection
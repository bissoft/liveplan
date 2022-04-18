@extends('layouts.admin')
@section('content')
<div class="container-fluid">
    <!-- start page title -->

    <div class="card">
        <div class="row">
            <div class="col-12">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h4 class="mb-0">Create Team Member</h4>
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="col-12">
                <form role="form" id="quickForm" action="{{ route('admin.team.store') }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-12 col-md-6 mt-3">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Name</label>
                                <input type="text" name="name" class="form-control" value="{{ old('name') }}" id="name"
                                    placeholder="Enter Name">
                                    {!! $errors->first('name', "<span class='text-danger'>:message</span>") !!}
                            </div>
                        </div>
                        <div class="col-12 col-md-6 mt-3">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Profession</label>
                                <input type="text" name="profession" class="form-control" value="{{ old('profession') }}"
                                    id="profession" placeholder="Enter Profession">
                                    {!! $errors->first('profession', "<span class='text-danger'>:message</span>") !!}
                            </div>
                        </div>
                        <div class="col-12 col-md-6 mt-3">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Image</label>
                                <input type="file" name="image" class="form-control" id="image">
                                {!! $errors->first('image', "<span class='text-danger'>:message</span>") !!}
                            </div>
                        </div>
                    </div>
                    <div class="col-12 text-center">
                        <button type="submit" class="btn btn-primary mt-4"> SAVE</button>
                    </div>
            </div>
            </form>
        </div>
    </div>
    <!-- end page title -->
</div>
@endsection

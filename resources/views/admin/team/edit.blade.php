@extends('layouts.admin')
@section('content')
<div class="container-fluid">
    <!-- start page title -->

    <div class="card">
        <div class="row">
            <div class="col-12">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h4 class="mb-0">Update Team Member</h4>
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="col-12">
                <form role="form" action="{{ route('admin.team.update', $team->id) }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-12 col-md-6 mt-3">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Name</label>
                                <input type="text" name="name" class="form-control"
                                    value="{{ $team->name ?? old('name') }}" id="name"
                                    placeholder="Enter Name">
                                    {!! $errors->first('name', "<span class='text-danger'>:message</span>") !!}
                            </div>
                        </div>
                        <div class="col-12 col-md-6 mt-3">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Profession</label>
                                <input type="text" name="profession" class="form-control"
                                    value="{{ $team->profession ?? old('profession') }}" id="profession"
                                    placeholder="Enter Profession">
                                    {!! $errors->first('profession', "<span class='text-danger'>:message</span>") !!}
                            </div>
                        </div>
                        @if ($team->image != null)
                            <div class="col-12 col-md-6 mt-3">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Old Image</label>
                                    <img src="{{ asset($team->image ?? '') }}" style="width:100px; height:100px;"
                                        alt="">
                                </div>
                            </div>
                        @endif
                        <div class="col-12 col-md-6 mt-3">
                            <div class="form-group">
                                <label for="exampleInputEmail1">New Image</label>
                                <input type="file" name="image" class="form-control">
                            </div>
                        </div>
                        
                    </div>
                    <div class="col-12 text-center">
                        <button type="submit" class="btn btn-primary mt-4"> UPDATE</button>
                    </div>
            </div>
            </form>
        </div>
    </div>
    <!-- end page title -->
</div>
@endsection

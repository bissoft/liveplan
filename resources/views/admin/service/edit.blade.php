@extends('layouts.admin')
@section('content')
    <div class="container-fluid">
        <div class="card">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="card-header page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0">Update service</h4>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form role="form" action="{{ route('admin.service.update', $service->id) }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-12 col-md-6 mt-3">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Heading <small style="color:red;">*</small></label>
                                <input type="text" name="heading" class="form-control"
                                    value="{{ $service->name ?? old('heading') }}" id="heading" required
                                    placeholder="Enter Service Heading">
                                {!! $errors->first('heading', "<span class='text-danger'>:message</span>") !!}
                            </div>
                        </div>
                        <div class="col-12 col-md-6 mt-3">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Icon <small style="color:red;">*</small></label>
                                <input type="text" name="icon" class="form-control"
                                    value="{{ $service->icon ?? old('icon') }}" id="icon" placeholder="Enter Service Icon"
                                    required>
                                {!! $errors->first('icon', "<span class='text-danger'>:message</span>") !!}
                            </div>
                        </div>
                        <div class="col-12 col-md-12 mt-3">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Description <small style="color:red;">*</small></label>
                                <textarea name="description" class="form-control" required>{{ $service->description ?? old('description') }}</textarea>
                                {!! $errors->first('description', "<span class='text-danger'>:message</span>") !!}
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
@endsection

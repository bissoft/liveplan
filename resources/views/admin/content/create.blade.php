@extends('layouts.admin')
@section('content')
<div class="container-fluid">
    <!-- start page title -->

    <div class="card">
        <div class="row">
            <div class="col-12">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h4 class="mb-0">Create Website Content</h4>
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="col-12">
                <form role="form" id="quickForm" action="{{ route('admin.content.store') }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-12 col-md-6 mt-3">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Website Page</label>
                                <input type="text" name="page" class="form-control" value="{{ old('page') }}" id="page"
                                    placeholder="Enter Website Page">
                            </div>
                        </div>
                        <div class="col-12 col-md-6 mt-3">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Heading</label>
                                <input type="text" name="heading" class="form-control" value="{{ old('heading') }}"
                                    id="heading" placeholder="Enter Heading">
                            </div>
                        </div>
                        <div class="col-12 col-md-6 mt-3">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Title</label>
                                <input type="text" name="title" class="form-control" value="{{ old('title') }}"
                                    id="title" placeholder="Enter Title">
                            </div>
                        </div>
                        <div class="col-12 col-md-6 mt-3">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Key <small style="color:red;">*</small></label>
                                <input type="text" name="key" class="form-control" value="{{ old('key') }}" id="key"
                                    required placeholder="Enter Key">
                                {!! $errors->first('key', "<span class='text-danger'>:message</span>") !!}
                            </div>
                        </div>
                        <div class="col-12 col-md-6 mt-3">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Image</label>
                                <input type="file" name="image" class="form-control" id="image">
                            </div>
                        </div>

                        <div class="col-12 col-md-12 mt-3">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Description</label>
                                <textarea name="description" class="form-control">{{ old('description') }}</textarea>
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

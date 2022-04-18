@extends('layouts.admin')
@section('content')
<div class="container-fluid">
    <!-- start page title -->

    <div class="card">
        <div class="row">
            <div class="col-12">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h4 class="mb-0">Create Article</h4>
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="col-12">
                <form role="form" id="quickForm" action="{{ route('admin.article.store') }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-12 col-md-6 mt-3">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Heading</label>
                                <input type="text" name="heading" class="form-control" value="{{ old('heading') }}" id="heading"
                                    placeholder="Enter Heading">
                                    {!! $errors->first('heading', "<span class='text-danger'>:message</span>") !!}
                            </div>
                        </div>
                        <div class="col-12 col-md-6 mt-3">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Image</label>
                                <input type="file" name="image" class="form-control" id="image">
                                {!! $errors->first('image', "<span class='text-danger'>:message</span>") !!}
                            </div>
                        </div>
                        <div class="col-12 col-md-6 mt-3">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Description</label>
                                <textarea name="description" class="form-control" >{{old('description')}}</textarea>
                                {!! $errors->first('description', "<span class='text-danger'>:message</span>") !!}
                            </div>
                        </div>
                        <div class="col-12 col-md-6 mt-3">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Author Name</label>
                                <input type="text" name="auth_name" class="form-control" value="{{ old('auth_name') }}" id="auth_name"
                                    placeholder="Enter author name">
                                    {!! $errors->first('auth_name', "<span class='text-danger'>:message</span>") !!}
                            </div>
                        </div>
                        <div class="col-12 col-md-6 mt-3">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Author Profession</label>
                                <input type="text" name="auth_profession" class="form-control" value="{{ old('auth_profession') }}"
                                    id="auth_profession" placeholder="Enter author profession">
                                    {!! $errors->first('auth_profession', "<span class='text-danger'>:message</span>") !!}
                            </div>
                        </div>
                        <div class="col-12 col-md-6 mt-3">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Author Image</label>
                                <input type="file" name="auth_image" class="form-control" id="auth_image">
                                {!! $errors->first('auth_image', "<span class='text-danger'>:message</span>") !!}
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

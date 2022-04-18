@extends('layouts.admin')
@section('content')
    <div class="container-fluid">

        <!-- start page title -->
        <div class="card">
            <div class="row">
                <div class="col-12">
                    <div class="card-header page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0">Create Review</h4>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form role="form" id="quickForm" action="{{ route('admin.review.store') }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-12 col-md-6 mt-3">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Name <small style="color:red;">*</small></label>
                                <input type="text" name="name" class="form-control" value="{{ old('name') }}" id="name"
                                    required placeholder="Enter Name">
                                {!! $errors->first('name', "<span class='text-danger'>:message</span>") !!}
                            </div>
                        </div>

                        <div class="col-12 col-md-6 mt-3">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Image <small style="color:red;">*</small></label>
                                <input type="file" name="image" class="form-control" id="image" required>
                                {!! $errors->first('image', "<span class='text-danger'>:message</span>") !!}
                            </div>
                        </div>
                        <div class="col-12 col-md-6 mt-3">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Rating <small style="color:red;">*</small></label>
                                <input type="number" name="rating" class="form-control" maxlength="1"
                                    value="{{ old('rating') }}" id="rating" required placeholder="Enter Rating">
                                {!! $errors->first('rating', "<span class='text-danger'>:message</span>") !!}
                            </div>
                        </div>
                        <div class="col-12 col-md-12 mt-3">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Description <small style="color:red;">*</small></label>
                                <textarea name="description" class="form-control" required>{{ old('description') }}</textarea>
                                {!! $errors->first('description', "<span class='text-danger'>:message</span>") !!}
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
@endsection

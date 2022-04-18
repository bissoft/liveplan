@extends('layouts.admin')
@section('content')
    <div class="container-fluid">

        <!-- start page title -->
        <div class="card">
            <div class="row">
                <div class="col-12">
                    <div class="card-header page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0">Update Review</h4>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <form role="form" action="{{ route('admin.review.update', $review->id) }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-12 col-md-6 mt-3">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Name <small style="color:red;">*</small></label>
                                <input type="text" name="name" class="form-control"
                                    value="{{ $review->name ?? old('name') }}" id="name" required placeholder="Enter Name">
                                {!! $errors->first('name', "<span class='text-danger'>:message</span>") !!}
                            </div>
                        </div>
                        <div class="col-12 col-md-6 mt-3">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Rating <small style="color:red;">*</small></label>
                                <input type="number" name="rating" class="form-control" maxlength="1"
                                    value="{{ $review->rating ?? old('rating') }}" id="rating" required
                                    placeholder="Enter Rating">
                                {!! $errors->first('rating', "<span class='text-danger'>:message</span>") !!}
                            </div>
                        </div>
                        <div class="col-12 col-md-6 mt-3">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Old Image</label>
                                <img src="{{ asset($review->image ?? '') }}" style="width:100px; height:100px;" alt="">
                            </div>
                        </div>
                        <div class="col-12 col-md-6 mt-3">
                            <div class="form-group">
                                <label for="exampleInputEmail1">New Image</label>
                                <input type="file" name="image" class="form-control">
                            </div>
                        </div>
                        <div class="col-12 col-md-6 mt-3">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Status <small style="color:red;">*</small></label>
                                <select name="status" class="form-control" id="">
                                    <option value="0" @if ($review->status == 0) selected @endif>Publish</option>
                                    <option value="1" @if ($review->status == 1) selected @endif>Unpublish</option>
                                </select>
                                {!! $errors->first('status', "<span class='text-danger'>:message</span>") !!}
                            </div>
                        </div>
                        <div class="col-12 col-md-12 mt-3">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Description <small style="color:red;">*</small></label>
                                <textarea name="description" class="form-control"
                                    required>{{ $review->description ?? old('description') }}</textarea>
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

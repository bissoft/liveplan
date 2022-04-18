@extends('layouts.admin')
@section('content')
<div class="container-fluid">
    <!-- start page title -->

    <div class="card">
        <div class="row">
            <div class="col-12">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h4 class="mb-0">Update Website Content</h4>
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="col-12">
                <form role="form" action="{{ route('admin.content.update', $content->id) }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-12 col-md-6 mt-3">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Page</label>
                                <input type="text" name="page" class="form-control"
                                    value="{{ $content->page ?? old('page') }}" id="page"
                                    placeholder="Enter Website Page">
                            </div>
                        </div>
                        <div class="col-12 col-md-6 mt-3">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Heading</label>
                                <input type="text" name="heading" class="form-control"
                                    value="{{ $content->heading ?? old('heading') }}" id="heading"
                                    placeholder="Enter Heading">
                            </div>
                        </div>
                        <div class="col-12 col-md-6 mt-3">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Title</label>
                                <input type="text" name="title" class="form-control"
                                    value="{{ $content->sub_title ?? old('title') }}" id="title"
                                    placeholder="Enter Title">
                            </div>
                        </div>
                        @if ($content->image != null)
                            <div class="col-12 col-md-6 mt-3">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Old Image</label>
                                    <img src="{{ asset($content->image ?? '') }}" style="width:100px; height:100px;"
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
                        <div class="col-12 col-md-12 mt-3">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Description</label>
                                <textarea name="description" class="form-control">{{ $content->description ?? old('description') }}</textarea>
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

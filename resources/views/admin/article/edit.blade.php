@extends('layouts.admin')
@section('content')
<div class="container-fluid">
    <!-- start page title -->

    <div class="card">
        <div class="row">
            <div class="col-12">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h4 class="mb-0">Update Article</h4>
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="col-12">
                <form role="form" action="{{ route('admin.article.update', $article->id) }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-12 col-md-6 mt-3">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Heading</label>
                                <input type="text" name="heading" class="form-control"
                                    value="{{ $article->heading ?? old('heading') }}" id="heading"
                                    placeholder="Enter Heading">
                                    {!! $errors->first('heading', "<span class='text-danger'>:message</span>") !!}
                            </div>
                        </div>
                        @if ($article->image != null)
                            <div class="col-12 col-md-6 mt-3">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Old Image</label>
                                    <img src="{{ asset($article->image ?? '') }}" style="width:100px; height:100px;"
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
                        <div class="col-12 col-md-6 mt-3">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Description</label>
                                <textarea name="description" class="form-control" >{{$article->description??old('description')}}</textarea>
                                {!! $errors->first('description', "<span class='text-danger'>:message</span>") !!}
                            </div>
                        </div>
                        <div class="col-12 col-md-6 mt-3">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Author Name</label>
                                <input type="text" name="auth_name" class="form-control"
                                    value="{{ $article->auth_name ?? old('auth_name') }}" id="auth_name"
                                    placeholder="Enter author name">
                                    {!! $errors->first('auth_name', "<span class='text-danger'>:message</span>") !!}
                            </div>
                        </div>
                        <div class="col-12 col-md-6 mt-3">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Author Profession</label>
                                <input type="text" name="auth_profession" class="form-control"
                                    value="{{ $article->auth_profession ?? old('auth_profession') }}" id="auth_profession"
                                    placeholder="Enter author profession">
                                    {!! $errors->first('auth_profession', "<span class='text-danger'>:message</span>") !!}
                            </div>
                        </div>
                        @if ($article->auth_image != null)
                            <div class="col-12 col-md-6 mt-3">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Author Old Image</label>
                                    <img src="{{ asset($article->auth_image ?? '') }}" style="width:100px; height:100px;"
                                        alt="">
                                </div>
                            </div>
                        @endif
                        <div class="col-12 col-md-6 mt-3">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Author New Image</label>
                                <input type="file" name="auth_image" class="form-control">
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

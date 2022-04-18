@extends('layouts.admin')
@section('content')
    <div class="container-fluid">

        <!-- start page title -->
        <div class="card">
        <div class="row">
            <div class="col-12">
                <div class="card-header page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0">Update Social Media</h4>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form role="form" action="{{ route('admin.media.update',$media->id) }}" method="post"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-12 col-md-6 mt-3">
                        <div class="form-group">
                            <label for="exampleInputEmail1">name <small style="color:red;">*</small></label>
                            <input type="text" name="name" class="form-control" value="{{$media->name??old('name')}}" id="name" required placeholder="Enter Name">
                            {!! $errors->first('name', "<span class='text-danger'>:message</span>") !!}
                        </div>
                    </div>
                    <div class="col-12 col-md-6 mt-3">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Icon <small style="color:red;">*</small></label>
                            <input type="text" name="icon" class="form-control" value="{{$media->icon??old('icon')}}" id="icon"
                                placeholder="Enter media Icon" required>
                            {!! $errors->first('icon', "<span class='text-danger'>:message</span>") !!}
                        </div>
                    </div>
                    <div class="col-12 col-md-6 mt-3">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Link <small style="color:red;">*</small></label>
                            <input type="url" name="link" class="form-control" value="{{$media->link??old('link')}}" id="link" required>
                            {!! $errors->first('link', "<span class='text-danger'>:message</span>") !!}
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

@extends('layouts.admin')
@section('content')
    <div class="container-fluid">

        <!-- start page title -->
        <div class="card">
            <div class="row">
                <div class="col-12">
                    <div class="card-header page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0">Create Package</h4>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form role="form" id="quickForm" action="{{ route('admin.package.store') }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-12 col-md-6 mt-3">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Heading <small style="color:red;">*</small></label>
                                <input type="text" name="heading" class="form-control" value="{{ old('heading') }}"
                                    id="heading" required placeholder="Enter Package Heading">
                                {!! $errors->first('heading', "<span class='text-danger'>:message</span>") !!}
                            </div>
                        </div>
                        <div class="col-12 col-md-6 mt-3">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Title</label>
                                <input type="text" name="title" class="form-control" value="{{ old('title') }}"
                                    id="title" placeholder="Enter Package Title">
                            </div>
                        </div>
                        <div class="col-12 col-md-6 mt-3">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Price <small style="color:red;">*</small></label>
                                <input type="number" name="price" class="form-control" value="{{ old('price') }}"
                                    id="price" required placeholder="Enter Package Price">
                                {!! $errors->first('price', "<span class='text-danger'>:message</span>") !!}
                            </div>
                        </div>
                        <div class="col-12 col-md-6 mt-3">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Type <small style="color:red;">*</small></label>
                                <select name="type" class="form-control" id="">
                                    <option value="0">Monthly</option>
                                    <option value="1">Yearly</option>
                                </select>
                                {!! $errors->first('type', "<span class='text-danger'>:message</span>") !!}
                            </div>
                        </div>
                        <div class="col-12 col-md-6 mt-3">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Point <small style="color:red;">*</small></label>
                                <select name="point[]" class="form-control" multiple id="">
                                    @foreach ($packagePoint as $item)
                                        <option value="{{ $item->point }}">{{ $item->point }}</option>
                                    @endforeach
                                </select>
                                {!! $errors->first('point', "<span class='text-danger'>:message</span>") !!}
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

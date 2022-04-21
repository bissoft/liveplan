@extends('layouts.admin')
@section('content')
    <div class="container-fluid">
        <div class="card">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="card-header page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0">Update Company</h4>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form role="form" id="quickForm" action="{{ route('admin.companies.update',$company['id']) }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-12 col-md-6 mt-3">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Name <small style="color:red;">*</small></label>
                                <input type="text" name="name" class="form-control" value="{{ $company['name']??'' }}" id="name"
                                    required placeholder="Enter Company Name">
                            </div>
                        </div>
                    </div>
                    <div class="col-12 text-center">
                        <button type="submit" class="btn btn-primary mt-4"> UPDATE</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- end page title -->
@endsection

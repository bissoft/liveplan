@extends('layouts.admin')
@section('content')
    <div class="container-fluid">

        <!-- start page title -->
        <div class="card">
            <div class="row">
                <div class="col-12">
                    <div class="card-header page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0">Update Package Point</h4>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form role="form" action="{{ route('admin.packagePoint.update', $packagePoint->id) }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-12 col-md-6 mt-3">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Point <small style="color:red;">*</small></label>
                                <input type="text" name="point" class="form-control"
                                    value="{{ $packagePoint->point ?? old('point') }}" id="point" required
                                    placeholder="Enter Point">
                                {!! $errors->first('point', "<span class='text-danger'>:message</span>") !!}
                            </div>
                        </div>

                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary mt-4"> UPDATE</button>
                    </div>
            </div>
            </form>
        </div>
    </div>
    <!-- end page title -->
@endsection

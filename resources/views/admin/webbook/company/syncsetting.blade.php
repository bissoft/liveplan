@extends('layouts.admin')
@section('content')
    <div class="container-fluid">
        <div class="card">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="card-header page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0">Company Sync Setting</h4>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form role="form" id="quickForm" action="{{ url('admin/syncsetting/'.$company['companyId']) }}" method="post"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-12 col-md-6 mt-3">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Fetch On First Link <small style="color:red;">*</small></label>
                                <select name="status" class="form-control" required>
                                    <option value="true">True</option>
                                    <option value="false">False</option>
                                </select>
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

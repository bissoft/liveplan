@extends('layouts.admin')
@section('content')
<div class="main-content">       
  <div class="container">
                <div class="row">
                  <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                          <h3 class="card-title">Edit Services</h3>
                        </div>
                    <div class="card-body p-0">
            <form role="form" id="quickForm" action="@php if(isset($features)) echo url('/feature/update/'.$features->id); else echo url('/feature/add')" method="post" enctype="multipart/form-data">
                @csrf
              <div class="card-body">
              <div class="form-group">
                    <label for="image">icon</label>
                    <input type="file" name="icon" class="form-control" id="image">
                    <input type="hidden" name="current_image1" value="{{@$features->icon}}">
                                @if (!empty(isset($features) && $features->icon))
                                    <img style="width: 100px; height: 100px; margin-top:10px;" src="{{asset('uploads/features/'.$features->icon)}}" alt="">
                                @endif
                  </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Feature Name</label>
                    <input type="text" name="feature_name" class="form-control" value="{{@$features->name}}" id="feature_name" placeholder="Enter Feature Name">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Feature Description</label>
                    <input type="text" name="feature_desc" class="form-control" value="{{@$features->description}}" id="feature_desc" placeholder="Enter Feature Description">
                  </div>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
                    </div>
            </div>
            </div>
            </div>
            </div>
</div>
            @endsection

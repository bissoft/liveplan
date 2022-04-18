@extends('layouts.admin')
@section('content')
<div class="main-content">     
<div class="container">
          <div class="row">
            <div class="col-md-12">
              <form role="form" id="quickForm" action="{{url('/faq/update/'.$faq->id)}}" method="post" enctype="multipart/form-data">
                @csrf
              <div class="card-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Title</label>
                  <input type="text" name="title" class="form-control" value="{{$faq->title}}" id="name" placeholder="Enter Banner Title">
                </div>
    
                  <div class="form-group">
                    <label for="exampleInputEmail1"> Description</label>
                    <input type="text" name="desc" class="form-control" value="{{$faq->desc}}" id="desc" placeholder="Enter faq Description">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Heading</label>
                    <input type="text" name="heading" class="form-control" value="{{$faq->heading}}" id="heading" placeholder="Enter faq Description">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">String type1</label>
                    <input type="text" name="string1" class="form-control" value="{{$faq->string1}}" id="string1" placeholder="Enter faq Description">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">String type2</label>
                    <input type="text" name="string2" class="form-control" value="{{$faq->string2}}" id="String type2" placeholder="Enter faq Description">
                  </div>
                 
                  <div class="form-group">
                    <label for="image"> Image</label>
                    <input type="file" name="image1" class="form-control" id="image">
                    <input type="hidden" name="current_image1" value="{{$faq->image1}}">
                                @if (!empty($faq->image1))
                                    <img style="width: 100px; height: 100px; margin-top:10px;" src="{{asset('uploads/banners/'.$faq->image1)}}" alt="">
                                @endif
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

        @endsection


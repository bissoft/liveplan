@extends('layouts.admin')
@section('content')
<div class="main-content">     
<div class="container">
          <div class="row">
            <div class="col-md-12">
              <form role="form" id="quickForm" action="{{url('/price/update/'.$price->id)}}" method="post" enctype="multipart/form-data">
                @csrf
              <div class="card-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Title</label>
                  <input type="text" name="title" class="form-control" value="{{$price->title}}" id="title" placeholder="Enter latestidea Title">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">heading1</label>
                  <input type="text" name="heading1" class="form-control" value="{{$price->heading1}}" id="heading1" placeholder="Enter latestidea Title">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">headin2</label>
                  <input type="text" name="heading2" class="form-control" value="{{$price->heading2}}" id="heading2" placeholder="Enter latestidea Title">
                </div>
                
                  <div class="form-group">
                    <label for="exampleInputEmail1">Description</label>
                    <input type="text" name="desc" class="form-control" value="{{$price->desc}}" id="desc" placeholder="Enter latestidea Description">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">String type1</label>
                    <input type="text" name="string1" class="form-control" value="{{$price->string1}}" id="banner_desc" placeholder="Enter latestidea Description">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">String type2</label>
                    <input type="text" name="string2" class="form-control" value="{{$price->string2}}" id="banner_desc" placeholder="Enter Banner Description">
                  </div>
                  <div class="form-group">
                      <label for="exampleInputEmail1">list type 1</label>
                      <input type="text" name="list1" class="form-control"  value="{{$price->list1}}" id="list1" placeholder="Enter list1 type ">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">list type 2</label>
                      <input type="text" name="list2" class="form-control"  value="{{$price->list2}}" id="list2" placeholder="Enter list1 type ">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">list type 3</label>
                      <input type="text" name="list3" class="form-control"  value="{{$price->list3}}" id="list3" placeholder="Enter list1 type ">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">list type 4</label>
                      <input type="text" name="list4" class="form-control"  value="{{$price->list4}}" id="list4" placeholder="Enter list1 type ">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">list type 5</label>
                      <input type="text" name="list5" class="form-control"  value="{{$price->list5}}" id="list5" placeholder="Enter list1 type ">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">icon</label>
                      <input type="text" name="icon" class="form-control" value="{{$price->icon}}" id="icon" placeholder="Enter icon type ">
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
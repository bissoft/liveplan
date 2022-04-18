@extends('layouts.admin')
@section('heading','Add Steps')
@section('title','Add Steps')
@section('content')
@if(Session::has('flash_message_error'))
<div class="main-content">
         <div class="alert alert-sm alert-danger alert-block" role="alert">
         <button type="button" class="close" data-dismiss='alert' aria-label="Close">
               <span aria-hidden="true">&times;</span>
         </button>
         <strong>{!! session('flash_message_error') !!}</strong>
      </div>
      @endif
      @if(Session::has('flash_message_success'))
      <div class="alert alert-sm alert-success alert-block" role="alert">
      <button type="button" class="close" data-dismiss='alert' aria-label="Close">
         <span aria-hidden="true">&times;</span>
      </button>
      <strong>{!! session('flash_message_success') !!}</strong>
      </div>
      @endif
         <!-- Main content -->
         <section class="content">
            <div class="container-fluid">
               <div class="row">
                  <!-- left column -->
                  <div class="col-md-12">
                  <!-- jquery validation -->
                  <div class="card card-primary">
                     <div class="card-header">
                        <h3 class="card-title">Add Steps <small></small></h3>
                     </div>
                     <!-- /.card-header -->
                     <!-- form start -->
                     <form role="form" id="quickForm" action="{{url('/work/steps/'.$work->id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                        <div class="form-group">
                           <label for="exampleInputEmail1">Title</label>
                           {{$work->title}}
                           {{-- <input type="text" name="name" class="form-control" id="name" placeholder="Enter Product Name"> --}}
                        </div>


                           <div class="form-group">
                              <div class="field_wrapper">
                                 <div style="display: flex;">
                                    <input type="text" name="number[]" placeholder="Add Step Number" id="number" class="form-control" style="width: 300px; margin-right: 5px; margin-bottom: 5px;"/>
                                    <input type="text" name="title[]" placeholder="Add Step Title" id="title" class="form-control" style="width: 300px; margin-right: 5px; margin-bottom: 5px;"/>
                                    <input type="text" name="description[]" placeholder="Add Step Description" id="description" class="form-control" style="width: 300px; margin-right: 5px; margin-bottom: 5px;"/>
                                    <a href="javascript:void(0);" class="add_button" title="Add field">Add</a>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                     </form>
                  </div>
                  <!-- /.card -->
                  </div>
                  <!--/.col (left) -->
                  <!-- right column -->
                  <div class="col-md-6">

                  </div>
                  <!--/.col (right) -->
               </div>
               <!-- /.row -->
            </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
            <section class="content">
            <div class="row">
               <div class="col-sm-12">
                  <div class="panel panel-bd lobidrag">
                     <div class="panel-heading">
                        <div class="btn-group" id="buttonexport">
                           <a href="#">
                              <h4>View Steps</h4>
                           </a>
                        </div>
                     </div>
                     <div class="panel-body">
                     <!-- Plugin content:powerpoint,txt,pdf,png,word,xl -->
                        {{-- <div class="btn-group">
                           <div class="buttonexport" id="buttonlist">
                              <a class="btn btn-add" href="{{url('admin/add-product')}}"> <i class="fa fa-plus"></i> Add a Product
                              </a>
                           </div>

                        </div> --}}
                        <!-- Plugin content:powerpoint,txt,pdf,png,word,xl -->


                        <div class="table-responsive">
                           <table id="myTable" class="table table-bordered table-striped table-hover">
                                 <form enctype="multipart/form-data" action="{{url('/work/edit-steps/'.$work->id)}}" method="post">
                                 @csrf
                              <thead>
                                 <tr class="info">
                                    <th>Sr.No</th>
                                    <th>Points</th>

                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Action</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 @foreach ($work->steps as $step)
                                       <tr>
                                                <td style="display: none;"><input type="hidden" name="attr[]" id="" value="{{$step->id}}">{{$step->id}}</td>
                                                <td>{{$loop->index +1}}</td>

                                                <td>
                                                   <input type="text" name="number[]" value="{{$step->number}}" style="text-align: center;">
                                                </td>
                                                <td>
                                                      <input type="text" name="title[]" value="{{$step->title}}" style="text-align: center;">
                                                   </td>
                                                   <td>
                                                      <input type="text" name="description[]" value="{{$step->description}}" style="text-align: center;">
                                                   </td>
                                                <td>
                                                   <div class="btn btn-group">
                                                   <input type="submit" value="update" class="btn btn-success" style="height: 30px; padding-top: 4px;" >
                                                   <a href="{{url('/work/delete-step',$step->id)}}" class="btn btn-danger btn-sm" ><i class="fa fa-trash"></i>Delete </a>
                                                </div>
                                                </td>

                                 </tr>
                                 @endforeach
                              </tbody>
                              </form>
                           </table>
                        </div>
                     </div>
                  </div>
               </div>
            </div>

         </section>
</div>         
@endsection
@section('scripts')
<script>
    $(document).ready(function(){
var maxField = 10; //Input fields increment limitation
var addButton = $('.add_button'); //Add button selector
var wrapper = $('.field_wrapper'); //Input field wrapper
var fieldHTML = '<div style="display: flex;"><input type="text" name="number[]" placeholder="Add Number" id="number" class="form-control"style="width: 300px; margin-right: 5px; margin-bottom: 5px;"/><input type="text" name="title[]" placeholder="Add Content Title" id="title" class="form-control"style="width: 300px; margin-right: 5px; margin-bottom: 5px;"/><input type="text" name="description[]" placeholder="Add Step Description" id="description" class="form-control"style="width: 300px; margin-right: 5px; margin-bottom: 5px;"/><a href="javascript:void(0);" class="remove_button">Remove</a></div>'; //New input field html
var x = 1; //Initial field counter is 1

//Once add button is clicked
$(addButton).click(function(){
    //Check maximum number of input fields
    if(x < maxField){
        x++; //Increment field counter
        $(wrapper).append(fieldHTML); //Add field html
    }
});

//Once remove button is clicked
$(wrapper).on('click', '.remove_button', function(e){
    e.preventDefault();
    $(this).parent('div').remove(); //Remove field html
    x--; //Decrement field counter
});
});
</script>
@endsection

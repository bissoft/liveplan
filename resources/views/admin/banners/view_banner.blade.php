@extends('layouts.admin')
@section('content')
<div class="container-fluid">
        <section class="content">
            <div class="card">
                <div class="card-header">
                <h3 class="card-title">View Services</h3>
                <a class="btn btn-primary py-2 btn-sm" href="{{url('/banner/add')}}">
                               
                                Add Banner
                            </a>
                </div>
            <div class="card-body p-0">
            <table class="my-table table table-border table-striped table-responsive projects">
                <thead>
                    <tr>
                        <th style="width: 1%">
                            Sr.No:
                        </th>
                        <th style="width: 20%">
                            Banner Title
                        </th>
                        <th style="width: 30%">
                            Banner Description
                        </th>
                        <th style="width: 30%">
                            Banner Image
                        </th>
                        <th style="width: 30%">
                            String1
                        </th>
                        <th style="width: 30%">
                            String2
                        </th>           
                         <th style="width: 30%">
                            String3
                        </th>
                        <th style="width: 20%">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($banners as $banner)
                    <tr>
                        <td>
                            {{$loop->index +1}}
                        </td>
                        <td>
                            {{$banner->title}}
                        </td>
                        <td>
                            {{$banner->description}}
                        </td>
                        <td>
                            <img src="{{asset('uploads/banners/'.$banner->image1)}}" alt="" style="width: 100px; height: 100px;">
                        </td>
                        <td>
                            {{$banner->string1}}
                        </td>
                        <td>
                            {{$banner->string2}}
                        </td>
                        <td>
                            {{$banner->string3}}
                        </td>
                        
                        
                        <td >

                            <a class="btn btn-info btn-sm" href="{{url('/banner/edit',$banner->id)}}">
                                <i class="fas fa-pencil-alt">
                                </i>
                                Edit
                            </a>

                            <form id="delete-form-{{ $banner->id }}" action="{{url('/banner/delete',$banner->id)}}" method="post"  style="display: none;">
                                @csrf()
                                @method('POST')
                            </form>
                            <a href="" onclick="if(confirm('Are you sure, you want to delete this?'))

                            {event.preventDefault(); document.getElementById('delete-form-{{$banner->id}}').submit();}
                            else{
                                event.preventDefault();
                            }" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Delete </a>

                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            </div>
            </div>
            </section>
    </div>        
@endsection

@extends('layouts.admin')
@section('content')
<div class="main-content">
        <section class="content">
            <div class="card">
                <div class="card-header">
                <h3 class="card-title">View Services</h3>
                <a class="btn btn-info btn-sm" href="{{url('/latestidea/add')}}">
                                <i class="fas fa-pencil-alt">
                                </i>
                                add
                            </a>
                </div>
            <div class="card-body p-0">
            <table class="table table-striped projects">
                <thead>
                    <tr>
                        <th style="width: 1%">
                            Sr.No:
                        </th>
                        <th style="width: 20%">
                         Title
                        </th>
                        
                        <th style="width: 30%">
                            Description
                        </th>
                      
                        <th style="width: 30%">
                            String 1
                        </th>
                        <th style="width: 30%">
                            String 2
                        </th>
                        <th style="width: 30%">
                        image
                        </th>           
                      
                        <th style="width: 20%">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($latestideas as $latestidea)
                    <tr>
                    <td>
                        {{$loop->index +1}}
                    </td>
                    <td>
                        {{$latestidea->title}}
                    </td>
                    <td>
                        {{$latestidea->desc}}
                    </td>
                    <td>
                        {{$latestidea->string1}}
                    </td>
                    <td>
                        {{$latestidea->string2}}
                    </td>
                    <td>
                            <img src="{{asset('uploads/banners/'.$latestidea->image1)}}" alt="" style="width: 100px; height: 100px;">
                    </td>
                    <td>
                        
                    <a class="btn btn-info btn-sm" href="{{url('/latestidea/edit',$latestidea->id)}}">
                                <i class="fas fa-pencil-alt">
                                </i>
                                Edit
                            </a>
                            <form id="delete-form-{{ $latestidea->id }}" action="{{url('/latestidea/delete',$latestidea->id)}}" method="post"  style="display: none;">
                                @csrf()
                                @method('POST')
                            </form>
                            <a href="" onclick="if(confirm('Are you sure, you want to delete this?'))

                            {event.preventDefault(); document.getElementById('delete-form-{{$latestidea->id}}').submit();}
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

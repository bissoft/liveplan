@extends('layouts.admin')
@section('content')
<div class="main-content">
                <section class="content">
                <div class="card">
                    <div class="card-header">
                    <h3 class="card-title">View "How to Works"</h3>
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
                                Image
                        </th>
                            <th style="width: 20%">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($works as $work)
                        <tr>
                            <td>
                                {{$loop->index +1}}
                            </td>
                            <td>
                                {{$work->title}}
                            </td>
                            <td>
                                {{$work->description}}
                            </td>
                            <td>
                                <img src="{{asset('uploads/banners/'.$work->image)}}" alt="" style="width: 100px; height: 100px;">

                            </td>
                            <td >
                                <a class="btn btn-info btn-sm" href="{{url('/work/steps',$work->id)}}">
                                    <i class="fas fa-pencil-alt">
                                    </i>
                                    Add Work Steps
                                </a>
                                <a class="btn btn-info btn-sm" href="{{url('/work/edit',$work->id)}}">
                                    <i class="fas fa-pencil-alt">
                                    </i>
                                    Edit
                                </a>

                                <form id="delete-form-{{ $work->id }}" action="{{url('/work/delete',$work->id)}}" method="post"  style="display: none;">
                                    @csrf()
                                    @method('POST')
                                </form>
                                <a href="" onclick="if(confirm('Are you sure, you want to delete this?'))

                                {event.preventDefault(); document.getElementById('delete-form-{{$work->id}}').submit();}
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

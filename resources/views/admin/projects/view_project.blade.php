@extends('layouts.admin')
@section('content')
<div class="main-content">
        <section class="content">
            <div class="card">
                <div class="card-header">
                <h3 class="card-title">View Services</h3>
                <a class="btn btn-info btn-sm" href="{{url('/project/add')}}">
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
                        <th style="width: 20%">
                         Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                @foreach($projects as $project)
                    <tr>
                    <td>
                      {{$loop->index+1}}
                    </td>
                    <td>
                       {{$project->title}}
                    </td>
                    <td>
                        
                    <a class="btn btn-info btn-sm" href="{{url('/project/edit',$project->id)}}">
                                <i class="fas fa-pencil-alt">
                                </i>
                                Edit
                            </a>
                            <form id="delete-form-{{ $project->id }}" action="{{url('/project/delete',$project->id)}}" method="post"  style="display: none;">
                                @csrf()
                                @method('POST')
                            </form>
                            <a href="" onclick="if(confirm('Are you sure, you want to delete this?'))

                            {event.preventDefault(); document.getElementById('delete-form-{{$project->id}}').submit();}
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

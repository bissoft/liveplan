@extends('layouts.admin')
@section('content')
<div class="container-fluid">
        <section class="content">
        <div class="card">
            <div class="card-header">
            <h3 class="card-title">View Services</h3>
                <a class="btn btn-info btn-sm" href="{{url('/feature/add')}}">
                            <i class="fas fa-pencil-alt">
                            </i>
                            add
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
                        Icon
                    </th>
                    <th style="width: 30%">
                        Feature Description
                    </th>
                    <th style="width: 20%">
                        Actions
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($features as $feature)
                <tr>
                    <td>
                        {{$loop->index +1}}
                    </td>
                    <td>
                    
                        <img src="{{asset('uploads/features/'.$feature->icon)}}" alt="" style="width: 100px; height: 100px;">
                        
                    </td>
                    <td>
                        {{$feature->name}}
                    </td>
                    <td>
                        {{$feature->description}}
                    </td>

                    <td >

                        <a class="btn btn-info btn-sm" href="{{url('/feature/edit',$feature->id)}}">
                            <i class="fas fa-pencil-alt">
                            </i>
                            Edit
                        </a>

                        <form id="delete-form-{{ $feature->id }}" action="{{url('/feature/delete',$feature->id)}}" method="post"  style="display: none;">
                            @csrf()
                            @method('POST')
                        </form>
                        <a href="" onclick="if(confirm('Are you sure, you want to delete this?'))

                        {event.preventDefault(); document.getElementById('delete-form-{{$feature->id}}').submit();}
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

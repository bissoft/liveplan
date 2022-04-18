@extends('layouts.admin')
@section('content')
<div class="main-content">
            <section class="content">
                <div class="card">
                    <div class="card-header">
                    <h3 class="card-title">View Services</h3>
                    </div>
                <div class="card-body p-0">
                <table class="table table-striped projects">
                    <thead>
                        <tr>
                            <th style="width: 1%">
                                Sr.No:
                            </th>
                            <th style="width: 20%">
                                Service Name
                            </th>
                            <th style="width: 30%">
                                Service Description
                            </th>
                            <th style="width: 20%">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($services as $service)
                        <tr>
                            <td>
                                {{$loop->index +1}}
                            </td>
                            <td>
                                {{$service->icon}}
                            </td>
                            <td>
                                {{$service->name}}
                            </td>
                            <td>
                                {{$service->description}}
                            </td>

                            <td >

                                <a class="btn btn-info btn-sm" href="{{url('/service/edit',$service->id)}}">
                                    <i class="fas fa-pencil-alt">
                                    </i>
                                    Edit
                                </a>

                                <form id="delete-form-{{ $service->id }}" action="{{url('/service/delete',$service->id)}}" method="post"  style="display: none;">
                                    @csrf()
                                    @method('POST')
                                </form>
                                <a href="" onclick="if(confirm('Are you sure, you want to delete this?'))

                                {event.preventDefault(); document.getElementById('delete-form-{{$service->id}}').submit();}
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

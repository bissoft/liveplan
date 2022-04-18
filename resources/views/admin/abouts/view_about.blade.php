@extends('layouts.admin')
@section('content')
<div class="main-content">
        <section class="content">
            <div class="card">
                <div class="card-header">
                <h3 class="card-title">View Services</h3>
                <a class="btn btn-info btn-sm" href="{{url('/about/add')}}">
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
                            About Title
                        </th>
                        <th style="width: 30%">
                            About Heading
                        </th>
                        <th style="width: 30%">
                            About Description
                        </th>
                        <th style="width: 30%">
                            Icon
                        </th>
                        <th style="width: 30%">
                            String
                        </th>
                        <th style="width: 30%">
                        button text 1
                        </th>           
                         <th style="width: 30%">
                         button text 2
                        </th>
                        <th style="width: 20%">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($abouts as $about)
                    <tr>
                        <td>
                            {{$loop->index +1}}
                        </td>
                        <td>
                            {{$about->about_title}}
                        </td>
                        <td>
                            {{$about->about_heading}}
                        </td>
                        <td>
                            {{$about->about_description}}
                        </td>
                        <td>
                            {{$about->icon}}
                        </td>
                        <td>
                            {{$about->about_String}}
                        </td>
                        <td>
                            {{$about->about_button_text1}}
                        </td>
                        <td>
                            {{$about->about_button_text2}}
                        </td>
                        <td >

                            <a class="btn btn-info btn-sm" href="{{url('/about/edit',$about->id)}}">
                                <i class="fas fa-pencil-alt">
                                </i>
                                Edit
                            </a>

                            <form id="delete-form-{{ $about->id }}" action="{{url('/about/delete',$about->id)}}" method="post"  style="display: none;">
                                @csrf()
                                @method('POST')
                            </form>
                            <a href="" onclick="if(confirm('Are you sure, you want to delete this?'))

                            {event.preventDefault(); document.getElementById('delete-form-{{$about->id}}').submit();}
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

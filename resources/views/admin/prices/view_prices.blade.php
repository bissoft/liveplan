@extends('layouts.admin')
@section('content')
<div class="main-content">
        <section class="content">
            <div class="card">
                <div class="card-header">
                <h3 class="card-title">View Services</h3>
                <a class="btn btn-info btn-sm" href="{{url('price/add')}}">
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
                         heading1
                        </th>
                        <th style="width: 20%">
                         heading 2
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
                        list 1
                        </th> 
                        <th style="width: 30%">
                        list 2
                        </th> 
                        <th style="width: 30%">
                        list 3
                        </th> 
                        <th style="width: 30%">
                        list 4
                        </th> 
                        <th style="width: 30%">
                        list 4
                        </th> 

                        <th style="width: 30%">
                        Icon
                        </th>           
                      
                        <th style="width: 20%">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody>
                @foreach($prices as $price)
                    <tr>
                    <td>
                        
                    </td>
                    <td>
                
                    </td>
                    <td>
                   
                    </td>
                    <td>
                  
                    </td>
                    <td>
                  
                    </td>
                    <td>
                  
                    </td>
                    <td>
                  
                    </td>
                    <td>
                  
                    </td>
                    <td>
                   
                    </td>
                    <td>
                   
                    </td>
                    <td>
                  
                    </td>
                    <td>
                  
                    </td>
                    <td>
               
                    <td>
                        
                    <a class="btn btn-info btn-sm" href="{{url('/price/edit',$price->id)}}">
                                <i class="fas fa-pencil-alt">
                                </i>
                                Edit
                            </a>
                            <form id="delete-form-{{ $price->id }}" action="{{url('/price/delete',$price->id)}}" method="post"  style="display: none;">
                                @csrf()
                                @method('POST')
                            </form>
                            <a href="" onclick="if(confirm('Are you sure, you want to delete this?'))

                            {event.preventDefault(); document.getElementById('delete-form-{{$price->id}}').submit();}
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

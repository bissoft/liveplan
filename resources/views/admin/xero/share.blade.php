@extends('layouts.admin')

@section('content')

<div class="container-fluid search-filed">
    <div class="page-title-box pt-2 pb-3">
        <h4 class="mb-4 d-inline-block">{{$c}}</h4>
        <a class="btn btn-primary btn-sm" href="{{ route('admin.xeroaccountref.refreshAccessTokenIfNecessary') }}" >
                            <i class="fas fa-pencil-alt">
                            </i>
                            Refres Token
                        </a>
        <a href="{{ url('admin/fetch/accounts') }}" class="btn btn-primary float-right">Fetch From Xero</a>

            </div>
        @if(session()->has('message'))
        <div class="alert alert-success">{{ session()->get('message') }}</div>
        @endif


            <table class="my-table table table-striped table-responsive ">
                <thead>
                    <tr>
                        @foreach($class::$chars as $label)
                        <th scope="col">{{$label}}</th>
                        @endforeach

                    </tr>
                </thead>
                <tbody>
                @foreach ($instances as $instance) 
                <tr>         
                @foreach($class::$chars as $label)
                <td>{{$instance->$label}}</td>
                @endforeach
                </tr>
                @endforeach
            </tbody>
        </table>
        <div>{{ $instances->links() }}</div>

        @if(!$instances->count())
        <p class="text-center">No accounts found</p>
        @endif
    </div>
</div>

@endsection
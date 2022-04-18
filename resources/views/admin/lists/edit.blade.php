@extends('layouts.admin')

@section('content')

<div class="container-fluid search-filed">
    <div class="page-title-box pt-2 pb-3">
        <h4 class="mb-4">Edit List</h4>
        <form action="{{ route('admin.lists.update', $list->id) }}" method="POST">
            @csrf
            <input type="hidden" name="_method" value="PATCH">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="form-group">
                <label for="">Name</label>
                <input type="text" class="form-control" name="name" placeholder="Enter name" value="{{ $list->name }}">
            </div>
            <button class="btn btn-linear px-5 py-2 mt-4" type="submit">Save</button>
        </form>
    </div>
</div>

@endsection

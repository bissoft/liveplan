@extends('layouts.admin')
@section('content')
        <!-- start page title -->
        <div class="card">
            <div class="row">
                <div class="col-12">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h4 class="mb-0">Website Contents</h4>
                        @can('content_create')
                            <div>
                                <a href="{{ route('admin.content.create') }}" class="btn btn-primary">Add New</a>
                            </div>
                        @endcan
                    </div>
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                <table id="example" class="table table-responsive" style="width:100%">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Page</th>
                            <th scope="col">Heading</th>
                            <th scope="col">Title</th>
                            <th scope="col">Key</th>
                            <th scope="col">Image</th>
                            <th scope="col">Description</th>
                            <th scope="col">Actions</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($content as $index => $item)
                            <tr>
                                <td>
                                    {{ $index + 1 }}
                                </td>
                                <td>
                                    {{ $item->page ?? '' }}
                                </td>
                                <td>
                                    {{ $item->heading ?? '' }}
                                </td>
                                <td>
                                    {{ $item->sub_title ?? '' }}
                                </td>
                                <td>
                                    {{ $item->key ?? '' }}
                                </td>
                                <td>
                                    @if ($item->image != null)
                                        <img src="{{ asset($item->image) }}" style="height: 100px; width:100px;" alt="">
                                    @else
                                        No Image
                                    @endif
                                </td>
                                <td>
                                    {!! $item->description ?? '' !!}
                                </td>
                                <td>
                                    @can('content_edit')
                                        <a class="btn btn-warning btn-sm" href="{{ route('admin.content.edit', $item->id) }}">
                                            <i class="fas fa-pencil-alt">
                                            </i>
                                            Edit
                                        </a>
                                    @endcan
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
                </div>
            </div>
        </div>
        <!-- end page title -->
@endsection

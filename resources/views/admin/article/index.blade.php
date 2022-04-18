@extends('layouts.admin')
@section('content')
    <div class="container-fluid">
        <!-- start page title -->
        <div class="card">
            <div class="row">
                <div class="col-12">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h4 class="mb-0">Articles</h4>
                        @can('content_create')
                            <div>
                                <a href="{{ route('admin.article.create') }}" class="btn btn-primary">Add New</a>
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
                <table class="table table-responsive" style="width:100%">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Heading</th>
                            <th scope="col">Image</th>
                            <th scope="col">Description</th>
                            <th scope="col">Author</th>
                            <th scope="col">Profession</th>
                            <th scope="col">Image</th>
                            <th scope="col">Actions</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($article as $index => $item)
                            <tr>
                                <td>
                                    {{ $index + 1 }}
                                </td>
                                <td>
                                    {{ $item->heading ?? '' }}
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
                                    {{ $item->auth_name ?? '' }}
                                </td>
                                <td>
                                    {{ $item->auth_profession ?? '' }}
                                </td>
                                <td>
                                    @if ($item->auth_image != null)
                                        <img src="{{ asset($item->auth_image) }}" style="height: 100px; width:100px;" alt="">
                                    @else
                                        No Image
                                    @endif
                                </td>
                                <td>
                                    @can('article_edit')
                                        <a class="btn btn-warning btn-sm" href="{{ route('admin.article.edit', $item->id) }}">
                                            <i class="fas fa-pencil-alt">
                                            </i>
                                            Edit
                                        </a>
                                    @endcan
                                    @can('article_delete')
                                        <a class="btn btn-danger btn-sm"
                                            onclick="articleDelete{{ $item->id }}({{ $item->id }})">
                                            <i class="fas fa-trash">
                                            </i>
                                            Delete
                                        </a>
                                    @endcan
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
        <!-- end page title -->
    </div>
@endsection
@section('scripts')
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/izitoast@1.4.0/dist/js/iziToast.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/5.10.0/tinymce.min.js"></script>
    @foreach ($article as $item)
        <script>
            function articleDelete{{ $item->id }}(id) {
                swal({
                    title: "Are You Sure Want To Delete?",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                }).then((willDelete) => {
                    if (willDelete) {
                        var url = '{{ route('admin.deleteArticle', ':id') }}';
                        url = url.replace(':id', id);
                        $.ajax({
                            type: "POST",
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            url: url,
                            dataType: "json",
                            data: {
                                id: id
                            },
                            success: function(data) {
                                console.log(data);
                                //var data = JSON.parse(response);
                                iziToast.success({
                                    message: data.message,
                                    position: 'topRight'
                                });
                                //Reload page
                                window.location.reload();

                            }
                        });
                    }
                });

            }
        </script>
    @endforeach
@endsection

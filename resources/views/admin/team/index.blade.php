@extends('layouts.admin')
@section('content')
    <div class="container-fluid">
        <!-- start page title -->
        <div class="card">
            <div class="row">
                <div class="col-12">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h4 class="mb-0">Team Members</h4>
                        @can('content_create')
                            <div>
                                <a href="{{ route('admin.team.create') }}" class="btn btn-primary">Add New</a>
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
                <table class="table table-responsive" style="width:100%">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Profession</th>
                            <th scope="col">Image</th>
                            <th scope="col">Actions</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($team as $index => $item)
                            <tr>
                                <td>
                                    {{ $index + 1 }}
                                </td>
                                <td>
                                    {{ $item->name ?? '' }}
                                </td>
                                <td>
                                    {{ $item->profession ?? '' }}
                                </td>
                                <td>
                                    @if ($item->image != null)
                                        <img src="{{ asset($item->image) }}" style="height: 100px; width:100px;" alt="">
                                    @else
                                        No Image
                                    @endif
                                </td>
                                <td>
                                    @can('team_edit')
                                        <a class="btn btn-warning btn-sm" href="{{ route('admin.team.edit', $item->id) }}">
                                            <i class="fas fa-pencil-alt">
                                            </i>
                                            Edit
                                        </a>
                                    @endcan
                                    @can('team_delete')
                                        <a class="btn btn-danger btn-sm"
                                            onclick="teamDelete{{ $item->id }}({{ $item->id }})">
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
        </div>
        <!-- end page title -->
    </div>
@endsection
@section('scripts')
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/izitoast@1.4.0/dist/js/iziToast.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/5.10.0/tinymce.min.js"></script>
    @foreach ($team as $item)
        <script>
            function teamDelete{{ $item->id }}(id) {
                swal({
                    title: "Are You Sure Want To Delete?",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                }).then((willDelete) => {
                    if (willDelete) {
                        var url = '{{ route('admin.deleteTeam', ':id') }}';
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

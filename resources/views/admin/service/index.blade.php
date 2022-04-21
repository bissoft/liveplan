@extends('layouts.admin')
@section('content')
    <div class="container-fluid">
        <!-- start page title -->
        <div class="card">
            <div class="row">
                <div class="col-md-12">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h4 class="mb-0">Services</h4>
                        @can('service_create')
                            <div>
                                <a href="{{ route('admin.service.create') }}" class="btn btn-primary">Add New</a>
                            </div>
                        @endcan
                    </div>
                </div>
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
            </div>
            <div class="card-body">
                
                <div class="table-responsive">
                <table id="example" class="table table-responsive" style="width:100%">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Heading</th>
                            <th scope="col">Icon</th>
                            <th scope="col">Description</th>
                            <th scope="col">Actions</th>

                        </tr>
                    </thead>
                    <tbody>
                        
                        @foreach ($service as $index => $item)
                            <tr>
                                <td>
                                    {{ $index + 1 }}
                                </td>
                                <td>
                                    {{ $item->name ?? '' }}
                                </td>
                                <td>
                                    {{ $item->icon ?? '' }}
                                </td>
                                <td>
                                    {!! $item->description ?? '' !!}
                                </td>
                                <td style="min-width: 190px;">
                                    @can('service_edit')
                                        <a class="btn btn-warning btn-sm" href="{{ route('admin.service.edit', $item->id) }}">
                                            <i class="fas fa-pencil-alt">
                                            </i>
                                            Edit
                                        </a>
                                    @endcan
                                    @can('service_delete')
                                        <a class="btn btn-danger btn-sm"
                                            onclick="serviceDelete{{ $item->id }}({{ $item->id }})">
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
    </div> <!-- container-fluid -->
@endsection
@section('scripts')
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/izitoast@1.4.0/dist/js/iziToast.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/5.10.0/tinymce.min.js"></script>
    @foreach ($service as $item)
        <script>
            function serviceDelete{{ $item->id }}(id) {
                swal({
                    title: "Are You Sure Want To Delete?",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                }).then((willDelete) => {
                    if (willDelete) {
                        var url = '{{ route('admin.deleteService', ':id') }}';
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

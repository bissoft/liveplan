@extends('layouts.admin')
@section('content')
    <div class="container-fluid">
        <!-- start page title -->
        <div class="card">
            <div class="row">
                <div class="col-12">
                    <div class="card-header page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0">Packages</h4>
                        @can('package_create')
                            <div>
                                <a href="{{ route('admin.package.create') }}" class="btn btn-primary">Add New</a>
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
                <table id="example" class="table-bordered table-responsive" style="width:100%">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Heading</th>
                            <th scope="col">Title</th>
                            <th scope="col">Price</th>
                            <th scope="col">Type</th>
                            <th scope="col">Points</th>
                            <th scope="col">Actions</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($package as $index => $item)
                            <tr>
                                <td>
                                    {{ $index + 1 }}
                                </td>
                                <td>
                                    {{ $item->heading ?? '' }}
                                </td>
                                <td>
                                    {{ $item->title ?? '' }}
                                </td>
                                <td>
                                    {{ $item->price ?? '' }}
                                </td>
                                <td>
                                    @if($item->type==0)
                                    Monthly
                                    @else
                                    Yearly
                                    @endif
                                </td>
                                @php
                                    $arr = json_decode($item->point, true);
                                @endphp
                                <td>
                                    @foreach ($arr as $item1)
                                        <span class="btn-info">{{ $item1 }}</span>
                                    @endforeach
                                </td>
                                <td style="min-width: 190px;">
                                    @can('package_edit')
                                        <a class="btn btn-warning btn-sm" href="{{ route('admin.package.edit', $item->id) }}">
                                            <i class="fas fa-pencil-alt">
                                            </i>
                                            Edit
                                        </a>
                                    @endcan
                                    @can('package_delete')
                                        <a class="btn btn-danger btn-sm"
                                            onclick="packageDelete{{ $item->id }}({{ $item->id }})">
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
            <!-- end page title -->
        </div> <!-- container-fluid -->
    </div>
@endsection
@section('scripts')
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/izitoast@1.4.0/dist/js/iziToast.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/5.10.0/tinymce.min.js"></script>
    @foreach ($package as $item)
        <script>
            function packageDelete{{ $item->id }}(id) {
                swal({
                    title: "Are You Sure Want To Delete?",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                }).then((willDelete) => {
                    if (willDelete) {
                        var url = '{{ route('admin.deletePackage', ':id') }}';
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

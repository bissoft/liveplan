@extends('layouts.admin')
@section('content')
    <div class="container-fluid">
        <!-- start page title -->
        <div class="card">
        <div class="row">
            <div class="col-12">
                <div class="card-header page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0">Newsletter</h4>
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
            <table class="table table-bordered table-responsive" style="width:100%">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Email</th>
                        <th scope="col">Actions</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($newsletter as $index => $item)
                        <tr>
                            <td>
                                {{ $index + 1 }}
                            </td>
                            <td>
                                {{ $item->email ?? '' }}
                            </td>
                            <td>
                                @can('newsletter_delete')
                                    <a class="btn btn-danger btn-sm"
                                        onclick="newsletterDelete{{ $item->id }}({{ $item->id }})">
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
    </div> <!-- container-fluid -->
@endsection
@section('scripts')
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/izitoast@1.4.0/dist/js/iziToast.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/5.10.0/tinymce.min.js"></script>
    @foreach ($newsletter as $item)
        <script>
            function newsletterDelete{{ $item->id }}(id) {
                swal({
                    title: "Are You Sure Want To Delete?",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                }).then((willDelete) => {
                    if (willDelete) {
                        var url = '{{ route('admin.deleteNewsletter', ':id') }}';
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

@extends('layouts.admin')
@section('style')
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
@endsection
@section('content')
    <div class="container-fluid">
        <!-- start page title -->
        <div class="card">
            <div class="row">
                <div class="col-12">
                    <div class="card-header page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0">Companies</h4>
                        @can('webbook_company_create')
                            <div>
                                <a href="{{ route('admin.companies.create') }}" class="btn btn-primary">Add New</a>
                            </div>
                        @endcan
                    </div>
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
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
                                <th scope="col">ID</th>
                                <th scope="col">Name</th>
                                <th scope="col">Created At</th>
                                <th scope="col">Actions</th>
                                <th scope="col">More</th>

                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $arr = $company['results'];
                            @endphp
                            @foreach ($arr as $index => $item)
                                <tr>

                                    <td>
                                        {{ $index + 1 }}
                                    </td>
                                    <td>
                                        {{ $item['id'] ?? '' }}
                                    </td>
                                    <td>
                                        {{ $item['name'] ?? '' }}

                                    </td>
                                    <td>
                                        {{ $item['created'] ?? '' }}
                                    </td>

                                    <td style="min-width: 190px;">
                                        @can('webbook_company_view')
                                            <a class="btn btn-info btn-sm"
                                                href="{{ route('admin.companies.show', $item['id']) }}">
                                                View
                                            </a>
                                        @endcan
                                        @can('webbook_company_edit')
                                            <a class="btn btn-warning btn-sm"
                                                href="{{ route('admin.companies.edit', $item['id']) }}">
                                                Edit
                                            </a>
                                        @endcan
                                        @can('webbook_company_delete')
                                            <form action="{{ route('admin.companies.destroy', $item['id']) }}" method="POST"
                                                onsubmit="return confirm('{{ trans('global.areYouSure') }}');"
                                                style="display: inline-block;">
                                                <input type="hidden" name="_method" value="DELETE">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <input type="submit" class="btn btn-danger btn-sm"
                                                    value="{{ trans('global.delete') }}">
                                            </form>
                                        @endcan


                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-dark btn-sm dropdown-toggle"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Action
                                            </button>
                                            <div class="dropdown-menu" style="position: initial;">
                                                <a class="dropdown-item" href="{{url('admin/connection/'.$item['id'])}}">Connection</a>
                                                <a class="dropdown-item" href="{{url('admin/customer/'.$item['id'])}}">Customer</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item" href="{{ route('admin.companies.syncsetting', $item['id']) }}">Sync Setting</a>
                                                <a class="dropdown-item" href="{{ route('admin.companies.setting', $item['id']) }}">Setting</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
            <!-- end page title -->
        </div> <!-- container-fluid -->
    </div>
@endsection
@section('scripts')
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/izitoast@1.4.0/dist/js/iziToast.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/5.10.0/tinymce.min.js"></script>
    @foreach ($arr as $index => $item)
        <script>
            function webbook_companyDelete{{ $index }}() {
                var id = $('#company{{ $index }}').value;
                swal({
                    title: "Are You Sure Want To Delete?",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                }).then((willDelete) => {
                    if (willDelete) {
                        var url = '{{ route('admin.deleteCompanies', ':id') }}';
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

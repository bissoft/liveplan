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
                        <h4 class="mb-0">Connections</h4>
                        @can('webbook_company_create')
                            {{-- <div>
                                <a href="{{ route('admin.companies.create') }}" class="btn btn-primary">Add New</a>
                            </div> --}}
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
                                <th scope="col">Integration Id</th>
                                <th scope="col">Source Id</th>
                                <th scope="col">Platform Name</th>
                                <th scope="col">status</th>
                                <th scope="col">sourceType</th>
                                <th scope="col">Actions</th>

                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $arr = $connection['results'];
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
                                        {{ $item['integrationId'] ?? '' }}

                                    </td>
                                    <td>
                                        {{ $item['sourceId'] ?? '' }}
                                    </td>
                                    <td>
                                        {{ $item['platformName'] ?? '' }}
                                    </td>
                                    <td>
                                        {{ $item['status'] ?? '' }}
                                    </td>
                                    <td>
                                        {{ $item['sourceType'] ?? '' }}
                                    </td>

                                    <td style="min-width: 190px;">
                                        <a class="btn btn-info btn-sm"
                                            href="{{ url('admin/view-connection/' . $id . '/' . $item['id']) }}">
                                            View
                                        </a>
                                        <form action="{{ url('admin/delete-connection/' . $id . '/' . $item['id']) }}"
                                            method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');"
                                            style="display: inline-block;">
                                            @csrf
                                            <input type="submit" class="btn btn-danger btn-sm"
                                                value="{{ trans('global.delete') }}">
                                        </form>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-dark btn-sm dropdown-toggle"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                More
                                            </button>
                                            <div class="dropdown-menu" style="position: initial;">
                                                <a class="dropdown-item" href="{{url('admin/bank_balance/'.$id.'/'.$item['id'])}}">Banking Account Balance</a>
                                                <div class="dropdown-divider"></div>
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

@extends('layouts.admin')
@section('content')
    <div class="container-fluid">
        <!-- start page title -->
        <div class="card">
            <div class="row">
                <div class="col-12">
                    <div class="card-header page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0">Attachments</h4>
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
                                <th scope="col">Contact Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Currency</th>
                                <th scope="col">Phone</th>
                                <th scope="col">Registration No</th>
                                <th scope="col">Tax No</th>
                                <th scope="col">Status</th>
                                <th scope="col">Modified Date</th>
                                <th scope="col">Actions</th>

                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $arr = $attachment['results'];
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
                                        {{ $item['customerName'] ?? '' }}
                                    </td>
                                    <td>
                                        {{ $item['contactName'] ?? '' }}
                                    </td>
                                    <td>
                                        {{ $item['emailAddress'] ?? '' }}
                                    </td>
                                    <td>
                                        {{ $item['defaultCurrency'] ?? '' }}
                                    </td>
                                    <td>
                                        {{ $item['phone'] ?? '' }}
                                    </td>
                                    <td>
                                        {{ $item['registrationNumber'] ?? '' }}
                                    </td>
                                    <td>
                                        {{ $item['taxNumber'] ?? '' }}
                                    </td>
                                    <td>
                                        {{ $item['status'] ?? '' }}
                                    </td>
                                    <td>
                                        {{ $item['modifiedDate'] ?? '' }}
                                    </td>

                                    <td style="min-width: 190px;">
                                        @can('webbook_customer_view')
                                            <a class="btn btn-warning btn-sm"
                                                href="{{ url('admin/view-customer/'.$company.'/'.$item['id']) }}">
                                                View
                                            </a>
                                        @endcan
                                        @can('webbook_customer_delete')
                                            {{-- <input type="hidden" value="{{$item['id']??''}}" id="company{{$index}}" name="company{{$index}}">
                                            <a class="btn btn-danger btn-sm"
                                                onclick="customerDelete{{ $index }}()">
                                                <i class="fas fa-trash">
                                                </i>
                                                Delete
                                            </a> --}}
                                        @endcan
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
                        var url = '{{ url('admin/deleteCustomer/'. ':id') }}';
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

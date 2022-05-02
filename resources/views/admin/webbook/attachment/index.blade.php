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
                    <div class="row" style="padding: 10px;">
                        <form action="{{route('admin.fetchAttachment')}}" method="POST">
                            @csrf
                            <input type="hidden" name="company_id" value="{{$company}}">
                            <input type="hidden" name="customer_id" value="{{$id}}">
                        <div class="col-md-6 form-group">
                            <label for="">Connentions</label>
                            @php
                                $arr = $connection['results'];
                            @endphp
                            <select name="connection" class="form-control" id="">
                                @foreach ($arr as $item)
                                <option value="{{ $item['id'] ?? '' }}">{{ $item['platformName'] ?? '' }}</option>
                                @endforeach
                                
                            </select>
                        </div>
                        <div class="col-md-2 form-group">
                            <button type="submit" class="btn btn-primary">Filter</button>
                        </div>
                    </form>
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
                    <div class="card-body">

                        <div class="table-responsive">
                            <table id="example" class="table table-responsive" style="width:100%">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">ID</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Content Type</th>
                                        <th scope="col">Created At</th>
                                        <th scope="col">File Size</th>
                                        {{-- <th scope="col">Actions</th> --}}
        
                                    </tr>
                                </thead>
                                @if($attachment!='')
                                <tbody>
                                    @php
                                        $arr = $attachment['attachments'];
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
                                                {{ $item['contentType'] ?? '' }}
                                            </td>
                                            <td>
                                                {{ $item['dateCreated'] ?? '' }}
                                            </td>
                                            <td>
                                                {{ $item['fileSize'] ?? '' }}
                                            </td>
        
                                            {{-- <td style="min-width: 190px;">
                                                <a class="btn btn-info btn-sm"
                                                    href="{{ url('admin/view-attachment/' . $id . '/' . $item['id']) }}">
                                                    View
                                                </a>
                                                <a class="btn btn-warning btn-sm"
                                                    href="{{ url('admin/attachment-download/' . $id . '/' . $item['id']) }}">
                                                    download
                                                </a>
                                            </td> --}}
                                        </tr>
                                    @endforeach
        
                                </tbody>
                                @endif
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end page title -->
        </div> <!-- container-fluid -->
    </div>
@endsection

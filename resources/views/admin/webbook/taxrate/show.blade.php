@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            Tax Rate
        </div>

        <div class="card-body">
            <div class="form-group">
                <div class="form-group">
                    <a class="btn btn-default" href="{{ url('admin/taxrate/' . $id) }}">
                        Back
                    </a>
                </div>
                <table class="table table-bordered table-striped">
                    <tbody>
                        <tr>
                            <th>
                                ID
                            </th>
                            <td>
                                {{ $taxrate['id'] ?? '' }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                Name
                            </th>
                            <td>
                                {{ $taxrate['name'] ?? '' }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                Code
                            </th>
                            <td>
                                {{ $taxrate['code'] ?? '' }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                Effective Tax Rate
                            </th>
                            <td>
                                {{ $taxrate['effectiveTaxRate'] ?? '' }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                Total Tax Rate
                            </th>
                            <td>
                                {{ $taxrate['totalTaxRate'] ?? '' }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                Components
                            </th>
                            <td>
                                @foreach ($taxrate['components'] as $item)
                                <b>Name:</b>{{ $item['name'] ?? '' }} <br>
                                <b>Rate:</b>{{ $item['rate'] ?? '' }} <br>
                                <b>Is Compound:</b>@if ($item['isCompound']==1)
                                    True
                                    @else
                                    False
                                @endif <br>
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <th>
                                Modified Date
                            </th>
                            <td>
                                {{ $taxrate['modifiedDate'] ?? '' }}
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="form-group">
                    <a class="btn btn-default" href="{{ url('admin/taxrate/' . $id) }}">
                        Back
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection

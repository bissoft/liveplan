@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            Customer
        </div>

        <div class="card-body">
            <div class="form-group">
                <div class="form-group">
                    <a class="btn btn-default" href="{{ url('admin/customer/' . $company) }}">
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
                                {{ $customer['id'] ?? '' }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                Customer Name
                            </th>
                            <td>
                                {{ $customer['customerName'] ?? '' }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                Contact Name
                            </th>
                            <td>
                                {{ $customer['contactName'] ?? '' }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                Email
                            </th>
                            <td>
                                {{ $customer['emailAddress'] ?? '' }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                Phone
                            </th>
                            <td>
                                {{ $customer['phone'] ?? '' }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                Currency
                            </th>
                            <td>
                                {{ $customer['defaultCurrency'] ?? '' }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                Contacts
                            </th>
                            @php
                                $arr = $customer['contacts'];
                            @endphp

                            <td>
                                @foreach ($arr as $index => $item)
                                    <b>Name:</b>{{ $item['name'] ?? '' }}, <b>Email:</b>{{ $item['email'] ?? '' }}<br>
                                    @php
                                        $phone = $item['phone'];
                                        $address = $item['address'];
                                    @endphp
                                        <b>{{ $address['type'] ?? '' }}:</b>{{ $address['line1'] ?? '' }}
                                        {{ $address['line2'] ?? '' }} {{ $address['city'] ?? '' }},
                                        {{ $address['region'] ?? '' }} {{ $address['country'] ?? '' }} -
                                        {{ $address['postalCode'] ?? '' }}<br>
                                        <b>Status</b>: {{ $item['status'] ?? '' }} <br>
                                    @foreach ($phone as $item1)
                                        <b>{{ $item1['type'] ?? '' }}:</b>{{ $item1['number'] ?? '' }} <br>
                                    @endforeach
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <th>
                                Registration Number
                            </th>
                            <td>
                                {{ $customer['registrationNumber'] ?? '' }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                Tax Number
                            </th>
                            <td>
                                {{ $customer['taxNumber'] ?? '' }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                status
                            </th>
                            <td>
                                {{ $customer['status'] ?? '' }}
                            </td>
                        </tr>

                    </tbody>
                </table>
                <div class="form-group">
                    <a class="btn btn-default" href="{{ url('admin/customer/' . $company) }}">
                        Back
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection

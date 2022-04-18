@extends('layouts.admin')

@section('content')

<div class="container-fluid search-filed">
    <div class="page-title-box pt-2 pb-3">
        <h4 class="mb-4 d-inline-block">Contacts</h4>
        <div class="user-chosen-select-container">
            <label>Filter by Type</label>
            <select class="user-chosen-select">
                <option value="">All</option>
                <option value="paid_customer" @if($type == 'paid_customer') selected @endif>Paid Customer</option>
                <option value="prospect" @if($type == 'prospect') selected @endif>Prospect</option>
                <option value="business" @if($type == 'business') selected @endif>Buiness</option>
            </select>
        </div>
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        @if(session()->has('message'))
            <div class="alert alert-success">{{ session()->get('message') }}</div>
        @endif

        
        @if($contacts->count())
            <table class="table table-striped table-responsive my-table">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Type</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach($contacts as $contact)

                        @if(!$contact->is_admin)

                            <tr>
                                <td>{{ $contact->id }}</td>
                                <td>{{ $contact->name }}</td>
                                <td>{{ $contact->email }}</td>
                                <td class="text-capitalize">{{ str_replace('_', ' ', $contact->type) }}</td>
                            </tr>

                        @endif

                    @endforeach

                </tbody>
            </table>
            <div>{{ $contacts->links() }}</div>

        @else
            <p class="text-center">No contacts found</p>
        @endif

            </tbody>
        </table>
    </div>
</div>

@endsection

@section('scripts')

<script>

    $(document).ready(function(){
        $('.user-chosen-select').on('change', function(){
            window.location.href = '/admin/contacts/' + $(this).val();
        });
    });
</script>

@endsection
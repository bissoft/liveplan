@extends('layouts.admin')

@section('content')

<div class="container-fluid search-filed">
    <div class="page-title-box pt-2 pb-3">
        <h4 class="mb-4">Accounts</h4>
        @if(session()->has('message'))
            <div class="alert alert-success">{{ session()->get('message') }}</div>
        @endif
        <div class="filter-drop-check mt-3 ">
            <h5>Filter by </h5>
            <div class="dropdown">
                <button class="btn btn-primary px-4 dropdown-toggle" type="button" id="lists-dropdown" data-toggle="dropdown" data-selected="{{ @$list->id }}" aria-haspopup="true" aria-expanded="false">
                    Lists: {{ @$list->name }} <span class="fa fa-angle-down ml-2"></span>
                </button>
                <div class="dropdown-menu" aria-labelledby="lists-dropdown">
                    <a class="dropdown-item" href="#" data-value="">All</a>
                    @foreach($lists as $_list)
                        <a class="dropdown-item" href="#" data-value="{{ $_list->id }}">{{ $_list->name }}</a>
                    @endforeach
                </div>
            </div>
            <div class="dropdown">
                <button class="btn btn-primary px-4 dropdown-toggle" type="button" id="name-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Name: {{ @$name }} <span class="fa fa-angle-down ml-2"></span>
                </button>
                <div class="dropdown-menu px-2" aria-labelledby="name-dropdown">
                    <input type="text" class="form-control mb-2" id="name" name="name" value="{{ @$name }}">
                    <button class="btn btn-sm btn-primary name-filter">Filter</button>
                    <button class="btn btn-sm btn-danger name-clear">Clear</button>
                </div>
            </div>
            <div class="dropdown">
                <button class="btn btn-primary px-4 dropdown-toggle" type="button" id="email-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Email: {{ @$email }} <span class="fa fa-angle-down ml-2"></span>
                </button>
                <div class="dropdown-menu px-2" aria-labelledby="email-dropdown">
                    <input type="text" class="form-control mb-2" id="email" name="email" value="{{ @$email }}">
                    <button class="btn btn-sm btn-primary email-filter">Filter</button>
                    <button class="btn btn-sm btn-danger email-clear">Clear</button>
                </div>
            </div>
            <div class="dropdown">
                <button class="btn btn-primary px-4 dropdown-toggle" type="button" id="title-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Job Title: {{ @$title }} <span class="fa fa-angle-down ml-2"></span>
                </button>
                <div class="dropdown-menu px-2" aria-labelledby="title-dropdown">
                    <input type="text" class="form-control mb-2" id="title" name="title" value="{{ @$title }}">
                    <button class="btn btn-sm btn-primary title-filter">Filter</button>
                    <button class="btn btn-sm btn-danger title-clear">Clear</button>
                </div>
            </div>
            <div class="dropdown">
                <button class="btn btn-primary px-4 dropdown-toggle" type="button" id="location-dropdown" data-toggle="dropdown" data-selected="{{ @$country->id }}" aria-haspopup="true" aria-expanded="false">
                    Location: {{ @$country->name }} <span class="fa fa-angle-down ml-2"></span>
                </button>
                <div class="dropdown-menu" aria-labelledby="location-dropdown">
                    <a class="dropdown-item" href="#" data-value="">All</a>
                    @foreach($countries as $_country)
                        <a class="dropdown-item" href="#" data-value="{{ $_country->id }}">{{ $_country->name }}</a>
                    @endforeach
                </div>
            </div>
            <div class="dropdown">
                <button class="btn btn-primary px-4 dropdown-toggle" type="button" id="company-dropdown" data-toggle="dropdown" data-selected="{{ @$company->id }}" aria-haspopup="true" aria-expanded="false">
                    Company: {{ @$company->name }} <span class="fa fa-angle-down ml-2"></span>
                </button>
                <div class="dropdown-menu" aria-labelledby="company-dropdown">
                    <a class="dropdown-item" href="#" data-value="">All</a>
                    @foreach($companies as $_company)
                        <a class="dropdown-item" href="#" data-value="{{ $_company->id }}">{{ $_company->name }}</a>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="text-right mb-3">
            <a href="{{ route('admin.accounts.create') }}" class="btn btn-linear px-5 py-2">Add</a>
        </div>

        @if($accounts->count())

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Job Title</th>
                        <th scope="col">Company</th>
                        <th scope="col">Location</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach($accounts as $account)

                        <tr>
                            <td>{{ $account->name }}</td>
                            <td>{{ $account->email }}</td>
                            <td>{{ $account->title }}</td>
                            <td><a href="{{ route('admin.companies.show', $account->company->id) }}">{{ $account->company->name }}</a></td>
                            <td>{{ $account->country->name }}</td>
                            <td width="20%">
                                <a href="#" class="add-to-list" data-id="{{ $account->id }}" title="Add to list"><button class="btn btn-outline-primary"><i class="fa fa-plus"></i></button></a>
                                <a href="{{ route('admin.accounts.edit', $account->id) }}"><button class="btn btn-outline-primary"><i class="fa fa-edit"></i></button></a> 
                                <a href="" class="action-delete"><button class="btn btn-outline-danger"><i class="fas fa-trash-alt"></i></button></a>
                                <form action="{{ route('admin.accounts.destroy', $account->id) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="_method" value="DELETE">
                                </form>
                            </td>
                        </tr>

                    @endforeach

                </tbody>
            </table>

        @else
            <p class="text-center">No accounts found</p>
        @endif
    </div>
</div>

<div id="list-modal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Add To List</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <form action="{{ route('admin.accounts.addToList') }}" method="POST" class="list-form">
            @csrf
            <label>Select List</label>
            <input type="hidden" name="account_id" id="account-id">
            <select name="list_id" class="form-control">
                @foreach($lists as $list)
                    <option value="{{ $list->id }}">{{ $list->name }}</option>
                @endforeach
            </select>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success btn-save">Save</button>
      </div>
    </div>

  </div>
</div>

@endsection

@section('scripts')

<script type="text/javascript">
    $(document).ready(function () {

        $('.action-delete').on('click', function (e) {
            e.preventDefault();

            $(this).siblings('form').submit();
        });

        function apply_filters() {

            let list = $('#lists-dropdown').data('selected');
            let location = $('#location-dropdown').data('selected');
            let company = $('#company-dropdown').data('selected');
            let name = $('#name').val();
            let email = $('#email').val();
            let title = $('#title').val();
            
            window.location.href = '/admin/accounts'
                + '?list_id=' + list
                + '&country_id=' + location
                + '&company_id=' + company
                + '&name=' + name
                + '&email=' + email
                + '&title=' + title;
        }

        $('.dropdown-item').on('click', function (e) {
            e.preventDefault();

            $(this).closest('.dropdown')
                .find('button')
                .data('selected', $(this).data('value'));
            
            apply_filters();
        });

        $('.name-filter, .email-filter, .title-filter').on('click', function () {
            apply_filters();
        });

        $('.name-clear').on('click', function () {
            $('#name').val('');
            apply_filters();
        });

        $('.email-clear').on('click', function () {
            $('#email').val('');
            apply_filters();
        });

        $('.title-clear').on('click', function () {
            $('#title').val('');
            apply_filters();
        });

        $('.add-to-list').on('click', function () {
            
            $('#account-id').val($(this).data('id'));
            $('#list-modal').modal('show');
        });

        $('.btn-save').on('click', function () {
            
            $('.list-form').submit();
        });
    });
</script>

@endsection
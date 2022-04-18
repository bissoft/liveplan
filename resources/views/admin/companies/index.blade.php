@extends('layouts.admin')

@section('content')

<div class="container-fluid search-filed">
    <div class="page-title-box pt-2 pb-3">
        <h4 class="mb-4">Companies</h4>
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
                <button class="btn btn-primary px-4 dropdown-toggle" type="button" id="industry-dropdown" data-toggle="dropdown" data-selected="{{ @$industry->id }}" aria-haspopup="true" aria-expanded="false">
                    Industry: {{ @$industry->name }} <span class="fa fa-angle-down ml-2"></span>
                </button>
                <div class="dropdown-menu" aria-labelledby="industry-dropdown">
                    <a class="dropdown-item" href="#" data-value="">All</a>
                    @foreach($industries as $_industry)
                        <a class="dropdown-item" href="#" data-value="{{ $_industry->id }}">{{ $_industry->name }}</a>
                    @endforeach
                </div>
            </div>
            <div class="dropdown">
                <button class="btn btn-primary px-4 dropdown-toggle" type="button" id="keywords-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Keywords: {{ @$keywords }} <span class="fa fa-angle-down ml-2"></span>
                </button>
                <div class="dropdown-menu px-2" aria-labelledby="keywords-dropdown">
                    <input type="text" class="form-control mb-2" id="keywords" name="keywords" value="{{ @$keywords }}">
                    <button class="btn btn-sm btn-primary keywords-filter">Filter</button>
                    <button class="btn btn-sm btn-danger keywords-clear">Clear</button>
                </div>
            </div>
        </div>
        <div class="text-right mb-3">
            <a href="{{ route('admin.import.companies.form') }}" class="btn btn-linear px-5 py-2">Import</a>
            <!-- <a href="{{ route('admin.companies.create') }}" class="btn btn-linear px-5 py-2">Add</a> -->
        </div>

        @if($companies->count())

            <table class="table table-bordered table-responsive">
                <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <!-- <th scope="col">Country</th>
                        <th scope="col">City</th>
                        <th scope="col">Region</th>
                        <th scope="col">Zip</th> -->
                        <!-- <th scope="col">Phone</th>
                        <th scope="col">Contact</th>
                        <th scope="col">Email</th> -->
                        <!-- <th scope="col">Website</th> -->
                        <!-- <th scope="col">Category</th>
                        <th scope="col">Yelp Rating</th>
                        <th scope="col">Yelp Reviews</th>
                        <th scope="col">Facebook Rating</th>
                        <th scope="col">Facebook Reviews</th>
                        <th scope="col">Facebook Followers</th> -->
                        <!-- <th scope="col">Linkedin</th>
                        <th scope="col">Facebook</th>
                        <th scope="col">Twitter</th> -->
                        <!-- <th scope="col">Pinterest</th> -->
                        <!-- <th scope="col">Instagram</th> -->
                        <!-- <th scope="col">Youtube</th>
                        <th scope="col">Facebook Marketing</th>
                        <th scope="col">Adwords</th>
                        <th scope="col">Twitter Ads</th>
                        <th scope="col">Linkedin Ads</th> -->
                        <th scope="col">Employees</th>
                        <!-- <th scope="col">Year Established</th>
                        <th scope="col">Responsive</th>
                        <th scope="col">Web Hosting</th>
                        <th scope="col">Email Hosting</th>
                        <th scope="col">CMS</th>
                        <th scope="col">Marketing Auto</th>
                        <th scope="col">Schema</th>
                        <th scope="col">Open Graph</th>
                        <th scope="col">Latitude</th>
                        <th scope="col">Longitude</th> -->
                        <th scope="col">Industry</th>
                        <th scope="col">Keywords</th>
                        <th scope="col">Location</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach($companies as $company)

                        <tr>
                            <td>{{ $company->name }}</td>
                            <!-- <td>{{ $company->country->name }}</td>
                            <td>{{ $company->country->name }}</td>
                            <td>{{ $company->country->name }}</td>
                            <td>{{ $company->zip }}</td> -->
                            <!-- <td>{{ $company->phone }}</td>
                            <td>{{ $company->contact }}</td>
                            <td>{{ $company->email }}</td> -->
                            <!-- <td>{{ $company->website }}</td> -->
                            <!-- <td>{{ $company->category }}</td>
                            <td>{{ $company->yelp_rating }}</td>
                            <td>{{ $company->yelp_reviews }}</td>
                            <td>{{ $company->facebook_rating }}</td>
                            <td>{{ $company->facebook_reviews }}</td>
                            <td>{{ $company->facebook_followers }}</td> -->
                            <!-- <td>{{ $company->linkedin }}</td>
                            <td>{{ $company->facebook }}</td>
                            <td>{{ $company->twitter }}</td> -->
                            <!-- <td>{{ $company->pinterest }}</td>
                            <td>{{ $company->instagram }}</td>
                            <td>{{ $company->youtube }}</td>
                            <td>{{ $company->facebook_marketing }}</td>
                            <td>{{ $company->adwords }}</td>
                            <td>{{ $company->twitter_ads }}</td>
                            <td>{{ $company->linkedin_ads }}</td> -->
                            <td>{{ $company->employees }}</td>
                            <!-- <td>{{ $company->year_established }}</td>
                            <td>{{ $company->responsive }}</td>
                            <td>{{ $company->web_hosting }}</td>
                            <td>{{ $company->email_hosting }}</td>
                            <td>{{ $company->cms }}</td>
                            <td>{{ $company->marketing_auto }}</td>
                            <td>{{ $company->schema }}</td>
                            <td>{{ $company->open_graph }}</td>
                            <td>{{ $company->latitude }}</td>
                            <td>{{ $company->longitude }}</td> -->
                            <td>{{ @$company->industry->name }}</td>
                            <td>{{ $company->keywords }}</td>
                            <td>{{ $company->city->name . ', ' .$company->country->name }}</td>
                            <td width="20%">
                                <a href="#" class="add-to-list" data-id="{{ $company->id }}" title="Add to list"><button class="btn btn-outline-primary"><i class="fa fa-plus"></i></button></a>
                                <a href="{{ route('admin.companies.edit', $company->id) }}"><button class="btn btn-outline-primary"><i class="fa fa-edit"></i></button></a> 
                                <a href="" class="action-delete"><button class="btn btn-outline-danger"><i class="fas fa-trash-alt"></i></button></a>
                                <form action="{{ route('admin.companies.destroy', $company->id) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="_method" value="DELETE">
                                </form>
                            </td>
                        </tr>

                    @endforeach

                </tbody>
            </table>

        @else
            <p class="text-center">No companies found</p>
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
        <form action="{{ route('admin.companies.addToList') }}" method="POST" class="list-form">
            @csrf
            <label>Select List</label>
            <input type="hidden" name="company_id" id="company-id">
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
            let industry = $('#industry-dropdown').data('selected');
            let keywords = $('#keywords').val();
            
            window.location.href = '/admin/companies'
              + '?list_id=' + list
              + '&country_id=' + location
              + '&industry_id=' + industry
              + '&keywords=' + keywords;
        }

        $('.dropdown-item').on('click', function (e) {
            e.preventDefault();

            $(this).closest('.dropdown')
                .find('button')
                .data('selected', $(this).data('value'));

            apply_filters();
        });

        $('.keywords-filter').on('click', function () {
            apply_filters();
        });

        $('.keywords-clear').on('click', function () {
            $('#keywords').val('');
            apply_filters();
        });

        $('.add-to-list').on('click', function () {
            
            $('#company-id').val($(this).data('id'));
            $('#list-modal').modal('show');
        });

        $('.btn-save').on('click', function () {
            
            $('.list-form').submit();
        });
    });
</script>

@endsection
@extends('layouts.admin')

@section('content')

<div class="container-fluid search-filed">
    <div class="page-title-box pt-2 pb-3">
        <h4 class="mb-4">Lists</h4>
        <div class="text-right mb-3">
            <a href="{{ route('admin.lists.create') }}" class="btn btn-linear px-5 py-2">Add</a>
        </div>

        @if($lists->count())

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Type</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach($lists as $list)

                        <tr>
                            <td><a href="{{ $list->type == 'company' ? url('/admin/companies?list_id=' . $list->id) : url('/admin/accounts?list_id=' . $list->id) }}">{{ $list->name }}</a></td>
                            <td class="text-capitalize">{{ $list->type }}</td>
                            <td width="15%">
                                <a href="{{ route('admin.lists.edit', $list->id) }}"><button class="btn btn-outline-primary"><i class="fa fa-edit"></i></button></a> 
                                <a href="" class="action-delete"><button class="btn btn-outline-danger"><i class="fas fa-trash-alt"></i></button></a>
                                <form action="{{ route('admin.lists.destroy', $list->id) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="_method" value="DELETE">
                                </form>
                            </td>
                        </tr>

                    @endforeach

                </tbody>
            </table>

        @else
            <p class="text-center">No lists found</p>
        @endif
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
    });
</script>
@endsection
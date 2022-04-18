@extends('layouts.admin')

@section('content')

<div class="container-fluid search-filed">
    <div class="page-title-box pt-2 pb-3">
        <h4 class="mb-4 d-inline-block">Xero Profit and Loss</h4>
        @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
        <form action="{{route('admin.xero.fetchProfitAndLoss')}}" method="GET">
                    <div class="col-12 filters my-3">
                <div class="row w-100">
                    <div class="col-12 col-md-5 px-md-1 form-group ">
                        <label>From</label>
                        <input type="date" required class="form-control fromDate" style="border-radius: 10px;" name="fromDate" value="{{old('fromDate')}}">
                    </div>
                    <div class="col-12 col-md-5 px-md-1 form-group ">
                        <label>To</label>
                        <input type="date" required class="form-control toDate" style="border-radius: 10px;" name="toDate" value="{{old('toDate')}}">
                    </div>
                    <div class="col-12 col-md-2 px-md-1 ">
                        
                        <button class="btn btn-info mt-md-4 w-100"style="border-radius: 10px;" type="submit">Fetch from Xero</button>
                    </div>
                </div>
                    </form>
            </div>
        @if(session()->has('message'))
        <div class="alert alert-success">{{ session()->get('message') }}</div>
        @endif

        @if($profitLoss->count())
            <table class="my-table table table-striped table-responsive ">
                <thead>
                    <tr>
                        <th scope="col">ReportID</th>
                        <th scope="col">ReportName</th>
                        <th scope="col">ReportType</th>
                        <th scope="col">ReportTitles</th>
                        <th scope="col">ReportDate</th>
                        <th scope="col">UpdatedDateUTC</th>
                        <th scope="col">Rows</th>
                    </tr>
                </thead>
                <tbody>

                @foreach($profitLoss as $item)
                <tr>
                    <td>{{ $item->ReportID }}</td>
                    <td>{{ $item->ReportName }}</td>
                    <td>{{ $item->ReportType }}</td>
                    <td>{{  collect(json_decode($item->ReportTitles,true))->implode(',')  }}</td>
                    <td>{{ $item->ReportDate }}</td>
                    <td>{{ $item->UpdatedDateUTC }}</td>
                    <td><?php
                        $arr = json_decode($item->Rows,true);
                        if($arr!=null){
                        for($i=0; $i<=5; $i++){
                            $innerArray = $arr[$i];
                        echo collect($innerArray['RowType'])->implode(',');
                        
                        }
                    }
                        ?></td>
                </tr>

                @endforeach

            </tbody>
        </table>
        <div>{{ $profitLoss->links() }}</div>

        @else
        <p class="text-center">No Profit And Loss found</p>
        @endif
    </div>
</div>

@endsection
@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>

<script>
$(document).ready(function () {
  $('.fromDate').datetimepicker({
    format: 'YYYY/MM/DD',
    locale: 'en'
  });
  $('.toDate').datetimepicker({
    format: 'YYYY/MM/DD',
    locale: 'en'
  });
</script>    
@endsection
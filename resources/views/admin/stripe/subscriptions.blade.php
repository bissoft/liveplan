@extends('layouts.admin')
@section('content')
<div class="main-content">
    <div class="container">
        <div class="card-body">
            <div class="table table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-Role">
                    <thead>
                        <tr>
                            <th>Subscription Id.</th>
                            <th>User Id</th>
                            <th>User Name</th>
                            <th>Status</th>
                            <th>Amount</th>
                            <th>Subscription Start</th>
                            <th>Subscription Renewal</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($subscriptions as $subscription)
                        <?php $s = $subscription->asStripeSubscription() ?>
                        <tr>
                            <td>
                                {{$subscription->id}}
                            </td>
                            <td>
                                {{$subscription->user->id}}
                            </td>
                            <td>
                                {{$subscription->user->name}}
                            </td>
                            <td>
                                {{$subscription->stripe_status}}
                            </td>
                            <td>
                                {{($s->plan->amount/100).' '.strtoupper($s->plan->currency)}}
                            </td>
                            <td>
                                {{date('m/d/Y h:m:i', $s->current_period_start)}}
                            </td>
                            <td>
                                {{date('m/d/Y h:m:i', $s->current_period_end)}}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
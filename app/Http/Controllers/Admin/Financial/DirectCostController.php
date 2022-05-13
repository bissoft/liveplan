<?php

namespace App\Http\Controllers\Admin\Financial;

use App\DirectCost;
use App\Http\Controllers\Controller;
use App\direct;
use App\Revenue;
use Exception;
use Illuminate\Http\Request;

class DirectCostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $direct_cost = DirectCost::orderBy('created_at', 'ASC')->get();
        return view('admin/direct_cost.index', compact('direct_cost'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $revenue = Revenue::orderBy('id','ASC')->get();
        return view('admin/direct_cost.create',compact('revenue'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //  dd($request->all());
        try {
            $direct = new DirectCost;
            $direct->name = $request->name;
            $direct->cost = $request->cost;
            // Cost
            if ($request->cost == 0) {
                // constant
                $direct->constant = $request->constant;

                if ($request->constant == 0) {
                    $direct->cost_amount = $request->cost_amount;
                    $direct->cost_amount_type = $request->cost_amount_type;
                    $request->cost_amount_start = $request->cost_amount_start;
                }elseif ($request->constant == 2) {
                    $direct->cost_amount = $request->constant_overall_amount;
                    $request->cost_amount_start = $request->overall_amount_start;
                } else {
                    $data = [
                        $request->cost_month0, $request->cost_month1, $request->cost_month2, $request->cost_month3,
                        $request->cost_month4, $request->cost_month5, $request->cost_month6, $request->cost_month7, $request->cost_month8,
                        $request->cost_month9, $request->cost_month10, $request->cost_month11, $request->cost_month_total, $request->cost_year2, $request->cost_year3, $request->cost_year4, $request->cost_year5
                    ];
                    $direct->cost_amount = json_encode($data);
                }
            }else{
                $direct->constant = $request->constant;
                $direct->revenue_id = $request->revenue_id;
                if ($request->constant == 0) {
                    $direct->cost_amount = $request->cost_amount;
                    $direct->cost_amount_type = $request->cost_amount_type;
                    $request->cost_amount_start = $request->cost_amount_start;
                }elseif ($request->constant == 2) {
                    $direct->cost_amount = $request->constant_overall_amount;
                    $request->cost_amount_start = $request->overall_amount_start;
                } else {
                    $data = [
                        $request->cost_month0, $request->cost_month1, $request->cost_month2, $request->cost_month3,
                        $request->cost_month4, $request->cost_month5, $request->cost_month6, $request->cost_month7, $request->cost_month8,
                        $request->cost_month9, $request->cost_month10, $request->cost_month11, $request->cost_month_total, $request->cost_year2, $request->cost_year3, $request->cost_year4, $request->cost_year5
                    ];
                    $direct->cost_amount = json_encode($data);
                }
            }
            // Bill Hour (Step 2)
            // if ($request->type == 2) {
            //     // Bill for constant
            //     $direct->bill_for = $request->billable_constant;
            //     // Bill hour constant
            //     $direct->bill_hour = $request->billable_hour_constant;

            //     if ($request->billable_constant == 0) {
            //         $direct->bill_amount = $request->billable_constant_amount;
            //         $direct->bill_constant_type = $request->billable_constant_type;
            //         $request->bill_start = $request->billable_start;
            //     } else {
            //         $data = [
            //             $request->billable_month0, $request->billable_month1, $request->billable_month2, $request->billable_month3,
            //             $request->billable_month4, $request->billable_month5, $request->billable_month6, $request->billable_month7, $request->billable_month8,
            //             $request->billable_month9, $request->billable_month10, $request->billable_month11, $request->billable_month_total, $request->billable_year2, $request->billable_year3, $request->billable_year4, $request->billable_year5
            //         ];
            //         $direct->bill_amount = json_encode($data);
            //     }
            //     if ($request->billable_hour_constant == 0) {
            //         $direct->bill_hour_amount = $request->billable_hour_amount;
            //     } else {
            //         $data1 = [
            //             $request->rate_month0, $request->rate_month1, $request->rate_month2, $request->rate_month3,
            //             $request->rate_month4, $request->rate_month5, $request->rate_month6, $request->rate_month7, $request->rate_month8,
            //             $request->rate_month9, $request->rate_month10, $request->rate_month11, $request->rate_year1, $request->rate_year2, $request->rate_year3, $request->rate_year4, $request->rate_year5
            //         ];
            //         $direct->bill_hour_amount = json_encode($data1);
            //     }
            // }
            // if ($request->type == 3) {
            //     // Signup constant
            //     $direct->signups = $request->signup_constant;
            //     // Up front constant
            //     $direct->up_front = $request->up_front_constant;
            //     // Recurring constant
            //     $direct->recurring_charge = $request->recurring_constant;
            //     // Recurring assess
            //     // $direct->recurring_charge = $request->recurring_assess;
            //     // churn constant
            //     $direct->churn_rate = $request->churn_constant;

            //     if ($request->signup_constant == 0) {
            //         $direct->signups_amount = $request->signup_constant_amount;
            //         $request->direct_start = $request->recurring_start;
            //     } else {
            //         $data = [
            //             $request->signup_month0, $request->signup_month1, $request->signup_month2, $request->signup_month3,
            //             $request->signup_month4, $request->signup_month5, $request->signup_month6, $request->signup_month7, $request->signup_month8,
            //             $request->signup_month9, $request->signup_month10, $request->signup_month11, $request->signup_month_total, $request->signup_year2, $request->signup_year3, $request->signup_year4, $request->signup_year5
            //         ];
            //         $direct->signups_amount = json_encode($data);
            //     }
            //     if ($request->up_front_constant == 0) {
            //         $direct->up_front_amount = $request->up_front_constant_amount;
            //     } else {
            //         $data1 = [
            //             $request->up_front_month0, $request->up_front_month1, $request->up_front_month2, $request->up_front_month3,
            //             $request->up_front_month4, $request->up_front_month5, $request->up_front_month6, $request->up_front_month7, $request->up_front_month8,
            //             $request->up_front_month9, $request->up_front_month10, $request->up_front_month11, $request->up_front_year1, $request->up_front_year2, $request->up_front_year3, $request->up_front_year4, $request->up_front_year5
            //         ];
            //         $direct->up_front_amount = json_encode($data1);
            //     }
            //     if ($request->recurring_constant == 0) {
            //         $direct->recurring_amount = $request->recurring_constant_amount;
            //     } else {
            //         $data = [
            //             $request->recurring_month0, $request->recurring_month1, $request->recurring_month2, $request->recurring_month3,
            //             $request->recurring_month4, $request->recurring_month5, $request->recurring_month6, $request->recurring_month7, $request->recurring_month8,
            //             $request->recurring_month9, $request->recurring_month10, $request->recurring_month11, $request->recurring_year1, $request->recurring_year2, $request->recurring_year3, $request->recurring_year4, $request->recurring_year5
            //         ];
            //         $direct->recurring_amount = json_encode($data);
            //     }
            //     if ($request->churn_constant == 0) {
            //         $direct->churn_amount = $request->churn_constant_amount;
            //     } else {
            //         $data = [
            //             $request->churn_month0, $request->churn_month1, $request->churn_month2, $request->churn_month3,
            //             $request->churn_month4, $request->churn_month5, $request->churn_month6, $request->churn_month7, $request->churn_month8,
            //             $request->churn_month9, $request->churn_month10, $request->churn_month11, $request->churn_year1, $request->churn_year2, $request->churn_year3, $request->churn_year4, $request->churn_year5
            //         ];
            //         $direct->churn_amount = json_encode($data);
            //     }
            // }
            // if ($request->type == 4) {
            //     $direct->only_direct = $request->direct_constant;
            //     if ($request->direct_constant == 0) {
            //         $direct->only_direct_amount = $request->direct_constant_amount;
            //         $direct->only_direct_type = $request->direct_constant_type;
            //         $request->only_direct_start = $request->direct_start;
            //     } else {
            //         $data = [
            //             $request->direct_month0, $request->direct_month1, $request->direct_month2, $request->direct_month3,
            //             $request->direct_month4, $request->direct_month5, $request->direct_month6, $request->direct_month7, $request->direct_month8,
            //             $request->direct_month9, $request->direct_month10, $request->direct_month11, $request->direct_month_total, $request->direct_year2, $request->direct_year3, $request->direct_year4, $request->direct_year5
            //         ];
            //         $direct->only_direct_amount = json_encode($data);
            //     }
            // }
            $direct->save();
            return redirect('admin/direct-cost')->with('success', 'Direct Cost has created!');
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\DirectCost  $directCost
     * @return \Illuminate\Http\Response
     */
    public function show(DirectCost $directCost)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\DirectCost  $directCost
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $direct_cost = DirectCost::find($id);
        $revenue = Revenue::orderBy('id','ASC')->get();
        return view('admin/direct_cost.edit',compact('direct_cost','revenue'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\DirectCost  $directCost
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $direct = DirectCost::find($id);
            $direct->name = $request->name;
            $direct->cost = $request->cost;
            // Cost
            if ($request->cost == 0) {
                // constant
                $direct->constant = $request->constant;

                if ($request->constant == 0) {
                    $direct->cost_amount = $request->cost_amount;
                    $direct->cost_amount_type = $request->cost_amount_type;
                    $request->cost_amount_start = $request->cost_amount_start;
                }elseif ($request->constant == 2) {
                    $direct->cost_amount = $request->constant_overall_amount;
                    $request->cost_amount_start = $request->overall_amount_start;
                } else {
                    $data = [
                        $request->cost_month0, $request->cost_month1, $request->cost_month2, $request->cost_month3,
                        $request->cost_month4, $request->cost_month5, $request->cost_month6, $request->cost_month7, $request->cost_month8,
                        $request->cost_month9, $request->cost_month10, $request->cost_month11, $request->cost_month_total, $request->cost_year2, $request->cost_year3, $request->cost_year4, $request->cost_year5
                    ];
                    $direct->cost_amount = json_encode($data);
                }
            }else{
                $direct->constant = $request->constant;
                $direct->revenue_id = $request->revenue_id;
                if ($request->constant == 0) {
                    $direct->cost_amount = $request->cost_amount;
                    $direct->cost_amount_type = $request->cost_amount_type;
                    $request->cost_amount_start = $request->cost_amount_start;
                }elseif ($request->constant == 2) {
                    $direct->cost_amount = $request->constant_overall_amount;
                    $request->cost_amount_start = $request->overall_amount_start;
                } else {
                    $data = [
                        $request->cost_month0, $request->cost_month1, $request->cost_month2, $request->cost_month3,
                        $request->cost_month4, $request->cost_month5, $request->cost_month6, $request->cost_month7, $request->cost_month8,
                        $request->cost_month9, $request->cost_month10, $request->cost_month11, $request->cost_month_total, $request->cost_year2, $request->cost_year3, $request->cost_year4, $request->cost_year5
                    ];
                    $direct->cost_amount = json_encode($data);
                }
            }
            
            $direct->update();
            return redirect('admin/direct-cost')->with('success', 'Direct Cost has updated!');
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DirectCost  $directCost
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $direct_cost = DirectCost::find($request->id);
        $direct_cost->delete();
        return response(['message' => 'Direct Cost delete successfully']);
    }
}

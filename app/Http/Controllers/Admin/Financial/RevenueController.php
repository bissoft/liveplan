<?php

namespace App\Http\Controllers\Admin\Financial;

use App\Http\Controllers\Controller;
use App\Revenue;
use Illuminate\Http\Request;

class RevenueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $revenue = Revenue::orderBy('created_at', 'ASC')->get();
        return view('admin/revenue.index', compact('revenue'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/revenue.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $validation = $request->validate(
            [
                'name' => 'required|max:255',
                'type' => 'required'
            ]
        );
        $revenue = new Revenue;
        $revenue->name = $request->name;
        $revenue->type = $request->type;
        // Unit Sell (Type 1)
        if ($request->type == 1) {
            // Unit sell constant
            $revenue->unit_sell = $request->constant;
            // Unit Price constant
            $revenue->unit_price = $request->sale_constant;

            if ($request->constant == 0) {
                $revenue->unit_sell_amount = $request->constant_amount;
                $revenue->unit_constant_type = $request->constant_type;
                $request->unit_revenue_start = $request->constant_start;
            } else {
                $data = [
                    $request->unit_month0, $request->unit_month1, $request->unit_month2, $request->unit_month3,
                    $request->unit_month4, $request->unit_month5, $request->unit_month6, $request->unit_month7, $request->unit_month8,
                    $request->unit_month9, $request->unit_month10, $request->unit_month11, $request->unit_month_total, $request->unit_year2, $request->unit_year3, $request->unit_year4, $request->unit_year5
                ];
                $revenue->unit_sell_amount = json_encode($data);
            }
            if ($request->sale_constant == 0) {
                $revenue->unit_price_amount = $request->sale_constant_price;
            } else {
                $data1 = [
                    $request->sale_month0, $request->sale_month1, $request->sale_month2, $request->sale_month3,
                    $request->sale_month4, $request->sale_month5, $request->sale_month6, $request->sale_month7, $request->sale_month8,
                    $request->sale_month9, $request->sale_month10, $request->sale_month11, $request->sale_year1, $request->sale_year2, $request->sale_year3, $request->sale_year4, $request->sale_year5
                ];
                $revenue->unit_price_amount = json_encode($data1);
            }
        }
        // Bill Hour (Step 2)
        if ($request->type == 2) {
            // Bill for constant
            $revenue->bill_for = $request->billable_constant;
            // Bill hour constant
            $revenue->bill_hour = $request->billable_hour_constant;

            if ($request->billable_constant == 0) {
                $revenue->bill_amount = $request->billable_constant_amount;
                $revenue->bill_constant_type = $request->billable_constant_type;
                $request->bill_start = $request->billable_start;
            } else {
                $data = [
                    $request->billable_month0, $request->billable_month1, $request->billable_month2, $request->billable_month3,
                    $request->billable_month4, $request->billable_month5, $request->billable_month6, $request->billable_month7, $request->billable_month8,
                    $request->billable_month9, $request->billable_month10, $request->billable_month11, $request->billable_month_total, $request->billable_year2, $request->billable_year3, $request->billable_year4, $request->billable_year5
                ];
                $revenue->bill_amount = json_encode($data);
            }
            if ($request->billable_hour_constant == 0) {
                $revenue->bill_hour_amount = $request->billable_hour_amount;
            } else {
                $data1 = [
                    $request->rate_month0, $request->rate_month1, $request->rate_month2, $request->rate_month3,
                    $request->rate_month4, $request->rate_month5, $request->rate_month6, $request->rate_month7, $request->rate_month8,
                    $request->rate_month9, $request->rate_month10, $request->rate_month11, $request->rate_year1, $request->rate_year2, $request->rate_year3, $request->rate_year4, $request->rate_year5
                ];
                $revenue->bill_hour_amount = json_encode($data1);
            }
        }
        if ($request->type == 3) {
            // Signup constant
            $revenue->signups = $request->signup_constant;
            // Up front constant
            $revenue->up_front = $request->up_front_constant;
            // Recurring constant
            $revenue->recurring_charge = $request->recurring_constant;
            // Recurring assess
            // $revenue->recurring_charge = $request->recurring_assess;
            // churn constant
            $revenue->churn_rate = $request->churn_constant;

            if ($request->signup_constant == 0) {
                $revenue->signups_amount = $request->signup_constant_amount;
                $request->revenue_start = $request->recurring_start;
            } else {
                $data = [
                    $request->signup_month0, $request->signup_month1, $request->signup_month2, $request->signup_month3,
                    $request->signup_month4, $request->signup_month5, $request->signup_month6, $request->signup_month7, $request->signup_month8,
                    $request->signup_month9, $request->signup_month10, $request->signup_month11, $request->signup_month_total, $request->signup_year2, $request->signup_year3, $request->signup_year4, $request->signup_year5
                ];
                $revenue->signups_amount = json_encode($data);
            }
            if ($request->up_front_constant == 0) {
                $revenue->up_front_amount = $request->up_front_constant_amount;
            } else {
                $data1 = [
                    $request->up_front_month0, $request->up_front_month1, $request->up_front_month2, $request->up_front_month3,
                    $request->up_front_month4, $request->up_front_month5, $request->up_front_month6, $request->up_front_month7, $request->up_front_month8,
                    $request->up_front_month9, $request->up_front_month10, $request->up_front_month11, $request->up_front_year1, $request->up_front_year2, $request->up_front_year3, $request->up_front_year4, $request->up_front_year5
                ];
                $revenue->up_front_amount = json_encode($data1);
            }
            if ($request->recurring_constant == 0) {
                $revenue->recurring_amount = $request->recurring_constant_amount;
            } else {
                $data = [
                    $request->recurring_month0, $request->recurring_month1, $request->recurring_month2, $request->recurring_month3,
                    $request->recurring_month4, $request->recurring_month5, $request->recurring_month6, $request->recurring_month7, $request->recurring_month8,
                    $request->recurring_month9, $request->recurring_month10, $request->recurring_month11, $request->recurring_year1, $request->recurring_year2, $request->recurring_year3, $request->recurring_year4, $request->recurring_year5
                ];
                $revenue->recurring_amount = json_encode($data);
            }
            if ($request->churn_constant == 0) {
                $revenue->churn_amount = $request->churn_constant_amount;
            } else {
                $data = [
                    $request->churn_month0, $request->churn_month1, $request->churn_month2, $request->churn_month3,
                    $request->churn_month4, $request->churn_month5, $request->churn_month6, $request->churn_month7, $request->churn_month8,
                    $request->churn_month9, $request->churn_month10, $request->churn_month11, $request->churn_year1, $request->churn_year2, $request->churn_year3, $request->churn_year4, $request->churn_year5
                ];
                $revenue->churn_amount = json_encode($data);
            }
        }
        if ($request->type == 4) {
            $revenue->only_revenue = $request->revenue_constant;
            if ($request->revenue_constant == 0) {
                $revenue->only_revenue_amount = $request->revenue_constant_amount;
                $revenue->only_revenue_type = $request->revenue_constant_type;
                $request->only_revenue_start = $request->revenue_start;
            } else {
                $data = [
                    $request->revenue_month0, $request->revenue_month1, $request->revenue_month2, $request->revenue_month3,
                    $request->revenue_month4, $request->revenue_month5, $request->revenue_month6, $request->revenue_month7, $request->revenue_month8,
                    $request->revenue_month9, $request->revenue_month10, $request->revenue_month11, $request->revenue_month_total, $request->revenue_year2, $request->revenue_year3, $request->revenue_year4, $request->revenue_year5
                ];
                $revenue->only_revenue_amount = json_encode($data);
            }
        }
        $revenue->save();
        return redirect('admin/revenue')->with('success', 'Revenue has created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Revenue  $revenue
     * @return \Illuminate\Http\Response
     */
    public function show(Revenue $revenue)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Revenue  $revenue
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $revenue = Revenue::find($id);
        return view('admin/revenue.edit',compact('revenue'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Revenue  $revenue
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // dd($request->all());
        $validation = $request->validate(
            [
                'name' => 'required|max:255',
                'type' => 'required'
            ]
        );
        $revenue = Revenue::find($id);
        $revenue->name = $request->name;
        $revenue->type = $request->type;
        // Unit Sell (Type 1)
        if ($request->type == 1) {
            // Unit sell constant
            $revenue->unit_sell = $request->unit_sell;
            // Unit Price constant
            $revenue->unit_price = $request->unit_price;

            if ($request->unit_sell == 0) {
                $revenue->unit_sell_amount = $request->unit_sell_amount;
                $revenue->unit_constant_type = $request->unit_constant_type;
                $request->unit_revenue_start = $request->unit_revenue_start;
            } else {
                $data = [
                    $request->edit_unit_month0, $request->edit_unit_month1, $request->edit_unit_month2, $request->edit_unit_month3,
                    $request->edit_unit_month4, $request->edit_unit_month5, $request->edit_unit_month6, $request->edit_unit_month7, $request->edit_unit_month8,
                    $request->edit_unit_month9, $request->edit_unit_month10, $request->edit_unit_month11, $request->edit_unit_month_total, $request->edit_unit_year2, $request->edit_unit_year3, $request->edit_unit_year4, $request->edit_unit_year5
                ];
                $revenue->unit_sell_amount = json_encode($data);
            }
            if ($request->unit_price == 0) {
                $revenue->unit_price_amount = $request->unit_price_amount;
            } else {
                $data1 = [
                    $request->edit_sale_month0, $request->edit_sale_month1, $request->edit_sale_month2, $request->edit_sale_month3,
                    $request->edit_sale_month4, $request->edit_sale_month5, $request->edit_sale_month6, $request->edit_sale_month7, $request->edit_sale_month8,
                    $request->edit_sale_month9, $request->edit_sale_month10, $request->edit_sale_month11, $request->edit_sale_year1, $request->edit_sale_year2, $request->edit_sale_year3, $request->edit_sale_year4, $request->edit_sale_year5
                ];
                $revenue->unit_price_amount = json_encode($data1);
            }
        }
        // Bill Hour (Step 2)
        if ($request->type == 2) {
            // Bill for constant
            $revenue->bill_for = $request->bill_for;
            // Bill hour constant
            $revenue->bill_hour = $request->bill_hour;

            if ($request->bill_for == 0) {
                $revenue->bill_amount = $request->bill_amount;
                $revenue->bill_constant_type = $request->bill_constant_type;
                $request->bill_start = $request->bill_start;
            } else {
                $data = [
                    $request->edit_billable_month0, $request->edit_billable_month1, $request->edit_billable_month2, $request->edit_billable_month3,
                    $request->edit_billable_month4, $request->edit_billable_month5, $request->edit_billable_month6, $request->edit_billable_month7, $request->edit_billable_month8,
                    $request->edit_billable_month9, $request->edit_billable_month10, $request->edit_billable_month11, $request->edit_billable_month_total, $request->edit_billable_year2, $request->edit_billable_year3, $request->edit_billable_year4, $request->edit_billable_year5
                ];
                $revenue->bill_amount = json_encode($data);
            }
            if ($request->bill_hour == 0) {
                $revenue->bill_hour_amount = $request->bill_hour_amount;
            } else {
                $data1 = [
                    $request->edit_rate_month0, $request->edit_rate_month1, $request->edit_rate_month2, $request->edit_rate_month3,
                    $request->edit_rate_month4, $request->edit_rate_month5, $request->edit_rate_month6, $request->edit_rate_month7, $request->edit_rate_month8,
                    $request->edit_rate_month9, $request->edit_rate_month10, $request->edit_rate_month11, $request->edit_rate_year1, $request->edit_rate_year2, $request->edit_rate_year3, $request->edit_rate_year4, $request->edit_rate_year5
                ];
                $revenue->bill_hour_amount = json_encode($data1);
            }
        }
        if ($request->type == 3) {
            // Signup constant
            $revenue->signups = $request->signups;
            // Up front constant
            $revenue->up_front = $request->up_front;
            // Recurring constant
            $revenue->recurring_charge = $request->recurring_charge;
            // Recurring assess
            // $revenue->recurring_charge = $request->recurring_assess;
            // churn constant
            $revenue->churn_rate = $request->churn_rate;

            if ($request->signups == 0) {
                $revenue->signups_amount = $request->signups_amount;
                $request->revenue_start = $request->revenue_start;
            } else {
                $data = [
                    $request->edit_signup_month0, $request->edit_signup_month1, $request->edit_signup_month2, $request->edit_signup_month3,
                    $request->edit_signup_month4, $request->edit_signup_month5, $request->edit_signup_month6, $request->edit_signup_month7, $request->edit_signup_month8,
                    $request->edit_signup_month9, $request->edit_signup_month10, $request->edit_signup_month11, $request->edit_signup_month_total,
                     $request->edit_signup_year2, $request->edit_signup_year3, $request->edit_signup_year4, $request->edit_signup_year5
                ];
                $revenue->signups_amount = json_encode($data);
            }
            if ($request->up_front == 0) {
                $revenue->up_front_amount = $request->up_front_amount;
            } else {
                $data1 = [
                    $request->edit_up_front_month0, $request->edit_up_front_month1, $request->edit_up_front_month2, $request->edit_up_front_month3,
                    $request->edit_up_front_month4, $request->edit_up_front_month5, $request->edit_up_front_month6, $request->edit_up_front_month7, $request->edit_up_front_month8,
                    $request->edit_up_front_month9, $request->edit_up_front_month10, $request->edit_up_front_month11, $request->edit_up_front_year1,
                     $request->edit_up_front_year2, $request->edit_up_front_year3, $request->edit_up_front_year4, $request->edit_up_front_year5
                ];
                $revenue->up_front_amount = json_encode($data1);
            }
            if ($request->recurring_charge == 0) {
                $revenue->recurring_amount = $request->recurring_amount;
            } else {
                $data = [
                    $request->edit_recurring_month0, $request->edit_recurring_month1, $request->edit_recurring_month2, $request->edit_recurring_month3,
                    $request->edit_recurring_month4, $request->edit_recurring_month5, $request->edit_recurring_month6, $request->edit_recurring_month7,
                    $request->edit_recurring_month8,$request->edit_recurring_month9, $request->edit_recurring_month10, $request->edit_recurring_month11,
                     $request->edit_recurring_year1, $request->edit_recurring_year2, $request->edit_recurring_year3, $request->edit_recurring_year4, $request->edit_recurring_year5
                ];
                $revenue->recurring_amount = json_encode($data);
            }
            if ($request->churn_rate == 0) {
                $revenue->churn_amount = $request->churn_amount;
            } else {
                $data = [
                    $request->edit_churn_month0, $request->edit_churn_month1, $request->edit_churn_month2, $request->edit_churn_month3,
                    $request->edit_churn_month4, $request->edit_churn_month5, $request->edit_churn_month6, $request->edit_churn_month7,
                    $request->edit_churn_month8, $request->edit_churn_month9, $request->edit_churn_month10, $request->edit_churn_month11,
                    $request->edit_churn_year1, $request->edit_churn_year2, $request->edit_churn_year3, $request->edit_churn_year4, $request->edit_churn_year5
                ];
                $revenue->churn_amount = json_encode($data);
            }
        }
        if ($request->type == 4) {
            $revenue->only_revenue = $request->only_revenue;
            if ($request->only_revenue == 0) {
                $revenue->only_revenue_amount = $request->only_revenue_amount;
                $revenue->only_revenue_type = $request->only_revenue_type;
                $request->only_revenue_start = $request->only_revenue_start;
            } else {
                $data = [
                    $request->edit_revenue_month0, $request->edit_revenue_month1, $request->edit_revenue_month2, $request->edit_revenue_month3,
                    $request->edit_revenue_month4, $request->edit_revenue_month5, $request->edit_revenue_month6, $request->edit_revenue_month7, $request->edit_revenue_month8,
                    $request->edit_revenue_month9, $request->edit_revenue_month10, $request->edit_revenue_month11, $request->edit_revenue_month_total,
                     $request->edit_revenue_year2, $request->edit_revenue_year3, $request->edit_revenue_year4, $request->edit_revenue_year5
                ];
                $revenue->only_revenue_amount = json_encode($data);
            }
        }
        $revenue->update();
        return redirect('admin/revenue')->with('success', 'Revenue has updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Revenue  $revenue
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $revenue = Revenue::find($request->id);
        $revenue->delete();
        return response(['message' => 'Revenue delete successfully']);
    }
}

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
        if ($request->type == 1) {
            $revenue->constant = $request->constant;
            $revenue->unit_price_constant = $request->sale_constant;
            if ($request->constant == 0) {
                $revenue->amount = $request->constant_amount;
                $revenue->amount_type = $request->constant_type;
                $request->revenue_start = $request->constant_start;
            } else {
                $data = [
                    $request->unit_month0, $request->unit_month1, $request->unit_month2, $request->unit_month3,
                    $request->unit_month4, $request->unit_month5, $request->unit_month6, $request->unit_month7, $request->unit_month8,
                    $request->unit_month9, $request->unit_month10, $request->unit_month11, $request->unit_month_total, $request->unit_year2, $request->unit_year3, $request->unit_year4, $request->unit_year5
                ];
                $revenue->amount = json_encode($data);
            }
            if ($request->sale_constant == 0) {
                $revenue->unit_price = $request->sale_constant_price;
            } else {
                $data1 = [
                    $request->sale_month0, $request->sale_month1, $request->sale_month2, $request->sale_month3,
                    $request->sale_month4, $request->sale_month5, $request->sale_month6, $request->sale_month7, $request->sale_month8,
                    $request->sale_month9, $request->sale_month10, $request->sale_month11, $request->sale_year1, $request->sale_year2, $request->sale_year3, $request->sale_year4, $request->sale_year5
                ];
                $revenue->unit_price = json_encode($data1);
            }
        }
        if ($request->type == 2) {

            $revenue->constant = $request->billable_constant;
            $revenue->unit_price_constant = $request->billable_hour_constant;
            if ($request->billable_constant == 0) {
                $revenue->amount = $request->billable_constant_amount;
                $revenue->amount_type = $request->billable_constant_type;
                $request->revenue_start = $request->billable_start;
            } else {
                $data = [
                    $request->billable_month0, $request->billable_month1, $request->billable_month2, $request->billable_month3,
                    $request->billable_month4, $request->billable_month5, $request->billable_month6, $request->billable_month7, $request->billable_month8,
                    $request->billable_month9, $request->billable_month10, $request->billable_month11, $request->billable_month_total, $request->billable_year2, $request->billable_year3, $request->billable_year4, $request->billable_year5
                ];
                $revenue->amount = json_encode($data);
            }
            if ($request->billable_hour_constant == 0) {
                $revenue->unit_price = $request->billable_hour_amount;
            } else {
                $data1 = [
                    $request->rate_month0, $request->rate_month1, $request->rate_month2, $request->rate_month3,
                    $request->rate_month4, $request->rate_month5, $request->rate_month6, $request->rate_month7, $request->rate_month8,
                    $request->rate_month9, $request->rate_month10, $request->rate_month11, $request->rate_year1, $request->rate_year2, $request->rate_year3, $request->rate_year4, $request->rate_year5
                ];
                $revenue->unit_price = json_encode($data1);
            }
        }
        if ($request->type == 4) {
            $revenue->constant = $request->revenue_constant;
            if ($request->revenue_constant == 0) {
                $revenue->amount = $request->revenue_constant_amount;
                $revenue->amount_type = $request->revenue_constant_type;
                $request->revenue_start = $request->revenue_start;
            } else {
                $data = [
                    $request->revenue_month0, $request->revenue_month1, $request->revenue_month2, $request->revenue_month3,
                    $request->revenue_month4, $request->revenue_month5, $request->revenue_month6, $request->revenue_month7, $request->revenue_month8,
                    $request->revenue_month9, $request->revenue_month10, $request->revenue_month11, $request->revenue_month_total, $request->revenue_year2, $request->revenue_year3, $request->revenue_year4, $request->revenue_year5
                ];
                $revenue->amount = json_encode($data);
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
    public function edit(Revenue $revenue)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Revenue  $revenue
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Revenue $revenue)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Revenue  $revenue
     * @return \Illuminate\Http\Response
     */
    public function destroy(Revenue $revenue)
    {
        //
    }
}

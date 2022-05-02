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
        $revenue->constant = $request->constant;
        if ($request->type == 1) {
            if ($request->constant == 0) {
                $revenue->amount = $request->constant_amount;
                $revenue->amount_type = $request->constant_type;
                $request->revenue_start = $request->constant_start;
            } else {
                $data = [
                    $request->month0, $request->month1, $request->month2, $request->month3,
                    $request->month4, $request->month5, $request->month6, $request->month7, $request->month8,
                    $request->month9, $request->month10, $request->year1, $request->year2, $request->year3, $request->year4, $request->year5
                ];
                $revenue->amount = json_encode($data);
            }
            if ($request->unit_constant == 0) {
                $revenue->unit_price = $request->unit_constant_price;
            } else {
                $data1 = [
                    $request->unit_month0, $request->unit_month1, $request->unit_month2, $request->unit_month3,
                    $request->unit_month4, $request->unit_month5, $request->unit_month6, $request->unit_month7, $request->unit_month8,
                    $request->unit_month9, $request->unit_month10, $request->unit_year2, $request->unit_year3, $request->unit_year4, $request->unit_year5
                ];
                $revenue->unit_price = json_encode($data1);
            }
        }
        if ($request->type == 2) {
            if ($request->billable_constant == 0) {
                $revenue->amount = $request->billable_constant_amount;
                $revenue->amount_type = $request->billable_constant_type;
                $request->revenue_start = $request->billable_start;
            } else {
                $data = [
                    $request->month0, $request->month1, $request->month2, $request->month3,
                    $request->month4, $request->month5, $request->month6, $request->month7, $request->month8,
                    $request->month9, $request->month10, $request->year1, $request->year2, $request->year3, $request->year4, $request->year5
                ];
                $revenue->amount = json_encode($data);
            }
            if ($request->billable_hour_constant == 0) {
                $revenue->unit_price = $request->billable_hour_amount;
            } else {
                $data1 = [
                    $request->unit_month0, $request->unit_month1, $request->unit_month2, $request->unit_month3,
                    $request->unit_month4, $request->unit_month5, $request->unit_month6, $request->unit_month7, $request->unit_month8,
                    $request->unit_month9, $request->unit_month10, $request->unit_year2, $request->unit_year3, $request->unit_year4, $request->unit_year5
                ];
                $revenue->unit_price = json_encode($data1);
            }
        }
        if ($request->type == 4) {
            if ($request->revenue_constant == 0) {
                $revenue->amount = $request->revenue_constant_amount;
                $revenue->amount_type = $request->revenue_constant_type;
                $request->revenue_start = $request->revenue_start;
            } else {
                $data = [
                    $request->month0, $request->month1, $request->month2, $request->month3,
                    $request->month4, $request->month5, $request->month6, $request->month7, $request->month8,
                    $request->month9, $request->month10, $request->year1, $request->year2, $request->year3, $request->year4, $request->year5
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

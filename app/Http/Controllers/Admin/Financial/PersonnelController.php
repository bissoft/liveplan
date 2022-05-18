<?php

namespace App\Http\Controllers\Admin\Financial;

use App\Http\Controllers\Controller;
use App\Personnel;
use Exception;
use Illuminate\Http\Request;

class PersonnelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $personnel = Personnel::orderBy('created_at', 'ASC')->get();
        return view('admin/personnel.index', compact('personnel'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/personnel.create');
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
            $personnel = new Personnel;
            $personnel->name = $request->name;
            $personnel->employee_type = $request->employee_type;
            $personnel->employee_role = $request->employee_role;
            $personnel->labor_type = $request->labor_type;

            // Cost
            if ($request->employee_type == 0) {
                // constant
                $personnel->constant = $request->constant;

                if ($request->constant == 0) {
                    $personnel->constant_amount = $request->constant_amount;
                    $personnel->constant_amount_type = $request->constant_amount_type;
                    $personnel->constant_amount_start = $request->constant_amount_start;
                    $personnel->annual = $request->annual;
                } else {
                    $data = [
                        $request->constant_month0, $request->constant_month1, $request->constant_month2, $request->constant_month3,
                        $request->constant_month4, $request->constant_month5, $request->constant_month6, $request->constant_month7, $request->constant_month8,
                        $request->constant_month9, $request->constant_month10, $request->constant_month11, $request->constant_month_total, $request->constant_year2, $request->constant_year3, $request->constant_year4, $request->constant_year5
                    ];
                    $personnel->constant_amount = json_encode($data);
                }
            }else{
                $personnel->constant = $request->constant;
                $personnel->group_constant = $request->group_constant;
                if ($request->group_constant == 0) {
                    $personnel->group_employee = $request->group_employee;
                } else {
                    $data = [
                        $request->group_month0, $request->group_month1, $request->group_month2, $request->group_month3,
                        $request->group_month4, $request->group_month5, $request->group_month6, $request->group_month7, $request->group_month8,
                        $request->group_month9, $request->group_month10, $request->group_month11, $request->group_month_total, $request->group_year2, $request->group_year3, $request->group_year4, $request->group_year5
                    ];
                    $personnel->group_employee = json_encode($data);
                }
                if ($request->constant == 0) {
                    $personnel->constant_amount = $request->constant_amount;
                    $personnel->constant_amount_type = $request->constant_amount_type;
                    $personnel->constant_amount_start = $request->constant_amount_start;
                    $personnel->annual = $request->annual;
                } else {
                    $data = [
                        $request->constant_month0, $request->constant_month1, $request->constant_month2, $request->constant_month3,
                        $request->constant_month4, $request->constant_month5, $request->constant_month6, $request->constant_month7, $request->constant_month8,
                        $request->constant_month9, $request->constant_month10, $request->constant_month11, $request->constant_month_total, $request->constant_year2, $request->constant_year3, $request->constant_year4, $request->constant_year5
                    ];
                    $personnel->constant_amount = json_encode($data);
                }
            }
            
            $personnel->save();
            return redirect('admin/personnel')->with('success', 'Personnel has created!');
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Personnel  $Personnel
     * @return \Illuminate\Http\Response
     */
    public function show(Personnel $Personnel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Personnel  $Personnel
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $personnel = Personnel::find($id);
        return view('admin/personnel.edit',compact('personnel'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Personnel  $Personnel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $personnel = Personnel::find($id);
            $personnel->name = $request->name;
            $personnel->employee_type = $request->employee_type;
            $personnel->employee_role = $request->employee_role;
            $personnel->labor_type = $request->labor_type;

            // Cost
            if ($request->employee_type == 0) {
                // constant
                $personnel->constant = $request->constant;

                if ($request->constant == 0) {
                    $personnel->constant_amount = $request->constant_amount;
                    $personnel->constant_amount_type = $request->constant_amount_type;
                    $request->constant_amount_start = $request->constant_amount_start;
                    $request->annual = $request->annual;
                } else {
                    $data = [
                        $request->constant_month0, $request->constant_month1, $request->constant_month2, $request->constant_month3,
                        $request->constant_month4, $request->constant_month5, $request->constant_month6, $request->constant_month7, $request->constant_month8,
                        $request->constant_month9, $request->constant_month10, $request->constant_month11, $request->constant_month_total, $request->constant_year2, $request->constant_year3, $request->constant_year4, $request->constant_year5
                    ];
                    $personnel->constant_amount = json_encode($data);
                }
            }else{
                $personnel->constant = $request->constant;
                if ($request->group_constant == 0) {
                    $personnel->group_employee = $request->group_employee;
                } else {
                    $data = [
                        $request->group_month0, $request->group_month1, $request->group_month2, $request->group_month3,
                        $request->group_month4, $request->group_month5, $request->group_month6, $request->group_month7, $request->group_month8,
                        $request->group_month9, $request->group_month10, $request->group_month11, $request->group_month_total, $request->group_year2, $request->group_year3, $request->group_year4, $request->group_year5
                    ];
                    $personnel->group_employee = json_encode($data);
                }
                if ($request->constant == 0) {
                    $personnel->constant_amount = $request->constant_amount;
                    $personnel->constant_amount_type = $request->constant_amount_type;
                    $request->constant_amount_start = $request->constant_amount_start;
                    $request->annual = $request->annual;
                } else {
                    $data = [
                        $request->constant_month0, $request->constant_month1, $request->constant_month2, $request->constant_month3,
                        $request->constant_month4, $request->constant_month5, $request->constant_month6, $request->constant_month7, $request->constant_month8,
                        $request->constant_month9, $request->constant_month10, $request->constant_month11, $request->constant_month_total, $request->constant_year2, $request->constant_year3, $request->constant_year4, $request->constant_year5
                    ];
                    $personnel->constant_amount = json_encode($data);
                }
            }
            
            $personnel->update();
            return redirect('admin/personnel')->with('success', 'Personnel has updated!');
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Personnel  $Personnel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $personnel = Personnel::find($request->id);
        $personnel->delete();
        return response(['message' => 'Personnel delete successfully']);
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\PackagePoint;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Gate;

class PackagePointController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(Gate::denies('packagePoint_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $packagePoint = PackagePoint::orderBy('id','ASC')->get();
        return view('admin/packagePoint.index',compact('packagePoint'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(Gate::denies('packagePoint_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('admin/packagePoint/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation = $request->validate(
            [
                'point' => 'required|max:255'
            ]
        );
        $packagePoint = new PackagePoint;
        $packagePoint->point = $request->point;
        $packagePoint->save();
        return redirect('admin/packagePoint')->with('success','Package Point has created!');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PackagePoint  $packagePoint
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PackagePoint  $packagePoint
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        abort_if(Gate::denies('packagePoint_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $packagePoint = PackagePoint::find($id);
        return view('admin/packagePoint.edit',compact('packagePoint'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PackagePoint  $packagePoint
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $validation = $request->validate(
            [
                'point' => 'required|max:255'
            ]
        );
        $packagePoint = PackagePoint::find($id);
        $packagePoint->point = $request->point;
        $packagePoint->update();
        return redirect('admin/packagePoint')->with('success','Package Point has updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PackagePoint  $packagePoint
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $packagePoint = PackagePoint::find($request->id);
        $packagePoint->delete();
        return response(['message' => 'Package Point delete successfully']);
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Package;
use App\PackagePoint;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Gate;

class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(Gate::denies('package_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $package = Package::orderBy('created_at', 'DESC')->get();
        return view('admin/package.index', compact('package'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(Gate::denies('package_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $packagePoint = PackagePoint::all();
        return view('admin/package.create', compact('packagePoint'));
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
                'heading' => 'required',
                'price' => 'required',
                'type' => 'required',
                'point' => 'required'
            ]
        );

        $package = new Package;
        $package->heading = $request->heading;
        $package->title = $request->title;
        if ($request->type == '0') {
            $package->days = 30;
        } else {
            $package->days = 365;
        }
        // Available alpha caracters
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $characters1 = '@#$%^&*()';

        // generate a pin based on 2 * 7 digits + a random character
        $pin =$characters[rand(0, strlen($characters) - 1)]
         .$characters[rand(0, strlen($characters1) - 1)]
            . $characters1[rand(0, strlen($characters1) - 1)]
            .mt_rand(1000, 9999);
        $package->token = $pin;
        $package->type = $request->type;
        $package->point = json_encode($request->point);
        $package->price = $request->price;
        $package->save();
        return redirect('admin/package')->with('success', 'Package has created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function show(Package $package)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        abort_if(Gate::denies('package_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $package = Package::find($id);
        $packagePoint = PackagePoint::all();
        return view('admin/package.edit', compact('package', 'packagePoint'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validation = $request->validate(
            [
                'heading' => 'required',
                'price' => 'required',
                'point' => 'required'
            ]
        );
        $package = Package::find($id);
        $package->heading = $request->heading;
        if ($request->type == '0') {
            $package->days = 30;
        } else {
            $package->days = 365;
        }
        $package->title = $request->title;
        $package->type = $request->type;
        $package->point = $request->point;
        $package->price = $request->price;
        $package->update();
        return redirect('admin/package')->with('success', 'Package has updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Package  $package
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $package = Package::find($request->id);
        $package->delete();
        return response(['message' => 'Package delete successfully']);
    }
}

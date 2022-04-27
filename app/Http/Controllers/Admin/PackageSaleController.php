<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\PackageSale;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Gate;

class PackageSaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(Gate::denies('package_sale_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $packageSale = PackageSale::orderBy('created_at','DESC')->get();
        return view('admin/packageSale.index',compact('packageSale'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PackageSale  $packageSale
     * @return \Illuminate\Http\Response
     */
    public function show(PackageSale $packageSale)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PackageSale  $packageSale
     * @return \Illuminate\Http\Response
     */
    public function edit(PackageSale $packageSale)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PackageSale  $packageSale
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PackageSale $packageSale)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PackageSale  $packageSale
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $packageSale = PackageSale::find($request->id);
        $packageSale->delete();
        return response(['message' => 'Package Sale delete successfully']);
    }
}

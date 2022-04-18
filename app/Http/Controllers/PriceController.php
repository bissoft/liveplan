<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Price;

class PriceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        // dd('create');
        if($request->isMethod('post'))
        {
            $data = $request->all();
            $price = new Price();
            $price->title = $data['title'];
            $price->heading1 = $data['heading1'];
            $price->heading2 = $data['heading2'];
            $price->desc = $data['desc'];
            $price->string1 = $data['string1'];
            $price->string2 = $data['string2'];
            $price->list1 = $data['list1'];
            $price->list2 = $data['list2'];
            $price->list3 = $data['list3'];
            $price->list4 = $data['list4'];
            $price->list5 = $data['list5'];
            $price->icon = $data['icon'];
            $price->save();
            // dd($latestidea);
            
            return redirect('pricing/view')->with('flash_message_success','price added Successfully');
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $price = Price::where('id',$id)->first();
        return view('admin.prices.edit_price',compact('price'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request , $id)
    {
        $data = $request->all();
        Price::where('id',$id)->update(['title'=>$data['title'],'desc'=>$data['desc'],'heading1'=>$data['heading1'],'heading2'=>$data['heading2'],'string1'=>$data['string1'],'string2'=>$data['string2'],'list1'=>$data['list1'],
    'list2'=>$data['list2'],'list3'=>$data['list3'],'list4'=>$data['list4'],'list5'=>$data['list5'],'icon'=>$data['icon']]);
            return redirect('/pricing/view')->with('flash_message_success','price Updated Successfully!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        Price::where('id',$id)->delete();
        return redirect('/pricing/view')->with('flash_message_error','Price Deleted ');

    }
    public function view()
    {
        $prices = Price::all();
        // dd($chooses);
        return view('admin.prices.view_prices',compact('prices'));
    }
    public function add()
    {
       
        return view('admin.prices.add_price');
        
    }
}

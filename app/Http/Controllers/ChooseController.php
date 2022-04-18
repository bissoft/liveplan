<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Choose;

class ChooseController extends Controller
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
            $choose = new Choose();
            $choose->title = $data['title'];
            $choose->heading = $data['heading'];
            $choose->desc = $data['desc'];
            $choose->string = $data['string'];
            $choose->icon = $data['icon'];
            $choose->save();
            // dd($latestidea);
            
            return redirect('choose/view')->with('flash_message_success','choose added Successfully');
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
        $choose = Choose::where('id',$id)->first();
        return view('admin.chooses.edit_choose',compact('choose'));
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
        
        Choose::where('id',$id)->update(['title'=>$data['title'],'desc'=>$data['desc']
        ,'heading'=>$data['heading'],'string'=>$data['string'],'icon'=>$data['icon']]);
            return redirect('/choose/view')->with('flash_message_success','choose Updated Successfully!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function view()
    {
        $chooses = Choose::all();
        // dd($chooses);
        return view('admin.chooses.view_chooses',compact('chooses'));
    }
    public function add()
    {
       
        return view('admin.chooses.add_choose');
        
    }
    public function delete($id)
    {
        Choose::where('id',$id)->delete();
        return redirect('/choose/view')->with('flash_message_error','choose Deleted ');

    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\About;

class AboutController extends Controller
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
        if($request->isMethod('post'))
        {
            $data = $request->all();
            $about = new About();
            $about->about_title = $data['about_title'];
            $about->about_heading = $data['about_heading'];
            $about->about_description = $data['about_description'];
            $about->icon = $data['icon'];
            $about->about_String = $data['about_String'];
            $about->button_text1 = $data['button_text1'];
            $about->button_text2 = $data['button_text2'];
            $about->save();
            return redirect('/about/view')->with('flash_message_success','about added Successfully');
        }
    }
    public function view()
    {
        $abouts = About::all();
        return view('admin.abouts.view_about',compact('abouts'));
    }

    public function add()
    {
        return view('admin.abouts.add_about');
        
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
        
        $abouts = About::where('id',$id)->first();
        return view('admin.abouts.edit_about',compact('abouts'));
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
    
        About::where('id',$id)->update(['about_title'=>$data['about_title'],'about_heading'=>$data['about_heading'],
        'about_description'=>$data['about_description'],'icon'=>$data['icon'],'about_string'=>$data['about_String'],'button_text1'=>$data['button_text1'],'button_text2'=>$data['button_text2']]);
            return redirect('/about/view')->with('flash_message_success','About Updated Successfully!!');
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
    public function delete($id)
    {
        About::where('id',$id)->delete();
        return redirect('/about/view')->with('flash_message_error','Banner Deleted ');

    }
}

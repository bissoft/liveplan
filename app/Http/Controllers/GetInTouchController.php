<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\GetInTouch;

class GetInTouchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function view()
    {
        $getintouchs =GetInTouch::all();
        return view('admin.getintouchs.view_getintouch',compact('getintouchs'));
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
            $getintouch = new GetInTouch();
            $getintouch->title = $data['title'];
            $getintouch->heading = $data['heading'];
            $getintouch->description = $data['description'];
            $getintouch->button_text = $data['button_text'];
            $getintouch->save();
            return redirect('/getInTouch/view')->with('flash_message_success','Get In Touch  added Successfully');
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
        $getintouch = GetInTouch::where('id',$id)->first();
        return view('admin.getintouchs.edit_getintouch',compact('getintouch'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        // dd($data['heading']);
        GetInTouch::where('id',$id)->update(['title'=>$data['title'],'heading'=>$data['heading'],
        'description'=>$data['description'],'button_text'=>$data['button_text']]);
            return redirect('/getInTouch/view')->with('flash_message_success','GetInTouch Updated Successfully!!');
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
        GetInTouch::where('id',$id)->delete();
        return redirect('/getInTouch/view')->with('flash_message_error','Banner Deleted ');

    }
}


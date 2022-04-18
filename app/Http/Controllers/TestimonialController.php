<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Testimonial;
class TestimonialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function view()
    {
        $testimonials = Testimonial::all();
        return view('admin.testimonials.view_testimonial',compact('testimonials'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add()
    {
       
        return view('admin.testimonials.add_testimonial');
        
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
            $testmonial = new Testimonial();
            $testmonial->title = $data['title'];
            $testmonial->desc = $data['desc'];
            $testmonial->heading1 = $data['heading1'];
            $testmonial->heading2 = $data['heading2'];
            $testmonial->reting = $data['reting'];
            $testmonial->string = $data['string'];
            $testmonial->name = $data['name'];
            if($request->hasFile('image1'))
            {
               $img_temp = $request->file('image1');
               if($img_temp->isValid())
               {
                   $extension = $img_temp->getClientOriginalExtension();
                   $file_name = rand(111,999).".".$extension;
                   $request->image1->move(public_path('uploads/banners'), $file_name);
                //    $img_path = 'uploads/banners/'.$file_name;
                //    Image::make($img_temp)->resize(500,500)->save($img_path);
                   $testmonial->image1 = $file_name;
               }
            }
           
            $testmonial->save();
            return redirect('/testimonial/view')->with('flash_message_success','testmonial added Successfully');
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
        $testimonial = Testimonial::where('id',$id)->first();
        return view('admin.testimonials.edit_testimonial',compact('testimonial'));
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
        if($request->hasFile('image1'))
            {
               $img_temp = $request->file('image1');
               if($img_temp->isValid())
               {
                   $extension = $img_temp->getClientOriginalExtension();
                   $file_name1 = rand(111,999).".".$extension;
                   $request->image1->move(public_path('uploads/banners'), $file_name1);
               }
            }else{
                $file_name1 = $data['current_image1'];
            }
        Testimonial::where('id',$id)->update(['title'=>$data['title'],'name'=>$data['name'],'desc'=>$data['desc'],'image1'=>$file_name1,'heading1'=>$data['heading1'],'heading2'=>$data['heading2']
        ,'string'=>$data['string'],'reting'=>$data['reting']]);
            return redirect('/testimonial/view')->with('flash_message_success','testimonial Updated Successfully!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        Testimonial::where('id',$id)->delete();
        return redirect('/testimonial/view')->with('flash_message_error','testimonial Deleted ');

    }
}

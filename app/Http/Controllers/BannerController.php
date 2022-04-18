<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    public function create()
    {
        return view('admin.banners.add_banner');
    }
    public function store(Request $request)
    {
        if($request->isMethod('post'))
        {
            $data = $request->all();
            $banner = new Banner();
            $banner->title = $data['title'];
            $banner->description = $data['banner_desc'];
            $banner->string1 = $data['string1'];
            $banner->string2 = $data['string2'];
            $banner->string3 = $data['string3'];
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
                   $banner->image1 = $file_name;
               }
            }
           
            $banner->save();
            return redirect('/banner/view')->with('flash_message_success','Banner added Successfully');
        }
    }
    public function view()
    {
        $banners = Banner::all();
        return view('admin.banners.view_banner',compact('banners'));
    }
    public function edit($id)
    {
        $banner = Banner::where('id',$id)->first();
        return view('admin.banners.edit_banner',compact('banner'));
    }
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
        Banner::where('id',$id)->update(['title'=>$data['title'],'description'=>$data['banner_desc'],'image1'=>$file_name1
        ,'string1'=>$data['string1'],'string2'=>$data['string2'],'string3'=>$data['string3']]);
            return redirect('/banner/view')->with('flash_message_success','Banner Updated Successfully!!');
    }
    public function delete($id)
    {
        Banner::where('id',$id)->delete();
        return redirect('/banner/view')->with('flash_message_error','Banner Deleted ');

    }
}

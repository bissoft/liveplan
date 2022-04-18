<?php

namespace App\Http\Controllers;

use App\Models\Step;
use App\Models\Work;
use Illuminate\Http\Request;

class WorkController extends Controller
{
    public function create()
    {
        return view('admin.work.add_work');
    }

    public function store(Request $request)
    {
        if($request->isMethod('post'))
        {
            $data = $request->all();
            $work = new Work();
            $work->title = $data['title'];
            $work->description = $data['work_desc'];
            if($request->hasFile('image'))
            {
               $img_temp = $request->file('image');
               if($img_temp->isValid())
               {
                   $extension = $img_temp->getClientOriginalExtension();
                   $file_name = rand(111,999).".".$extension;
                   $request->image->move(public_path('uploads/banners'), $file_name);
                   $work->image = $file_name;
               }
            }
            $work->save();
            return redirect('work/view/')->with('flash_message_success','Stored Successfully!!');
        }
    }

    public function view()
    {
        $works = Work::all();
        return view('admin.work.view_work',compact('works'));
    }
    public function edit($id)
    {
        $work = Work::where('id',$id)->first();
        return view('admin.work.edit_work',compact('work'));
    }
    public function update(Request $request , $id)
    {
        $data = $request->all();
        if($request->hasFile('image'))
            {
               $img_temp = $request->file('image');
               if($img_temp->isValid())
               {
                   $extension = $img_temp->getClientOriginalExtension();
                   $file_name = rand(111,999).".".$extension;
                   $request->image->move(public_path('uploads/banners'), $file_name);
               }
            }else{
                $file_name = $data['current_image'];
            }
        Work::where('id',$id)->update(['title'=>$data['title'],'description'=>$data['work_desc'],'image'=>$file_name]);
            return redirect('/work/view')->with('flash_message_success','Updated Successfully!!');
    }
    public function delete($id)
    {
        Work::where('id',$id)->delete();
        return redirect('/work/view')->with('flash_message_error','Record Deleted !!');

    }
    public function workSteps($id)
    {
        $work = Work::with('steps')->where('id',$id)->first();
        return view('admin.work.add_steps',compact('work'));
    }
    public function addWorkSteps(Request $request , $id)
    {
        if($request->isMethod('post'))
        {
            $data = $request->all();
            foreach($data['number'] as $key => $val)
            {
                if(!empty($val))
                {
                   $stepCount = Step::where('number',$val)->count();
                    if($stepCount > 0)
                    {
                        return redirect()->back()->with('flash_message_error','Step Number is Already Exist!!');
                    }
                    $step = new Step();
                    $step->work_id = $id;
                    $step->number = $val;
                    $step->title = $data['title'][$key];
                    $step->description = $data['description'][$key];
                    $step->save();
                }

            }
            return redirect('work/steps/'.$id)->with('flash_message_success','Work Steps are Stored Successfully!!');
        }
    }
    public function editSteps(Request $request,$id)
     {
        if($request->isMethod('post'))
        {
           $data =  $request->all();
           foreach($data['attr'] as $key=>$attr)
           {
            Step::where(['id'=>$data['attr'][$key]])->update(['number'=>$data['number'][$key],'title'=>$data['title'][$key],'description'=>$data['description'][$key]]);
            return redirect()->back()->with('flash_message_success','Content points are Updated!!');
           }
        }
     }

     public function deleteStep($id)
     {
        Step::where('id',$id)->delete();
        return redirect()->back()->with('flash_message_error','Step is Deleted!!');
     }
}

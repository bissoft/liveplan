<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServicesController extends Controller
{
    public function create()
    {
        return view('admin.services.add_service');
    }
    public function store(Request $request)
    {
        if($request->isMethod('post'))
        {
            $data = $request->all();
            $service = new Service();
            $service->icon = $data['icon'];
            $service->name = $data['service_name'];
            $service->description = $data['service_desc'];
            $service->save();
            return redirect('/service/view')->with('flash_message_success','Service added Successfully');
        }
    }
    public function view()
    {
        $services = Service::all();
        return view('admin.services.view_service',compact('services'));
    }
    public function edit($id)
    {
        $service = Service::where('id',$id)->first();
        return view('admin.services.edit_service',compact('service'));
    }
    public function update(Request $request , $id)
    {
        $data = $request->all();
        Service::where('id',$id)->update(['icon'=>$data['icon'],'name'=>$data['service_name'],'description'=>$data['service_desc']]);
            return redirect('/service/view')->with('flash_message_success','Banner Updated Successfully!!');
    }
    public function delete($id)
    {
        Service::where('id',$id)->delete();
        return redirect('/service/view')->with('flash_message_error','Service Deleted ');

    }
}

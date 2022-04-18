<?php

namespace App\Http\Controllers\Admin\Xero;

use App\Http\Controllers\Controller;

class XeroController extends Controller
{
    public function index($class){
        $c = $class;
        $class = '\\App\\Xero\\'.$class;
        if(class_exists($class)){
            $instances = $class::paginate(10);
            return view('admin.xero.share',compact('class','instances','c'));
        }
        abort(404);
    }
}

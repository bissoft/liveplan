<?php

namespace App\Http\Controllers\Admin\Webbook;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Gate;

class CustomerController extends Controller
{

    public function customer($id)
    {
        abort_if(Gate::denies('webbook_customer_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            $client = new \GuzzleHttp\Client();
            $request = $client->get(
                "https://api.codat.io/companies/$id/data/customers?page=1&pageSize=100",
                [
                    'headers' => [
                        'Authorization' => ' Basic R2sxdnpwM1JOZXNSRjYwa05Wb2ZIc2hVbGlEcmNSZ2kwVjlzZzNsRA==',
                    ]
                ]
            );
            $company = $id;
            $response = $request->getBody()->getContents();
            $customer = json_decode($response, true);
            return view('admin/webbook/customer.index', compact('customer','company'));
        } catch (\Exception $e) {
            return back()->with('error', 'No Data Found!');
        }
    }
    public function view($company,$id)
    {
        abort_if(Gate::denies('webbook_customer_view'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            $client = new \GuzzleHttp\Client();
            $request = $client->get(
                "https://api.codat.io/companies/$company/data/customers/$id",
                [
                    'headers' => [
                        'Authorization' => ' Basic R2sxdnpwM1JOZXNSRjYwa05Wb2ZIc2hVbGlEcmNSZ2kwVjlzZzNsRA==',
                    ]
                ]
            );
            $response = $request->getBody()->getContents();
            $customer = json_decode($response, true);
            return view('admin/webbook/customer.show', compact('customer', 'company'));
        } catch (\Exception $e) {
            return back()->with('error', 'No Data Found!');
        }
    }

    public function create()
    {
        abort_if(Gate::denies('webbook_customer_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('admin/webbook/customer/create');
    }

    public function store(Request $request)
    {
        //

    }

   


    public function edit($id)
    {
        abort_if(Gate::denies('webbook_customer_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy(Request $request)
    {
        //
    }
}

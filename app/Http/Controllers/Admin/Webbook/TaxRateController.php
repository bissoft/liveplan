<?php

namespace App\Http\Controllers\Admin\Webbook;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TaxRateController extends Controller
{
    public function index($id)
    {
        // abort_if(Gate::denies('webbook_balance_sheet'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        
        try {
            $client = new \GuzzleHttp\Client();
            $data = $client->get(
                "https://api.codat.io/companies/$id/data/taxRates?page=1",
                [
                    'headers' => [
                        'Authorization' => 'Basic R2sxdnpwM1JOZXNSRjYwa05Wb2ZIc2hVbGlEcmNSZ2kwVjlzZzNsRA==',
                    ]
                ]
            );
            $response = $data->getBody()->getContents();
            $taxrate = json_decode($response, true);
            // dd($taxrate);
            return view('admin/webbook/taxrate/index', compact('taxrate', 'id'));
        } catch (\Exception $e) {
            return back()->with('error', 'No Data Found!');
        }
    }
    public function view($company,$id)
    {
        // dd($request->all());
        // abort_if(Gate::denies('webbook_balancesheet_view'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            $client = new \GuzzleHttp\Client();
            $data = $client->get(
                "https://api.codat.io/companies/$company/data/taxRates/$id",
                [
                    'headers' => [
                        'Authorization' => 'Basic R2sxdnpwM1JOZXNSRjYwa05Wb2ZIc2hVbGlEcmNSZ2kwVjlzZzNsRA==',
                    ]
                ]
            );
            $response = $data->getBody()->getContents();
            $taxrate = json_decode($response, true);
            $id = $company;
            // dd($taxrate);
            return view('admin/webbook/taxrate/show', compact('taxrate', 'id'));
        } catch (\Exception $e) {
            return back()->with('error', 'No Data Found!');
        }
    }
}

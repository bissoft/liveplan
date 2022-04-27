<?php

namespace App\Http\Controllers\Admin\Webbook;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BankBalanceController extends Controller
{
    public function index($company,$id)
    {
        // abort_if(Gate::denies('webbook_company_view'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            $client = new \GuzzleHttp\Client();
            $request = $client->get(
                "https://api.codat.io/companies/$company/connections/" . $id,
                [
                    'headers' => [
                        'Authorization' => ' Basic R2sxdnpwM1JOZXNSRjYwa05Wb2ZIc2hVbGlEcmNSZ2kwVjlzZzNsRA==',
                    ]
                ]
            );
            $response = $request->getBody()->getContents();
            $connection = json_decode($response, true);
            return view('admin/webbook/connection.show', compact('connection','company'));
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}

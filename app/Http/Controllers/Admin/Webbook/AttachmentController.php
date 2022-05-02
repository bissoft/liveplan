<?php

namespace App\Http\Controllers\Admin\Webbook;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Gate;

class AttachmentController extends Controller
{
    public function index($company, $id)
    {
        abort_if(Gate::denies('webbook_customer_attachment'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            $client = new \GuzzleHttp\Client();
            $request = $client->get(
                "https://api.codat.io/companies/$company/connections?page=1&pageSize=100",
                [
                    'headers' => [
                        'Authorization' => ' Basic R2sxdnpwM1JOZXNSRjYwa05Wb2ZIc2hVbGlEcmNSZ2kwVjlzZzNsRA==',
                    ]
                ]
            );
            $response = $request->getBody()->getContents();
            $connection = json_decode($response, true);
            $attachment = '';
            return view('admin/webbook/attachment.index', compact('attachment','connection','company', 'id'));
        } catch (\Exception $e) {
            return back()->with('error', 'Data not found');
        }
    }
    public function fetch(Request $request)
    {
        try {
            $company = $request->company_id;
            $id = $request->customer_id;
            $client = new \GuzzleHttp\Client();
            $request = $client->get(
                "https://api.codat.io/companies/$request->company_id/connections/$request->connection/data/customers/$request->customer_id/attachments",
                [
                    'headers' => [
                        'Authorization' => ' Basic R2sxdnpwM1JOZXNSRjYwa05Wb2ZIc2hVbGlEcmNSZ2kwVjlzZzNsRA==',
                    ]
                ]
            );
            $response = $request->getBody()->getContents();
            $attachment = json_decode($response, true);

            $request1 = $client->get(
                "https://api.codat.io/companies/$company/connections?page=1&pageSize=100",
                [
                    'headers' => [
                        'Authorization' => ' Basic R2sxdnpwM1JOZXNSRjYwa05Wb2ZIc2hVbGlEcmNSZ2kwVjlzZzNsRA==',
                    ]
                ]
            );
            $response1 = $request1->getBody()->getContents();
            $connection = json_decode($response1, true);
            return view('admin/webbook/attachment.index', compact('attachment','connection', 'company','id'));
        } catch (\Exception $e) {
            return back()->with('error', 'Data not found!');
        }
    }
}

<?php

namespace App\Http\Controllers\Admin\Webbook;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Gate;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(Gate::denies('webbook_company_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            $client = new \GuzzleHttp\Client();
            $request = $client->get(
                'https://api.codat.io/companies',
                [
                    'headers' => [
                        'Authorization' => ' Basic R2sxdnpwM1JOZXNSRjYwa05Wb2ZIc2hVbGlEcmNSZ2kwVjlzZzNsRA==',
                    ]
                ]
            );
            $response = $request->getBody()->getContents();
            $company = json_decode($response, true);
            return view('admin/webbook/company.index', compact('company'));
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function create()
    {
        abort_if(Gate::denies('webbook_company_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('admin/webbook/company/create');
    }

    public function store(Request $request)
    {
        // dd($request->all());
        try {
            $client = new \GuzzleHttp\Client();
            $request = $client->request(
                'POST',
                'https://api.codat.io/companies',
                [
                    'headers' => [
                        'Authorization' => ' Basic R2sxdnpwM1JOZXNSRjYwa05Wb2ZIc2hVbGlEcmNSZ2kwVjlzZzNsRA=='
                    ],
                    'json' => [
                        'name' => $request->name
                    ]
                ]
            );
            $response = $request->getBody()->getContents();
            return redirect('admin/companies')->with('success', 'Company has created!');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function show($id)
    {
        abort_if(Gate::denies('webbook_company_view'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            $client = new \GuzzleHttp\Client();
            $request = $client->get(
                'https://api.codat.io/companies/' . $id,
                [
                    'headers' => [
                        'Authorization' => ' Basic R2sxdnpwM1JOZXNSRjYwa05Wb2ZIc2hVbGlEcmNSZ2kwVjlzZzNsRA==',
                    ]
                ]
            );
            $response = $request->getBody()->getContents();
            $company = json_decode($response, true);
            return view('admin/webbook/company.show', compact('company'));
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
    public function setting($id)
    {
        abort_if(Gate::denies('webbook_company_setting'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            $client = new \GuzzleHttp\Client();
            $request = $client->get(
                "https://api.codat.io/companies/$id/settings",
                [
                    'headers' => [
                        'Authorization' => ' Basic R2sxdnpwM1JOZXNSRjYwa05Wb2ZIc2hVbGlEcmNSZ2kwVjlzZzNsRA==',
                    ]
                ]
            );
            $response = $request->getBody()->getContents();
            $company = json_decode($response, true);
            return view('admin/webbook/company.setting', compact('company'));
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
    public function update_setting(Request $request, $id)
    {

        try {
            $client = new \GuzzleHttp\Client();
            $request = $client->put(
                "https://api.codat.io/companies/$id/settings",
                [
                    'headers' => [
                        'Authorization' => ' Basic R2sxdnpwM1JOZXNSRjYwa05Wb2ZIc2hVbGlEcmNSZ2kwVjlzZzNsRA==',
                    ],
                    'json' => [
                        'companyId' => $id,
                        'offlineConnectorInstall' =>  $request->status
                    ]
                ]
            );
            $response = $request->getBody()->getContents();
            return redirect('admin/companies')->with('success', 'Company Setting has updated!');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function syncsetting($id)
    {
        // abort_if(Gate::denies('webbook_company_syncsetting'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            $client = new \GuzzleHttp\Client();
            $request = $client->get(
                "https://api.codat.io/companies/$id/settings",
                [
                    'headers' => [
                        'Authorization' => ' Basic R2sxdnpwM1JOZXNSRjYwa05Wb2ZIc2hVbGlEcmNSZ2kwVjlzZzNsRA==',
                    ]
                ]
            );
            $response = $request->getBody()->getContents();
            $company = json_decode($response, true);
            return view('admin/webbook/company.syncsetting', compact('company'));
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
    public function update_syncsetting(Request $request, $id)
    {
        // dd($request->all());

        try {
            $client = new \GuzzleHttp\Client();
            $request = $client->post(
                "https://api.codat.io/companies/$id/syncSettings",
                [
                    'headers' => [
                        'Authorization' => ' Basic R2sxdnpwM1JOZXNSRjYwa05Wb2ZIc2hVbGlEcmNSZ2kwVjlzZzNsRA==',
                    ],
                    'json' => [
                        'companyId' => $id,
                        "settings" => [
                            "dataType" => $request->status
                        ],
                    ]
                ]
            );
            $response = $request->getBody()->getContents();
            return redirect('admin/companies')->with('success', 'Company Sync Setting has updated!');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function edit($id)
    {
        abort_if(Gate::denies('webbook_company_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            $client = new \GuzzleHttp\Client();
            $request = $client->get(
                "https://api.codat.io/companies/$id",
                [
                    'headers' => [
                        'Authorization' => ' Basic R2sxdnpwM1JOZXNSRjYwa05Wb2ZIc2hVbGlEcmNSZ2kwVjlzZzNsRA==',
                    ]
                ]
            );
            $response = $request->getBody()->getContents();
            $company = json_decode($response, true);
            return view('admin/webbook/company.edit', compact('company'));
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }


    public function update(Request $request, $id)
    {
        try {
            $client = new \GuzzleHttp\Client();
            $request = $client->put(
                'https://api.codat.io/companies/' . $id,
                [
                    'headers' => [
                        'Authorization' => ' Basic R2sxdnpwM1JOZXNSRjYwa05Wb2ZIc2hVbGlEcmNSZ2kwVjlzZzNsRA==',
                        'Content-type' => 'application/json'
                    ],
                    'json' => [
                        'name' => $request->name
                    ]
                ]
            );
            $response = $request->getBody()->getContents();
            return redirect('admin/companies')->with('success', 'Company has updated!');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }


    public function destroy($id)
    {
        abort_if(Gate::denies('webbook_company_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            $client = new \GuzzleHttp\Client();
            $request = $client->delete(
                'https://api.codat.io/companies/' . $id,
                [
                    'headers' => [
                        'Authorization' => ' Basic R2sxdnpwM1JOZXNSRjYwa05Wb2ZIc2hVbGlEcmNSZ2kwVjlzZzNsRA==',
                    ]
                ]
            );
            return redirect('admin/companies')->with('success', 'Company has deleted!');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}

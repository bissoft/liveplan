<?php

namespace App\Http\Controllers\Admin\Webbook;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FinancialController extends Controller
{
    public function balancesheet($id)
    {
        // abort_if(Gate::denies('webbook_balance_sheet'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        
        try {
            $client = new \GuzzleHttp\Client();
            $data = $client->get(
                "https://api.codat.io/companies/$id/data/financials/balanceSheet?periodLength=3&periodsToCompare=1&startMonth=2018-02",
                [
                    'headers' => [
                        'Authorization' => 'Basic R2sxdnpwM1JOZXNSRjYwa05Wb2ZIc2hVbGlEcmNSZ2kwVjlzZzNsRA==',
                    ]
                ]
            );
            $response = $data->getBody()->getContents();
            $balancesheet = json_decode($response, true);
            // dd($balancesheet);
            return view('admin/webbook/financial/balancesheet', compact('balancesheet', 'id'));
        } catch (\Exception $e) {
            return back()->with('error', 'No Data Found!');
        }
    }
    public function get_balancesheet(Request $request)
    {
        // dd($request->all());
        // abort_if(Gate::denies('webbook_balancesheet_view'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            $client = new \GuzzleHttp\Client();
            $data = $client->get(
                "https://api.codat.io/companies/$request->id/data/financials/balanceSheet?periodLength=$request->periodLength&periodsToCompare=$request->periodsToCompare&startMonth=$request->startMonth",
                [
                    'headers' => [
                        'Authorization' => 'Basic R2sxdnpwM1JOZXNSRjYwa05Wb2ZIc2hVbGlEcmNSZ2kwVjlzZzNsRA==',
                    ]
                ]
            );
            $response = $data->getBody()->getContents();
            $balancesheet = json_decode($response, true);
            $id = $request->id;
            // dd($balancesheet);
            return view('admin/webbook/financial/balancesheet', compact('balancesheet', 'id'));
        } catch (\Exception $e) {
            return back()->with('error', 'No Data Found!');
        }
    }

    //Profit & Lost
    public function profit_lost($id)
    {
        // abort_if(Gate::denies('webbook_balance_sheet'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        
        try {
            $client = new \GuzzleHttp\Client();
            $data = $client->get(
                "https://api.codat.io/companies/$id/data/financials/profitAndLoss?periodLength=3&periodsToCompare=1&startMonth=2018-02",
                [
                    'headers' => [
                        'Authorization' => 'Basic R2sxdnpwM1JOZXNSRjYwa05Wb2ZIc2hVbGlEcmNSZ2kwVjlzZzNsRA==',
                    ]
                ]
            );
            $response = $data->getBody()->getContents();
            $profit_lost = json_decode($response, true);
            // dd($profit_lost);
            return view('admin/webbook/financial/profit_lost', compact('profit_lost', 'id'));
        } catch (\Exception $e) {
            return back()->with('error', 'No Data Found!');
        }
    }
    public function get_profit_lost(Request $request)
    {
        // dd($request->all());
        // abort_if(Gate::denies('webbook_balancesheet_view'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        try {
            $client = new \GuzzleHttp\Client();
            $data = $client->get(
                "https://api.codat.io/companies/$request->id/data/financials/profitAndLoss?periodLength=$request->periodLength&periodsToCompare=$request->periodsToCompare&startMonth=$request->startMonth",
                [
                    'headers' => [
                        'Authorization' => 'Basic R2sxdnpwM1JOZXNSRjYwa05Wb2ZIc2hVbGlEcmNSZ2kwVjlzZzNsRA==',
                    ]
                ]
            );
            $response = $data->getBody()->getContents();
            $profit_lost = json_decode($response, true);
            $id = $request->id;
            // dd($profit_lost);
            return view('admin/webbook/financial/profit_lost', compact('profit_lost', 'id'));
        } catch (\Exception $e) {
            return back()->with('error', 'No Data Found!');
        }
    }

        //Cash Flow
        public function cashflow($id)
        {
            // abort_if(Gate::denies('webbook_balance_sheet'), Response::HTTP_FORBIDDEN, '403 Forbidden');
            
            try {
                $client = new \GuzzleHttp\Client();
                $data = $client->get(
                    "https://api.codat.io/companies/$id/data/financials/cashFlowStatement?periodLength=3&periodsToCompare=1&startMonth=2018-02",
                    [
                        'headers' => [
                            'Authorization' => 'Basic R2sxdnpwM1JOZXNSRjYwa05Wb2ZIc2hVbGlEcmNSZ2kwVjlzZzNsRA==',
                        ]
                    ]
                );
                $response = $data->getBody()->getContents();
                $cashflow = json_decode($response, true);
                dd($cashflow);
                return view('admin/webbook/financial/cashflow', compact('cashflow', 'id'));
            } catch (\Exception $e) {
                return back()->with('error', 'No Data Found!');
            }
        }
        public function get_cashflow(Request $request)
        {
            // dd($request->all());
            // abort_if(Gate::denies('webbook_balancesheet_view'), Response::HTTP_FORBIDDEN, '403 Forbidden');
            try {
                $client = new \GuzzleHttp\Client();
                $data = $client->get(
                    "https://api.codat.io/companies/$request->id/data/financials/cashFlowStatement?periodLength=$request->periodLength&periodsToCompare=$request->periodsToCompare&startMonth=$request->startMonth",
                    [
                        'headers' => [
                            'Authorization' => 'Basic R2sxdnpwM1JOZXNSRjYwa05Wb2ZIc2hVbGlEcmNSZ2kwVjlzZzNsRA==',
                        ]
                    ]
                );
                $response = $data->getBody()->getContents();
                $cashflow = json_decode($response, true);
                $id = $request->id;
                dd($cashflow);
                return view('admin/webbook/financial/cashflow', compact('cashflow', 'id'));
            } catch (\Exception $e) {
                return back()->with('error', 'No Data Found!');
            }
        }
}

<?php

namespace App\Http\Controllers\Admin\Webbook;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WebBookController extends Controller
{
    public function companies(){
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
        $result = json_decode($response,true);
        dd($result['results']);
    }
}

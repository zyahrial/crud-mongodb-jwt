<?php
 
namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Queue;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Facades\Log;
use Redirect,Response;
use Illuminate\Http\Request;

use Laravel\Lumen\Routing\Controller as BaseController;

class ReqresController extends BaseController 
{

public function register(Request $request)
{
        $this->email = $request->get('email');
        $this->password = $request->get('password');

        $data = [
            'email' => $this->email,
            'password' => $this->password,
        ];
            try
            {                  
        // for productions https://leadservice.heroleads.co.th/PbxCallService?token=thioch4eimovoiDu6ahd
                    $client = new Client(
                        [
                            'base_uri' => 'https://reqres.in/',
                            'timeout'  => 10,
                            'headers' => [
                                "Content-Type" => 'application/json'
                            ]
                        ]
                    );

                $json_response =  $client->request('POST','api/register',['json' => $data]);
                Log::info(json_encode($json_response->getBody()));
    return response()->json([
    "status" => true,
    "data" => empty($data) ? "" : $data,
            ], 201);
            } catch (\Exception $ex) {
                Log::critical($ex);
    return response()->json([
    "status" => false,
            ], 401);
            }
    }

    public function login(Request $request)
{
        $this->email = $request->get('email');
        $this->password = $request->get('password');

        $data = [
            'email' => $this->email,
            'password' => $this->password,
        ];
            try
            {                  
        // for productions https://leadservice.heroleads.co.th/PbxCallService?token=thioch4eimovoiDu6ahd
                    $client = new Client(
                        [
                            'base_uri' => 'https://reqres.in/',
                            'timeout'  => 10,
                            'headers' => [
                                "Content-Type" => 'application/json'
                            ]
                        ]
                    );

                $json_response =  $client->request('POST','api/login',['json' => $data]);
                Log::info(json_encode($json_response->getBody()));
    return response()->json([
    "status" => true,
    "data" => empty($data) ? "" : $data,
            ], 201);
            } catch (\Exception $ex) {
                Log::critical($ex);
    return response()->json([
    "status" => false,
            ], 401);
            }
    }
}
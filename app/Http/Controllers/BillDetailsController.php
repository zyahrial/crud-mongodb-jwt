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

class BillDetailsController extends BaseController 
{

        public function index(Request $request)
        {

        $this->data = (__DIR__.'\data.json');    
        $json = json_decode(file_get_contents($this->data), true); 
        // return array_values(array_values(json_decode($this->data, true))[1])[0];

            $billdetails = $json['data']['response']['billdetails'];
            foreach($billdetails as $key => $value) {
                $this->body = ($value['body']); 
                $value = (array)$this->body;
                $value = str_replace("DENOM","",$value);
                $value = str_replace(":","",$value);
                $value = str_replace(" ","",$value);
                $numArray = array_map('intval', $value);
     
                $data = array_filter($numArray, function($el)
                {
                    return ($el >= 100000);
                });
                print_r($data);
            }
        }
}
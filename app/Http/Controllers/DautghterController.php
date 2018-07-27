<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Ixudra\Curl\Facades\Curl;

class DautghterController extends Controller
{
    public function RecordData()
    {
        $ch = curl_init();
        $vars = [


            "title" => "Москва3",
            "content" => "Address: блабла<p>123</p>"

        ];
        $vars = json_encode($vars);
       $response = Curl::to('http://wordpress.v22018066425368087.megasrv.de/wp-json/wp/v2/posts/16')
            ->withData( $vars )
            ->withHeaders( array (
                'Content-Type:application/json',
                'Authorization: Basic '. base64_encode("admin:wordpress_admin1") // <---
            ))
            ->put();
        dump(json_decode($response));
        /*$response = Curl::to('http://wordpress.v22018066425368087.megasrv.de/wp-json/acf/v3/posts/16/')
            ->withData( $vars )
            ->withHeaders( array (
                'Content-Type:application/json',
                'Authorization: Basic '. base64_encode( "admin:wordpress_admin1" ) // <---
            ))
            ->post();
        dump(json_decode($response));*/
     //   $this->ch_acf($final_array->id);

    }

    public function ch_acf($id)
    {
        $ch = curl_init();
        $vars = [

        "fields[address]" => "true"

        ];
        curl_setopt($ch, CURLOPT_URL, "http://wordpress.v22018066425368087.megasrv.de/wp-json/acf/v3/posts/" . $id);
        curl_setopt($ch, CURLOPT_PUT, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $vars);  //Post Fields
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($ch, CURLOPT_USERPWD, "admin:wordpress_admin1");

        $server_output = curl_exec($ch);

        curl_close($ch);
        $final_array = json_decode($server_output);
        dump($server_output);
        dump($final_array);
    }
}

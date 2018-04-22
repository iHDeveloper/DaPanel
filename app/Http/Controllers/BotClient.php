<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class BotClient extends Controller
{
    
    public static function get($link){
        $client = new Client([
            'base_uri' => 'http://localhost:2040',
        ]);
        $response = $client->request('GET', $link);
        $stream = $response->getBody();
        $res = json_decode($stream->getContents(), true);
        foreach ($res as $key => $value) {
            if($res[$key] == "true") $res[$key] = true;
            else if($res[$key] == "false") $res[$key] = false;
        }
        return $res;
    }

}

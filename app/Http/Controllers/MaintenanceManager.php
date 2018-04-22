<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MaintenanceManager extends Controller
{
    
    public static function check($authToken){
        try{
            $res = BotClient::get('/panel/login/' . $authToken['panel_id'] . '/' . $authToken->clientid);
            return $res;
        } catch (\Exception $ex){
            return null;
        }
    }

}

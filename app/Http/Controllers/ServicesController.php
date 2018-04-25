<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ServicesController extends Controller
{
    
    public function nickname(Request $req, $id){
        $token = session(Settings::discord_session());
        $authProfile = TokenManager::auth($req, $token, $id);
        if ($authProfile == null){
            $res = ResponseManager::build(202);
            return response()->json($res);
        }
        $maintenance = MaintenanceManager::check($authProfile);
        if($maintenance['whitelist'] == true){
            $res = ResponseManager::build(201);
            return response()->json($res);
        }
        $nickname = $req->input('nickname');
        if($nickname == null){
            return response()->json(ResponseManager::build(203));
        }
        $nicknameData = BotClient::get('/method/nickname/' . $id . '/' . $authProfile->clientid . '/' . $nickname);
        $code = $nicknameData['code'];
        switch ($code) {
            case 2:
                return response()->json(ResponseManager::build(302));
                break;
            case 1:
                return response()->json(ResponseManager::build(301));
            default:
                return response()->json(ResponseManager::build(300));
                break;
        }
    }

}

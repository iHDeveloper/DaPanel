<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ClientOAuth as AuthProfile;

class TokenManager extends Controller
{
    
    public static function auth(Request $req, $token, $id){
        if($token == null) return null;
        $where = AuthProfile::find($token);
        if($where == null) return null;
        if($where->count() <= 0) return null;
        $profile = $where->get()[0];
        if($id != $profile['panel_id']) return null;
        if($profile["client_id"] == -1) return null;
        if($profile["ip"] != $req->ip()) return null;
        $profile->save();
        $profile["clientid"] = $profile["client_id"];
        return $profile;
    }

}

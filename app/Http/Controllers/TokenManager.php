<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ClientOAuth as AuthProfile;

class TokenManager extends Controller
{
    
    public static function auth(Request $req, $token, $id){
        if($token == null) return null;
        $where = AuthProfile::where('token', $token);
        if($where->count() <= 0) return null;
        $profile = $where->get()[0];
        $clientip = $req->ip();
        if($clientip != $profile->ip) return null;
        if($id != $profile['panel_id']) return null;
        if($profile->clientid == -1) return null;
        $profile->save();
        return $profile;
    }

}

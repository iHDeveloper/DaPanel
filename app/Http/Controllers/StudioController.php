<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StudioController extends Controller
{
    
    public function home(){
        return view('studio.home');
    }

    public function editor(){
        return view('studio.editor');
    }

    public function login(Request $req, $id){
        $token = session(Settings::discord_session());
        if ($token == null){
            return redirect()->route('panel.find', ["id"=>$id,"type"=>"studio"]);
        }
        $authProfile = TokenManager::auth($req, $token, $id);
        if($authProfile == null){
            return redirect()->route('panel.find', ["id"=>$id,"type"=>"studio"]);
        }
        return redirect()->route('studio.home');
    }

}

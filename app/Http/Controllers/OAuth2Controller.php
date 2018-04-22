<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Discord\OAuth\Discord as Provider;
use Webpatser\Uuid\Uuid;
use App\ClientOAuth;
use GuzzleHttp\Client;

class OAuth2Controller extends Controller
{
    
    public function discord(Request $req){
        $code = $req->input('code');
        $state = $req->input('state');
        $id = $req->input('id');
        if($id == null && ($state == null || $code == null)){
            return view('error.panel')->with([
                "code" => 404,
                "title" => "Panel ID not found",
                "message" => "The given id in the url is not correct"
            ]);
        }
        $provider = new Provider([
            'clientId' => Settings::discord_client_id(),
            'clientSecret' => Settings::discord_client_secret(),
            'redirectUri'  => Settings::discord_redirect_url(),
        ]);
        if ($code == null && $state == null){
            $state = Uuid::generate();
            $url = $provider->getAuthorizationUrl() . '&state=' . $state;
            $clientoauth = new ClientOAuth;
            $clientoauth->state = $state;
            $clientoauth->ip = request()->ip();
            $clientoauth->clientid = "-1";
            $clientoauth->token = Uuid::generate();
            $clientoauth['panel_id'] = $id;
            $clientoauth->save();
            return redirect()->to($url);
        }
        if($state == null){
            return view('error.panel')->with([
                "code" => 203,
                "title" => "OAuth2 Error",
                "message" => "Something went wrong in the state in the oauth2"
            ]);
        }
        $clientoauth = null;
        $clientToken = null;
        if(strpos($state, ',')){
            $realstate = explode(',', $state);
            $realstate = $realstate[1];
            $clientoauth = ClientOAuth::where('state', $realstate);
            if($clientoauth->count() <= 0){
                return view('error.panel')->with([
                    "code" => 203,
                    "title" => "OAuth2 Error",
                    "message" => "Something went wrong in the state in the oauth2"
                ]);
            }
            $clientoauth = $clientoauth->get()[0];
            $clientToken = $clientoauth->token; 
        } else {
            return view('error.panel')->with([
                "code" => 203,
                "title" => "OAuth2 Error",
                "message" => "Something went wrong in the state in the oauth2"
            ]);
        }
        $token = $provider->getAccessToken('authorization_code', [
            'code' => $code,
        ]);
        $user = $provider->getResourceOwner($token);
        $clientoauth->clientid = $user->id;
        $req = new Client([
            'base_uri' => "http://localhost:2040",
        ]);
        if($id == null) $id = $clientoauth['panel_id'];
        $res = $req->request("GET", '/check/client/'. $id . '/' . $user->id);
        $stream = $res->getBody();
        $response = json_decode($stream->getContents(), true);
        $panel = ($response['panel'] == "true" ? true : false);
        $client = ($response['client'] == "true" ? true : false);
        if($panel){
            if ($client){
                session(['DISCORD_AUTH_PROFILE_TOKEN' => $clientToken]);
                $clientoauth->save();
                return redirect(route('panel.login', ["id" => $id]));
            } else {
                $clientoauth->destroy();
                return view('error.panel')->with([
                    "code" => 404,
                    "title" => "Client Not found",
                    "message" => "We can't find you and access to you because you aren't in the server!"
                ]);
            }
        } else {
            $clientoauth->destroy();
            return view('error.panel')->with([
                "code" => 404,
                "title" => "Panel not found",
                "message" => "we didn't found the panel successfully"
            ]);
        }
    }

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\ClientOAuth;
use Session;

class PanelController extends Controller
{
    
    public function panel(Request $req, $id){
        $res = BotClient::get('/check/panel/' . $id);
        if($res == array()){
            return response()->json(["status"=>201,"message"=>"not found the panel!"]);
        }
        
        $found = $res['found'];
        if($found == true){
            $token = session(Settings::discord_session());
            if($token != null){
                $authProfile = TokenManager::auth($req, $token, $id);
                if($authProfile != null){
                    return redirect(route('panel.login', ['id'=>$id]) . '/?token=' . $token);
                }
            }
            return redirect(route("oauth2.discord") . '/?id=' . $id);
        } else {
            return view('error.panel')->with([
                "code" => 404,
                "title" => "Panel not found",
                "message" => "The panel not found by the given id"
            ]);
        }
    }

    public function login(Request $req, $id){
        $token = session(Settings::discord_session());
        if ($token == null){
            $token = $req->input('token');
            if($token == null){
                return redirect()->route('panel.find', ["id"=>$id]);
            }
        }
        $authProfile = TokenManager::auth($req, $token, $id);
        if($authProfile == null){
            return redirect()->route('panel.find', ["id"=>$id]);
        }
        $client = new Client([
            'base_uri' => 'http://localhost:2040',
        ]);
        $res = BotClient::get("/panel/login/" . $id . "/" . $authProfile->clientid);
        $whitelist = $res['whitelist'];
        $reason = $res['reason'];
        if($whitelist == true){
            return view('error.panel')->with([
                "code" => 201,
                "title" => "Whitelist",
                "message" => $reason
            ]);
        }
        return redirect(route("panel.open", ["id"=>$id]) . '/?token=' . $token);
    }

    public function open(Request $req, $id){
        $token = session(Settings::discord_session());
        if ($token == null){
            $token = $req->input('token');
            if($token == null){
                return redirect()->route('panel.find', ["id"=>$id]);
            }
        }
        $authProfile = TokenManager::auth($req, $token, $id);
        if($authProfile == null){
            return redirect()->route('panel.find', ["id"=>$id]);
        }
        try {
            $response = BotClient::get('/panel/open/' . $id . '/' . $authProfile->clientid);
            $type = $response["type"];
            $value = $response["route"];
            $route = "panel.page";
            if($type == "route"){
                $route = "panel.route";
            }
            return redirect(route($route, ["id"=>$id,($type)=>$value]) . '/?token=' . $token);
        } catch (\Exception $ex){
            return view('error.panel')->with([
                "code" => 500,
                "title" => "Open Error",
                "message" => "Something went wrong while opening the panel. Try again please."
            ]);
        }
    }

    public function page(Request $req, $id, $page){
        $token = session(Settings::discord_session());
        if ($token == null){
            $token = $req->input('token');
            if($token == null) {
                return redirect()->route('panel.find', ["id"=>$id]);
            }
        }
        $authProfile = TokenManager::auth($req, $token, $id);
        if($authProfile == null){
            return redirect()->route('panel.find', ["id"=>$id]);
        }
        $maintenance = MaintenanceManager::check($authProfile);
        if($maintenance['whitelist'] == true){
            return view('error.panel')->with([
                "code" => 201,
                "title" => "Whitelist",
                "message" => $maintenance['reason'],
            ]);
        }
        try {
            $pageData = BotClient::get('/panel/output/' . $id . '/' . $authProfile->clientid . '/page/' . $page);
            if($pageData == array()){
                return view('error.panel')->with([
                    "code" => 404,
                    "title" => "Route Not found",
                    "message" => "Not found the route of the server",
                ]);
            }
            $branch = $pageData['branch'];
            $config = $pageData['config'];
            $layout = $pageData['layout'];
            $page = $pageData['page'];
            $info = BotClient::get('/panel/info/' . $id . '/' . $authProfile->clientid);
            $placeholders = [
                "server.id" => $id,
                "server.name" => $config['name'],
                "client.id" => $authProfile->clientid,
                "client.name" => $info['nickname'],
                "clients" => $info['clients'],
            ];
            return view('panel.' . $layout['name'])->with([
                "branch" => $branch,
                "config" => $config,
                "layout" => $layout,
                "placeholders" => $placeholders,
                "page" => $page,
                "token" => $token,
                "server_id" => $id,
            ]);    
        } catch(\Exception $ex){
            return view('error.panel')->with([
                "code" => 501,
                "title" => "Page Error",
                "message" => "Something went wrong while building the page. Try again please."
            ]);
        }
    }

    public function route(Request $req, $id, $route){
        $token = session(Settings::discord_session());
        if ($token == null){
            $token = $req->input('token');
            if($token == null){
                return redirect()->route('panel.find', ["id"=>$id]);
            }
        }
        $authProfile = TokenManager::auth($req, $token, $id);
        if($authProfile == null){
            return redirect()->route('panel.find', ["id"=>$id]);
        }
        $maintenance = MaintenanceManager::check($authProfile);
        if($maintenance['whitelist'] == true){
            return view('error.panel')->with([
                "code" => 201,
                "title" => "Whitelist",
                "message" => $maintenance['reason'],
            ]);
        }
        try {
            $pageData = BotClient::get('/panel/output/' . $id . '/' . $authProfile->clientid . '/route/' . $route);
            if($pageData == array()){
                return view('error.panel')->with([
                    "code" => 404,
                    "title" => "Route Not found",
                    "message" => "Not found the route of the server",
                ]);
            }
            $branch = "master";
            $branch = $pageData['branch'];
            $config = $pageData['config'];
            $layout = $pageData['layout'];
            $page = $pageData['page'];
            $info = BotClient::get('/panel/info/' . $id . '/' . $authProfile->clientid);
            $placeholders = [
                "server.id" => $id,
                "server.name" => $config['name'],
                "client.id" => $authProfile->clientid,
                "client.name" => $info['nickname'],
                "clients" => $info['clients'],
            ];
            return view('panel.' . $layout['name'])->with([
                "branch" => $branch,
                "config" => $config,
                "layout" => $layout,
                "placeholders" => $placeholders,
                "page" => $page,
                "token" => $token,
                "server_id" => $id,
            ]);  
        } catch(\Exception $ex){
            return view('error.panel')->with([
                "code" => 501,
                "title" => "Page Error",
                "message" => "Something went wrong while building the page. Try again please."
            ]);
        }
    }

}

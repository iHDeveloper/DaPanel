<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Settings extends Controller
{
    public static function discord_client_id(){
        return "398399718851346432";
    }

    public static function discord_client_secret(){
        return "8i8gZh2HvVGwzWyZf-r5Skd5nX4aWixW";
    }

    public static function discord_redirect_url(){
        return "http://dapanel.tk/oauth2/discord";
    }

    public static function discord_session(){
        return 'DISCORD_AUTH_PROFILE_TOKEN';
    }
}

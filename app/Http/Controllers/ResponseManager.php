<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ResponseManager extends Controller
{
    
    public static function build($code){
        return array('code'=>$code);
    }

}

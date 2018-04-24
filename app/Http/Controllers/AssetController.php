<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AssetController extends Controller
{
    public function callback(Request $req, $asset){
        if($asset == null) return ResponseManager::build(405);
        return asset($asset);
    }
}

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

}

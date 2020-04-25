<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class FrontendController extends Controller
{
    public function __construct()
    {
        
    }
    

    public function index($page = 'home')
    {
        if($page == "home") {
            return view('template.home');
        }
        if($page == "lotto") {
            return view('template.lotto');
        }
        if($page == "betrate") {
            return view('template.betrate');
        }
        if($page == "promotion") {
            return view('template.promotion');
        }
        if($page == "recommend") {
            return view('template.recommend');
        }
        
    }
    

}

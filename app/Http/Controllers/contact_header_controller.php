<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//import class Session
use Illuminate\Support\Facades\Session;

//return type View
use Illuminate\View\View;

class contact_header_controller extends Controller
{
    public function contact_header_content()
    {

        return view('contact_header_page');

    }
}

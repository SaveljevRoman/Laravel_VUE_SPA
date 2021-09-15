<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SpaController extends BaseController
{
    public function index()
    {
        return view('index');
    }
}

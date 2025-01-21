<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

class ThemeController extends Controller
{
    public function index()
    {
        $themes = DB::table('themes')->get();
    }
}

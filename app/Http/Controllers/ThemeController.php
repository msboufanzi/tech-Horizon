<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Models\Theme;

class ThemeController extends Controller
{
    public function index()
    {
        // Fetch all themes from the database
        $themes = Theme::all();

        // Pass the themes to the themes view
        return view('themes', compact('themes'));
    }
}

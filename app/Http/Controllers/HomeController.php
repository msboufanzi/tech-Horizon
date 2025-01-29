<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Theme;
use App\Models\Article; 

class HomeController extends Controller
{
    public function index()
    {
        $themes = Theme::take(3)->get();

        $articles = Article::with(['author', 'theme'])
            ->where('ispublic', true)
            ->take(3)
            ->get();

        return view('home', compact('themes', 'articles'));
    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Theme; // Import the Theme model
use App\Models\Article; // Import the Article model

class HomeController extends Controller
{
    public function index()
    {
        // Fetch the first 3 themes from the database
        $themes = Theme::take(3)->get();

        // Fetch the first 3 public articles with their author and theme information
        $articles = Article::with(['author', 'theme'])
            ->where('ispublic', true)
            ->take(3)
            ->get();

        // Pass both themes and articles to the home view
        return view('home', compact('themes', 'articles'));
    }
}
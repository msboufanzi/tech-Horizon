<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Theme;

class ArticlesController extends Controller
{
    public function index()
    {
        // Fetch all themes from the database
        $themes = Theme::all();

        // Pass the themes to the articles view
        return view('articles', compact('themes'));
    }

    public function showByTheme($themeId)
    {
        // Fetch articles for the selected theme
        $articles = Article::where('theme_id', $themeId)->get();

        // Fetch all themes for the navbar
        $themes = Theme::all();

        // Fetch the 10 most recent public articles for the aside section
        $publicArticles = Article::where('ispublic', true)
            ->with(['author', 'theme']) // Eager load author and theme relationships
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();

        // Pass the articles, themes, and public articles to the view
        return view('articles', compact('articles', 'themes', 'publicArticles'));
    }
}
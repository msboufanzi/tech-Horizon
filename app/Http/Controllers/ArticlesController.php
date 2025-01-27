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

        // Fetch the 10 most recent public articles for the aside section
        $publicArticles = Article::where('ispublic', true)
            ->with(['author', 'theme']) // Eager load author and theme relationships
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();

        // Fetch all articles (or adjust the query as needed)
        $articles = Article::with(['author', 'theme'])->get();

        // Pass the articles, themes, and public articles to the view
        return view('articles', compact('articles', 'themes', 'publicArticles'));
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

    public function show($id)
    {
        // Fetch the article by ID
        $article = Article::with(['author', 'theme'])->findOrFail($id);

        // Fetch all themes for the navbar
        $themes = Theme::all();

        // Fetch the 10 most recent public articles for the aside section
        $publicArticles = Article::where('ispublic', true)
            ->with(['author', 'theme'])
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();

        // Pass the article, themes, and public articles to the view
        return view('article_details', compact('article', 'themes', 'publicArticles'));
    }
}
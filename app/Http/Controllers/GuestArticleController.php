<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;

class GuestArticleController extends Controller
{
    public function show($article_id)
    {
        $article = Article::with(['author', 'theme'])->findOrFail($article_id);

        $publicArticles = Article::where('ispublic', true)
            ->where('id', '!=', $article_id) 
            ->take(6) 
            ->get();

        return view('guest_article_details', compact('article', 'publicArticles'));
    }
}
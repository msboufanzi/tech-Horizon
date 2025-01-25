<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;

class GuestArticleController extends Controller
{
    public function show($article_id)
    {
        // Fetch the article details
        $article = Article::with('author')->findOrFail($article_id);

        // Fetch related public articles (excluding the current article)
        $publicArticles = Article::where('ispublic', true)
            ->where('id', '!=', $article_id) // Exclude the current article
            ->take(6) // Limit to 6 articles
            ->get();

        // Pass the data to the view
        return view('guest_article_details', compact('article', 'publicArticles'));
    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;

class PublicArticleController extends Controller
{
    public function index()
    {
        // Fetch all public articles with their author information
        $articles = Article::with('author')
            ->where('ispublic', true)
            ->get();

        // Pass the articles to the public_articles view
        return view('public_articles', compact('articles'));
    }
}
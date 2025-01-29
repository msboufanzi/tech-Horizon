<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;

class PublicArticleController extends Controller
{
    public function index()
    {
        $articles = Article::with(['author', 'theme'])
            ->where('ispublic', true)
            ->get();

        return view('public_articles', compact('articles'));
    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Theme;
use App\Models\Comment;
use App\Models\Rating;
use Illuminate\Support\Facades\Auth;

class ArticlesController extends Controller
{
    public function index()
    {
        // Fetch all themes from the database
        $themes = Theme::all();

        // Fetch the 10 most recent articles for the aside section
        $recentArticles = Article::with(['author', 'theme']) // Eager load author and theme relationships
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();

        // Fetch all articles
        $articles = Article::with(['author', 'theme'])->get();

        // Pass the articles, themes, and recent articles to the view
        return view('articles', compact('articles', 'themes', 'recentArticles'));
    }

    public function showByTheme($themeId)
    {
        // Fetch articles for the selected theme
        $articles = Article::where('theme_id', $themeId)->get();

        // Fetch all themes for the navbar
        $themes = Theme::all();

        // Fetch the 10 most recent articles for the aside section
        $recentArticles = Article::with(['author', 'theme'])
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();

        // Pass the articles, themes, and recent articles to the view
        return view('articles', compact('articles', 'themes', 'recentArticles'));
    }

    public function show($id)
    {
        // Fetch the article by ID and eager load comments, ratings, and users
        $article = Article::with([
            'author',
            'theme',
            'comments' => function ($query) {
                $query->with(['user', 'ratings']);
            }
        ])->findOrFail($id);

        // Fetch all themes for the navbar
        $themes = Theme::all();

        // Fetch the 10 most recent articles for the aside section
        $recentArticles = Article::with(['author', 'theme'])
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();

        // Pass the article, themes, and recent articles to the view
        return view('article_details', compact('article', 'themes', 'recentArticles'));
    }

    // New method to handle role-based redirection
    public function redirectToDashboard()
    {
        $user = Auth::user();

        switch ($user->role) {
            case 'subscriber':
                return redirect()->route('subscriber_dashboard');
            case 'manager':
                return redirect()->route('theme_manager_dashboard');
            case 'editor':
                return redirect()->route('editor_dashboard');
            default:
                // Handle unknown roles or default case
                return redirect()->route('home')->with('error', 'Unknown user role.');
        }
    }

    public function storeComment(Request $request, $articleId)
    {
        // Validate the request
        $request->validate([
            'comment' => 'required|string',
            'rating' => 'nullable|integer|between:1,5', 
        ]);

        // Get the authenticated user
        $user = Auth::user();

        // Create the comment
        $comment = Comment::create([
            'text' => $request->input('comment'),
            'user_id' => $user->id,
            'article_id' => $articleId,
        ]);

        // Create the rating only if it is provided
        if ($request->has('rating') && $request->input('rating') !== null) {
            Rating::create([
                'rating' => $request->input('rating'),
                'user_id' => $user->id,
                'article_id' => $articleId,
                'comment_id' => $comment->id,
            ]);
        }

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Comment submitted successfully!');
    }
}
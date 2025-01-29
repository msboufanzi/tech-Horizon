<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Theme;
use App\Models\Comment;
use App\Models\Rating;
use App\Models\History;
use Illuminate\Support\Facades\Auth;

class ArticlesController extends Controller
{
    public function index()
    {
        $themes = Theme::all();
        $recentArticles = Article::with(['author', 'theme'])
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();
        $articles = Article::with(['author', 'theme'])->get();

        return view('articles', compact('articles', 'themes', 'recentArticles'));
    }

    public function showByTheme($themeId)
    {
        $articles = Article::where('theme_id', $themeId)->get();
        $themes = Theme::all();
        $recentArticles = Article::with(['author', 'theme'])
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();

        return view('articles', compact('articles', 'themes', 'recentArticles'));
    }

    public function show($id)
    {
        $article = Article::with([
            'author',
            'theme',
            'comments' => function ($query) {
                $query->with(['user', 'ratings']);
            }
        ])->findOrFail($id);
        $themes = Theme::all();
        $recentArticles = Article::with(['author', 'theme'])
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();

        if (Auth::check()) {
            $userId = Auth::id();
            $existingHistory = History::where('user_id', $userId)
                ->where('article_id', $id)
                ->first();

            if (!$existingHistory) {
                History::create([
                    'user_id' => $userId,
                    'article_id' => $id,
                ]);
            }
        }

        return view('article_details', compact('article', 'themes', 'recentArticles'));
    }


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

                return redirect()->route('home')->with('error', 'Unknown user role.');
        }
    }

    public function storeComment(Request $request, $articleId)
    {

        $request->validate([
            'comment' => 'required|string',
            'rating' => 'nullable|integer|between:1,5',
        ]);


        $user = Auth::user();


        $comment = Comment::create([
            'text' => $request->input('comment'),
            'user_id' => $user->id,
            'article_id' => $articleId,
        ]);


        if ($request->has('rating') && $request->input('rating') !== null) {
            Rating::create([
                'rating' => $request->input('rating'),
                'user_id' => $user->id,
                'article_id' => $articleId,
                'comment_id' => $comment->id,
            ]);
        }


        return redirect()->back()->with('success', 'Comment submitted successfully!');
    }
}
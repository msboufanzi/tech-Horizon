<?php

namespace App\Http\Controllers;

use App\Models\Theme;
use App\Models\Following;
use App\Models\History;
use App\Models\Comment;
use App\Models\ProposedArticle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubscriberController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        $themes = Theme::all();
        $subscriptions = Following::with('theme')
            ->where('user_id', $user->id)
            ->get();
            
        $history = History::with(['article', 'article.theme'])
            ->where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();
            
        $proposedArticles = ProposedArticle::with('theme')
            ->where('author_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();
            
        $comments = Comment::with('article')
            ->where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('subscriber_dashboard', compact(
            'user',
            'themes',
            'subscriptions',
            'history',
            'proposedArticles',
            'comments'
        ));
    }

    public function unfollow(Request $request)
    {
        Following::where('user_id', Auth::id())
            ->where('theme_id', $request->theme_id)
            ->delete();
        
        return redirect()->back()->with('success', 'Theme unfollowed successfully');
    }

    public function deleteHistory(Request $request)
    {
        History::where('user_id', Auth::id())
            ->where('article_id', $request->article_id)
            ->delete();
            
        return redirect()->back()->with('success', 'History deleted successfully');
    }

    public function proposeArticle(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'theme_id' => 'required|exists:themes,id',
            'content' => 'required|string',
            'image' => 'required|url',
            'description' => 'required|string'
        ]);

        $validated['author_id'] = Auth::id();
        $validated['position'] = 1; // waiting status

        ProposedArticle::create($validated);

        return redirect()->back()->with('success', 'Article proposed successfully');
    }

    public function deleteComment(Request $request)
    {
        Comment::where('id', $request->comment_id)
            ->where('user_id', Auth::id())
            ->delete();
            
        return redirect()->back()->with('success', 'Comment deleted successfully');
    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\User;
use App\Models\Theme;
use App\Models\Comment;
use App\Models\Rating;
use App\Models\Magazine; // Add this line

class EditorController extends Controller
{
    public function index()
    {
        $existingArticles = Article::with(['author', 'theme'])
            ->orderBy('title')
            ->paginate(7, ['*'], 'existing_page');
        $pendingArticles = Article::with(['author', 'theme'])
            ->where('ispublic', false)
            ->paginate(7, ['*'], 'pending_page');
        $users = User::paginate(7, ['*'], 'users_page');
        $subscribers = User::where('role', 'subscriber')->get();
        $statistics = [
            'total_subscribers' => User::where('role', 'subscriber')->count(),
            'published_articles' => Article::where('ispublic', true)->count(),
            'active_themes' => Theme::count(),
            'total_activities' => Comment::count() + Rating::count(),
        ];
        $magazines = Magazine::all(); // Add this line
        return view('editor_dashboard', compact('existingArticles', 'pendingArticles', 'users', 'statistics', 'subscribers', 'magazines')); // Add 'magazines' to the compact function
    }
    
    public function toggleVisibility(Request $request, Article $article)
    {
        $article->ispublic = !$article->ispublic;
        $article->save();
        return response()->json(['success' => true, 'ispublic' => $article->ispublic]);
    }

    public function updateUser(Request $request, User $user)
    {
        $user->update($request->only(['name', 'email']));
        return response()->json(['success' => true, 'user' => $user]);
    }

    public function updateRole(Request $request, User $user)
    {
        $user->role = $request->role;
        $user->save();
        return response()->json(['success' => true, 'user' => $user]);
    }

    public function blockUser(User $user)
    {
        $user->delete();
        return response()->json(['success' => true]);
    }

    public function addUser(Request $request)
    {
        $user = User::create($request->all());
        return response()->json(['success' => true, 'user' => $user]);
    }
    
    public function addTheme(Request $request)
{
    $request->validate([
        'theme-title' => 'required|string|max:255',
        'theme-image' => 'required|url',
        'theme-manager' => 'required|exists:users,id',
        'theme-description' => 'required|string',
    ]);

    $subscriber = User::findOrFail($request->input('theme-manager'));

    $subscriber->role = 'manager';
    $subscriber->save();

    $theme = Theme::create([
        'title' => $request->input('theme-title'),
        'image' => $request->input('theme-image'),
        'description' => $request->input('theme-description'),
        'manager_id' => $subscriber->id,
    ]);

    return response()->json(['success' => true, 'theme' => $theme]);
}
}


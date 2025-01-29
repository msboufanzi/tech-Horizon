<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\User;
use App\Models\Theme;
use App\Models\Comment;
use App\Models\Rating;
use App\Models\Magazine;
use App\Models\ProposedArticle;

class EditorController extends Controller
{
    public function index()
    {
        $existingArticles = Article::with(['author', 'theme'])
            ->orderBy('title')
            ->paginate(7, ['*'], 'existing_page');

        $pendingArticles = ProposedArticle::with(['author', 'theme'])
            ->where('position', 2)
            ->paginate(7, ['*'], 'pending_page');

        $users = User::paginate(7, ['*'], 'users_page');
        $subscribers = User::where('role', 'subscriber')->get();
        $statistics = [
            'total_subscribers' => User::where('role', 'subscriber')->count(),
            'published_articles' => Article::where('ispublic', true)->count(),
            'active_themes' => Theme::count(),
            'total_activities' => Comment::count() + Rating::count(),
        ];
        $magazines = Magazine::all();

        return view('editor_dashboard', compact('existingArticles', 'pendingArticles', 'users', 'statistics', 'subscribers', 'magazines'));
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
        $validatedData = $request->validate([
            'theme-title' => 'required|string|max:255',
            'theme-image' => 'required|url',
            'theme-manager' => 'nullable|exists:users,id',
            'theme-description' => 'required|string',
        ]);

        $managerId = $request->input('theme-manager');
        $subscriber = null;
        if ($managerId) {
            $subscriber = User::find($managerId);
            if (!$subscriber) {
                return response()->json(['success' => false, 'message' => 'Selected manager not found.'], 400);
            }
            $subscriber->role = 'manager';
            $subscriber->save();
        }
        $theme = Theme::create([
            'title' => $validatedData['theme-title'],
            'image' => $validatedData['theme-image'],
            'description' => $validatedData['theme-description'],
            'manager_id' => $subscriber ? $subscriber->id : null,
        ]);

        return response()->json(['success' => true, 'theme' => $theme]);
    }

    public function showProposedArticle($id)
    {
        $proposal = ProposedArticle::with(['author', 'theme'])->findOrFail($id);
        return view('proposed_article_review', compact('proposal'));
    }

    public function approveArticle($id)
    {
        $proposal = ProposedArticle::findOrFail($id);

        $article = new Article();
        $article->title = $proposal->title;
        $article->content = $proposal->content;
        $article->description = $proposal->description;
        $article->author_id = $proposal->author_id;
        $article->theme_id = $proposal->theme_id;
        $article->ispublic = true;
        $article->image = $proposal->image;
        $article->save();

        $proposal->position = 3;
        $proposal->save();

        return redirect()->route('editor_dashboard')->with('success', 'Article approved and published.');
    }

    public function rejectArticle($id)
    {
        $proposal = ProposedArticle::findOrFail($id);

        $proposal->position = 4;
        $proposal->save();

        return redirect()->route('editor_dashboard')->with('error', 'Article rejected.');
    }
}


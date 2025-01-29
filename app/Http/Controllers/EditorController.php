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
        $availableThemes = Theme::whereNull('manager_id')->get();
        $themes = Theme::with('manager')->get();

        return view('editor_dashboard', compact(
            'existingArticles',
            'pendingArticles',
            'users',
            'statistics',
            'subscribers',
            'magazines',
            'availableThemes',
            'themes'
        ));
    }

    public function toggleVisibility(Request $request, Article $article)
    {
        $article->ispublic = !$article->ispublic;
        $article->save();
        return response()->json(['success' => true, 'ispublic' => $article->ispublic]);
    }

    public function updateUser(Request $request, User $user)
    {
        try {
            $user->update($request->only(['name', 'email']));
            return response()->json(['success' => true, 'user' => $user]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function updateRole(Request $request, User $user)
    {
        try {
            $oldRole = $user->role;
            $newRole = $request->role;
            
            if ($oldRole === 'manager') {
                Theme::where('manager_id', $user->id)->update(['manager_id' => null]);
            }
            
            $user->role = $newRole;
            $user->save();
            
            if ($newRole === 'manager' && $request->has('theme_id')) {
                $theme = Theme::findOrFail($request->theme_id);
                if ($theme->manager_id === null) {
                    $theme->manager_id = $user->id;
                    $theme->save();
                }
            }
            
            return response()->json(['success' => true, 'user' => $user]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function blockUser(User $user)
    {
        try {
            $user->delete();
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function addUser(Request $request)
    {
        try {
            $userData = $request->only(['name', 'email', 'password', 'role']);
            $user = User::create($userData);

            if ($request->role === 'manager' && $request->has('theme_id')) {
                $theme = Theme::findOrFail($request->theme_id);
                if ($theme->manager_id === null) {
                    $theme->manager_id = $user->id;
                    $theme->save();
                }
            }

            return response()->json(['success' => true, 'user' => $user]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function addTheme(Request $request)
    {
        $validatedData = $request->validate([
            'theme-title' => 'required|string|max:255',
            'theme-image' => 'required|url',
            'theme-description' => 'required|string',
        ]);

        try {
            $theme = Theme::create([
                'title' => $validatedData['theme-title'],
                'image' => $validatedData['theme-image'],
                'description' => $validatedData['theme-description'],
                'manager_id' => null,
            ]);

            return response()->json(['success' => true, 'theme' => $theme]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function showProposedArticle($id)
    {
        $proposal = ProposedArticle::with(['author', 'theme'])->findOrFail($id);
        return view('proposed_article_review', compact('proposal'));
    }

    public function approveArticle($id)
    {
        try {
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
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to approve article: ' . $e->getMessage());
        }
    }

    public function rejectArticle($id)
    {
        try {
            $proposal = ProposedArticle::findOrFail($id);
            $proposal->position = 4;
            $proposal->save();

            return redirect()->route('editor_dashboard')->with('error', 'Article rejected.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to reject article: ' . $e->getMessage());
        }
    }

    public function deleteTheme($id)
    {
        try {
            $theme = Theme::findOrFail($id);
            
            if ($theme->manager) {
                $manager = $theme->manager;
                $manager->role = 'subscriber';
                $manager->save();
            }

            $theme->delete();

            return response()->json(['success' => true, 'message' => 'Theme deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function addArticle(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'required|string',
                'content' => 'required|string',
                'image' => 'required|url',
                'theme_id' => 'required|exists:themes,id',
                'magazine_id' => 'nullable|exists:magazines,id'
            ]);

            $article = Article::create([
                'title' => $validatedData['title'],
                'description' => $validatedData['description'],
                'content' => $validatedData['content'],
                'image' => $validatedData['image'],
                'theme_id' => $validatedData['theme_id'],
                'author_id' => auth()->id(),
                'ispublic' => true,
            ]);

            if (!empty($validatedData['magazine_id'])) {
                $magazine = Magazine::find($validatedData['magazine_id']);
                $magazine->articles()->attach($article->id);
            }

            return response()->json([
                'success' => true, 
                'message' => 'Article added successfully',
                'article' => $article->load('author', 'theme')
            ]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
}


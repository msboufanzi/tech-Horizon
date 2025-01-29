<?php

namespace App\Http\Controllers;

use App\Models\Magazine;
use App\Models\Article;
use Illuminate\Http\Request;

class MagazineController extends Controller
{
    public function manage($id)
    {
        try {
            $magazine = Magazine::findOrFail($id);
            $availableArticles = Article::whereDoesntHave('magazines', function($query) use ($id) {
                $query->where('magazine_id', $id);
            })->get();
            
            return view('magazines.manage', compact('magazine', 'availableArticles'));
        } catch (\Exception $e) {
            return redirect()->route('editor_dashboard')
                ->with('error', 'Magazine not found');
        }
    }
    
    
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'number' => 'required|string|unique:magazines',
                'title' => 'required|string',
                'is_public' => 'required|boolean',
            ]);
    
            $magazine = Magazine::create($validated);
    
            return response()->json([
                'success' => true,
                'message' => 'Magazine created successfully',
                'magazine' => $magazine
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function addArticle(Request $request, $id)
    {
        try {
            $magazine = Magazine::findOrFail($id);
            $article = Article::findOrFail($request->article_id);
            $magazine->articles()->attach($article);
            
            return redirect()->back()->with('success', 'Article added successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to add article: ' . $e->getMessage());
        }
    }
    
    

    public function removeArticle($magazineId, $articleId)
    {
        $magazine = Magazine::findOrFail($magazineId);
        $magazine->articles()->detach($articleId);
        return redirect()->back()->with('success', 'Article removed successfully');
    }

    public function destroy($id)
{
    try {
        $magazine = Magazine::findOrFail($id);
        $magazine->articles()->detach();
        $magazine->delete();
        
        if(request()->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Magazine deleted successfully'
            ]);
        }
        
        return redirect()->route('editor_dashboard')
            ->with('success', 'Magazine deleted successfully');
    } catch (\Exception $e) {
        if(request()->wantsJson()) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete magazine'
            ], 500);
        }
        
        return redirect()->back()
            ->with('error', 'Failed to delete magazine');
    }
}


}


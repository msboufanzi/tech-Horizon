<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Comment;
use App\Models\Following;
use App\Models\ProposedArticle;
use App\Models\Theme;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ThemeManagerController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $theme = Theme::where('manager_id', $user->id)->first();

        if (!$theme) {
            return redirect()->route('home')->with('error', 'You are not a theme manager');
        }

        $subscriptions = Following::with('user')->where('theme_id', $theme->id)->get();
        $articles = Article::with('author')->where('theme_id', $theme->id)->get();
        $proposals = ProposedArticle::with('author')->where('theme_id', $theme->id)->where('position', 1)->get();
        $comments = Comment::whereHas('article', function ($query) use ($theme) {
            $query->where('theme_id', $theme->id);
        })->with(['user', 'article'])->get();

        $stats = [
            'Total Subscribers' => $subscriptions->count(),
            'Published Articles' => $articles->where('ispublic', true)->count(),
            'Pending Proposals' => $proposals->where('position', 1)->count(),
            'Total Comments' => $comments->count()
        ];

        return view('theme_manager_dashboard', compact('theme', 'subscriptions', 'articles', 'proposals', 'comments', 'stats'));
    }

    public function removeSubscriber(Request $request)
    {
        Following::where('user_id', $request->user_id)
            ->where('theme_id', $request->theme_id)
            ->delete();

        return redirect()->back()->with('success', 'Subscriber removed successfully');
    }

    public function deleteArticle($id)
    {
        Article::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Article deleted successfully');
    }

    public function updateProposalStatus(Request $request)
    {
        $proposal = ProposedArticle::findOrFail($request->proposal_id);
        $proposal->position = 2; // 2 for " Processed" status
        $proposal->save();
        return redirect()->back()->with('success', 'Proposal status updated to  Processed');
    }

    public function deleteProposal($id)
    {
        ProposedArticle::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Proposal deleted successfully');
    }

    public function deleteComment($id)
    {
        Comment::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Comment deleted successfully');
    }

    public function showProposedArticle($id)
    {
        $proposal = ProposedArticle::findOrFail($id);
        return view('proposed_article_details', compact('proposal'));
    }
}


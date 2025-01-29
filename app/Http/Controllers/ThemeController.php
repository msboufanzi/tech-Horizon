<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Models\Theme;
use App\Models\Following;


class ThemeController extends Controller
{
    public function index()
    {
        $themes = Theme::all();

        if (auth()->check()) {
            $user = auth()->user();
            foreach ($themes as $theme) {
                $theme->is_followed = $user->followings()->where('theme_id', $theme->id)->exists();
            }
        }

        return view('themes', compact('themes'));
    }
    public function follow(Request $request)
    {
        $request->validate([
            'theme_id' => 'required|exists:themes,id',
            'user_id' => 'required|exists:users,id',
        ]);
        $existingFollow = Following::where('user_id', $request->user_id)
            ->where('theme_id', $request->theme_id)
            ->first();

        if ($existingFollow) {
            return redirect()->back()->with('error', 'You are already following this theme.');
        }

        Following::create([
            'user_id' => $request->user_id,
            'theme_id' => $request->theme_id,
        ]);

        return redirect()->back()->with('success', 'You are now following this theme.');
    }

    public function unfollow(Request $request)
    {
        $request->validate([
            'theme_id' => 'required|exists:themes,id',
            'user_id' => 'required|exists:users,id',
        ]);

        $follow = Following::where('user_id', $request->user_id)
            ->where('theme_id', $request->theme_id)
            ->first();

        if ($follow) {
            $follow->delete();
            return redirect()->back()->with('success', 'You have unfollowed this theme.');
        }

        return redirect()->back()->with('error', 'You are not following this theme.');
    }
}
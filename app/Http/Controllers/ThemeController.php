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
        // Fetch all themes from the database
        $themes = Theme::all();

        // Check if the authenticated user is following each theme
        if (auth()->check()) {
            $user = auth()->user(); 
            foreach ($themes as $theme) {
                $theme->is_followed = $user->followings()->where('theme_id', $theme->id)->exists();
            }
        }

        // Pass the themes to the themes view
        return view('themes', compact('themes'));
    }
    public function follow(Request $request)
    {
        // Validate the request
        $request->validate([
            'theme_id' => 'required|exists:themes,id',
            'user_id' => 'required|exists:users,id',
        ]);

        // Check if the user is already following the theme
        $existingFollow = Following::where('user_id', $request->user_id)
            ->where('theme_id', $request->theme_id)
            ->first();

        if ($existingFollow) {
            return redirect()->back()->with('error', 'You are already following this theme.');
        }

        // Create a new follow relationship
        Following::create([
            'user_id' => $request->user_id,
            'theme_id' => $request->theme_id,
        ]);

        return redirect()->back()->with('success', 'You are now following this theme.');
    }
}
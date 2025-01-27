<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProposedArticle extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'image',
        'description',
        'content',
        'theme_id',
        'author_id',
        'ispublic',
        'position', // Add this line
    ];

    // Define a relationship to fetch the author (user)
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    // Define a relationship to fetch the theme
    public function theme()
    {
        return $this->belongsTo(Theme::class, 'theme_id');
    }
}
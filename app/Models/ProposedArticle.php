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
        'position',
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function theme()
    {
        return $this->belongsTo(Theme::class, 'theme_id');
    }
}
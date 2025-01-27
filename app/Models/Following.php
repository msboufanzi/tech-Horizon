<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Following extends Model
{
    use HasFactory;

    protected $table = 'following';

    protected $fillable = ['user_id', 'theme_id'];

    // Relationship to the User model
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relationship to the Theme model
    public function theme()
    {
        return $this->belongsTo(Theme::class, 'theme_id');
    }
}
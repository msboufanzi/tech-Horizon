<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Theme extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'manager_id', 'created_at', 'image'];

    public function followings()
    {
        return $this->hasMany(Following::class, 'theme_id');
    }

    public function manager()
    {
        return $this->belongsTo(User::class, 'manager_id');
    }
}
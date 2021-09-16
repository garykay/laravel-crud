<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Support\Str;

class Post extends Model
{

    use HasFactory;
    use Sluggable;

    const EXCERPT_LENGTH = 100;
    const BLOG_EXCERPT_LENGTH = 300;

    protected $fillable = ['title', 'slug', 'description', 'image_path', 'user_id'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function excerpt()
    {
        return Str::limit($this->description, Post::EXCERPT_LENGTH);
    }

    public function blog_excerpt()
    {
        return Str::limit($this->description, Post::BLOG_EXCERPT_LENGTH);
    }

}

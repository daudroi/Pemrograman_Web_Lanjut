<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'slug', 'category_id', 'color', 'image', 'body', 'published', 'published_at'];
    protected $casts = ['published' => 'boolean', 'published_at' => 'date'];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'post_tag');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Article extends Model
{
    use HasFactory;

    protected $casts = [
        'published_at' => 'datetime'
    ];

    protected $fillable = [
        'name',
        'photo',
        'description',
        'published_at',
        'author_id',
    ];

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function comments():HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function likes(): hasMany
    {
        return $this->hasMany(Like::class);
    }

    public function user_like(): HasOne
    {
        return $this->hasOne(Like::class)->where('user_id', auth()->id());
    }
}

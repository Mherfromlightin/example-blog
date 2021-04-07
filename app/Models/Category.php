<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    public function hasSubCategories(): bool
    {
        return !$this->sub_categories->isEmpty();
    }

    public function sub_categories(): HasMany
    {
        return $this->hasMany(Category::class, 'parent_category_id');
    }

    public function parent_category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'parent_category_id');
    }
}

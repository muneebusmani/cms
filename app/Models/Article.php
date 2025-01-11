<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Article extends Model
{
    /** @use HasFactory<\Database\Factories\ArticleFactory> */
    use HasFactory;

    /**
     * Get the user that owns the Article
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get all of the pdfs for the Article
     */
    public function pdfs(): HasMany
    {
        return $this->hasMany(articles_pdfs::class);
    }

    protected $casts = [
        'title' => 'string',
        'description' => 'string',
        'thumbnail' => 'string',
    ];
}

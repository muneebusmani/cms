<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ArticlesPdfs extends Model
{
    /** @use HasFactory<\Database\Factories\ArticlesPdfsFactory> */
    use HasFactory;

    /**
     * Get the article that owns the ArticlesPdfs
     */
    public function article(): BelongsTo
    {
        return $this->belongsTo(Article::class);
    }
}

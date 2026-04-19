<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sermon extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'preacher',
        'scripture',
        'description',
        'file_path',
        'file_type',   // 'audio' | 'video' | 'youtube'
        'youtube_url',
        'thumbnail',
        'sermon_date',
        'is_published',
    ];

    protected $casts = [
        'sermon_date'  => 'date',
        'is_published' => 'boolean',
    ];

    // Scopes
    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    public function scopeLatest($query)
    {
        return $query->orderBy('sermon_date', 'desc');
    }

    // Helpers
    public function isYoutube(): bool
    {
        return $this->file_type === 'youtube';
    }

    public function getYoutubeEmbedUrl(): ?string
    {
        if (! $this->isYoutube() || ! $this->youtube_url) {
            return null;
        }
        preg_match('/(?:v=|youtu\.be\/)([a-zA-Z0-9_-]{11})/', $this->youtube_url, $matches);
        return isset($matches[1]) ? "https://www.youtube.com/embed/{$matches[1]}" : null;
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bulletin extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'file_path',
        'bulletin_date',
        'is_published',
    ];

    protected $casts = [
        'bulletin_date' => 'date',
        'is_published'  => 'boolean',
    ];

    public function scopePublished($query)
    {
        return $query->where('is_published', true)->orderBy('bulletin_date', 'desc');
    }
}

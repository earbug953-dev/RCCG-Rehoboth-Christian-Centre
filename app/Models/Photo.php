<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;

    protected $fillable = [
        'gallery_id',
        'file_path',
        'caption',
        'sort_order',
    ];

    public function gallery()
    {
        return $this->belongsTo(Gallery::class);
    }
}

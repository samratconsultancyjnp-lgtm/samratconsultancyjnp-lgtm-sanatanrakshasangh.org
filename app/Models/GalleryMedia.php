<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GalleryMedia extends Model
{
    protected $fillable = ['album_id', 'file_path', 'type'];

    public function album()
    {
        return $this->belongsTo(GalleryAlbum::class, 'album_id');
    }
}

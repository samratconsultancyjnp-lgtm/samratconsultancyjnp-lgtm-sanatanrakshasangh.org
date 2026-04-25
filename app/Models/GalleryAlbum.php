<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GalleryAlbum extends Model
{
    protected $fillable = ['name'];

    public function media()
    {
        return $this->hasMany(GalleryMedia::class, 'album_id');
    }
}

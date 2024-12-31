<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FileUpload extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = ['expires_at', 'password', 'name', 'user_id', 'folder_id'];
    public function trackFiles()
    {
        return $this->hasMany(TrackFile::class);
    }
}

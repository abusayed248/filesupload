<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Folder extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

    public function fileUploads()
    {
        return $this->hasMany(FileUpload::class);
    }

    public function trackFiles()
    {
        return $this->hasManyThrough(TrackFile::class, FileUpload::class);
    }
}

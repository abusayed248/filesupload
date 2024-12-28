<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrackFile extends Model
{
    use HasFactory;
    protected $fillable = ['filepath', 'file_upload_id'];
}

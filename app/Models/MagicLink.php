<?php
// app/Models/MagicLink.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MagicLink extends Model
{
    use HasFactory;

    // Define the table name (optional, as it defaults to plural form)
    protected $table = 'magic_links';

    // Define the fillable attributes (for mass assignment)
    protected $fillable = [
        'email',
        'token',
        'expires_at',
    ];

    // Optional: Method to check if the magic link has expired
    public function isExpired()
    {
        return $this->expires_at < now();  // Check if the token has expired
    }
}

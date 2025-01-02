<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactInfo extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_name',
        'text_no',
        'tel',
        'address',
        'email',
        'twitter',
        'photo',
        'description',
    ];
}

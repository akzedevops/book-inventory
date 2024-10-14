<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    // Define the fields that are mass assignable
    protected $fillable = [
        'title',
        'author',
        'isbn',
        'publisher',
        'published_year',
        'pages',
        'language',
        'cover_image', // If you're going to add book covers later
    ];
}


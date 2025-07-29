<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Article extends Model
{
    // colones autoriser en écriture
    use HasFactory; 
    protected $fillable =[
        'title',
        'content',
        'publish',
    ];

    protected $cast = [
        'publish'=> 'boolean',

    ];
}

<?php

namespace App\Pages;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Model extends Eloquent
{
    protected $table = 'pages';
    protected $fillable = ['title', 'body', 'slug'];
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    protected $fillable = ['first_name', 'last_name', 'date_of_birth', 'date_of_death', 'nationality', 'biographic', 'image'];
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nationality extends Model
{
    protected $fillable = ['nationality', 'history_link', 'flag'];
}

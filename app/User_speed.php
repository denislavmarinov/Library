<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_speed extends Model
{
    protected $fillable = ['monday', 'tuesday', 'wednsday', 'thursday', 'friday', 'saturday', 'sunday', 'week_num', 'pages_per_week'];
}

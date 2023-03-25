<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
class User_role extends Model
{
    protected $table = 'role_user';
    protected $fillable = [
        'role_id','user_id'
    ];

}
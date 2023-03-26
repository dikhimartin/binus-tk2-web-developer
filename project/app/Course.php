<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;

class Course extends Model
{
    Use Uuid;

    protected $table = 'courses';
    protected $fillable = ['code', 'name', 'description', 'status'];
       
    public $incrementing = false;

    protected $keyType = 'uuid';
}

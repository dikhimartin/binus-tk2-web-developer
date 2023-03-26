<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;

class Faculty extends Model
{
    Use Uuid;

    protected $table = 'faculties';
    protected $fillable = ['code', 'name', 'description', 'status'];
       
    public $incrementing = false;

    protected $keyType = 'uuid';
}

<?php

namespace App;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;
use DB;

class Student extends Model
{
    Use Uuid;

    protected $table = 'students';
    protected $fillable = ['name', 'faculties_id'];
       
    public $incrementing = false;

    protected $keyType = 'uuid';

    public function grades(){
        return $this->hasOne(Grade::class);
    }

    public function faculties(){
        return $this->belongsTo(Faculty::class);
    }

}
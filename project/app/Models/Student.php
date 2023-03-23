<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'quiz', 'assignment', 'attendance', 'practice', 'final_exam'];

    public function grade(){
        return $this->hasOne(Grade::class);
    }

}

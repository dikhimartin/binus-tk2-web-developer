<?php

namespace App;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;
use DB;

class Grade extends Model
{
    Use Uuid;

    protected $table = 'grades';
    protected $fillable = ['students_id', 'courses_id', 'quiz', 'assignment', 'attendance', 'practice', 'final_exam','total_score','grade'];
       
    public $incrementing = false;

    protected $keyType = 'uuid';


    public function students(){
        return $this->belongsTo(Student::class);
    }

    public function courses(){
        return $this->belongsTo(Course::class);
    }    

}

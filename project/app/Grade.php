<?php

namespace App;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    Use Uuid;

    protected $table = 'grades';
    protected $fillable = ['student_id', 'quiz', 'assignment', 'attendance', 'practice', 'final_exam'];
       
    public $incrementing = false;

    protected $keyType = 'uuid';

    public function get_data(){
    	$data = DB::table('grades')
        ->select('grades.*')
        ->orderBy('id','ASC');
        return $data;
    }
}

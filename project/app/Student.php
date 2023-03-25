<?php

namespace App;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Model;
use DB;

class Student extends Model
{
    Use Uuid;

    protected $table = 'students';
    protected $fillable = ['name', 'email'];
       
    public $incrementing = false;

    protected $keyType = 'uuid';

    public function get_data(){
    	$data = DB::table('students')
        ->select('students.*')
        ->orderBy('id','ASC');
        return $data;
    }
}

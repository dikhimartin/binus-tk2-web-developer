<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use PeterColes\Countries\CountriesFacade;
use App\User;
use App\Course;
use App\Grade;
use Illuminate\Support\Facades\Auth;
use Zizaco\Entrust\EntrustFacade as Entrust;

class HomeController extends Controller
{
    private $controller = 'home';
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    private function title(){
        return __('main.dashboard');
    }

    public function index(){

      $controller =$this->controller;
      $pages_title="Dashboard";
      $page_active='dashboard';

      $data_user = User::select('users.username','users.name','users.id_level_user','roles.display_name')
        ->leftjoin('roles','users.id_level_user','=','roles.id')
        ->where('users.id_users',Auth::user()->id_users)
      ->first();

      // $data_courses = Course::get();

      $data_courses = Grade::whereHas('courses')->with(['courses'])->groupBy('courses_id')->get();


      return view('backend.home',compact('controller','page_active','pages_title','data_user', 'data_courses'));
    }

    public function get_grade_courses(Request $request){
      $course_id = $request->course_id;
  
      $query = Grade::whereHas('courses')
          ->whereHas('students.faculties')
          ->where('courses_id', $course_id)
          ->with(['courses'])
          ->with(['students' => function($query) {
              $query->orderBy('name', 'asc');
          }, 'students.faculties'])
          ->get();
  
      $students = $query->pluck('students')->unique()->all();
  
      $categories = [];
      foreach ($students as $student) {
          $categories[] = $student->name;
      }
  
      $quiz = [];
      $assignment = [];
      $attendance = [];
      $practice = [];
      $final_exam = [];
  
      foreach ($query as $grade) {
          $student_name = $grade->students->name;
          $quiz[$student_name] = $grade->quiz;
          $assignment[$student_name] = $grade->assignment;
          $attendance[$student_name] = $grade->attendance;
          $practice[$student_name] = $grade->practice;
          $final_exam[$student_name] = $grade->final_exam;
      }
  
      $series = [
          [
              'name' => 'Nilai Quiz',
              'data' => array_values($quiz)
          ],
          [
              'name' => 'Nilai Tugas',
              'data' => array_values($assignment)
          ],
          [
              'name' => 'Nilai Absensi',
              'data' => array_values($attendance)
          ],
          [
              'name' => 'Nilai praktek',
              'data' => array_values($practice)
          ],
          [
              'name' => 'Nilai UAS',
              'data' => array_values($final_exam)
          ]
      ];
  
      $output = [
          'categories' => $categories,
          'series' => $series
      ];
  
      return response()->json($output);
    }

}

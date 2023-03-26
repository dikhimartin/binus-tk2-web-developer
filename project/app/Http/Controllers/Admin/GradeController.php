<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Grade;
use App\Course;
use App\User;
use App\Student;
use Illuminate\Support\Facades\Auth;
use DB;

class GradeController extends Controller
{
    
    private $controller = 'grades';

    private function title(){
        return __('main.grades');
    }

    public function __construct(){
        $this->middleware('auth');
    }

    public function index(Request $request){ 

        if (!Auth::user()->can($this->controller.'-list')){
            return view('backend.errors.401')->with(['url' => '/admin']);
        }

        // Filter Data
        $field_filter       = $request->get('field_filter');
        $operator_filter    = $request->get('operator_filter');
        $text_filter        = $request->get('text_filter');

        $query = Grade::whereHas('courses')
        ->whereHas('student.faculties')
        ->with(['courses'])
        ->with(['student.faculties']);
    
        if ($text_filter !== false && $operator_filter == "LIKE"){
            $query->where('student.'.$field_filter.'','LIKE','%'.$text_filter.'%');        
        }else if ($text_filter !== false && $operator_filter == "="){
            $query->where('student.'.$field_filter.'', '=', "".$text_filter."");      
        }

        $query->orderBy('id','DESC');
        $rows = $query->paginate(10);

        $students = Student::get();
        $courses = Course::get();

        return view('backend.'.$this->controller.'.list', compact('rows','students','courses'))->with(array('controller' => $this->controller, 'pages_title' => $this->title(), 'text_filter' => $text_filter , 'operator_filter' => $operator_filter, 'field_filter' => $field_filter));
    }

    private function _validate_data(Request $request){

        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if($request->student_id == ''){
            $data['inputerror'][] = 'student_id';
            $data['error_string'][] = 'Student is required';
            $data['status'] = FALSE;
        }
        if($request->quiz == ''){
            $data['inputerror'][] = 'quiz';
            $data['error_string'][] = 'Quiz score is required';
            $data['status'] = FALSE;
        }
        if($request->assignment == ''){
            $data['inputerror'][] = 'assignment';
            $data['error_string'][] = 'Assignment score is required';
            $data['status'] = FALSE;
        }
        if($request->attendance == ''){
            $data['inputerror'][] = 'attendance';
            $data['error_string'][] = 'Attendance score is required';
            $data['status'] = FALSE;
        }
        if($request->practice == ''){
            $data['inputerror'][] = 'practice';
            $data['error_string'][] = 'Practice score is required';
            $data['status'] = FALSE;
        }
        if($request->final_exam == ''){
            $data['inputerror'][] = 'final_exam';
            $data['error_string'][] = 'Final exam score is required';
            $data['status'] = FALSE;
        }

        if($data['status'] === FALSE){
            echo json_encode($data);
            exit();
        }

    }

    public function save(Request $request){

        if (!Auth::user()->can($this->controller.'-create')){
            return  json_encode("error_403");
        }

        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        GradeController::_validate_data($request);

        $mod = new Grade;
        $mod->student_id = $request->student_id;
        $mod->courses_id = $request->courses_id;
        $mod->quiz = $request->quiz;
        $mod->assignment = $request->assignment;
        $mod->attendance = $request->attendance;
        $mod->practice = $request->practice;
        $mod->final_exam = $request->final_exam;

        // Hitung total nilai
        $total_score = ($mod->quiz * 0.2) + ($mod->assignment * 0.2) + ($mod->attendance * 0.1) + ($mod->practice * 0.3) + ($mod->final_exam * 0.2);
        $mod->total_score = $total_score;

        // Hitung grade
        $grade = '';
        if ($total_score <= 65) {
            $grade = 'D';
        } elseif ($total_score <= 75) {
            $grade = 'C';
        } elseif ($total_score <= 85) {
            $grade = 'B';
        } else {
            $grade = 'A';
        }
        $mod->grade = $grade;
        $mod->save();

        $result=array(
                "data_post"=>array(
                "status"=>TRUE,
                "class" => "success",
                "message"=> __('main.data_added_succesfully')
            )
        );
        echo json_encode($result);
    }

    public function update(Request $request){

        if (!Auth::user()->can($this->controller.'-edit')){
            return  json_encode("error_403");
        }

        GradeController::_validate_data($request);

        $mod = Grade::find($request->id);
        $mod->quiz = $request->quiz;
        $mod->assignment = $request->assignment;
        $mod->attendance = $request->attendance;
        $mod->practice = $request->practice;
        $mod->final_exam = $request->final_exam;

        // Hitung total nilai
        $total_score = ($mod->quiz * 0.2) + ($mod->assignment * 0.2) + ($mod->attendance * 0.1) + ($mod->practice * 0.3) + ($mod->final_exam * 0.2);
        $mod->total_score = $total_score;

        // Hitung grade
        $grade = '';
        if ($total_score <= 65) {
            $grade = 'D';
        } elseif ($total_score <= 75) {
            $grade = 'C';
        } elseif ($total_score <= 85) {
            $grade = 'B';
        } else {
            $grade = 'A';
        }
        $mod->grade = $grade;
        $mod->save();

        $result=array(
                "data_post"=>array(
                "status"=>TRUE,
                "class" => "warning",
                "message"=> __('main.data_succesfully_changed')
            )
        );
        echo json_encode($result);
    }

    public function delete(Request $request){

        if (!Auth::user()->can($this->controller.'-delete')){
            echo json_encode("error_403");
        }


        $mod = Student::find($request->id);
        $mod->delete();
        $result=array(
                "data_post"=>array(
                    "status"=>TRUE,
                    "class" => "danger",
                    "message"=> __('main.data_succesfully_deleted')
                )
            );
        echo json_encode($result);
    }

    public function delete_all($id){
        if (!Auth::user()->can($this->controller.'-delete')){
            echo json_encode("error_403");
        }


        DB::table("students")->whereIn('id',explode(",",$id))->delete();

        $result=array(
                "data_post"=>array(
                    "status"=>TRUE,
                    "class" => "danger",
                    "message"=> __('main.data_succesfully_deleted')
                )
            );
        echo json_encode($result);
    }

    public function get_data_byid($id){

        if (!Auth::user()->can($this->controller.'-list')){
            echo json_encode("error_403");
        }

        $data = DB::table('students')->select('students.*')
        ->where('id',$id)
        ->first();

        $data_return =array('data'=>$data);
        return response()->json($data_return);
    }

}

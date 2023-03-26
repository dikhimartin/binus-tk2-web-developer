<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Student;
use App\Faculty;
use App\User;
use Illuminate\Support\Facades\Auth;
use DB;

class StudentController extends Controller
{
    
    private $controller = 'students';

    private function title(){
        return __('main.students');
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

        $query = Student::where('status', 'Y')
        ->orderBy('name')
        ->whereHas('faculties')
        ->with(['faculties' => function ($query) {
            $query->orderBy('name', 'desc');
        }]);
    
        if (!empty($text_filter)) {
            switch ($operator_filter) {
                case 'LIKE':
                    $query->where('students.'.$field_filter.'', 'LIKE', '%'.$text_filter.'%');
                    break;
                case '=':
                    $query->where('students.'.$field_filter.'', '=', $text_filter);
                    break;
            }
        }

        $query->orderBy('id','DESC');
        $rows = $query->paginate(10);

        $faculties = Faculty::get();

        return view('backend.'.$this->controller.'.list', compact('rows','faculties'))->with(array('controller' => $this->controller, 'pages_title' => $this->title(), 'text_filter' => $text_filter , 'operator_filter' => $operator_filter, 'field_filter' => $field_filter));
    }

    private function _validate_data(Request $request){

        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if($request->name == ''){
            $data['inputerror'][] = 'name';
            $data['error_string'][] = 'Name is required';
            $data['status'] = FALSE;
        }
        if($request->faculties_id == ''){
            $data['inputerror'][] = 'faculties_id';
            $data['error_string'][] = 'Faculty is required';
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

        StudentController::_validate_data($request);

        $mod = new Student;
        $mod->name           = $request->name;
        $mod->faculties_id   = $request->faculties_id;
        $mod->description    = $request->description;
        $mod->status         = $request->status;
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

        StudentController::_validate_data($request);

        $mod = Student::find($request->id);
        $mod->name           = $request->name;
        $mod->faculties_id   = $request->faculties_id;
        $mod->description    = $request->description;
        $mod->status         = $request->status;
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

    public function change_status_active($id){

        if (!Auth::user()->can($this->controller.'-edit')){
            return  json_encode("error_403");
        }


        $mod = Student::find($id);
        $mod->status = "Y";
        $mod->save();
        $result=array(
                "data_post"=>array(
                "status"=>TRUE,
                "class" => "info",
                "message"=> __('main.data_already_active')
            )

        );
        echo json_encode($result);
    }

    public function change_status_inactive($id){

        if (!Auth::user()->can($this->controller.'-edit')){
            return  json_encode("error_403");
        }

        $mod = Student::find($id);
        $mod->status = "N";
        $mod->save();
        $result=array(
                "data_post"=>array(
                "status"=>TRUE,
                "class" => "warning",
                "message"=> __('main.data_inactive')
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

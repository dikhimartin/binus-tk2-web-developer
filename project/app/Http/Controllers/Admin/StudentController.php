<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Student;
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

        $row = new Student;
        $datas = $row->get_data();
        
        if ($text_filter !== false && $operator_filter == "LIKE"){
            $datas->where('students.'.$field_filter.'','LIKE','%'.$text_filter.'%');        
        }else if ($text_filter !== false && $operator_filter == "="){
            $datas->where('students.'.$field_filter.'', '=', "".$text_filter."");      
        }

        $datas->orderBy('id','DESC');
        $rows = $datas->paginate(10);

        return view('backend.'.$this->controller.'.list', compact('rows'))->with(array('controller' => $this->controller, 'pages_title' => $this->title(), 'text_filter' => $text_filter , 'operator_filter' => $operator_filter, 'field_filter' => $field_filter));
    }

    private function _validate_data(Request $request){

        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if($request->name == '')
        {
            $data['inputerror'][] = 'name';
            $data['error_string'][] = 'Name is required';
            $data['status'] = FALSE;
        }

        if($data['status'] === FALSE)
        {
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

        $pk = new Student;
        $pk->name           = $request->name;
        $pk->email          = $request->email;
        $pk->description    = $request->description;
        $pk->status         = $request->status;
        $pk->save();

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

        $pk = Student::find($request->id);
        $pk->name           = $request->name;
        $pk->email          = $request->email;
        $pk->description    = $request->description;
        $pk->status         = $request->status;
        $pk->save();

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


        $pk = Student::find($id);
        $pk->status = "Y";
        $pk->save();
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

        $pk = Student::find($id);
        $pk->status = "N";
        $pk->save();
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


        $pk = Student::find($request->id);
        $pk->delete();
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

    public function get_data_byid(Request $request){

        if (!Auth::user()->can($this->controller.'-list')){
            echo json_encode("error_403");
        }

        $id = $request->id;

        $data = DB::table('students')->select('students.*')
        ->where('id',$id)
        ->first();

        $data_return =array('data'=>$data);
        return response()->json($data_return);
    }

}

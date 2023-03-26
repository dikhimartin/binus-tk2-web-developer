<?php
use Zizaco\Entrust\EntrustFacade as Entrust;
use Illuminate\Support\Facades\Auth;
use App\User;
	

    function arrStatusActive(){
        return array('Y' => __('main.active'), 'N' => __('main.non-active'));
    }

    function arrStatusActiveLabel(){
        return array('Y' => 'info', 'N' => 'danger');
    }

    function diset($set,$id_quotation){
        @session_start();
        if (session()->has('diset')){
            $diset = array('diset'=>$id_quotation);
            Session::put($diset, array());
        }
            $diset = array('diset'=>array($id_quotation=>true));
            Session::put($diset);
    }

	function diget($id_quotation){	
		if(session()->has('diset')){
					$diset = session()->get('diset');
		 			if(isset($diset[$id_quotation])) return $diset[$id_quotation];
		 			else return false;
		}else{
					return false;
		}
	}  

	function arrGender() {
	    return array('L' => __('main.male'), 'P' => __('main.female'));
	}
    
    function getGradeClass($grade){
        switch ($grade) {
            case 'A':
                return 'text-success';
                break;
            case 'B':
                return 'text-info';
                break;
            case 'C':
                return 'text-warning';
                break;
            case 'D':
                return 'text-danger';
                break;
            default:
                return '';
                break;
        }
    }
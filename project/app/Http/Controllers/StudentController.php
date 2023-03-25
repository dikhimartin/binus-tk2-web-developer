<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use Carbon\Carbon;

class StudentController extends Controller
{

    public function index(){
        $heads = [
            'ID',
            'Title',
            'Created At',
            'Updated At',
            ['label' => 'Actions', 'width' => 15],
        ];
        $config = [
            'data' => [],
            'order' => [[1, 'desc']],
            'columns' => [null, null, null, null, ['orderable' => false]],
        ];

        foreach (Student::all() as $key => $value) {
            $config['data'][] = [
                $value->id,
                $value->name,
                Carbon::parse($value->created_at)->format('d M Y H:i:s'),
                Carbon::parse($value->updated_at)->format('d M Y H:i:s'),
                '
                    <a
                        class="btn btn-xs btn-default text-teal mx-1 shadow"
                        title="Details"
                        role="button"
                        href="/video-view/'.$value->id.'"
                    >
                        <i class="fa fa-lg fa-fw fa-eye"></i>
                    </a>
                    <a 
                        class="btn btn-xs btn-default text-primary mx-1 shadow"
                        title="Edit"
                        role="button"
                        href="/video-edit/'.$value->id.'"
                    >
                        <i class="fa fa-lg fa-fw fa-pen"></i>
                    </a>
                    <a 
                        class="btn btn-xs btn-default text-danger mx-1 shadow"
                        title="Delete"
                        role="button"
                        href="/video-delete/'.$value->id.'"
                    >
                        <i class="fa fa-lg fa-fw fa-trash"></i>
                    </a>
                '
            ];
        }
        
        return view('student.list', compact('heads', 'config'));
    }

    public function create(){
        return view('student.add');
    }
}

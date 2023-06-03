<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $rqst){
        $rqst->validate([
            'name'=>'required',
            'class'=>'required',
            'date_of_birth'=>'required',
            'student_image'=>'required',
            'department_id'=>'required'
        ]);
        $student = new Student;
        if($rqst->image){ 
            $image = $rqst->file('image');
            $customName = rand().'.'.$image->getClientOriginalExtension();
            $location = public_path('image/'.$customName);
            Image::make($image)->resize(300,300)->save($location);
            $student->name = $rqst->name;
            $student->class = $rqst->class;
            $student->date_of_birth = $rqst->date_of_birth;
            $student->department_id = $rqst->department_id;
            $student->image = $customName;
     
        }
        $student->save();

       
        return back();
    }

}
<?php

namespace App\Http\Controllers\Student;

use App\Models\Student;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StudentRequest;
use App\Repository\Student\StudentRepositoryInterface;

class StudentController extends Controller
{

    protected $Student;

    public function __construct(StudentRepositoryInterface $Student)
    {
        $this->Student = $Student;
    }


    public function index()
    {
        return $this->Student->index();
    }



    public function create()
    {
        return $this->Student->create();
    }


    public function classrooms($id)
    {
        return $this->Student->classrooms($id);
    }


    public function sections($id)
    {
        return $this->Student->sections($id);
    }


    public function store(Request $requst)
    {

        return $this->Student->store($requst);
    }

  
    public function show($id)
    {
        return $this->Student->show($id);
    }


    public function edit($id)
    {
        return $this->Student->edit($id);

    }

    public function update(Request $request, $id)
    {
        //dd($id);
        return $this->Student->update($request,$id);

    }

    public function Upload_attachment(Request $request){

        return $this->Student->Upload_attachment($request);

    }

    public function Download_attachment($student_name , $file){
        return $this->Student->Download_attachment($student_name ,$file);

    }

    public function Delete_attachment(Request $request){

        //dd($request->student_name);
        return $this->Student->Delete_attachment($request);

    }

    public function destroy(Request $request, $id)
    {
        return $this->Student->delete($request);

    }

}

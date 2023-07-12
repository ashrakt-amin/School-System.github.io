<?php

namespace App\Http\Controllers\Teachers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repository\Teacher\TeacherRepositoryInterface;

class TeacherController extends Controller
{
    protected $Teacher ;

    public function __construct(TeacherRepositoryInterface $Teacher)
    {
        $this->Teacher = $Teacher;
    }


    public function index()
    {
        $Teachers = $this->Teacher->getAllTeachers();
        // dd($Teachers);
        return view('pages.Teachers.index',compact('Teachers'));

    }

 
    public function create()
    {
        $specializations = $this->Teacher->Getspecialization();
        $genders = $this->Teacher->getGender();
        return view('pages.Teachers.create',compact('specializations','genders'));

    }

   
    public function store(Request $request)
    {
       return $this->Teacher->store($request);
    }

    
    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $Teachers = $this->Teacher->edit($id);
        $specializations = $this->Teacher->Getspecialization();
        $genders = $this->Teacher->GetGender();
        return view('pages.Teachers.edit',compact('Teachers','specializations','genders'));
    }


    public function update(Request $request)
    {
        return $this->Teacher->update($request);
    }


    public function destroy(Request $request)
    {
        // dd($request);
        return $this->Teacher->delete($request->id);
    }
}

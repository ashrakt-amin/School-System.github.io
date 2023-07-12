<?php

namespace App\Repository\Graduated;

use App\Models\Grade;
use App\Models\Student;
use App\Repository\Graduated\GraduatedRepositoryInterface;

class GraduatedRepository implements GraduatedRepositoryInterface
{

    public function index()
    {
        $students = Student::onlyTrashed()->get();
        return view('pages.graduated.index', compact('students'));
    }



    public function create()
    {
        $Grades = Grade::all();
        return view('pages.graduated.create', compact('Grades'));
    }



    public function softDelete($request)
    {
        $students = student::where('Grade_id', $request->Grade_id)
            ->where('Classroom_id', $request->Classroom_id)
            ->where('section_id', $request->section_id)
            ->get();

        if ($students->count() < 1) {
            return redirect()->back()->with('error_Graduated', ('No Data For Students'));
        } else {
            foreach ($students as $student) {
                $id = explode(',', $student->id);
                Student::whereIn('id', $id)->Delete();
            }
            toastr()->success(trans('messages.success'));
            return redirect()->route('graduated.index');
        }
    }


    public function restore($request)
    {
        student::onlyTrashed()->where('id', $request->id)
            ->first()->restore();

        toastr()->success(trans('messages.success'));
        return redirect()->back();
    }




    public function destroy($request)
    {
        Student::onlyTrashed()->where('id', $request->id)->first()->forceDelete();
        toastr()->error(trans('messages.Delete'));
        return redirect()->back();
    }
}

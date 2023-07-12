<?php

namespace App\Repository\Subject;

use Exception;
use App\Models\Grade;
use App\Models\Section;
use App\Models\Teacher;
use App\Models\Classroom;
use App\Models\Subject;

class SubjectRepository implements SubjectRepositoryInterface
{

  public function  index()
  {

    $subjects = Subject::all();
    return view('pages.Subject.index', compact('subjects'));
  }


  public function edit($id)
  {
    $subject = Subject::findOrFail($id);
    $grades = Grade::all();
    $teachers = Teacher::all();
    return view('pages.Subject.edit', compact('subject', 'grades', 'teachers'));
  }


  public function update($request)
  {
    try {

      $request->validate([
        'name'         => 'required',
        'Grade_id'     => 'required',
        'Classroom_id' => 'required',
        'teacher_id'   => 'required'

      ], [
        'name.required' => 'name of subject is required',
        'Grade_id.required' => 'grade is required',
        'Classroom_id.required' => 'class is required',
        'teacher_id.required' => 'teacher name is required'
      ]);

      $subject = Subject::findOrFail($request->id);
      $subject->update([
        'name'         => $request->name,
        'grade_id'     => $request->Grade_id,
        'classroom_id' => $request->Classroom_id,
        'teacher_id'   => $request->teacher_id
      ]);

      toastr()->success(trans('messages.success'));
      return redirect()->route('subjects.index');
    } catch (\Exception $e) {
      return redirect()->back()->with(['error' => $e->getMessage()]);
    }
  }

  public function create()
  {
    $grades = Grade::all();
    $teachers = Teacher::all();
    return view('pages.Subject.create', compact('grades', 'teachers'));
  }

  public function store($request)
  {
    try {

      $request->validate([
        'name'         => 'required',
        'Grade_id'     => 'required',
        'Classroom_id' => 'required',
        'teacher_id'   => 'required'

      ], [
        'name.required' => 'name of subject is required',
        'Grade_id.required' => 'grade is required',
        'Classroom_id.required' => 'class is required',
        'teacher_id.required' => 'teacher name is required'
      ]);

      Subject::create([
        'name'         => $request->name,
        'grade_id'     => $request->Grade_id,
        'classroom_id' => $request->Classroom_id,
        'teacher_id'   => $request->teacher_id
      ]);

      toastr()->success(trans('messages.success'));
      return redirect()->route('subjects.index');
    } catch (\Exception $e) {
      return redirect()->back()->with(['error' => $e->getMessage()]);
    }
  }

  public function delete($id)
  {
    Subject::findOrFail($id)->delete();
    toastr()->success(trans('messages.Delete'));
    return redirect()->route('subjects.index');
  }
}

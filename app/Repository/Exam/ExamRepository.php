<?php

namespace App\Repository\Exam;
use App\Models\Exam;

class ExamRepository implements ExamRepositoryInterface
{

  public function  index()
  {

    $exams = Exam::all();
    return view('pages.Exams.index', compact('exams'));
  }


  public function edit($id)
  {
    $exam = Exam::findOrFail($id);
    return view('pages.Exams.edit', compact('exam'));
  }


  public function update($request)
  {
    try {

      $request->validate([
        'name'          => 'required',
        'term'          => 'required',
        'academic_year' => 'required',

      ], [
        'name.required' => 'name of subject is required',
        'term.required' => 'term is required',
        'academic_year.required' => 'academic year is required',
      ]);

      $exam = Exam::findOrFail($request->id);
      $exam->update([
        'name'         => $request->name,
        'term'     => $request->term,
        'academic_year' => $request->academic_year,
      ]);

      toastr()->success(trans('messages.success'));
      return redirect()->route('exams.index');
    } catch (\Exception $e) {
      return redirect()->back()->with(['error' => $e->getMessage()]);
    }
  }

  public function create()
  {
    return view('pages.Exams.create');
  }

  public function store($request)
  {
    try {

      $request->validate([
        'name'          => 'required',
        'term'          => 'required',
        'academic_year' => 'required',

      ], [
        'name.required' => 'name of subject is required',
        'term.required' => 'term is required',
        'academic_year.required' => 'academic year is required',
      ]);

      Exam::create([
        'name'          => $request->name,
        'term'          => $request->term,
        'academic_year' => $request->academic_year,
      ]);


      toastr()->success(trans('messages.success'));
      return redirect()->route('exams.index');
    } catch (\Exception $e) {
      return redirect()->back()->with(['error' => $e->getMessage()]);
    }
  }

  public function delete($request)
  {
    Exam::findOrFail($request)->delete();
    toastr()->success(trans('messages.Delete'));
    return redirect()->route('exams.index');
  }
}

<?php

namespace App\Repository\Question;

use App\Models\Quiz;
use App\Models\Grade;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\Question;

class QuestionRepository implements QuestionRepositoryInterface
{

  public function  index()
  {
    $questions = Question::all();
    return view('pages.Questions.index', compact('questions'));
  }

  public function  show($id)
  {
    $quiz = Quiz::findOrFail($id);
    return view('pages.Questions.create', compact('quiz'));
  }

  public function edit($id)
  {
    $data['quiz'] = Quiz::findOrFail($id);
    $data['grades']   = Grade::all();
    $data['subjects'] = Subject::all();
    $data['teachers'] = Teacher::all();

    return view('pages.quizzes.edit', $data);
  }


  public function update($request)
  {
    try {
      $request->validate([
        'name'          => 'required',
        'subject_id'    => 'required',
        'Grade_id'      => 'required',
        'Classroom_id'  => 'required',
        'section_id'    => 'required',
        'teacher_id'    => 'required'
      ], [
        'name.required'          => 'name of subject is required',
        'term.required'          => 'term is required',
        'academic_year.required' => 'academic year is required',
        'Classroom_id.required'  => 'class is required',
        'section_id.required'    => 'section is required',
        'teacher_id.required'    => 'teacher is required',

      ]);

      $quiz = Quiz::findOrFail($request->id);
      $quiz->update([
        'name'          => $request->name,
        'subject_id'    => $request->subject_id,
        'grade_id'      => $request->Grade_id,
        'classroom_id'  => $request->Classroom_id,
        'section_id'    => $request->section_id,
        'teacher_id'    => $request->teacher_id,
      ]);

      toastr()->success(trans('messages.success'));
      return redirect()->route('quiz.index');
    } catch (\Exception $e) {
      return redirect()->back()->with(['error' => $e->getMessage()]);
    }
  }

  public function create($id)
  {
    $quiz = Quiz::findOrFail($id);
    return view('pages.Questions.create', compact('quiz'));
  }

  
  public function store($request)
  {
    try {
      $request->validate([
        'title'         => 'required',
        'answers'       => 'required',
        'right_answer'  => 'required',
        'score'         => 'required',
        'quiz_id'       => 'required',
      ], [
        'title.required'        => 'name of subject is required',
        'answers.required'      => 'answers is required',
        'right_answer.required' => 'right_answer is required',
        'score.required'        => 'score is required',
        'quiz_id.required'      => 'quiz_id is required',

      ]);

      $answers = implode(" ",$request->answers);

      Question::create([
        'title'          => $request->title,
        'answers'    => $answers,
        'right_answer'      => $request->right_answer,
        'score'  => $request->score,
        'quiz_id'    => $request->quiz_id,
      ]);

      toastr()->success(trans('messages.success'));
      return redirect()->route('quiz.show',$request->quiz_id);
    } catch (\Exception $e) {
      return redirect()->back()->with(['error' => $e->getMessage()]);
    }
  }

  public function delete($request)
  {
    Quiz::findOrFail($request)->delete();
    toastr()->success(trans('messages.Delete'));
    return redirect()->route('quiz.index');
  }
}

<?php

namespace App\Http\Controllers\Grades;

use toastr;
use App\Models\Grade;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Classroom;

class GradeController extends Controller
{

  public function index()
  {
    $grades = Grade::all();
    return view('pages.grades', compact('grades'));
  }


  public function store(Request $request)
  {
    if(Grade::where('name->en', $request->en_name)->orWhere('name->ar', $request->ar_name)->exists()){
      return redirect()->back()->withError(trans('Grades_trans.exists'));
    }

    try {
      // return $request;
      $request->validate([
        'en_name' => 'required',
        'ar_name' => 'required',
        'notes' => 'required'

      ], [
        'en_name.required' => trans('validation.required'),
        'ar_name.required' => trans('validation.required'),

      ]);


      Grade::create([
        'name' => [
          'en' => $request->en_name,
          'ar' => $request->ar_name
        ],
        'notes' => $request->notes
      ]);
      toastr()->success(trans('Messages.success'), ' ', ['timeOut' => 5000]);

      return redirect()->back();
    } catch (\Exception $e) {
      return redirect()->back()->withError(['error' => $e->getMessage()]);
    }
  }


  public function show($id)
  {
  }

  public function update(Request $request, $id)
  {
    if(Grade::where('name->en',$request->en_name)->Where('name->ar', $request->ar_name)->exists()){
      return redirect()->back()->withError(trans('Grades_trans.exists'));
    }
    try {
      $request->validate(
        [
          'en_name' => 'required',
          'ar_name' => 'required',
        ],
        [
          'en_name.required' => trans('validation.required'),
          'ar_name.required' => trans('validation.required')

        ]
      );
      //return $request;

      $grade = Grade::findOrFail($id);
      $grade->update([
        'name' => [
          'en' => $request->en_name,
          'ar' => $request->ar_name
        ],
        'notes' => $request->notes
      ]);
      return redirect()->back()->with('success', 'grade was updated');
    } catch (\Exception $e) {
      return redirect()->back()->withError(['error' => $e->getMessage()]);
    }
  }


  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy($id)
  {
    $grade = Grade::findOrFail($id);
    $class = Classroom::where('grade_id',$grade->id)->pluck('id');
    if(count($class)== 0){
      $grade->delete();
      return redirect()->back()->with('success', 'grade was deleted');
    }else{
      toastr()->error(trans('Grades_trans.delete_Grade_Error'), ' ', ['timeOut' => 5000]);
      return redirect()->back();
    }

  }
}

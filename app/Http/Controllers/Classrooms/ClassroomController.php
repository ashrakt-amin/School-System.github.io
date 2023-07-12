<?php

namespace App\Http\Controllers\Classrooms;

use App\Models\Grade;
use App\Models\Classroom;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ClassroomController extends Controller
{

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
    $classes = Classroom::all();
    $grades = Grade::all();
    return view('pages.classrooms', compact('classes', 'grades'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {
  }

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store(Request $request)
  {

    try {

      $request->validate([
        'List_Classes.*.ar_name' => 'required|unique:classrooms,class_name->ar',
        'List_Classes.*.en_name' => 'required|unique:classrooms,class_name->en',
        'List_Classes.*.grade_id' => 'required'
      ], [
        'en_name.required' => trans('validation.required'),
        'ar_name.required' => trans('validation.required'),
        'en_name.unique' => trans('validation.unique'),
        'en_name.unique' => trans('validation.unique'),


      ]);

        Classroom::create([
          'class_name' => [
            'ar' => $request->ar_name,
            'en' => $request->en_name
          ],
          'grade_id' => $request->grade_id
        ]);
      
      toastr()->success(trans('Messages.success'), ' ', ['timeOut' => 5000]);

      return redirect()->back();
    } catch (\Exception $e) {
      return redirect()->back()->withError(['error' => $e->getMessage()]);
    }
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function show($id)
  {
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function edit($id)
  {
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function update(Request $request, $id)
  {
    try {
      $class = Classroom::findOrFail($id);
      // return $request;

      $request->validate([
        'en_name' => ['required'],
        'ar_name' => ['required'],
        'grade_id' => 'required'
      ], [
        'en_name.required' => trans('validation.required'),
        'ar_name.required' => trans('validation.required'),
        'en_name.unique' => trans('validation.unique'),
        'en_name.unique' => trans('validation.unique'),


      ]);

      $class->update([
        'class_name' => [
          'ar' => $request['ar_name'],
          'en' => $request['en_name']
        ],
        'grade_id' => $request['grade_id']
      ]);
      toastr()->success(trans('Messages.success'), ' ', ['timeOut' => 5000]);

      return redirect()->back();
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
    $class = Classroom::findOrFail($id);

    $class->delete();
    toastr()->error(trans('Messages.error'), ' ', ['timeOut' => 5000]);

    return redirect()->back();
  }

  public function delete(Request $request)
  {
    // return $request;
    $elements = explode(',', $request->delete_all_id);
    Classroom::whereIn('id', $elements)->delete();
    toastr()->error(trans('Classes_trans.delete_checkbox'), ' ', ['timeOut' => 5000]);

    return redirect()->back();
  }

  public function filter(Request $request)
  {
    // return $request;
    $grades = Grade::all();
    $classes = Classroom::select('*')->where('grade_id', $request->grade_id)->get();

    return view('pages.classrooms', compact('classes', 'grades'));
  }

  public function classes($id)
  {
    $classes = Classroom::where('grade_id',"=",$id)->pluck('class_name','id');
    return $classes ;
  }
}

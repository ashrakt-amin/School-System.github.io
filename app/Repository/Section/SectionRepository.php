<?php

namespace App\Repository\Section;

use Exception;
use App\Models\Grade;
use App\Models\Gender;
use App\Models\Section;
use App\Models\Teacher;
use App\Models\Classroom;
use App\Models\Specialization;
use Illuminate\Support\Facades\Hash;

class SectionRepository implements SectionRepositoryInterface
{
   
  public function  index()
    {

        $sections = Section::with(['grade', 'class'])->get();
        $grades = Grade::with('sections')->get();
        $classes = Classroom::all();
        $teachers = Teacher::all();

        return view('pages.Sections.index', compact('sections', 'grades', 'classes', 'teachers'));
    }


    public function edit($id)
    {

        return Teacher::findOrFail($id);
    }

    public function GetGender()
    {

        return Gender::all();
    }


    public function update($request ,$id)
    {
        // dd($request);
        $section = Section::findOrFail($id);
        // return $section;
    
        try {
          $request->validate([
            'en_name' => 'required',
            'ar_name' => 'required',
            'Grade_id' => 'required',
            'Class_id'=> 'required'
    
          ], [
            'en_name.required' => trans('validation.required'),
            'ar_name.required' => trans('validation.required'),
    
          ]);
          if(isset($request->status)){
            $status = "1" ;
          }else{
            $status = "0" ;
    
          }
          
         //   return $request;

          $section->update([
            'name' => [
              'en' => $request->en_name,
              'ar' => $request->ar_name
            ],
            'status'=>$status,
            'grade_id' => $request->Grade_id,
            'class_id' =>$request->Class_id
          ]);

         // $section->teachers()->sync($request->teacher_id);

          
          toastr()->success(trans('Messages.success'), ' ', ['timeOut' => 5000]);
    
          return redirect()->back();
        } catch (\Exception $e) {
          return redirect()->back()->withError(['error' => $e->getMessage()]);
        }
    }

    public function Getspecialization()
    {

        return Specialization::all();
    }


    public function store($request)
    {
        try {
            // return $request;
            $request->validate([
                'en_name'  => 'required',
                'ar_name'  => 'required',
                'Grade_id' => 'required',
                'Classroom_id' => 'required'

            ], [
                'en_name.required' => trans('validation.required'),
                'ar_name.required' => trans('validation.required'),

            ]);


            $section = Section::create([
                'name' => [
                    'en' => $request->en_name,
                    'ar' => $request->ar_name
                ],
                'status' => 1,
                'grade_id' => $request->Grade_id,
                'class_id' => $request->Classroom_id
            ]);

            $section->teachers()->attach($request->teacher_id);
            toastr()->success(trans('Messages.success'), ' ', ['timeOut' => 5000]);

            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->withError(['error' => $e->getMessage()]);
        }
    }

    public function delete($id)
    {

        $section = Section::findOrFail($id);
        $section->teachers()->detach();
        $section->delete();
        toastr()->success(trans('messages.Delete'));
        return redirect()->back();
    }
}

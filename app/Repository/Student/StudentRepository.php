<?php

namespace App\Repository\Student;

use Exception;
use App\Models\Grade;
use App\Models\Gender;
use App\Models\Section;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\MyParent;
use App\Models\Classroom;
use App\Models\Image;
use App\Models\TypeBlood;
use App\Models\Nationalitie;
use App\Models\Specialization;
use App\Models\StudentAccount;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class StudentRepository implements StudentRepositoryInterface
{

  public function  index()
  {

    $data['sections'] = Section::with(['grade', 'class'])->get();
    $data['grades']   = Grade::with('sections')->get();
    $data['classes']  = Classroom::all();
    $data['teachers'] = Teacher::all();
    $data['students']  = Student::all();


    return view('pages.Students.index', $data);
  }


  public function Create()
  {

    $data['grades'] = Grade::all();
    $data['parents'] = MyParent::all();
    $data['Genders'] = Gender::all();
    $data['nationals'] = Nationalitie::all();
    $data['bloods'] = TypeBlood::all();

    return view('pages.Students.create', $data);
  }


  public function store($request)
  {

    DB::beginTransaction();

    try {
  
      $student = new Student();
      $student->name = [
          'en' => $request->name_en,
          'ar' => $request->name_ar
      ];
      $student->email = $request->email;
      $student->password = Hash::make($request->password);
      $student->gender_id = $request->gender_id;
      $student->nationalitie_id = $request->nationalitie_id;
      $student->blood_id = $request->blood_id;
      $student->Date_Birth = $request->Date_Birth;
      $student->Grade_id = $request->Grade_id;
      $student->Classroom_id = $request->Classroom_id;
      $student->section_id = $request->section_id;
      $student->parent_id = $request->parent_id;
      $student->gender_id = $request->gender_id;
      $student->academic_year = $request->academic_year;
      $student->save();

      if($request->hasfile('photos')){
        foreach($request->file('photos') as $file){
          $name = $file->getClientOriginalName();
          $file->storeAs("Attachments/students/".$student->name,$name,"attachments");

          $image = new Image();
          $image->body           = $name;
          $image->imageable_id	   =$student->id;
          $image->imageable_type	  ="App\Models\Student";
          $image->save();
          
        }
      }

      DB::commit();
      toastr()->success(trans('messages.success'));
      return redirect()->route('student.index');
    } catch (\Exception $e) {
      DB::rollback();  
      return redirect()->back()->withErrors(['error' => $e->getMessage()]);
    }
  }


  public function Upload_attachment($request){
   
      foreach($request->file('photos') as $file){
        $name = $file->getClientOriginalName();
        $file->storeAs("Attachments/students/".$request->student_name,$name,"attachments");

        $image = new Image();
        $image->body           = $name;
        $image->imageable_id   =$request->student_id;
        $image->imageable_type  ="App\Models\Student";
        $image->save();   
    }
    toastr()->success(trans('messages.success'));
    return redirect()->route('student.show',$request->student_id);

  }

  public function Download_attachment($student_name , $file){
    return response()->download(public_path("Attachments/students/".$student_name."/" .$file));

  }

  public function Delete_attachment($request){
    Storage::disk("attachments")->delete("Attachments/students/".$request->student_name."/".$request->filename);
    Image::where('imageable_id',$request->student_id)->where('body',$request->filename)->delete();
    toastr()->error(trans('messages.Delete'));
    return redirect()->route('student.show',$request->student_id);
  }


  public function show($id){
   $data['Student'] = Student::findOrFail($id);
   $data['debit'] = StudentAccount::where('student_id',$data['Student']->id)->sum('Debit');
   $data['credit'] = StudentAccount::where('student_id',$data['Student']->id)->sum('credit');
   $data['rest'] = ($data['debit'] - $data['credit'] );

   return view('pages.Students.show',$data);

  }


  public function classrooms($id)
  {

    $classes = Classroom::where("grade_id", $id)->pluck("class_name", "id");
    return $classes;
  }



  public function sections($id)
  {

    $list_sections  = Section::where("class_id", $id)->pluck("name", "id");
    return $list_sections;
  }


  public function GetGender()
  {

    return Gender::all();
  }




  public function edit($id)
  {
    $student = Student::findOrFail($id);
    $data['grades']   = Grade::all();
    $data['parents']  = MyParent::all();
    $data['Genders']  = Gender::all();
    $data['nationals']= Nationalitie::all();
    $data['bloods']   = TypeBlood::all();
    $data['classes']   = Classroom::all();
    $data['sections']   = Section::all();


    return view('pages.Students.edit', $data, compact('student'));
  }


  public function update($request,$id)
  {
    // dd($request);
    $student = Student::findOrFail($id);

    DB::beginTransaction();

    try {
      $student->update([
        'name' => [
          'en' => $request->en_name,
          'ar' => $request->ar_name
        ],
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'gender_id' => $request->gender_id,
        'nationalitie_id' => $request->nationalitie_id,
        'blood_id' => $request->blood_id,
        'Date_Birth' => $request->Date_Birth,
        'Grade_id' => $request->Grade_id,
        'Classroom_id' => $request->Classroom_id,
        'section_id' => $request->section_id,
        'parent_id' => $request->parent_id,
        'gender_id' => $request->gender_id,
        'academic_year' => $request->academic_year,

      ]);

      DB::commit();
      toastr()->success(trans('Messages.success'), ' ', ['timeOut' => 5000]);

      return redirect()->route('student.index');

    } catch (\Exception $e) {
      DB::rollback();  
      return redirect()->back()->withError(['error' => $e->getMessage()]);
    }
  }

  public function Getspecialization()
  {

    return Specialization::all();
  }


  public function delete($request)
  {
    $student = Student::findOrFail($request->id);
    $student->delete();
    toastr()->success(trans('messages.Delete'));
    return redirect()->back();
  }

  
}

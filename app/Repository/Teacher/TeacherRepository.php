<?php
namespace App\Repository\Teacher;

use Exception;
use App\Models\Gender;
use App\Models\Teacher;
use App\Models\Specialization;
use Illuminate\Support\Facades\Hash;
use App\Repository\Teacher\TeacherRepositoryInterface;

class TeacherRepository implements TeacherRepositoryInterface {

    public function  getAllTeachers(){
        return Teacher::with('genders','specializations')->get();

    }


    public function edit($id){

        return Teacher::findOrFail($id);

    }

    public function GetGender(){

        return Gender::all();

    }
    

    public function update($request){
        // dd($request);
        try{

            $teachers = Teacher::findOrFail($request->id);
            $teachers->email    = $request->Email;
            $teachers->password = Hash::make($request->Password);
            $teachers->Name     = ['en'=>$request->Name_en , 'ar'=>$request->Name_ar ];
            $teachers->Specialization_id = $request->Specialization_id;
            $teachers->Gender_id = $request->Gender_id;
            $teachers->Joining_Date = $request->Joining_Date;
            $teachers->Address = $request->Address;
            $teachers->update();

            toastr()->success(trans('messages.Update'));
            return redirect()->route('Teachers.index');

        }catch(Exception $e){

            return redirect()->back()->with(['error' => $e->getMessage()]);
            
        }

    }

    public function Getspecialization(){

        return Specialization::all();


    }


    public function store($request){
        try{
            $teachers = new Teacher();
            $teachers->email    = $request->Email;
            $teachers->password = Hash::make($request->Password);
            $teachers->Name     = ['en'=>$request->Name_en , 'ar'=>$request->Name_ar ];
            $teachers->Specialization_id = $request->Specialization_id;
            $teachers->Gender_id = $request->Gender_id;
            $teachers->Joining_Date = $request->Joining_Date;
            $teachers->Address = $request->Address;

            $teachers->save();
           
            toastr()->success(trans('messages.success'));
            return redirect()->route('Teachers.index');


        }catch(Exception $e){

            return redirect()->back()->with(['error' => $e->getMessage()]);

        }

    }

    public function delete($id){
         
       $teacher = Teacher::findOrFail($id)->delete();
       toastr()->success(trans('messages.Delete'));
       return redirect()->route('Teachers.index');



    }


}

<?php

namespace App\Repository\Fees;

use App\Models\Fee;
use App\Models\Grade;
use App\Models\Student;
use App\Repository\Graduated\FeesRepositoryInterface;

class FeesRepository implements FeesRepositoryInterface
{

    public function index()
    {
        $fees = Fee::onlyTrashed()->get();
        return view('pages.fees.index', compact('fees'));
    }



    public function create()
    {
        $Grades = Grade::all();
        return view('pages.fees.create', compact('Grades'));
    }



    public function store($request)
    {
       
    }


    public function edit($request)
    {
        $fee = Fee::findOrFail('id', $request->id);
        $fee->update([
            'title'   =>$request->title,
            'amount'  =>$request->amount,
            'Grade_id'  =>$request->Grade_id,
            'Classroom_id'  =>$request->Classroom_id,
            'year'  =>$request->year,
            'description'  =>$request->description,
            'type_id'  =>$request->type_id,
        ]);

        toastr()->success(trans('messages.success'));
        return redirect()->back();
    }



    public function update($request)
    {
        Student::onlyTrashed()->where('id', $request->id)
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

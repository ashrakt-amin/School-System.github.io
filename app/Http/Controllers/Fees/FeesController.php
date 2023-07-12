<?php

namespace App\Http\Controllers\Fees;

use App\Models\Fee;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Classroom;
use App\Models\feeType;
use App\Models\Grade;

class FeesController extends Controller
{

    public function index()
    {
        $fees = Fee::with(['grade','type','class'])->get();
        return view('pages.fees.index', compact('fees'));
    }

    public function create()
    {
        $Grades = Grade::all();
        $types = feeType::all();
        return view('pages.fees.create', compact('Grades','types'));
    }


    public function store(Request $request)
    {
        try {

            $fee = Fee::where('Grade_id', $request->Grade_id)
                ->where('Classroom_id', $request->Classroom_id)
                ->where('type_id', $request->type_id)
                ->where('year', $request->year)
                ->get();

            if (count($fee) < 1) {
                Fee::create([
                    'title'        => $request->title,
                    'amount'       => $request->amount,
                    'Grade_id'     => $request->Grade_id,
                    'Classroom_id' => $request->Classroom_id,
                    'year'         => $request->year,
                    'description'  => $request->description,
                    'type_id'      => $request->type_id
                ]);


                toastr()->success(trans('Messages.success'), ' ', ['timeOut' => 5000]);
                return redirect()->route('Fees.index');
            } else {
                return redirect()->back()->with('error', 'this fees for the grade and class already exists');
            }
        } catch (\Exception $e) {
            return redirect()->back()->withError(['error' => $e->getMessage()]);
        }
    }


    public function show($id)
    {
        //
    }



    public function edit($id)
    {
        $fee = Fee::findOrFail($id);
        $Grades = Grade::all();
        $types = feeType::all(); 
        $classes = Classroom::where('grade_id', $fee->Grade_id)->get();

        return view('pages.fees.edit', compact('fee', 'Grades', 'classes','types'));
    }



    public function update(Request $request)
    {
        $feeData = Fee::findOrFail($request->id);

        try {
            $fee = Fee::where('Grade_id', $request->Grade_id)
                ->where('Classroom_id', $request->Classroom_id)
                ->where('type_id', $request->type_id)
                ->where('year', $request->year)
                ->get();
            if (count($fee) == 1 && ($feeData = $fee)) {
                $feeData->update($request->all());
                toastr()->success(trans('Messages.success'), ' ', ['timeOut' => 5000]);
                return redirect()->route('Fees.index');
            } elseif (count($fee) < 1) {
                $feeData->update($request->all());
                toastr()->success(trans('Messages.success'), ' ', ['timeOut' => 5000]);
                return redirect()->route('Fees.index');
            }
        } catch (\Exception $e) {
            return redirect()->back()->withError(['error' => $e->getMessage()]);
        }
    }


    public function destroy(Request $request)
    {
        try {
            $fees = Fee::findOrFail($request->id);
            $fees->delete();

            toastr()->success(trans('Messages.success'), ' ', ['timeOut' => 5000]);
            return redirect()->route('Fees.index');
        } catch (\Exception $e) {
            return redirect()->back()->withError(['error' => $e->getMessage()]);
        }
    }
}

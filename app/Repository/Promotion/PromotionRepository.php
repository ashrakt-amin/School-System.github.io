<?php

namespace App\Repository\Promotion;

use Exception;
use App\Models\Grade;
use App\Models\Student;
use App\Models\Promotion;
use Illuminate\Support\Facades\DB;
use App\Repository\Promotion\PromotionRepositoryInterface;

class PromotionRepository implements PromotionRepositoryInterface
{

    public function index()
    {
        $Grades = Grade::all();
        $promotions = Promotion::all();
        return view('pages.promotions.index', compact('Grades', 'promotions'));
    }



    public function create()
    {
        $Grades = Grade::all();
        return view('pages.promotions.create', compact('Grades'));
    }



    public function store($request)
    {
        DB::beginTransaction();
        try {
            $students = Student::where('Grade_id', $request->Grade_id)
                ->where('Classroom_id', $request->Classroom_id)
                ->where('section_id', $request->section_id)
                ->where('academic_year', $request->academic_year)
                ->get();

            if (count($students) < 1) {
                return redirect()->back()->with('error_promotions', ('no data in student table'));
            } else {
                foreach ($students as $student) {

                    $id = explode(',', $student->id);
                    $student->whereIn('id', $id)
                        ->update([
                            'Grade_id'      => $request->Grade_id_new,
                            'Classroom_id'  => $request->Classroom_id_new,
                            'section_id'    => $request->section_id_new,
                            'academic_year' => $request->academic_year_new
                        ]);

                    Promotion::updateOrCreate([
                        'student_id' => $student->id,
                        'from_grade' => $student->Grade_id,
                        'from_Classroom' => $student->Classroom_id,
                        'from_section' => $student->section_id,
                        'to_grade' => $request->Grade_id_new,
                        'to_Classroom' => $request->Classroom_id_new,
                        'to_section' => $request->section_id_new,
                        'academic_year' => $request->academic_year,
                        'academic_year_new' => $request->academic_year_new,
                    ]);
                }
            }
            DB::commit();
            toastr()->success(trans('messages.success'));
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }




    public function destroy($request)
    {
        DB::beginTransaction();
        try {
            if ($request->page_id == 1) {
                //return $request->page_id;
                $promotions = Promotion::all();
                foreach ($promotions as $promotion) {
                    $id = explode(',', $promotion->student_id);
                    Student::whereIn('id', $id)->update([
                        'Grade_id'      => $promotion->from_grade,
                        'Classroom_id'  => $promotion->from_Classroom,
                        'section_id'    => $promotion->from_section,
                        'academic_year' => $promotion->academic_year_new
                    ]);
                } //end foreach
                Promotion::truncate();
                DB::commit();
                toastr()->success(trans('messages.success'));
                return redirect()->back();
            } else {
                $promotion = Promotion::findOrFail($request->id);
                Student::where('id', $promotion->student_id)
                    ->update([
                        'Grade_id'      => $promotion->to_grade,
                        'Classroom_id'  => $promotion->to_grade,
                        'section_id'    => $promotion->to_grade,
                        'academic_year' => $promotion->academic_year
                    ]);
                Promotion::destroy($request->id);
                DB::commit();
                toastr()->success(trans('messages.success'));
                return redirect()->back();
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors([
                'error' => $e->getMessage()
            ]);
        }
    }
}

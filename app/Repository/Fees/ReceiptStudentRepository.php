<?php

namespace App\Repository\Fees;

use App\Models\Fee;
use App\Models\Student;
use App\Models\Fee_invoice;
use App\Models\FundAccount;
use App\Models\ReceiptStudent;
use App\Models\StudentAccount;
use Illuminate\Support\Facades\DB;

class ReceiptStudentRepository implements ReceiptStudentRepositoryInterface
{

    public function index()
    {
        $receipt_students = ReceiptStudent::all();
        return view('pages.receipt.index', compact('receipt_students'));
    }


    public function show($id)
    {
        $student = Student::findOrFail($id);
        $receipt_students = ReceiptStudent::where('student_id', $student->id)->get();
        return view('pages.receipt.add', compact('student', 'receipt_students'));
    }


    public function store($request)
    {
        try {

            DB::beginTransaction();

            $receipt_student =  ReceiptStudent::create([
                'date'         => date('Y-m-d'),
                'student_id'   => $request->student_id,
                'debit'        => $request->Debit,
                'description'  => $request->description,
            ]);

            FundAccount::create([
                'date'         => date('Y-m-d'),
                'receipt_id'   => $receipt_student->id,
                'Debit'        => $request->Debit,
                'credit'       => 0.00,
                'description'  => $request->description
            ]);


            StudentAccount::create([

                'date'            => date('Y-m-d'),
                'type'            => 'receipt',
                'receipt_id'      => $receipt_student->id,
                'student_id'      => $receipt_student->student_id,
                'Debit'           => 0.00,
                'credit'          => $request->Debit,
                'description'     => $request->description,

            ]);

            DB::commit();
            toastr()->success(trans('messages.success'));
            return redirect()->route('receipt_students.index');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }



    public function edit($id)
    {
        $receipt_student =  ReceiptStudent::findOrFail($id);
        return view('pages.receipt.edit', compact('receipt_student'));
    }



    public function update($request)
    {
        try {
            DB::beginTransaction();
            $receipt_student =  ReceiptStudent::findOrFail($request->id);
            $receipt_student->update([
                'date'         => date('Y-m-d'),
                'student_id'   => $request->student_id,
                'debit'        => $request->Debit,
                'description'  => $request->description,
            ]);

            $FundAccount = FundAccount::where('receipt_id', $receipt_student->id)->first();
            $FundAccount->update([
                'date'         => date('Y-m-d'),
                'receipt_id'   => $receipt_student->id,
                'Debit'        => $request->Debit,
                'credit'       => 0.00,
                'description'  => $request->description
            ]);


            $FundAccount = StudentAccount::where('receipt_id', $receipt_student->id)->first();
            $FundAccount->update([
                'date'            => date('Y-m-d'),
                'type'            => 'receipt',
                'receipt_id'      => $receipt_student->id,
                'student_id'      => $receipt_student->student_id,
                'Debit'           => 0.00,
                'credit'          => $request->Debit,
                'description'     => $request->description,

            ]);

            DB::commit();
            toastr()->success(trans('messages.success'));
            return redirect()->route('Fees_Invoices.index');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }




    public function destroy($request)
    {
        $receipt_student =  ReceiptStudent::findOrFail($request->id);
        FundAccount::where('receipt_id', $receipt_student->id)->delete();
        StudentAccount::where('receipt_id', $receipt_student->id)->delete();
        $receipt_student->delete();
        toastr()->success(trans('messages.Delete'));
        return redirect()->back();
    }
}

<?php

namespace App\Repository\Fees;

use App\Models\Fee;
use App\Models\feeType;
use App\Models\Student;
use App\Models\Fee_invoice;
use App\Models\StudentAccount;
use Illuminate\Support\Facades\DB;
use App\Repository\Fees\FeeInvoicesRepositoryInterface;

class FeeInvoicesRepository implements FeeInvoicesRepositoryInterface
{

    public function index()
    {
        $Fee_invoices = Fee_invoice::all();
        return view('pages.fees_invoices.index', compact('Fee_invoices'));
    }


    public function show($id)
    {
        $student = Student::findOrFail($id);
        $fees = Fee::where('Grade_id', $student->Grade_id)
            ->where('Classroom_id', $student->Classroom_id)->get();
        return view('pages.fees_invoices.add', compact('student', 'fees'));
    }


    public function create()
    {
        return view('pages.fees.create', compact('Grades', 'types'));
    }


    public function store($request)
    {
        try {

            DB::beginTransaction();
           $Fee_invoice =  Fee_invoice::create([
                'invoice_date' => date('Y-m-d'),
                'student_id'   => $request->student_id,
                'Grade_id'     => $request->Grade_id,
                'Classroom_id' => $request->Classroom_id,
                'fee_id'       => $request->fee_id,
                'amount'       => $request->amount,
                'description'  => $request->description
            ]);

            StudentAccount::create([
                'date'         => date('Y-m-d'),
                'student_id'   => $request->student_id,
                'type'         => 'invoice',
                'fee_invoice_id' =>$Fee_invoice->id,
                'Debit'        => $request->amount,
                'credit'       => 0.00,
                'description'  => $request->description
            ]);
            DB::commit();
            toastr()->success(trans('messages.success'));
            return redirect()->route('Fees_Invoices.index');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }



    public function edit($request)
    {
        $fee_invoices = Fee_invoice::findOrFail($request);
        $fees = Fee::where('Classroom_id', $fee_invoices->Classroom_id)->get();
        return view('pages.fees_invoices.edit', compact('fee_invoices', 'fees'));
    }



    public function update($request)
    {
        // return $request;
        try {
            DB::beginTransaction();
            $Fee_invoice = Fee_invoice::findOrFail($request->id);
            $stuent = StudentAccount::findOrFail($request->student_id);
            $fee = Fee::findOrFail($request->fee_id);

            $Fee_invoice->update([
                'fee_id'       => $request->fee_id,
                'amount'       => $request->amount,
                'description'  => $request->description
            ]);

            if ($request->amount != null) {
                $stuent->update([
                    'Debit'        => $request->amount,
                ]);

                $fee->update([
                    'amount'        => $request->amount,
                ]);
            }
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
        Fee_invoice::findOrFail($request->id)->delete();
        toastr()->success(trans('messages.Delete'));
        return redirect()->back();
    }
}

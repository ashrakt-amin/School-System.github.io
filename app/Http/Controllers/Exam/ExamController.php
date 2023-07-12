<?php

namespace App\Http\Controllers\Exam;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repository\Exam\ExamRepositoryInterface;

class ExamController extends Controller
{
    protected $exam ;

    public function __construct(ExamRepositoryInterface $exam)
    {
        $this->exam = $exam;
    }
   
    public function index()
    {
        return $this->exam->index();

    }

   
    public function create()
    {
        return $this->exam->create();

    }

   
    public function store(Request $request)
    {
        return $this->exam->store($request);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        return $this->exam->edit($id);

    }

    
    public function update(Request $request,$id)
    {

        return $this->exam->update($request);

    }

    
    public function destroy(Request $request)
    {
        return $this->exam->delete($request->id);

    }
}

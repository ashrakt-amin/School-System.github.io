<?php

namespace App\Http\Controllers\Quiz;

use App\Models\Quiz;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repository\Quiz\QuizRepositoryInterface;

class QuizController extends Controller
{
    protected $quiz ;

    public function __construct(QuizRepositoryInterface $quiz)
    {
        $this->quiz = $quiz;
    }
   
    public function index()
    {
        return $this->quiz->index();

    }

   
    public function create()
    {
        return $this->quiz->create();

    }

   
    public function store(Request $request)
    {
        return $this->quiz->store($request);
    }

    public function show($id)
    {
        
        return $this->quiz->show($id);
    }

    public function edit($id)
    {
        return $this->quiz->edit($id);

    }

    
    public function update(Request $request,$id)
    {
        return $this->quiz->update($request);

    }

    
    public function destroy(Request $request)
    {
        return $this->quiz->delete($request->id);

    }
}

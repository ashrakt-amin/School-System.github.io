<?php

namespace App\Http\Controllers\Question;

use App\Models\Question;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repository\Question\QuestionRepositoryInterface;

class QuestionController extends Controller
{
    protected $question ;

    public function __construct(QuestionRepositoryInterface $question)
    {
        $this->question = $question;
    }
   

    public function index()
    {
        return $this->question->index();
    }

    
    public function show($id)
    {
        return $this->question->show($id);

    }
   
    public function createQuestion($id)
    {
        
        return $this->question->create($id);

    }

    
    public function store(Request $request)
    {
        // return $request;
        return $this->question->store($request);

    }



    public function edit($id)
    {
        return $this->question->edit($id);
    }


    public function update(Request $request, $id)
    {
        return $this->question->update($request);

    }

    public function destroy($request)
    {
        return $this->question->update($request);

    }
}

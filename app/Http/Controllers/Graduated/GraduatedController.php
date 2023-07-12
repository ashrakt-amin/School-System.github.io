<?php

namespace App\Http\Controllers\Graduated;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repository\Graduated\GraduatedRepositoryInterface;

class GraduatedController extends Controller
{
    protected $graduated ;

 
    public function __construct(GraduatedRepositoryInterface $graduated)
    {
        $this->graduated = $graduated;
    }

    public function index()
    {
        return $this->graduated->index();
    }

    public function create()
    {
        return $this->graduated->create();
    }

    
    public function store(Request $request)
    {
        return $this->graduated->softDelete($request);
    }


    public function update(Request $request)
    {
        return $this->graduated->restore($request);
    }


    public function destroy(Request $request)
    {
            return $this->graduated->destroy($request);

    }
}

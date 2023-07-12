<?php

namespace App\Http\Controllers\Student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repository\Attendance\AttendanceRepositoryInterface;

class AttendanceController extends Controller
{

    protected $attendace;

    public function __construct(AttendanceRepositoryInterface $attendace)
    {
        $this->attendace = $attendace;
    }


    public function index()
    {
        return $this->attendace->index();
    }



    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        return $this->attendace->store($request);
    }


    public function show($id)
    {
        return $this->attendace->show($id);
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}

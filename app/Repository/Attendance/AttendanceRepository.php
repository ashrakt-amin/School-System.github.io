<?php

namespace App\Repository\Attendance;

use App\Models\Attendance;
use Exception;
use App\Models\Grade;
use App\Models\Student;
use App\Models\Teacher;

class AttendanceRepository implements AttendanceRepositoryInterface
{

  public function  index()
  {
    $data['Grades'] = Grade::with('sections')->get();
    $data['list_Grades'] = Grade::all();
    $data['teachers'] = Teacher::all();
    return view('pages.attendance.sections', $data);
  }

  public function store($request)
  {
    try {
      foreach ($request->attendances as $student_id => $status) {
        if ($status == 'presence') {
          $attendance_status = true;
        } elseif ($status == 'absent') {
          $attendance_status = false;
        }else{
          return redirect()->back();

        }
        Attendance::create([
          'student_id'        => $student_id,
          'grade_id'          => $request->grade_id,
          'classroom_id'      => $request->classroom_id,
          'section_id'        => $request->section_id,
          'teacher_id'        => 1,
          'attendance_date'   => date('Y-m-d'),
          'attendance_status' => $attendance_status
        ]);
      }
      toastr()->success(trans('messages.success'));
      return redirect()->back();
    } catch (\Exception $e) {
      return redirect()->back()->withErrors(['error' => $e->getMessage()]);
    }
  }

  public function show($id)
  {
    $students = Student::with('attendance')->where('section_id', $id)->get();
    return view('pages.attendance.index', compact('students'));
  }


  public function edit($id)
  {
  }


  public function update($request, $id)
  {
  }


  public function delete($request)
  {
  }
}

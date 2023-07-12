<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Online_Class;


class DashboardController extends Controller
{
    public function index()
    {
        $data['students'] = Student::count();
        $data['teachers'] = Teacher::count();
        $data['zoom'] = Online_Class::count();


        return view('dashboard', $data);
    }

    
    public function student()
    {
        return "kk";
    }

   
    public function parent()
    {
        return 'parent';
    }

    public function teacher()
    {
        return 'teacher';
    }
}

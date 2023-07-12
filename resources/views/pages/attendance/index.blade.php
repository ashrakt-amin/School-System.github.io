@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
Attendance and absence list for students
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
Attendance and absence list for students
@stop
<!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('status'))
        <div class="alert alert-danger">
            <ul>
                <li>{{ session('status') }}</li>
            </ul>
        </div>
    @endif



    <h5 style="font-family: 'Cairo', sans-serif;color: red"> Date: {{ date('Y-m-d') }}</h5>
    <form method="post" action="{{ route('attendance.store') }}">

        @csrf
        <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
               style="text-align: center">
            <thead>
            <tr>
                <th class="alert-success">#</th>
                <th class="alert-success">Name</th>
                <th class="alert-success">Email</th>
                <th class="alert-success">Gender</th>
                <th class="alert-success">Grade</th>
                <th class="alert-success">Classrooms</th>
                <th class="alert-success">Section</th>
                <th class="alert-success">Processes</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($students as $student)
                <tr>
                    <td>{{ $loop->index + 1 }}</td>
                    <td>{{ $student->name }}</td>
                    <td>{{ $student->email }}</td>
                    <td>{{ $student->gender->Name }}</td>
                    <td>{{ $student->grade->name }}</td>
                    <td>{{ $student->class->class_name }}</td>
                    <td>{{ $student->section->name }}</td>
                    <td>

                        @if(isset($student->attendance()->where('attendance_date',date('Y-m-d'))->first()->student_id))

                            <label class="block text-gray-500 font-semibold sm:border-r sm:pr-4">
                                <input name="attendances[{{ $student->id }}]" disabled
                                       {{ $student->attendance()->first()->attendance_status == 1 ? 'checked' : '' }}
                                       class="leading-tight" type="radio" value="presence">
                                <span class="text-success">attendace</span>
                            </label>

                            <label class="ml-4 block text-gray-500 font-semibold">
                                <input name="attendances[{{ $student->id }}]" disabled
                                       {{ $student->attendance()->first()->attendance_status == 0 ? 'checked' : '' }}
                                       class="leading-tight" type="radio" value="absent">
                                <span class="text-danger">absence</span>
                            </label>

                        @else

                            <label class="block text-gray-500 font-semibold sm:border-r sm:pr-4">
                                <input name="attendances[{{ $student->id }}]" class="leading-tight" type="radio"
                                       value="presence">
                                <span class="text-success">attendance</span>
                            </label>

                            <label class="ml-4 block text-gray-500 font-semibold">
                                <input name="attendances[{{ $student->id }}]" class="leading-tight" type="radio"
                                       value="absent">
                                <span class="text-danger">absence</span>
                            </label>

                        @endif

                        <input type="hidden" name="student_id[]" value="{{ $student->id }}">
                        <input type="hidden" name="grade_id" value="{{ $student->Grade_id }}">
                        <input type="hidden" name="classroom_id" value="{{ $student->Classroom_id }}">
                        <input type="hidden" name="section_id" value="{{ $student->section_id }}">

                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <P>
            <button class="btn btn-success" type="submit">{{ trans('Students_trans.submit') }}</button>
        </P>
    </form><br>
    <!-- row closed -->
@endsection
@section('js')
    @toastr_js
    @toastr_render
@endsection
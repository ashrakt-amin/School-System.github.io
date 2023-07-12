@extends('layouts.master')
@section('css')
@toastr_css
@section('title')
Quizzes List
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
Quizzes List
@stop
<!-- breadcrumb --> 
@endsection
@section('content')
<!-- row -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                <a href="{{route('quiz.create')}}" class="btn btn-success btn-sm" role="button" aria-pressed="true">Add New Quiz</a><br><br>
                <div class="table-responsive">
                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50" style="text-align: center">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Quiz</th>
                                <th>Teacher</th>
                                <th>Grade</th>
                                <th>Class</th>
                                <th>Section</th>
                                <th>Process</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($quizzes as $quiz)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td><a href="{{route('quiz.show',$quiz->id)}}">{{$quiz->name}}</a></td>
                                <td>{{$quiz->teacher->Name}}</td>
                                <td>{{$quiz->grade->name}}</td>
                                <td>{{$quiz->classroom->class_name}}</td>
                                <td>{{$quiz->section->name}}</td>
                                <td>
                                    <a href="{{route('quiz.edit',$quiz->id)}}" class="btn btn-info btn-sm" role="button" aria-pressed="true"><i class="fa fa-edit"></i></a>
                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete_exam{{ $quiz->id }}" title="delete"><i class="fa fa-trash"></i></button>
                                </td>
                            </tr>

                            <div class="modal fade" id="delete_exam{{$quiz->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <form action="{{route('quiz.destroy','test')}}" method="post">
                                        {{method_field('delete')}}
                                        {{csrf_field()}}
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Delete {{$quiz->name}}</p>
                                                <input type="hidden" name="id" value="{{$quiz->id}}">
                                            </div>
                                            <div class="modal-footer">
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('My_Classes_trans.Close') }}</button>
                                                    <button type="submit" class="btn btn-danger">{{ trans('My_Classes_trans.submit') }}</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')
@toastr_js
@toastr_render
@endsection
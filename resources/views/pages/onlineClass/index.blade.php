@extends('layouts.master')
@section('css')
@toastr_css
@section('title')
Online Classes
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
Online Classes
@stop
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card-body">
            <a href="{{route('online_classes.create')}}" class="btn btn-success" role="button" aria-pressed="true">Online Class</a>
            <a class="btn btn-warning" href="{{route('indirect.create')}}">Offline Class</a>
            <div class="table-responsive">
                <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50" style="text-align: center">
                    <thead>
                        <tr class="alert-success">

                            <th>#</th>
                            <th>Grade</th>
                            <th>Class</th>
                            <th>Section</th>
                            <th>Teacher</th>
                            <th>Topic</th>
                            <th>Start Time</th>
                            <th>Duration</th>
                            <th>class URL </th>
                            <th>Process</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach($online_classes as $online_classe)
                        <tr>
                            <td>{{ $loop->iteration}}</td>
                            <td>{{$online_classe->grade->name}}</td>
                            <td>{{$online_classe->class->class_name}}</td>
                            <td>{{$online_classe->section->name}}</td>
                            <td>{{$online_classe->user->name}}</td>
                            <td>{{$online_classe->topic}}</td>
                            <td>{{$online_classe->start_at}}</td>
                            <td>{{$online_classe->duration}}</td>
                            <td class="text-danger"><a href="{{$online_classe->join_url}}" target="_blank">Join now</a></td>
                            <td>
                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#Delete{{$online_classe->id}}"><i class="fa fa-trash"></i></button>
                            </td>
                        </tr>
                        @include('pages.onlineClass.delete')
                        @endforeach
                </table>
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
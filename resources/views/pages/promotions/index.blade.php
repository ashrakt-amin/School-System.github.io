@extends('layouts.master')
@section('css')
@toastr_css
@section('title')
{{trans('main_trans.list_students')}}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
{{trans('main_trans.list_students')}}
@stop
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">
    <div class="col-md-12 mb-30">

        <a class="button x-small" href="{{route('Promotion.create')}}">Add</a>
        <a class="button x-small" href="#" data-toggle="modal" data-target="#exampleModal">
            Delete all</a>

        <br><br>



        <div class="table-responsive">
            <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50" style="text-align: center">
                <thead>
                    <tr>
                        <th class="alert-info">#</th>
                        <th class="alert-info">{{trans('Students_trans.name')}}</th>
                        <th class="alert-danger">{{trans('Students_trans.Previous Stage')}}</th>
                        <th class="alert-danger">{{trans('Students_trans.Previous Year')}}</th>
                        <th class="alert-danger">{{trans('Students_trans.Previous Class')}}</th>
                        <th class="alert-danger">{{trans('Students_trans.Previous Section')}}</th>
                        <th class="alert-success">{{trans('Students_trans.Current Stage')}}</th>
                        <th class="alert-success">{{trans('Students_trans.Current Year')}}</th>
                        <th class="alert-success">{{trans('Students_trans.Current Class')}}</th>
                        <th class="alert-success">{{trans('Students_trans.Current Section')}}</th>
                        <th>{{trans('Students_trans.Processes')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($promotions as $promotion)
                    <tr>
                        <td>{{ $loop->index+1 }}</td>
                        <td>{{$promotion->student->name}}</td>
                        <td>{{$promotion->f_grade->name}}</td>
                        <td>{{$promotion->academic_year}}</td>
                        <td>{{$promotion->f_classroom->class_name}}</td>
                        <td>{{$promotion->f_section->name}}</td>
                        <td>{{$promotion->t_grade->name}}</td>
                        <td>{{$promotion->academic_year_new}}</td>
                        <td>{{$promotion->t_classroom->class_name}}</td>
                        <td>{{$promotion->t_section->name}}</td>
                        <td>

                        
                            <a href="{{route('student.edit',$promotion->id)}}" class="btn btn-info btn-sm" role="button" aria-pressed="true"><i class="fa fa-edit"></i></a>
                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#Delete_one{{ $promotion->id }}" title="{{ trans('Grades_trans.Delete') }}"><i class="fa fa-trash"></i></button>
                        </td>
                    </tr>
                    @include('pages.promotions.Delete_one')

                    @endforeach
            </table>
        </div>


        <!-- delete promotion -->


        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">

                    <div class="modal-header">

                        <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">Delete All </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <form action="{{route('Promotion.destroy','test')}}" method="post">
                            @csrf
                            @method('DELETE')

                            <input type="hidden" name="page_id" value="1">
                            <h5 style="font-family: 'Cairo', sans-serif;">Are You Sure From Deleting All ?</h5>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('Students_trans.Close')}}</button>
                                <button class="btn btn-danger">{{trans('Students_trans.submit')}}</button>
                            </div>
                        </form>
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
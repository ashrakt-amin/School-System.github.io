@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    Tuition Fees
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
   Tuition Fees
@stop
<!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">
                            <div class="card-body">
                                <a href="{{route('Fees.create')}}" class="btn btn-success btn-sm" role="button"
                                   aria-pressed="true">Add New Fees</a><br><br>
                                <div class="table-responsive">
                                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                           data-page-length="50"
                                           style="text-align: center">
                                        <thead>
                                        <tr class="alert-success">
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Type</th>
                                            <th>Amount</th>
                                            <th>Grade</th>
                                            <th>Class</th>
                                            <th>Year</th>
                                            <th>Notes</th>
                                            <th>Process &emsp;&emsp;</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($fees as $fee)
                                            <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$fee->title}}</td>
                                            <td>{{$fee->type->type}}</td>
                                            <td>{{number_format($fee->amount, 2)}}</td>
                                            <td>{{$fee->grade->name}}</td>
                                            <td>{{$fee->class->class_name}}</td>
                                            <td>{{$fee->year}}</td>
                                            <td>{{$fee->description}}</td>
                                                <td>
                                                    <a href="{{route('Fees.edit',$fee->id)}}" class="btn btn-info btn-sm" role="button" aria-pressed="true"><i class="fa fa-edit"></i></a>
                                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#Delete_Fee{{ $fee->id }}" title="{{ trans('Grades_trans.Delete') }}"><i class="fa fa-trash"></i></button>

                                                </td>
                                            </tr>
                                        @include('pages.fees.Delete')
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                       
    </div>
    <!-- row closed -->
@endsection
@section('js')
    @toastr_js
    @toastr_render
@endsection
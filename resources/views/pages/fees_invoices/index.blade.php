@extends('layouts.master')
@section('css')
@toastr_css
@section('title')
Tution Invoices
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
Tution Invoices
@stop
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">

                <div class="table-responsive">
                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50" style="text-align: center">
                        <thead>
                            <tr class="alert-success">
                                <th>#</th>
                                <th>Name</th>
                                <th>Fees Type</th>
                                <th>Amount</th>
                                <th>Grade</th>
                                <th>Class</th>
                                <th>Notes</th>
                                <th>Process</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($Fee_invoices as $Fee_invoice)
                            <tr>
                                <td>{{$loop->iteration }}</td>
                                <td>{{$Fee_invoice->student->name}}</td>
                                <td>{{$Fee_invoice->fee->title}}</td>
                                <td>{{number_format($Fee_invoice->amount, 2)}}</td>
                                <td>{{$Fee_invoice->grade->name}}</td>
                                <td>{{$Fee_invoice->class->class_name}}</td>
                                <td>{{$Fee_invoice->description}}</td>
                                <td>
                                    <a href="{{route('Fees_Invoices.edit',$Fee_invoice->id)}}" class="btn btn-info btn-sm" role="button" aria-pressed="true"><i class="fa fa-edit"></i></a>
                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#Delete_Fee_invoice{{$Fee_invoice->id}}" title="{{ trans('Grades_trans.Delete') }}"><i class="fa fa-trash"></i></button>

                                </td>
                            </tr>
                            @include('pages.fees_invoices.Delete')

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
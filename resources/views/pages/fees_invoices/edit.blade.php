@extends('layouts.master')
@section('css')
@toastr_css
@section('title')
Tuition fees update
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
Tuition fees update
@stop
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">

                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <form action="{{route('Fees_Invoices.update','test')}}" method="post" autocomplete="off">
                    @method('PUT')
                    @csrf
                    <div class="form-row">
                        <div class="form-group col">
                            <label for="inputEmail4">Student Name</label>
                            <input type="text" value="{{$fee_invoices->student->name}}" readonly name="student_name" class="form-control">
                            <input type="hidden" value="{{$fee_invoices->id}}" name="id" class="form-control">
                            <input type="hidden" value="{{$fee_invoices->student->id}}" name="student_id" class="form-control">

                        </div>


                        <div class="form-group col">
                            <label for="inputEmail4">Amount</label>
                            <input type="number" value="{{$fee_invoices->amount}}" name="amount" class="form-control">
                        </div>

                    </div>


                    <div class="form-row">

                        <div class="form-group col">
                            <label for="inputZip">Fee</label>
                            <select class="custom-select mr-sm-2" name="fee_id">
                                @foreach($fees as $fee)
                                <option value="{{$fee->id}}" {{$fee->id == $fee_invoices->fee_id ? 'selected':"" }}>{{$fee->title}}</option>

                                @endforeach
                            </select>
                        </div>

                    </div>

                    <div class="form-group">
                        <label for="inputAddress">Notes</label>
                        <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="4">{{$fee_invoices->description}}</textarea>
                    </div>
                    <br>

                    <button type="submit" class="btn btn-primary">Ok</button>

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
@extends('layouts.master')
@section('css')
@toastr_css
@section('title')
Add New Invoice
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
Add New Invoice{{$student->name}}
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

                <form action="{{ route('Fees_Invoices.store') }}" method="POST" >
                    {{ csrf_field() }}
                    <div class="col">
                        <label for="fee_id" class="control-label">Fees Type</label>
                        <select style="height:calc(2.8rem + 6px)" class="form-control" name="fee_id" required>
                            <option selected disabled>choose</option>
                            @foreach($fees as $fee)
                            <option value="{{ $fee->id }}">{{ $fee->title }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col">
                        <label for="amount" class="control-label">Amount</label>
                        <input type="number" class="form-control" name="amount" required>

                    </div>

                    <div class="col">
                        <label for="description" class="control-label">Note</label>
                        <input type="text" class="form-control" name="description" required>
                    </div>



                    <input type="hidden" name="Grade_id" value="{{$student->Grade_id}}">
                    <input type="hidden" name="Classroom_id" value="{{$student->Classroom_id}}">
                    <input type="hidden" name="student_id" value="{{$student->id}}">


                    <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" type="submit">Ok</button>
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
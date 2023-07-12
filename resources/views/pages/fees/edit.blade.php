@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
Tuition Fees Update
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
Tuition Fees Update
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

                    <form action="{{route('Fees.update','test')}}" method="post" autocomplete="off">
                        @method('PUT')
                        @csrf
                        <div class="form-row">
                            <div class="form-group col">
                                <label for="inputEmail4">Name</label>
                                <input type="text" value="{{$fee->title}}" name="title" class="form-control">
                                <input type="hidden" value="{{$fee->id}}" name="id" class="form-control">
                            </div>


                            <div class="form-group col">
                                <label for="inputEmail4">Amount</label>
                                <input type="number" value="{{$fee->amount}}" name="amount" class="form-control">
                            </div>

                        </div>


                        <div class="form-row">

                            <div class="form-group col">
                                <label for="inputState">Grade</label>
                                <select class="custom-select mr-sm-2" name="Grade_id">
                                    @foreach($Grades as $Grade)
                                        <option value="{{ $Grade->id }}" {{$Grade->id == $fee->Grade_id ? 'selected' : ""}}>{{ $Grade->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col">
                                <label for="inputZip">Class</label>
                                <select class="custom-select mr-sm-2" name="Classroom_id">
                                    @foreach($classes as $class)
                                    <option value="{{$class->id}}"  {{$class->id == $fee->class->class_name ? 'selected' : ""}}> {{$class->class_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>


                            <div class="form-row">
                            <div class="form-group col">
                                <label for="inputZip">Year</label>
                                <select class="custom-select mr-sm-2" name="year">
                                    @php
                                        $current_year = date("Y")
                                    @endphp
                                    @for( $year = $current_year - 2 ; $year <= $current_year + 2 ; $year++ )
                                        <option value="{{ $year}}" {{$year == $fee->year ? 'selected' : ' '}}>{{ $year }}</option>
                                    @endfor
                                </select>
                            </div>

                            <div class="form-group col">
                                <label for="inputState">Type</label>
                                <select class="custom-select mr-sm-2" name="type_id">
                                    @foreach($types as $type)
                                        <option value="{{ $type->id }}" {{$type->id == $fee->type_id ? 'selected' : ""}}>{{ $type->type }}</option>
                                    @endforeach
                                </select>
                            </div>



                            
                        </div>

                        <div class="form-group">
                            <label for="inputAddress">Notes</label>
                            <textarea class="form-control" name="description" id="exampleFormControlTextarea1"
                                      rows="4">{{$fee->description}}</textarea>
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
@extends('layouts.master')
@section('css')
@toastr_css
@section('title')
offline Class
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
offline Class
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

                <form method="post" action="{{ route('indirect.store') }}" autocomplete="off">
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="Grade_id">Grade : <span class="text-danger">*</span></label>
                                <select class="custom-select mr-sm-2" name="Grade_id">
                                    <option selected disabled>Choose ...</option>
                                    @foreach ($Grades as $Grade)
                                    <option value="{{ $Grade->id }}">{{ $Grade->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="Classroom_id">Classrooms : <span class="text-danger">*</span></label>
                                <select class="custom-select mr-sm-2" name="Classroom_id">

                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="section_id">Section : </label>
                                <select class="custom-select mr-sm-2" name="section_id">

                                </select>
                            </div>
                        </div>
                    </div><br>

                    <div class="row">

                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Meeting ID : <span class="text-danger">*</span></label>
                                <input class="form-control" name="meeting_id" type="number">
                            </div>
                        </div>


                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Topic : <span class="text-danger">*</span></label>
                                <input class="form-control" name="topic" type="text">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Start Time : <span class="text-danger">*</span></label>
                                <input class="form-control" type="datetime-local" name="start_time">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Duration : <span class="text-danger">*</span></label>
                                <input class="form-control" name="duration" type="number">
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Password : <span class="text-danger">*</span></label>
                                <input class="form-control" name="password" type="text">
                            </div>
                        </div>


                    </div>

                    <div class="row">

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>start url : <span class="text-danger">*</span></label>
                                <input class="form-control" name="start_url" type="text">
                            </div>
                        </div>

                        <div class="col-md-8">
                            <div class="form-group">
                                <label>join url : <span class="text-danger">*</span></label>
                                <input class="form-control" name="join_url" type="text">
                            </div>
                        </div>
                    </div>

                    <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" type="submit">{{ trans('Students_trans.submit') }}</button>
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
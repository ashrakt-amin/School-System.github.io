@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
Add Question
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
Add Question
@stop
<!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">

                    @if(session()->has('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>{{ session()->get('error') }}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <div class="col-xs-12">
                        <div class="col-md-12">
                            <br>
                            <form action="{{ route('questions.store') }}" method="post" autocomplete="off">
                                @csrf
                                <div class="form-row">

                                    <div class="col">
                                        <label for="title">Name</label>
                                        <input type="text" name="title" id="input-name" class="form-control form-control-alternative" autofocus>
                                        <input type="hidden" name="quiz_id" value="{{$quiz->id}}">
                                    </div>
                                </div>
                                <br>

                                <div class="form-row">
                                    <div class="col">
                                        <label for="title">Answers</label>
                                        <input  class="form-control" type="text" name="answers[]" placeholder ="a) "/>
                                        <input  class="form-control" type="text" name="answers[]" placeholder ="b) "/>
                                        <input  class="form-control" type="text" name="answers[]" placeholder ="c) "/>
                                        <input  class="form-control" type="text" name="answers[]" placeholder ="d) "/>
                                    </div>
                                </div>
                                <br>

                                <div class="form-row">
                                    <div class="col">
                                        <label for="title">Right Answer</label>
                                        <input type="text" name="right_answer" id="input-name"
                                               class="form-control form-control-alternative" autofocus>
                                    </div>
                                </div>
                                <br>

                                <div class="form-row">
                                    
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="Grade_id">Score : <span class="text-danger">*</span></label>
                                            <select class="custom-select mr-sm-2" name="score">
                                                <option selected disabled>Choose ...</option>
                                                <option value="5">5</option>
                                                <option value="10">10</option>
                                                <option value="15">15</option>
                                                <option value="20">20</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" type="submit">Ok</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- row closed -->
@endsection

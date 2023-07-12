@extends('layouts.master')
@section('css')
@toastr_css
@section('title')
Quiz
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
Quiz
@stop
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">
<a href="{{route('create.question',$quiz->id)}}" class="btn btn-successmb-3"  role="button" aria-pressed="true">New Question</a><br><br>

    <div class="col-md-12 mb-30 mt-30">
      
                @if(session()->has('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>{{ session()->get('error') }}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif


                
                        @foreach($quiz->questions as $question)
                        <div class="card">
                            <div class="card-header">
                            {{$loop->iteration}})  {{$question->title}}
                            </div>
                            <div class="card-body">
                                <blockquote class="blockquote mb-0">

                                    <?php 
                                    $answers = explode(" ", $question->answers);
                                    $arr = ['a','b','c','d'];
                                   $count = 0;

                                    ?>
                                    @foreach($answers as $answer)
                                    
                                       @if($answer == $question->right_answer)
                                       <p style="background-color:#B1FBCA;">{{$arr[$count]}}) {{$answer}} </p>
                                       @else
                                       <p>{{$arr[$count]}}) {{$answer}} </p>

                                       @endif
<?php $count ++ ; ?>
                                    @endforeach
                                </blockquote>
                            </div>
                        </div>
                        <br>

                        @endforeach

    </div>
</div>
<!-- row closed -->
@endsection
@extends('template')

@section('content')
<div class='container'  style="width:35%;margin-top:30px;background:white;">
<h1 style="text-align:centre;padding:5px;">Create Match</h1>
{{ Form::open(['action'=>'MatchesController@store','method'=>'post','enctype'=>'multipart/form-data']) }}
	<div class='form-group'>
        {{ Form::label('team1', 'Team1')}}
        {{Form::text('team1','',['class'=>'form-control','placeholder'=>'Team1 Name'])}}

    </div>   
    <div class='form-group'>
        {{ Form::label('team2', 'Team2')}}
        {{Form::text('team2','',['class'=>'form-control','placeholder'=>'Team2 Name'])}}
    </div>
    <div class='form-group'>
        {{ Form::label('logo1', 'logo Team1')}}
        {{Form::file('cover_image1')}}
    </div>

    <div class='form-group'>
        {{ Form::label('logo2', 'logo Team2')}}
        {{Form::file('cover_image2')}}
    </div>

    <div class='form-group'>
        {{ Form::label('time', 'Time')}}
        {{Form::time('time',\Carbon\Carbon::now(),['class'=>'form-control','placeholder'=>'Time'])}}
    </div>

    <div class='form-group'>
        {{ Form::label('date', 'Date')}}
        {{Form::date('date', \Carbon\Carbon::now(),['class'=>'form-control','placeholder'=>'Date'])}}
    </div>

    <div class='form-group'>
        {{ Form::label('day', 'Day')}}
        {{Form::text('day','',['class'=>'form-control','placeholder'=>'Day'])}}
    </div>

    <div class='form-group'>
        {{ Form::label('league', 'League')}}
        {{Form::text('league','',['class'=>'form-control','placeholder'=>'League'])}}
    </div>

    {{Form::submit('Submit',['class'=>'btn btn-primary'])}}
</div>
{{ Form::close() }}
@endsection
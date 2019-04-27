@extends('template');

@section('content');


@foreach($matches_ as $match)
    <div class="match" >
    <h2>{{$match->team1}} <img src="/storage/cover_images/{{$match->cover_image1}}"/>   vs  <img src="/storage/cover_images/{{$match->cover_image2}}"/>  {{$match->team2}}  <a href="matches/{{$match->id}}/edit" class="btn btn-default">Edit</a>
    <br>
    {{Form::open(['action'=>['MatchesController@destroy',$match->id],'_method'=>'POST','class'=>'pull-right'])}}
        
        {{Form::hidden('_method','DELETE')}}
        <br>
        {{Form::submit('Delete',['class'=>'btn btn-danger button'])}}
    {{Form::close()}}

    {{$match->time}}
</h2>

    
    <style>
        .button{
            padding:10px;
            width:150px;
        }
        .match{
            width:75%;
            margin:auto;
            background:white;
            padding:10px;
        }
        img{
            width:50px;
            height:50px;
        }
        h2{
            text-align: center;
        }
    </style>
    </div>
    <br>
@endforeach
{{$matches_->links()}}

@endsection
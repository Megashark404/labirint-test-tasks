@extends('layout')

@section('content')

    <div class="container mt-4">
        <h1 align="center" class="mb-3">{{$news->title}}</h1>
        <div>Дата: {{$news->date}}</div>
        <hr>
        <div class="article">
            {{$news->text}}
        </div>
        <hr>
        <div>Тэги: {{$news->tags}}</div>
       
      
    </div>
@endsection

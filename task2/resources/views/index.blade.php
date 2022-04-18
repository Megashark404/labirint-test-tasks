@extends('layout')

@section('content')

    <div class="container">
        <h1 align="center" class="mb-3">News list</h1>
        <table class="table">
            <thead>
                <th>id</th>
                <th>date</th>
                <th>title</th>
                <th>teaser</th>
                <th></th>
                <th></th>
            </thead>
       
            @foreach($news as $item)
                
                <tr>
                    <td>{{$item->id}}</td>
                    <td>{{$item->date}}</td>
                    <td>{{$item->title}}</td>
                    <td>{{$item->teaser}}</td>
                    <td><a href="news/id={{$item->id}}">Открыть</a></td>
                    <td><a href="delete/{{$item->id}}">Удалить</a></td>
                </tr>

            @endforeach

        </table>
      
    </div>
@endsection

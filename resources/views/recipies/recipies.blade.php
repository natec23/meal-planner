@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            @if(isset($title))
                <h2>{{$title}}</h2>
            @else
                <h2>Recipies</h2>
            @endif
            @foreach($recipies as $recipie)
                <h3><a href="{{ route('recipie.update', $recipie) }}">{{$recipie->name}}</a></h3>
            @endforeach
        </div>
    </div>
</div>
@endsection

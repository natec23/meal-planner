@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <a href="{{ route('recipie.create') }}" class="float-right btn btn-primary"><i class="fas fa-plus"></i></a>
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

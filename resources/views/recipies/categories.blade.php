@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <h2>Recipie Categories</h2>
            @foreach($categories as $category)
                <h3><a href="{{ url('recipies/category/'.$category->id.'/edit') }}">{{$category->name}}</a></h3>
            @endforeach
        </div>
    </div>
</div>
@endsection

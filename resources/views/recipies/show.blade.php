@extends('layouts.app')

@section('content')
<div id="recipie-container" class="container">
    <div class="card">
        <div class="card-header">
            <h1>{{ $recipie->name }}</h1>
        </div>
        <div class="card-body">
            @php
            $columns = 0;
            if($recipie->oven_temp) { $columns++; }
            if($recipie->prep_time) { $columns++; }
            if($recipie->cook_time) {
                $columns++;
                if($recipie->cook_time >= 60) {
                    $hours = floor($recipie->cook_time / 60);
                    $minutes = $recipie->cook_time % 60;
                }
                else {
                    $hours = 0;
                    $minutes = $recipie->cook_time;
                }
            }
            if($recipie->yield) { $columns++; }
            @endphp
            @if($columns > 0)
                @php $columns = 12 / $columns; @endphp
                <div class="row">
                    @if($recipie->yield)
                        <div class="col-sm-{{$columns}}">
                            @if(strtolower($recipie->yield_unit) == 'servings')
                                <i class="fas fa-utensils"></i>
                            @else
                                <i class="fas fa-weight"></i>
                            @endif
                            Yield: {{ $recipie->yield.' - '.$recipie->yield_unit}}
                        </div>
                    @endif
                    @if($recipie->prep_time)
                        <div class="col-sm-{{$columns}}">
                            <i class="far fa-clock"></i> Prep: {{ $recipie->prep_time}}
                        </div>
                    @endif
                    @if($recipie->cook_time)
                        <div class="col-sm-{{$columns}}">
                            <i class="far fa-clock"></i> Cook:
                            @if($hours >= 1)
                                {{ $hours }} hours
                            @endif
                            @if($minutes > 0)
                                {{ $minutes }} m
                            @endif
                        </div>
                    @endif
                    @if($recipie->oven_temp)
                        <div class="col-sm-{{$columns}}">
                            <i class="fas fa-thermometer-three-quarters"></i> {{ $recipie->oven_temp}}&#176;
                        </div>
                    @endif
                </div>
            @endif
            {{ $recipie->notes }}
        </div>

        @if($recipie->tags)
        <div class="card-footer">
            <div class="row">
                @foreach($recipie->tags as $tag)
                    <a href="#" class="col"><i class="fas fa-tag"></i> {{ $tag->name }}</a>
                @endforeach
            </div>
        </div>
        @endif
    </div>
    <br />
    <div class="row">
        <div class="col-sm-8">
            <div class="card">
                <div class="card-header">
                    <h2>Directions</h2>
                </div>
                <div class="card-body">
                    <ol class="list-group list-group-flush" style="list-style: decimal inside;">
                        <recipie-direction v-for="direction in directions" v-bind:key="direction.id" v-bind:direction="direction" v-bind:edit="false"></recipie-direction>
                    </ol>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="card">
                <div class="card-header">
                    <h2>Ingredients</h2>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <recipie-ingredient v-for="ingredient in ingredients" v-bind:key="ingredient.id" v-bind:ingredient="ingredient" v-bind:edit="false"></recipie-ingredient>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<script>var recipie_id = {{$recipie->id}};</script>
@endsection

@section('scripts')
<script src="{{ asset('js/recipies.js') }}" defer></script>
@endsection

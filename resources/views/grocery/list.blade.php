@extends('layouts.app')

@section('content')
<div id="grocery-container" class="container" v-bind:list="{{$list->id}}">
    <div class="row justify-content-center">
        <div class="col-lg-8 md-10">
            <h2>{{ $list->name }}</h2>
            <form action="{{ url('/grocery/item') }}" method="post" v-on:submit.prevent="addItem" data-list="{{$list->id}}">
                @csrf
                <div class="input-group">
                    <label class="sr-only" for="new-list-item"></label>
                    <input type="text" name="new_item" id="new-list-item" class="form-control" placeholder="Add new item" v-model="newItem" />
                    <div class="input-group-append">
                        <input type="submit" class="btn btn-primary" value="+" />
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-lg-8 md-10">
            <grocery-list v-bind:list="{{$list->id}}" ref="grocerylist"></grocery-list>
        </div>
    </div>
</div>
<script>
var list_id = {{$list->id}};
</script>
@endsection


@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <h2>{{ ($category ? 'Update' : 'Create') }} Category</h2>
            @if($category)
                <form action="{{ route('recipie.category.update', $category) }}" method="post">
                @method('PUT')
            @else
                <form action="{{ route('recipie.category.store') }}" method="post">
            @endif
                @csrf
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" name="name" id="name" value=" {{ old('name', optional($category)->name) }}" />
                </div>
                <input type="submit" class="btn btn-primary" value="{{ ($category ? 'Update' : 'Create') }}" />
            </form>
        </div>
    </div>
</div>
@endsection

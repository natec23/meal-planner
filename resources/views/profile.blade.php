@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-8">
            <form method="post" action="{{ url('change-password') }}">
                @csrf
                @if(session('change_password'))
                    <div class="alert alert-success" role="alert">{{ session('change_password') }}</div>
                @endif

                <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" name="password" id="password" />
                </div>
                <input type="submit" class="btn btn-primary" value="Update" />
            </form>
        </div>
    </div>
</div>
@endsection

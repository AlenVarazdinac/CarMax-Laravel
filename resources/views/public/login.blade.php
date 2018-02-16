@extends('layouts.main')

@section('title')
    Log in
@endsection

@section('content')
<div class="row mt-5 justify-content-center">
    <div class="col-md-10 jumbotron">
        <h2 class="text-center mb-3">Log in</h2>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form class="form-group" method="post" action="/auth">
                    <div class="form-group">
                        <input type="text" class="form-control" name="user_name" placeholder="Enter your username" />
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" name="user_password" placeholder="Enter your password" />
                    </div>
                    <div class="form-group row justify-content-center">
                        <button type="submit" class="btn btn-primary">Log in</button>
                    </div>
                    <input type = "hidden" name = "_token" value = "<?php echo csrf_token() ?>" />
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

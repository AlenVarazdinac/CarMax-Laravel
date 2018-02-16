@extends('layouts.main')

@section('title')
    Add Car Feature
@endsection

@section('content')

    <div class="row mt-5">
        <div class="col-md-12">
            <h1 class="text-left">Add Car Feature</h1>
        </div>
    </div>

    <div class="row mt-5 justify-content-center">
        <div class="col-md-6 form-style">
            <form method="post" action="/carfeature_adding">
                <div class="row">
                    <div class="form-group col-md-12">
                        <input type="text" placeholder="Enter car feature name" class="form-control"
                        name="car_feature_name" required />
                    </div>
                </div>

                <div class="row justify-content-center">
                    <button class="btn btn-primary mr-1">Add</button>
                    <a href="/carfeature" role="button" class="btn btn-danger ml-1">Back</a>
                </div>

                <input type = "hidden" name = "_token" value = "<?php echo csrf_token() ?>" />

            </form>
        </div>
    </div>

@endsection

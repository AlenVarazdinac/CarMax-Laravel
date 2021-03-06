@extends('layouts.main')

@section('title')
    Add Car Make
@endsection

@section('content')

    <div class="row mt-5">
        <div class="col-md-12">
            <h1 class="text-left">Add Car Make</h1>
        </div>
    </div>

    <div class="row mt-5 justify-content-center">
        <div class="col-md-6 form-style">
            <form enctype="multipart/form-data" method="post" action="/carmake_adding">
                <div class="row">
                    <div class="form-group col-md-6">
                        <input type="text" placeholder="Enter car make name" class="form-control"
                        name="car_make_name" id="car_make_name" required />
                    </div>
                    <div class="form-group col-md-6 mt-1">
                        <input type="file" class="form-control-file" name="car_make_file"
                        id="car_make_file" required />
                    </div>
                </div>

                <div class="row justify-content-center">
                    <button class="btn btn-primary mr-1">Add</button>
                    <a href="/carmake" role="button" class="btn btn-danger ml-1">Back</a>
                </div>

                <input type = "hidden" name = "_token" value = "<?php echo csrf_token() ?>" />

            </form>
        </div>
    </div>

@endsection

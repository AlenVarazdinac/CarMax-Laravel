@extends('layouts.main')

@section('title')
    Add Car Model
@endsection

@section('content')

@if (count($errors) > 0)
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
        </ul>
    </div>
@endif

    <div class="row mt-5">
        <div class="col-md-12">
            <h1 class="text-left">Add Car Model</h1>
        </div>
    </div>

    <div class="row mt-5 justify-content-center">
        <div class="col-md-8 form-style">
            <form enctype="multipart/form-data" method="post" action="/carmodel_adding">

                <div class="row justify-content-center">
                    <div class="form-group col-md-4">
                        <select class="form-control" name="car_make" required>
                            <option value="" selected>
                                Select car make
                            </option>
                            @foreach($carMakes as $carMake)
                            <option value="{{$carMake->car_make_id}}">
                                {{$carMake->car_make_name}}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-md-4">
                        <input type="text" placeholder="Enter car model name" class="form-control"
                        name="car_model_name" id="car_model_name" required />
                    </div>

                    <div class="form-group col-md-4">
                        <input type="text" placeholder="Enter car variant" class="form-control"
                        name="car_variant" id="car_variant" />
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="form-group col-md-4">
                        <select class="form-control" name="gearbox_type" required>
                            <option selected>
                                Select gearbox type
                            </option>
                            <option value="Automatic">
                                Automatic
                            </option>
                            <option value="Manual">
                                Manual
                            </option>
                        </select>
                    </div>

                    <div class="form-group col-md-4">
                        <select class="form-control" name="fuel_type" required>
                            <option selected>
                                Select fuel type
                            </option>
                            <option value="Petrol">
                                Petrol
                            </option>
                            <option value="Diesel">
                                Diesel
                            </option>
                        </select>
                    </div>

                    <div class="form-group col-md-4 input-group align-items-center">
                        <input type="number" step="0.01" placeholder="Enter fuel consumption" class="form-control"
                        name="car_fuel_cons" id="car_fuel_cons" />
                        <div class="input-group-prepend">
                            <div class="input-group-text">l/100km</div>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="form-group col-md-4 input-group align-items-center">
                        <input type="number" step="1" placeholder="Enter car power" class="form-control"
                        name="car_power" id="car_power" />
                        <div class="input-group-prepend">
                            <div class="input-group-text">HP</div>
                        </div>
                    </div>

                    <div class="form-group col-md-4 input-group align-items-center">
                        <input type="number" step="1" placeholder="Enter car mileage" class="form-control"
                        name="car_mileage" id="car_mileage" />
                        <div class="input-group-prepend">
                            <div class="input-group-text">km</div>
                        </div>
                    </div>

                    <div class="form-group col-md-4 input-group align-items-center">
                        <div class="input-group-prepend">
                            <div class="input-group-text">$</div>
                        </div>
                        <input type="number" step="0.01" placeholder="Enter price" class="form-control"
                        name="car_price" id="car_price" />
                    </div>

                </div>

                <div class="row justify-content-center mt-1">
                    <div class="form-group col-md-12">
                        <textarea rows=4 name="car_description"
                        placeholder="Enter car description" class="form-control"></textarea>
                    </div>
                </div>

                <div class="row justify-content-center">
                    @foreach($carFeatures as $carFeature)
                    <div class="form-check form-check-inline col-md-5 mt-1 ml-1">
                        <input type="checkbox" class="form-check-input" name="car_feature[]" id="carfeature_{{$carFeature->car_feature_name}}" value="{{$carFeature->car_feature_id}}" />
                        <label class="form-check-label" for="carfeature_{{$carFeature->car_feature_name}}">{{$carFeature->car_feature_name}}</label>
                    </div>
                    @endforeach
                </div>

                <div class="row justify-content-center">
                    <div class="form-group col-md-6 mt-1">
                        <input type="file" class="form-control-file" name="car_model_file"
                        id="car_model_file" />
                    </div>
                </div>

                <div class="row justify-content-center">
                    <button class="btn btn-primary mr-1">Add</button>
                    <a href="/carmodel" role="button" class="btn btn-danger ml-1">Back</a>
                </div>

                <input type="hidden" name="_token" value="<?php echo csrf_token() ?>" />

            </form>
        </div>
    </div>

@endsection

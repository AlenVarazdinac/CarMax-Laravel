@extends('layouts.main')

@section('title')
    {{$carModel[0]->car_make_name}} {{$carModel[0]->car_model_name}}
@endsection

@section('content')


<?php
$carModelImgPath = 'storage/carmodel/' . $carModel[0]->car_model_id . '.png';
?>

<div class="row mt-5">
    <div class="col-md-12 jumbotron">
        <div class="row">
            <div class="col-md-8">
                <h1 class="text-left mb-1">{{$carModel[0]->car_make_name}} {{$carModel[0]->car_model_name}} {{$carModel[0]->car_model_variant}}</h1>
                <img src="{{asset($carModelImgPath)}}" alt="car_model_image" class="img-fluid" />
            </div>
            <div class="col-md-4 mt-5">
                <p class="text-left">
                    Power: {{$carModel[0]->car_model_power}} HP
                </p>
                <p class="text-left">
                    Mileage: {{$carModel[0]->car_model_mileage}} km
                </p>
                <p class="text-left">
                    Fuel type: {{$carModel[0]->car_model_fuel_type}}
                </p>
                <p class="text-left">
                    Fuel consumption: {{$carModel[0]->car_model_fuel_cons}} l/100km
                </p>
                <p class="text-left">
                    Gearbox: {{$carModel[0]->car_model_gearbox}}
                </p>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-md-6">
                <p>Description: <br />{{$carModel[0]->car_model_desc}}</p>
            </div>
            <div class="col-md-6">
                <p>
                    Features: <br />
                    @foreach($carModel as $carFeature)
                        {{$carFeature->car_feature_name}}
                        @if(end($carFeature)===$carFeature->car_feature_name)
                        ,
                        @endif
                    @endforeach
                </p>
            </div>

        </div>

        <div class="row mt-3">
            <div class="col-md-12">
                <h2 class="text-center">$ {{$carModel[0]->car_model_price}}</h2>
            </div>
        </div>

        <div class="row mt-5 justify-content-center">
            <a href="{{URL::previous()}}" class="btn btn-danger text-center">Back</a>
        </div>

    </div>
</div>

@endsection

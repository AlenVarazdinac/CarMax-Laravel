@extends('layouts.main')

@section('title')
Home
@endsection

@section('content')
<?php
$mostExpensiveModelImg = 'storage/carmodel/' . $mostExpensiveModel->car_model_id . '.png';
$cheapestModelImg = 'storage/carmodel/' . $cheapestModel->car_model_id . '.png';
$latestAddedModelImg = 'storage/carmodel/' . $latestAddedModel->car_model_id . '.png';
?>
<div class="row mt-5">
    <div class="col-md-12">
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="d-block w-100" src={{$mostExpensiveModelImg}} alt="most_expensive_model">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="{{$cheapestModelImg}}" alt="cheapest_model">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="{{$latestAddedModelImg}}" alt="latest_added_model">
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
</div>
@endsection

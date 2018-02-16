@extends('layouts.main')

@section('title')
Car make
@endsection

@section('content')
<!-- Page title and Order by -->
<div class="row my-5">

    <!-- Page title -->
    <div class="col-md-6 d-flex justify-content-left">
        <h1 class="text-left">Car Model</h1>
    </div>

    <!-- Order By -->
    <div class="col-md-6 d-flex justify-content-right">

        <div class="col-md-5 mt-3">
            <h4 class="text-center">Sort by</h4>
        </div>

        <div class="col-md-7 mt-3">
            <select class="custom-select col-md-12" id="carModelSort" onchange="sortCarModels()">
                <option value="pricelowtohigh" <?php if(isset($_GET['sortBy'])){if($_GET['sortBy']==='pricelowtohigh'){echo 'selected=selected';}}?>>
                    Price ascending
                </option>
                <option value="pricehightolow" <?php if(isset($_GET['sortBy'])){if($_GET['sortBy']==='pricehightolow'){echo 'selected=selected';}}?>>
                    Price descending
                </option>
                <option value="az" <?php if(isset($_GET['sortBy'])){if($_GET['sortBy']==='az'){echo 'selected=selected';}}?>>
                    Name A-Z
                </option>
                <option value="za" <?php if(isset($_GET['sortBy'])){if($_GET['sortBy']==='za'){echo 'selected=selected';}}?>>
                    Name Z-A
                </option>
            </select>
        </div>
    </div>
</div>

<!-- Add car make -->
@if(Auth::user()->user_rights==='Admin')
<div class="row justify-content-center">
    <div class="col-md-10 panel-style">
        <a href="/carmodel_add" class="panel-button">
            <p class="text-center mt-3">
                <i class="fas fa-plus fa-3x"></i>
            </p>
            <h5 class="text-center mb-3">Add Car Model</h5>
        </a>
    </div>
</div>
@endif
<!-- List Car Makes -->
<div class="row justify-content-center">
    @foreach($carModels as $carModel)

    <?php
    $carModelImgPath = 'storage/carmodel/' . $carModel->car_model_id . '.png';
    ?>

    <div class="col-md-5 panel-style">
        <a href="/carmodel_show/{{$carModel->car_model_id}}" class="panel-button">
            <p class="text-center mt-3">
                <img src="{{asset($carModelImgPath)}}" alt="carmodel_img" class="car_model_img" />
            </p>
            <h5 class="text-center mb-3">{{$carModel->car_model_name}}</h5>
        </a>
        <h6 class="text-center mb-3">$ {{$carModel->car_model_price}}</h6>
        <div class="row justify-content-center mb-1">
            <a href="/carmodel_show/{{$carModel->car_model_id}}" class="btn btn-light col-md-6">Select</a>
        </div>
        @if(Auth::user()->user_rights==='Admin')
        <div class="row justify-content-center mb-1">
            <a href="/carmodel_edit/{{$carModel->car_model_id}}" class="btn btn-primary mr-1 col-md-3">Edit</a>
            <a href="/carmodel_remove/{{$carModel->car_model_id}}" class="btn btn-danger ml-1 col-md-3">Remove</a>
        </div>
        @endif
    </div>
    @endforeach
</div> <!-- Close ROW div -->


<!-- Paginator-->
<div class="row mt-5 justify-content-center">
      <?php echo $carModels->render(); ?>
</div>



@endsection

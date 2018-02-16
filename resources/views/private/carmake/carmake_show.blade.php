@extends('layouts.main')

@section('title')
Car make
@endsection

@section('content')
<!-- Page title and Order by -->
<div class="row mt-5">

    <!-- Page title -->
    <div class="col-md-6 d-flex justify-content-left">
        <h1 class="text-left">Car Make</h1>
    </div>

    <!-- Order By -->
    <div class="col-md-6 d-flex justify-content-right">

        <div class="col-md-5 mt-3">
            <h4 class="text-center">Sort by</h4>
        </div>

        <div class="col-md-7 mt-3">
            <select class="custom-select col-md-12" id="carMakeSort" onchange="sortCarMakes()">
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
<div class="row justify-content-center mt-5">
    @if(Auth::user()->user_rights==='Admin')
    <div class="col-md-2 panel-style">
        <a href="/carmake_add" class="panel-button">
            <p class="text-center mt-3">
                <i class="fas fa-plus fa-3x add-button"></i>
            </p>
            <h5 class="text-center mb-3">Add Car Make</h5>
        </a>
    </div>
    @endif
<!-- List Car Makes -->
    @foreach($carMakes as $carMake)

    <?php
    $carMakeImgPath = 'storage/carmake/' . $carMake->car_make_id . '.png';
    ?>

    <div class="col-md-2 panel-style">
        <a href="/carmodel/{{$carMake->car_make_name}}" class="panel-button">
            <p class="text-center mt-3">
                <img src="{{asset($carMakeImgPath)}}" alt="carmake_img" class="car_make_img" />
            </p>
            <h5 class="text-center mb-3">{{$carMake->car_make_name}}</h5>
        </a>
        <div class="row justify-content-center mb-1">
            <a href="#" class="btn btn-light col-md-7">Select</a>
        </div>
        @if(Auth::user()->user_rights==='Admin')
        <div class="row justify-content-center mb-1">
            <a href="/carmake_edit/{{$carMake->car_make_id}}" class="btn btn-primary mr-1">Edit</a>
            <a href="/carmake_remove/{{$carMake->car_make_id}}" class="btn btn-danger ml-1">Remove</a>
        </div>
        @endif
    </div>
    @endforeach
</div> <!-- Close ROW div -->

<!-- Paginator-->
<div class="row mt-5 justify-content-center">
      <?php echo $carMakes->render(); ?>
</div>

@endsection

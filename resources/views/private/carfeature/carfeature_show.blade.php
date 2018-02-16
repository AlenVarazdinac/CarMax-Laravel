@extends('layouts.main')

@section('title')
Car feature
@endsection

@section('content')

<?php $number=1;?>

<!-- Page title and Order by -->
<div class="row mt-5">

    <!-- Page title -->
    <div class="col-md-6 d-flex justify-content-left">
        <h1 class="text-left">Car feature</h1>
    </div>

    <!-- Sort By -->
    <div class="col-md-6 d-flex justify-content-right">

        <div class="col-md-5 mt-3">
            <h4 class="text-center">Sort by</h4>
        </div>

        <div class="col-md-7 mt-3">
        <!--
            <p class="mb-1">
                Name
            </p>
            <a class="mt-1" href="/carfeature?sortBy=az">A-Z</a><span> | </span>
            <a href="/carfeature?sortBy=za">Z-A</a>
        -->
            <select id="carFeatureSort" onchange="sortCarFeatures()" class="custom-select col-md-12">
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

<div class="row justify-content-center mt-5">
    <div class="col-md-12">
        <table class="table table-striped table-inverse carfeature_table">
            <thead>
                <tr>
                    <th class="text-center">
                        #
                    </th>
                    <th class="text-center">
                        Feature name
                    </th>
                    @if(Auth::user()->user_rights==='Admin')
                    <th class="text-center">
                        Option
                    </th>
                    @endif
                </tr>
            </thead>

            @include('private.carfeature.carfeature_data')

        </table>

        <!-- Paginator-->
        <div class="row mt-5 justify-content-center">
            <?php
            echo $carFeatures->appends('sortBy', $sortBy)->render();
            ?>
        </div>

    </div>
</div>

@endsection

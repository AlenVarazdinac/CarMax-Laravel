@extends('layouts.main')

@section('title')
    About
@endsection

@section('content')

    <div class="row justify-content-center mt-5">
        <div class="col-md-12">
            <h1 class="text-center">About</h1>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-md-6">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d86720.1403106756!2d8.567134531407984!3d47.216496507057386!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x213e0c79afac3d32!2sCarmax+AG!5e0!3m2!1sen!2shr!4v1508097549019"
            height="450" class="w-100" frameborder="0" style="border:0" allowfullscreen></iframe>
        </div>

        <div class="col-md-6 mt-4 mt-md-0">
            <p class="text-left">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
                Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
            </p>
        </div>
    </div>

@endsection

<?php

namespace App\Http\Controllers;

use App\CarMake;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CarMakeController extends Controller
{
    // Function to fetch all car makes for listing
    public function listCarMake(Request $request) {
        // Check if Request from JavaScript onchange has 'SortBy'
        if($request->has('sortBy')){
            $sortBy = $request->input('sortBy');
        } else {
            $sortBy = 'az';
        }
        if($sortBy === 'az') {
            $sortBy = 'az';
            // Get CarMakes from Database
            $carMakes = DB::table('car_makes')->orderBy('car_make_name', 'asc')->paginate(6);
            $carMakes->appends(array('sortBy' => $sortBy))->render();
        }else{
            $sortBy = 'za';
            // Get CarMakes from Database
            $carMakes = DB::table('car_makes')->orderBy('car_make_name', 'desc')->paginate(6);
            $carMakes->appends(array('sortBy' => $sortBy))->render();
        }

        // Return view with CarMakes
        return view('private.carmake.carmake_show')->with(['carMakes' => $carMakes]);
    }

    public function addCarMake(Request $request) {
        // Validate form
        $this->validate($request, [
            'car_make_name' => 'required|unique:car_makes',
            'car_make_file' => 'required'
        ]);
        // Assign values from $request
        $carMakeName = $request->car_make_name;
        $carMakeImg = $request->car_make_file;
        // Create new CarMake
        $carMake = new CarMake;
        $carMake->car_make_name = $carMakeName;
        // Save CarMake
        $carMake->save();
        // Get last inserted CarMake ID
        $carMakeId = DB::getPdo()->lastInsertId();
        // Store image
        Storage::disk('public')->put('carmake/' . $carMakeId . '.png', file_get_contents($carMakeImg));
        // Redirect user to CarMake page
        return redirect('carmake');
    }

    // Function to get CarMake by Id for values/placeholder
    public function getCarMake($carMakeId) {
        // Get CarMake from database
        $carMake = DB::table('car_makes')->select()->where('car_make_id', '=', $carMakeId)->first();
        // Return edit carmake view with carMake variable
        return view('private.carmake.carmake_edit')->with(['carMake' => $carMake]);
    }

    // Edit existing CarMake
    public function editCarMake(Request $request, $carMakeId) {
        if(!empty($request->car_make_name)) {
            $carMakeName = $request->car_make_name;
            DB::table('car_makes')->where('car_make_id', '=', $carMakeId)->update(['car_make_name' => $carMakeName]);
        }

        if($request->hasFile('car_make_file')) {
            $carMakeImg = $request->car_make_file;
            Storage::disk('public')->put('carmake/' . $carMakeId . '.png', file_get_contents($carMakeImg));
        }
        return redirect('/carmake');
    }

    // Remove Car Make Function
    public function removeCarMake($carMakeId) {
        // Delete car make from database
        DB::table('car_makes')->where('car_make_id', '=', $carMakeId)->delete();
        // Remove image from storage
        Storage::disk('public')->delete('carmake/' . $carMakeId . '.png');
        // Redirect back
        return redirect()->back();
    }
}

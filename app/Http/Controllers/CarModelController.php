<?php

namespace App\Http\Controllers;

use App\CarModel;
use App\ModelFeature;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CarModelController extends Controller
{
    // Function to fetch all car models for listing
    public function listCarModel(Request $request) {
        if($request->has('sortBy')){
            $sortBy = $request->input('sortBy');
        }else{
            $sortBy = 'pricelowtohigh';
        }

        if($sortBy === 'pricelowtohigh') {
            $sortBy = 'pricelowtohigh';
            // Get CarModels from Database
            $carModels = DB::table('car_models')->orderBy('car_model_price', 'asc')->paginate(8);
            $carModels->appends(array('sortBy' => $sortBy))->render();
        }else if($sortBy === 'pricehightolow'){
            $sortBy = 'pricehightolow';
            // Get CarModels from Database
            $carModels = DB::table('car_models')->orderBy('car_model_price', 'desc')->paginate(8);
            $carModels->appends(array('sortBy' => $sortBy))->render();
        }else if($sortBy === 'az'){
            $sortBy = 'az';
            // Get CarModels from Database
            $carModels = DB::table('car_models')->orderBy('car_model_name', 'asc')->paginate(8);
            $carModels->appends(array('sortBy' => $sortBy))->render();
        }else{
            $sortBy = 'za';
            // Get CarModels from Database
            $carModels = DB::table('car_models')->orderBy('car_model_name', 'desc')->paginate(8);
            $carModels->appends(array('sortBy' => $sortBy))->render();
        }
        // Return view with CarModels
        return view('private.carmodel.carmodel_list')->with(['carModels' => $carModels]);
    }

    // Get CarMakes for Select in CarModel ADD Form
    public function getCarMakes() {
        DB::beginTransaction();
        // Get CarMakes
        $carMakes = DB::table('car_makes')->select()->get();
        // Get CarFeatures
        $carFeatures = DB::table('car_features')->select()->get();
        DB::commit();
        // Return to form with CarMakes
        return view('private.carmodel.carmodel_add')->with(['carMakes' => $carMakes, 'carFeatures' => $carFeatures]);
    }

    // Add car model in database
    public function addCarModel(Request $request) {
        // Validate form
        $this->validate($request, [
            'car_make' => 'required',
            'car_model_name' => 'required',
            'car_variant' => 'nullable',
            'gearbox_type' => 'required',
            'fuel_type' => 'required',
            'car_power' => 'required',
            'car_mileage' => 'required',
            'car_price' => 'required',
            'car_model_file' => 'required'
        ]);
        // Assign values from Request
        $carMake = $request->car_make;
        $carModelName = $request->car_model_name;
        $carVariant = $request->car_variant;
        $gearboxType = $request->gearbox_type;
        $fuelType = $request->fuel_type;
        $fuelCons = $request->car_fuel_cons;
        $carPower = $request->car_power;
        $carMileage = $request->car_mileage;
        $carPrice = $request->car_price;
        $carDescription = $request->car_description;
        $carImage = $request->car_model_file;

        // Create New CarModel
        $carModel = new CarModel;
        $carModel->car_model_name = $carModelName;
        $carModel->car_model_variant = $carVariant;
        $carModel->car_model_price = $carPrice;
        $carModel->car_model_power = $carPower;
        $carModel->car_model_mileage = $carMileage;
        $carModel->car_model_fuel_type = $fuelType;
        $carModel->car_model_fuel_cons = $fuelCons;
        $carModel->car_model_gearbox = $gearboxType;
        $carModel->car_model_desc = $carDescription;
        $carModel->car_make_id = $carMake;
        // Save CarModel
        $carModel->save();
        // Get last inserted CarModel ID
        $carModelId = DB::getPdo()->lastInsertId();

        // Insert CarFeatures into ModelFeature table
        $modelFeatures = array();
        $modelFeatures = $request->input('car_feature');
        $featuresArray = [];
        foreach ($modelFeatures as $feature) {
            $featuresArray[] = [
                'model_id' => $carModelId,
                'feature_id' => $feature
            ];
        }
        DB::table('model_features')->insert($featuresArray);

        // Store image
        Storage::disk('public')->put('carmodel/' . $carModelId . '.png', file_get_contents($carImage));
        // Redirect to ModelFeature Controller
        return redirect('/carmodel');
    }

    // Show CarModel
    public function showCarModel($carModelId) {
        // Get carmodel from database
        $carModel = DB::table('car_makes')
        ->leftJoin('car_models', 'car_makes.car_make_id', '=', 'car_models.car_make_id')
        ->leftJoin('model_features', 'car_models.car_model_id', '=', 'model_features.model_id')
        ->leftJoin('car_features', 'model_features.feature_id', '=', 'car_features.car_feature_id')
        ->select()->where('car_models.car_model_id', '=', $carModelId)->get();

        return view('private.carmodel.carmodel_show')->with(['carModel' => $carModel]);
    }

    // Function to get CarMake by Id for values/placeholder (EDIT)
    public function getCarModel($carModelId) {
        // Get all CarModel details from database
        $carModel= DB::table('car_models')
        ->leftJoin('car_makes', 'car_models.car_make_id', '=', 'car_makes.car_make_id')
        ->leftJoin('model_features', 'car_models.car_model_id', '=', 'model_features.model_id')
        ->leftJoin('car_features', 'model_features.feature_id', '=', 'car_features.car_feature_id')
        ->select()->where('car_model_id', '=', $carModelId)->first();
        // Get Features for checkboxes
        $carFeatures = DB::table('car_features')->select()->get();
        // Return edit CarModel
        return view('private.carmodel.carmodel_edit')->with(['carModel' => $carModel, 'carFeatures' => $carFeatures]);
    }

    // Edit CarModel
    public function editCarModel(Request $request, $carModelId) {
        // Update existing values if provided
        $carModelName = $request->car_model_name;
        $carModelVariant = $request->car_variant;
        $carGearboxType = $request->gearbox_type;
        $carFuelType = $request->fuel_type;
        $carFuelCons = $request->car_fuel_cons;
        $carPower = $request->car_power;
        $carMileage = $request->car_mileage;
        $carPrice = $request->car_price;
        $carDesc = $request->car_description;

        DB::table('car_models')->where('car_model_id', '=', $carModelId)->update([
            'car_model_name' => $carModelName,
            'car_model_variant' => $carModelVariant,
            'car_model_price' => $carPrice,
            'car_model_power' => $carPower,
            'car_model_mileage' => $carMileage,
            'car_model_fuel_type' => $carFuelType,
            'car_model_fuel_cons' => $carFuelCons,
            'car_model_gearbox' => $carGearboxType,
            'car_model_desc' => $carDesc
        ]);

        // Delete car features from car model
        DB::table('model_features')->where('model_id', '=', $carModelId)->delete();

        // Insert CarFeatures into ModelFeature table
        $modelFeatures = array();
        $modelFeatures = $request->input('car_feature');
        $featuresArray = [];
        if(!empty($modelFeatures)){
            foreach ($modelFeatures as $feature) {
                $featuresArray[] = [
                    'model_id' => $carModelId,
                    'feature_id' => $feature
                ];
            }
        }

        DB::table('model_features')->insert($featuresArray);

        // Change existing picture if provided
        if($request->hasFile('car_model_file')) {
            $carModelImg = $request->car_model_file;
            Storage::disk('public')->put('carmodel/' . $carModelId . '.png', file_get_contents($carModelImg));
        }

        return redirect('/carmodel');
    }

    // Remove Car Model Function
    public function removeCarModel($carModelId) {
        // Delete features for selected car
        DB::table('model_features')->where('model_id', '=', $carModelId)->delete();
        // Delete Car Model from Database
        DB::table('car_models')->where('car_model_id', '=', $carModelId)->delete();
        // Remove image from storage
        Storage::disk('public')->delete('carmodel/' . $carModelId . '.png');
        // Redirect back
        return redirect()->back();
    }

    public function getCarsForHome(){
        $mostExpensiveModel = DB::table('car_models')->orderBy('car_model_price', 'desc')->first();
        $cheapestModel = DB::table('car_models')->orderBy('car_model_price', 'asc')->first();
        $latestAddedModel = DB::table('car_models')->orderBy('car_model_id', 'desc')->first();
        return view('home')->with(['mostExpensiveModel' => $mostExpensiveModel,
        'cheapestModel' => $cheapestModel, 'latestAddedModel' => $latestAddedModel]);
    }

}

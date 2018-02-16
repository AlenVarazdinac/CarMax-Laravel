<?php

namespace App\Http\Controllers;

use App\CarFeature;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class CarFeatureController extends Controller
{
    // Function to fetch all car features for listing
    public function listCarFeatures(Request $request) {

        if($request->has('sortBy')){
            $sortBy = $request->input('sortBy');
        } else {
            $sortBy = 'az';
        }
        if($sortBy === 'az') {
            $sortBy = 'az';
            $carFeatures = DB::table('car_features')->orderBy('car_feature_name', 'asc')->paginate(5);
            $carFeatures->appends(array('sortBy' => $sortBy))->render();
        } else {
            $sortBy = 'za';
            $carFeatures = DB::table('car_features')->orderBy('car_feature_name', 'desc')->paginate(5);
            $carFeatures->appends(array('sortBy' => $sortBy))->render();
        }
        /*
        if($request->ajax()) {
            $view = view('private.carfeature.carfeature_data', compact('carFeatures', 'sortBy'));
            return $view->render();
        }
        */
        return view('private.carfeature.carfeature_show')->with(['carFeatures' => $carFeatures])->with(['sortBy' => $sortBy]);

    }

    public function addCarFeature(Request $request) {
        // Validate form
        $this->validate($request, [
            'car_feature_name' => 'required'
        ]);
        // Assign values from request
        $carFeatureName = $request->car_feature_name;
        // Create new Car Feature
        $carFeature = new CarFeature;
        $carFeature->car_feature_name = $carFeatureName;
        // Save created car feature
        $carFeature->save();
        // Redirect back to CarFeature page
        return redirect('carfeature');
    }

    // Get car feature for edit placeholder
    public function getCarFeature($carFeatureId) {
        // Get CarFeature from database
        $carFeature = DB::table('car_features')->select()->where('car_feature_id', '=', $carFeatureId)->first();
        // Get CarFeature edit page
        return view('private.carfeature.carfeature_edit')->with(['carFeature' => $carFeature]);
    }

    // Function for editing existing Car Features
    public function editCarFeature(Request $request, $carFeatureId) {
        if(!empty($request->car_feature_name)) {
            $carFeatureName = $request->car_feature_name;
            DB::table('car_features')->where('car_feature_id', '=', $carFeatureId)->update(['car_feature_name' => $carFeatureName]);
        }
        return redirect('/carfeature');
    }

    // Remove CarFeature from database
    public function removeCarFeature($carFeatureId) {
        DB::table('car_features')->where('car_feature_id', '=', $carFeatureId)->delete();
        // Redirect back
        return redirect()->back();
    }
}

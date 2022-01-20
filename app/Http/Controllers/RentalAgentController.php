<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RentalAgentController extends Controller
{
    public function new_car() {
        return view('car-rental-agency.addCar');
    }

    public function list_all_cars_to_edit() {
        return view('car-rental-agency.all_cars_to_edit');
    }

    public function store_new_car(Request $request) {
        $request->validate([
            'model_no'=>'required|string|min:3| max:25',
            'vehicle_no'=> 'required|string|min:3| max:15',
            'rent_per_day'=>'required| integer| min:100| max: 10000'
        ]);
        $auth_id= Auth::id();
        $car= new Car();
        $car->user_id= $auth_id;
        $car->model_no = $request->model_no;
        $car->vehicle_no= $request->vehicle_no;
        $car->capacity= $request->capacity;
        $car->rent_per_day= $request->rent_per_day;

        if($car->save()){
            return back()->with('success','Car successfully added for Renting');
        }else{
            return back()->with('success','Something went wrong !! please try again');
        }
    }

    public function edit_details($id) {
        $car = Car::findOrFail($id);
        $not_yours= false;
        $user= Auth::user();
        if(!$car->ifCarBelongsToAgent($user,$car)) {
            $belongs_to_message = "You can not edit details of this car !! This car doesNot belong to you";
            $not_yours=true;
        }
        else
            $belongs_to_message= "this car belongs to auth user";
        return view('car-rental-agency.editCarDetails',[
            'car'=>$car,
            'belongs_to_message'=>$belongs_to_message,
            'not_yours'=>$not_yours
        ]);
    }

    public function save_edited_details(Request $request) {
        $request->validate([
            'model_no'=>'required|string|min:3| max:25',
            'vehicle_no'=> 'required|string|min:3| max:15',
            'rent_per_day'=>'required| integer| min:100| max: 10000'
        ]);
        $car= Car::findOrFail($request->get('car_id'));
        $car->model_no = $request->model_no;
        $car->vehicle_no= $request->vehicle_no;
        $car->capacity= $request->capacity;
        $car->rent_per_day= $request->rent_per_day;
        if($car->update()){
            return back()->with('success','Car successfully added for Renting');
        }else{
            return back()->with('success','Something went wrong !! please try again');
        }
    }


}

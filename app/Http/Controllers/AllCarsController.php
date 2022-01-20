<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Rent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AllCarsController extends Controller
{
    public function all_cars_available_for_rent() {
        $cars= Car::all();
        return view('index',[
            'cars'=>$cars
        ]);
    }

    public function car_request_for_rent(Request $request) {
        $request->validate([
            'date'=>'required'
        ]);
        $rent= new Rent();
        $user_id= Auth::id();
        $car_id= $request->get('car_id');
        $car= Car::find($car_id);
        $rent->user_id= $user_id;
        $rent->car_id = $car_id;
        $rent->model_no= $car->model_no;
        $rent->vehicle_no= $car->vehicle_no;
        $rent->capacity= $car->capacity;
        $rent->number_of_days= $request->get('days_to_rent');
        $rent->start_date= $request->get('date');
        if($rent->save()){
            return back()->with('success','Applied Successfully for taking car on rent');
        }else{
            return back()->with('success','Cant Rent at the moment');
        }
    }

    public function list_all_bookings() {
        $user= Auth::user();
        $cars_id_of_auth_user= $user->cars()->pluck('id'); //array of car_ids of auth user
        $bookings= DB::table('rents')
                    ->join('users','rents.user_id','=','users.id')
                    ->whereIn('rents.car_id',$cars_id_of_auth_user)
                    ->get();
        return view('car-rental-agency.viewBookedCars',[
            'bookings'=>$bookings,
        ]);
    }

}

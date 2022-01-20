<?php

use App\Http\Controllers\AllCarsController;
use App\Http\Controllers\RentalAgentController;
use Illuminate\Support\Facades\Route;

Route::get('/',function (){
    return redirect('/available-for-rent');
});
Route::get('/available-for-rent',[AllCarsController::class,'all_cars_available_for_rent'])->name('rent.available');
Route::post('/available-for-rent',[AllCarsController::class,'car_request_for_rent'])->middleware(['auth'])->name('take.on.rent');

Route::group(['middleware'=>['auth','agent']],function (){
    Route::get('/addCarToRent',[RentalAgentController::class,'new_car'])->name('new.car');
    Route::post('/addCarToRent',[RentalAgentController::class,'store_new_car'])->name('store.car');

    Route::get('/edit-car-rental-details',[RentalAgentController::class,'list_all_cars_to_edit'])->name('allcars.edit');
    Route::get('/edit-car-rental-details/{id}',[RentalAgentController::class,'edit_details'])->name('car.edit');
    Route::post('/edit-car-rental-details/{id}',[RentalAgentController::class,'save_edited_details'])->name('car.saveEdited');

    Route::get('/list-all-bookings',[AllCarsController::class,'list_all_bookings'])->name('list.car');
});



require __DIR__.'/auth.php';

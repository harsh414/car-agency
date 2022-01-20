@extends('layouts.app')
@section('content')
    <div class="text-center text-2xl font-bold text-gray-500 tracking-widest">Bookings for your cars</div>
    @if($bookings->count()==0)
        <div class="bookings-container bg-white rounded-xl px-2 py-2 mt-4">
            <div class="text-center font-bold text-2xl text-gray-600 text-lg tracking-widest">No Request's for Rent</div>
        </div>
    @else
    @foreach($bookings as $booking)
        <div class="bookings-container bg-white rounded-xl px-2 py-2 flex space-x-24 items-center mt-4">
            <div class="flex flex-col space-y-4 items-center sm:justify-between md:flex-row md:space-x-16">
                <div class="flex items-center space-x-24 justify-between">
                    <div class="bg-gray-200">
                        <img src="https://imgd.aeplcdn.com/0x0/n/cw/ec/27032/s60-exterior-right-front-three-quarter-3.jpeg" alt="avatar" class="w-24 h-24 rounded-full">
                    </div>
                    <div>
                        <div class="flex flex-col items-center space-y-2">
                            <div class="car_agent font-bold text-gray-600 tracking-widest">Requested By:</div>
                            <div>{{$booking->name}}</div>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="flex flex-col space-y-2 items-center">
                        <div>
                            <div class="vehicle_model font-bold text-gray-600 tracking-widest">Email of user:</div>
                            <div class="text-center">{{$booking->email}}</div>
                        </div>
                        <div>
                            <div class="capacity font-bold text-gray-600 tracking-widest">Capacity: {{$booking->capacity}}</div>
                        </div>
                    </div>
                    <div class="flex space-x-2">
                        <div class="vehicle_model font-bold text-gray-600 tracking-widest">Vehicle Number</div>
                        <div>{{$booking->vehicle_no}}</div>
                    </div>
                </div>
                <div class="flex items-center space-x-24 justify-between">
                    <div>
                        <span class="font-bold text-gray-600">Model  No</span>
                        {{$booking->model_no}}
                    </div>
                    <div>
                        <div class="font-bold text-gray-600">Requested For(Days): </div>
                        {{$booking->number_of_days}}
                    </div>
                </div>
                <div class="flex items-center space-x-24 justify-between">
                    <div class="font-bold text-gray-600">Start Date: &nbsp</div>
                    {{$booking->start_date}}
                </div>
            </div>
        </div>
    @endforeach
        <div style="height: 120px"></div>
    @endif
@endsection


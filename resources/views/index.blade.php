@extends('layouts.app')
@section('content')
{{--    <header>--}}
{{--        <img src="https://mexicaninsurancestore.com/blog/wp-content/uploads/2014/02/car-rental-mexico.jpg" class="w-full" style="height: 30rem">--}}
{{--    </header>--}}
    <div class="text-center px-6 py-2" x-data="{flashMessage:true}">
        @if($errors->any()) <!--  customer trying to add a car -->
            <div class="bg-gray-300 text-center py-4 lg:px-4 mb-4" x-show="flashMessage">
                <div class="p-2 bg-gray-500 items-center text-indigo-100 leading-none lg:rounded-full flex lg:inline-flex" role="alert">
                    <span class="font-semibold mr-2 text-left flex-auto">{{$errors->first()}}</span>
                    <svg @click="flashMessage=false" xmlns="http://www.w3.org/2000/svg" class="cursor-pointer h-6 w-6 border border-l-2 border-gray-400 px-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </div>
            </div>
        @endif
        @if(session()->has('success'))
            <div class="bg-gray-300 text-center py-4 lg:px-4 mb-4" x-show="flashMessage">
                <div class="p-2 bg-gray-500 items-center text-indigo-100 leading-none lg:rounded-full flex lg:inline-flex" role="alert">
                    <span class="font-semibold mr-2 text-left flex-auto">{{session()->get('success')}}</span>
                    <svg @click="flashMessage=false" xmlns="http://www.w3.org/2000/svg" class="cursor-pointer h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </div>
            </div>
        @endif
    </div>
{{--        <img src="https://www.gravatar.com/avatar/00000000000000000000000000000000?d=mp" alt="avatar" class="w-16 h-16 rounded-xl">--}}
        <div class="text-center text-2xl font-bold text-gray-500 tracking-widest">Cars available for Rent</div>
    @foreach($cars as $car)
        <div class="car-container bg-white rounded-xl px-2 py-2 flex space-x-24 items-center mt-4 sm:justify-center">
            <form action="{{route('take.on.rent')}}" method="POST" id="{{$car->id}}">
                {{@csrf_field()}}
                <input type="hidden" name="car_id" value="{{$car->id}}">
                <div class="flex flex-col space-y-4 items-center sm:justify-between md:flex-row md:space-x-16">
                    <div class="flex items-center space-x-24 justify-between">
                        <div class="bg-gray-200">
                            <img src="https://imgd.aeplcdn.com/0x0/n/cw/ec/27032/s60-exterior-right-front-three-quarter-3.jpeg" alt="avatar" class="w-24 h-24 rounded-full">
                        </div>
                        <div>
                            <div class="flex flex-col items-center space-y-2">
                                <div class="car_agent font-bold text-gray-600 tracking-widest">Car Agent:</div>
                                <div>{{$car->agent->name}}</div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="flex flex-col space-y-2 items-center">
                            <div>
                                <div class="vehicle_model font-bold text-gray-600 tracking-widest">Vehicle Model:</div>
                                <div class="text-center">{{$car->model_no}}</div>
                            </div>
                            <div>
                                <div class="capacity font-bold text-gray-600 tracking-widest">Capacity: {{$car->capacity}}</div>
                            </div>
                        </div>
                        <div class="flex space-x-2">
                            <div class="vehicle_model font-bold text-gray-600 tracking-widest">Vehicle Number</div>
                            <div>{{$car->vehicle_no}}</div>
                        </div>
                    </div>
                    <div class="flex items-center space-x-8 justify-between">
                        <div>
                            <span class="font-bold text-gray-600">Rent per day:</span>
                            {{$car->rent_per_day}}
                        </div>
                        <div>
                            <div>Days to Rent Car</div>
                            <select name="days_to_rent" id="days_to_rent" class="w-full bg-gray-100 text-sm rounded-xl border-none px-4 py-2">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                            </select>
                        </div>
                    </div>
                    <div class="start-date">
                        <input type="text" autocomplete="off" onkeydown="return false;" class="form-control datepicker border rounded-full w-32 focus:outline-none outline-none" name="date" value="" placeholder="start date">
                    </div>
                    <div>
                        @if(auth()->user() &&  auth()->user()->user_type=="customer")
                            <button type="submit" class="flex items-center justify-center  h-9 text-xs bg-blue-600 text-white font-semibold rounded-xl border border-blue hover:bg-blue-hover transition duration-150 ease-in px-6 py-3">
                                <span class="ml-1">Rent Now</span>
                            </button>
                        @elseif(auth()->user() &&  auth()->user()->user_type=="agent")
                            <button type="submit" disabled class="cursor-not-allowed disabled:opacity-50 flex items-center justify-center  h-9 text-xs bg-blue-600 text-white font-semibold rounded-xl border border-blue hover:bg-blue-hover transition duration-150 ease-in px-6 py-3">
                                <span class="ml-1">Rent Now</span>
                            </button>
                        @else
                            <button type="submit" class="flex items-center justify-center  h-9 text-xs bg-blue-600 text-white font-semibold rounded-xl border border-blue hover:bg-blue-hover transition duration-150 ease-in px-6 py-3">
                                <a href="{{route('login.customer')}}" class="hover:text-white">Login for booking</a>
                            </button>
                        @endif
                    </div>
                </div>
            </form>
        </div>
    @endforeach
@endsection


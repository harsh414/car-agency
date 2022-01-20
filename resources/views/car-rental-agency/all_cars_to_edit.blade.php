@extends('layouts.app')
@section('content')
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
    <div class="text-center text-2xl font-bold text-gray-500 tracking-widest">Edit Details for your cars</div>
    @if(auth()->user()->cars()->count() ==0)
        <div class="bg-indigo-500 text-center py-4 lg:px-4 mb-4" x-show="flashMessage">
            <div class="p-2 text-white bg-indigo-500 items-center text-indigo-100 leading-none lg:rounded-full flex lg:inline-flex" role="alert">
                <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z"/></svg>
            </div>
            <span class="text-white font-semibold mr-2 text-left flex-auto">No cars to edit</span>
        </div>
    @else
        @foreach(auth()->user()->cars as $car)
            <div class="car-container bg-white rounded-xl px-2 py-2 flex space-x-24 items-center mt-4 sm:justify-center">
                <form action="{{route('take.on.rent')}}" method="POST" id="{{$car->id}}">
                    {{@csrf_field()}}
                    <input type="hidden" name="car_id" value="{{$car->id}}">
                    <div class="flex flex-col space-y-4 items-center sm:justify-between md:flex-row md:space-x-32">
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
                        <div>
                            <button type="submit" class="flex items-center justify-center  h-9 text-xs bg-blue-600 text-white font-semibold rounded-xl border border-blue hover:bg-blue-hover transition duration-150 ease-in px-6 py-3">
                                <a href="{{route('car.edit',$car->id)}}" class="hover:text-white tracking-wider">EDIT DETAILS</a>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        @endforeach
    @endif
@endsection


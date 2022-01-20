@extends('layouts.app')
@section('content')
    <div class="bg-gray-100 border-2 border-blue rounded-xl mt-4 mb-24 container mx-auto"
         style="border-image-source: linear-gradient(to bottom, rgba(50, 138, 241, 0.22), rgba(99, 123, 255, 0));
                                border-image-slice: 1;background-image: linear-gradient(to bottom, #ffffff, #ffffff), linear-gradient(to bottom, rgba(50, 138, 241, 0.22), rgba(99, 123, 255, 0));
                                background-origin: border-box;background-clip: content-box, border-box;">
        <div class="text-center bg-gray-200 px-6 py-2 pt-6" x-data="{flashMessage:true}">
            @if(session()->has('success'))
                <div class="bg-indigo-900 text-center py-4 lg:px-4 mb-4" x-show="flashMessage">
                    <div class="p-2 bg-indigo-800 items-center text-indigo-100 leading-none lg:rounded-full flex lg:inline-flex" role="alert">
                        <span class="font-semibold mr-2 text-left flex-auto">{{session()->get('success')}}</span>
                        <svg @click="flashMessage=false" xmlns="http://www.w3.org/2000/svg" class="cursor-pointer h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </div>
                </div>
            @endif
            @if($errors->any())
                <div class="bg-indigo-500 text-center py-4 lg:px-4 mb-4" x-show="flashMessage">
                    <div class="p-2 text-white bg-indigo-500 items-center text-indigo-100 leading-none lg:rounded-full flex lg:inline-flex" role="alert">
                        <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z"/></svg>
                    </div>
                    <span class="text-white font-semibold mr-2 text-left flex-auto">{{$errors->first()}}</span>
                    <svg @click="flashMessage=false" xmlns="http://www.w3.org/2000/svg" class="border-b border-r border-t border-white cursor-pointer h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="white">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </div>
            @endif
            @if($not_yours==true)
                <div class="bg-indigo-500 text-center py-4 lg:px-4 mb-4" x-show="flashMessage">
                    <div class="p-2 text-white bg-indigo-500 items-center text-indigo-100 leading-none lg:rounded-full flex lg:inline-flex" role="alert">
                        <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z"/></svg>
                    </div>
                    <span class="text-white font-semibold mr-2 text-left flex-auto">{{$belongs_to_message}}</span>
                </div>
            @else
                <h3 class="font-semibold text-xl tracking-wider">Edit Your Car Details</h3>
                <p class="mt-4 tracking-wide">Edit the existing details of your car</p>
                <form action="{{route('car.saveEdited',$car->id)}}" method="POST" class="px-3 py-6">
                    {{@csrf_field()}}
                    <input type="hidden" name="car_id" value="{{$car->id}}">
                    <div class="mb-8">
                        <div class="text-left text-sm tracking-wider pl-2 mb-2">Model No</div>
                        <input type="text" name="model_no" id="model_no" value="{{$car->model_no}}" class="bg-white border-none w-full rounded mt-1 placeholder-gray-500">
                    </div>
                    <div class="mb-8">
                        <div class="text-left text-sm tracking-wider pl-2">Vehicle No</div>
                        <input type="text" name="vehicle_no" id="vehicle_no" value="{{$car->vehicle_no}}" class="bg-white border-none w-full rounded mt-1 placeholder-gray-500" placeholder="Vehicle Number">
                    </div>
                    <div>
                        <div class="text-left text-sm tracking-wider pl-2 mb-2">Capacity</div>
                        <select name="capacity" id="capacity" class="w-full bg-gray-100 text-sm rounded-xl border-none px-4 py-2">
                                <option value="{{$car->capacity}}">{{$car->capacity}}</option>
                            @for($i=1;$i<=7;$i++)
                                @if($i==$car->capacity) @continue @endif
                                <option value="{{$i}}">{{$i}}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="mt-4">
                        <div class="text-left text-sm tracking-wider pl-2">Rent per day</div>
                        <input type="text" name="rent_per_day" id="rent_per_day" value="{{$car->rent_per_day}}" class="bg-white text-sm border-none w-full text-sm rounded mt-1 placeholder-gray-500" placeholder="Rent/day in INR (100-10000)" >
                    </div>
                    <div class="flex items-center justify-between space-x-3 mt-8">
                        <button type="submit" class="flex items-center justify-center w-1/3 md:w-1/6 h-9 text-xs bg-blue-600 text-white font-semibold rounded-xl border border-blue hover:bg-blue-hover transition duration-150 ease-in px-6 py-3">
                            <span class="ml-1">Edit Now</span>
                        </button>
                    </div>
                </form>
            @endif
        </div>
    </div>
@endsection

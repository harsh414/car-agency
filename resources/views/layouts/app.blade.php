<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}"
    <title></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/semantic-ui@2.4.2/dist/semantic.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link href='https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/ui-lightness/jquery-ui.css' rel='stylesheet'>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href='https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/ui-lightness/jquery-ui.css' rel='stylesheet'>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js" ></script>
    <script src= "https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js" > </script>


</head>
<body class="font-sans bg-gray-background text-gray-900 bg-gray-100" x-data="{top:true}">
<header class="fixed bg-gray-800 sm:bg-gray-800 z-50 flex flex-col top-0 left-0 right-0 md:flex-row items-center text-white justify-center px-8 py-1"
        :class="{'bg-black sm:bg-black md:bg-black lg:bg-black ': !top}"
        @scroll.window="top= (window.pageYOffset)>20 ? false : true">
    <a href="{{route('rent.available')}}" class="flex items-center justify-between space-x-2 hover:text-gray-200" style="text-decoration: none">
        <img src="https://res.cloudinary.com/dkerurdbc/image/upload/v1630087528/carlogo_aiqrxa.png" class="h-12 w-12 rounded-full" alt="">
        <div class="pl-4 text-lg tracking-wider">Car Rental Agency</div>
    </a>
    <div class="flex items-center justify-between ml-6">
        @if (Route::has('login.customer') || Route::has('login.agent'))
            <div class="px-6 py-4 sm:block">
                @auth
                    <div class="flex justify-between items-center space-x-8">
                        @if(auth()->user()->user_type=="agent")
                            <div class="flex-col space-y-2 items-center">
                                <div class="flex space-x-2">
                                    <div class="px-2 py-1 transition ease-in bg-gray-400 text-center rounded-3xl"><a href="{{route('new.car')}}" class="hover:text-white">Add New Car</a></div>
                                    <div class="px-2 py-1 transition ease-in bg-gray-400 text-center rounded-3xl"><a href="{{route('allcars.edit')}}" class="hover:text-white">Edit Car Details</a></div>
                                </div>
                                <div class="px-2 py-1 transition ease-in bg-gray-500 rounded-3xl"><a href="{{route('list.car')}}" class="hover:text-white">List Bookings for your cars</a></div>
                            </div>
                        @endif
                        <div class="flex flex-col items-center space-y-1">
                            <div class="ml-8">{{auth()->user()->name}}</div>
                            <div class="text-xs font-semibold text-white tracking-wider px-2 py-1 rounded-full bg-gray-500">@if(auth()->user()->user_type=="agent") {{('You are a Car Agent')}} @else {{('You are a Customer')}} @endif</div>
                        </div>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a href="{{route('logout')}}" style="text-decoration: none" class="hover:text-white bg-blue-600 transition ease-in font-semibold px-3 py-2 rounded-full"
                               onclick="event.preventDefault();
                                            this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </a>
                        </form>
                    </div>
                @else
                    <button class="relative bg-gray-100 focus:outline-none rounded-full h-7 px-2 py-0.5 ml-3" x-data="{toggleOpen:false}"
                            @click="toggleOpen = !toggleOpen">
                        <svg fill="currentColor" width="24" height="6"><path fill="#73767a" d="M2.97.061A2.969 2.969 0 000 3.031 2.968 2.968 0 002.97 6a2.97 2.97 0 100-5.94zm9.184 0a2.97 2.97 0 100 5.939 2.97 2.97 0 100-5.939zm8.877 0a2.97 2.97 0 10-.003 5.94A2.97 2.97 0 0021.03.06z" style="color: rgba(163, 163, 163, .5)"></svg>
                        <ul @click.away="toggleOpen=false" class="absolute text-left space-y-2 pl-2 ml-12 w-36 sm:w-36 md:w-44 shadow-lg bg-white rounded-xl py-2" x-show="toggleOpen">
                            <a href="{{ route('login.customer') }}" style="text-decoration: none" class="border-b-2 border-gray-200 bg-gray-300 text-black hover:bg-gray-200 hover:text-black block transition duration-150 ease-in px-2">Login (Customer)</a>
                            <a href="{{ route('login.agent') }}" style="text-decoration: none" class="border-b-2 border-gray-200 bg-gray-300 text-black hover:bg-gray-200 hover:text-black block transition duration-150 ease-in px-2">Login (Agent)</a>
                            @if(Route::has('register.customer'))
                                <a href="{{route('register.customer')}}" class="border-b-2 border-gray-200 text-black hover:bg-gray-200 hover:text-black block transition duration-150 ease-in px-2"
                                   style="text-decoration: none" class="ml-4 hover:text-white">Register as Customer</a>
                            @endif
                            @if(Route::has('register.car-rental-agent'))
                                <a href="{{route('register.car-rental-agent')}}" class="border-b-2 border-gray-200 bg-white text-black hover:bg-gray-200 hover:text-black block transition duration-150 ease-in px-2"
                                   style="text-decoration: none" class="ml-4 hover:text-white">Register (Rental agent)</a>
                            @endif
                        </ul>
                    </button>
                @endauth
            </div>
        @endif
    </div>
</header>

<div class="w-full md:mt-0">
    <div class="mt-32 md:mt-0">
        <header>
            <img src="https://mexicaninsurancestore.com/blog/wp-content/uploads/2014/02/car-rental-mexico.jpg" class="w-full" style="height: 30rem">
        </header>
        @yield('content')
        <div class="mt-24"></div>
    </div>
</div>
</body>
<script>
    $(function($){ // wait until the DOM is ready
        $(".datepicker").datepicker({ dateFormat: 'yy-mm-dd' });
    });
</script>
</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Review Portal</title>
    <link rel="shortcut icon" href="{{ asset('images/favicon-logo.png') }}" type="image/x-icon">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- CSS -->
   
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>

    <!-- Swipper Slider -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css" />
    <!-- /* Font Awsome Cdn */ -->
    <link href="https://cdn.jsdelivr.net/gh/hung1001/font-awesome-pro-v6@44659d9/css/all.min.css" rel="stylesheet"
        type="text/css" />

    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="{{ asset('assets/js/bundle.js') }}" defer></script>

    <!-- Scripts -->
    <!-- jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!-- Toastr -->
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
        crossorigin="anonymous" />


    <!-- Styles -->
    @livewireStyles
    @stack('styles')
</head>

<style>
    /* Custom scrollbar style */
    .custom-scrollbar::-webkit-scrollbar {
        width: 8px;
    }

    .custom-scrollbar::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 10px;
    }

    .custom-scrollbar::-webkit-scrollbar-thumb {
        background: #888;
        border-radius: 10px;
    }

    .custom-scrollbar::-webkit-scrollbar-thumb:hover {
        background: #555;
    }
</style>

<body x-data="{ showBar: false }">

    <!-- Navbar -->
    <nav class="bg-blue-500 p-4">
        <div class="container mx-auto flex justify-between items-center">
            <a href="{{ route('home') }}" class="text-white text-2xl font-bold">Review Portal</a>
            <div class="flex space-x-4">
                <a href="{{ route('home') }}" class="text-white">Home</a>
                <a href="#" class="text-white">Categories</a>
                <a href="#" class="text-white">Write a Review</a>
                <a href="#" class="text-white">Contact</a>
                @if (Route::has('login'))
                    @auth
                        <a href="{{ route('logout-user') }}"
                            class="bg-white text-blue-500 px-4 py-2 rounded-full hover:bg-blue-500 hover:text-white">Sign
                            Out</a>
                        @if (!Auth::user()->has_business_account && !Auth::user()->is_admin)
                            <a href="{{ route('business-account.create') }}"
                                class="bg-white text-blue-500 px-4 py-2 rounded-full hover:bg-blue-500 hover:text-white">Create
                                Business Account</a>
                        @else
                            @if (Auth::user()->is_admin)
                                <a href="{{ route('admin.dashboard') }}"
                                    class="bg-white text-blue-500 px-4 py-2 rounded-full hover:bg-blue-500 hover:text-white">Admin
                                    Dashboard</a>
                            @endif

                            @if (Auth::user()->has_business_account)
                                <a href="{{ route('business-owner.details') }}"
                                    class="bg-white text-blue-500 px-4 py-2 rounded-full hover:bg-blue-500 hover:text-white">View Business</a>

                                <a href="{{ route('business-owner.dashboard') }}"
                                    class="bg-white text-blue-500 px-4 py-2 rounded-full hover:bg-blue-500 hover:text-white">Owner Dashboard</a>
                            @endif
                        @endif
                    @else
                        <a href="{{ route('login') }}"
                            class="bg-white text-blue-500 px-4 py-2 rounded-full hover:bg-blue-500 hover:text-white">Login</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}"
                                class="bg-blue-500 text-white px-4 py-2 rounded-full hover:bg-blue-700">Register</a>
                        @endif
                    @endauth
                @endif
            </div>

        </div>
    </nav>

    <!-- <nav class=" bg-[#301200]  dark:bg-gray-900 sticky w-full z-[999] top-0 left-0 transition-all duration-500 header__top " :class="{ 'shadow-[0px_10px_30px_0.18px_#a0a0a02e] transition duration-300': showBar }" @scroll.window="showBar = (window.pageYOffset > 50) ? true : false">
        <div class="flex justify-center items-center gap-3 py-2 text-white bg-cover bg-center" style="background-image: url({{ asset('images/') }}./images/original-brown-leather-texture-background.png);">
            <div class="flex justify-start items-center gap-3">
                <i class="fa-sharp fa-solid fa-circle-check text-sm"></i>
                <span class="text-[#F9F1E6] text-base  font-normal uppercase">
                    FREE UK DELIVERY & RETURNS
                </span>
            </div>
            <div class="bg-[#F9F1E6] w-8 h-[2px]">

            </div>
            <div class="flex justify-start items-center gap-3">
                <i class="fa-sharp fa-solid fa-circle-check text-sm"></i>
                <span class="text-[#F9F1E6] text-base  font-normal uppercase">
                    FOR MORE INFO CALL ON 123456789
                </span>
            </div>
        </div>
        <div class="flex flex-wrap justify-between items-center mx-auto px-5 py-3">
            <a href="https://flowbite.com/" class="flex items-center">
                <img src="{{ asset('images/') }}./images/lala-logo.png" class="mr-3" alt="lala-Logo">
            </a>
            <div class="flex lg:order-2 xl:w-[254px] lg:justify-end">
                <div class="div  justify-center items-center space-x-5 hidden md:flex">
                    <button class="w-[133px] h-[41px] bg-[#511F00] text-white hover:bg-white hover:text-[#511F00] border border-[#511F00]">Sign in</button>
                    <button class="w-[133px] h-[41px] bg-transparent text-white hover:bg-[#511F00] hover:text-white border border-white">Sign up</button>
                </div>
                <button data-collapse-toggle="navbar-sticky" type="button" class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg lg:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-sticky" aria-expanded="false">
                <span class="sr-only">Open main menu</span>
                <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path></svg>
                </button>
            </div>
            <div class="hidden justify-between items-center w-full lg:flex lg:w-auto lg:order-1" id="navbar-sticky">
                <ul class="flex flex-col p-4 mt-4 bg-white lg:bg-transparent rounded-lg border border-gray-100 lg:flex-row lg:space-x-7 xl:space-x-20 lg:mt-0 lg:text-sm lg:font-medium lg:border-0 dark:bg-gray-800 lg:dark:bg-gray-900 dark:border-gray-700">
                <li>
                    <a href="#" class="block relative py-2 pr-4 pl-3 font-[400] text-white text-[16px] bg-blue-700 lg:hover:text-[#6F38C5] rounded lg:bg-transparent lg:text-[#F8E7CF] lg:p-0 dark:text-white " aria-current="page">Dashboard</a>
                </li>
                <li>
                    <a href="#" class="block py-2 pr-4 pl-3 font-[400] text-gray-700 lg:text-[#F8E7CF] rounded text-[16px] hover:bg-gray-100 lg:hover:bg-transparent lg:hover:text-[#6F38C5] lg:p-0 lg:dark:hover:text-white dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white lg:dark:hover:bg-transparent dark:border-gray-700">About us</a>
                </li>
                <li>
                    <a href="#" class="block py-2 pr-4 pl-3 font-[400] text-gray-700 lg:text-[#F8E7CF] rounded text-[16px] hover:bg-gray-100 lg:hover:bg-transparent lg:hover:text-[#6F38C5] lg:p-0 lg:dark:hover:text-white dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white lg:dark:hover:bg-transparent dark:border-gray-700">Products</a>
                </li>
                <li>
                    <a href="#" class="block py-2 pr-4 pl-3 font-[400] text-gray-700 lg:text-[#F8E7CF] rounded text-[16px] hover:bg-gray-100 lg:hover:bg-transparent lg:hover:text-[#6F38C5] lg:p-0 lg:dark:hover:text-white dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white lg:dark:hover:bg-transparent dark:border-gray-700">Services</a>
                </li>
                <li>
                    <a href="#" class="block py-2 pr-4 pl-3 font-[400] text-gray-700 lg:text-[#F8E7CF] rounded text-[16px] hover:bg-gray-100 lg:hover:bg-transparent lg:hover:text-[#6F38C5] lg:p-0 lg:dark:hover:text-white dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white lg:dark:hover:bg-transparent dark:border-gray-700">Contact us</a>
                </li>
                <li class="md:hidden">
                    <a href="#" class="block py-2 pr-4 pl-3 font-[400] text-gray-700 lg:text-[#F8E7CF] rounded text-[16px] hover:bg-gray-100 lg:hover:bg-transparent lg:hover:text-[#6F38C5] lg:p-0 lg:dark:hover:text-white dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white lg:dark:hover:bg-transparent dark:border-gray-700">Sign in</a>
                </li>
                <li class="md:hidden">
                    <a href="#" class="block py-2 pr-4 pl-3 font-[400] text-gray-700 lg:text-[#F8E7CF] rounded text-[16px] hover:bg-gray-100 lg:hover:bg-transparent lg:hover:text-[#6F38C5] lg:p-0 lg:dark:hover:text-white dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white lg:dark:hover:bg-transparent dark:border-gray-700">Sign up</a>
                </li>
                </ul>
            </div>
        </div>
    </nav> -->
    <!-- Navbar -->
    {{-- @livewire('partials.header')   --}}

    {{ $slot }}
    {{-- @livewire('partials.footer') --}}
    {{-- </div> --}}

</body>

@stack('modals')
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script src="https://unpkg.com/flowbite@1.5.2/dist/flowbite.js"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
<script src="{{ asset('assets/js/app.js') }}"></script>
@livewireScriptConfig

@stack('scripts')


</html>

<nav class="fixed w-full z-20 top-0 start-0 transition-all duration-300 ease-in"
    :class="{ 'bg-white shadow-md': scrolled }">
    <div class="container xl:max-w-screen-2xl flex flex-wrap items-center justify-between mx-auto p-4">
        <a href="{{ route('home') }}" class="flex items-center space-x-3 rtl:space-x-reverse">
            @php
                $logo = $settings->where('key', 'app_logo')->whereNotNull('value')->first();
            @endphp
            <img src="{{ asset($logo ? 'storage/'.$logo->value : 'images/LOGO.png') }}" class="" alt="site-Logo" />
        </a>
        <div class="flex md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse">
            <div class="flex justify-start items-center gap-3">

                @if (Route::has('login'))
                    @auth
                        <a href="{{ route('logout-user') }}">
                            <button
                                class="px-6 py-3 font-medium text-center text-gray-900 align-middle transition-all rounded-lg select-none disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none hover:bg-gray-900/10 active:bg-gray-900/20"
                                type="button" data-ripple-dark="true">
                                Sign Out
                            </button>
                        </a>

                        @if (!Auth::user()->has_business_account && !Auth::user()->is_admin)
                            @if (!Auth::user()->businessClaimRequest)
                                <a href="{{ route('business-account.create') }}" id="front-user-create-business"
                                    class="align-middle select-none font-medium text-center transition-all disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none py-3 px-6 rounded-lg bg-gray-900 text-white shadow-md shadow-gray-900/10 hover:shadow-lg hover:shadow-gray-900/20 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none hidden md:block"
                                    type="button" data-ripple-light="true">
                                    For Businesses
                                </a>
                            @endif
                       
                        @else
                            @if (Auth::user()->is_admin)
                                <a href="{{ route('admin.dashboard') }}"
                                    class="align-middle select-none font-medium text-center transition-all disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none py-3 px-6 rounded-lg bg-gray-900 text-white shadow-md shadow-gray-900/10 hover:shadow-lg hover:shadow-gray-900/20 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none hidden md:block"
                                    type="button" data-ripple-light="true">
                                    Admin Dashboard
                                </a>
                            @endif

                            @if (Auth::user()->has_business_account)
                                <a href="{{ route('business-owner.dashboard') }}"
                                    class="align-middle select-none font-medium text-center transition-all disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none py-3 px-6 rounded-lg bg-gray-900 text-white shadow-md shadow-gray-900/10 hover:shadow-lg hover:shadow-gray-900/20 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none hidden md:block"
                                    type="button" data-ripple-light="true">
                                    Owner Dashboard
                                </a>
                            @endif
                        @endif
                        <div class="ms-3 relative">
                            <x-dropdown align="right" width="48">
                                <x-slot name="trigger">
                                    @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                        <button
                                            class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                            <img class="h-12 w-12 rounded-full object-cover"
                                                src="{{ Auth::user()->profile_photo_url }}"
                                                alt="{{ Auth::user()->name }}" />
                                        </button>
                                    @else
                                        <span class="inline-flex rounded-md">
                                            <button type="button"
                                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                                                {{ Auth::user()->name }}

                                                <svg class="ms-2 -me-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                                    fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                    stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                                </svg>
                                            </button>
                                        </span>
                                    @endif
                                </x-slot>

                                <x-slot name="content">
                                    <!-- Account Management -->
                                    <div class="block px-4 py-2 text-xs text-gray-400">
                                        {{ __('Manage Account') }}
                                    </div>

                                    {{-- <x-dropdown-link href="{{ route('profile.show') }}">
                                        {{ __('Profile') }}
                                    </x-dropdown-link> --}}
                                    <x-dropdown-link href="{{ route('disputes') }}">
                                        {{ __('Disputes Chats') }}
                                    </x-dropdown-link>

                                    @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                        <x-dropdown-link href="{{ route('api-tokens.index') }}">
                                            {{ __('API Tokens') }}
                                        </x-dropdown-link>
                                    @endif

                                    <div class="border-t border-gray-200"></div>

                                    <!-- Authentication -->
                                    <form method="POST" action="{{ route('logout') }}" x-data>
                                        @csrf

                                        <x-dropdown-link href="{{ route('logout') }}" @click.prevent="$root.submit();">
                                            {{ __('Log Out') }}
                                        </x-dropdown-link>
                                    </form>
                                </x-slot>
                            </x-dropdown>
                        </div>
                    @else
                        <a href="{{ route('login') }}">
                            <button
                                class="px-6 py-3 font-medium text-center text-gray-900 align-middle transition-all rounded-lg select-none disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none hover:bg-gray-900/10 active:bg-gray-900/20"
                                type="button" data-ripple-dark="true">
                                login
                            </button>
                        </a>

                        <a href="{{ route('register') }}">
                            <button
                                class="px-6 py-3 font-medium text-center text-gray-900 align-middle transition-all rounded-lg select-none disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none hover:bg-gray-900/10 active:bg-gray-900/20"
                                type="button" data-ripple-dark="true">
                                Sign Up
                            </button>
                        </a>
                    @endauth
                @endif


            </div>
            <button data-collapse-toggle="navbar-sticky" type="button"
                class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-blue-500 p-5 hover:text-white focus:outline-none focus:ring-2 focus:ring-gray-200"
                aria-controls="navbar-sticky" aria-expanded="false">
                <span class="sr-only">Open main menu</span>
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 17 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M1 1h15M1 7h15M1 13h15" />
                </svg>
            </button>
        </div>
        <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-sticky">
            <ul
                class="flex flex-col p-4 md:p-0 mt-4 font-medium border border-gray-100 rounded-lg bg-gray-50 md:space-x-14 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-transparent">
                <li>
                    <a href="{{ route('home') }}"
                        class="block py-2 px-3 {{ Request::routeIs(['home']) ? 'text-white' : 'text-black' }} bg-blue-700  rounded md:bg-transparent nunito-sans text-lg font-semibold  hover:bg-blue-500 p-5 hover:text-white"
                        :class="{ 'md:!text-black': scrolled }" aria-current="page">Home</a>
                </li>
                <li>
                    <a href="{{ route('categories.show.all') }}" :class="{ 'md:!text-black': scrolled }"
                        class="block py-2 px-3 {{ Request::routeIs(['home']) ? 'md:text-white' : 'md:text-black' }} rounded hover:bg-blue-500 p-5 hover:text-white  nunito-sans text-lg font-semibold">Businesses</a>
                </li>

                <li>
                    <a href="https://thehotbleep.com/hotMoon" :class="{ 'md:!text-black': scrolled }"
                        class="block py-2 px-3 {{ Request::routeIs(['home']) ? 'md:text-white' : 'md:text-black' }} rounded hover:bg-blue-500 p-5 hover:text-white   nunito-sans text-lg font-semibold">hotMoon</a>
                </li>

                <li>
                    <a href="https://thehotbleep.com/hotTribe" :class="{ 'md:!text-black': scrolled }"
                        class="block py-2 px-3 {{ Request::routeIs(['home']) ? 'md:text-white' : 'md:text-black' }} rounded  hover:bg-blue-500 p-5 hover:text-white  nunito-sans text-lg font-semibold">hotTribe</a>
                </li>
                {{-- <li>
                    <a href="#" :class="{ 'md:!text-black': scrolled }"
                        class="block py-2 px-3 {{ Request::routeIs(['home']) ? 'md:text-white' : 'md:text-black' }} rounded hover:bg-blue-500 p-5 hover:text-white t md:p-0 nunito-sans text-lg font-semibold">Blog</a>
                </li> --}}
                {{-- <li>
                    <a href="{{ route('contactUs') }}" :class="{ 'md:!text-black': scrolled }"
                        class="block py-2 px-3 {{ Request::routeIs(['home']) ? 'md:text-white' : 'md:text-black' }} rounded hover:bg-blue-500 p-5 hover:text-white md:hover:bg-transparent md:p-0 nunito-sans text-lg font-semibold">Contact us</a>
                </li> --}}
                <li class="md:hidden">
                    <a href="#" :class="{ 'md:!text-black': scrolled }"
                        class="block py-2 px-3 {{ Request::routeIs(['home']) ? 'md:text-white' : 'md:text-black' }} rounded hover:bg-gray-100 p-5 hover:text-white   nunito-sans text-lg font-semibold">For
                        Businesses</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

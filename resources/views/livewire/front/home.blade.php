<div>

    <!-- Banner with Image -->
    <section class="py-28 lg:py-24 relative flex justify-center items-center bg-[#FAFAFF]">
        <div class="bg-[#0BA1E5] w-full h-full absolute top-0 left-0 right-0 bottom-0 clipPath"></div>
        <div class="container xl:max-w-screen-2xl mx-auto px-4 relative mt-16">
            <div class="grid lg:grid-cols-2 gap-5">
                <div class="flex justify-start items-center">
                    <div class="mt-10 lg:mt-0">
                        <h1 class="text-white text-5xl xl:text-3xl leading-tight font-bold">

                            Find medical companies <br class="hidden lg:block" />
                            you can trust.
                        </h1>
                        <h2 class="text-white text-xl md:text-xl leading-tight mt-3">
                            Discover authentic user reviews of various businesses, contribute your own insights, or
                            showcase your own company by leaving a review or listing your business. Dive into the
                            vibrant world of shared experiences and opinions! </h2>
                        <div class="bg-white w-20 h-1.5 rounded-full mt-5"></div>
                        <div x-data="{ showList: false }" @click.away="showList = false" class="mt-20 relative">
                            <input type="text" wire:model.live="search" x-on:click="showList = true" id="first_name"
                                autocomplete="off"
                                class="bg-transparent border border-white text-white rounded-lg focus:ring-white focus:border-white block w-full p-2.5 placeholder:text-white"
                                placeholder="Search a Business..." required />

                            <div class="absolute right-1 top-1/2 -translate-y-1/2">
                                <button
                                    class="align-middle select-none font-medium text-center transition-all disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none w-12 h-9 rounded-md bg-white text-black shadow-md shadow-white/10 hover:shadow-lg hover:shadow-white/20 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none flex justify-center items-center"
                                    type="button" data-ripple-dark="true">
                                    <i class="fa-regular fa-magnifying-glass"></i>
                                </button>
                            </div>

                            <div style="width: 100%" x-show="showList"
                                class="custom-scrollbar max-h-80 overflow-y-auto  absolute top-full mt-1 bg-[#E3E3E9] rounded-md shadow-lg z-10">
                                @if (!empty($companies) || !empty($searchCategories))
                                    <ul class="divide-y divide-gray-700">
                                        @if (!empty($companies))
                                            <li class="py-2 px-4 text-black font-semibold">Companies</li>
                                            @forelse ($companies as $company)
                                                <li class="py-2 px-4">
                                                    <a class="text-black hover:underline"
                                                        href="{{ route('front.business.show', ['business_name' => $company->businessName]) }}">
                                                        {{ $company->businessName }}
                                                        @if ($company->businessStat)
                                                            <span
                                                                class="text-black-400">({{ $company->businessStat->reviews_count }}
                                                                reviews)</span>
                                                            <span
                                                                class="text-yellow-500">{{ $company->businessStat->avg_rating }}
                                                                stars</span>
                                                        @endif
                                                    </a>
                                                </li>
                                            @empty
                                                <p class="text-black px-4 py-2">No results found.</p>
                                            @endforelse
                                        @endif
                                        @if (!empty($searchCategories))
                                            <li class="py-2 px-4 text-black font-semibold">Categories</li>
                                            @forelse ($searchCategories as $category)
                                                <li class="py-2 px-4">
                                                    <a class="text-black hover:underline"
                                                        href="{{ route('categories.business', str_replace(' ', '-', $category->title)) }}">{{ $category->title }}</a>
                                                </li>
                                            @empty
                                                <p class="text-black px-4 py-2">No results found.</p>
                                            @endforelse
                                        @endif
                                    </ul>

                                @endif
                            </div>
                        </div>

                    </div>
                </div>
                <div class=" lg:flex justify-center items-center">
                    <img class="mt-5" src="http://trustpilot.local/images/header-img.png" alt="">
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="container xl:max-w-screen-2xl mx-auto px-4">
            <div class="flex justify-between sm:items-center gap-4 mt-20 flex-col sm:flex-row">
                <h1 class="text-black font-semibold text-5xl">Explore Categories</h1>
                <a href="{{ route('categories.show.all') }}"
                    class="align-middle select-none font-medium text-center transition-all disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none py-3 px-6 rounded-lg bg-gray-900 text-white shadow-md shadow-gray-900/10 hover:shadow-lg hover:shadow-gray-900/20 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none"
                    type="button" data-ripple-light="true">
                    View all
                </a>
            </div>
            <div class="mt-10 bg-[#15A5E6] bg-opacity-20 rounded-[40px] py-9 sm:py-16 md:py-24 px-6 sm:px-16 md:px-20">
                <div class="grid sm:grid-cols-2 mb-5 xl:grid-cols-4 gap-8">
                    @foreach ($categories as $category)
                        <a href="{{ route('categories.business', str_replace(' ', '-', $category->title)) }}"
                            title="{{ $category->title }}"
                            class="flex justify-center items-center gap-3 border border-[#0BA1E5] bg-white rounded-lg py-3 px-4 group hover:bg-[#0BA1E5] transition-all duration-300 ease-in-out cursor-pointer"
                            data-ripple-light="true">
                            <img src="{{ asset('storage/' . $category->icon_path) }}" class="w-9 h-8" alt="">
                            <h1 class="text-lg group-hover:text-white">{{ Str::limit($category->title, 15, '...') }}
                            </h1>
                        </a>
                    @endforeach
                </div>
                @if ($loadedCategoriesCount > $batchSize && $loadedCategoriesCount <= $batchSize * 2)
                    <br>
                    <div class="text-center mt-5">
                        <button wire:click="loadCategoriesMore"
                            class="inline-flex justify-center items-center gap-3 border border-[#0BA1E5] bg-white rounded-lg py-3 px-4 group hover:bg-[#0BA1E5] transition-all duration-300 ease-in-out cursor-pointer"
                            data-ripple-light="true">
                            <span>View More</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                    </div>
                @endif
            </div>

        </div>
    </section>

    <section class="bg-black py-16 mt-20 relative">
        <!-- <img src="./images/48-PhotoRoom 1.png" class="absolute top-1/2 -translate-y-1/2 right-5 w-44" alt=""> -->
        <div class="container xl:max-w-screen-2xl mx-auto px-4 relative">
            <div class="flex justify-between items-start md:items-center gap-5 flex-col md:flex-row">
                <div class="text-white space-y-2">
                    <h1 class="text-4xl font-semibold">Are you a medical business or medical professional?</h1>
                    <p class="font-light text-lg">
                        theHotBleep is a review platform that is open to everyone.
                    </p>
                </div>
                <div class="flex justify-end items-center">
                    @auth
                        @if (auth()->user()->is_admin)
                            <a href="{{ route('admin.dashboard') }}"
                                class="align-middle select-none font-medium text-center transition-all disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none py-3 px-6 rounded-lg bg-[#0BA1E5] text-white shadow-md shadow-[#0BA1E5]/10 hover:shadow-lg hover:shadow-[#0BA1E5]/20 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none"
                                type="button" data-ripple-light="true">
                                Get Started
                                <i class="fa-solid fa-angles-right"></i>
                            </a>
                        @elseif(auth()->user()->has_business_account)
                            <a href="{{ route('business-owner.dashboard') }}"
                                class="align-middle select-none font-medium text-center transition-all disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none py-3 px-6 rounded-lg bg-[#0BA1E5] text-white shadow-md shadow-[#0BA1E5]/10 hover:shadow-lg hover:shadow-[#0BA1E5]/20 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none"
                                type="button" data-ripple-light="true">
                                Get Started
                                <i class="fa-solid fa-angles-right"></i>
                            </a>
                        @else
                            <a href="{{ route('business-account.create') }}"
                                class="align-middle select-none font-medium text-center transition-all disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none py-3 px-6 rounded-lg bg-[#0BA1E5] text-white shadow-md shadow-[#0BA1E5]/10 hover:shadow-lg hover:shadow-[#0BA1E5]/20 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none"
                                type="button" data-ripple-light="true">
                                Get Started
                                <i class="fa-solid fa-angles-right"></i>
                            </a>
                        @endif
                    @else
                        <a href="{{ route('login') }}"
                            class="align-middle select-none font-medium text-center transition-all disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none py-3 px-6 rounded-lg bg-[#0BA1E5] text-white shadow-md shadow-[#0BA1E5]/10 hover:shadow-lg hover:shadow-[#0BA1E5]/20 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none"
                            type="button" data-ripple-light="true">
                            Get Started
                            <i class="fa-solid fa-angles-right"></i>
                        </a>
                    @endauth
                    <img class="ml-5" src="{{ asset('images/48-PhotoRoom 1.png') }}" alt="" />

                </div>
            </div>
        </div>
    </section>

    <section class="mt-20">
        <div class="container xl:max-w-screen-2xl mx-auto px-4 relative">
            <h1 class="text-5xl font-semibold text-center">Recent Reviews</h1>
            <div class="mt-32 grid md:grid-cols-2 lg:grid-cols-4 gap-x-6 gap-y-24">
                @foreach ($recentReviews as $review)
                    <div
                        class="h-[325px] max-h-[325px] min-h-[325px] border border-[#EEEEEE] bg-[#EBEDEF] bg-opacity-55 rounded-lg px-6 pt-20 pb-6 relative">
                        <div class="absolute -top-20 w-36 h-36 rounded-full bg-white left-1/2 -translate-x-1/2 p-2">
                            <div class="bg-[#0BA1E5] w-full h-full rounded-full p-2">
                                @if (isset($review->user->profile_photo_path))
                                    <img src="storage/{{ asset($review->user->profile_photo_path) }}"
                                        class="w-full h-full rounded-full" alt="doctor" />
                                @else
                                    <img src="{{ asset('images/dummy.jpg') }}" class="w-full h-full rounded-full"
                                        alt="doctor" />
                                @endif
                            </div>
                        </div>

                        <div class="">
                            <h1 class="text-lg font-medium text-center">
                                {{ $review->user->name }}
                                <span class="text-base font-light">Reviewed</span>
                                <a href="{{ route('front.business.show', ['business_name' => $review->businessAccount->businessName]) }}"
                                    class="hover:underline">{{ $review->businessAccount->businessName }}</a>
                            </h1>
                            <div style="width: 8rem;justify-content:center;"
                                class="bg-[#0BA1E5] rounded-full px-2 py-1 flex justify-start items-center gap-1 mx-auto mt-2">
                                {!! $review->generateStarRating() !!}
                            </div>
                            <span class="mt-3 line-clamp-5 font-light">
                                {!! Str::limit($review->review, 150, '...') !!}
                            </span>

                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="mt-20">
        <div class="container xl:max-w-screen-2xl mx-auto px-4">
            <div
                class="relative after:content-[''] after:bg-[#15A5E6] after:bg-opacity-20 after:absolute after:top-0 after:bottom-0 after:left-0 after:right-0 lg:after:w-full after:h-full after:rounded-[40px] h-full py-16 px-6 md:px-24 lg:px-0 lg:pl-28">
                <div class="grid lg:grid-cols-2 gap-12 lg:gap-5 relative z-10">
                    <div class="flex justify-start items-center lg:col-span-2">
                        <div>
                            <div class="space-y-2">
                                <h1 class="text-5xl font-semibold">What is TrustBank</h1>
                                <p class="text-xl font-medium lg:pr-32">
                                    Transparency is the foundation of trust in the rapidly evolving healthcare
                                    landscape. That's why we've built a TrustBank for the sector, a space where honesty
                                    leads the way. Through reviews and real user feedback, we help you navigate the new
                                    healthcare companies, ensuring you can make informed decisions with confidence.
                                </p>
                            </div>
                            
                        </div>
                    </div>
                 
                </div>
            </div>
        </div>
    </section>

    @if ($featureCompanies->count() > 0)
        <section class="mt-20">
            <div class="container xl:max-w-screen-2xl mx-auto px-4">
                <h1 class="text-5xl font-semibold text-center">
                    Feature companies
                </h1>
                <div class="flex justify-between sm:items-center gap-4 flex-col sm:flex-row">
                    <div class="flex items-center">
                        <button
                            class="px-6 py-3 font-medium text-center text-gray-900 align-middle transition-all rounded-lg select-none disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none hover:bg-gray-900/10 active:bg-gray-900/20 slidePrev-btn2"
                            type="button" data-ripple-dark="true">
                            <svg xmlns="http://www.w3.org/2000/svg" width="39" height="22"
                                viewBox="0 0 39 22" fill="none">
                                <path
                                    d="M10.8462 0.718406L0.0059561 11.091L10.8343 21.4749L12.6563 19.7314L4.93482 12.3269L38.573 12.3445L38.5744 9.8776L4.93648 9.86004L12.6662 2.46376L10.8462 0.718406Z"
                                    fill="black"></path>
                            </svg>
                        </button>
                        <button
                            class="px-6 py-3 font-medium text-center text-gray-900 align-middle transition-all rounded-lg select-none disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none hover:bg-gray-900/10 active:bg-gray-900/20 slideNext-btn2"
                            type="button" data-ripple-dark="true">
                            <svg xmlns="http://www.w3.org/2000/svg" width="39" height="22"
                                viewBox="0 0 39 22" fill="none">
                                <path
                                    d="M28.1693 0.72866L39.0095 11.1012L28.1812 21.4851L26.3592 19.7417L34.0807 12.3372L0.442513 12.3547L0.441097 9.88785L34.079 9.87029L26.3493 2.47402L28.1693 0.72866Z"
                                    fill="black"></path>
                            </svg>
                        </button>
                    </div>
                </div>


                <div>
                    <div class="swiper swiperCompanies">
                        <div class="swiper-wrapper">

                            @foreach ($featureCompanies as $featureCompany)
                                <div wire:key="featureCompany-{{ $featureCompany->id }}" class="swiper-slide py-20">
                                    <a
                                        href="{{ route('front.business.show', ['business_name' => $featureCompany->businessName]) }}">

                                        <div class="border border-[#0BA1E5] rounded-[12px]">
                                            <div class="bg-primary h-[172px] py-5 px-4 rounded-[10px]">
                                                <div class="flex justify-end items-center gap-2">
                                                    <i class="fa-regular fa-clock text-white text-xs"></i>
                                                    <p class="text-xs text-white">
                                                        {{ $featureCompany->created_at?->diffForHumans() }}</p>
                                                </div>
                                                <div class="flex justify-start items-center gap-2 mt-2">
                                                    <h1 class="text-white text-sm">
                                                        <div class="hover:underline">
                                                            {!! Str::limit($featureCompany->businessName, 20, '...') !!}

                                                            </d>
                                                    </h1>
                                                    <div
                                                        class="bg-black rounded-full px-2 py-1 flex justify-start items-center gap-1 w-38">
                                                        {!! $featureCompany->generateStarRating() !!}
                                                    </div>
                                                    <p class="text-sm text-white">
                                                        {{ $featureCompany?->businessStat?->avg_rating }}</p>
                                                </div>
                                                <div class="mt-3 description_section">
                                                    <p class="text-black text-xs font-light line-clamp-2">
                                                        {!! Str::limit($featureCompany->description, 50, '...') !!}
                                                    </p>
                                                </div>
                                                <div class="mt-2 text-end ">
                                                    <p class="text-xs text-white">
                                                        {{ number_format($featureCompany?->businessStat?->reviews_count) }}
                                                        @choice('review|reviews', $featureCompany?->businessStat?->reviews_count)
                                                    </p>
                                                </div>
                                            </div>
                                            <div
                                                class="border-t border-gray-400 pt-4 pb-3 px-5 mt-20 flex justify-start items-center gap-2">
                                                <i class="fa-regular fa-location-dot"></i>
                                                <p class="line-clamp-6">{{ $featureCompany->country->name }}</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif

    @if ($newestCompanies->count() > 0)
        <section class="mt-20">
            <div class="container xl:max-w-screen-2xl mx-auto px-4">
                <h1 class="text-5xl font-semibold text-center">
                    Newest companies
                </h1>
                <div class="flex justify-between sm:items-center gap-4 flex-col sm:flex-row">
                    <div class="flex items-center">
                        <button
                            class="px-6 py-3 font-medium text-center text-gray-900 align-middle transition-all rounded-lg select-none disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none hover:bg-gray-900/10 active:bg-gray-900/20 slidePrev-btn2"
                            type="button" data-ripple-dark="true">
                            <svg xmlns="http://www.w3.org/2000/svg" width="39" height="22"
                                viewBox="0 0 39 22" fill="none">
                                <path
                                    d="M10.8462 0.718406L0.0059561 11.091L10.8343 21.4749L12.6563 19.7314L4.93482 12.3269L38.573 12.3445L38.5744 9.8776L4.93648 9.86004L12.6662 2.46376L10.8462 0.718406Z"
                                    fill="black"></path>
                            </svg>
                        </button>
                        <button
                            class="px-6 py-3 font-medium text-center text-gray-900 align-middle transition-all rounded-lg select-none disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none hover:bg-gray-900/10 active:bg-gray-900/20 slideNext-btn2"
                            type="button" data-ripple-dark="true">
                            <svg xmlns="http://www.w3.org/2000/svg" width="39" height="22"
                                viewBox="0 0 39 22" fill="none">
                                <path
                                    d="M28.1693 0.72866L39.0095 11.1012L28.1812 21.4851L26.3592 19.7417L34.0807 12.3372L0.442513 12.3547L0.441097 9.88785L34.079 9.87029L26.3493 2.47402L28.1693 0.72866Z"
                                    fill="black"></path>
                            </svg>
                        </button>
                    </div>
                </div>


                <div>
                    <div class="swiper swiperCompanies">
                        <div class="swiper-wrapper">

                            @foreach ($newestCompanies as $newCompany)
                                <div wire:key="newCompany-{{ $newCompany->id }}" class="swiper-slide py-20">
                                    <a
                                        href="{{ route('front.business.show', ['business_name' => $newCompany->businessName]) }}">

                                        <div class="border border-[#0BA1E5] rounded-[12px]">
                                            <div class="bg-primary h-[172px] py-5 px-4 rounded-[10px]">
                                                <div class="flex justify-end items-center gap-2">
                                                    <i class="fa-regular fa-clock text-white text-xs"></i>
                                                    <p class="text-xs text-white">
                                                        {{ $newCompany->created_at?->diffForHumans() }}</p>
                                                </div>
                                                <div class="flex justify-start items-center gap-2 mt-2">
                                                    <h1 class="text-white text-sm">
                                                        <div class="hover:underline">
                                                            {!! Str::limit($newCompany->businessName, 20, '...') !!}

                                                            </d>
                                                    </h1>
                                                    <div
                                                        class="bg-black rounded-full px-2 py-1 flex justify-start items-center gap-1 w-38">
                                                        {!! $newCompany->generateStarRating() !!}
                                                    </div>
                                                    <p class="text-sm text-white">
                                                        {{ $newCompany?->businessStat?->avg_rating }}</p>
                                                </div>
                                                <div class="mt-3 description_section">
                                                    <p class="text-black text-xs font-light line-clamp-2">
                                                        {!! Str::limit($newCompany->description, 50, '...') !!}
                                                    </p>
                                                </div>
                                                <div class="mt-2 text-end ">
                                                    <p class="text-xs text-white">
                                                        {{ number_format($newCompany?->businessStat?->reviews_count) }}
                                                        @choice('review|reviews', $newCompany?->businessStat?->reviews_count)
                                                    </p>
                                                </div>
                                            </div>
                                            <div
                                                class="border-t border-gray-400 pt-4 pb-3 px-5 mt-20 flex justify-start items-center gap-2">
                                                <i class="fa-regular fa-location-dot"></i>
                                                <p class="line-clamp-6">{{ $newCompany->country->name }}</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif

    @if ($mostRatedBusiness->count() > 0)
        <section class="mt-20">
            <div class="container xl:max-w-screen-2xl mx-auto px-4">
                <h1 class="text-5xl font-semibold text-center">
                    Top Rated businesses
                </h1>
                <div class="flex justify-between sm:items-center gap-4 flex-col sm:flex-row">
                    <div class="flex items-center">
                        <button
                            class="px-6 py-3 font-medium text-center text-gray-900 align-middle transition-all rounded-lg select-none disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none hover:bg-gray-900/10 active:bg-gray-900/20 slidePrev-btn3"
                            type="button" data-ripple-dark="true">
                            <svg xmlns="http://www.w3.org/2000/svg" width="39" height="22"
                                viewBox="0 0 39 22" fill="none">
                                <path
                                    d="M10.8462 0.718406L0.0059561 11.091L10.8343 21.4749L12.6563 19.7314L4.93482 12.3269L38.573 12.3445L38.5744 9.8776L4.93648 9.86004L12.6662 2.46376L10.8462 0.718406Z"
                                    fill="black"></path>
                            </svg>
                        </button>
                        <button
                            class="px-6 py-3 font-medium text-center text-gray-900 align-middle transition-all rounded-lg select-none disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none hover:bg-gray-900/10 active:bg-gray-900/20 slideNext-btn3"
                            type="button" data-ripple-dark="true">
                            <svg xmlns="http://www.w3.org/2000/svg" width="39" height="22"
                                viewBox="0 0 39 22" fill="none">
                                <path
                                    d="M28.1693 0.72866L39.0095 11.1012L28.1812 21.4851L26.3592 19.7417L34.0807 12.3372L0.442513 12.3547L0.441097 9.88785L34.079 9.87029L26.3493 2.47402L28.1693 0.72866Z"
                                    fill="black"></path>
                            </svg>
                        </button>
                    </div>
                </div>

                <div>
                    <div class="swiper swiperCompaniesMost">
                        <div class="swiper-wrapper">

                            @foreach ($mostRatedBusiness as $mostRatedBusines)
                                <div wire:key="mostRatedBusines-{{ $mostRatedBusines->id }}"
                                    class="swiper-slide py-20">
                                    <div class="border border-[#0BA1E5] rounded-[12px]">
                                        <a
                                            href="{{ route('front.business.show', ['business_name' => $mostRatedBusines->businessAccount->businessName]) }}">
                                            <div class="bg-primary h-[172px] py-5 px-4 rounded-[10px]">
                                                <div class="flex justify-end items-center gap-2">
                                                    <i class="fa-regular fa-clock text-white text-xs"></i>
                                                    <p class="text-xs text-white">
                                                        {{ $mostRatedBusines->businessAccount->created_at?->diffForHumans() }}
                                                    </p>
                                                </div>
                                                <div class="flex justify-start items-center gap-2 mt-2">

                                                    <h1 class="text-white text-sm">
                                                        {!! Str::limit($mostRatedBusines->businessAccount->businessName, 20, '...') !!}

                                                    </h1>

                                                    <div
                                                        class="bg-black rounded-full px-2 py-1 flex justify-start items-center gap-1 w-38">
                                                        {!! $mostRatedBusines->businessAccount->generateStarRating() !!}
                                                    </div>
                                                    <p class="text-sm text-white">
                                                        {{ $mostRatedBusines->avg_rating }}</p>
                                                </div>
                                                <div class="mt-3">
                                                    <p class="text-white text-xs font-light line-clamp-2">
                                                        {!! Str::limit($mostRatedBusines->businessAccount->description, 50, '...') !!}
                                                    </p>
                                                </div>
                                                <div class="mt-2 text-end">
                                                    <p class="text-xs text-white">
                                                        {{ number_format($mostRatedBusines->reviews_count) }}
                                                        @choice('review|reviews', $mostRatedBusines->reviews_count)</p>
                                                </div>
                                            </div>
                                        </a>
                                        <div
                                            class="border-t border-gray-400 pt-4 pb-3 px-5 mt-20 flex justify-start items-center gap-2">
                                            <i class="fa-regular fa-location-dot"></i>
                                            <p class="line-clamp-6">
                                                {{ $mostRatedBusines->businessAccount->country->name }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif


    <section class="mt-20">
        <div class="container xl:max-w-screen-2xl mx-auto px-4">
            <div class="grid grid-cols-1 lg:grid-cols-2">
                <div class="hidden lg:block">
                    <img src="{{ asset('images/Group 129.png') }}" alt="" />
                    {{-- <img src="{{ asset('images/female-img.jpeg') }}" alt="" class="rounded-3xl" /> --}}
                </div>
                <div class="">
                    <div class="lg:mt-10">
                        {{-- <div class="flex justify-end items-center mb-10">
                            <button
                                class="px-6 py-3 font-medium text-center text-gray-900 align-middle transition-all rounded-lg select-none disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none hover:bg-gray-900/10 active:bg-gray-900/20 slidePrev-btn"
                                type="button" data-ripple-dark="true">
                                <svg xmlns="http://www.w3.org/2000/svg" width="39" height="22"
                                    viewBox="0 0 39 22" fill="none">
                                    <path
                                        d="M10.8462 0.718406L0.0059561 11.091L10.8343 21.4749L12.6563 19.7314L4.93482 12.3269L38.573 12.3445L38.5744 9.8776L4.93648 9.86004L12.6662 2.46376L10.8462 0.718406Z"
                                        fill="black" />
                                </svg>
                            </button>
                            <button
                                class="px-6 py-3 font-medium text-center text-gray-900 align-middle transition-all rounded-lg select-none disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none hover:bg-gray-900/10 active:bg-gray-900/20 slideNext-btn"
                                type="button" data-ripple-dark="true">
                                <svg xmlns="http://www.w3.org/2000/svg" width="39" height="22"
                                    viewBox="0 0 39 22" fill="none">
                                    <path
                                        d="M28.1693 0.72866L39.0095 11.1012L28.1812 21.4851L26.3592 19.7417L34.0807 12.3372L0.442513 12.3547L0.441097 9.88785L34.079 9.87029L26.3493 2.47402L28.1693 0.72866Z"
                                        fill="black" />
                                </svg>
                            </button>
                        </div> --}}
                        <div class="bg-black rounded-[40px] py-5 md:py-8 px-6 md:px-12">
                            <div class="swiper mySwiperTestimonial">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide py-20">
                                        <div class="text-white">
                                            <h1 class="text-3xl font-semibold">
                                                theHotBleep is a movement towards transparent, smarter and more
                                                connected healthcare.<br />Welcome to the future of healthcare.
                                            </h1>
                                            {{-- <div
                                                class="bg-[#0BA1E5] rounded-full px-2 py-1 flex justify-start items-center gap-1 w-24 mt-3">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                    viewBox="0 0 14 14" fill="none">
                                                    <path
                                                        d="M7.0004 0L8.89983 5.34765H14L9.83842 8.48846L11.3266 14L7.0004 10.6953L2.67496 14L4.16238 8.48846L0 5.34765H5.10016L7.0004 0Z"
                                                        fill="white"></path>
                                                </svg>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                    viewBox="0 0 14 14" fill="none">
                                                    <path
                                                        d="M7.0004 0L8.89983 5.34765H14L9.83842 8.48846L11.3266 14L7.0004 10.6953L2.67496 14L4.16238 8.48846L0 5.34765H5.10016L7.0004 0Z"
                                                        fill="white"></path>
                                                </svg>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                    viewBox="0 0 14 14" fill="none">
                                                    <path
                                                        d="M7.0004 0L8.89983 5.34765H14L9.83842 8.48846L11.3266 14L7.0004 10.6953L2.67496 14L4.16238 8.48846L0 5.34765H5.10016L7.0004 0Z"
                                                        fill="white"></path>
                                                </svg>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                    viewBox="0 0 14 14" fill="none">
                                                    <path
                                                        d="M7.0004 0L8.89983 5.34765H14L9.83842 8.48846L11.3266 14L7.0004 10.6953L2.67496 14L4.16238 8.48846L0 5.34765H5.10016L7.0004 0Z"
                                                        fill="white"></path>
                                                </svg>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                    viewBox="0 0 14 14" fill="none">
                                                    <path
                                                        d="M7.0004 0L8.89983 5.34765H14L9.83842 8.48846L11.3266 14L7.0004 10.6953L2.67496 14L4.16238 8.48846L0 5.34765H5.10016L7.0004 0Z"
                                                        fill="white"></path>
                                                </svg>
                                            </div>
                                            <p class="tex-xl font-medium mt-6">
                                                Marjori experienced Patch
                                            </p> --}}
                                        </div>
                                    </div>
                                    {{-- <div class="swiper-slide py-20">
                                        <div class="text-white">
                                            <h1 class="text-5xl font-semibold">
                                                The first birthday gift my wife didn't want to return.
                                            </h1>
                                            <div
                                                class="bg-[#0BA1E5] rounded-full px-2 py-1 flex justify-start items-center gap-1 w-24 mt-3">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                    viewBox="0 0 14 14" fill="none">
                                                    <path
                                                        d="M7.0004 0L8.89983 5.34765H14L9.83842 8.48846L11.3266 14L7.0004 10.6953L2.67496 14L4.16238 8.48846L0 5.34765H5.10016L7.0004 0Z"
                                                        fill="white"></path>
                                                </svg>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                    viewBox="0 0 14 14" fill="none">
                                                    <path
                                                        d="M7.0004 0L8.89983 5.34765H14L9.83842 8.48846L11.3266 14L7.0004 10.6953L2.67496 14L4.16238 8.48846L0 5.34765H5.10016L7.0004 0Z"
                                                        fill="white"></path>
                                                </svg>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                    viewBox="0 0 14 14" fill="none">
                                                    <path
                                                        d="M7.0004 0L8.89983 5.34765H14L9.83842 8.48846L11.3266 14L7.0004 10.6953L2.67496 14L4.16238 8.48846L0 5.34765H5.10016L7.0004 0Z"
                                                        fill="white"></path>
                                                </svg>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                    viewBox="0 0 14 14" fill="none">
                                                    <path
                                                        d="M7.0004 0L8.89983 5.34765H14L9.83842 8.48846L11.3266 14L7.0004 10.6953L2.67496 14L4.16238 8.48846L0 5.34765H5.10016L7.0004 0Z"
                                                        fill="white"></path>
                                                </svg>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                    viewBox="0 0 14 14" fill="none">
                                                    <path
                                                        d="M7.0004 0L8.89983 5.34765H14L9.83842 8.48846L11.3266 14L7.0004 10.6953L2.67496 14L4.16238 8.48846L0 5.34765H5.10016L7.0004 0Z"
                                                        fill="white"></path>
                                                </svg>
                                            </div>
                                            <p class="tex-xl font-medium mt-6">
                                                Marjori experienced Patch
                                            </p>
                                        </div>
                                    </div> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>

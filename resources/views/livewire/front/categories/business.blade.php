<div>
    <section class="pt-36 relative flex justify-center items-center">
        <div class="container xl:max-w-screen-2xl mx-auto px-4 relative">
            <div class="grid">
                <div class="flex justify-center items-center">
                    <div class="mt-660 lg:mt-0 text-center">
                        <p class="opacity-50 mb-6">
                            @if ($category->parentCategory)
                                <a
                                    href="{{ route('categories.business', str_replace(' ', '-', $category->parentCategory->title)) }}">{{ $category->parentCategory->title }}
                                    >> </a>

                                {{ $category->title }}
                            @endif
                        </p>
                        <h1 class="text-black text-4xl xl:text-4xl leading-tight  mt-10 font-bold">
                            Best in {{ $category->title }}
                        </h1>
                        <p class="font-light text-lg mt-6">
                            {{ $category->description }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="mt-12">
        <div class="container xl:max-w-screen-2xl mx-auto px-4 relative">
            <div class="grid lg:grid-cols-12 gap-5">
                <div class="lg:col-span-4 xl:col-span-3 rounded-xl bg-[#FAFAFF] py-10 px-7">
                    <div>
                        <div>
                            <label for="review" class="text-lg"> Location </label>
                            <div class="relative">
                                <select wire:model.live="countryFilter"
                                    class="peer w-full bg-white rounded-[10px] border border-white bg-transparent px-3 py-2.5 font-normal text-black outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-white placeholder-shown:border-t-white empty:!bg-gray-900 focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50 focus:border-primary mt-2 h-[65px]">
                                    <option value="" selected>Any</option>
                                    @foreach (\App\Models\Country::get() as $country)
                                        <option value="{{ $country->id }}">{{ $country->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="mt-4">
                            <label for="review" class="text-lg"> Rating </label>
                            <div class="relative">
                                <select wire:model.live="ratingFilter" id="review"
                                    class="peer w-full bg-white rounded-[10px] border border-white bg-transparent px-3 py-2.5 font-normal text-black outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-white placeholder-shown:border-t-white empty:!bg-gray-900 focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50 focus:border-primary mt-2 h-[65px]">
                                    <option value="" selected="">Any</option>
                                    <option value="3">&#9733; 3.0+</option>
                                    <option value="4">&#9733; 4.0+</option>
                                    <option value="4.5">&#9733; 4.5+</option>
                                </select>
                            </div>
                        </div>
                        <div class="mt-4">
                            <div class="relative">
                                <input type="text" wire:model.live="companyNameFilter" id="Product"
                                    class="peer w-full bg-white rounded-[10px] border border-white bg-transparent px-3 py-2.5 font-normal text-black outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-white placeholder-shown:border-t-white focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50 focus:border-primary h-[65px]"
                                    placeholder="Company name..." required="" />
                                <i class="fa-regular fa-magnifying-glass absolute top-1/2 -translate-y-1/2 right-3"></i>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="mt-16">
                        <div>
                            <label for="review" class="text-lg"> Company Status </label>
                            <div
                                class="bg-white rounded-[10px] h-[65px] flex justify-between items-center gap-4 px-3 py-2.5 mt-2">
                                <label class="mt-px font-light text-black cursor-pointer select-none"
                                    htmlFor="ripple-on">
                                    Verified
                                </label>
                                <label class="relative flex items-center p-3 rounded-full cursor-pointer"
                                    htmlFor="ripple-on" data-ripple-dark="true">
                                    <input id="ripple-on" type="checkbox"
                                        class="before:content[''] peer relative h-5 w-5 cursor-pointer appearance-none rounded-md border border-blue-gray-200 transition-all before:absolute before:top-2/4 before:left-2/4 before:block before:h-12 before:w-12 before:-translate-y-2/4 before:-translate-x-2/4 before:rounded-full before:bg-blue-gray-500 before:opacity-0 before:transition-opacity checked:border-gray-900 checked:bg-gray-900 checked:before:bg-gray-900 hover:before:opacity-10" />
                                    <span
                                        class="absolute text-white transition-opacity opacity-0 pointer-events-none top-2/4 left-2/4 -translate-y-2/4 -translate-x-2/4 peer-checked:opacity-100">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" viewBox="0 0 20 20"
                                            fill="currentColor" stroke="currentColor" stroke-width="1">
                                            <path fill-rule="evenodd"
                                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                    </span>
                                </label>
                            </div>
                        </div>
                        <div class="mt-4">
                            <div
                                class="bg-white rounded-[10px] h-[65px] flex justify-between items-center gap-4 px-3 py-2.5">
                                <label class="mt-px font-light text-black cursor-pointer select-none" htmlFor="Claimed">
                                    Claimed
                                </label>
                                <label class="relative flex items-center p-3 rounded-full cursor-pointer"
                                    htmlFor="Claimed" data-ripple-dark="true">
                                    <input id="Claimed" type="checkbox"
                                        class="before:content[''] peer relative h-5 w-5 cursor-pointer appearance-none rounded-md border border-blue-gray-200 transition-all before:absolute before:top-2/4 before:left-2/4 before:block before:h-12 before:w-12 before:-translate-y-2/4 before:-translate-x-2/4 before:rounded-full before:bg-blue-gray-500 before:opacity-0 before:transition-opacity checked:border-gray-900 checked:bg-gray-900 checked:before:bg-gray-900 hover:before:opacity-10" />
                                    <span
                                        class="absolute text-white transition-opacity opacity-0 pointer-events-none top-2/4 left-2/4 -translate-y-2/4 -translate-x-2/4 peer-checked:opacity-100">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" viewBox="0 0 20 20"
                                            fill="currentColor" stroke="currentColor" stroke-width="1">
                                            <path fill-rule="evenodd"
                                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                    </span>
                                </label>
                            </div>
                        </div>
                    </div> --}}
                    <div class="mt-10">
                        <div class="flex justify-between items-center">
                            <h1 class="text-lg">Categories</h1>

                        </div>

                        <ul class="mt-9 space-y-2">

                            @foreach ($randomCategories as $category)
                                <div class="hs-accordion-group" id="accordion-nested-parent" data-accordion="collapse">
                                    <div class="hs-accordion hs-accordion-active:border-gray-200 bg-white border border-transparent rounded-xl dark:hs-accordion-active:border-gray-700 dark:bg-gray-800 dark:border-transparent"
                                        id="accordion-collapse-heading-{{ $category->id }}">

                                        <button data-accordion-target="#accordion-collapse-body-{{ $category->id }}"
                                            aria-expanded="false"
                                            aria-controls="accordion-collapse-body-{{ $category->id }}"
                                            class="hs-accordion-toggle hs-accordion-active:text-blue-600 gap-x-3 w-full  text-start text-gray-800 py-4 px-5 hover:text-gray-500 disabled:opacity-50 inline-flex justify-between items-center disabled:pointer-events-none dark:hs-accordion-active:text-blue-500 dark:text-gray-200 dark:hover:text-gray-400 dark:focus:outline-none dark:focus:text-gray-400"
                                            aria-controls="hs-basic-active-bordered-collapse-one">
                                            {{ $category->title }}
                                            <a href="{{ route('categories.business', str_replace(' ', '-', $category->title)) }}"
                                                class="px-1 py-1  text-center text-gray-900 align-middle transition-all rounded-lg select-none disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none hover:bg-gray-900/10 active:bg-gray-900/20">
                                                ➔
                                            </a>


                                        </button>

                                        <div id="accordion-collapse-body-{{ $category->id }}"
                                            aria-labelledby="accordion-collapse-heading-{{ $category->id }}"
                                            class="hs-accordion-content hidden w-full overflow-hidden transition-[height] duration-300">
                                            <div class="pb-4 px-5">
                                                @foreach ($category->childCategories as $childCategory)
                                                    <div class="border-b-2 mb-2 hover:bg-gray-100/5 mt-1 text-gray-400">
                                                        <a
                                                            href="{{ route('categories.business', str_replace(' ', '-', $childCategory->title)) }}">{{ $childCategory->title }}</a>
                                                    </div>
                                                @endforeach

                                            </div>

                                        </div>
                                    </div>
                                </div>
                                {{-- <li class="flex justify-between items-center opacity-50">
                                    <a href="{{ route('categories.business', ['category' => $category->title]) }}"
                                        class="cursor-pointer hover:underline">{{ $category->title }}</a>
                                    <p class="border-b-2 border-primary">305</p>
                                </li> --}}
                            @endforeach
                            <a href="{{ route('categories.show.all') }}" class="text-white">
                                <div class="mx-auto my-4 p-4 bg-[#158FC6] text-center">
                                    View all
                                </div>
                            </a>
                        </ul>
                    </div>
                </div>

                <div class="bg-[#FAFAFF] lg:col-span-8 xl:col-span-9 rounded-xl py-10 px-7">
                    <div class="flex justify-end items-center gap-4 flex-col sm:flex-row">
                        <div class="max-w-sm w-full flex items-center">
                            <select wire:model.live="sortBy" id="review"
                                class="peer flex-1 bg-white rounded-[10px] border border-black bg-transparent font-normal text-black outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-white placeholder-shown:border-t-white empty:!bg-gray-900 focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50 focus:border-primary mt-2">
                                <option value="2">Best Rated</option>
                                <option value="1" selected="">Recent Businesses</option>
                                <option value="3">Recently Reviewed</option>
                            </select>
                        </div>
                        {{-- <div class="max-w-sm w-full">
                            <label for="review" class="text-lg">Rating</label>
                            <select wire:model.live="ratingFilter" id="review"
                                class="peer w-full bg-white rounded-[10px] border border-black bg-transparent px-3 py-2.5 font-normal text-black outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-white placeholder-shown:border-t-white empty:!bg-gray-900 focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50 focus:border-primary mt-2 h-[65px]">
                                <option value="" selected="">Any</option>
                                <option value="3">&#9733; 3.0+</option>
                                <option value="4">&#9733; 4.0+</option>
                                <option value="4.5">&#9733; 4.5+</option>
                            </select>
                        </div> --}}
                    </div>

                    <div class="mt-10 space-y-4">
                        @forelse ($companies as $company)
                            <div wire:key="company-{{ $company->id }}"
                                class="bg-white rounded-[20px] py-6 px-4 flex justify-start items-start gap-3 xl:flex-row flex-col">


                                {{-- Tooltip content --}}
                                <div id="tooltip-click-{{ $company->id }}" role="tooltip"
                                    class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium bg-gray-200 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                                    <div class="max-w-md mx-auto px-4">
                                        <div class="border-b-2 border-gray-300 pt-4 pb-1 flex items-center">
                                            <span class="text-sm font-bold">contact</span>
                                        </div>

                                        <div class="border-b-2 border-gray-300 pt-4 pb-1 flex items-center">
                                            <div
                                                class="border border-black rounded-md w-8 h-8 flex justify-center items-center">
                                                <i class="fa-regular fa-envelope text-sm"></i>
                                            </div>
                                            <span class="px-4"></span>
                                            <a href="mailto:{{ $company->user_email }}"
                                                class="text-blue-600 ml-2 underline">{{ $company->user_email }}</a>
                                        </div>

                                        <div class="border-b-2 border-gray-300 pt-4 pb-1 flex items-center">
                                            <div
                                                class="border border-black rounded-md w-8 h-8 flex justify-center items-center">
                                                <i class="fa-regular fa-globe text-sm"></i>
                                            </div>
                                            <span class="px-4"></span>
                                            <a href="{{ $company->websiteUrl }}" target="_black"
                                                class="text-blue-600 ml-2 underline">{{ $company->websiteUrl }}</a>
                                        </div>

                                        <div class="border-b-2 border-gray-300 pt-4 pb-1 flex items-center">
                                            <div
                                                class="border border-black rounded-md w-8 h-8 flex justify-center items-center">
                                                <i class="fa-regular fa-phone text-sm"></i>
                                            </div>
                                            <span class="px-4"></span>
                                            <a href="tel:{{ $company->phone_number }}"
                                                class="text-blue-600 ml-2 underline">{{ $company->phone_number }}</a>
                                        </div>
                                    </div>

                                    <div class="tooltip-arrow" data-popper-arrow></div>
                                </div>
                                {{-- Tooltip content --}}

                                {{-- company tooltip --}}
                                <div id="tooltip-company-description-{{ $company->id }}" role="tooltip"
                                    class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium bg-gray-200 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                                    <div class="max-w-md mx-auto px-4">
                                        {!! $company->description !!}
                                    </div>
                                    <div class="tooltip-arrow" data-popper-arrow></div>
                                </div>

                                <div class="flex-1 h-full flex flex-col justify-between">
                                    <div data-tooltip-target="tooltip-company-description-{{ $company->id }}"
                                        class="flex justify-start flex-col sm:flex-row">
                                        <div class="flex-shrink-0">
                                            <img src="{{ asset('storage/' . $company->business_image) }}"
                                                class="w-50 h-50 max-w-50" style="max-height: 50px;border-radius:10px"
                                                alt="{{ $company->business_name }} />
                                            
                                        </div>
                                        <div>
                                            <h1 class="text-lg">{{ $company->businessName }}
                                            </h1>
                                            <div class="flex justify-start items-center gap-2 flex-wrap">
                                                <p class="text-lg opacity-50">TrustBank
                                                    {{ $company?->avg_rating ?? '0.0' }}</p>
                                                <div
                                                    class="bg-[#0BA1E5] rounded-full px-2 py-1 flex justify-start items-center gap-1 w-38">
                                                    {!! $company->generateStarRating() !!}
                                                </div>
                                                <p class="text-lg opacity-50 font-light italic">
                                                    {{ $company?->reviews_count ?? '0' }}
                                                    @choice('review|reviews', $company->reviews_count)
                                                </p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="flex items-center mt-9 gap-2">

                                        <div data-tooltip-target="tooltip-click-{{ $company->id }}"
                                            data-tooltip-trigger="click"
                                            class="flex-shrink-0 cursor-pointer border-r-2 pr-2">
                                            <div class="flex items-start gap-2">
                                                <div
                                                    class="border border-black rounded-md w-8 h-8 flex justify-center items-center">
                                                    <i class="fa-regular fa-phone text-sm"></i>
                                                </div>
                                                <div
                                                    class="border border-black rounded-md w-8 h-8 flex justify-center items-center">
                                                    <i class="fa-regular fa-globe text-sm"></i>
                                                </div>
                                                <div
                                                    class="border border-black rounded-md w-8 h-8 flex justify-center items-center">
                                                    <i class="fa-regular fa-envelope text-sm"></i>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="flex justify-start items-center gap-3 flex-wrap">
                                            @if ($company?->category)
                                                <div class="flex justify-start items-center gap-2">
                                                    <div class="w-2 h-2 rounded-full bg-[#D9D9D9]"></div>
                                                    <p class="text-sm opacity-50">{{ $company->category->title }}</p>
                                                </div>
                                            @endif

                                            @if ($company?->subcategory)
                                                <div class="flex justify-start items-center gap-2">
                                                    <div class="w-2 h-2 rounded-full bg-[#D9D9D9]"></div>
                                                    <p class="text-sm opacity-50">{{ $company->subcategory->title }}
                                                    </p>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div
                                    class="flex-shrink-0 flex items-center gap-2 flex-col sm:flex-row sm:w-auto w-full">
                                    <a href="{{ route('front.business.show', ['business_name' => $company->businessName]) }}"
                                        class="align-middle select-none text-sm font-medium text-center transition-all disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none py-3 px-6 rounded-lg bg-primary text-white shadow-md shadow-primary/10 hover:shadow-lg hover:shadow-primary/20 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none border border-primary sm:w-auto w-full"
                                        type="button" data-ripple-light="true">
                                        View business
                                    </a>
                                    {{-- <button
                                        class="align-middle select-none text-sm text-black font-medium text-center transition-all disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none py-3 px-6 rounded-lg bg-white shadow-md shadow-white/10 hover:shadow-lg hover:shadow-white/20 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none border border-primary sm:w-auto w-full"
                                        type="button" data-ripple-dark="true">
                                        Most Relevant
                                    </button> --}}
                                </div>
                            </div>

                        @empty
                            <p class="text-center">No businesses have been listed in this category yet. Would you like
                                to explore another category?</p>
                        @endforelse

                    </div>
                </div>
            </div>

            <div class="mt-6 grid lg:grid-cols-12">
                <div class="lg:col-span-4 xl:col-span-3"></div>
                <div class="lg:col-span-8 xl:col-span-9">
                    {{ $companies->links('vendor.livewire.front-custom-pagination') }}
                </div>
            </div>
        </div>
    </section>

    @if ($recentlyReviewedCompanies->count() > 0)
        <section class="pt-36 relative flex justify-center items-center" wire:ignore>
            <div class="container xl:max-w-screen-2xl mx-auto px-4 relative">
                <div class="flex justify-between sm:items-center gap-4 flex-col sm:flex-row">
                    <h1 class="text-black text-5xl leading-tight font-bold">
                        Recently reviewed companies
                    </h1>
                    <div class="flex items-center">
                        <button
                            class="px-6 py-3 font-medium text-center text-gray-900 align-middle transition-all rounded-lg select-none disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none hover:bg-gray-900/10 active:bg-gray-900/20 slidePrev-btn1"
                            type="button" data-ripple-dark="true">
                            <svg xmlns="http://www.w3.org/2000/svg" width="39" height="22"
                                viewBox="0 0 39 22" fill="none">
                                <path
                                    d="M10.8462 0.718406L0.0059561 11.091L10.8343 21.4749L12.6563 19.7314L4.93482 12.3269L38.573 12.3445L38.5744 9.8776L4.93648 9.86004L12.6662 2.46376L10.8462 0.718406Z"
                                    fill="black"></path>
                            </svg>
                        </button>
                        <button
                            class="px-6 py-3 font-medium text-center text-gray-900 align-middle transition-all rounded-lg select-none disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none hover:bg-gray-900/10 active:bg-gray-900/20 slideNext-btn1"
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
                    <div class="swiper swiperReview">
                        <div class="swiper-wrapper">
                            @foreach ($recentlyReviewedCompanies as $review)
                                <div wire:key="{{ 'recentlyReviewedCompanies-' . $review->id }}"
                                    class="swiper-slide py-20">
                                    <div class="border border-[#0BA1E5] rounded-[12px] pb-5">
                                        <div class="bg-primary h-[172px] py-5 px-4 rounded-[10px]">
                                            <div class="flex justify-end items-center gap-2">
                                                <i class="fa-regular fa-clock text-white text-xs"></i>
                                                <p class="text-xs text-white">
                                                    {{ $review->created_at->diffForHumans() }}
                                                </p>
                                            </div>
                                            <div class="flex justify-start items-center gap-2 mt-2">
                                                <h1 class="text-white text-lg">
                                                    <a href="{{ route('front.business.show', ['business_name' => $review->businessAccount->businessName]) }}"
                                                        class="hover:underline">
                                                        {!! Str::limit($review->businessAccount->businessName, 20, '...') !!}

                                                    </a>
                                                </h1>
                                                <div
                                                    class="bg-black rounded-full px-2 py-1 flex justify-start items-center gap-1 w-38">
                                                    {!! $review->businessAccount->generateStarRating() !!}
                                                </div>
                                                <p class="text-sm text-white">
                                                    {{ $review->businessAccount->businessStat->avg_rating }}</p>
                                            </div>
                                            <div class="mt-3 description_section">
                                                <p class="text-white text-xs font-light line-clamp-1">
                                                    {!! Str::limit($review->businessAccount->description, 50, '...') !!}
                                                </p>
                                            </div>
                                            <div class="mt-2 text-end">
                                                <p class="text-xs text-white">
                                                    {{ number_format($review->businessAccount->businessStat->reviews_count) }}
                                                    @choice('review|reviews', $review->businessAccount->businessStat->reviews_count)</p>
                                            </div>
                                        </div>
                                        <div class="h-[155px] bg-[#FAFAFF] mt-4 mx-4 py-5 px-4">
                                            <p class="line-clamp-6">
                                                {!! Str::limit($review->review, 100, '...') !!}
                                            </p>
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

    @if ($newestCompanies->count() > 0)
        <section class="pt-20 relative flex justify-center items-center" wire:ignore>
            <div class="container xl:max-w-screen-2xl mx-auto px-4 relative">
                <div class="flex justify-between sm:items-center gap-4 flex-col sm:flex-row">
                    <h1 class="text-black text-5xl leading-tight font-bold">
                        Newest companies
                    </h1>
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
                                    <div class="border border-[#0BA1E5] rounded-[12px]">
                                        <div class="bg-primary h-[172px] py-5 px-4 rounded-[10px]">
                                            <div class="flex justify-end items-center gap-2">
                                                <i class="fa-regular fa-clock text-white text-xs"></i>
                                                <p class="text-xs text-white">
                                                    {{ $newCompany->created_at?->diffForHumans() }}</p>
                                            </div>
                                            <div class="flex justify-start items-center gap-2 mt-2">
                                                <h1 class="text-white text-lg">
                                                    <a href="{{ route('front.business.show', ['business_name' => $newCompany->businessName]) }}"
                                                        class="hover:underline">
                                                        {!! Str::limit($newCompany->businessName, 20, '...') !!}
                                                    </a>
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

                                            <div class="mt-2 text-end">
                                                <p class="text-xs text-white">
                                                    {{ number_format($newCompany?->businessStat?->reviews_count) }}
                                                    @choice('review|reviews', $newCompany?->businessStat?->reviews_count)</p>
                                            </div>
                                        </div>
                                        <div
                                            class="border-t border-gray-400 pt-4 pb-3 px-5 mt-20 flex justify-start items-center gap-2">
                                            <i class="fa-regular fa-location-dot"></i>
                                            <p class="line-clamp-6">{{ $newCompany->country->name }}</p>
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
</div>

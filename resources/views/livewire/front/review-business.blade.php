@push('styles')
    <style>
        #full-stars-example {

            /* use display:inline-flex to prevent whitespace issues. alternatively, you can put all the children of .rating-group on a single line */
            .rating-group {
                display: inline-flex;
            }

            /* make hover effect work properly in IE */
            .rating__icon {
                pointer-events: none;
            }

            /* hide radio inputs */
            .rating__input {
                position: absolute !important;
                left: -9999px !important;
            }

            /* set icon padding and size */
            .rating__label {
                cursor: pointer;
                padding: 0 0.1em;
                font-size: 2rem;
            }

            /* set default star color */
            .rating__icon--star {
                color: orange;
            }

            /* set color of none icon when unchecked */
            .rating__icon--none {
                color: #eee;
            }

            /* if none icon is checked, make it red */
            .rating__input--none:checked+.rating__label .rating__icon--none {
                color: red;
            }

            /* if any input is checked, make its following siblings grey */
            .rating__input:checked~.rating__label .rating__icon--star {
                color: #ddd;
            }

            /* make all stars orange on rating group hover */
            .rating-group:hover .rating__label .rating__icon--star {
                color: orange;
            }

            /* make hovered input's following siblings grey on hover */
            .rating__input:hover~.rating__label .rating__icon--star {
                color: #ddd;
            }

            /* make none icon grey on rating group hover */
            .rating-group:hover .rating__input--none:not(:hover)+.rating__label .rating__icon--none {
                color: #eee;
            }

            /* make none icon red on hover */
            .rating__input--none:hover+.rating__label .rating__icon--none {
                color: red;
            }
        }

        #half-stars-example {

            /* use display:inline-flex to prevent whitespace issues. alternatively, you can put all the children of .rating-group on a single line */
            .rating-group {
                display: inline-flex;
            }

            /* make hover effect work properly in IE */
            .rating__icon {
                pointer-events: none;
            }

            /* hide radio inputs */
            .rating__input {
                position: absolute !important;
                left: -9999px !important;
            }

            /* set icon padding and size */
            .rating__label {
                cursor: pointer;
                /* if you change the left/right padding, update the margin-right property of .rating__label--half as well. */
                padding: 0 0.1em;
                font-size: 2rem;
            }

            /* add padding and positioning to half star labels */
            .rating__label--half {
                padding-right: 0;
                margin-right: -1.2em;
                z-index: 2;
            }

            /* set default star color */
            .rating__icon--star {
                color: orange;
            }

            /* set color of none icon when unchecked */
            .rating__icon--none {
                color: #eee;
            }

            /* if none icon is checked, make it red */
            .rating__input--none:checked+.rating__label .rating__icon--none {
                color: red;
            }

            /* if any input is checked, make its following siblings grey */
            .rating__input:checked~.rating__label .rating__icon--star {
                color: #ddd;
            }

            /* make all stars orange on rating group hover */
            .rating-group:hover .rating__label .rating__icon--star,
            .rating-group:hover .rating__label--half .rating__icon--star {
                color: orange;
            }

            /* make hovered input's following siblings grey on hover */
            .rating__input:hover~.rating__label .rating__icon--star,
            .rating__input:hover~.rating__label--half .rating__icon--star {
                color: #ddd;
            }

            /* make none icon grey on rating group hover */
            .rating-group:hover .rating__input--none:not(:hover)+.rating__label .rating__icon--none {
                color: #eee;
            }

            /* make none icon red on hover */
            .rating__input--none:hover+.rating__label .rating__icon--none {
                color: red;
            }
        }

        #full-stars-example-two {

            /* use display:inline-flex to prevent whitespace issues. alternatively, you can put all the children of .rating-group on a single line */
            .rating-group {
                display: inline-flex;
            }

            /* make hover effect work properly in IE */
            .rating__icon {
                pointer-events: none;
            }

            /* hide radio inputs */
            .rating__input {
                position: absolute !important;
                left: -9999px !important;
            }

            /* hide 'none' input from screenreaders */
            .rating__input--none {
                display: none
            }

            /* set icon padding and size */
            .rating__label {
                cursor: pointer;
                padding: 0 0.1em;
                font-size: 2rem;
            }

            /* set default star color */
            .rating__icon--star {
                color: orange;
            }

            /* if any input is checked, make its following siblings grey */
            .rating__input:checked~.rating__label .rating__icon--star {
                color: #ddd;
            }

            /* make all stars orange on rating group hover */
            .rating-group:hover .rating__label .rating__icon--star {
                color: orange;
            }

            /* make hovered input's following siblings grey on hover */
            .rating__input:hover~.rating__label .rating__icon--star {
                color: #ddd;
            }
        }
    </style>
@endpush
<div>
    <section class="pt-36 relative flex justify-center items-center">
        <div class="container xl:max-w-screen-2xl mx-auto px-4 relative">
            <div class="grid">
                @php
                    $urlCurrent = Illuminate\Support\Facades\URL::current();
                @endphp

                <div class="flex flex-col justify-center items-center">
                    <!-- Breadcrumbs -->
                    <p class="opacity-50 mb-6">
                        <a href="{{ route('categories.business', str_replace(' ', '-', $businessAccount->category->title)) }}"
                            class="hover:underline">{{ $businessAccount->category->title }}</a>
                        >>
                        @if ($businessAccount->subCategory)
                            <a href="{{ route('categories.business', str_replace(' ', '-', $businessAccount->subCategory->title)) }}"
                                class="hover:underline">{{ $businessAccount->subCategory->title }}</a>
                            >>
                        @endif
                        {{ $businessAccount->businessName }}
                    </p>

                    <!-- Logo -->
                    <img class="w-100 h-100 max-w-100" style="max-height: 100px;"
                        src="{{ asset('storage/' . $businessAccount->business_image) }}" alt="">

                    <!-- Business Name -->
                    <h1 class="text-black text-4xl xl:text-4xl leading-tight   font-bold">
                        {{ $businessAccount->businessName }}
                    </h1>

                    <div class="business-stats flex flex-col justify-center items-center mt-6">
                        <div class="flex items-center gap-3 mt-2">
                            <div class="flex items-center gap-1">
                                <i class="fa-regular fa-globe"></i>
                                <a href="{{ $businessAccount->websiteUrl }}"
                                    class="font-light hover:underline">{{ $businessAccount->websiteUrl }}</a>
                            </div>
                            <div class="flex items-center gap-1">
                                <i class="fa-regular fa-phone"></i>
                                <p class="font-light">{{ $businessAccount->phone_number }}</p>
                            </div>

                        </div>
                        <div class="mt-2">
                            <!-- Individual or Business Badge -->
                            <div class="flex justify-center items-center rounded-full p-3 space-x-8">
                                <!-- Individual or Business Badge -->
                                <div
                                    class="mt-2 px-2 py-1 rounded-full text-xs font-semibold 
                            {{ $businessAccount->individual_or_business === 'business' ? 'bg-blue-500 text-white' : 'bg-green-500 text-white' }}">
                                    {{ $businessAccount->individual_or_business === 'business' ? 'Business' : 'Individual' }}
                                </div>

                                <!-- Verification Status -->
                                <div class="flex items-center gap-1">
                                    @if ($businessAccount->user->is_hot_bleep == 1)
                                        <i class="fa-solid fa-badge-check text-green-600"></i>
                                        <p class="font-light">Unclaimed company</p>
                                    @else
                                        <i
                                            class="fa-solid fa-badge-check {{ $businessAccount->is_verified ? 'text-green-600' : 'text-red-600' }}"></i>
                                        <p class="font-light">
                                            {{ $businessAccount->is_verified ? 'Verified' : 'Not Verified' }}</p>
                                    @endif
                                </div>

                                <!-- Star Rating and Average Rating -->
                                <div class="bg-[#0BA1E5] rounded-full px-2 py-1 flex items-center gap-1 text-white">
                                    {!! $businessAccount->generateStarRating() !!}
                                    <p class="font-light">{{ $businessAccount?->businessStat?->avg_rating ?? '0.0' }}
                                    </p>
                                </div>
                                <div class="flex items-center gap-1">
                                    <p>{!! '<i class="' .
                                        $businessAccount?->getSmileyAndMessage()['iconClass'] .
                                        '"></i> ' .
                                        $businessAccount?->getSmileyAndMessage()['message'] !!}</p>
                                </div>
                            </div>
                        </div>


                    </div>


                    <!-- Claim Business Button -->
                    @auth
                        @if (
                            !Auth::user()->has_business_account &&
                                !Auth::user()->businessClaimRequest &&
                                !Auth::user()->is_hot_bleep &&
                                $businessAccount->user->is_hot_bleep)
                            <span class="mt-8">
                                <span wire:click="showSendClaimModal()" title="Send claim request"
                                    class="cursor-pointer inline-flex items-center gap-x-1.5 py-3 px-5 rounded-lg text-base font-medium bg-yellow-500 text-white hover:bg-yellow-600 transition-colors">
                                    Claim
                                </span>
                            </span>
                        @endif
                    @endauth


                    <!-- Description -->
                    {{-- <span class="text-gray-800 dark:text-white w-full p-8 px-10 m-5 border-t-2 border-orange/50 dark:border-orange/50 text-lg leading-relaxed font-serif" style="word-wrap: break-word; white-space: pre-wrap;">
                        {{ $businessAccount->description }}
                    </span> --}}
                    <span id="descriptionSpan" class="text-gray-800 dark:text-white w-full p-8 px-10 m-5 border-t-2 border-orange/50 dark:border-orange/50 text-lg leading-relaxed font-serif"></span>

                    <script>
                        document.addEventListener("DOMContentLoaded", function() {
                            var description = {!! json_encode($businessAccount->description) !!};
                            var descriptionSpan = document.getElementById("descriptionSpan");
                            var characterLimit = 180; // Change the character limit as needed
                            var descriptionWithSpaces = addSpaces(description, characterLimit);
                    
                            descriptionSpan.textContent = descriptionWithSpaces;
                        });
                    
                        function addSpaces(description, characterLimit) {
                            var result = "";
                            var count = 0;
                    
                            for (var i = 0; i < description.length; i++) {
                                result += description[i];
                                count++;
                    
                                if (count === characterLimit && description[i + 1] !== " ") {
                                    result += " ";
                                }
                    
                                if (count === 2 * characterLimit && description[i + 1] !== " ") {
                                    result += " ";
                                    count = 0;
                                }
                            }
                    
                            return result;
                        }
                    </script>
                    

                    
                    
                    
                    
                    
                </div>



                <div class="container">
                    <!-- Social Icons -->
                    <div class="flex justify-center items-center mt-0 mb-4">
                        <div class="flex flex-col items-center">
                            <p class="text-gray-700 text-lg font-semibold mb-2">Share</p>
                            <div
                                class="flex justify-center items-center bg-gray-100 border border-gray-300 rounded-full p-3 space-x-8">
                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ $urlCurrent }}"
                                    target="_blank" rel="noopener noreferrer"
                                    class="inline-block w-12 h-12 flex items-center justify-center">
                                    <i class="fab fa-facebook-square text-blue-500 text-4xl hover:text-blue-600"></i>
                                </a>
                                <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ $urlCurrent }}"
                                    target="_blank" rel="noopener noreferrer"
                                    class="inline-block w-12 h-12 flex items-center justify-center">
                                    <i class="fab fa-linkedin text-blue-500 text-4xl hover:text-blue-600"></i>
                                </a>
                                <a href="https://twitter.com/intent/tweet?url={{ $urlCurrent }}" target="_blank"
                                    rel="noopener noreferrer"
                                    class="inline-block w-12 h-12 flex items-center justify-center">
                                    <img style="height: 36px; width: auto;" class="inline-block"
                                        src="{{ asset('images/twitter.png') }}" alt="">
                                </a>
                                <a href="https://www.instagram.com/?url={{ $urlCurrent }}" target="_blank"
                                    rel="noopener noreferrer"
                                    class="inline-block w-12 h-12 flex items-center justify-center">
                                    <i class="fab fa-instagram text-pink-500 text-4xl hover:text-pink-600"></i>
                                </a>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
            <div class="flex justify-end items-center gap-3">
                @if (Auth::check())
                    @if (!$alreadyReviewed && $businessAccount->user_id != Auth::id())
                        <button wire:click="addReview"
                            class="align-middle select-none font-medium text-center transition-all disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none py-3 px-6 rounded-lg bg-gray-900 text-white shadow-md shadow-gray-900/10 hover:shadow-lg hover:shadow-gray-900/20 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none"
                            type="button" data-ripple-light="true">
                            Add a review
                        </button>
                    @endif
                @else
                    <a href="{{ route('login') }}"
                        class="px-6 py-3 bg-gray-900/25 font-medium text-center text-gray-900 align-middle transition-all rounded-lg select-none disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none hover:bg-gray-900/10 active:bg-gray-900/20">
                        Login to add a review</a>
                @endif
            </div>

            @auth
                @if (
                    $businessAccount?->businessClaimRequest &&
                        $businessAccount?->businessClaimRequest->user_id == Auth::id() &&
                        $businessAccount?->businessClaimRequest->is_claimed == 0)
                    <div class="mt-10 rounded-xl bg-[#FAFAFF] py-10 px-12">
                        <div class="flex justify-start sm:items-center gap-5 sm:flex-row flex-col">
                            <div class="flex-1 flex justify-center items-center gap-5">
                                <span class="text-lg font-light text-orange-500">
                                    You have a pending request to claim ownership of this business.
                                </span>
                            </div>
                        </div>
                    </div>
                @endif
            @endauth
        </div>
    </section>

    <section class="mt-12">
        <div class="container xl:max-w-screen-2xl mx-auto px-4 relative">
            <div class="grid lg:grid-cols-12 gap-5">
                <div class="lg:col-span-8 space-y-4">
                    <div class="rounded-xl bg-[#FAFAFF] py-10 px-7">
                        <div>
                            <h1 class="text-3xl font-semibold">
                                Reviews
                                <span class="text-2xl font-normal relative">
                                    {{ $businessAccount?->businessStat?->avg_rating ?? '0.0' }}
                                    <i class="fa-solid fa-star absolute top-0 -right-4 text-xs text-primary"></i>
                                </span>
                            </h1>
                        </div>
                        <div class="mt-6 space-y-3">
                            <div class="flex justify-start items-center gap-3">
                                <label class="relative flex items-center p-3 rounded-full cursor-pointer"
                                    htmlFor="ripple-on" data-ripple-dark="true">
                                    <input wire:model.live="starsFilter" value="5" id="ripple-on" type="checkbox"
                                        class="before:content[''] peer relative h-5 w-5 cursor-pointer appearance-none rounded-full border border-blue-gray-200 transition-all before:absolute before:top-2/4 before:left-2/4 before:block before:h-12 before:w-12 before:-translate-y-2/4 before:-translate-x-2/4 before:rounded-full before:bg-blue-gray-500 before:opacity-0 before:transition-opacity checked:border-gray-900 checked:bg-gray-900 checked:before:bg-gray-900 hover:before:opacity-10" />
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
                                <p class="font-light">5-Star</p>
                                <div
                                    class="flex-start flex h-2 flex-1 overflow-hidden rounded-full bg-blue-gray-50 font-sans text-xs font-medium">
                                    <div class="flex h-full items-center justify-center overflow-hidden break-all rounded-full bg-gray-900 text-white"
                                        style="width: {{ $this->calculatePercentageForSpecificStar(5) . '%' }}">
                                    </div>
                                </div>
                                <p class="font-light md:ml-5">{{ $this->calculatePercentageForSpecificStar(5) }}%</p>
                            </div>
                            <div class="flex justify-start items-center gap-3">
                                <label class="relative flex items-center p-3 rounded-full cursor-pointer"
                                    htmlFor="ripple-on" data-ripple-dark="true">
                                    <input wire:model.live="starsFilter" value="4" id="ripple-on"
                                        type="checkbox"
                                        class="before:content[''] peer relative h-5 w-5 cursor-pointer appearance-none rounded-full border border-blue-gray-200 transition-all before:absolute before:top-2/4 before:left-2/4 before:block before:h-12 before:w-12 before:-translate-y-2/4 before:-translate-x-2/4 before:rounded-full before:bg-blue-gray-500 before:opacity-0 before:transition-opacity checked:border-gray-900 checked:bg-gray-900 checked:before:bg-gray-900 hover:before:opacity-10" />
                                    <span
                                        class="absolute text-white transition-opacity opacity-0 pointer-events-none top-2/4 left-2/4 -translate-y-2/4 -translate-x-2/4 peer-checked:opacity-100">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5"
                                            viewBox="0 0 20 20" fill="currentColor" stroke="currentColor"
                                            stroke-width="1">
                                            <path fill-rule="evenodd"
                                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                    </span>
                                </label>
                                <p class="font-light">4-Star</p>
                                <div
                                    class="flex-start flex h-2 flex-1 overflow-hidden rounded-full bg-blue-gray-50 font-sans text-xs font-medium">
                                    <div class="flex h-full items-center justify-center overflow-hidden break-all rounded-full bg-gray-900 text-white"
                                        style="width: {{ $this->calculatePercentageForSpecificStar(4) . '%' }}">
                                    </div>
                                </div>
                                <p class="font-light md:ml-5">{{ $this->calculatePercentageForSpecificStar(4) . '%' }}
                                </p>
                            </div>
                            <div class="flex justify-start items-center gap-3">
                                <label class="relative flex items-center p-3 rounded-full cursor-pointer"
                                    htmlFor="ripple-on" data-ripple-dark="true">
                                    <input wire:model.live="starsFilter" value="3" id="ripple-on"
                                        type="checkbox"
                                        class="before:content[''] peer relative h-5 w-5 cursor-pointer appearance-none rounded-full border border-blue-gray-200 transition-all before:absolute before:top-2/4 before:left-2/4 before:block before:h-12 before:w-12 before:-translate-y-2/4 before:-translate-x-2/4 before:rounded-full before:bg-blue-gray-500 before:opacity-0 before:transition-opacity checked:border-gray-900 checked:bg-gray-900 checked:before:bg-gray-900 hover:before:opacity-10" />
                                    <span
                                        class="absolute text-white transition-opacity opacity-0 pointer-events-none top-2/4 left-2/4 -translate-y-2/4 -translate-x-2/4 peer-checked:opacity-100">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5"
                                            viewBox="0 0 20 20" fill="currentColor" stroke="currentColor"
                                            stroke-width="1">
                                            <path fill-rule="evenodd"
                                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                    </span>
                                </label>
                                <p class="font-light">3-Star</p>
                                <div
                                    class="flex-start flex h-2 flex-1 overflow-hidden rounded-full bg-blue-gray-50 font-sans text-xs font-medium">
                                    <div class="flex h-full items-center justify-center overflow-hidden break-all rounded-full bg-gray-900 text-white"
                                        style="width: {{ $this->calculatePercentageForSpecificStar(3) . '%' }}">
                                    </div>
                                </div>
                                <p class="font-light md:ml-5">{{ $this->calculatePercentageForSpecificStar(3) . '%' }}
                                </p>
                            </div>
                            <div class="flex justify-start items-center gap-3">
                                <label class="relative flex items-center p-3 rounded-full cursor-pointer"
                                    htmlFor="ripple-on" data-ripple-dark="true">
                                    <input wire:model.live="starsFilter" value="2" id="ripple-on"
                                        type="checkbox"
                                        class="before:content[''] peer relative h-5 w-5 cursor-pointer appearance-none rounded-full border border-blue-gray-200 transition-all before:absolute before:top-2/4 before:left-2/4 before:block before:h-12 before:w-12 before:-translate-y-2/4 before:-translate-x-2/4 before:rounded-full before:bg-blue-gray-500 before:opacity-0 before:transition-opacity checked:border-gray-900 checked:bg-gray-900 checked:before:bg-gray-900 hover:before:opacity-10" />
                                    <span
                                        class="absolute text-white transition-opacity opacity-0 pointer-events-none top-2/4 left-2/4 -translate-y-2/4 -translate-x-2/4 peer-checked:opacity-100">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5"
                                            viewBox="0 0 20 20" fill="currentColor" stroke="currentColor"
                                            stroke-width="1">
                                            <path fill-rule="evenodd"
                                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                    </span>
                                </label>
                                <p class="font-light">2-Star</p>
                                <div
                                    class="flex-start flex h-2 flex-1 overflow-hidden rounded-full bg-blue-gray-50 font-sans text-xs font-medium">
                                    <div class="flex h-full items-center justify-center overflow-hidden break-all rounded-full bg-gray-900 text-white"
                                        style="width: {{ $this->calculatePercentageForSpecificStar(2) . '%' }}">
                                    </div>
                                </div>
                                <p class="font-light md:ml-5">
                                    {{ $this->calculatePercentageForSpecificStar(2) . '%' }}</p>
                            </div>
                            <div class="flex justify-start items-center gap-3">
                                <label class="relative flex items-center p-3 rounded-full cursor-pointer"
                                    htmlFor="ripple-on" data-ripple-dark="true">
                                    <input wire:model.live="starsFilter" value="1" id="ripple-on"
                                        type="checkbox"
                                        class="before:content[''] peer relative h-5 w-5 cursor-pointer appearance-none rounded-full border border-blue-gray-200 transition-all before:absolute before:top-2/4 before:left-2/4 before:block before:h-12 before:w-12 before:-translate-y-2/4 before:-translate-x-2/4 before:rounded-full before:bg-blue-gray-500 before:opacity-0 before:transition-opacity checked:border-gray-900 checked:bg-gray-900 checked:before:bg-gray-900 hover:before:opacity-10" />
                                    <span
                                        class="absolute text-white transition-opacity opacity-0 pointer-events-none top-2/4 left-2/4 -translate-y-2/4 -translate-x-2/4 peer-checked:opacity-100">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5"
                                            viewBox="0 0 20 20" fill="currentColor" stroke="currentColor"
                                            stroke-width="1">
                                            <path fill-rule="evenodd"
                                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                    </span>
                                </label>
                                <p class="font-light">1-Star</p>
                                <div
                                    class="flex-start flex h-2 flex-1 overflow-hidden rounded-full bg-blue-gray-50 font-sans text-xs font-medium">
                                    <div class="flex h-full items-center justify-center overflow-hidden break-all rounded-full bg-gray-900 text-white"
                                        style="width: {{ $this->calculatePercentageForSpecificStar(1) . '%' }}">
                                    </div>
                                </div>
                                <p class="font-light md:ml-5">
                                    {{ $this->calculatePercentageForSpecificStar(1) . '%' }}</p>
                            </div>
                        </div>
                    </div>

                    @forelse ($reviews as $review)
                        <div wire:key="review-key-{{ $review->id }}" class="rounded-xl bg-[#FAFAFF] py-10 px-7">
                            <div class="flex justify-start items-center gap-2 relative">
                                <div class="border-2 border-primary rounded-full w-max">
                                    <img src="{{ asset('images/doctor-2.png') }}"
                                        class="rounded-full w-9 h-9 object-cover" alt="" />
                                </div>
                                <div>
                                    <h1 class="font-semibold">{{ $review->user->name }}</h1>
                                    <div class="flex justify-start items-center gap-6 mt-1">
                                        <div title="Interaction date"
                                            class="flex justify-start items-center gap-2 text-sm font-semibold">
                                            <i class="fa-regular fa-calendar-days"></i>
                                            {{ $review?->interaction_date?->format('F d, Y') }}
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div
                                class="py-4 px-6 rounded-xl mt-6 {{ $review->IsDisputedReview()->count() > 0 ? 'opacity-70 bg-red-300' : 'bg-white' }}">

                                <div class="bg-white py-4 px-6 rounded-xl mt-6">
                                    <div class="md:flex justify-between items-center gap-4">
                                        <div class="flex justify-start items-start gap-2">
                                            <div class="flex justify-start items-start gap-3">
                                                <i class="fa-solid fa-badge-check text-green-600 mt-1"></i>
                                                <p title="interaction detail" class="font-light">
                                                    {{ $review->interaction_detail }} <br />
                                                    <span
                                                        class="text-sm opacity-45">{{ $review->created_at?->diffForHumans() }}</span>
                                                </p>
                                            </div>
                                            <div
                                                class="bg-[#0BA1E5] rounded-full px-2 py-1 flex justify-start items-center gap-1 w-30">
                                                {!! $review->generateStarRating() !!}
                                            </div>
                                        </div>
                                        <div class="flex justify-end mt-5 md:mt-0 md:justify-start items-center gap-3">
                                            @if ($businessAccount->user_id == Auth::id())
                                                @if ($review->IsDisputedReview()->count() === 0)
                                                    <button wire:click="showDisputeModal({{ $review->id }})"
                                                        title="start a dispute"
                                                        class="relative h-10 max-h-[40px] w-10 max-w-[40px] select-none rounded-lg bg-white text-center align-middle font-sans text-xs font-medium uppercase text-white shadow-md shadow-gray-900/10 transition-all hover:shadow-lg hover:shadow-gray-900/20 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none">
                                                        <img src="{{ asset('images/dispute.jpg') }}" alt=""
                                                            class="p-1" />
                                                    </button>
                                                @else
                                                    <button title="disputed review"
                                                        class="relative h-10 max-h-[40px] w-10 max-w-[40px] select-none rounded-lg bg-white text-center align-middle font-sans text-xs font-medium uppercase text-white shadow-md shadow-gray-900/10 transition-all hover:shadow-lg hover:shadow-gray-900/20 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none">
                                                        <i class="fas fa-exclamation-triangle text-gray-700"></i>
                                                    </button>
                                                @endif
                                            @endif
                                            @php
                                                $userHasHelped = $review->users->contains(auth()->id());
                                            @endphp

                                            <button data-tooltip-target="tooltip-helpful-users-{{ $review->id }}"
                                                class="relative h-10 max-h-[40px] w-10 max-w-[40px] select-none rounded-lg bg-white text-center align-middle font-sans text-xs font-medium uppercase shadow-md transition-colors"
                                                type="button"
                                                @if ($review->user_id == auth()->id()) disabled
                                            @else
                                                wire:click="toggleHelpful({{ $review->id }})" @endif>
                                                <span
                                                    class="absolute transform -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2">
                                                    @if ($userHasHelped)
                                                        <span
                                                            class="absolute  transform -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="20"
                                                                height="20" viewBox="0 0 20 20" fill="none">
                                                                <path
                                                                    d="M3.125 1.25C2.62772 1.25 2.15081 1.44754 1.79917 1.79917C1.44754 2.15081 1.25 2.62772 1.25 3.125V5.875C1.25 6.04076 1.18415 6.19973 1.06694 6.31694C0.949731 6.43415 0.79076 6.5 0.625 6.5C0.45924 6.5 0.300269 6.43415 0.183058 6.31694C0.065848 6.19973 0 6.04076 0 5.875V3.125C0 2.2962 0.32924 1.50134 0.915291 0.915291C1.50134 0.32924 2.2962 0 3.125 0H5.875C6.04076 0 6.19973 0.065848 6.31694 0.183058C6.43415 0.300269 6.5 0.45924 6.5 0.625C6.5 0.79076 6.43415 0.949731 6.31694 1.06694C6.19973 1.18415 6.04076 1.25 5.875 1.25H3.125ZM3.125 18.75C2.62772 18.75 2.15081 18.5525 1.79917 18.2008C1.44754 17.8492 1.25 17.3723 1.25 16.875V14.125C1.25 13.9592 1.18415 13.8003 1.06694 13.6831C0.949731 13.5658 0.79076 13.5 0.625 13.5C0.45924 13.5 0.300269 13.5658 0.183058 13.6831C0.065848 13.8003 0 13.9592 0 14.125V16.875C0 17.7038 0.32924 18.4987 0.915291 19.0847C1.50134 19.6708 2.2962 20 3.125 20H5.875C6.04076 20 6.19973 19.9342 6.31694 19.8169C6.43415 19.6997 6.5 19.5408 6.5 19.375C6.5 19.2092 6.43415 19.0503 6.31694 18.9331C6.19973 18.8158 6.04076 18.75 5.875 18.75H3.125ZM18.75 3.125C18.75 2.62772 18.5525 2.15081 18.2008 1.79917C17.8492 1.44754 17.3723 1.25 16.875 1.25H14.125C13.9592 1.25 13.8003 1.18415 13.6831 1.06694C13.5658 0.949731 13.5 0.79076 13.5 0.625C13.5 0.45924 13.5658 0.300269 13.6831 0.183058C13.8003 0.065848 13.9592 0 14.125 0H16.875C17.7038 0 18.4987 0.32924 19.0847 0.915291C19.6708 1.50134 20 2.2962 20 3.125V5.875C20 6.04076 19.9342 6.19973 19.8169 6.31694C19.6997 6.43415 19.5408 6.5 19.375 6.5C19.2092 6.5 19.0503 6.43415 18.9331 6.31694C18.8158 6.19973 18.75 6.04076 18.75 5.875V3.125ZM16.875 18.75C17.3723 18.75 17.8492 18.5525 18.2008 18.2008C18.5525 17.8492 18.75 17.3723 18.75 16.875V14.125C18.75 13.9592 18.8158 13.8003 18.9331 13.6831C19.0503 13.5658 19.2092 13.5 19.375 13.5C19.5408 13.5 19.6997 13.5658 19.8169 13.6831C19.9342 13.8003 20 13.9592 20 14.125V16.875C20 17.7038 19.6708 18.4987 19.0847 19.0847C18.4987 19.6708 17.7038 20 16.875 20H14.125C13.9592 20 13.8003 19.9342 13.6831 19.8169C13.5658 19.6997 13.5 19.5408 13.5 19.375C13.5 19.2092 13.5658 19.0503 13.6831 18.9331C13.8003 18.8158 13.9592 18.75 14.125 18.75H16.875ZM9.6035 4.398C9.72217 4.23317 9.87897 4.09952 10.0605 4.00844C10.242 3.91737 10.4429 3.87158 10.646 3.875C11.3245 3.875 11.816 4.2875 12.1055 4.7985C12.389 5.298 12.5185 5.94 12.5185 6.6055C12.5185 7.0015 12.445 7.434 12.3335 7.875H13C13.085 7.875 13.2035 7.8825 13.309 7.892C13.406 7.901 13.546 7.917 13.654 7.944C14.7265 8.216 15.335 9.26 15.0625 10.322L14.2775 13.382C13.87 14.9685 12.255 15.927 10.6625 15.539L6.546 14.5365C6.22196 14.4581 5.92717 14.2885 5.69659 14.0477C5.466 13.807 5.30928 13.5051 5.245 13.178L4.903 11.424C4.83586 11.0786 4.89298 10.7206 5.06426 10.4133C5.23554 10.106 5.50995 9.86908 5.839 9.7445L6.4665 9.506C6.92753 9.33105 7.3204 9.01301 7.5875 8.5985L9.018 6.3745C9.03193 6.34618 9.04298 6.31653 9.051 6.286C9.07 6.2205 9.0885 6.136 9.1085 6.028C9.119 5.968 9.1315 5.895 9.1445 5.8145C9.1725 5.644 9.2055 5.441 9.2445 5.268C9.3035 5.0045 9.4005 4.672 9.6035 4.398ZM10.3385 6.252C10.2975 6.4745 10.232 6.7985 10.0695 7.051L8.639 9.275C8.22734 9.91416 7.62174 10.4046 6.911 10.6745L6.2835 10.913C6.22986 10.9327 6.18494 10.9708 6.15674 11.0205C6.12855 11.0702 6.11889 11.1283 6.1295 11.1845L6.472 12.9385C6.49047 13.0311 6.53509 13.1164 6.60058 13.1844C6.66607 13.2523 6.74968 13.3001 6.8415 13.322L10.9585 14.3245C11.8925 14.552 12.831 13.9885 13.0665 13.071L13.8515 10.011C13.954 9.6135 13.7425 9.256 13.3465 9.156C13.2957 9.14807 13.2447 9.14173 13.1935 9.137C13.1292 9.13058 13.0646 9.12657 13 9.125H11.5C11.4014 9.12501 11.3042 9.10168 11.2163 9.05691C11.1284 9.01215 11.0524 8.94722 10.9944 8.86744C10.9364 8.78766 10.8981 8.69529 10.8827 8.59789C10.8672 8.50048 10.875 8.4008 10.9055 8.307C11.1335 7.6065 11.2685 7.034 11.2685 6.6055C11.2685 6.082 11.1635 5.6715 11.0185 5.4155C10.8795 5.1705 10.747 5.125 10.646 5.125H10.635C10.6265 5.125 10.6225 5.125 10.62 5.1265C10.618 5.1275 10.6165 5.1295 10.614 5.1335L10.608 5.142C10.566 5.199 10.514 5.3185 10.464 5.541C10.4325 5.683 10.4115 5.8135 10.388 5.9575C10.373 6.048 10.3585 6.144 10.3385 6.252Z"
                                                                    fill="#3232eb" />
                                                            </svg>
                                                        </span>
                                                    @else
                                                        <span
                                                            class="absolute transform -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="20"
                                                                height="20" viewBox="0 0 20 20" fill="none">
                                                                <path
                                                                    d="M3.125 1.25C2.62772 1.25 2.15081 1.44754 1.79917 1.79917C1.44754 2.15081 1.25 2.62772 1.25 3.125V5.875C1.25 6.04076 1.18415 6.19973 1.06694 6.31694C0.949731 6.43415 0.79076 6.5 0.625 6.5C0.45924 6.5 0.300269 6.43415 0.183058 6.31694C0.065848 6.19973 0 6.04076 0 5.875V3.125C0 2.2962 0.32924 1.50134 0.915291 0.915291C1.50134 0.32924 2.2962 0 3.125 0H5.875C6.04076 0 6.19973 0.065848 6.31694 0.183058C6.43415 0.300269 6.5 0.45924 6.5 0.625C6.5 0.79076 6.43415 0.949731 6.31694 1.06694C6.19973 1.18415 6.04076 1.25 5.875 1.25H3.125ZM3.125 18.75C2.62772 18.75 2.15081 18.5525 1.79917 18.2008C1.44754 17.8492 1.25 17.3723 1.25 16.875V14.125C1.25 13.9592 1.18415 13.8003 1.06694 13.6831C0.949731 13.5658 0.79076 13.5 0.625 13.5C0.45924 13.5 0.300269 13.5658 0.183058 13.6831C0.065848 13.8003 0 13.9592 0 14.125V16.875C0 17.7038 0.32924 18.4987 0.915291 19.0847C1.50134 19.6708 2.2962 20 3.125 20H5.875C6.04076 20 6.19973 19.9342 6.31694 19.8169C6.43415 19.6997 6.5 19.5408 6.5 19.375C6.5 19.2092 6.43415 19.0503 6.31694 18.9331C6.19973 18.8158 6.04076 18.75 5.875 18.75H3.125ZM18.75 3.125C18.75 2.62772 18.5525 2.15081 18.2008 1.79917C17.8492 1.44754 17.3723 1.25 16.875 1.25H14.125C13.9592 1.25 13.8003 1.18415 13.6831 1.06694C13.5658 0.949731 13.5 0.79076 13.5 0.625C13.5 0.45924 13.5658 0.300269 13.6831 0.183058C13.8003 0.065848 13.9592 0 14.125 0H16.875C17.7038 0 18.4987 0.32924 19.0847 0.915291C19.6708 1.50134 20 2.2962 20 3.125V5.875C20 6.04076 19.9342 6.19973 19.8169 6.31694C19.6997 6.43415 19.5408 6.5 19.375 6.5C19.2092 6.5 19.0503 6.43415 18.9331 6.31694C18.8158 6.19973 18.75 6.04076 18.75 5.875V3.125ZM16.875 18.75C17.3723 18.75 17.8492 18.5525 18.2008 18.2008C18.5525 17.8492 18.75 17.3723 18.75 16.875V14.125C18.75 13.9592 18.8158 13.8003 18.9331 13.6831C19.0503 13.5658 19.2092 13.5 19.375 13.5C19.5408 13.5 19.6997 13.5658 19.8169 13.6831C19.9342 13.8003 20 13.9592 20 14.125V16.875C20 17.7038 19.6708 18.4987 19.0847 19.0847C18.4987 19.6708 17.7038 20 16.875 20H14.125C13.9592 20 13.8003 19.9342 13.6831 19.8169C13.5658 19.6997 13.5 19.5408 13.5 19.375C13.5 19.2092 13.5658 19.0503 13.6831 18.9331C13.8003 18.8158 13.9592 18.75 14.125 18.75H16.875ZM9.6035 4.398C9.72217 4.23317 9.87897 4.09952 10.0605 4.00844C10.242 3.91737 10.4429 3.87158 10.646 3.875C11.3245 3.875 11.816 4.2875 12.1055 4.7985C12.389 5.298 12.5185 5.94 12.5185 6.6055C12.5185 7.0015 12.445 7.434 12.3335 7.875H13C13.085 7.875 13.2035 7.8825 13.309 7.892C13.406 7.901 13.546 7.917 13.654 7.944C14.7265 8.216 15.335 9.26 15.0625 10.322L14.2775 13.382C13.87 14.9685 12.255 15.927 10.6625 15.539L6.546 14.5365C6.22196 14.4581 5.92717 14.2885 5.69659 14.0477C5.466 13.807 5.30928 13.5051 5.245 13.178L4.903 11.424C4.83586 11.0786 4.89298 10.7206 5.06426 10.4133C5.23554 10.106 5.50995 9.86908 5.839 9.7445L6.4665 9.506C6.92753 9.33105 7.3204 9.01301 7.5875 8.5985L9.018 6.3745C9.03193 6.34618 9.04298 6.31653 9.051 6.286C9.07 6.2205 9.0885 6.136 9.1085 6.028C9.119 5.968 9.1315 5.895 9.1445 5.8145C9.1725 5.644 9.2055 5.441 9.2445 5.268C9.3035 5.0045 9.4005 4.672 9.6035 4.398ZM10.3385 6.252C10.2975 6.4745 10.232 6.7985 10.0695 7.051L8.639 9.275C8.22734 9.91416 7.62174 10.4046 6.911 10.6745L6.2835 10.913C6.22986 10.9327 6.18494 10.9708 6.15674 11.0205C6.12855 11.0702 6.11889 11.1283 6.1295 11.1845L6.472 12.9385C6.49047 13.0311 6.53509 13.1164 6.60058 13.1844C6.66607 13.2523 6.74968 13.3001 6.8415 13.322L10.9585 14.3245C11.8925 14.552 12.831 13.9885 13.0665 13.071L13.8515 10.011C13.954 9.6135 13.7425 9.256 13.3465 9.156C13.2957 9.14807 13.2447 9.14173 13.1935 9.137C13.1292 9.13058 13.0646 9.12657 13 9.125H11.5C11.4014 9.12501 11.3042 9.10168 11.2163 9.05691C11.1284 9.01215 11.0524 8.94722 10.9944 8.86744C10.9364 8.78766 10.8981 8.69529 10.8827 8.59789C10.8672 8.50048 10.875 8.4008 10.9055 8.307C11.1335 7.6065 11.2685 7.034 11.2685 6.6055C11.2685 6.082 11.1635 5.6715 11.0185 5.4155C10.8795 5.1705 10.747 5.125 10.646 5.125H10.635C10.6265 5.125 10.6225 5.125 10.62 5.1265C10.618 5.1275 10.6165 5.1295 10.614 5.1335L10.608 5.142C10.566 5.199 10.514 5.3185 10.464 5.541C10.4325 5.683 10.4115 5.8135 10.388 5.9575C10.373 6.048 10.3585 6.144 10.3385 6.252Z"
                                                                    fill="#0BA1E5" />
                                                            </svg>
                                                        </span>
                                                    @endif
                                                </span>
                                                @if ($review->helpful_count > 0)
                                                    <span style="background: #0BA1E5;"
                                                        class="helpful-count inline-block  text-white px-2 py-1 rounded-full text-xs absolute top-0 right-0 transform translate-x-1/2 -translate-y-1/2">
                                                        {{ $review->helpful_count }}
                                                    </span>
                                                @endif
                                            </button>



                                            @if ($review->helpful_count > 0)
                                                <div id="tooltip-helpful-users-{{ $review->id }}" role="tooltip"
                                                    class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                                                    @foreach ($review->users as $index => $user)
                                                        {{ $user->name }}
                                                        @if (!$loop->last)
                                                            <span class="separator">,</span>
                                                        @endif
                                                    @endforeach
                                                    <div class="tooltip-arrow" data-popper-arrow></div>
                                                </div>
                                                <div class="relative">

                                                    <div id="tooltip-helpful-users-{{ $review->id }}"
                                                        role="tooltip"
                                                        class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
                                                        @foreach ($review->users as $index => $user)
                                                            {{ $user->name }}
                                                            @if (!$loop->last)
                                                                <span class="separator">,</span>
                                                                <!-- Add a comma separator if this is not the last user -->
                                                            @endif
                                                        @endforeach
                                                        <div class="tooltip-arrow" data-popper-arrow></div>
                                                    </div>
                                                </div>
                                            @endif

                                            @if ($businessAccount->user_id == Auth::id())
                                                <button title="reply" wire:click="replyReview({{ $review->id }})"
                                                    class="relative h-10 max-h-[40px] w-10 max-w-[40px] select-none rounded-lg bg-white text-center align-middle font-sans text-xs font-medium uppercase text-white shadow-md shadow-gray-900/10 transition-all hover:shadow-lg hover:shadow-gray-900/20 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                                                    type="button" data-ripple-dark="true">
                                                    <span
                                                        class="absolute transform -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2">
                                                        <svg width="60" height="40" data-name="Layer 2"
                                                            id="Layer_2" viewBox="0 0 1000 1000"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <defs>
                                                                <style>
                                                                    .cls-1 {
                                                                        fill: none;
                                                                        stroke: #0BA1E5;
                                                                        stroke-linecap: round;
                                                                        stroke-miterlimit: 10;
                                                                        stroke-width: 32px;
                                                                    }
                                                                </style>
                                                            </defs>
                                                            <path class="cls-1"
                                                                d="M760.22,534.94c-24-95.71-131-157.47-252-141.83a.81.81,0,0,1-.91-.79v-67a.8.8,0,0,0-1.29-.63l-182,153a.81.81,0,0,0,0,1.27l182,153a.8.8,0,0,0,1.29-.64v-83a.82.82,0,0,1,.47-.73c55.74-26.47,115.28-30,160.54-4.06s66.16,75.16,62.2,130.94a.93.93,0,0,0,1.64.69C766.28,635.29,772.86,585.27,760.22,534.94Z" />
                                                            <path class="cls-1"
                                                                d="M416.09,324.7l-182,153a.8.8,0,0,0,0,1.27l182,153" />
                                                        </svg>
                                                    </span>
                                                </button>
                                            @endif
                                        </div>
                                    </div>
                                    <span class="line-clamp-5 mt-2.5 text-sm">
                                        {!! $review->review !!}
                                    </span>
                                    @if ($review->attachments)
                                        <div class="mt-4" style="display: flex; flex-wrap: wrap;">
                                            @foreach ($review->attachments as $attachment)
                                                <a href="{{ asset('storage/' . $attachment->file_path) }}"
                                                    data-fancybox="group"
                                                    data-caption="Image {{ $loop->index + 1 }}">
                                                    <img src="{{ asset('storage/' . $attachment->file_path) }}"
                                                        style="max-width: 100px; max-height: 100px; margin-right: 10px; margin-bottom: 10px;"
                                                        class="object-cover rounded-[6px]" alt="">
                                                </a>
                                            @endforeach
                                        </div>
                                    @endif




                                    <div class="flex justify-end items-center gap-2 mt-1">
                                        @if ($review->is_edited)
                                            <span class="ju text-gray-500 ml-1 mr-2">(edited)</span>
                                        @endif


                                        {{-- Edit reply button --}}
                                        @if ($review->user_id == Auth::id())
                                            @if (now()->diffInDays($review->created_at) <= $edit_review_par_day)
                                                <button wire:click="EditReview({{ $review->id }})"
                                                    class="text-[#6fc0e6] relative h-10 max-h-[40px] w-10 max-w-[40px] select-none rounded-lg bg-white text-center align-middle font-sans text-xs font-medium uppercase shadow-md shadow-gray-900/10 transition-all hover:shadow-lg hover:shadow-gray-900/20 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                                                    type="button" data-ripple-dark="true">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                            @endif
                                        @endif
                                        {{-- Edit reply button --}}
                                    </div>
                                </div>
                            </div>
                        </div>

                        @foreach ($review->replies as $reply)
                            <div wire:key="reply-key-{{ $reply->id }}"
                                class="rounded-xl bg-[#FAFAFF] py-10 px-7 relative ml-5">
                                <div class="bg-primary w-2 rounded-full h-full absolute top-0 left-0 bottom-0">
                                </div>
                                <div class="md:flex justify-between items-center gap-4">
                                    <div class="flex justify-start items-start gap-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="14"
                                            viewBox="0 0 24 14" fill="none">
                                            <path
                                                d="M11.9825 12.5846C11.9516 12.5982 11.9177 12.6038 11.884 12.601C11.8503 12.5981 11.8179 12.5868 11.7897 12.5681C11.7616 12.5494 11.7385 12.5239 11.7228 12.494C11.707 12.4641 11.699 12.4307 11.6996 12.3969V10.7819C11.6996 10.5962 11.6258 10.4181 11.4944 10.2867C11.3631 10.1554 11.185 10.0816 10.9992 10.0816C10.065 10.0816 8.17967 10.0746 6.377 8.93024C4.99874 8.05622 3.58967 6.46506 2.74226 3.50124C4.17095 4.8781 5.80273 5.62466 7.23141 6.02105C8.10947 6.26405 9.012 6.40782 9.9221 6.44965C10.2946 6.46718 10.6678 6.46343 11.0398 6.43845H11.058L11.0651 6.43705H11.0665L10.9992 5.73951L11.0693 6.43705C11.2421 6.41967 11.4024 6.33866 11.5188 6.20976C11.6353 6.08085 11.6997 5.91325 11.6996 5.73951V4.12454C11.6996 3.97326 11.8536 3.87802 11.9825 3.93685L17.5628 8.04502L17.6216 8.08424C17.6521 8.10254 17.6773 8.12841 17.6948 8.15934C17.7122 8.19026 17.7214 8.22519 17.7214 8.26072C17.7214 8.29625 17.7122 8.33118 17.6948 8.36211C17.6773 8.39303 17.6521 8.4189 17.6216 8.43721L17.5628 8.47642L11.9825 12.5846ZM10.2989 5.05878C10.2036 5.05878 10.0995 5.05598 9.98654 5.05038C9.37864 5.02237 8.53824 4.92992 7.60539 4.6708C5.7481 4.15535 3.54905 2.98719 2.08674 0.356728C2.00767 0.214737 1.88167 0.104671 1.73034 0.0453911C1.57901 -0.0138884 1.41177 -0.0186892 1.25729 0.0318117C1.1028 0.0823116 0.970699 0.184969 0.883606 0.322189C0.796513 0.45941 0.759853 0.62265 0.779917 0.783934C1.42983 5.98043 3.42159 8.71454 5.62624 10.1124C7.37008 11.2189 9.16574 11.4318 10.2989 11.4725V12.3969C10.2988 12.6853 10.3765 12.9685 10.5239 13.2164C10.6713 13.4644 10.8828 13.6679 11.1363 13.8056C11.3898 13.9433 11.6757 14.0101 11.9639 13.9988C12.2521 13.9875 12.532 13.8986 12.7739 13.7416L18.3682 9.62357C18.5994 9.47921 18.7902 9.27836 18.9224 9.03994C19.0546 8.80151 19.124 8.53336 19.124 8.26072C19.124 7.98808 19.0546 7.71993 18.9224 7.48151C18.7902 7.24308 18.5994 7.04223 18.3682 6.89787L12.7739 2.77989C12.532 2.62281 12.2521 2.53394 11.9639 2.52267C11.6757 2.51139 11.3898 2.57812 11.1363 2.71582C10.8828 2.85352 10.6713 3.05708 10.5239 3.30502C10.3765 3.55296 10.2988 3.83609 10.2989 4.12454V5.05878Z"
                                                fill="black" />
                                            <path
                                                d="M15.9969 13.5931C16.0514 13.6673 16.1201 13.7301 16.1989 13.7777C16.2778 13.8254 16.3652 13.857 16.4563 13.8708C16.5474 13.8846 16.6403 13.8802 16.7297 13.8581C16.8191 13.8359 16.9033 13.7963 16.9774 13.7416L22.5688 9.62361C22.8001 9.47924 22.9909 9.27839 23.1231 9.03997C23.2553 8.80155 23.3247 8.53339 23.3247 8.26076C23.3247 7.98812 23.2553 7.71996 23.1231 7.48154C22.9909 7.24312 22.8001 7.04227 22.5688 6.8979L16.9746 2.77993C16.9007 2.72341 16.8162 2.68217 16.7262 2.65864C16.6362 2.63511 16.5424 2.62974 16.4503 2.64286C16.3582 2.65598 16.2697 2.68731 16.1898 2.73504C16.1099 2.78277 16.0404 2.84593 15.9852 2.92083C15.93 2.99573 15.8903 3.08088 15.8684 3.1713C15.8465 3.26172 15.8429 3.35559 15.8576 3.44745C15.8724 3.5393 15.9053 3.62729 15.9545 3.70627C16.0037 3.78525 16.0681 3.85365 16.144 3.90747L21.7649 8.04505L21.8237 8.08427C21.8541 8.10257 21.8793 8.12845 21.8968 8.15937C21.9143 8.1903 21.9235 8.22522 21.9235 8.26076C21.9235 8.29629 21.9143 8.33122 21.8968 8.36214C21.8793 8.39307 21.8541 8.41894 21.8237 8.43724L21.7649 8.47646L16.1454 12.614C15.9959 12.7242 15.8962 12.8892 15.8684 13.0728C15.8406 13.2564 15.8868 13.4436 15.9969 13.5931Z"
                                                fill="black" />
                                        </svg>
                                        <p class="font-light">
                                            Reply from {{ $businessAccount->businessName }} <br />
                                            <span class="text-sm opacity-45">
                                                {{ $reply->created_at?->diffForHumans() }}
                                            </span>
                                        </p>
                                    </div>

                                    <div class="flex justify-end mt-5 md:mt-0 md:justify-start items-center gap-3">
                                        <!-- Flex container for buttons -->
                                        @if ($businessAccount->user_id == Auth::id() && $reply->user_id == Auth::id())
                                            <button wire:click="EditReviewReply({{ $reply->id }})"
                                                class="relative h-10 max-h-[40px] w-10 max-w-[40px] select-none rounded-lg bg-white text-center align-middle font-sans text-xs font-medium uppercase text-white shadow-md shadow-gray-900/10 transition-all hover:shadow-lg hover:shadow-gray-900/20 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none">
                                                <i class="fas fa-edit text-blue-500"></i>
                                            </button>
                                            <button wire:click="DeleteReviewReply({{ $reply->id }})"
                                                class="relative h-10 max-h-[40px] w-10 max-w-[40px] select-none rounded-lg bg-white text-center align-middle font-sans text-xs font-medium uppercase text-white shadow-md shadow-gray-900/10 transition-all hover:shadow-lg hover:shadow-gray-900/20 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none">
                                                <i class="fas fa-trash text-red-500"></i>
                                            </button>
                                        @endif
                                    </div>
                                </div>
                                <p class="mt-5 text-sm">
                                    {!! $reply->message !!}
                                </p>

                            </div>
                        @endforeach

                    @empty
                    @endforelse

                    <div class="">
                        @if ($totalReviews > 5)
                            <div class="w-max ml-auto flex items-center gap-2 border-b border-black">
                                @if ($showMoreBtn)
                                    <p wire:click="loadMoreReviews({{ $totalReviews }})"
                                        class="cursor-pointer text-sm sm:text-base">
                                        Read more reviews...
                                        <i class="fa-regular fa-chevron-down"></i>
                                    </p>
                                @else
                                    <p wire:click="showLess()" class="cursor-pointer text-sm sm:text-base">
                                        Show less...
                                        <i class="fa-regular fa-chevron-up"></i>
                                    </p>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>
                <div class="lg:col-span-4 rounded-xl bg-[#FAFAFF] py-10 px-7">
                    <div class="">
                        <div class="flex justify-between items-center">
                            <h1 class="text-lg">Categories</h1>
                            <a href="{{ route('categories.show.all') }}" class="text-primary">See all</a>
                        </div>
                        <div class="mt-8 space-y-3">
                            <ul class="mt-9 space-y-2">
                                @forelse ($randomCategories as $category)
                                    <div class="hs-accordion-group" id="accordion-nested-parent"
                                        data-accordion="collapse">
                                        <div class="hs-accordion hs-accordion-active:border-gray-200 bg-white border border-transparent rounded-xl dark:hs-accordion-active:border-gray-700 dark:bg-gray-800 dark:border-transparent"
                                            id="accordion-collapse-heading-{{ $category->id }}">

                                            <button
                                                data-accordion-target="#accordion-collapse-body-{{ $category->id }}"
                                                aria-expanded="false"
                                                aria-controls="accordion-collapse-body-{{ $category->id }}"
                                                class="hs-accordion-toggle hs-accordion-active:text-blue-600 gap-x-3 w-full font-semibold text-start text-gray-800 py-4 px-5 hover:text-gray-500 disabled:opacity-50 inline-flex justify-between items-center disabled:pointer-events-none dark:hs-accordion-active:text-blue-500 dark:text-gray-200 dark:hover:text-gray-400 dark:focus:outline-none dark:focus:text-gray-400"
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
                                                        <div
                                                            class="border-b-2 mb-2 hover:bg-gray-100/5 mt-1 text-gray-400">
                                                            <a
                                                                href="{{ route('categories.business', str_replace(' ', '-', $childCategory->title)) }}">{{ $childCategory->title }}</a>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <p>No Category Found</p>
                                @endforelse

                            </ul>
                        </div>
                    </div>
                    <div class="mt-5 pt-5">
                        <div class="flex justify-between items-center">
                            <h1 class="text-lg">Related Business</h1>
                        </div>
                        <div class="mt-8 space-y-3">
                            <ul class="mt-9 space-y-2">
                                @forelse ($relatedBusiness as $relatedBusines)
                                    <div class="hs-accordion-group" id="accordion-nested-parent"
                                        data-accordion="collapse">
                                        <div
                                            class="hs-accordion hs-accordion-active:border-gray-200 bg-white border border-transparent rounded-xl dark:hs-accordion-active:border-gray-700 dark:bg-gray-800 dark:border-transparent">

                                            <a href="{{ route('front.business.show', ['business_name' => $relatedBusines->businessName]) }}"
                                                class="hs-accordion-toggle hs-accordion-active:text-blue-600 gap-x-3 w-full font-semibold text-start text-gray-800 py-4 px-5 hover:text-gray-500 disabled:opacity-50 inline-flex justify-between items-center disabled:pointer-events-none dark:hs-accordion-active:text-blue-500 dark:text-gray-200 dark:hover:text-gray-400 dark:focus:outline-none dark:focus:text-gray-400"
                                                aria-controls="hs-basic-active-bordered-collapse-one">
                                                {{ $relatedBusines->businessName }}
                                            </a>

                                        </div>
                                    </div>
                                @empty
                                    <p>No Related Business Found</p>
                                @endforelse

                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>


    </script>


    {{-- Modals --}}
    @if ($addReviewModel)
        <x-modals.modal wire:model.live="addReviewModel" maxWidth="5xl">
            @slot('headerTitle')
                Review
            @endslot

            @slot('content')
                <form class="my-5 space-y-6" wire:submit.prevent="StoreOrUpdate">
                    <div class="flex justify-center">
                        <div id="half-stars-example">
                            <div class="rating-group">
                                <input class="rating__input rating__input--none" checked wire:model="rating"
                                    id="rating-0" value="0" type="radio">
                                <label aria-label="0 stars" class="rating__label" for="rating-0">&nbsp;</label>
                                <label aria-label="0.5 stars" class="rating__label rating__label--half"
                                    for="rating-05"><i
                                        class="rating__icon rating__icon--star fa fa-star-half"></i></label>
                                <input class="rating__input" wire:model="rating" id="rating-05" value="0.5"
                                    type="radio">
                                <label aria-label="1 star" class="rating__label" for="rating-10"><i
                                        class="rating__icon rating__icon--star fa fa-star"></i></label>
                                <input class="rating__input" wire:model="rating" id="rating-10" value="1"
                                    type="radio">
                                <label aria-label="1.5 stars" class="rating__label rating__label--half"
                                    for="rating-15"><i
                                        class="rating__icon rating__icon--star fa fa-star-half"></i></label>
                                <input class="rating__input" wire:model="rating" id="rating-15" value="1.5"
                                    type="radio">
                                <label aria-label="2 stars" class="rating__label" for="rating-20"><i
                                        class="rating__icon rating__icon--star fa fa-star"></i></label>
                                <input class="rating__input" wire:model="rating" id="rating-20" value="2"
                                    type="radio">
                                <label aria-label="2.5 stars" class="rating__label rating__label--half"
                                    for="rating-25"><i
                                        class="rating__icon rating__icon--star fa fa-star-half"></i></label>
                                <input class="rating__input" wire:model="rating" id="rating-25" value="2.5"
                                    type="radio">
                                <label aria-label="3 stars" class="rating__label" for="rating-30"><i
                                        class="rating__icon rating__icon--star fa fa-star"></i></label>
                                <input class="rating__input" wire:model="rating" id="rating-30" value="3"
                                    type="radio">
                                <label aria-label="3.5 stars" class="rating__label rating__label--half"
                                    for="rating-35"><i
                                        class="rating__icon rating__icon--star fa fa-star-half"></i></label>
                                <input class="rating__input" wire:model="rating" id="rating-35" value="3.5"
                                    type="radio">
                                <label aria-label="4 stars" class="rating__label" for="rating-40"><i
                                        class="rating__icon rating__icon--star fa fa-star"></i></label>
                                <input class="rating__input" wire:model="rating" id="rating-40" value="4"
                                    type="radio">
                                <label aria-label="4.5 stars" class="rating__label rating__label--half"
                                    for="rating-45"><i
                                        class="rating__icon rating__icon--star fa fa-star-half"></i></label>
                                <input class="rating__input" wire:model="rating" id="rating-45" value="4.5"
                                    type="radio">
                                <label aria-label="5 stars" class="rating__label" for="rating-50"><i
                                        class="rating__icon rating__icon--star fa fa-star"></i></label>
                                <input class="rating__input" wire:model="rating" id="rating-50" value="5"
                                    type="radio">
                            </div>
                        </div>

                    </div>
                    <div class="text-center"> <x-input-error for="rating" /></div>

                    <div class="my-10 flex justify-center items-center gap-4">
                        <div class="w-full">
                            <label for="interaction" class="text-black text-sm font-semibold">
                                Your interaction with this business 10 words
                            </label>
                            <div class="relative">
                                <input wire:model="interactionDetail" id="interaction" type="text"
                                    class="peer w-full rounded-md border border-black bg-transparent px-3 py-2.5 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border  placeholder-shown:border-t-blaborder-black  focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50 focus:border-[#0BA1E5] mt-2 h-[46px]">
                                <x-input-error for="interactionDetail" />
                            </div>
                        </div>
                        <div class="w-full">
                            <label for="interaction-date" class="text-black text-sm font-semibold">
                                Interaction date
                            </label>
                            <div class="relative">
                                <input wire:model="interactionDate" id="interaction-date" type="date"
                                    class="peer w-full rounded-md border border-black bg-transparent px-3 py-2.5 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border  placeholder-shown:border-t-blaborder-black  focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50 focus:border-[#0BA1E5] mt-2 h-[46px]">
                                <x-input-error for="interactionDate" />
                            </div>
                        </div>
                    </div>
                    <!-- Review Text -->
                    <div class="mb-4" wire:ignore>
                        <label for="review" class="block text-sm font-semibold text-black">Review</label>
                        <textarea wire:model.live="review" id="review" maxlength="1000" class="mt-1 p-3 w-full border rounded-md"></textarea>
                        <small>The minimum length is 50 characters, and the maximum length is 1000 characters.</small>

                    </div>
                    <x-input-error for="spam_error" />
                    <x-input-error for="review" />

                    <div class="mb-4">
                        <label for="reviewImages" class="block text-sm font-medium text-gray-600">Attach
                            Images (Max: 5)</label>

                        <x-form.upload-files multiple wire:model.live="reviewImages" :fileData="$oldReviewImages ?? null" perview
                            allowFileTypes="['image/png', 'image/jpg', 'image/jpeg', 'image/webp']" />
                        <x-input-error for="reviewImages" />
                    </div>
                    <!-- Submit Button -->
                    <div class="text-end">
                        <button type="submit"
                            class="bg-white border-2 border-primary text-center px-5 py-2 rounded-xl hover:bg-primary hover:text-white">
                            Submit
                        </button>
                    </div>
                </form>
            @endslot
        </x-modals.modal>
    @endif

    @if ($replyReviewModel)
        <x-modals.modal wire:model.live="replyReviewModel" maxWidth="5xl">
            @slot('headerTitle')
                Reply
            @endslot

            @slot('content')
                <form class="my-5 space-y-6" wire:submit.prevent="StoreOrUpdateReply">
                    <!-- Review Text -->
                    <div class="mb-4" wire:ignore>
                        <label for="message" class="block text-sm font-medium text-gray-600">Message</label>
                        <textarea wire:model.live="message" id="message" maxlength="1000" class="mt-1 p-3 w-full border rounded-md"></textarea>
                    </div>
                    <x-input-error for="spam_error" />
                    <x-input-error for="message" />

                    <!-- Submit Button -->
                    <button type="submit"
                        class="bg-white border-2 border-primary text-center px-5 py-2 rounded-xl hover:bg-primary hover:text-white">
                        Submit
                    </button>
                </form>
            @endslot
        </x-modals.modal>
    @endif

    @if ($claimBusinessModal)
        <x-modals.modal maxWidth="2xl" wire:model.live="claimBusinessModal">
            @slot('title')
                Are you sure?
            @endslot

            @slot('content')
                <p class="">You want to claim your business account!</p>
                <textarea wire:model.live="claimDetails" maxlength="200"
                    class="w-full h-32 px-5 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring focus:border-blue-500 mt-3"
                    placeholder="Enter details"></textarea>
                <small>Min:5, Max:200</small>
                <x-input-error for="claimDetails" />
            @endslot

            @slot('footer')
                <button class="w-32 py-3 px-5 bg-green-500 border border-green-500 rounded text-white"
                    style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);"
                    wire:click="sendClaimRequest({{ $businessAccount->id }})">
                    Yes
                </button>
                <button class="w-32 py-3 px-5 bg-gray-300 border border-gray-300 rounded text-gray-600 ml-3"
                    style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);" wire:click="$set('claimBusinessModal', false)">
                    Cancel
                </button>
            @endslot
        </x-modals.modal>
    @endif

    <x-modals.delete-alert message="You are going to delete this Reply" />

    @if ($disputeModal)
        <x-modals.modal wire:model.live="disputeModal" maxWidth="3xl">
            @slot('headerTitle')
                Dispute Modal
            @endslot

            @slot('content')
                <form class="my-5 space-y-6" wire:submit.prevent="createDispute">
                    <div class="mb-4">
                        <label for="description" class="block text-gray-600 text-sm font-medium mb-2">Description:</label>
                        <textarea wire:model="description" id="description" name="description" rows="4" class="w-full border p-2"></textarea>
                        <x-input-error for="description" />
                    </div>

                    <div class="mb-4">
                        <label for="media" class="block text-gray-600 text-sm font-medium mb-2">Attachments:</label>
                        <x-form.upload-files wire:model.live="attachments" multiple
                            allowFileTypes="['image/png', 'image/jpg', 'image/jpeg', 'application/pdf', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'video/mp4']" />
                        <x-input-error for="attachments" />
                    </div>

                    <!-- Submit Button -->
                    <button type="submit"
                        class="bg-white border-2 border-primary text-center px-5 py-2 rounded-xl hover:bg-primary hover:text-white">
                        Submit
                    </button>
                </form>
            @endslot
        </x-modals.modal>
    @endif

    @if ($showSuccessModal)
        <x-modals.modal wire:model.live="showSuccessModal" maxWidth="2xl">
            <!-- Modal header -->
            <x-slot name="headerTitle">
            </x-slot>
            <!-- Modal content -->
            <x-slot name="content">
                <div class="rw-full h-full">
                    <!-- Modal content -->
                    <div class="text-center">

                        <div
                            class="w-12 h-12 rounded-full bg-green-100 dark:bg-green-900 p-2 flex items-center justify-center mx-auto mb-3.5">
                            <svg aria-hidden="true" class="w-8 h-8 text-green-500 dark:text-green-400"
                                fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <span class="sr-only">Success</span>
                        </div>
                        <p class="mb-4 text-lg font-semibold text-gray-900 dark:text-white"> Action performed
                            successfully.
                            .</p>

                    </div>
                </div>
            </x-slot>
        </x-modals.modal>
    @endif

    @if ($showErrorModal)
        <x-modals.modal wire:model.live="showErrorModal" maxWidth="2xl">
            <!-- Modal header -->
            <x-slot name="headerTitle">
                <!-- Header title goes here -->
            </x-slot>
            <!-- Modal content -->
            <x-slot name="content">
                <div class="w-full h-full">
                    <!-- Modal content -->
                    <div class="text-center">
                        <div
                            class="w-12 h-12 rounded-full bg-red-100 dark:bg-red-900 p-2 flex items-center justify-center mx-auto mb-3.5">
                            <svg aria-hidden="true" class="w-8 h-8 text-red-500 dark:text-red-400"
                                fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M5.293 5.293a1 1 0 011.414 0L10 8.586l3.293-3.293a1 1 0 111.414 1.414L11.414 10l3.293 3.293a1 1 0 01-1.414 1.414L10 11.414l-3.293 3.293a1 1 0 01-1.414-1.414L8.586 10 5.293 6.707a1 1 0 010-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <span class="sr-only">Error</span>
                        </div>
                        <p class="mb-4 text-lg font-semibold text-gray-900 dark:text-white">You need to log in first.
                        </p>
                    </div>
                </div>
            </x-slot>
        </x-modals.modal>
    @endif
    
    {{-- Modals --}}
</div>

<script>
    let editorOptions = {
        height: '250px',
        tabSpaces: 4,
        removePlugins: 'forms,smiley,iframe,link,div,save'
    };

    window.addEventListener('initReviewEditor', event => {
        function findReviewId() {
            const reviewId = document.getElementById('review');
            if (reviewId) {
                clearInterval(reviewIdInterval);
                const editorC = CKEDITOR.replace('review', editorOptions);
                editorC.on('change', function(event) {
                    @this.set('review', event.editor.getData());
                });

                window.addEventListener('updateCkEditorBody', event => {
                    let changedVal = @this.get('review');

                    editorC.setData(changedVal);
                });


                const updateEvent = new Event('updateCkEditorBody');
                window.dispatchEvent(updateEvent);
            }

        }

        const reviewIdInterval = setInterval(findReviewId, 200);
    });


    window.addEventListener('initReplyEditor', event => {
        function findReplyMessageId() {
            const replyMessageId = document.getElementById('message');

            if (replyMessageId) {
                clearInterval(replyMessageIdInterval);
                const editorM = CKEDITOR.replace('message', editorOptions);
                editorM.on('change', function(event) {
                    @this.set('message', event.editor.getData());
                });

                window.addEventListener('updateCkEditorBodyMessage', event => {
                    let changedVal = @this.get('message');

                    editorM.setData(changedVal);
                });

                const updateEvent = new Event('updateCkEditorBodyMessage');
                window.dispatchEvent(updateEvent);
            }
        }

        const replyMessageIdInterval = setInterval(findReplyMessageId, 200);
    });

    // hide create business button event
    window.addEventListener('hideCreateBusinessButton', event => {
        let CreateBusinessBtn = document.getElementById('front-user-create-business');
        CreateBusinessBtn.style.display = 'none';
    })
</script>
</div>

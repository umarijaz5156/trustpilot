<div>

    <section class="pt-36 relative flex justify-center items-center">
        <div class="container xl:max-w-screen-2xl mx-auto px-4 relative">
            <div class="grid">
                <div class="flex justify-center items-center ">
                    <div class="mt-10 lg:mt-0 text-center">
                        <h1 class="text-black text-2xl xl:text-4xl leading-tight  mt-16 font-bold">

                            On the lookout for a specific business or individual? Begin your search now!
                        </h1>
                        <div class="bg-white w-20 h-1.5 rounded-full"></div>
                        <div x-data="{showList: false}" @click.away="showList = false" class="mt-4 relative">
                            <input wire:model.live="search" type="text" x-on:click="showList = true" id="first_name" autocomplete="off"
                                class="bg-transparent border border-black text-black rounded-lg focus:ring-black focus:border-black block w-full p-2.5 placeholder:text-black"
                                placeholder="Search" required />
                            <div class="absolute right-1 top-1/2 -translate-y-1/2">
                                <button
                                    class="align-middle select-none font-medium text-center transition-all disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none w-12 h-9 rounded-md bg-black text-white shadow-md shadow-black/10 hover:shadow-lg hover:shadow-black/20 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none flex justify-center items-center"
                                    type="button" data-ripple-dark="true">
                                    <i class="fa-regular fa-magnifying-glass"></i>
                                </button>
                            </div>
                            <div style="width: 100%" x-show="showList"
                                class="custom-scrollbar max-h-48 overflow-y-auto  absolute top-full mt-1 bg-[#E3E3E9] rounded-md shadow-lg z-10">
                                @if (!empty($searchCategories))
                                    <ul class="divide-y divide-gray-700">
                                        @foreach ($searchCategories as $searchCategorie)
                                            <li class="py-2 px-4 text-start">
                                                <a class="text-black hover:underline"
                                                    href="{{ route('categories.business', str_replace(' ', '-', $searchCategorie->title)) }}">{{ $searchCategorie->title }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="mt-36">
        <div class="container xl:max-w-screen-2xl mx-auto px-4 relative">
            <h1 class="text-black text-2xl xl:text-4xl leading-tight mb-6 font-bold">
                Business Categories
            </h1>
            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-5">
                @foreach ($categories as $category)
                    <div wire:key="category-{{ $category->id }}"
                        class="border border-[#0BA1E5] rounded-[12px] overflow-hidden shadow-md">
                        <div class="bg-[#158FC6] p-4 flex items-center justify-center">
                            <img style="border-radius:10px" src="{{ asset('storage/' . $category->icon_path) }}"
                                class="w-full h-auto max-h-40 object-cover" alt="{{ $category->title }} logo">
                        </div>
                        <div class="p-4">
                            <a href="{{ route('categories.business', str_replace(' ', '-', $category->title)) }}"
                                class="text-lg font-semibold text-[#158FC6] hover:text-[#0BA1E5] transition-colors">
                                {{ Str::limit($category->title, 20) }}
                            </a>
                            <p class="text-sm text-gray-700 mt-1">{{ Str::limit($category->description, 60) }}</p>
                        </div>
                        <ul class="px-4 pb-4 overflow-y-auto custom-scroll">
                            @if ($category->childCategories->count() > 0)
                                <p class="bg-[#158FC6] text-white px-1 mb-2"> Sub Categories </p>
                            @endif
                            @foreach ($category->childCategories as $childCategory)
                                <li wire:key="subcategory-{{ $childCategory->id }}">
                                    <a href="{{ route('categories.business', str_replace(' ', '-', $childCategory->title)) }}"
                                        class="block text-sm text-[#158FC6] hover:text-[#0BA1E5] transition-colors">
                                        <i class="far fa-arrow-right mr-1"></i>
                                        -> {{ Str::limit($childCategory->title, 20) }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endforeach

            </div>
        </div>
    </section>

    {{-- <section class="mt-36">
    <div class="container xl:max-w-screen-2xl mx-auto px-4 relative">
        <h1 class="text-black text-2xl xl:text-4xl leading-tight  mb-6 font-bold">
            Business Categories
        </h1>
        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-5">
            @foreach ($categories as $category)
            <div wire:key="category-{{ $category->id }}" class="border border-[#0BA1E5] rounded-[12px] overflow-hidden shadow-md">
                <div class="bg-[#158FC6] p-4 flex items-center justify-center">
                    <img src="{{ asset('storage/' . $category->icon_path) }}" class="w-150 h-150 max-w-150" style="max-height: 150px;" alt="{{ $category->title }} logo">
                </div>
                <div class="p-4">
                    <a href="{{ route('categories.business', ['category' => $category->title]) }}" class="text-lg font-semibold text-[#158FC6] hover:text-[#0BA1E5] transition-colors">
                        {{ Str::limit($category->title, 20) }}
                    </a>
                    <p class="text-sm text-gray-700 mt-1">{{ Str::limit($category->description, 60) }}</p>
                </div>
                <ul class="px-4 pb-4 overflow-y-auto custom-scroll">
                    @if ($category->childCategories->count() > 0)
                    <p class="bg-[#158FC6] text-white px-1 mb-2"> Sub Categories </p>
                    @endif
                    @foreach ($category->childCategories as $childCategory)
                    <li wire:key="subcategory-{{ $childCategory->id }}">
                        <a href="{{ route('categories.business', ['category' => $childCategory->title]) }}" class="block text-sm text-[#158FC6] hover:text-[#0BA1E5] transition-colors">
                            <i class="far fa-arrow-right mr-1"></i>
                            -> {{ Str::limit($childCategory->title, 20) }}
                        </a>
                    </li>                                
                    @endforeach
                </ul>
            </div>
            @endforeach
            
        </div>
    </div>
</section> --}}



    {{-- <section class="mt-36 py-24 bg-[#FAFAFF]">
    <div class="container xl:max-w-screen-2xl mx-auto px-4 relative">
        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-5">
            <div class="border border-[#0BA1E5] rounded-[12px] pb-5">
                <div class="flex justify-center items-center gap-2 bg-[#158FC6] pt-12 pb-5 px-4 rounded-[10px]">
                    <svg class="text-white" xmlns="http://www.w3.org/2000/svg" width="32" height="38"
                    viewBox="0 0 32 38" fill="none">
                    <path
                    d="M8.22342 15.6297C6.77936 13.8546 5.42427 13.473 4.15643 14.4859C2.25469 16.0053 1.70888 21.3025 3.2385 25.9726C4.76896 30.6427 7.74435 37.0024 13.7516 37.0024C19.758 37.0024 21.1789 30.6033 23.6291 26.7348C26.08 22.8663 27.3761 19.1338 24.9747 14.4859"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round"></path>
                    <path
                    d="M5.19501 13.9341C4.06406 12.2062 2.92339 10.4846 1.77305 8.76954C0.536018 6.93452 3.69876 4.56225 5.19501 6.1757C6.1925 7.25191 7.51766 8.83627 9.17046 10.9297"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round"></path>
                    <path
                    d="M8.6375 20.4384C8.22259 15.2507 8.56051 11.8733 9.64869 10.3052C11.2827 7.95258 14.3171 7.06116 17.1753 7.06116C18.876 7.06116 20.4304 7.78576 21.836 9.23495"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round"></path>
                    <path
                    d="M30.8596 9.29394C31.361 11.0357 30.5431 12.6278 28.0228 12.9879C25.5034 13.3481 23.6145 14.6151 22.2526 15.681C20.8898 16.747 18.4542 19.9807 17.9726 21.6036C17.4918 23.2273 14.7423 21.7344 14.004 21.086C13.2657 20.4384 12.5394 19.0191 14.004 17.5349C15.4686 16.0506 15.1512 15.7546 15.1512 14.2498C15.1512 12.7441 23.1602 7.76519 27.6712 7.31007C28.6739 7.25189 30.3592 7.55132 30.8596 9.29394Z"
                    stroke="currentColor" stroke-width="2"></path>
                    <path
                    d="M15.4677 1.92566V6.42809M13.157 7.67282C10.5752 4.42796 8.49377 2.61689 6.91197 2.24047M10.3314 4.51693L11.1783 1.03766M26.2511 7.67282C25.9757 8.61728 25.9757 9.50357 26.2511 10.33C26.5266 11.1572 27.1177 12.0427 28.0228 12.988"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round"></path>
                </svg>
                <h1 class="text-white">Heart Specialist</h1>
            </div>
            <ul class="pt-6 w-full px-5 xl:px-11 space-y-3 max-h-[292px] overflow-y-auto custom-scroll">
                <li>
                    <a href="" class="font-light pl-7 relative">
                        <i class="fa-regular fa-arrow-right-long absolute top-1/2 -translate-y-1/2 left-0"></i>
                        Heart Specialist
                    </a>
                </li>
                <li>
                    <a href="" class="font-light pl-7 relative">
                        <i class="fa-regular fa-arrow-right-long absolute top-1/2 -translate-y-1/2 left-0"></i>
                        Heart Specialist
                    </a>
                </li>
                <li>
                    <a href="" class="font-light pl-7 relative">
                        <i class="fa-regular fa-arrow-right-long absolute top-1/2 -translate-y-1/2 left-0"></i>
                        Heart Specialist
                    </a>
                </li>
                <li>
                    <a href="" class="font-light pl-7 relative">
                        <i class="fa-regular fa-arrow-right-long absolute top-1/2 -translate-y-1/2 left-0"></i>
                        Heart Specialist
                    </a>
                </li>
                <li>
                    <a href="" class="font-light pl-7 relative">
                        <i class="fa-regular fa-arrow-right-long absolute top-1/2 -translate-y-1/2 left-0"></i>
                        Heart Specialist
                    </a>
                </li>
                <li>
                    <a href="" class="font-light pl-7 relative">
                        <i class="fa-regular fa-arrow-right-long absolute top-1/2 -translate-y-1/2 left-0"></i>
                        Heart Specialist
                    </a>
                </li>
                <li>
                    <a href="" class="font-light pl-7 relative">
                        <i class="fa-regular fa-arrow-right-long absolute top-1/2 -translate-y-1/2 left-0"></i>
                        Heart Specialist
                    </a>
                </li>
                <li>
                    <a href="" class="font-light pl-7 relative">
                        <i class="fa-regular fa-arrow-right-long absolute top-1/2 -translate-y-1/2 left-0"></i>
                        Heart Specialist
                    </a>
                </li>
                <li>
                    <a href="" class="font-light pl-7 relative">
                        <i class="fa-regular fa-arrow-right-long absolute top-1/2 -translate-y-1/2 left-0"></i>
                        Heart Specialist
                    </a>
                </li>
            </ul>
        </div>
        <div class="border border-[#0BA1E5] rounded-[12px] pb-5">
            <div class="flex justify-center items-center gap-2 bg-[#158FC6] pt-12 pb-5 px-4 rounded-[10px]">
                <svg class="text-white" xmlns="http://www.w3.org/2000/svg" width="32" height="38"
                viewBox="0 0 32 38" fill="none">
                <path
                d="M8.22342 15.6297C6.77936 13.8546 5.42427 13.473 4.15643 14.4859C2.25469 16.0053 1.70888 21.3025 3.2385 25.9726C4.76896 30.6427 7.74435 37.0024 13.7516 37.0024C19.758 37.0024 21.1789 30.6033 23.6291 26.7348C26.08 22.8663 27.3761 19.1338 24.9747 14.4859"
                stroke="currentColor" stroke-width="2" stroke-linecap="round"
                stroke-linejoin="round"></path>
                <path
                d="M5.19501 13.9341C4.06406 12.2062 2.92339 10.4846 1.77305 8.76954C0.536018 6.93452 3.69876 4.56225 5.19501 6.1757C6.1925 7.25191 7.51766 8.83627 9.17046 10.9297"
                stroke="currentColor" stroke-width="2" stroke-linecap="round"></path>
                <path
                d="M8.6375 20.4384C8.22259 15.2507 8.56051 11.8733 9.64869 10.3052C11.2827 7.95258 14.3171 7.06116 17.1753 7.06116C18.876 7.06116 20.4304 7.78576 21.836 9.23495"
                stroke="currentColor" stroke-width="2" stroke-linecap="round"
                stroke-linejoin="round"></path>
                <path
                d="M30.8596 9.29394C31.361 11.0357 30.5431 12.6278 28.0228 12.9879C25.5034 13.3481 23.6145 14.6151 22.2526 15.681C20.8898 16.747 18.4542 19.9807 17.9726 21.6036C17.4918 23.2273 14.7423 21.7344 14.004 21.086C13.2657 20.4384 12.5394 19.0191 14.004 17.5349C15.4686 16.0506 15.1512 15.7546 15.1512 14.2498C15.1512 12.7441 23.1602 7.76519 27.6712 7.31007C28.6739 7.25189 30.3592 7.55132 30.8596 9.29394Z"
                stroke="currentColor" stroke-width="2"></path>
                <path
                d="M15.4677 1.92566V6.42809M13.157 7.67282C10.5752 4.42796 8.49377 2.61689 6.91197 2.24047M10.3314 4.51693L11.1783 1.03766M26.2511 7.67282C25.9757 8.61728 25.9757 9.50357 26.2511 10.33C26.5266 11.1572 27.1177 12.0427 28.0228 12.988"
                stroke="currentColor" stroke-width="2" stroke-linecap="round"></path>
            </svg>
            <h1 class="text-white">Heart Specialist</h1>
        </div>
        <ul class="pt-6 w-full px-5 xl:px-11 space-y-3 max-h-[292px] overflow-y-auto custom-scroll">
            <li>
                <a href="" class="font-light pl-7 relative">
                    <i class="fa-regular fa-arrow-right-long absolute top-1/2 -translate-y-1/2 left-0"></i>
                    Heart Specialist
                </a>
            </li>
            <li>
                <a href="" class="font-light pl-7 relative">
                    <i class="fa-regular fa-arrow-right-long absolute top-1/2 -translate-y-1/2 left-0"></i>
                    Heart Specialist
                </a>
            </li>
            <li>
                <a href="" class="font-light pl-7 relative">
                    <i class="fa-regular fa-arrow-right-long absolute top-1/2 -translate-y-1/2 left-0"></i>
                    Heart Specialist
                </a>
            </li>
            <li>
                <a href="" class="font-light pl-7 relative">
                    <i class="fa-regular fa-arrow-right-long absolute top-1/2 -translate-y-1/2 left-0"></i>
                    Heart Specialist
                </a>
            </li>
            <li>
                <a href="" class="font-light pl-7 relative">
                    <i class="fa-regular fa-arrow-right-long absolute top-1/2 -translate-y-1/2 left-0"></i>
                    Heart Specialist
                </a>
            </li>
            <li>
                <a href="" class="font-light pl-7 relative">
                    <i class="fa-regular fa-arrow-right-long absolute top-1/2 -translate-y-1/2 left-0"></i>
                    Heart Specialist
                </a>
            </li>
            <li>
                <a href="" class="font-light pl-7 relative">
                    <i class="fa-regular fa-arrow-right-long absolute top-1/2 -translate-y-1/2 left-0"></i>
                    Heart Specialist
                </a>
            </li>
            <li>
                <a href="" class="font-light pl-7 relative">
                    <i class="fa-regular fa-arrow-right-long absolute top-1/2 -translate-y-1/2 left-0"></i>
                    Heart Specialist
                </a>
            </li>
            <li>
                <a href="" class="font-light pl-7 relative">
                    <i class="fa-regular fa-arrow-right-long absolute top-1/2 -translate-y-1/2 left-0"></i>
                    Heart Specialist
                </a>
            </li>
        </ul>
    </div>
    <div class="border border-[#0BA1E5] rounded-[12px] pb-5">
        <div class="flex justify-center items-center gap-2 bg-[#158FC6] pt-12 pb-5 px-4 rounded-[10px]">
            <svg class="text-white" xmlns="http://www.w3.org/2000/svg" width="32" height="38"
            viewBox="0 0 32 38" fill="none">
            <path
            d="M8.22342 15.6297C6.77936 13.8546 5.42427 13.473 4.15643 14.4859C2.25469 16.0053 1.70888 21.3025 3.2385 25.9726C4.76896 30.6427 7.74435 37.0024 13.7516 37.0024C19.758 37.0024 21.1789 30.6033 23.6291 26.7348C26.08 22.8663 27.3761 19.1338 24.9747 14.4859"
            stroke="currentColor" stroke-width="2" stroke-linecap="round"
            stroke-linejoin="round"></path>
            <path
            d="M5.19501 13.9341C4.06406 12.2062 2.92339 10.4846 1.77305 8.76954C0.536018 6.93452 3.69876 4.56225 5.19501 6.1757C6.1925 7.25191 7.51766 8.83627 9.17046 10.9297"
            stroke="currentColor" stroke-width="2" stroke-linecap="round"></path>
            <path
            d="M8.6375 20.4384C8.22259 15.2507 8.56051 11.8733 9.64869 10.3052C11.2827 7.95258 14.3171 7.06116 17.1753 7.06116C18.876 7.06116 20.4304 7.78576 21.836 9.23495"
            stroke="currentColor" stroke-width="2" stroke-linecap="round"
            stroke-linejoin="round"></path>
            <path
            d="M30.8596 9.29394C31.361 11.0357 30.5431 12.6278 28.0228 12.9879C25.5034 13.3481 23.6145 14.6151 22.2526 15.681C20.8898 16.747 18.4542 19.9807 17.9726 21.6036C17.4918 23.2273 14.7423 21.7344 14.004 21.086C13.2657 20.4384 12.5394 19.0191 14.004 17.5349C15.4686 16.0506 15.1512 15.7546 15.1512 14.2498C15.1512 12.7441 23.1602 7.76519 27.6712 7.31007C28.6739 7.25189 30.3592 7.55132 30.8596 9.29394Z"
            stroke="currentColor" stroke-width="2"></path>
            <path
            d="M15.4677 1.92566V6.42809M13.157 7.67282C10.5752 4.42796 8.49377 2.61689 6.91197 2.24047M10.3314 4.51693L11.1783 1.03766M26.2511 7.67282C25.9757 8.61728 25.9757 9.50357 26.2511 10.33C26.5266 11.1572 27.1177 12.0427 28.0228 12.988"
            stroke="currentColor" stroke-width="2" stroke-linecap="round"></path>
        </svg>
        <h1 class="text-white">Heart Specialist</h1>
    </div>
    <ul class="pt-6 w-full px-5 xl:px-11 space-y-3 max-h-[292px] overflow-y-auto custom-scroll">
        <li>
            <a href="" class="font-light pl-7 relative">
                <i class="fa-regular fa-arrow-right-long absolute top-1/2 -translate-y-1/2 left-0"></i>
                Heart Specialist
            </a>
        </li>
        <li>
            <a href="" class="font-light pl-7 relative">
                <i class="fa-regular fa-arrow-right-long absolute top-1/2 -translate-y-1/2 left-0"></i>
                Heart Specialist
            </a>
        </li>
        <li>
            <a href="" class="font-light pl-7 relative">
                <i class="fa-regular fa-arrow-right-long absolute top-1/2 -translate-y-1/2 left-0"></i>
                Heart Specialist
            </a>
        </li>
        <li>
            <a href="" class="font-light pl-7 relative">
                <i class="fa-regular fa-arrow-right-long absolute top-1/2 -translate-y-1/2 left-0"></i>
                Heart Specialist
            </a>
        </li>
        <li>
            <a href="" class="font-light pl-7 relative">
                <i class="fa-regular fa-arrow-right-long absolute top-1/2 -translate-y-1/2 left-0"></i>
                Heart Specialist
            </a>
        </li>
        <li>
            <a href="" class="font-light pl-7 relative">
                <i class="fa-regular fa-arrow-right-long absolute top-1/2 -translate-y-1/2 left-0"></i>
                Heart Specialist
            </a>
        </li>
        <li>
            <a href="" class="font-light pl-7 relative">
                <i class="fa-regular fa-arrow-right-long absolute top-1/2 -translate-y-1/2 left-0"></i>
                Heart Specialist
            </a>
        </li>
        <li>
            <a href="" class="font-light pl-7 relative">
                <i class="fa-regular fa-arrow-right-long absolute top-1/2 -translate-y-1/2 left-0"></i>
                Heart Specialist
            </a>
        </li>
        <li>
            <a href="" class="font-light pl-7 relative">
                <i class="fa-regular fa-arrow-right-long absolute top-1/2 -translate-y-1/2 left-0"></i>
                Heart Specialist
            </a>
        </li>
    </ul>
</div>
<div class="border border-[#0BA1E5] rounded-[12px] pb-5">
    <div class="flex justify-center items-center gap-2 bg-[#158FC6] pt-12 pb-5 px-4 rounded-[10px]">
        <svg class="text-white" xmlns="http://www.w3.org/2000/svg" width="32" height="38"
        viewBox="0 0 32 38" fill="none">
        <path
        d="M8.22342 15.6297C6.77936 13.8546 5.42427 13.473 4.15643 14.4859C2.25469 16.0053 1.70888 21.3025 3.2385 25.9726C4.76896 30.6427 7.74435 37.0024 13.7516 37.0024C19.758 37.0024 21.1789 30.6033 23.6291 26.7348C26.08 22.8663 27.3761 19.1338 24.9747 14.4859"
        stroke="currentColor" stroke-width="2" stroke-linecap="round"
        stroke-linejoin="round"></path>
        <path
        d="M5.19501 13.9341C4.06406 12.2062 2.92339 10.4846 1.77305 8.76954C0.536018 6.93452 3.69876 4.56225 5.19501 6.1757C6.1925 7.25191 7.51766 8.83627 9.17046 10.9297"
        stroke="currentColor" stroke-width="2" stroke-linecap="round"></path>
        <path
        d="M8.6375 20.4384C8.22259 15.2507 8.56051 11.8733 9.64869 10.3052C11.2827 7.95258 14.3171 7.06116 17.1753 7.06116C18.876 7.06116 20.4304 7.78576 21.836 9.23495"
        stroke="currentColor" stroke-width="2" stroke-linecap="round"
        stroke-linejoin="round"></path>
        <path
        d="M30.8596 9.29394C31.361 11.0357 30.5431 12.6278 28.0228 12.9879C25.5034 13.3481 23.6145 14.6151 22.2526 15.681C20.8898 16.747 18.4542 19.9807 17.9726 21.6036C17.4918 23.2273 14.7423 21.7344 14.004 21.086C13.2657 20.4384 12.5394 19.0191 14.004 17.5349C15.4686 16.0506 15.1512 15.7546 15.1512 14.2498C15.1512 12.7441 23.1602 7.76519 27.6712 7.31007C28.6739 7.25189 30.3592 7.55132 30.8596 9.29394Z"
        stroke="currentColor" stroke-width="2"></path>
        <path
        d="M15.4677 1.92566V6.42809M13.157 7.67282C10.5752 4.42796 8.49377 2.61689 6.91197 2.24047M10.3314 4.51693L11.1783 1.03766M26.2511 7.67282C25.9757 8.61728 25.9757 9.50357 26.2511 10.33C26.5266 11.1572 27.1177 12.0427 28.0228 12.988"
        stroke="currentColor" stroke-width="2" stroke-linecap="round"></path>
    </svg>
    <h1 class="text-white">Heart Specialist</h1>
</div>
<ul class="pt-6 w-full px-5 xl:px-11 space-y-3 max-h-[292px] overflow-y-auto custom-scroll">
    <li>
        <a href="" class="font-light pl-7 relative">
            <i class="fa-regular fa-arrow-right-long absolute top-1/2 -translate-y-1/2 left-0"></i>
            Heart Specialist
        </a>
    </li>
    <li>
        <a href="" class="font-light pl-7 relative">
            <i class="fa-regular fa-arrow-right-long absolute top-1/2 -translate-y-1/2 left-0"></i>
            Heart Specialist
        </a>
    </li>
    <li>
        <a href="" class="font-light pl-7 relative">
            <i class="fa-regular fa-arrow-right-long absolute top-1/2 -translate-y-1/2 left-0"></i>
            Heart Specialist
        </a>
    </li>
    <li>
        <a href="" class="font-light pl-7 relative">
            <i class="fa-regular fa-arrow-right-long absolute top-1/2 -translate-y-1/2 left-0"></i>
            Heart Specialist
        </a>
    </li>
    <li>
        <a href="" class="font-light pl-7 relative">
            <i class="fa-regular fa-arrow-right-long absolute top-1/2 -translate-y-1/2 left-0"></i>
            Heart Specialist
        </a>
    </li>
    <li>
        <a href="" class="font-light pl-7 relative">
            <i class="fa-regular fa-arrow-right-long absolute top-1/2 -translate-y-1/2 left-0"></i>
            Heart Specialist
        </a>
    </li>
    <li>
        <a href="" class="font-light pl-7 relative">
            <i class="fa-regular fa-arrow-right-long absolute top-1/2 -translate-y-1/2 left-0"></i>
            Heart Specialist
        </a>
    </li>
    <li>
        <a href="" class="font-light pl-7 relative">
            <i class="fa-regular fa-arrow-right-long absolute top-1/2 -translate-y-1/2 left-0"></i>
            Heart Specialist
        </a>
    </li>
    <li>
        <a href="" class="font-light pl-7 relative">
            <i class="fa-regular fa-arrow-right-long absolute top-1/2 -translate-y-1/2 left-0"></i>
            Heart Specialist
        </a>
    </li>
</ul>
</div>
</div>
</div>
</section>

<section class="mt-36">
    <div class="container xl:max-w-screen-2xl mx-auto px-4 relative">
        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-5">
            <div class="border border-[#0BA1E5] rounded-[12px] pb-5">
                <div class="flex justify-center items-center gap-2 bg-[#158FC6] pt-12 pb-5 px-4 rounded-[10px]">
                    <svg class="text-white" xmlns="http://www.w3.org/2000/svg" width="32" height="38"
                    viewBox="0 0 32 38" fill="none">
                    <path
                    d="M8.22342 15.6297C6.77936 13.8546 5.42427 13.473 4.15643 14.4859C2.25469 16.0053 1.70888 21.3025 3.2385 25.9726C4.76896 30.6427 7.74435 37.0024 13.7516 37.0024C19.758 37.0024 21.1789 30.6033 23.6291 26.7348C26.08 22.8663 27.3761 19.1338 24.9747 14.4859"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round"></path>
                    <path
                    d="M5.19501 13.9341C4.06406 12.2062 2.92339 10.4846 1.77305 8.76954C0.536018 6.93452 3.69876 4.56225 5.19501 6.1757C6.1925 7.25191 7.51766 8.83627 9.17046 10.9297"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round"></path>
                    <path
                    d="M8.6375 20.4384C8.22259 15.2507 8.56051 11.8733 9.64869 10.3052C11.2827 7.95258 14.3171 7.06116 17.1753 7.06116C18.876 7.06116 20.4304 7.78576 21.836 9.23495"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round"></path>
                    <path
                    d="M30.8596 9.29394C31.361 11.0357 30.5431 12.6278 28.0228 12.9879C25.5034 13.3481 23.6145 14.6151 22.2526 15.681C20.8898 16.747 18.4542 19.9807 17.9726 21.6036C17.4918 23.2273 14.7423 21.7344 14.004 21.086C13.2657 20.4384 12.5394 19.0191 14.004 17.5349C15.4686 16.0506 15.1512 15.7546 15.1512 14.2498C15.1512 12.7441 23.1602 7.76519 27.6712 7.31007C28.6739 7.25189 30.3592 7.55132 30.8596 9.29394Z"
                    stroke="currentColor" stroke-width="2"></path>
                    <path
                    d="M15.4677 1.92566V6.42809M13.157 7.67282C10.5752 4.42796 8.49377 2.61689 6.91197 2.24047M10.3314 4.51693L11.1783 1.03766M26.2511 7.67282C25.9757 8.61728 25.9757 9.50357 26.2511 10.33C26.5266 11.1572 27.1177 12.0427 28.0228 12.988"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round"></path>
                </svg>
                <h1 class="text-white">Heart Specialist</h1>
            </div>
            <ul class="pt-6 w-full px-5 xl:px-11 space-y-3 max-h-[292px] overflow-y-auto custom-scroll">
                <li>
                    <a href="" class="font-light pl-7 relative">
                        <i class="fa-regular fa-arrow-right-long absolute top-1/2 -translate-y-1/2 left-0"></i>
                        Heart Specialist
                    </a>
                </li>
                <li>
                    <a href="" class="font-light pl-7 relative">
                        <i class="fa-regular fa-arrow-right-long absolute top-1/2 -translate-y-1/2 left-0"></i>
                        Heart Specialist
                    </a>
                </li>
                <li>
                    <a href="" class="font-light pl-7 relative">
                        <i class="fa-regular fa-arrow-right-long absolute top-1/2 -translate-y-1/2 left-0"></i>
                        Heart Specialist
                    </a>
                </li>
                <li>
                    <a href="" class="font-light pl-7 relative">
                        <i class="fa-regular fa-arrow-right-long absolute top-1/2 -translate-y-1/2 left-0"></i>
                        Heart Specialist
                    </a>
                </li>
                <li>
                    <a href="" class="font-light pl-7 relative">
                        <i class="fa-regular fa-arrow-right-long absolute top-1/2 -translate-y-1/2 left-0"></i>
                        Heart Specialist
                    </a>
                </li>
                <li>
                    <a href="" class="font-light pl-7 relative">
                        <i class="fa-regular fa-arrow-right-long absolute top-1/2 -translate-y-1/2 left-0"></i>
                        Heart Specialist
                    </a>
                </li>
                <li>
                    <a href="" class="font-light pl-7 relative">
                        <i class="fa-regular fa-arrow-right-long absolute top-1/2 -translate-y-1/2 left-0"></i>
                        Heart Specialist
                    </a>
                </li>
                <li>
                    <a href="" class="font-light pl-7 relative">
                        <i class="fa-regular fa-arrow-right-long absolute top-1/2 -translate-y-1/2 left-0"></i>
                        Heart Specialist
                    </a>
                </li>
                <li>
                    <a href="" class="font-light pl-7 relative">
                        <i class="fa-regular fa-arrow-right-long absolute top-1/2 -translate-y-1/2 left-0"></i>
                        Heart Specialist
                    </a>
                </li>
            </ul>
        </div>
        <div class="border border-[#0BA1E5] rounded-[12px] pb-5">
            <div class="flex justify-center items-center gap-2 bg-[#158FC6] pt-12 pb-5 px-4 rounded-[10px]">
                <svg class="text-white" xmlns="http://www.w3.org/2000/svg" width="32" height="38"
                viewBox="0 0 32 38" fill="none">
                <path
                d="M8.22342 15.6297C6.77936 13.8546 5.42427 13.473 4.15643 14.4859C2.25469 16.0053 1.70888 21.3025 3.2385 25.9726C4.76896 30.6427 7.74435 37.0024 13.7516 37.0024C19.758 37.0024 21.1789 30.6033 23.6291 26.7348C26.08 22.8663 27.3761 19.1338 24.9747 14.4859"
                stroke="currentColor" stroke-width="2" stroke-linecap="round"
                stroke-linejoin="round"></path>
                <path
                d="M5.19501 13.9341C4.06406 12.2062 2.92339 10.4846 1.77305 8.76954C0.536018 6.93452 3.69876 4.56225 5.19501 6.1757C6.1925 7.25191 7.51766 8.83627 9.17046 10.9297"
                stroke="currentColor" stroke-width="2" stroke-linecap="round"></path>
                <path
                d="M8.6375 20.4384C8.22259 15.2507 8.56051 11.8733 9.64869 10.3052C11.2827 7.95258 14.3171 7.06116 17.1753 7.06116C18.876 7.06116 20.4304 7.78576 21.836 9.23495"
                stroke="currentColor" stroke-width="2" stroke-linecap="round"
                stroke-linejoin="round"></path>
                <path
                d="M30.8596 9.29394C31.361 11.0357 30.5431 12.6278 28.0228 12.9879C25.5034 13.3481 23.6145 14.6151 22.2526 15.681C20.8898 16.747 18.4542 19.9807 17.9726 21.6036C17.4918 23.2273 14.7423 21.7344 14.004 21.086C13.2657 20.4384 12.5394 19.0191 14.004 17.5349C15.4686 16.0506 15.1512 15.7546 15.1512 14.2498C15.1512 12.7441 23.1602 7.76519 27.6712 7.31007C28.6739 7.25189 30.3592 7.55132 30.8596 9.29394Z"
                stroke="currentColor" stroke-width="2"></path>
                <path
                d="M15.4677 1.92566V6.42809M13.157 7.67282C10.5752 4.42796 8.49377 2.61689 6.91197 2.24047M10.3314 4.51693L11.1783 1.03766M26.2511 7.67282C25.9757 8.61728 25.9757 9.50357 26.2511 10.33C26.5266 11.1572 27.1177 12.0427 28.0228 12.988"
                stroke="currentColor" stroke-width="2" stroke-linecap="round"></path>
            </svg>
            <h1 class="text-white">Heart Specialist</h1>
        </div>
        <ul class="pt-6 w-full px-5 xl:px-11 space-y-3 max-h-[292px] overflow-y-auto custom-scroll">
            <li>
                <a href="" class="font-light pl-7 relative">
                    <i class="fa-regular fa-arrow-right-long absolute top-1/2 -translate-y-1/2 left-0"></i>
                    Heart Specialist
                </a>
            </li>
            <li>
                <a href="" class="font-light pl-7 relative">
                    <i class="fa-regular fa-arrow-right-long absolute top-1/2 -translate-y-1/2 left-0"></i>
                    Heart Specialist
                </a>
            </li>
            <li>
                <a href="" class="font-light pl-7 relative">
                    <i class="fa-regular fa-arrow-right-long absolute top-1/2 -translate-y-1/2 left-0"></i>
                    Heart Specialist
                </a>
            </li>
            <li>
                <a href="" class="font-light pl-7 relative">
                    <i class="fa-regular fa-arrow-right-long absolute top-1/2 -translate-y-1/2 left-0"></i>
                    Heart Specialist
                </a>
            </li>
            <li>
                <a href="" class="font-light pl-7 relative">
                    <i class="fa-regular fa-arrow-right-long absolute top-1/2 -translate-y-1/2 left-0"></i>
                    Heart Specialist
                </a>
            </li>
            <li>
                <a href="" class="font-light pl-7 relative">
                    <i class="fa-regular fa-arrow-right-long absolute top-1/2 -translate-y-1/2 left-0"></i>
                    Heart Specialist
                </a>
            </li>
            <li>
                <a href="" class="font-light pl-7 relative">
                    <i class="fa-regular fa-arrow-right-long absolute top-1/2 -translate-y-1/2 left-0"></i>
                    Heart Specialist
                </a>
            </li>
            <li>
                <a href="" class="font-light pl-7 relative">
                    <i class="fa-regular fa-arrow-right-long absolute top-1/2 -translate-y-1/2 left-0"></i>
                    Heart Specialist
                </a>
            </li>
            <li>
                <a href="" class="font-light pl-7 relative">
                    <i class="fa-regular fa-arrow-right-long absolute top-1/2 -translate-y-1/2 left-0"></i>
                    Heart Specialist
                </a>
            </li>
        </ul>
    </div>
    <div class="border border-[#0BA1E5] rounded-[12px] pb-5">
        <div class="flex justify-center items-center gap-2 bg-[#158FC6] pt-12 pb-5 px-4 rounded-[10px]">
            <svg class="text-white" xmlns="http://www.w3.org/2000/svg" width="32" height="38"
            viewBox="0 0 32 38" fill="none">
            <path
            d="M8.22342 15.6297C6.77936 13.8546 5.42427 13.473 4.15643 14.4859C2.25469 16.0053 1.70888 21.3025 3.2385 25.9726C4.76896 30.6427 7.74435 37.0024 13.7516 37.0024C19.758 37.0024 21.1789 30.6033 23.6291 26.7348C26.08 22.8663 27.3761 19.1338 24.9747 14.4859"
            stroke="currentColor" stroke-width="2" stroke-linecap="round"
            stroke-linejoin="round"></path>
            <path
            d="M5.19501 13.9341C4.06406 12.2062 2.92339 10.4846 1.77305 8.76954C0.536018 6.93452 3.69876 4.56225 5.19501 6.1757C6.1925 7.25191 7.51766 8.83627 9.17046 10.9297"
            stroke="currentColor" stroke-width="2" stroke-linecap="round"></path>
            <path
            d="M8.6375 20.4384C8.22259 15.2507 8.56051 11.8733 9.64869 10.3052C11.2827 7.95258 14.3171 7.06116 17.1753 7.06116C18.876 7.06116 20.4304 7.78576 21.836 9.23495"
            stroke="currentColor" stroke-width="2" stroke-linecap="round"
            stroke-linejoin="round"></path>
            <path
            d="M30.8596 9.29394C31.361 11.0357 30.5431 12.6278 28.0228 12.9879C25.5034 13.3481 23.6145 14.6151 22.2526 15.681C20.8898 16.747 18.4542 19.9807 17.9726 21.6036C17.4918 23.2273 14.7423 21.7344 14.004 21.086C13.2657 20.4384 12.5394 19.0191 14.004 17.5349C15.4686 16.0506 15.1512 15.7546 15.1512 14.2498C15.1512 12.7441 23.1602 7.76519 27.6712 7.31007C28.6739 7.25189 30.3592 7.55132 30.8596 9.29394Z"
            stroke="currentColor" stroke-width="2"></path>
            <path
            d="M15.4677 1.92566V6.42809M13.157 7.67282C10.5752 4.42796 8.49377 2.61689 6.91197 2.24047M10.3314 4.51693L11.1783 1.03766M26.2511 7.67282C25.9757 8.61728 25.9757 9.50357 26.2511 10.33C26.5266 11.1572 27.1177 12.0427 28.0228 12.988"
            stroke="currentColor" stroke-width="2" stroke-linecap="round"></path>
        </svg>
        <h1 class="text-white">Heart Specialist</h1>
    </div>
    <ul class="pt-6 w-full px-5 xl:px-11 space-y-3 max-h-[292px] overflow-y-auto custom-scroll">
        <li>
            <a href="" class="font-light pl-7 relative">
                <i class="fa-regular fa-arrow-right-long absolute top-1/2 -translate-y-1/2 left-0"></i>
                Heart Specialist
            </a>
        </li>
        <li>
            <a href="" class="font-light pl-7 relative">
                <i class="fa-regular fa-arrow-right-long absolute top-1/2 -translate-y-1/2 left-0"></i>
                Heart Specialist
            </a>
        </li>
        <li>
            <a href="" class="font-light pl-7 relative">
                <i class="fa-regular fa-arrow-right-long absolute top-1/2 -translate-y-1/2 left-0"></i>
                Heart Specialist
            </a>
        </li>
        <li>
            <a href="" class="font-light pl-7 relative">
                <i class="fa-regular fa-arrow-right-long absolute top-1/2 -translate-y-1/2 left-0"></i>
                Heart Specialist
            </a>
        </li>
        <li>
            <a href="" class="font-light pl-7 relative">
                <i class="fa-regular fa-arrow-right-long absolute top-1/2 -translate-y-1/2 left-0"></i>
                Heart Specialist
            </a>
        </li>
        <li>
            <a href="" class="font-light pl-7 relative">
                <i class="fa-regular fa-arrow-right-long absolute top-1/2 -translate-y-1/2 left-0"></i>
                Heart Specialist
            </a>
        </li>
        <li>
            <a href="" class="font-light pl-7 relative">
                <i class="fa-regular fa-arrow-right-long absolute top-1/2 -translate-y-1/2 left-0"></i>
                Heart Specialist
            </a>
        </li>
        <li>
            <a href="" class="font-light pl-7 relative">
                <i class="fa-regular fa-arrow-right-long absolute top-1/2 -translate-y-1/2 left-0"></i>
                Heart Specialist
            </a>
        </li>
        <li>
            <a href="" class="font-light pl-7 relative">
                <i class="fa-regular fa-arrow-right-long absolute top-1/2 -translate-y-1/2 left-0"></i>
                Heart Specialist
            </a>
        </li>
    </ul>
</div>
<div class="border border-[#0BA1E5] rounded-[12px] pb-5">
    <div class="flex justify-center items-center gap-2 bg-[#158FC6] pt-12 pb-5 px-4 rounded-[10px]">
        <svg class="text-white" xmlns="http://www.w3.org/2000/svg" width="32" height="38"
        viewBox="0 0 32 38" fill="none">
        <path
        d="M8.22342 15.6297C6.77936 13.8546 5.42427 13.473 4.15643 14.4859C2.25469 16.0053 1.70888 21.3025 3.2385 25.9726C4.76896 30.6427 7.74435 37.0024 13.7516 37.0024C19.758 37.0024 21.1789 30.6033 23.6291 26.7348C26.08 22.8663 27.3761 19.1338 24.9747 14.4859"
        stroke="currentColor" stroke-width="2" stroke-linecap="round"
        stroke-linejoin="round"></path>
        <path
        d="M5.19501 13.9341C4.06406 12.2062 2.92339 10.4846 1.77305 8.76954C0.536018 6.93452 3.69876 4.56225 5.19501 6.1757C6.1925 7.25191 7.51766 8.83627 9.17046 10.9297"
        stroke="currentColor" stroke-width="2" stroke-linecap="round"></path>
        <path
        d="M8.6375 20.4384C8.22259 15.2507 8.56051 11.8733 9.64869 10.3052C11.2827 7.95258 14.3171 7.06116 17.1753 7.06116C18.876 7.06116 20.4304 7.78576 21.836 9.23495"
        stroke="currentColor" stroke-width="2" stroke-linecap="round"
        stroke-linejoin="round"></path>
        <path
        d="M30.8596 9.29394C31.361 11.0357 30.5431 12.6278 28.0228 12.9879C25.5034 13.3481 23.6145 14.6151 22.2526 15.681C20.8898 16.747 18.4542 19.9807 17.9726 21.6036C17.4918 23.2273 14.7423 21.7344 14.004 21.086C13.2657 20.4384 12.5394 19.0191 14.004 17.5349C15.4686 16.0506 15.1512 15.7546 15.1512 14.2498C15.1512 12.7441 23.1602 7.76519 27.6712 7.31007C28.6739 7.25189 30.3592 7.55132 30.8596 9.29394Z"
        stroke="currentColor" stroke-width="2"></path>
        <path
        d="M15.4677 1.92566V6.42809M13.157 7.67282C10.5752 4.42796 8.49377 2.61689 6.91197 2.24047M10.3314 4.51693L11.1783 1.03766M26.2511 7.67282C25.9757 8.61728 25.9757 9.50357 26.2511 10.33C26.5266 11.1572 27.1177 12.0427 28.0228 12.988"
        stroke="currentColor" stroke-width="2" stroke-linecap="round"></path>
    </svg>
    <h1 class="text-white">Heart Specialist</h1>
</div>
<ul class="pt-6 w-full px-5 xl:px-11 space-y-3 max-h-[292px] overflow-y-auto custom-scroll">
    <li>
        <a href="" class="font-light pl-7 relative">
            <i class="fa-regular fa-arrow-right-long absolute top-1/2 -translate-y-1/2 left-0"></i>
            Heart Specialist
        </a>
    </li>
    <li>
        <a href="" class="font-light pl-7 relative">
            <i class="fa-regular fa-arrow-right-long absolute top-1/2 -translate-y-1/2 left-0"></i>
            Heart Specialist
        </a>
    </li>
    <li>
        <a href="" class="font-light pl-7 relative">
            <i class="fa-regular fa-arrow-right-long absolute top-1/2 -translate-y-1/2 left-0"></i>
            Heart Specialist
        </a>
    </li>
    <li>
        <a href="" class="font-light pl-7 relative">
            <i class="fa-regular fa-arrow-right-long absolute top-1/2 -translate-y-1/2 left-0"></i>
            Heart Specialist
        </a>
    </li>
    <li>
        <a href="" class="font-light pl-7 relative">
            <i class="fa-regular fa-arrow-right-long absolute top-1/2 -translate-y-1/2 left-0"></i>
            Heart Specialist
        </a>
    </li>
    <li>
        <a href="" class="font-light pl-7 relative">
            <i class="fa-regular fa-arrow-right-long absolute top-1/2 -translate-y-1/2 left-0"></i>
            Heart Specialist
        </a>
    </li>
    <li>
        <a href="" class="font-light pl-7 relative">
            <i class="fa-regular fa-arrow-right-long absolute top-1/2 -translate-y-1/2 left-0"></i>
            Heart Specialist
        </a>
    </li>
    <li>
        <a href="" class="font-light pl-7 relative">
            <i class="fa-regular fa-arrow-right-long absolute top-1/2 -translate-y-1/2 left-0"></i>
            Heart Specialist
        </a>
    </li>
    <li>
        <a href="" class="font-light pl-7 relative">
            <i class="fa-regular fa-arrow-right-long absolute top-1/2 -translate-y-1/2 left-0"></i>
            Heart Specialist
        </a>
    </li>
</ul>
</div>
</div>
</div>
</section>

<section class="mt-36 py-24 bg-[#FAFAFF]">
    <div class="container xl:max-w-screen-2xl mx-auto px-4 relative">
        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-5">
            <div class="border border-[#0BA1E5] rounded-[12px] pb-5">
                <div class="flex justify-center items-center gap-2 bg-[#158FC6] pt-12 pb-5 px-4 rounded-[10px]">
                    <svg class="text-white" xmlns="http://www.w3.org/2000/svg" width="32" height="38"
                    viewBox="0 0 32 38" fill="none">
                    <path
                    d="M8.22342 15.6297C6.77936 13.8546 5.42427 13.473 4.15643 14.4859C2.25469 16.0053 1.70888 21.3025 3.2385 25.9726C4.76896 30.6427 7.74435 37.0024 13.7516 37.0024C19.758 37.0024 21.1789 30.6033 23.6291 26.7348C26.08 22.8663 27.3761 19.1338 24.9747 14.4859"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round"></path>
                    <path
                    d="M5.19501 13.9341C4.06406 12.2062 2.92339 10.4846 1.77305 8.76954C0.536018 6.93452 3.69876 4.56225 5.19501 6.1757C6.1925 7.25191 7.51766 8.83627 9.17046 10.9297"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round"></path>
                    <path
                    d="M8.6375 20.4384C8.22259 15.2507 8.56051 11.8733 9.64869 10.3052C11.2827 7.95258 14.3171 7.06116 17.1753 7.06116C18.876 7.06116 20.4304 7.78576 21.836 9.23495"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round"></path>
                    <path
                    d="M30.8596 9.29394C31.361 11.0357 30.5431 12.6278 28.0228 12.9879C25.5034 13.3481 23.6145 14.6151 22.2526 15.681C20.8898 16.747 18.4542 19.9807 17.9726 21.6036C17.4918 23.2273 14.7423 21.7344 14.004 21.086C13.2657 20.4384 12.5394 19.0191 14.004 17.5349C15.4686 16.0506 15.1512 15.7546 15.1512 14.2498C15.1512 12.7441 23.1602 7.76519 27.6712 7.31007C28.6739 7.25189 30.3592 7.55132 30.8596 9.29394Z"
                    stroke="currentColor" stroke-width="2"></path>
                    <path
                    d="M15.4677 1.92566V6.42809M13.157 7.67282C10.5752 4.42796 8.49377 2.61689 6.91197 2.24047M10.3314 4.51693L11.1783 1.03766M26.2511 7.67282C25.9757 8.61728 25.9757 9.50357 26.2511 10.33C26.5266 11.1572 27.1177 12.0427 28.0228 12.988"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round"></path>
                </svg>
                <h1 class="text-white">Heart Specialist</h1>
            </div>
            <ul class="pt-6 w-full px-5 xl:px-11 space-y-3 max-h-[292px] overflow-y-auto custom-scroll">
                <li>
                    <a href="" class="font-light pl-7 relative">
                        <i class="fa-regular fa-arrow-right-long absolute top-1/2 -translate-y-1/2 left-0"></i>
                        Heart Specialist
                    </a>
                </li>
                <li>
                    <a href="" class="font-light pl-7 relative">
                        <i class="fa-regular fa-arrow-right-long absolute top-1/2 -translate-y-1/2 left-0"></i>
                        Heart Specialist
                    </a>
                </li>
                <li>
                    <a href="" class="font-light pl-7 relative">
                        <i class="fa-regular fa-arrow-right-long absolute top-1/2 -translate-y-1/2 left-0"></i>
                        Heart Specialist
                    </a>
                </li>
                <li>
                    <a href="" class="font-light pl-7 relative">
                        <i class="fa-regular fa-arrow-right-long absolute top-1/2 -translate-y-1/2 left-0"></i>
                        Heart Specialist
                    </a>
                </li>
                <li>
                    <a href="" class="font-light pl-7 relative">
                        <i class="fa-regular fa-arrow-right-long absolute top-1/2 -translate-y-1/2 left-0"></i>
                        Heart Specialist
                    </a>
                </li>
                <li>
                    <a href="" class="font-light pl-7 relative">
                        <i class="fa-regular fa-arrow-right-long absolute top-1/2 -translate-y-1/2 left-0"></i>
                        Heart Specialist
                    </a>
                </li>
                <li>
                    <a href="" class="font-light pl-7 relative">
                        <i class="fa-regular fa-arrow-right-long absolute top-1/2 -translate-y-1/2 left-0"></i>
                        Heart Specialist
                    </a>
                </li>
                <li>
                    <a href="" class="font-light pl-7 relative">
                        <i class="fa-regular fa-arrow-right-long absolute top-1/2 -translate-y-1/2 left-0"></i>
                        Heart Specialist
                    </a>
                </li>
                <li>
                    <a href="" class="font-light pl-7 relative">
                        <i class="fa-regular fa-arrow-right-long absolute top-1/2 -translate-y-1/2 left-0"></i>
                        Heart Specialist
                    </a>
                </li>
            </ul>
        </div>
        <div class="border border-[#0BA1E5] rounded-[12px] pb-5">
            <div class="flex justify-center items-center gap-2 bg-[#158FC6] pt-12 pb-5 px-4 rounded-[10px]">
                <svg class="text-white" xmlns="http://www.w3.org/2000/svg" width="32" height="38"
                viewBox="0 0 32 38" fill="none">
                <path
                d="M8.22342 15.6297C6.77936 13.8546 5.42427 13.473 4.15643 14.4859C2.25469 16.0053 1.70888 21.3025 3.2385 25.9726C4.76896 30.6427 7.74435 37.0024 13.7516 37.0024C19.758 37.0024 21.1789 30.6033 23.6291 26.7348C26.08 22.8663 27.3761 19.1338 24.9747 14.4859"
                stroke="currentColor" stroke-width="2" stroke-linecap="round"
                stroke-linejoin="round"></path>
                <path
                d="M5.19501 13.9341C4.06406 12.2062 2.92339 10.4846 1.77305 8.76954C0.536018 6.93452 3.69876 4.56225 5.19501 6.1757C6.1925 7.25191 7.51766 8.83627 9.17046 10.9297"
                stroke="currentColor" stroke-width="2" stroke-linecap="round"></path>
                <path
                d="M8.6375 20.4384C8.22259 15.2507 8.56051 11.8733 9.64869 10.3052C11.2827 7.95258 14.3171 7.06116 17.1753 7.06116C18.876 7.06116 20.4304 7.78576 21.836 9.23495"
                stroke="currentColor" stroke-width="2" stroke-linecap="round"
                stroke-linejoin="round"></path>
                <path
                d="M30.8596 9.29394C31.361 11.0357 30.5431 12.6278 28.0228 12.9879C25.5034 13.3481 23.6145 14.6151 22.2526 15.681C20.8898 16.747 18.4542 19.9807 17.9726 21.6036C17.4918 23.2273 14.7423 21.7344 14.004 21.086C13.2657 20.4384 12.5394 19.0191 14.004 17.5349C15.4686 16.0506 15.1512 15.7546 15.1512 14.2498C15.1512 12.7441 23.1602 7.76519 27.6712 7.31007C28.6739 7.25189 30.3592 7.55132 30.8596 9.29394Z"
                stroke="currentColor" stroke-width="2"></path>
                <path
                d="M15.4677 1.92566V6.42809M13.157 7.67282C10.5752 4.42796 8.49377 2.61689 6.91197 2.24047M10.3314 4.51693L11.1783 1.03766M26.2511 7.67282C25.9757 8.61728 25.9757 9.50357 26.2511 10.33C26.5266 11.1572 27.1177 12.0427 28.0228 12.988"
                stroke="currentColor" stroke-width="2" stroke-linecap="round"></path>
            </svg>
            <h1 class="text-white">Heart Specialist</h1>
        </div>
        <ul class="pt-6 w-full px-5 xl:px-11 space-y-3 max-h-[292px] overflow-y-auto custom-scroll">
            <li>
                <a href="" class="font-light pl-7 relative">
                    <i class="fa-regular fa-arrow-right-long absolute top-1/2 -translate-y-1/2 left-0"></i>
                    Heart Specialist
                </a>
            </li>
            <li>
                <a href="" class="font-light pl-7 relative">
                    <i class="fa-regular fa-arrow-right-long absolute top-1/2 -translate-y-1/2 left-0"></i>
                    Heart Specialist
                </a>
            </li>
            <li>
                <a href="" class="font-light pl-7 relative">
                    <i class="fa-regular fa-arrow-right-long absolute top-1/2 -translate-y-1/2 left-0"></i>
                    Heart Specialist
                </a>
            </li>
            <li>
                <a href="" class="font-light pl-7 relative">
                    <i class="fa-regular fa-arrow-right-long absolute top-1/2 -translate-y-1/2 left-0"></i>
                    Heart Specialist
                </a>
            </li>
            <li>
                <a href="" class="font-light pl-7 relative">
                    <i class="fa-regular fa-arrow-right-long absolute top-1/2 -translate-y-1/2 left-0"></i>
                    Heart Specialist
                </a>
            </li>
            <li>
                <a href="" class="font-light pl-7 relative">
                    <i class="fa-regular fa-arrow-right-long absolute top-1/2 -translate-y-1/2 left-0"></i>
                    Heart Specialist
                </a>
            </li>
            <li>
                <a href="" class="font-light pl-7 relative">
                    <i class="fa-regular fa-arrow-right-long absolute top-1/2 -translate-y-1/2 left-0"></i>
                    Heart Specialist
                </a>
            </li>
            <li>
                <a href="" class="font-light pl-7 relative">
                    <i class="fa-regular fa-arrow-right-long absolute top-1/2 -translate-y-1/2 left-0"></i>
                    Heart Specialist
                </a>
            </li>
            <li>
                <a href="" class="font-light pl-7 relative">
                    <i class="fa-regular fa-arrow-right-long absolute top-1/2 -translate-y-1/2 left-0"></i>
                    Heart Specialist
                </a>
            </li>
        </ul>
    </div>
    <div class="border border-[#0BA1E5] rounded-[12px] pb-5">
        <div class="flex justify-center items-center gap-2 bg-[#158FC6] pt-12 pb-5 px-4 rounded-[10px]">
            <svg class="text-white" xmlns="http://www.w3.org/2000/svg" width="32" height="38"
            viewBox="0 0 32 38" fill="none">
            <path
            d="M8.22342 15.6297C6.77936 13.8546 5.42427 13.473 4.15643 14.4859C2.25469 16.0053 1.70888 21.3025 3.2385 25.9726C4.76896 30.6427 7.74435 37.0024 13.7516 37.0024C19.758 37.0024 21.1789 30.6033 23.6291 26.7348C26.08 22.8663 27.3761 19.1338 24.9747 14.4859"
            stroke="currentColor" stroke-width="2" stroke-linecap="round"
            stroke-linejoin="round"></path>
            <path
            d="M5.19501 13.9341C4.06406 12.2062 2.92339 10.4846 1.77305 8.76954C0.536018 6.93452 3.69876 4.56225 5.19501 6.1757C6.1925 7.25191 7.51766 8.83627 9.17046 10.9297"
            stroke="currentColor" stroke-width="2" stroke-linecap="round"></path>
            <path
            d="M8.6375 20.4384C8.22259 15.2507 8.56051 11.8733 9.64869 10.3052C11.2827 7.95258 14.3171 7.06116 17.1753 7.06116C18.876 7.06116 20.4304 7.78576 21.836 9.23495"
            stroke="currentColor" stroke-width="2" stroke-linecap="round"
            stroke-linejoin="round"></path>
            <path
            d="M30.8596 9.29394C31.361 11.0357 30.5431 12.6278 28.0228 12.9879C25.5034 13.3481 23.6145 14.6151 22.2526 15.681C20.8898 16.747 18.4542 19.9807 17.9726 21.6036C17.4918 23.2273 14.7423 21.7344 14.004 21.086C13.2657 20.4384 12.5394 19.0191 14.004 17.5349C15.4686 16.0506 15.1512 15.7546 15.1512 14.2498C15.1512 12.7441 23.1602 7.76519 27.6712 7.31007C28.6739 7.25189 30.3592 7.55132 30.8596 9.29394Z"
            stroke="currentColor" stroke-width="2"></path>
            <path
            d="M15.4677 1.92566V6.42809M13.157 7.67282C10.5752 4.42796 8.49377 2.61689 6.91197 2.24047M10.3314 4.51693L11.1783 1.03766M26.2511 7.67282C25.9757 8.61728 25.9757 9.50357 26.2511 10.33C26.5266 11.1572 27.1177 12.0427 28.0228 12.988"
            stroke="currentColor" stroke-width="2" stroke-linecap="round"></path>
        </svg>
        <h1 class="text-white">Heart Specialist</h1>
    </div>
    <ul class="pt-6 w-full px-5 xl:px-11 space-y-3 max-h-[292px] overflow-y-auto custom-scroll">
        <li>
            <a href="" class="font-light pl-7 relative">
                <i class="fa-regular fa-arrow-right-long absolute top-1/2 -translate-y-1/2 left-0"></i>
                Heart Specialist
            </a>
        </li>
        <li>
            <a href="" class="font-light pl-7 relative">
                <i class="fa-regular fa-arrow-right-long absolute top-1/2 -translate-y-1/2 left-0"></i>
                Heart Specialist
            </a>
        </li>
        <li>
            <a href="" class="font-light pl-7 relative">
                <i class="fa-regular fa-arrow-right-long absolute top-1/2 -translate-y-1/2 left-0"></i>
                Heart Specialist
            </a>
        </li>
        <li>
            <a href="" class="font-light pl-7 relative">
                <i class="fa-regular fa-arrow-right-long absolute top-1/2 -translate-y-1/2 left-0"></i>
                Heart Specialist
            </a>
        </li>
        <li>
            <a href="" class="font-light pl-7 relative">
                <i class="fa-regular fa-arrow-right-long absolute top-1/2 -translate-y-1/2 left-0"></i>
                Heart Specialist
            </a>
        </li>
        <li>
            <a href="" class="font-light pl-7 relative">
                <i class="fa-regular fa-arrow-right-long absolute top-1/2 -translate-y-1/2 left-0"></i>
                Heart Specialist
            </a>
        </li>
        <li>
            <a href="" class="font-light pl-7 relative">
                <i class="fa-regular fa-arrow-right-long absolute top-1/2 -translate-y-1/2 left-0"></i>
                Heart Specialist
            </a>
        </li>
        <li>
            <a href="" class="font-light pl-7 relative">
                <i class="fa-regular fa-arrow-right-long absolute top-1/2 -translate-y-1/2 left-0"></i>
                Heart Specialist
            </a>
        </li>
        <li>
            <a href="" class="font-light pl-7 relative">
                <i class="fa-regular fa-arrow-right-long absolute top-1/2 -translate-y-1/2 left-0"></i>
                Heart Specialist
            </a>
        </li>
    </ul>
</div>
<div class="border border-[#0BA1E5] rounded-[12px] pb-5">
    <div class="flex justify-center items-center gap-2 bg-[#158FC6] pt-12 pb-5 px-4 rounded-[10px]">
        <svg class="text-white" xmlns="http://www.w3.org/2000/svg" width="32" height="38"
        viewBox="0 0 32 38" fill="none">
        <path
        d="M8.22342 15.6297C6.77936 13.8546 5.42427 13.473 4.15643 14.4859C2.25469 16.0053 1.70888 21.3025 3.2385 25.9726C4.76896 30.6427 7.74435 37.0024 13.7516 37.0024C19.758 37.0024 21.1789 30.6033 23.6291 26.7348C26.08 22.8663 27.3761 19.1338 24.9747 14.4859"
        stroke="currentColor" stroke-width="2" stroke-linecap="round"
        stroke-linejoin="round"></path>
        <path
        d="M5.19501 13.9341C4.06406 12.2062 2.92339 10.4846 1.77305 8.76954C0.536018 6.93452 3.69876 4.56225 5.19501 6.1757C6.1925 7.25191 7.51766 8.83627 9.17046 10.9297"
        stroke="currentColor" stroke-width="2" stroke-linecap="round"></path>
        <path
        d="M8.6375 20.4384C8.22259 15.2507 8.56051 11.8733 9.64869 10.3052C11.2827 7.95258 14.3171 7.06116 17.1753 7.06116C18.876 7.06116 20.4304 7.78576 21.836 9.23495"
        stroke="currentColor" stroke-width="2" stroke-linecap="round"
        stroke-linejoin="round"></path>
        <path
        d="M30.8596 9.29394C31.361 11.0357 30.5431 12.6278 28.0228 12.9879C25.5034 13.3481 23.6145 14.6151 22.2526 15.681C20.8898 16.747 18.4542 19.9807 17.9726 21.6036C17.4918 23.2273 14.7423 21.7344 14.004 21.086C13.2657 20.4384 12.5394 19.0191 14.004 17.5349C15.4686 16.0506 15.1512 15.7546 15.1512 14.2498C15.1512 12.7441 23.1602 7.76519 27.6712 7.31007C28.6739 7.25189 30.3592 7.55132 30.8596 9.29394Z"
        stroke="currentColor" stroke-width="2"></path>
        <path
        d="M15.4677 1.92566V6.42809M13.157 7.67282C10.5752 4.42796 8.49377 2.61689 6.91197 2.24047M10.3314 4.51693L11.1783 1.03766M26.2511 7.67282C25.9757 8.61728 25.9757 9.50357 26.2511 10.33C26.5266 11.1572 27.1177 12.0427 28.0228 12.988"
        stroke="currentColor" stroke-width="2" stroke-linecap="round"></path>
    </svg>
    <h1 class="text-white">Heart Specialist</h1>
</div>
<ul class="pt-6 w-full px-5 xl:px-11 space-y-3 max-h-[292px] overflow-y-auto custom-scroll">
    <li>
        <a href="" class="font-light pl-7 relative">
            <i class="fa-regular fa-arrow-right-long absolute top-1/2 -translate-y-1/2 left-0"></i>
            Heart Specialist
        </a>
    </li>
    <li>
        <a href="" class="font-light pl-7 relative">
            <i class="fa-regular fa-arrow-right-long absolute top-1/2 -translate-y-1/2 left-0"></i>
            Heart Specialist
        </a>
    </li>
    <li>
        <a href="" class="font-light pl-7 relative">
            <i class="fa-regular fa-arrow-right-long absolute top-1/2 -translate-y-1/2 left-0"></i>
            Heart Specialist
        </a>
    </li>
    <li>
        <a href="" class="font-light pl-7 relative">
            <i class="fa-regular fa-arrow-right-long absolute top-1/2 -translate-y-1/2 left-0"></i>
            Heart Specialist
        </a>
    </li>
    <li>
        <a href="" class="font-light pl-7 relative">
            <i class="fa-regular fa-arrow-right-long absolute top-1/2 -translate-y-1/2 left-0"></i>
            Heart Specialist
        </a>
    </li>
    <li>
        <a href="" class="font-light pl-7 relative">
            <i class="fa-regular fa-arrow-right-long absolute top-1/2 -translate-y-1/2 left-0"></i>
            Heart Specialist
        </a>
    </li>
    <li>
        <a href="" class="font-light pl-7 relative">
            <i class="fa-regular fa-arrow-right-long absolute top-1/2 -translate-y-1/2 left-0"></i>
            Heart Specialist
        </a>
    </li>
    <li>
        <a href="" class="font-light pl-7 relative">
            <i class="fa-regular fa-arrow-right-long absolute top-1/2 -translate-y-1/2 left-0"></i>
            Heart Specialist
        </a>
    </li>
    <li>
        <a href="" class="font-light pl-7 relative">
            <i class="fa-regular fa-arrow-right-long absolute top-1/2 -translate-y-1/2 left-0"></i>
            Heart Specialist
        </a>
    </li>
</ul>
</div>
</div>
</div>
</section>

<section class="mt-36">
    <div class="container xl:max-w-screen-2xl mx-auto px-4 relative">
        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-5">
            <div class="border border-[#0BA1E5] rounded-[12px] pb-5">
                <div class="flex justify-center items-center gap-2 bg-[#158FC6] pt-12 pb-5 px-4 rounded-[10px]">
                    <svg class="text-white" xmlns="http://www.w3.org/2000/svg" width="32" height="38"
                    viewBox="0 0 32 38" fill="none">
                    <path
                    d="M8.22342 15.6297C6.77936 13.8546 5.42427 13.473 4.15643 14.4859C2.25469 16.0053 1.70888 21.3025 3.2385 25.9726C4.76896 30.6427 7.74435 37.0024 13.7516 37.0024C19.758 37.0024 21.1789 30.6033 23.6291 26.7348C26.08 22.8663 27.3761 19.1338 24.9747 14.4859"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round"></path>
                    <path
                    d="M5.19501 13.9341C4.06406 12.2062 2.92339 10.4846 1.77305 8.76954C0.536018 6.93452 3.69876 4.56225 5.19501 6.1757C6.1925 7.25191 7.51766 8.83627 9.17046 10.9297"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round"></path>
                    <path
                    d="M8.6375 20.4384C8.22259 15.2507 8.56051 11.8733 9.64869 10.3052C11.2827 7.95258 14.3171 7.06116 17.1753 7.06116C18.876 7.06116 20.4304 7.78576 21.836 9.23495"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round"></path>
                    <path
                    d="M30.8596 9.29394C31.361 11.0357 30.5431 12.6278 28.0228 12.9879C25.5034 13.3481 23.6145 14.6151 22.2526 15.681C20.8898 16.747 18.4542 19.9807 17.9726 21.6036C17.4918 23.2273 14.7423 21.7344 14.004 21.086C13.2657 20.4384 12.5394 19.0191 14.004 17.5349C15.4686 16.0506 15.1512 15.7546 15.1512 14.2498C15.1512 12.7441 23.1602 7.76519 27.6712 7.31007C28.6739 7.25189 30.3592 7.55132 30.8596 9.29394Z"
                    stroke="currentColor" stroke-width="2"></path>
                    <path
                    d="M15.4677 1.92566V6.42809M13.157 7.67282C10.5752 4.42796 8.49377 2.61689 6.91197 2.24047M10.3314 4.51693L11.1783 1.03766M26.2511 7.67282C25.9757 8.61728 25.9757 9.50357 26.2511 10.33C26.5266 11.1572 27.1177 12.0427 28.0228 12.988"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round"></path>
                </svg>
                <h1 class="text-white">Heart Specialist</h1>
            </div>
            <ul class="pt-6 w-full px-5 xl:px-11 space-y-3 max-h-[292px] overflow-y-auto custom-scroll">
                <li>
                    <a href="" class="font-light pl-7 relative">
                        <i class="fa-regular fa-arrow-right-long absolute top-1/2 -translate-y-1/2 left-0"></i>
                        Heart Specialist
                    </a>
                </li>
                <li>
                    <a href="" class="font-light pl-7 relative">
                        <i class="fa-regular fa-arrow-right-long absolute top-1/2 -translate-y-1/2 left-0"></i>
                        Heart Specialist
                    </a>
                </li>
                <li>
                    <a href="" class="font-light pl-7 relative">
                        <i class="fa-regular fa-arrow-right-long absolute top-1/2 -translate-y-1/2 left-0"></i>
                        Heart Specialist
                    </a>
                </li>
                <li>
                    <a href="" class="font-light pl-7 relative">
                        <i class="fa-regular fa-arrow-right-long absolute top-1/2 -translate-y-1/2 left-0"></i>
                        Heart Specialist
                    </a>
                </li>
                <li>
                    <a href="" class="font-light pl-7 relative">
                        <i class="fa-regular fa-arrow-right-long absolute top-1/2 -translate-y-1/2 left-0"></i>
                        Heart Specialist
                    </a>
                </li>
                <li>
                    <a href="" class="font-light pl-7 relative">
                        <i class="fa-regular fa-arrow-right-long absolute top-1/2 -translate-y-1/2 left-0"></i>
                        Heart Specialist
                    </a>
                </li>
                <li>
                    <a href="" class="font-light pl-7 relative">
                        <i class="fa-regular fa-arrow-right-long absolute top-1/2 -translate-y-1/2 left-0"></i>
                        Heart Specialist
                    </a>
                </li>
                <li>
                    <a href="" class="font-light pl-7 relative">
                        <i class="fa-regular fa-arrow-right-long absolute top-1/2 -translate-y-1/2 left-0"></i>
                        Heart Specialist
                    </a>
                </li>
                <li>
                    <a href="" class="font-light pl-7 relative">
                        <i class="fa-regular fa-arrow-right-long absolute top-1/2 -translate-y-1/2 left-0"></i>
                        Heart Specialist
                    </a>
                </li>
            </ul>
        </div>
        <div class="border border-[#0BA1E5] rounded-[12px] pb-5">
            <div class="flex justify-center items-center gap-2 bg-[#158FC6] pt-12 pb-5 px-4 rounded-[10px]">
                <svg class="text-white" xmlns="http://www.w3.org/2000/svg" width="32" height="38"
                viewBox="0 0 32 38" fill="none">
                <path
                d="M8.22342 15.6297C6.77936 13.8546 5.42427 13.473 4.15643 14.4859C2.25469 16.0053 1.70888 21.3025 3.2385 25.9726C4.76896 30.6427 7.74435 37.0024 13.7516 37.0024C19.758 37.0024 21.1789 30.6033 23.6291 26.7348C26.08 22.8663 27.3761 19.1338 24.9747 14.4859"
                stroke="currentColor" stroke-width="2" stroke-linecap="round"
                stroke-linejoin="round"></path>
                <path
                d="M5.19501 13.9341C4.06406 12.2062 2.92339 10.4846 1.77305 8.76954C0.536018 6.93452 3.69876 4.56225 5.19501 6.1757C6.1925 7.25191 7.51766 8.83627 9.17046 10.9297"
                stroke="currentColor" stroke-width="2" stroke-linecap="round"></path>
                <path
                d="M8.6375 20.4384C8.22259 15.2507 8.56051 11.8733 9.64869 10.3052C11.2827 7.95258 14.3171 7.06116 17.1753 7.06116C18.876 7.06116 20.4304 7.78576 21.836 9.23495"
                stroke="currentColor" stroke-width="2" stroke-linecap="round"
                stroke-linejoin="round"></path>
                <path
                d="M30.8596 9.29394C31.361 11.0357 30.5431 12.6278 28.0228 12.9879C25.5034 13.3481 23.6145 14.6151 22.2526 15.681C20.8898 16.747 18.4542 19.9807 17.9726 21.6036C17.4918 23.2273 14.7423 21.7344 14.004 21.086C13.2657 20.4384 12.5394 19.0191 14.004 17.5349C15.4686 16.0506 15.1512 15.7546 15.1512 14.2498C15.1512 12.7441 23.1602 7.76519 27.6712 7.31007C28.6739 7.25189 30.3592 7.55132 30.8596 9.29394Z"
                stroke="currentColor" stroke-width="2"></path>
                <path
                d="M15.4677 1.92566V6.42809M13.157 7.67282C10.5752 4.42796 8.49377 2.61689 6.91197 2.24047M10.3314 4.51693L11.1783 1.03766M26.2511 7.67282C25.9757 8.61728 25.9757 9.50357 26.2511 10.33C26.5266 11.1572 27.1177 12.0427 28.0228 12.988"
                stroke="currentColor" stroke-width="2" stroke-linecap="round"></path>
            </svg>
            <h1 class="text-white">Heart Specialist</h1>
        </div>
        <ul class="pt-6 w-full px-5 xl:px-11 space-y-3 max-h-[292px] overflow-y-auto custom-scroll">
            <li>
                <a href="" class="font-light pl-7 relative">
                    <i class="fa-regular fa-arrow-right-long absolute top-1/2 -translate-y-1/2 left-0"></i>
                    Heart Specialist
                </a>
            </li>
            <li>
                <a href="" class="font-light pl-7 relative">
                    <i class="fa-regular fa-arrow-right-long absolute top-1/2 -translate-y-1/2 left-0"></i>
                    Heart Specialist
                </a>
            </li>
            <li>
                <a href="" class="font-light pl-7 relative">
                    <i class="fa-regular fa-arrow-right-long absolute top-1/2 -translate-y-1/2 left-0"></i>
                    Heart Specialist
                </a>
            </li>
            <li>
                <a href="" class="font-light pl-7 relative">
                    <i class="fa-regular fa-arrow-right-long absolute top-1/2 -translate-y-1/2 left-0"></i>
                    Heart Specialist
                </a>
            </li>
            <li>
                <a href="" class="font-light pl-7 relative">
                    <i class="fa-regular fa-arrow-right-long absolute top-1/2 -translate-y-1/2 left-0"></i>
                    Heart Specialist
                </a>
            </li>
            <li>
                <a href="" class="font-light pl-7 relative">
                    <i class="fa-regular fa-arrow-right-long absolute top-1/2 -translate-y-1/2 left-0"></i>
                    Heart Specialist
                </a>
            </li>
            <li>
                <a href="" class="font-light pl-7 relative">
                    <i class="fa-regular fa-arrow-right-long absolute top-1/2 -translate-y-1/2 left-0"></i>
                    Heart Specialist
                </a>
            </li>
            <li>
                <a href="" class="font-light pl-7 relative">
                    <i class="fa-regular fa-arrow-right-long absolute top-1/2 -translate-y-1/2 left-0"></i>
                    Heart Specialist
                </a>
            </li>
            <li>
                <a href="" class="font-light pl-7 relative">
                    <i class="fa-regular fa-arrow-right-long absolute top-1/2 -translate-y-1/2 left-0"></i>
                    Heart Specialist
                </a>
            </li>
        </ul>
    </div>
    <div class="border border-[#0BA1E5] rounded-[12px] pb-5">
        <div class="flex justify-center items-center gap-2 bg-[#158FC6] pt-12 pb-5 px-4 rounded-[10px]">
            <svg class="text-white" xmlns="http://www.w3.org/2000/svg" width="32" height="38"
            viewBox="0 0 32 38" fill="none">
            <path
            d="M8.22342 15.6297C6.77936 13.8546 5.42427 13.473 4.15643 14.4859C2.25469 16.0053 1.70888 21.3025 3.2385 25.9726C4.76896 30.6427 7.74435 37.0024 13.7516 37.0024C19.758 37.0024 21.1789 30.6033 23.6291 26.7348C26.08 22.8663 27.3761 19.1338 24.9747 14.4859"
            stroke="currentColor" stroke-width="2" stroke-linecap="round"
            stroke-linejoin="round"></path>
            <path
            d="M5.19501 13.9341C4.06406 12.2062 2.92339 10.4846 1.77305 8.76954C0.536018 6.93452 3.69876 4.56225 5.19501 6.1757C6.1925 7.25191 7.51766 8.83627 9.17046 10.9297"
            stroke="currentColor" stroke-width="2" stroke-linecap="round"></path>
            <path
            d="M8.6375 20.4384C8.22259 15.2507 8.56051 11.8733 9.64869 10.3052C11.2827 7.95258 14.3171 7.06116 17.1753 7.06116C18.876 7.06116 20.4304 7.78576 21.836 9.23495"
            stroke="currentColor" stroke-width="2" stroke-linecap="round"
            stroke-linejoin="round"></path>
            <path
            d="M30.8596 9.29394C31.361 11.0357 30.5431 12.6278 28.0228 12.9879C25.5034 13.3481 23.6145 14.6151 22.2526 15.681C20.8898 16.747 18.4542 19.9807 17.9726 21.6036C17.4918 23.2273 14.7423 21.7344 14.004 21.086C13.2657 20.4384 12.5394 19.0191 14.004 17.5349C15.4686 16.0506 15.1512 15.7546 15.1512 14.2498C15.1512 12.7441 23.1602 7.76519 27.6712 7.31007C28.6739 7.25189 30.3592 7.55132 30.8596 9.29394Z"
            stroke="currentColor" stroke-width="2"></path>
            <path
            d="M15.4677 1.92566V6.42809M13.157 7.67282C10.5752 4.42796 8.49377 2.61689 6.91197 2.24047M10.3314 4.51693L11.1783 1.03766M26.2511 7.67282C25.9757 8.61728 25.9757 9.50357 26.2511 10.33C26.5266 11.1572 27.1177 12.0427 28.0228 12.988"
            stroke="currentColor" stroke-width="2" stroke-linecap="round"></path>
        </svg>
        <h1 class="text-white">Heart Specialist</h1>
    </div>
    <ul class="pt-6 w-full px-5 xl:px-11 space-y-3 max-h-[292px] overflow-y-auto custom-scroll">
        <li>
            <a href="" class="font-light pl-7 relative">
                <i
                class="fa-regular fa-arrow-right-long absolute top-1/2 -translate-y-1/2 left-0"></i>
                Heart Specialist
            </a>
        </li>
        <li>
            <a href="" class="font-light pl-7 relative">
                <i
                class="fa-regular fa-arrow-right-long absolute top-1/2 -translate-y-1/2 left-0"></i>
                Heart Specialist
            </a>
        </li>
        <li>
            <a href="" class="font-light pl-7 relative">
                <i
                class="fa-regular fa-arrow-right-long absolute top-1/2 -translate-y-1/2 left-0"></i>
                Heart Specialist
            </a>
        </li>
        <li>
            <a href="" class="font-light pl-7 relative">
                <i
                class="fa-regular fa-arrow-right-long absolute top-1/2 -translate-y-1/2 left-0"></i>
                Heart Specialist
            </a>
        </li>
        <li>
            <a href="" class="font-light pl-7 relative">
                <i
                class="fa-regular fa-arrow-right-long absolute top-1/2 -translate-y-1/2 left-0"></i>
                Heart Specialist
            </a>
        </li>
        <li>
            <a href="" class="font-light pl-7 relative">
                <i
                class="fa-regular fa-arrow-right-long absolute top-1/2 -translate-y-1/2 left-0"></i>
                Heart Specialist
            </a>
        </li>
        <li>
            <a href="" class="font-light pl-7 relative">
                <i
                class="fa-regular fa-arrow-right-long absolute top-1/2 -translate-y-1/2 left-0"></i>
                Heart Specialist
            </a>
        </li>
        <li>
            <a href="" class="font-light pl-7 relative">
                <i
                class="fa-regular fa-arrow-right-long absolute top-1/2 -translate-y-1/2 left-0"></i>
                Heart Specialist
            </a>
        </li>
        <li>
            <a href="" class="font-light pl-7 relative">
                <i
                class="fa-regular fa-arrow-right-long absolute top-1/2 -translate-y-1/2 left-0"></i>
                Heart Specialist
            </a>
        </li>
    </ul>
</div>
<div class="border border-[#0BA1E5] rounded-[12px] pb-5">
    <div class="flex justify-center items-center gap-2 bg-[#158FC6] pt-12 pb-5 px-4 rounded-[10px]">
        <svg class="text-white" xmlns="http://www.w3.org/2000/svg" width="32" height="38"
        viewBox="0 0 32 38" fill="none">
        <path
        d="M8.22342 15.6297C6.77936 13.8546 5.42427 13.473 4.15643 14.4859C2.25469 16.0053 1.70888 21.3025 3.2385 25.9726C4.76896 30.6427 7.74435 37.0024 13.7516 37.0024C19.758 37.0024 21.1789 30.6033 23.6291 26.7348C26.08 22.8663 27.3761 19.1338 24.9747 14.4859"
        stroke="currentColor" stroke-width="2" stroke-linecap="round"
        stroke-linejoin="round"></path>
        <path
        d="M5.19501 13.9341C4.06406 12.2062 2.92339 10.4846 1.77305 8.76954C0.536018 6.93452 3.69876 4.56225 5.19501 6.1757C6.1925 7.25191 7.51766 8.83627 9.17046 10.9297"
        stroke="currentColor" stroke-width="2" stroke-linecap="round"></path>
        <path
        d="M8.6375 20.4384C8.22259 15.2507 8.56051 11.8733 9.64869 10.3052C11.2827 7.95258 14.3171 7.06116 17.1753 7.06116C18.876 7.06116 20.4304 7.78576 21.836 9.23495"
        stroke="currentColor" stroke-width="2" stroke-linecap="round"
        stroke-linejoin="round"></path>
        <path
        d="M30.8596 9.29394C31.361 11.0357 30.5431 12.6278 28.0228 12.9879C25.5034 13.3481 23.6145 14.6151 22.2526 15.681C20.8898 16.747 18.4542 19.9807 17.9726 21.6036C17.4918 23.2273 14.7423 21.7344 14.004 21.086C13.2657 20.4384 12.5394 19.0191 14.004 17.5349C15.4686 16.0506 15.1512 15.7546 15.1512 14.2498C15.1512 12.7441 23.1602 7.76519 27.6712 7.31007C28.6739 7.25189 30.3592 7.55132 30.8596 9.29394Z"
        stroke="currentColor" stroke-width="2"></path>
        <path
        d="M15.4677 1.92566V6.42809M13.157 7.67282C10.5752 4.42796 8.49377 2.61689 6.91197 2.24047M10.3314 4.51693L11.1783 1.03766M26.2511 7.67282C25.9757 8.61728 25.9757 9.50357 26.2511 10.33C26.5266 11.1572 27.1177 12.0427 28.0228 12.988"
        stroke="currentColor" stroke-width="2" stroke-linecap="round"></path>
    </svg>
    <h1 class="text-white">Heart Specialist</h1>
</div>
<ul class="pt-6 w-full px-5 xl:px-11 space-y-3 max-h-[292px] overflow-y-auto custom-scroll">
    <li>
        <a href="" class="font-light pl-7 relative">
            <i
            class="fa-regular fa-arrow-right-long absolute top-1/2 -translate-y-1/2 left-0"></i>
            Heart Specialist
        </a>
    </li>
    <li>
        <a href="" class="font-light pl-7 relative">
            <i
            class="fa-regular fa-arrow-right-long absolute top-1/2 -translate-y-1/2 left-0"></i>
            Heart Specialist
        </a>
    </li>
    <li>
        <a href="" class="font-light pl-7 relative">
            <i
            class="fa-regular fa-arrow-right-long absolute top-1/2 -translate-y-1/2 left-0"></i>
            Heart Specialist
        </a>
    </li>
    <li>
        <a href="" class="font-light pl-7 relative">
            <i
            class="fa-regular fa-arrow-right-long absolute top-1/2 -translate-y-1/2 left-0"></i>
            Heart Specialist
        </a>
    </li>
    <li>
        <a href="" class="font-light pl-7 relative">
            <i
            class="fa-regular fa-arrow-right-long absolute top-1/2 -translate-y-1/2 left-0"></i>
            Heart Specialist
        </a>
    </li>
    <li>
        <a href="" class="font-light pl-7 relative">
            <i
            class="fa-regular fa-arrow-right-long absolute top-1/2 -translate-y-1/2 left-0"></i>
            Heart Specialist
        </a>
    </li>
    <li>
        <a href="" class="font-light pl-7 relative">
            <i
            class="fa-regular fa-arrow-right-long absolute top-1/2 -translate-y-1/2 left-0"></i>
            Heart Specialist
        </a>
    </li>
    <li>
        <a href="" class="font-light pl-7 relative">
            <i
            class="fa-regular fa-arrow-right-long absolute top-1/2 -translate-y-1/2 left-0"></i>
            Heart Specialist
        </a>
    </li>
    <li>
        <a href="" class="font-light pl-7 relative">
            <i
            class="fa-regular fa-arrow-right-long absolute top-1/2 -translate-y-1/2 left-0"></i>
            Heart Specialist
        </a>
    </li>
</ul>
</div>
</div>
</div>
</section> --}}
</div>

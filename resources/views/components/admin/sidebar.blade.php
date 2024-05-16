    <!-- sidenav  -->
    <style>
        .active {
            background-color: white;
            color: rgba(29, 17, 17, 0.726);
            font-weight: bold;
        }
    </style>
    <aside
        class="max-w-62.5 ease-nav-brand z-90 fixed inset-y-0 my-4 ml-4 block w-full -translate-x-full flex-wrap items-center justify-between overflow-y-auto rounded-2xl border-0 bg-white p-0 antialiased shadow-none transition-transform duration-200 xl:left-0 xl:translate-x-0 xl:bg-transparent">
        <div class="h-19.5">
            <i class="absolute top-0 right-0 hidden p-4 opacity-50 cursor-pointer fas fa-times text-slate-400 xl:hidden"
                sidenav-close></i>
            @php
                $logo = App\Models\Setting::where('key', 'app_logo')->whereNotNull('value')->first();
                $siteName = App\Models\Setting::where('key', 'site_name')->whereNotNull('value')->first();
            @endphp
            <a class="block px-8 py-6 m-0 text-sm whitespace-nowrap text-slate-700" href="/" target="_blank">
                <img src="{{ asset($logo ? 'storage/' . $logo->value : 'images/LOGO.png') }}"
                    class="inline h-full max-w-full transition-all duration-200 ease-nav-brand max-h-8" alt="main_logo" />
                <span class="ml-1 font-semibold transition-all duration-200 ease-nav-brand">{!! $siteName->value ?? config('app.name') !!}</span>
            </a>
        </div>

        <hr class="h-px mt-0 bg-transparent bg-gradient-to-r from-transparent via-black/40 to-transparent" />

        <div class="items-center block w-auto h-auto overflow-auto h-sidenav grow basis-full">
            <ul class="flex flex-col pl-0 mb-0">

                <li class="mt-0.5 w-full">
                    <a class="py-2.7 text-sm ease-nav-brand my-0 mx-4 flex items-center whitespace-nowrap rounded-lg  px-4  transition-colors {{ Request::is('admin/dashboard*') ? 'shadow-soft-xl  rounded-lg bg-white  font-semibold text-slate-700' : '' }}"
                        href="{{ route('admin.dashboard') }}">
                        <div
                            class="{{ Request::is('admin/dashboard*') ? 'bg-gradient-to-tl from-purple-700 to-pink-500 text-white' : '' }} shadow-soft-2xl mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-white bg-center stroke-0 text-center xl:p-2.5">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-speedometer2" viewBox="0 0 16 16">
                                <path
                                    d="M11.06 1.94a.5.5 0 0 0-.34-.13H5.28a.5.5 0 0 0-.31.11l-4 3a.5.5 0 0 0-.15.53l2 5A.5.5 0 0 0 3 11h1v4a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V11h1a.5.5 0 0 0 .15-.06l2-1a.5.5 0 0 0 .15-.53l-2-5a.5.5 0 0 0-.47-.34zM9 3.38V7a1 1 0 1 0 2 0V3.38l1.5.75-1.73 4.33a.5.5 0 0 0-.94 0L9.5 4.13 8 3.38zm1.5 8.62V9.18a.5.5 0 0 0-.5-.5H6a.5.5 0 0 0-.5.5v3.82a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5zM11 0a1 1 0 0 0-1 1v.06l-.44.33-4 3A1 1 0 0 0 5 5h6a1 1 0 0 0 .78-.37l4-5A1 1 0 0 0 14 0h-3z" />
                            </svg>
                        </div>
                        <span class="ml-1 duration-300 opacity-100 pointer-events-none ease-soft">Dashboard</span>
                    </a>
                </li>

                <li class="mt-0.5 w-full">
                    <a class="py-2.7 text-sm ease-nav-brand my-0 mx-4 flex items-center whitespace-nowrap px-4 transition-colors {{ Request::is('admin/categories*') ? 'shadow-soft-xl  rounded-lg bg-white  font-semibold text-slate-700' : '' }}"
                        href="{{ route('admin.categories') }}">
                        <div
                            class="{{ Request::is('admin/categories*') ? 'bg-gradient-to-tl from-purple-700 to-pink-500 text-white' : '' }} shadow-soft-2xl mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-white bg-center stroke-0 text-center xl:p-2.5">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-grid-3x3-gap-fill" viewBox="0 0 16 16">
                                <path
                                    d="M1 1.5A.5.5 0 0 1 1.5 1h3a.5.5 0 0 1 .5.5V5a.5.5 0 0 1-.5.5H1.5a.5.5 0 0 1-.5-.5v-3zm5 0a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 .5.5V5a.5.5 0 0 1-.5.5H6.5a.5.5 0 0 1-.5-.5v-3zM1 7.5A.5.5 0 0 1 1.5 7h3a.5.5 0 0 1 .5.5V11a.5.5 0 0 1-.5.5H1.5a.5.5 0 0 1-.5-.5v-3zm5 0a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 .5.5V11a.5.5 0 0 1-.5.5H6.5a.5.5 0 0 1-.5-.5v-3zM1 13.5A.5.5 0 0 1 1.5 13h3a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5H1.5a.5.5 0 0 1-.5-.5v-2zm5 0a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5H6.5a.5.5 0 0 1-.5-.5v-2zm8-11a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 .5.5V5a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5V1.5zm-5 5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 .5.5V5a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5V1.5zm5 8a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-2zm-5 0a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-2z" />
                            </svg>
                        </div>
                        <span class="ml-1 duration-300 opacity-100 pointer-events-none ease-soft">Categories</span>
                    </a>
                </li>

                <li class="mt-0.5 w-full">
                    <a class="py-2.7 text-sm ease-nav-brand my-0 mx-4 flex items-center whitespace-nowrap px-4 transition-colors {{ Request::is('admin/verification-methods*') ? 'shadow-soft-xl  rounded-lg bg-white  font-semibold text-slate-700' : '' }}"
                        href="{{ route('admin.verification-methods') }}">
                        <div
                            class="{{ Request::is('admin/verification-methods*') ? 'bg-gradient-to-tl from-purple-700 to-pink-500 text-white' : '' }} shadow-soft-2xl mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-white bg-center stroke-0 text-center xl:p-2.5">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-file-earmark-check-fill" viewBox="0 0 16 16">
                                <path
                                    d="M5.854 10.146a.5.5 0 0 0 .708 0L8 8.707l2.438 2.439a.5.5 0 0 0 .708-.708L8.707 8l2.439-2.438a.5.5 0 0 0-.708-.708L8 7.293 5.562 4.854a.5.5 0 0 0-.708.708L7.293 8 4.854 10.438a.5.5 0 0 0 0 .708z" />
                                <path
                                    d="M4.5 1A1.5 1.5 0 0 0 3 2.5v11A1.5 1.5 0 0 0 4.5 15h7a1.5 1.5 0 0 0 1.5-1.5V4h-3a2 2 0 0 1-2-2V.5A1.5 1.5 0 0 0 7.5 0h-3zM8 4.5V2l2-1.5v3a2 2 0 0 1-2 2z" />
                            </svg>
                        </div>
                        <span class="ml-1 duration-300 opacity-100 pointer-events-none ease-soft">Verification
                            methods</span>
                    </a>
                </li>

                <li class="mt-0.5 w-full">
                    <a class="py-2.7 text-sm ease-nav-brand my-0 mx-4 flex items-center whitespace-nowrap px-4 transition-colors {{ Request::is('admin/users*') ? 'shadow-soft-xl  rounded-lg bg-white  font-semibold text-slate-700' : '' }}"
                        href="{{ route('admin.users') }}">
                        <div
                            class="{{ Request::is('admin/users*') ? 'bg-gradient-to-tl from-purple-700 to-pink-500 text-white' : '' }} shadow-soft-2xl mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-white bg-center stroke-0 text-center xl:p-2.5">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-people" viewBox="0 0 16 16">
                                <path
                                    d="M8 8a2 2 0 1 1 0-4 2 2 0 0 1 0 4zm3-3a3 3 0 0 0-2.598 1.5A3.486 3.486 0 0 0 8 6a3.486 3.486 0 0 0-1.402.5A3 3 0 1 0 5 8c0-.612.224-1.17.598-1.598A3 3 0 1 0 5 12h6a3 3 0 1 0 0-6z" />
                                <path fill-rule="evenodd"
                                    d="M2 9a1 1 0 0 1 1-1h1a1 1 0 0 1 1 1v1a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1v-1zm10 0a1 1 0 0 1 1-1h1a1 1 0 0 1 1 1v1a1 1 0 0 1-1 1h-1a1 1 0 0 1-1-1v-1zM7 0a1 1 0 0 1 1 1v1a1 1 0 0 1-2 0V1a1 1 0 0 1 1-1zM4 3a1 1 0 0 1-1-1V1a3 3 0 0 1 6 0v1a1 1 0 0 1-1 1H4zm6-2a1 1 0 0 1-1 1h-1a1 1 0 0 1-1-1V1a1 1 0 0 1 2 0v1z" />
                            </svg>

                        </div>
                        <span class="ml-1 duration-300 opacity-100 pointer-events-none ease-soft">Users</span>
                    </a>
                </li>

                <li class="mt-0.5 w-full">
                    <a class="py-2.7 text-sm ease-nav-brand my-0 mx-4 flex items-center whitespace-nowrap px-4 transition-colors {{ Request::routeIs(['admin.business-accounts', 'admin.view-business-account']) ? 'shadow-soft-xl  rounded-lg bg-white  font-semibold text-slate-700' : '' }}"
                        href="{{ route('admin.business-accounts') }}">
                        <div
                            class="{{ Request::routeIs(['admin.business-accounts', 'admin.view-business-account']) ? 'bg-gradient-to-tl from-purple-700 to-pink-500 text-white' : '' }} shadow-soft-2xl mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-white bg-center stroke-0 text-center xl:p-2.5">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-building" viewBox="0 0 16 16">
                                <path
                                    d="M1 10.5V15h1v-4.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5V15h1v-3.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5V15h1v-2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5V15h1v-4.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5V15h1v-6a1 1 0 0 0-1-1h-1V8h1a1 1 0 0 0 1-1V5a1 1 0 0 0-1-1H4a1 1 0 0 0-1 1v2a1 1 0 0 0 1 1h1v1H3a1 1 0 0 0-1 1v1H1zM0 2a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v11a1 1 0 0 1-1 1h-3.5v-1H14V3H2v10h3.5v1H2a1 1 0 0 1-1-1V2z" />
                            </svg>

                        </div>
                        <span class="ml-1 duration-300 opacity-100 pointer-events-none ease-soft">Business
                            Profiles</span>
                    </a>
                </li>

                <li class="mt-0.5 w-full">
                    <a class="py-2.7 text-sm ease-nav-brand my-0 mx-4 flex items-center whitespace-nowrap px-4 transition-colors {{ Request::is('admin/feature/business*') ? 'shadow-soft-xl  rounded-lg bg-white  font-semibold text-slate-700' : '' }}"
                        href="{{ route('admin.feature.business') }}">
                        <div
                            class="{{ Request::is('admin/feature/business*') ? 'bg-gradient-to-tl from-purple-700 to-pink-500 text-white' : '' }} shadow-soft-2xl mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-white bg-center stroke-0 text-center xl:p-2.5">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                fill="currentColor" class="bi bi-stars" viewBox="0 0 16 16">
                                <path
                                    d="M4.457 5.471l-1.286.117-.465-1.247a.667.667 0 0 0-1.242 0l-.465 1.247-1.286-.117a.667.667 0 0 0-.369 1.145l1.04.795-.292 1.261a.667.667 0 0 0 .964.703L4 9.864l1.203.757a.667.667 0 0 0 .964-.703l-.292-1.261 1.04-.795a.667.667 0 0 0-.369-1.145zM8 12.942V3.333c0-.242.19-.443.43-.49l3.116-.567L12.16 1.17a.664.664 0 0 1 .327-.173l1.375-.256a.667.667 0 0 1 .788.75l-.22 1.489a.666.666 0 0 0 .254.604l1.195 1.06a.667.667 0 0 1-.39 1.13l-1.533.273-1.077 1.457a.666.666 0 0 0-.124.372l.254 1.494a.667.667 0 0 1-.97.703l-1.564-.832-1.564.832a.667.667 0 0 1-.97-.703l.254-1.494a.666.666 0 0 0-.124-.372l-1.077-1.457-1.533-.273a.667.667 0 0 1-.39-1.13l1.195-1.06a.666.666 0 0 0 .254-.604l-.22-1.489a.667.667 0 0 1 .788-.75l1.375.256a.664.664 0 0 1 .327.173l1.187 1.11 3.116.567a.666.666 0 0 1 .43.49v9.609a.666.666 0 0 1-.666.666H8.667a.666.666 0 0 1-.667-.666z" />
                            </svg>

                        </div>
                        <span class="ml-1 duration-300 opacity-100 pointer-events-none ease-soft">Feature Business</span>
                    </a>
                </li>

                <li class="mt-0.5 w-full">
                    <a class="py-2.7 text-sm ease-nav-brand my-0 mx-4 flex items-center whitespace-nowrap px-4 transition-colors {{ Request::is('admin/dispute-requests*') ? 'shadow-soft-xl  rounded-lg bg-white  font-semibold text-slate-700' : '' }}"
                        href="{{ route('admin.dispute-requests') }}">
                        <div
                            class="{{ Request::is('admin/dispute-requests*') ? 'bg-gradient-to-tl from-purple-700 to-pink-500 text-white' : '' }} shadow-soft-2xl mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-white bg-center stroke-0 text-center xl:p-2.5">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-exclamation-triangle" viewBox="0 0 16 16">
                                <path
                                    d="M0 14.12V1a1 1 0 0 1 1.553-.833l14 6.928a1 1 0 0 1 0 1.666l-14 6.928A1 1 0 0 1 0 14.12zM1 13.347V2.653L13.234 8 1 13.347z" />
                                <path
                                    d="M6 10a1 1 0 0 1 2 0v2a1 1 0 1 1-2 0v-2zm0-4a1 1 0 1 1 2 0v2a1 1 0 1 1-2 0V6z" />
                            </svg>

                        </div>
                        <span class="ml-1 duration-300 opacity-100 pointer-events-none ease-soft">Dispute
                            Requests</span>
                    </a>
                </li>

                <li class="mt-0.5 w-full">
                    <a class="py-2.7 text-sm ease-nav-brand my-0 mx-4 flex items-center whitespace-nowrap px-4 transition-colors {{ Request::is('admin/spam-pharases*') ? 'shadow-soft-xl  rounded-lg bg-white  font-semibold text-slate-700' : '' }}"
                        href="{{ route('admin.spam-pharases') }}">
                        <div
                            class="{{ Request::is('admin/spam-pharases*') ? 'bg-gradient-to-tl from-purple-700 to-pink-500 text-white' : '' }} shadow-soft-2xl mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-white bg-center stroke-0 text-center xl:p-2.5">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-exclamation-octagon" viewBox="0 0 16 16">
                                <path
                                    d="M.74 9.03a1 1 0 0 0 .286.842l5.153 5.153a1 1 0 0 0 1.414 0l5.153-5.153a1 1 0 0 0 .287-.842V3.237a1 1 0 0 0-.855-.992l-9-1.5a1 1 0 0 0-.29 0l-9 1.5A1 1 0 0 0 0 3.237v5.793zm5.511 1.948l-3.968-3.968 3.968-3.968 3.968 3.968-3.968 3.968z" />
                                <path fill-rule="evenodd"
                                    d="M6.5 7a.5.5 0 0 1 .5.5V11a.5.5 0 0 1-1 0V7.5a.5.5 0 0 1 .5-.5zm7-7a.5.5 0 0 1 .5.5v3.973a5.5 5.5 0 0 1-.358 2.077l-4.107 8.215a1.5 1.5 0 0 1-2.669 0l-4.107-8.215A5.5 5.5 0 0 1 1 3.473V.5a.5.5 0 0 1 1 0v2.973c0 .76.154 1.47.43 2.121l4.107 8.214a.5.5 0 0 0 .892 0l4.107-8.214c.276-.551.43-1.36.43-2.121V.5a.5.5 0 0 1 .5-.5z" />
                            </svg>

                        </div>
                        <span class="ml-1 duration-300 opacity-100 pointer-events-none ease-soft">Add Spam
                            Phrases</span>
                    </a>
                </li>

                <li class="mt-0.5 w-full">
                    <a class="py-2.7 text-sm ease-nav-brand my-0 mx-4 flex items-center whitespace-nowrap px-4 transition-colors {{ Request::routeIs(['admin.business.claim-requests']) ? 'shadow-soft-xl  rounded-lg bg-white  font-semibold text-slate-700' : '' }}"
                        href="{{ route('admin.business.claim-requests') }}">
                        <div
                            class="{{ Request::routeIs(['admin.business.claim-requests']) ? 'bg-gradient-to-tl from-purple-700 to-pink-500 text-white' : '' }} shadow-soft-2xl mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-white bg-center stroke-0 text-center xl:p-2.5">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-bank" viewBox="0 0 16 16">
                                <path
                                    d="M0 2.5A2.5 2.5 0 0 1 2.5 0h11A2.5 2.5 0 0 1 16 2.5v6.8a.8.8 0 0 1-.8.8H.8a.8.8 0 0 1-.8-.8V2.5z" />
                                <path d="M0 12.7A.8.8 0 0 1 .8 12h14.4a.8.8 0 0 1 .8.7V15H0v-2.3z" />
                            </svg>

                        </div>
                        <span class="ml-1 duration-300 opacity-100 pointer-events-none ease-soft">Claim Requests</span>
                    </a>
                </li>

                <li class="mt-0.5 w-full">
                    <a class="py-2.7 text-sm ease-nav-brand my-0 mx-4 flex items-center whitespace-nowrap rounded-lg  px-4  transition-colors {{ Request::routeIs(['admin.currencies']) ? 'active' : '' }}"
                        href="{{ route('admin.currencies') }}">
                        <div
                            class="{{ Request::routeIs(['admin.currencies']) ? 'bg-gradient-to-tl from-purple-700 to-pink-500' : '' }} shadow-soft-2xl mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-white bg-center stroke-0 text-center xl:p-2.5">
                            <svg width="12px" height="12px" viewBox="0 0 45 40" version="1.1"
                                xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                <title>shop</title>
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <g transform="translate(-1716.000000, -439.000000)" fill="#FFFFFF"
                                        fill-rule="nonzero">
                                        <g transform="translate(1716.000000, 291.000000)">
                                            <g transform="translate(0.000000, 148.000000)">
                                                <path class="fill-slate-800 opacity-60"
                                                    d="M46.7199583,10.7414583 L40.8449583,0.949791667 C40.4909749,0.360605034 39.8540131,0 39.1666667,0 L7.83333333,0 C7.1459869,0 6.50902508,0.360605034 6.15504167,0.949791667 L0.280041667,10.7414583 C0.0969176761,11.0460037 -1.23209662e-05,11.3946378 -1.23209662e-05,11.75 C-0.00758042603,16.0663731 3.48367543,19.5725301 7.80004167,19.5833333 L7.81570833,19.5833333 C9.75003686,19.5882688 11.6168794,18.8726691 13.0522917,17.5760417 C16.0171492,20.2556967 20.5292675,20.2556967 23.494125,17.5760417 C26.4604562,20.2616016 30.9794188,20.2616016 33.94575,17.5760417 C36.2421905,19.6477597 39.5441143,20.1708521 42.3684437,18.9103691 C45.1927731,17.649886 47.0084685,14.8428276 47.0000295,11.75 C47.0000295,11.3946378 46.9030823,11.0460037 46.7199583,10.7414583 Z">
                                                </path>
                                                <path class="fill-slate-800"
                                                    d="M39.198,22.4912623 C37.3776246,22.4928106 35.5817531,22.0149171 33.951625,21.0951667 L33.92225,21.1107282 C31.1430221,22.6838032 27.9255001,22.9318916 24.9844167,21.7998837 C24.4750389,21.605469 23.9777983,21.3722567 23.4960833,21.1018359 L23.4745417,21.1129513 C20.6961809,22.6871153 17.4786145,22.9344611 14.5386667,21.7998837 C14.029926,21.6054643 13.533337,21.3722507 13.0522917,21.1018359 C11.4250962,22.0190609 9.63246555,22.4947009 7.81570833,22.4912623 C7.16510551,22.4842162 6.51607673,22.4173045 5.875,22.2911849 L5.875,44.7220845 C5.875,45.9498589 6.7517757,46.9451667 7.83333333,46.9451667 L19.5833333,46.9451667 L19.5833333,33.6066734 L27.4166667,33.6066734 L27.4166667,46.9451667 L39.1666667,46.9451667 C40.2482243,46.9451667 41.125,45.9498589 41.125,44.7220845 L41.125,22.2822926 C40.4887822,22.4116582 39.8442868,22.4815492 39.198,22.4912623 Z">
                                                </path>
                                            </g>
                                        </g>
                                    </g>
                                </g>
                            </svg>
                        </div>
                        <span class="ml-1 duration-300 opacity-100 pointer-events-none ease-soft">Currency</span>
                    </a>
                </li>

                <li class="mt-0.5 w-full">
                    <a class="py-2.7 text-sm ease-nav-brand my-0 mx-4 flex items-center whitespace-nowrap px-4 transition-colors {{ Request::is('admin/settings*') ? 'shadow-soft-xl  rounded-lg bg-white  font-semibold text-slate-700' : '' }}"
                        href="{{ route('admin.settings') }}">
                        <div
                            class="{{ Request::is('admin/settings*') ? 'bg-gradient-to-tl from-purple-700 to-pink-500 text-white' : '' }} shadow-soft-2xl mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-white bg-center stroke-0 text-center xl:p-2.5">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                fill="currentColor" class="bi bi-gear" viewBox="0 0 16 16">
                                <path
                                    d="M10.88 3.123a6 6 0 0 0-1.302-1.32l-.265-.183a.5.5 0 0 0-.632 0l-.265.183a6 6 0 0 0-1.302 1.32l-.174.308a.5.5 0 0 0 .117.586l.248.217a7.001 7.001 0 0 0 0 1.306l-.248.217a.5.5 0 0 0-.117.586l.174.308a6 6 0 0 0 1.302 1.32l.265.183a.5.5 0 0 0 .632 0l.265-.183a6 6 0 0 0 1.302-1.32l.174-.308a.5.5 0 0 0-.117-.586l-.248-.217a7.001 7.001 0 0 0 0-1.306l.248-.217a.5.5 0 0 0 .117-.586l-.174-.308zm-1.602 2.288a4.5 4.5 0 0 1-.979.992l-.266.183a.5.5 0 0 0-.157.57l.072.202a6.02 6.02 0 0 1-.01 1.35l-.073.207a.5.5 0 0 0 .157.57l.266.183a4.5 4.5 0 0 1 .979.992l.123.218a.5.5 0 0 0 .448.263h.268a6.02 6.02 0 0 1 1.355.01l.269.074a.5.5 0 0 0 .57-.157l.183-.266a4.5 4.5 0 0 1 .992-.979l.218-.123a.5.5 0 0 0 .263-.448v-.268a6.02 6.02 0 0 1-.01-1.355l-.074-.269a.5.5 0 0 0-.157-.57l-.183-.266a4.5 4.5 0 0 1-.992-.979l-.123-.218a.5.5 0 0 0-.263-.153l-.157.054a4.5 4.5 0 0 1-.918-.574l-.163-.14-.163.14a4.5 4.5 0 0 1-.918.574l-.157-.054a.5.5 0 0 0-.263.153z" />
                                <path fill-rule="evenodd"
                                    d="M11.646 2.646a.5.5 0 0 1 0 .708l-.708.708a.5.5 0 0 1-.708-.708l.708-.708a.5.5 0 0 1 .708 0zM4.354 13.354a.5.5 0 0 1 0-.708l.708-.708a.5.5 0 0 1 .708.708l-.708.708a.5.5 0 0 1-.708 0zM2.646 2.646a.5.5 0 0 1 0 .708l-.708.708a.5.5 0 0 1-.708-.708l.708-.708a.5.5 0 0 1 .708 0zM13.354 13.354a.5.5 0 0 1 0-.708l.708-.708a.5.5 0 0 1 .708.708l-.708.708a.5.5 0 0 1-.708 0z" />
                            </svg>

                        </div>
                        <span class="ml-1 duration-300 opacity-100 pointer-events-none ease-soft">Settings</span>
                    </a>
                </li>

                <li class="mt-0.5 w-full">
                    <a class="py-2.7 text-sm ease-nav-brand my-0 mx-4 flex items-center whitespace-nowrap px-4 transition-colors {{ Request::is('admin/disputes*') ? 'shadow-soft-xl  rounded-lg bg-white  font-semibold text-slate-700' : '' }}"
                        href="{{ route('admin.disputes') }}">
                        <div
                            class="{{ Request::is('admin/disputes*') ? 'bg-gradient-to-tl from-purple-700 to-pink-500 text-white' : '' }} shadow-soft-2xl mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-white bg-center stroke-0 text-center xl:p-2.5">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                fill="currentColor" class="bi bi-chat-square-dots" viewBox="0 0 16 16">
                                <path
                                    d="M0 1a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1V1zm8 7.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .5.5h.5a.5.5 0 0 0 .5-.5v-.5zm0-2a.5.5 0 0 0-1 0V7a.5.5 0 0 0 .5.5h.5a.5.5 0 0 0 .5-.5V6zm-3 2.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .5.5h.5a.5.5 0 0 0 .5-.5v-.5zm0-2a.5.5 0 0 0-1 0V7a.5.5 0 0 0 .5.5h.5a.5.5 0 0 0 .5-.5V6zm-3 2.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .5.5h.5a.5.5 0 0 0 .5-.5v-.5zm0-2a.5.5 0 0 0-1 0V7a.5.5 0 0 0 .5.5h.5a.5.5 0 0 0 .5-.5V6z" />
                            </svg>

                        </div>
                        <span class="ml-1 duration-300 opacity-100 pointer-events-none ease-soft">dispute Chats</span>
                    </a>
                </li>

                


                <li class="mt-0.5 w-full">
                    <a class="py-2.7 text-sm ease-nav-brand my-0 mx-4 flex items-center whitespace-nowrap px-4 transition-colors {{ Request::is('admin/reviews*') ? 'shadow-soft-xl  rounded-lg bg-white  font-semibold text-slate-700' : '' }}"
                        href="{{ route('admin.reviews') }}">
                        <div
                            class="{{ Request::is('admin/reviews*') ? 'bg-gradient-to-tl from-purple-700 to-pink-500 text-white' : '' }} shadow-soft-2xl mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-white bg-center stroke-0 text-center xl:p-2.5">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                fill="currentColor" class="bi bi-stars" viewBox="0 0 16 16">
                                <path
                                    d="M4.457 5.471l-1.286.117-.465-1.247a.667.667 0 0 0-1.242 0l-.465 1.247-1.286-.117a.667.667 0 0 0-.369 1.145l1.04.795-.292 1.261a.667.667 0 0 0 .964.703L4 9.864l1.203.757a.667.667 0 0 0 .964-.703l-.292-1.261 1.04-.795a.667.667 0 0 0-.369-1.145zM8 12.942V3.333c0-.242.19-.443.43-.49l3.116-.567L12.16 1.17a.664.664 0 0 1 .327-.173l1.375-.256a.667.667 0 0 1 .788.75l-.22 1.489a.666.666 0 0 0 .254.604l1.195 1.06a.667.667 0 0 1-.39 1.13l-1.533.273-1.077 1.457a.666.666 0 0 0-.124.372l.254 1.494a.667.667 0 0 1-.97.703l-1.564-.832-1.564.832a.667.667 0 0 1-.97-.703l.254-1.494a.666.666 0 0 0-.124-.372l-1.077-1.457-1.533-.273a.667.667 0 0 1-.39-1.13l1.195-1.06a.666.666 0 0 0 .254-.604l-.22-1.489a.667.667 0 0 1 .788-.75l1.375.256a.664.664 0 0 1 .327.173l1.187 1.11 3.116.567a.666.666 0 0 1 .43.49v9.609a.666.666 0 0 1-.666.666H8.667a.666.666 0 0 1-.667-.666z" />
                            </svg>

                        </div>
                        <span class="ml-1 duration-300 opacity-100 pointer-events-none ease-soft">Reviews</span>
                    </a>
                </li>

                <li class="mt-0.5 w-full">
                    <a class="py-2.7 text-sm ease-nav-brand my-0 mx-4 flex items-center whitespace-nowrap px-4 transition-colors {{ Request::is('admin/tags*') ? 'shadow-soft-xl  rounded-lg bg-white  font-semibold text-slate-700' : '' }}"
                        href="{{ route('admin.tags') }}">
                        <div
                            class="{{ Request::is('admin/tags*') ? 'bg-gradient-to-tl from-purple-700 to-pink-500 text-white' : '' }} shadow-soft-2xl mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-white bg-center stroke-0 text-center xl:p-2.5">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-exclamation-triangle" viewBox="0 0 16 16">
                                <path
                                    d="M0 14.12V1a1 1 0 0 1 1.553-.833l14 6.928a1 1 0 0 1 0 1.666l-14 6.928A1 1 0 0 1 0 14.12zM1 13.347V2.653L13.234 8 1 13.347z" />
                                <path
                                    d="M6 10a1 1 0 0 1 2 0v2a1 1 0 1 1-2 0v-2zm0-4a1 1 0 1 1 2 0v2a1 1 0 1 1-2 0V6z" />
                            </svg>

                        </div>
                        <span class="ml-1 duration-300 opacity-100 pointer-events-none ease-soft">Add Tags</span>
                    </a>
                </li>

                <li class="mt-0.5 w-full">
                    <a class="py-2.7 text-sm ease-nav-brand my-0 mx-4 flex items-center whitespace-nowrap px-4 transition-colors {{ Request::is('admin/contacts*') ? 'shadow-soft-xl  rounded-lg bg-white  font-semibold text-slate-700' : '' }}"
                        href="{{ route('admin.contacts') }}">
                        <div
                            class="{{ Request::is('admin/contacts*') ? 'bg-gradient-to-tl from-purple-700 to-pink-500 text-white' : '' }} shadow-soft-2xl mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-white bg-center stroke-0 text-center xl:p-2.5">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                fill="currentColor" class="bi bi-stars" viewBox="0 0 16 16">
                                <path
                                    d="M4.457 5.471l-1.286.117-.465-1.247a.667.667 0 0 0-1.242 0l-.465 1.247-1.286-.117a.667.667 0 0 0-.369 1.145l1.04.795-.292 1.261a.667.667 0 0 0 .964.703L4 9.864l1.203.757a.667.667 0 0 0 .964-.703l-.292-1.261 1.04-.795a.667.667 0 0 0-.369-1.145zM8 12.942V3.333c0-.242.19-.443.43-.49l3.116-.567L12.16 1.17a.664.664 0 0 1 .327-.173l1.375-.256a.667.667 0 0 1 .788.75l-.22 1.489a.666.666 0 0 0 .254.604l1.195 1.06a.667.667 0 0 1-.39 1.13l-1.533.273-1.077 1.457a.666.666 0 0 0-.124.372l.254 1.494a.667.667 0 0 1-.97.703l-1.564-.832-1.564.832a.667.667 0 0 1-.97-.703l.254-1.494a.666.666 0 0 0-.124-.372l-1.077-1.457-1.533-.273a.667.667 0 0 1-.39-1.13l1.195-1.06a.666.666 0 0 0 .254-.604l-.22-1.489a.667.667 0 0 1 .788-.75l1.375.256a.664.664 0 0 1 .327.173l1.187 1.11 3.116.567a.666.666 0 0 1 .43.49v9.609a.666.666 0 0 1-.666.666H8.667a.666.666 0 0 1-.667-.666z" />
                            </svg>

                        </div>
                        <span class="ml-1 duration-300 opacity-100 pointer-events-none ease-soft">Contact Us</span>
                    </a>
                </li>


            </ul>
        </div>

    </aside>

    <!-- end sidenav -->

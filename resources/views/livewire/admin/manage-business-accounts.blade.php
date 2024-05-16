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
<div class="mx-8">
    <div>
        @if (session('success'))
            <x-alerts.success :success="session('success')" />
        @endif

        @if (session('error'))
            <x-alerts.error :error="session('error')" />
        @endif
    </div>

    <div>
        <button wire:click="showModal('addNewBusiness')"
            class="px-4 py-3 mb-2 ml-2 font-bold text-center uppercase align-middle transition-all bg-transparent border border-solid rounded-lg cursor-pointer xl-max:cursor-not-allowed xl-max:opacity-65 xl-max:pointer-events-none xl-max:bg-gradient-to-tl xl-max:from-purple-700 xl-max:to-pink-500 xl-max:text-white xl-max:border-0 hover:scale-102 hover:shadow-soft-xs active:opacity-85 leading-pro text-xs ease-soft-in tracking-tight-soft shadow-soft-md bg-150 bg-x-25 border-fuchsia-500 bg-none text-fuchsia-500 hover:border-fuchsia-500"
            type="button">
            Add New Business Profile
        </button>

        <div
            class="relative flex flex-col w-full min-w-0 mb-0 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
            <div class="p-6 pb-0 mb-0 bg-white rounded-t-2xl">
                <h6>Business Profiles</h6>
            </div>
            <div class="flex items-center md:ml-auto md:pr-4">
                <div class="relative flex flex-wrap items-stretch w-full transition-all rounded-lg ease-soft">
                    <div class="relative">
                        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                            </svg>
                        </div>
                        <input wire:model.live="search" type="search" id="default-search"
                            class="block w-full p-4 focus:ring-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 pl-8.75 text-sm focus:shadow-soft-primary-outline ease-soft relative rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 pr-10 text-gray-700 transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none focus:transition-shadow"
                            placeholder="Search here..." required />
                    </div>
                </div>


                <div class="relative flex flex-wrap items-stretch w-full transition-all rounded-lg ease-soft px-1">
                    <select wire:model = "sortField" wire:change="filterBy($event.target.value)"
                        class="pl-8.75 text-sm focus:shadow-soft-primary-outline ease-soft w-1/100 leading-5.6 relative -ml-px block min-w-0 flex-auto rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 pr-3 text-gray-700 transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none focus:transition-shadow">
                        <option value="">Sort By</option>
                        <option value="is_approved">All Approved</option>
                        <option value="is_verified">All Verified</option>
                    </select>
                </div>
                <div class="relative flex flex-wrap items-stretch w-full transition-all rounded-lg ease-soft px-1">
                    <select wire:model = "filterDate" wire:change="filterDateBy($event.target.value)"
                        class="pl-8.75 text-sm focus:shadow-soft-primary-outline ease-soft w-1/100 leading-5.6 relative -ml-px block min-w-0 flex-auto rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 pr-3 text-gray-700 transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none focus:transition-shadow">
                        <option value="">All Time</option>
                        <option value="1">Last Day</option>
                        <option value="2">Last Week</option>
                        <option value="3">Last Month</option>
                        <option value="4">Last Year</option>
                    </select>
                </div>
            </div>
            <div class="flex-auto px-0 pt-3 pb-2">
                <div class="p-0 overflow-x-auto">
                    <x-admin.table>
                        <x-admin.table.thead>
                            <tr>
                                <th
                                    class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">

                                    <button wire:click="sortBy('businessName')" class="inline-flex items-center"
                                        type="button">
                                        Bussniss name
                                        <x-sort-icon field="businessName" :sortField="$sortField" :sortAsc="$sortAsc" />
                                    </button>
                                </th>

                                <th
                                    class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                    Logo</th>

                                <th
                                    class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                    <button wire:click="sortBy('created_at')" class="inline-flex items-center"
                                        type="button">
                                        Created At
                                        <x-sort-icon field="created_at" :sortField="$sortField" :sortAsc="$sortAsc" />
                                    </button>
                                </th>
                                <th
                                    class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                    Main category</th>
                                <th
                                    class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">

                                    <button wire:click="sortBy('is_verified')" class="inline-flex items-center"
                                        type="button">
                                        Verified
                                        <x-sort-icon field="is_verified" :sortField="$sortField" :sortAsc="$sortAsc" />
                                    </button>
                                </th>
                                <th
                                    class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                    verification Method</th>


                                <th
                                    class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                    Status</th>
                                <th
                                    class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                    Action</th>

                            </tr>
                        </x-admin.table.thead>
                        <tbody>
                            {{-- Parent Foreach --}}
                            @forelse ($businessAccounts as $businessAccount)
                                <tr wire:key="{{ 'manage-business-account' . $businessAccount->id }}">
                                    <td
                                        class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                        <div class="flex px-2 py-1">

                                            <div class="flex flex-col justify-center">
                                                <h6 class="mb-0 leading-normal text-sm">
                                                    {{ Str::limit($businessAccount->businessName, 20, '...') }}

                                                </h6>
                                            </div>
                                        </div>
                                    </td>

                                    <td
                                        class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                        <p class="mb-0 overflow-hidden w-[100px] font-semibold leading-tight text-xs">
                                        <div class="" uk-lightbox="animation: scale">
                                            <div>
                                                </form>
                                                <a class="uk-inline"
                                                    href="{{ asset('storage/' . $businessAccount->business_image) }}"
                                                    data-caption="Caption 1">
                                                    <img src="{{ asset('storage/' . $businessAccount->business_image) }}"
                                                        class="w-20 h-20 object-cover rounded-[6px]" alt="">
                                                </a>
                                            </div>
                                        </div>
                                        </p>
                                    </td>
                                    <td
                                        class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                        {{ $businessAccount->created_at->format('d-m-Y') }}
                                    </td>


                                    <td
                                        class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                        <p class="mb-0 overflow-hidden w-[180px] font-semibold leading-tight text-xs">
                                            {{ Str::limit($businessAccount->category->title, 20, '...') }}

                                        </p>
                                    </td>
                                    <td
                                        class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                        @if ($businessAccount->is_verified)
                                            <span class="text-green-500">✅</span>
                                        @else
                                            <span class="text-red-500">❌</span>
                                        @endif
                                    </td>
                                    <td
                                        class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                        <p class="mb-0 overflow-hidden w-[180px] font-semibold leading-tight text-xs">
                                            {{ Str::limit($businessAccount->verificationMethod->name, 20, '...') }}

                                        </p>
                                    </td>
                                    {{-- create_at --}}

                                    <td
                                        class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                        <button type="button"
                                            wire:click="confirmChangeStatus('{{ $businessAccount->id }}', '{{ $businessAccount->is_approved }}')"
                                            class="text-white bg-gradient-to-r {{ $businessAccount->is_approved ? 'from-green-400 via-green-500 to-green-600 focus:ring-green-300' : 'from-red-400 via-red-500 to-red-600 focus:ring-red-300' }}  hover:bg-gradient-to-br focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">{{ $businessAccount->is_approved ? 'Approved' : 'Not approved' }}</button>

                                    </td>

                                    <td
                                        class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                        <button type="button" wire:click="addFakeReview({{ $businessAccount->id }})"
                                            class="text-white bg-gradient-to-r from-blue-400 via-blue-500 to-blue-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 
                                            font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">Add
                                            Review</button>
                                        <button type="button" wire:click="editAccount({{ $businessAccount->id }})"
                                            class="text-white bg-gradient-to-r from-blue-400 via-blue-500 to-blue-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 
                                            font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">Edit</button>
                                        <button type="button" wire:click="deleteAccount({{ $businessAccount->id }})"
                                            class="text-white bg-gradient-to-r from-red-400 
                                            via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 
                                            font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">Delete</button>
                                        <a href="{{ route('admin.view-business-account', ['business_name' => $businessAccount->businessName]) }}"
                                            type="button"
                                            class="text-white bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">Details</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="py-4 px-6 text-center" colspan="9">
                                        No Record Found
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </x-admin.table>
                    <div class="m-4">
                        {{ $businessAccounts->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>


    @if ($addFakeReviewModal)

        <x-modals.modal wire:model.live="addFakeReviewModal" maxWidth="5xl">
            @slot('headerTitle')
                Add Review In Business Account
            @endslot

            @slot('content')
                <form class="my-5 space-y-6" wire:submit.prevent="StoreFakeReview">
                    <div>
                        <select wire:model="selectedUserId"
                            class="block w-full px-4 py-2 mt-2 text-sm border border-gray-300 rounded-md focus:outline-none focus:border-indigo-500">
                            <option value="">Select User</option>
                            @foreach ($usersWithoutReview as $user)
                                <option value="{{ $user->id }}">{{ $user->name }} (Fake User)</option>
                            @endforeach
                        </select>
                        <x-input-error for="selectedUserId" />

                    </div>
                    <div class="mb-4">
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
                    <x-input-error for="rating" />

                    <div class="my-10 flex justify-center items-center gap-4">
                        <div class="w-full">
                            <label for="interaction" class="text-black font-semibold">
                                Your interaction with this business 10 words
                            </label>
                            <div class="relative">
                                <input wire:model="interactionDetail" id="interaction" type="text"
                                    class="peer w-full rounded-md border border-black bg-transparent px-3 py-2.5 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border  placeholder-shown:border-t-blaborder-black  focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50 focus:border-[#0BA1E5] mt-2 h-[46px]">
                                <x-input-error for="interactionDetail" />
                            </div>
                        </div>
                        <div class="w-full">
                            <label for="interaction-date" class="text-black font-semibold">
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

                    <!-- Register Button -->
                    <button type="submit"
                        class="bg-blue-500 text-white rounded-full py-3 px-6 hover:bg-blue-700 focus:outline-none focus:shadow-outline-blue w-full">
                        Submit
                    </button>

                </form>
            @endslot
        </x-modals.modal>
    @endif

    @if ($addNewBusiness)
        <x-modals.modal wire:model.live="addNewBusiness" maxWidth="5xl">
            @slot('headerTitle')
                {{ $accountId ? 'Edit Business Profile' : 'Add New Business Profile' }}
            @endslot

            @slot('content')
                <form class="my-5 space-y-6" wire:submit.prevent="StoreOrUpdate">
                    <div class="mb-4">
                        <label for="user_id" class="block text-sm font-medium text-gray-600">Select User</label>
                        <select wire:model="associatedUserId" id="user_id" class="mt-1 p-3 w-full border rounded-md">
                            <option value="">Select user</option>
                            @foreach ($users as $user)
                                @php
                                    $displayName = $user->is_hot_bleep ? $user->name . '-hot-bleep' : $user->name;
                                @endphp
                                <option value="{{ $user->id }}" @if ($associatedUserId == $user->id) selected @endif>
                                    {{ $displayName }}</option>
                            @endforeach
                        </select>

                        <x-input-error for="associatedUserId" />
                    </div>
                    <div class="flex mb-4">
                        <div class="mr-2 w-1/2">
                            <label for="firstName" class="block text-sm font-medium text-gray-600">First Name</label>
                            <input wire:model.live="first_name" maxlength="50" type="text" id="firstName"
                                class="mt-1 p-3 w-full border rounded-md">
                            <x-input-error for="first_name" />
                        </div>
                        <div class="ml-2 w-1/2">
                            <label for="lastName" class="block text-sm font-medium text-gray-600">Last Name</label>
                            <input wire:model.live="last_name" maxlength="50" type="text" id="lastName"
                                class="mt-1 p-3 w-full border rounded-md">
                            <x-input-error for="last_name" />
                        </div>
                    </div>

                    <div class="flex mb-4">
                        <div class="mr-2 w-1/2">
                            <label for="username" class="block text-sm font-medium text-gray-600">Username</label>
                            <input type="text" wire:model.live="username" maxlength="100" id="username"
                                class="mt-1 p-3 w-full border rounded-md">
                            <x-input-error for="username" />
                        </div>

                        {{-- need a select filed individual and business --}}
                        <div class="mr-2 w-1/2">
                            <label for="country" class="block text-sm font-medium text-gray-600">Are you an individual or
                                a
                                business</label>
                            <select id="country" class="mt-1 p-3 w-full border rounded-md"
                                wire:model.live="individual_or_business">
                                <option value="individual">Individual</option>
                                <option value="business">Business</option>
                            </select>
                            <x-input-error for="individual_or_business" />
                        </div>
                        <!-- Name Input -->
                        <div class="mr-2 w-1/2">
                            @if ($individual_or_business === 'individual')
                                <label for="businessName" class="block text-sm font-medium text-gray-600">Individual
                                    Name</label>
                            @else
                                <label for="businessName" class="block text-sm font-medium text-gray-600">Company
                                    Name</label>
                            @endif
                            <input type="text" wire:model.live="businessName" maxlength="100" id="businessName"
                                class="mt-1 p-3 w-full border rounded-md">
                            <x-input-error for="businessName" />
                        </div>
                    </div>

                    <div class="flex mb-4">
                        <div class="mr-2 w-1/2">
                            <label for="websiteUrl" class="block text-sm font-medium text-gray-600">Website Url</label>
                            <input type="text" wire:model.live="websiteUrl" maxlength="255" id="websiteUrl"
                                class="mt-1 p-3 w-full border rounded-md">
                            <x-input-error for="websiteUrl" />
                        </div>

                        <!-- Phone Number Input -->
                        <div class="mr-2 w-1/2">
                            <label for="phoneNumber" class="block text-sm font-medium text-gray-600">Phone Number</label>
                            <input type="tel" wire:model.live="phone_number" maxlength="15" id="phoneNumber"
                                class="mt-1 p-3 w-full border rounded-md">
                            <x-input-error for="phone_number" />
                        </div>
                    </div>
                    <!-- Description Input -->
                    <div class="mb-4 " wire:ignore>
                        <label for="description" class="block text-sm font-medium text-gray-600">Description</label>
                        <textarea wire:model.live="description" id="description" rows="5" maxlength="2000" class="mt-1 p-3 w-full border rounded-md"></textarea>
                        <small>Min:5, Max:2000</small>
                    </div>
                    <x-input-error for="description" />




                    <!-- Profile Image Input -->
                    @if ($addNewBusiness)
                        <div class="mb-4">
                            <label for="businessImage" class="block text-sm font-medium text-gray-600">Business
                                Image</label>

                            <x-form.upload-files wire:model.live="businessImage" :previous="$businessImage ?? null" perview
                                allowFileTypes="['image/png', 'image/jpg', 'image/jpeg', 'image/webp']" />
                            <x-input-error for="businessImage" />
                        </div>
                    @endif


                    <div class="flex mb-4">
                        <div class="mr-2 w-1/2">
                            <div wire:ignore>
                                <label for="specialization" class="block text-sm font-medium text-gray-600">
                                    Tags (Write and enter to make tags)
                                </label>
                                <input x-data="{ tagify: null }" x-ref="specialization" x-init="tagify = new Tagify($refs.specialization, {
                                    originalInputValueFormat: valuesArr => valuesArr.map(item => item.value).join(','),
                                    callbacks: {
                                        add: function(tagData) {
                                            @this.set('specialization', tagify.value.map(tag => tag.value).join(','));
                                        },
                                        remove: function(tagData) {
                                            @this.set('specialization', tagify.value.map(tag => tag.value).join(','));
                                        }
                                    }
                                });
                                
                                // Initialize with existing tags
                                tagify.addTags('{{ $this->specialization }}'.split(',').map(tag => ({ value: tag })));"
                                    type="text" id="specialization" class="mt-1 p-2 w-full border rounded-md"
                                    placeholder="Tags (e.g Doctor, Health specialist, Surgeon)">
                            </div>
                            <x-input-error for="specialization" />
                        </div>

                        <!-- Phone Number Input -->
                        <div class="mr-2 w-1/2">
                            <label for="country" class="block text-sm font-medium text-gray-600">Country</label>
                            <select wire:model.live="country_id" id="country"
                                class="mt-1 p-3 w-full border rounded-md">
                                <option value="">Select country</option>
                                @foreach (App\Models\Country::select('id', 'name')->get() as $country)
                                    <option value="{{ $country->id }}">{{ $country->name }}</option>
                                @endforeach
                            </select>
                            <x-input-error for="country_id" />
                        </div>
                    </div>



                    <div class="flex mb-6">
                        <div class="mr-2 w-1/2">
                            <label for="categoryId" class="block text-sm font-medium text-gray-600">Category</label>
                            <select id="categoryId" wire:model.live="category_id"
                                class="mt-1 p-3 w-full border rounded-md">
                                <option value="">Select category</option>
                                @foreach (App\Models\Category::select('id', 'title')->whereNull('parent_id')->get() as $category)
                                    <option value="{{ $category->id }}">{{ $category->title }}</option>
                                @endforeach
                            </select>
                            <x-input-error for="category_id" />
                        </div>
                        @if (count($subCategories) > 0)
                            <div class="ml-2 w-1/2">
                                <label for="subCategoryId" class="block text-sm font-medium text-gray-600">Sub
                                    Category</label>
                                <select id="subCategoryId" wire:model.live="sub_category_id"
                                    class="mt-1 p-3 w-full border rounded-md">
                                    <option value="">Select category</option>
                                    @foreach ($subCategories as $subCategory)
                                        <option value="{{ $subCategory->id }}"
                                            @if ($sub_category_id == $subCategory->id) selected @endif>{{ $subCategory->title }}
                                        </option>
                                    @endforeach
                                </select>

                                <x-input-error for="sub_category_id" />
                            </div>
                        @endif
                    </div>

                    <div class="mb-4">
                        <label for="verification_option" class="block text-sm font-medium text-gray-600">Business
                            Verification</label>
                        <select wire:model="verification_option" wire:change="handleVerificationOptionChange"
                            id="verification_option" class="mt-1 p-3 w-full border rounded-md">
                            <option value="">Select verification option</option>
                            @foreach (App\Models\VerificationMethod::all() as $method)
                                <option value="{{ $method->id }}">{{ $method->name }}</option>
                            @endforeach
                        </select>
                        <x-input-error for="verification_option" />
                    </div>

                    @if ($default_response)
                        <div class="mb-4">
                            <p>{!! $default_response !!}</p>
                        </div>
                    @endif


                    <!-- Register Button -->
                    <button type="submit"
                        class="bg-blue-500 text-white rounded-full py-3 px-6 hover:bg-blue-700 focus:outline-none focus:shadow-outline-blue w-full">
                        Submit
                    </button>

                </form>
            @endslot
        </x-modals.modal>
    @endif

    {{-- Delete Confirmation Modal --}}
    <x-modals.delete-alert message="You are going to delete this account" />
    <x-modals.change-status-modal
        message="You are going to {{ $statusChangeInfo['status'] ? 'approve' : 'disapprove' }} business account status" />


</div>

@push('scripts')
    <script src="https://unpkg.com/@yaireo/tagify"></script>
    <script src="https://unpkg.com/@yaireo/tagify/dist/tagify.polyfills.min.js"></script>
    <script>
        var input = document.getElementById('specialization');
        new Tagify(input);
    </script>
    <script>
        let editorOptions = {
            height: '250px',
            tabSpaces: 4,
            removePlugins: 'forms,smiley,iframe,link,div,save'
        };


        // window.addEventListener('initEditor', event => {
        //     function findReplyMessageId() {
        //         const replyMessageId = document.getElementById('description');

        //         if (replyMessageId) {
        //             clearInterval(replyMessageIdInterval);
        //             const editorM = CKEDITOR.replace('description', editorOptions);
        //             editorM.on('change', function(event) {
        //                 @this.set('description', event.editor.getData());
        //             });

        //             window.addEventListener('updateCkEditorBodyBusiness', event => {
        //                 let changedVal = @this.get('description');

        //                 editorM.setData(changedVal);
        //             });
        //         }
        //     }

        //     const replyMessageIdInterval = setInterval(findReplyMessageId, 200);
        // });


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
    </script>
@endpush

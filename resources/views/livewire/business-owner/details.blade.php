<div>
    <div class=" relative p-[41px_31px_0px_31px]">

        <x-hero-section title="My Business" body="Business details will  be shown here." />
        @if (session()->has('message'))
            <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)"
                class="animate-bounce text-center text-green-500 mt-4">
                {{ session('message') }}
            </div>
        @endif

        @if (session('success'))
            <x-alerts.success :success="session('success')" />
        @endif

        @if (session('error'))
            <x-alerts.error :error="session('error')" />
        @endif

        <div class="mt-[36px]">
            <div class="w-full mx-auto ">
                <div class="p-4 sm:p-6 animate__animated animate__backInUp">
                    <div class="flex justify-end flex-wrap-reverse gap-y-10 items-center mb-9">
                        {{-- <h1 class="hidden text-[34px] text-[#5C5C5C]  leading-[40px] font-semibold">All Recipients</h1> --}}
                        {{-- <div class="w-full max-w-[320px]">
                            <label for="default-search"
                                class="mb-2 text-sm font-medium text-gray-900 sr-only drk:text-white">Search</label>
                            <div class="relative ">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <svg aria-hidden="true" class="w-5 h-5 text-gray-500 drk:text-gray-400"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                    </svg>
                                </div>
                                <input type="search" wire:model="search" id="default-search"
                                    class="block w-full p-4 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-[#EAB6E5] focus:border-[#EAB6E5] drk:bg-gray-700 drk:border-gray-600 drk:placeholder-gray-400 drk:text-white drk:focus:ring-blue-500 drk:focus:border-blue-500"
                                    placeholder="Search by name or email" required>
                                <button type="button" wire:click="searchRecipient"
                                    class="text-white absolute right-2.5 bottom-2.5 bg-[#BA39BB] focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 ">Search</button>
                            </div>
                        </div> --}}
                    </div>

                    <div class="">
                        <div class="max-w-full mx-auto bg-white p-8 shadow-md mt-16">

                            <!-- Display business details here -->
                            <div id="businessDetails">
                                <div class="mb-4 flex justify-between items-center">
                                    <h2 class="text-2xl font-semibold">Business Details</h2>

                                    <div class="flex gap-4">
                                        @if ($user->businessAccount->is_approved && $user->businessAccount->is_verified)
                                            <a href="{{ route('front.business.show', ['business_name' => $user->businessAccount->businessName]) }}"
                                                class="align-middle select-none font-medium text-center transition-all disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none py-3 px-6 rounded-lg bg-gray-900 text-white shadow-md shadow-gray-900/10 hover:shadow-lg hover:shadow-gray-900/20 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none hidden md:block"
                                                type="button" data-ripple-light="true">
                                                View Business
                                            </a>
                                        @endif

                                        <button type="button" wire:click="openEditDetailsModal"
                                            class="w-max text-white bg-[#A581F9] hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-[#A581F9] font-normal rounded-lg text-[16px] px-5 py-3.5 text-center">Edit
                                            Details</button>
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2">

                                    <p class="mb-2"><span class="font-semibold">User Name: </span>
                                        {{ $user->businessAccount->username }}</p>
                                    <p class="mb-4"><span class="font-semibold">Email: </span> {{ $user->email }}</p>
                                    <p class="mb-4"><span class="font-semibold">Company: </span>
                                        {{ $user->businessAccount->businessName }}</p>
                                    <p class="mb-4"><span class="font-semibold">Phone Number: </span>
                                        {{ $user->businessAccount->phone_number }}</p>
                                    <p class="mb-4">
                                        <span class="font-semibold">Category: </span>
                                        <a href="{{ route('front.business.show', ['business_name' => $user->businessAccount->category->title]) }}"
                                            class="cursor-pointer hover:underline">
                                            {{ $user->businessAccount->category->title }}
                                        </a>
                                    </p>
                                    <p class="mb-4">
                                        <span class="font-semibold">Sub-Category: </span>
                                        @if ($user->businessAccount->subCategory)
                                            <a href="{{ route('front.business.show', ['business_name' => $user->businessAccount->subCategory->title]) }}"
                                                class="cursor-pointer hover:underline">
                                                {{ $user->businessAccount->subCategory->title }}
                                            </a>
                                        @else
                                            Null
                                        @endif
                                    </p>
                                    <p class="mb-4">
                                        <span class="font-semibold">Status: </span>
                                        <span
                                            class="{{ $user->businessAccount->is_approved ? 'text-green-500' : 'text-red-500' }}">{{ $user->businessAccount->is_approved ? 'Approved' : 'Not Approved' }}</span>
                                    </p>
                                    <p class="mb-4"><span class="font-semibold">Status: </span>
                                        <span
                                            class="{{ $user->businessAccount->is_verified ? 'text-green-500' : 'text-red-500' }}">{{ $user->businessAccount->is_verified ? 'Verified' : 'Not Verified' }}</span>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="max-w-full mx-auto bg-white p-8 shadow-md mt-16">
                            <!-- Display business details here -->
                            <div id="businessDetails">
                                <div class="mb-4 flex justify-between items-center">
                                    <h2 class="text-2xl font-semibold">Verification Method</h2>
                                </div>

                                <div class="">
                                    <p class="mb-4">
                                        <span class="font-medium">Method Name:</span>
                                        {{ Auth::user()->businessAccount->verificationMethod->name }}
                                    </p>
                                    <div class="">
                                        <span class="font-medium">Method Description:</span> {!! Auth::user()->businessAccount->verificationMethod->field_text !!}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="max-w-full mx-auto bg-white p-8 shadow-md mt-16">
                            <h2 class="text-2xl font-semibold mb-2">Verification Status</h2>
                            @if (session('successVerification'))
                                <x-alerts.success :success="session('successVerification')" />
                            @endif
                            <div class="flex justify-end items-center space-x-4">
                                @if ($user->has_business_account)
                                    @if ($user->verificationRequest()->get()->isNotEmpty())
                                        <span
                                            class=" {{ \App\Enums\VerificationStatus::Pending->value == $user->verificationRequest->status ? 'text-[#A581F9]' : (\App\Enums\VerificationStatus::Verified->value == $user->verificationRequest->status ? 'text-green-500' : 'text-orange-500') }} inline-flex items-center font-medium text-sm px-4 py-2 mr-2 mb-2 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-300">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M5 13l4 4L19 7"></path>
                                            </svg>
                                            {{ str_replace('_', ' ', $user->verificationRequest->status) }}
                                        </span>

                                        <button type="button" wire:click="showResponseModal"
                                            class="w-max text-white bg-[#A581F9] hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-[#A581F9] font-normal rounded-lg text-[16px] px-5 py-3.5 text-center">Send
                                            Response</button>
                                    @endif

                                    @if ($user->verificationRequest()->get()->isEmpty())
                                        <button type="button" wire:click="sendVerificationRequestToAdmin"
                                            class="w-max text-white bg-[#A581F9] hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-[#A581F9] font-normal rounded-lg text-[16px] px-5 py-3.5 text-center">Send
                                            verification request to admin</button>
                                    @endif
                                @endif
                            </div>


                            <div class="overflow-x-auto md:overflow-visible relative sm:rounded-lg">
                                <table
                                    class="w-full text-sm text-left text-gray-500 drk:text-gray-400 border-separate border-spacing-y-3">
                                    <thead
                                        class="text-base text-[#707176] bg-[#F4F6FC] rounded-[10px] drk:bg-gray-700 drk:text-gray-400  ">
                                        <tr class="">

                                            <th scope="col" class="py-6 px-6 font-normal ">
                                                Name
                                            </th>
                                            <th scope="col" width="60%" class="py-6 px-6 font-normal">
                                                Detail
                                            </th>
                                            <th scope="col" class="py-6 px-6 font-normal">
                                                Date
                                            </th>
                                            <th scope="col"
                                                class="py-6 px-6 rounded-tr-[10px] rounded-br-[10px] font-normal">
                                                Actions
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (!empty($user?->verificationRequest?->response))

                                            @foreach ($user->verificationRequest->response()->latest()->get() as $response)
                                                <tr class=" drk:bg-gray-800 drk:border-gray-700  rounded-[10px] drk:hover:bg-gray-600 overflow-hidden transition-all duration-300"
                                                    style="box-shadow: rgba(0, 0, 0, 0.1) 0px 4px 12px;">

                                                    <th scope="row"
                                                        class=" marker:rounded-tl-[10px] rounded-bl-[10px] py-6 px-6 font-medium whitespace-nowrap drk:text-white flex items-center flex-wrap gap-x-3">
                                                        {{-- <img src="./images/Clip.png" alt=""> --}}
                                                        <p class="relative mt-[10px] lg:mt-0 pt-1">
                                                            {{ $response->user->name }}
                                                            @if ($response->user->is_admin)
                                                                <span
                                                                    class="absolute -top-6 -left-5  inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-800/30 dark:text-blue-500">
                                                                    <span
                                                                        class="w-1 h-1 inline-block rounded-full bg-blue-800 dark:bg-blue-500"></span>
                                                                        theHotBleep
                                                                </span>
                                                            @endif
                                                        </p>
                                                    </th>

                                                    <td class="py-6 px-6">
                                                        {!! $response->response !!}
                                                    </td>

                                                    <td class="py-6 px-6">
                                                        {!! $response->created_at !!}
                                                    </td>

                                                    <td class="flex py-6 px-6 rounded-tr-[10px] rounded-br-[10px]">
                                                        @if (Auth::user()->id == $response->user_id)
                                                            <button title="edit"
                                                                wire:click="showResponseModal('{{ $response->id }}')"
                                                                class="font-medium text-[#17AFF3]  drk:text-[#17AFF3] hover:underline"><svg
                                                                    class="w-6 h-6" fill="none"
                                                                    stroke="currentColor" viewBox="0 0 24 24"
                                                                    xmlns="http://www.w3.org/2000/svg">
                                                                    <path stroke-linecap="round"
                                                                        stroke-linejoin="round" stroke-width="2"
                                                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                                                    </path>
                                                                </svg></button>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr class="w-full bg-gray-200 text-center">
                                                <td colspan="5">
                                                    <p class="font-medium py-4">No Record Found</p>
                                                </td>
                                            </tr>
                                        @endif


                                    </tbody>
                                </table>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>



    @if ($editBusinessDetailsModal)
        <x-modals.modal wire:model.live="editBusinessDetailsModal" maxWidth="3xl">
            @slot('content')
                <div class="py-6 px-6 lg:px-8">
                    <div class="text-center">
                        <h3 class="mb-4 text-[20px] font-light  drk:text-white">You can edit only limited
                            fields for your business</h3>
                        <div class="relative mx-auto bg-cover bg-no-repeat w-[80px] h-[80px] rounded-full flex justify-center items-center before:absolute before:content-[''] before:bg-black before:bg-opacity-20 before:top-0 before:left-0 before:bottom-0 before:right-0 before:rounded-full before:z[-1]"
                            style="background-image: url({{ asset('images/event-slider-img.svg') }})">
                            <img src="{{ asset('images/edit-profile-logo.svg') }}" class="relative z-10 cursor-pointer"
                                alt="">
                        </div>
                    </div>
                    <form wire:submit.prevent="updateDetails" class="space-y-6 mt-7">
                        <div>
                            <label class='relative'>
                                <x-form.upload-files wire:model.live="businessImage" :previous="$previousImage" perview allowFileTypes="['image/png', 'image/jpg', 'image/jpeg', 'image/webp']" 
                                    class='bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#A581F9] focus:border-[#A581F9] block w-full p-2.5 drk:bg-gray-600 drk:border-gray-500 drk:placeholder-gray-400 drk:text-white material-ui-inputs transition duration-200' />
                                <span
                                    class='text-sm text-gray-400 bg-white absolute left-[10px] -top-[10px] px-1 transition duration-200 input-text hover:cursor-text'>Business
                                    Image</span>
                            </label>
                            <x-input-error for="businessImage" />
                        </div>
                        <div>
                            <label class='relative'>
                                <textarea wire:model="description" rows="10" placeholder="description"
                                    class='bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#A581F9] focus:border-[#A581F9] block w-full p-2.5 drk:bg-gray-600 drk:border-gray-500 drk:placeholder-gray-400 drk:text-white material-ui-inputs transition duration-200'></textarea>
                                <span
                                    class='text-sm text-gray-400 bg-white absolute left-[10px] -top-[10px] px-1 transition duration-200 input-text hover:cursor-text'>Description</span>

                            </label>
                            <x-input-error for="description" />
                        </div>

                        <button type="submit"
                            class="w-full text-white bg-[#A581F9] hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-[#A581F9] font-normal rounded-lg text-[16px] px-5 py-3.5 text-center">Update</button>

                    </form>
                </div>
            @endslot
        </x-modals.modal>
    @endif


    <x-modals.modal wire:model.live="responseModal" maxWidth="3xl">
        @slot('headerTitle')
            {{ $isEditResponse ? 'Edit' : 'Send' }} response
        @endslot

        @slot('content')
            <div class="py-6 px-6 lg:px-8">
                <form wire:submit.prevent="sendResponse" class="space-y-6 mt-7">
                    <div wire:ignore>
                        <label class='relative'>
                            <textarea wire:model="responseMessage" id="responseMessage"
                                class='bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#A581F9] focus:border-[#A581F9] block w-full p-2.5 drk:bg-gray-600 drk:border-gray-500 drk:placeholder-gray-400 drk:text-white material-ui-inputs transition duration-200'></textarea>
                            <span
                                class='text-sm text-gray-400 bg-white absolute left-[10px] -top-[10px] px-1 transition duration-200 input-text hover:cursor-text'>Description</span>
                        </label>
                    </div>
                    <x-input-error for="responseMessage" />

                    <button type="submit"
                        class="w-full text-white bg-[#A581F9] hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-[#A581F9] font-normal rounded-lg text-[16px] px-5 py-3.5 text-center">{{ $isEditResponse ? 'Update' : 'Send' }}</button>

                </form>
            </div>
        @endslot
    </x-modals.modal>
</div>

@push('scripts')
    <script>
        let editorOptions = {
            height: '250px',
            tabSpaces: 4,
            removePlugins: 'forms,smiley,iframe,link,div,save'
        };

        const editorC = CKEDITOR.replace('responseMessage', editorOptions);
        editorC.on('change', function(event) {
            @this.set('responseMessage', event.editor.getData());
        });

        window.addEventListener('updateCkEditorBody', event => {
            let changedVal = @this.get('responseMessage');
            console.log(changedVal);

            editorC.setData(changedVal);
        });
    </script>
@endpush

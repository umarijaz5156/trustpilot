<div>


    <div class="container mx-auto px-4 py-8">
        @if ($businessAccount->is_approved)
        <div class="m-4">
            <a href="{{ route('front.business.show', ['business_name' => $businessAccount->businessName]) }}"
                type="button"
                class="text-white bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
                View Business</a>
            </div>
        @endif

        <div class=" mx-auto bg-white shadow-xl rounded-lg overflow-hidden">
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Business Information -->
                    <div class="space-y-4">
                        <!-- Business Name -->
                        <div>
                            <p class="text-gray-600">Business Name:</p>
                            <p>{{ $businessAccount->businessName }}</p>
                        </div>

                        <!-- Business Type -->
                        <div>
                            <p class="text-gray-600">Business Type:</p>
                            <p>{{ $businessAccount->individual_or_business }}</p>
                        </div>

                        <!-- Website URL -->
                        <div>
                            <p class="text-gray-600">Website URL:</p>
                            <p>{{ $businessAccount->websiteUrl }}</p>
                        </div>

                        <!-- Phone Number -->
                        <div>
                            <p class="text-gray-600">Phone Number:</p>
                            <p>{{ $businessAccount->phone_number }}</p>
                        </div>

                        <!-- Country -->
                        <div>
                            <p class="text-gray-600">Country:</p>
                            <p>{{ optional($businessAccount->country)->name ?? 'Not found' }}</p>
                        </div>

                        <!-- Category -->
                        <div>
                            <p class="text-gray-600">Category:</p>
                            <p>{{ optional($businessAccount->category)->title ?? 'Category not found' }}</p>
                        </div>

                        <!-- Sub Category -->
                        <div>
                            <p class="text-gray-600">Sub Category:</p>
                            <p>{{ optional($businessAccount->subCategory)->title ?? 'Sub Category not found' }}</p>
                        </div>

                        <!-- Specialization -->
                        <div class="col-span-full">
                            <p class="text-gray-600">Specialization:</p>
                            <p>{{ $businessAccount->specialization }}</p>
                        </div>

                        <!-- Verification Option -->
                        <div class="col-span-full">
                            <p class="text-gray-600">Verification Option:</p>
                            @if ($verificationOption = $businessAccount->verificationMethod)
                                <b>{{ $verificationOption->name }}</b>
                                <p>{!! $verificationOption->default_response !!}</p>
                            @else
                                <p>Not found</p>
                            @endif
                        </div>
                    </div>

                    <!-- Business Status and Image -->
                    <div class="space-y-4">
                        <!-- Business Status -->
                        <div>
                            <p class="text-gray-600">Status:</p>
                            <div>
                                <p>Verified:
                                    @if ($businessAccount->is_verified)
                                        <span class="text-green-500">Yes</span>
                                    @else
                                        <span class="text-red-500">No</span>
                                    @endif
                                </p>
                                <p>Approved:
                                    @if ($businessAccount->is_approved)
                                        <span class="text-green-500">Yes</span>
                                    @else
                                        <span class="text-red-500">No</span>
                                    @endif
                                </p>
                            </div>
                        </div>

                        <!-- Business Image -->
                        <div class="col-span-full">
                            <p class="text-gray-600">Business Image:</p>
                            <div uk-lightbox="animation: scale">
                                <a class="uk-inline" href="{{ asset('storage/' . $businessAccount->business_image) }}"
                                    data-caption="Caption 1">
                                    <img style="height: 200px"
                                        src="{{ asset('storage/' . $businessAccount->business_image) }}"
                                        class="object-cover rounded-[6px]" alt="">
                                </a>
                            </div>
                        </div>

                        <!-- Description -->
                        <div class="col-span-full">
                            <p class="text-gray-600">Description:</p>
                            <p>{!! $businessAccount->description !!}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div>
                @if (session('success'))
                    <x-alerts.success :success="session('success')" />
                @endif

                @if (session('error'))
                    <x-alerts.error :error="session('error')" />
                @endif
            </div>


            <div class="p-6">
                <div class="flex justify-between items-center">
                    @if (!$verificationRequest)
                        <p class="text-gray-600">Send verification request to the user to verify their account.</p>
                        <button wire:click="verifyBusinessAccount"
                            class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                            Send Verification Request
                        </button>
                    @else
                        <div class="flex justify-between items-center w-full">
                            <p class="text-gray-600 flex-grow">Send verification response message to the user for their
                                account.</p>

                            <div>
                                <span
                                    class="inline-flex items-center font-medium text-sm px-4 py-2 mr-2 mb-2 
                                @if ($verificationRequest->status === 'verified') text-green-500
                                @elseif ($verificationRequest->status === 'need more info') text-yellow-500
                                @else text-blue-500 @endif
                                focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-300">
                                    @if ($verificationRequest->status === 'verified')
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        Verified
                                    @elseif ($verificationRequest->status === 'need more info')
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        Need More Info
                                    @else
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        Pending
                                    @endif
                                </span>

                                <button wire:click="replyResponse"
                                    class="text-white bg-gradient-to-r from-blue-400 via-blue-500 to-blue-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
                                    Need Information</button>
                                <button type="button"
                                    wire:click="confirmChangeStatus('{{ $businessAccount->id }}', '{{ $businessAccount->is_verified }}')"
                                    class="text-white bg-gradient-to-r {{ $businessAccount->is_verified ? 'from-green-400 via-green-500 to-green-600 focus:ring-green-300' : 'from-red-400 via-red-500 to-red-600 focus:ring-red-300' }}  hover:bg-gradient-to-br focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">{{ $businessAccount->is_verified ? 'Verified' : 'Not Verified' }}
                                </button>
                                <button type="button"
                                    wire:click="confirmChangeStatusApproved('{{ $businessAccount->id }}', '{{ $businessAccount->is_approved }}')"
                                    class="text-white bg-gradient-to-r {{ $businessAccount->is_approved ? 'from-green-400 via-green-500 to-green-600 focus:ring-green-300' : 'from-red-400 via-red-500 to-red-600 focus:ring-red-300' }}  hover:bg-gradient-to-br focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">{{ $businessAccount->is_approved ? 'Approved' : 'Not approved' }}
                                </button>

                            </div>
                        </div>
                    @endif
                </div>


                <div class="flex-auto px-0 pt-0 pb-2">
                    <div class="p-0 overflow-x-auto">
                        <x-admin.table>
                            <x-admin.table.thead>
                                <tr>
                                    <th
                                        class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                        User Name</th>
                                    <th
                                        class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                        Response</th>
                                    <th
                                        class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                        Date</th>
                                    <th
                                        class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                        Action</th>

                                </tr>
                            </x-admin.table.thead>
                            <tbody>
                                @forelse ($verificationResponse as $response)
                                    <tr>
                                        <x-admin.table.cell>
                                            <p class="relative mb-0 w-[180px] font-semibold leading-tight text-xs py-1">
                                                {{ $response->user->name }}

                                                @if ($response->user->is_admin)
                                                    <span
                                                        class="absolute -top-6 -left-2 inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-normal bg-blue-100 text-blue-800 dark:bg-blue-800/30 dark:text-blue-500">
                                                        <span
                                                            class="w-1 h-1 inline-block rounded-full bg-blue-800 dark:bg-blue-500"></span>
                                                            theHotBleep
                                                    </span>
                                                @endif
                                            </p>
                                        </x-admin.table.cell>

                                        <x-admin.table.cell>
                                            <p
                                                class="mb-0 overflow-hidden w-[180px] font-semibold leading-tight text-xs">
                                                {!! Str::limit($response->response, 50, '...') !!}
                                            </p>
                                        </x-admin.table.cell>

                                        <x-admin.table.cell>
                                            <p
                                                class="mb-0 overflow-hidden w-[180px] font-semibold leading-tight text-xs">
                                                {{ $response->created_at->format('Y-m-d') }}
                                            </p>
                                        </x-admin.table.cell>


                                        <x-admin.table.cell>
                                            <button type="button" wire:click="viewResponse({{ $response->id }})"
                                                class="text-white bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">View</button>
                                            @if ($response->user_id == auth()->user()->id)
                                                <button wire:click="replyResponse({{ $response->id }})"
                                                    class="text-white bg-gradient-to-r from-blue-400 via-blue-500 to-blue-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">Edit</button>
                                            @endif
                                        </x-admin.table.cell>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="py-4 px-6 text-center" colspan="5">
                                            No Record Found
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </x-admin.table>
                        @if ($verificationResponse)
                            <div class="mt-4">
                                {{ $verificationResponse->links() }}
                            </div>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>


    @if ($changeVerifiedModal)
        <x-modals.change-verified-modal
            message="You are going to {{ $verifiedChangeInfo['status'] ? 'Verified' : 'Not Verified' }} business account status" />
    @endif

    @if ($changeStatusModal)
        <x-modals.change-status-modal
            message="You are going to {{ $statusChangeInfo['status'] ? 'Approved' : 'Not Approved' }} business account status" />
    @endif


    @if ($viewResponseModel)
        <x-modals.modal wire:model.live="viewResponseModel" maxWidth="5xl">
            @slot('headerTitle')
                Verification Method
            @endslot

            @slot('content')
                <div class="my-5 space-y-6">
                    <div class="flex mb-4">
                        <div class="mr-2 w-1/2">
                            <label for="name" class="block text-sm font-medium text-gray-600">Name</label>
                            <span class="mt-1  w-full rounded-md">{{ $verificationResponseById->user->name }}</span>
                        </div>
                        <div class="ml-2 w-1/1">
                            <label for="field_text" class="block text-sm font-medium text-gray-600">Response</label>
                            <span class="mt-1  w-full  rounded-md">{!! $verificationResponseById->response !!}</span>
                        </div>
                    </div>

                </div>
            @endslot
        </x-modals.modal>
    @endif

    @if ($replyResponseModal)
        <x-modals.modal wire:model.live="replyResponseModal" maxWidth="5xl">
            @slot('headerTitle')
                Reply
            @endslot

            @slot('content')
                <form class="my-5 space-y-6" wire:submit.prevent="StoreOrUpdate">

                    <div class="mb-4 " wire:ignore>
                        <label for="description" class="block text-sm font-medium text-gray-600">Description</label>
                        <textarea id="description" maxlength="1000" class="mt-1 p-3 w-full border rounded-md"></textarea>
                        <x-input-error for="description" />
                    </div>

                    <div class="mb-4">
                        <label for="status" class="block text-sm font-medium text-gray-600">Status</label>
                        <div class="relative ml-2">
                            <select wire:model="status" id="status" name="status"
                                class="block appearance-none w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                <option value="verified">Verified
                                </option>
                                <option value="pending">Pending</option>
                                <option value="need more info" selected>Need More
                                    Info</option>
                            </select>
                        </div>
                        <x-input-error for="status" />
                    </div>


                    <button type="submit"
                        class="bg-blue-500 text-white rounded-full py-3 px-6 hover:bg-blue-700 focus:outline-none focus:shadow-outline-blue w-full">
                        Submit
                    </button>

                </form>
            @endslot
        </x-modals.modal>
    @endif
</div>

@push('scripts')
    <script>
        let editorOptions = {
            height: '250px',
            tabSpaces: 4,
            removePlugins: 'forms,smiley,iframe,link,div,save'
        };

        window.addEventListener('initDescriptionEditor', event => {
            function findDescriptionId() {
                const descriptionId = document.getElementById('description');
                if (descriptionId) {
                    clearInterval(descriptionIdInterval);

                    const editorC = CKEDITOR.replace('description', editorOptions);
                    editorC.on('change', function(event) {
                        @this.set('description', event.editor.getData());
                    });
                    // CKEDITOR.replace('description');

                    window.addEventListener('updateCkEditorBodyRes', event => {
                        let changedVal = @this.get('description');
                        console.log(changedVal);

                        editorC.setData(changedVal);
                    });

                    const updateEvent = new Event('updateCkEditorBodyRes');
                    window.dispatchEvent(updateEvent);
                }

            }

            const descriptionIdInterval = setInterval(findDescriptionId, 100);
        });
    </script>
@endpush

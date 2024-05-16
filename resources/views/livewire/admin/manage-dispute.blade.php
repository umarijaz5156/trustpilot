<div>
    <div>
        @if (session('success'))
            <x-alerts.success :success="session('success')" />
        @endif

        @if (session('error'))
            <x-alerts.error :error="session('error')" />
        @endif
    </div>

    <div>

        <div
            class="relative flex flex-col w-full min-w-0 mb-0 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
            <div class="p-6 pb-0 mb-0 bg-white rounded-t-2xl">
                <h6>Tickets</h6>
            </div>
            <div class="flex-auto px-0 pt-0 pb-2">
                <div class="p-0 overflow-x-auto">
                    <x-admin.table>
                        <x-admin.table.thead>
                            <tr>
                                <th
                                    class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                    Description</th>
                                <th
                                    class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                    Reviewer</th>
                                <th
                                    class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                    Business Name</th>
                                <th
                                    class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                    View Business</th>
                                <th
                                    class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                    Status</th>

                                <th
                                    class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap  ">
                                    Review Status</th>
                                <th
                                    class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                    Action</th>

                            </tr>
                        </x-admin.table.thead>
                        <tbody>
                            {{-- Parent Foreach --}}
                            @forelse ($tickets as $ticket)
                                <tr>
                                    <x-admin.table.cell>
                                        <div class="flex px-2 py-1">

                                            <div class="flex flex-col justify-center">
                                                <h6 class="mb-0 leading-normal text-sm">
                                                    {{ Str::limit($ticket->description, 100, '...') }}
                                                </h6>
                                            </div>
                                        </div>
                                    </x-admin.table.cell>
                                    <x-admin.table.cell>

                                        <p>
                                            {{ $ticket->review->user->name }}
                                        </p>

                                    </x-admin.table.cell>
                                    <x-admin.table.cell>
                                        <p>
                                            <a href="{{ route('admin.view-business-account', ['business_name' => $ticket->review->businessAccount->businessName]) }}"
                                                class="text-blue-500 bg-gradient-to-r  focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5  mr-2 mb-2">
                                                {{ $ticket->review->businessAccount->businessName }}
                                            </a>
                                        </p>
                                    </x-admin.table.cell>
                                    <x-admin.table.cell>
                                        <a href="{{ route('front.business.show', ['business_name' => $ticket->review->businessAccount->businessName]) }}"
                                            type="button"
                                            class="text-white bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
                                            Business</a>
                                    </x-admin.table.cell>


                                    <x-admin.table.cell>
                                        <button type="button"
                                            @if ($ticket->ticket_status === 'closed') disabled
                                            @else
                                                wire:click="changeTicketStatus('{{ $ticket->id }}', '{{ $ticket->ticket_status }}')" @endif
                                            class="text-white bg-gradient-to-r {{ $ticket->ticket_status === 'closed' ? 'from-green-400 via-green-500 to-green-600 focus:ring-green-300' : 'from-red-400 via-red-500 to-red-600 focus:ring-red-300' }}  hover:bg-gradient-to-br focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
                                            {{ $ticket->ticket_status === 'closed' ? 'Closed' : 'Pending' }}
                                        </button>
                                    </x-admin.table.cell>



                                    <x-admin.table.cell>
                                        <button type="button"
                                            wire:click="confirmChangeStatusApproved('{{ $ticket->review->id }}', '{{ $ticket->review->is_approved }}', '{{ $ticket->id }}')"
                                            class="text-white bg-gradient-to-r {{ $ticket->review->is_approved ? 'from-green-400 via-green-500 to-green-600 focus:ring-green-300' : 'from-red-400 via-red-500 to-red-600 focus:ring-red-300' }}  hover:bg-gradient-to-br focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">{{ $ticket->review->is_approved ? 'Approved' : 'Not approved' }}
                                        </button>

                                    </x-admin.table.cell>



                                    <x-admin.table.cell>

                                        <a href="{{ route('admin.disputes', ['id' => $ticket->id]) }}"
                                            class="text-white bg-gradient-to-r from-gray-400 via-gray-500 to-gray-600 hover:bg-gradient-to-br
                                             focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 
                                             py-2.5 text-center hover:text-white mr-2 mb-2">Dispute
                                            Chat</a>
                                        <button wire:click="viewDispute({{ $ticket->id }})" type="button"
                                            class="text-white bg-gradient-to-r from-blue-400 via-blue-500 to-blue-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">Details</button>

                                    </x-admin.table.cell>
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
                    {{ $tickets->links() }}
                </div>
            </div>
        </div>
    </div>




    @if ($viewDisputeModel)
        <x-modals.modal wire:model.live="viewDisputeModel" maxWidth="5xl">
            @slot('headerTitle')
                View Dispute Details
            @endslot
            @slot('content')
                <div class="my-5 space-y-6">
                    <!-- Section 1: Dispute Description, Status, and Attachments -->
                    <div class="mb-8">
                        <h2 class="text-lg text-blue-500 font-semibold mb-2">Dispute Details:</h2>
                        <!-- Description -->
                        <div class="mb-4">
                            <h3 class="text-base font-semibold mb-1">Description:</h3>
                            <p>{{ $ticket_description }}</p>
                        </div>
                        <!-- Attachments -->
                        <div class="mb-4">
                            <h3 class="text-base font-semibold mb-1">Attachments:</h3>
                            <div class="grid grid-cols-3 gap-4">
                                @foreach ($ticket_attachments as $attachment)
                                    <div class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20"
                                            fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M2 0a2 2 0 00-2 2v16a2 2 0 002 2h16a2 2 0 002-2V2a2 2 0 00-2-2H2zm9 16a1 1 0 100-2 1 1 0 000 2zM4 3a1 1 0 00-1 1v10a1 1 0 001 1h3V3H4zm6 0v12h7a1 1 0 001-1V4a1 1 0 00-1-1h-7zm0 1h6v10h-6V4z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        <span class="mr-1">{{ $attachment['file_mime'] }}</span>
                                        <button wire:click="decryptAndOpenFile('{{ $attachment['file_path'] }}')"
                                            class="border-b border-blue-500 text-blue-500 hover:text-blue-700">
                                            View
                                        </button>
                                    </div>
                                @endforeach
                            </div>
                        </div>


                        <!-- Dispute Status -->
                        <div class="mb-4">
                            <h3 class="text-base font-semibold mb-1">Dispute Status:</h3>
                            <p>{{ $ticket_status }}</p>
                        </div>
                    </div>

                    <!-- Section 2: Business Review Details -->
                    <div class="mb-8">
                        <h2 class="text-lg text-blue-500 font-semibold mb-2">Review Details:</h2>
                        <!-- Rating -->
                        <div class="mb-4">
                            <div class="mb-4">
                                <h3 class="text-base font-semibold mb-1">Rating:</h3>
                                <div class="text-yellow-500">
                                    @for ($i = 0; $i < $fullStars; $i++)
                                        <i class="fas fa-star"></i>
                                    @endfor
                                    @if ($halfStar)
                                        <i class="fas fa-star-half-alt"></i>
                                    @endif
                                    @for ($i = $fullStars + $halfStar; $i < 5; $i++)
                                        <i class="far fa-star"></i>
                                    @endfor
                                </div>
                            </div>
                        </div>
                        <!-- Review Description -->
                        <div class="mb-4">
                            <h3 class="text-base font-semibold mb-1">Review Description:</h3>
                            <p>{!! $user_review !!}</p>
                        </div>
                        <!-- User Name -->
                        <div class="mb-4">
                            <h3 class="text-base font-semibold mb-1">User Name:</h3>
                            <p>{{ $username }}</p>
                        </div>
                    </div>

                    <!-- Section 3: Business Account Details -->
                    <div>
                        <h2 class="text-lg text-blue-500 font-semibold mb-2">Business Account Details:</h2>
                        <!-- Business Name -->
                        <div class="mb-4">
                            <h3 class="text-base font-semibold mb-1">Business Name:</h3>
                            <p>{{ $businessAccountName }}</p>
                        </div>
                        <div class="mb-4">
                            <h3 class="text-base font-semibold mb-1">View Account:</h3>
                            <p>
                                {{-- Add button --}}
                                <a href="{{ route('front.business.show', ['business_name' => $businessName]) }}"
                                    class="text-white bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">View</a>
                            </p>
                        </div>

                        <!-- Add other details of the business account here -->
                    </div>
                </div>
            @endslot
        </x-modals.modal>
    @endif

    @if ($changeStatusModal)
        <x-modals.change-status-modal :message="'You are going to ' .
            ($statusChangeInfo['status'] ? 'Approved' : 'Not Approved') .
            ' Review Status. It will also affect the total rating and mark the ticket as completed if the review is disapproved'" />
    @endif


    @if ($changeVerifiedModal)
        <x-modals.change-verified-modal-winner :message="'You are going to ' .
            ($statusChangeTicket['status'] == 'closed' ? 'close' : 'reopen') .
            ' the ticket.'" />
    @endif



</div>

@push('scripts')
    <script>
        window.addEventListener('fileDecrypted', event => {
            const url = new URL(event.detail[0].decryptedFilePath, window.location.origin);
            const absoluteURL = url.href;
            window.open(absoluteURL, '_blank');
        });
    </script>
@endpush

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
                <h6>Claim Requests</h6>
            </div>
            <div class="flex-auto px-0 pt-0 pb-2">
                <div class="p-0 overflow-x-auto">
                    <x-admin.table>
                        <x-admin.table.thead>
                            <tr>
                                <th
                                    class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                    Claimer</th>
                                <th
                                    class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                    Business Account</th>
                                    <th
                                    class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                    Details</th>
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
                            @forelse ($claimRequests as $claimRequest)
                                <tr>
                                    <x-admin.table.cell>
                                        <div class="flex px-2 py-1">

                                            <div class="flex flex-col justify-center">
                                                <h6 class="mb-0 leading-normal text-sm">
                                                    {{ $claimRequest->user->name }}
                                                </h6>
                                            </div>
                                        </div>
                                    </x-admin.table.cell>
                                    <x-admin.table.cell>

                                        <p>
                                            {{ $claimRequest->businessAccount->businessName }}
                                        </p>

                                    </x-admin.table.cell>
                                    <x-admin.table.cell >
                                        {{ $claimRequest->claimDetails }}
                                        
                                    </x-admin.table.cell>
                                    
                                    
                                    

                                    <x-admin.table.cell>
                                        <button type="button"
                                            class="cursor-pointer inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium  text-white {{ $claimRequest->is_claimed === 0 ? 'bg-blue-500' : ($claimRequest->is_claimed === 1 ? 'bg-green-500' : 'bg-red-500') }} ">{{ $claimRequest->is_claimed === 0 ? 'Not claimed' : ($claimRequest->is_claimed === 1 ? 'Request Accepted' : 'Request Rejected') }}
                                        </button>
                                    </x-admin.table.cell>

                                    <x-admin.table.cell>

                                        @if ($claimRequest->is_claimed === 0)
                                            <button wire:click="confirmAcceptRequest({{ $claimRequest->id }})"
                                                type="button"
                                                class="text-white bg-gradient-to-r from-blue-400 via-blue-500 to-blue-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
                                                Accept
                                            </button>
                                        @endif
                                        <button wire:click="confirmDenyClaimRequest({{ $claimRequest->id }})"
                                            type="button"
                                            class="text-white bg-gradient-to-r from-red-500 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-500 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
                                            Deny
                                        </button>

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
                    {{ $claimRequests->links() }}
                </div>
            </div>
        </div>
    </div>

    @if ($confirmRequestModal)
        <x-modals.modal maxWidth="2xl" wire:model.live="confirmRequestModal">
            @slot('title')
                Are you sure?
            @endslot

            @slot('content')
                <p class="px-5">You want to confirm this request!</p>
            @endslot

            @slot('footer')
                <button class="w-32 py-3 px-5 bg-green-500 border border-green-500 rounded text-white"
                    style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);" wire:click="confirmRequest">
                    Yes
                </button>
                <button class="w-32 py-3 px-5 bg-gray-300 border border-gray-300 rounded text-gray-600 ml-3"
                    style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);" wire:click="$set('confirmRequestModal', false)">
                    Cancel
                </button>
            @endslot
        </x-modals.modal>
    @endif

    @if ($denyRequestModal)
        <x-modals.modal maxWidth="2xl" wire:model.live="denyRequestModal">
            @slot('title')
                Are you sure?
            @endslot

            @slot('content')
                <p class="px-5">You want to deny this request!</p>
            @endslot

            @slot('footer')
                <button class="w-32 py-3 px-5 bg-green-500 border border-green-500 rounded text-white"
                    style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);" wire:click="denyRequest">
                    Yes
                </button>
                <button class="w-32 py-3 px-5 bg-gray-300 border border-gray-300 rounded text-gray-600 ml-3"
                    style="box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);" wire:click="$set('denyRequestModal', false)">
                    Cancel
                </button>
            @endslot
        </x-modals.modal>
    @endif
</div>

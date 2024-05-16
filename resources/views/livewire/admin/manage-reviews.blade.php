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

        <div
            class="relative  flex flex-col w-full min-w-0 mb-0 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
            <div class="p-6 pb-0  mb-0 bg-white rounded-t-2xl">
                <h6>Reviews</h6>
            </div>
          
            <div
                class="relative mt-2 p-3 flex flex-col w-full min-w-0 mb-0 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">

                <div class="flex-auto px-0 pt-0 pb-2">
                    <div class="p-0 overflow-x-auto">
                        <x-admin.table>
                            <x-admin.table.thead>
                                <tr>
                                    <th
                                        class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">

                                        Business Name
                                    </th>
                                    <th
                                        class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                        Reviewr User</th>
                                    <th
                                        class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                        rating</th>
                                        <th
                                        class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                        Review</th>
                                    <th
                                        class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">

                                        <button wire:click="sortBy('created_at')" type="button">Created
                                            At</button>
                                        <x-sort-icon field="created_at" :sortField="$sortField" :sortAsc="$sortAsc" />
                                    </th>

                                    <th
                                        class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                        Action</th>

                                </tr>
                            </x-admin.table.thead>
                            <tbody>
                                {{-- Parent Foreach --}}
                                @forelse ($reviews as $review)
                                    <tr>
                                        <x-admin.table.cell>
                                            <div class="flex px-2 py-1">

                                                <div class="flex flex-col justify-center">
                                                    <h6 class="mb-0 leading-normal text-sm">
                                                        @if ($review->businessAccount->is_approved)
                                                        <a href="{{ route('front.business.show', ['business_name' => $review->businessAccount->businessName]) }}">
                                                        {{ $review->businessAccount->businessName }}
                                                        </a>
                                                        @else
                                                        <a href="{{ route('admin.view-business-account', ['business_name' => $review->businessAccount->businessName]) }}">

                                                        {{ $review->businessAccount->businessName }}
                                                        </a>
                                                        @endif

                                                    </h6>
                                                </div>
                                            </div>
                                        </x-admin.table.cell>

                                        <x-admin.table.cell>
                                            <div class="flex px-2 py-1">

                                                <div class="flex flex-col justify-center">
                                                    <h6
                                                        class="mb-0 leading-normal text-sm">
                                                        {{ $review->user->name  }}
                                                    </h6>
                                                </div>
                                            </div>
                                        </x-admin.table.cell>
                                        <x-admin.table.cell>
                                            <div class="flex px-2 py-1 items-center">
                                                <div class="flex flex-row justify-start items-center">
                                                    @php
                                                    $rating = $review->rating;
                                                    $fullStars = floor($rating);
                                                    $halfStar = $rating - $fullStars >= 0.5 ? true : false;
                                                    $emptyStars = 5 - $fullStars - ($halfStar ? 1 : 0);
                                                    @endphp
                                        
                                                    <!-- Full stars -->
                                                    @for ($i = 0; $i < $fullStars; $i++)
                                                        <i class="fas fa-star text-yellow-500" style="margin-right: 3px;"></i>
                                                    @endfor
                                        
                                                    <!-- Half star -->
                                                    @if ($halfStar)
                                                        <i class="fas fa-star-half-alt text-yellow-500" style="margin-right: 3px;"></i>
                                                    @endif
                                        
                                                    <!-- Empty stars -->
                                                    @for ($i = 0; $i < $emptyStars; $i++)
                                                        <i class="far fa-star text-yellow-500" style="margin-right: 3px;"></i>
                                                    @endfor
                                                </div>
                                            </div>
                                        </x-admin.table.cell>
                                        
                                        

                                        <x-admin.table.cell>
                                            <p
                                                class="mb-0 overflow-hidden w-[180px] font-semibold leading-tight text-xs">
                                                {!! Str::limit($review->review, 50, '...') !!}

                                            </p>
                                        </x-admin.table.cell>

                                        <x-admin.table.cell>{{ $review->created_at->format('d-m-Y') }}</x-admin.table.cell>


                                        
                                        <x-admin.table.cell>
                                            <button type="button"
                                            wire:click="confirmChangeStatusApproved('{{ $review->id }}', '{{ $review->is_approved }}')"
                                            class="text-white bg-gradient-to-r {{ $review->is_approved ? 'from-green-400 via-green-500 to-green-600 focus:ring-green-300' : 'from-red-400 via-red-500 to-red-600 focus:ring-red-300' }}  hover:bg-gradient-to-br focus:ring-4 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">{{ $review->is_approved ? 'Approved' : 'Not approved' }}
                                        </button>
                                        <button type="button" wire:click="deleteAccount({{ $review->id }})"
                                            class="text-white bg-gradient-to-r from-red-400 
                                            via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 
                                            font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">Delete</button>
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
                        <div class="mt-3">
                        {{ $reviews->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if ($changeStatusModal)
        <x-modals.change-status-modal :message="'You are going to ' .
            ($statusChangeInfo['status'] ? 'Approved' : 'Not Approved') .
            ' Review Status. It will also affect the total rating'" />
    @endif
    <x-modals.delete-alert message="You are going to delete this account" />

</div>

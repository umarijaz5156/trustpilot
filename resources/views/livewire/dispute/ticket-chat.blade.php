<div class="w-full ">
    @if ($chat)
        <div class="h-full flex p-5 flex-col bg-[#F4F6FC]">
            <!-- Chat Header -->

            <div class="sticky top-0 left-0 z-[2] p-[30px] lg:p-[30px_60px] bg-[#F4F6FC]">
                <div class="flex w-full items-center justify-between mb-5">
                    <div class="flex items-center cursor-pointer transition-all duration-200 relativ">
                        <div class="w-full overflow-hidden">
                            <a
                                href="{{ route('front.business.show', ['business_name' => $details->review->businessAccount->businessName]) }}">
                                <p class="hover:text-blue-800 text-blue-500  font-medium text-[17px]">Review#
                                    {{ $details->review->id }}</p>
                            </a>
                            <a class="hover:text-blue-800 text-blue-500 font-medium text-[17px]"
                                href="{{ route('admin.view-business-account', ['business_name' => $details->review->businessAccount->businessName]) }}">{{ $details->review->businessAccount->businessName }}</a>
                            <p class=" font-medium text-[17px] text-gray-500">Business Owner:
                                {{ $details->review->businessAccount->user->name }}</p>

                            <p class=" font-medium text-[17px] text-gray-500">Reviewer: {{ $details->reviewer->name }}
                            </p>
                            <p class="mb-1 font-normal text-lg sm:text-[30px]">{{ $details->subject }}</p>

                        </div>
                    </div>
                    <div class="flex items-center">
                        <p class="text-[16px] text-gray-600 group-hover:text-[#f0f0f0a1]">
                            {{ $chat->created_at->format('M, d Y') }}</p>
                    </div>
                </div>
                <div class="w-full bg-[#DBE0ED] h-[2px]"></div>
            </div>
            <!-- Chats Messages -->
            <div class="flex-grow">
                {{-- Chat Area Component --}}
                <x-admin.ticket.chat-area :chat="$chat" />
                @if($chat->ticket_status == 'closed')
                <div class="text-center p-4">
                    <p>Ticket Status is Closed</p>
                </div>
                @else

                @php
                $ticket = App\Models\Ticket::where('id', $details->id)->first();
                $adminMessageAfterUser = null;

                $userLastMessage = App\Models\TicketChat::where('ticket_id', $ticket->id)
                    ->where('sender_id', auth()->user()->id)
                    ->latest()
                    ->first();
        
        
                if ($userLastMessage) {
                    $adminUser = App\Models\User::where('is_admin', 1)->first();
        
                    if ($adminUser) {
                        $adminMessageAfterUser = App\Models\TicketChat::where('ticket_id', $ticket->id)
                            ->where('id', '>', $userLastMessage->id)
                            ->where('sender_id', $adminUser->id)
                            ->exists();
                    }
                    
                }
                @endphp

                @if(!$userLastMessage || $adminMessageAfterUser)
                    <form wire:submit.prevent="sendMessage" class="sticky bottom-0">
                        <label for="chat" class="sr-only">Your message</label>
                        <small class="px-7">You can provide external proofs, by posting image or document links
                            here.</small>
    
                        <div class="flex items-center py-2 px-3 bg-gray-50 rounded-lg drk:bg-gray-700">
                            <input wire:model="message" id="chat" rows="1"
                                class="block mx-4 p-2.5 w-full text-sm text-gray-900 bg-white rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 drk:bg-gray-800 drk:border-gray-600 drk:placeholder-gray-400 drk:text-white drk:focus:ring-blue-500 drk:focus:border-blue-500"
                                placeholder="Your message...">
                            <button type="submit"
                                class="inline-flex justify-center p-2 text-blue-600 rounded-full cursor-pointer hover:bg-blue-100 drk:text-blue-500 drk:hover:bg-gray-600">
                                <svg aria-hidden="true" class="w-6 h-6 rotate-90" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z">
                                    </path>
                                </svg>
                                <span class="sr-only">Send message</span>
                            </button>
                        </div>
    
                    </form>
                @else
                    <div class="text-center">
                        <p>Please wait for an admin response</p>
                    </div>
                @endif
               
                @endif
            </div>

        </div>
    @endif

    <div>
        @if (session('success'))
            <x-alerts.success :success="session('success')" />
        @endif

        @if (session('error'))
            <x-alerts.error :error="session('error')" />
        @endif
    </div>

</div>

<script>
    const scrollToBottom = (id) => {
        const element = document.getElementById(id);
        element.scrollTop = element.scrollHeight;
    }

    document.addEventListener('livewire:init', () => {
        Livewire.on('ticketSelected', (event) => {
            setTimeout(() => {
                scrollToBottom('ChatArea');
            }, 500);
        })
    })
</script>

<div>
    <button class="absolute  right-3 lg:hidden" id="close-sidebar"><i class="fa-solid fa-xmark"></i></button>
    @if($tickets)
    
    @foreach($tickets as $ticket)
        <div   class="{{ $selectedTicket == $ticket->id ? 'bg-[#2545C3] text-white' : ''}}  flex items-center p-5 cursor-pointer transition-all duration-200 my-1 rounded-[20px] relative  group hover:bg-gradient-to-t hover:from-[#2545C3] hover:to-[#3959D5] hover:text-white">
            <div wire:click="$dispatch('ticketSelected', { ticket: {{ $ticket }} })"  class="w-full overflow-hidden">
                <div class="flex justify-between items-center mb-1 ">
                    <p class="font-medium text-[17px]">Ticket #{{$ticket->id}}</p>
                    <p class="font-medium text-[17px]"> Review #{{$ticket->business_review_id}}</p>
                    
                </div>
                <div class="flex justify-between text-[13px] font-medium items-center">
                    <p class="overflow-hidden text-ellipsis ... text-[#969eaa] group-hover:text-[#f0f0f0a1] font-normal"><span class="whitespace-nowrap">{{$ticket->subject}}</span></p>
                    <p class="text-[13px] hover:text-blue text-[#969eaa] group-hover:text-[#f0f0f0a1]">{{$ticket->created_at->format('M d, Y')}}</p>
                </div>
            </div>
        </div>
    @endforeach
    @endif
 
</div>

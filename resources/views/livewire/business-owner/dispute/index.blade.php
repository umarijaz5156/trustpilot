<div class="p-3  w-full lg:max-w-[960px] xl:max-w-[1140px] 2xl:max-w-[1600px] mx-auto h-screen">
    <div class="py-5 flex justify-start items-center gap-x-3 px-3 lg:px-0">
        <h1 class="text-3xl font-semibold">Resolution Center</h1>
        <button class="btn text-[17px]  lg:hidden" id="collapse-sidebar"><i class="fa-solid fa-bars"></i></button>
    </div>

    @if($count > 0)
    <div class="w-full flex overflow-hidden rounded-3xl bg-[#F4F6FC] h-[calc(100vh - 4rem)]">

        <!-- Sidebar -->
        <div class="flex-shrink-0 w-72 bg-white shadow-sidebar overflow-y-auto">
            <div class="p-5">
                <livewire:business-owner.dispute.tickets-list :ticketId="$ticketId"/>
            </div>
        </div>

        <!-- Chat Messages -->
        <div class="flex-grow overflow-y-auto">
            <livewire:business-owner.dispute.ticket-chat :ticketId="$ticketId"/>
        </div>

    </div>
    @else
    <p class="bg-gray-100 p-5 mt-10 text-gray-500 text-lg text-center">No disputes found yet</p>
    @endif
</div>

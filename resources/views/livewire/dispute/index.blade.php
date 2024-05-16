<div>
<div class="md:p-[80px] mt-16 w-full lg:max-w-[960px] xl:max-w-[1140px] 2xl:max-w-[1600px] mx-auto">
    <div class="py-5 mt-5 flex justify-start items-center gap-x-3 px-3 lg:px-0">
        <h1 class="text-3xl font-semibold">Disputes</h1>
        <button class="btn text-[17px] lg:hidden" id="collapse-sidebar"><i class="fa-solid fa-bars"></i></button>
    </div>

    @if ($count > 0)
        <div class="w-full flex overflow-hidden rounded-3xl bg-[#F4F6FC] h-[calc(100vh - 4rem)]">

            <!-- Sidebar -->
            <div class="">
                <div class="p-5">
                    <livewire:dispute.tickets-list :ticketId="$ticketId" />
                </div>
            </div>

            <!-- Chat Messages -->
            <div class="flex-grow overflow-y-auto flex items-center justify-center">
                <livewire:dispute.ticket-chat :ticketId="$ticketId" />
            </div>

        </div>
    @else
        <p class="bg-gray-100 p-5 mt-10 text-gray-500 text-lg text-center">No disputes found yet</p>
    @endif
</div>
</div>

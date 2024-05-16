<div>
    <div class=" relative p-[41px_31px_0px_31px] bg-no-repeat bg-right-top"
        style="background-image: url({{ asset('images/reminder-[Converted]\ 1.svg') }});">
        <div class="flex justify-between items-center animate__animated animate__zoomIn">
            {{-- <div class="bg-white rounded-lg shadow-xl w-max flex justify-start items-center gap-3 p-2">
                <img src="{{ asset('images/clipboard.svg') }}" alt="">
                <div>
                    <h3 class="text-[#272727] text-[14px] font-medium">{{ 'as fasdf asdf asdfas' }}</h3>
                </div>
            </div> --}}
        </div>
        {{-- recipient table --}}
        <div class="mt-[56px]">
            <div class="w-full mx-auto ">
                <div class="p-4 sm:p-6 animate__animated animate__backInUp">
                    <div class="flex justify-between items-center mb-9">
                        <h1 class="text-[34px] text-[#5C5C5C] leading-[40px] font-semibold">Tickets</h1>

                    </div>
                    <div class="">
                        <div class="overflow-auto relative sm:rounded-lg">
                            <table
                                class="xl:w-full w-[1280px] text-sm text-left text-gray-500 drk:text-gray-400 border-separate border-spacing-y-3">
                                <thead
                                    class="text-base text-[#707176] bg-[#F4F6FC] rounded-[10px] drk:bg-gray-700 drk:text-gray-400  ">
                                    <tr class="">
                                        <th scope="col" class="p-6 rounded-tl-[10px] rounded-bl-[10px] font-normal">
                                            Description
                                        </th>
                                        <th scope="col" class="py-6 px-6 font-normal ">
                                            Reviewer Name
                                        </th>
                                        <th scope="col" class="py-6 px-6 font-normal">
                                            Reviewer Email
                                        </th>
                                        <th scope="col" class="py-6 px-6 font-normal">
                                            Review
                                        </th>
                                        <th scope="col" class="py-6 px-6 font-normal">
                                            Attachments
                                        </th>
                                        <th scope="col" class="py-6 px-6 font-normal">
                                            Status
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($tickets as $ticket)
                                        <tr class=" drk:bg-gray-800 drk:border-gray-700  rounded-[10px]  overflow-hidden transition-all duration-300"
                                            style="box-shadow: rgba(0, 0, 0, 0.1) 0px 4px 12px;">
                                            <td class="p-4 w-4 rounded-tl-[10px] rounded-bl-[10px] font-medium">
                                                <p class="mt-[10px] lg:mt-0">{!! $ticket->description !!}</p>
                                            </td>
                                            <td class="p-6 w-6">
                                                {{ $ticket->review->user->name }}
                                            </td>
                                            <td class="py-6 px-6">
                                                {{ $ticket->review->user->email }}
                                            </td>
                                            <td class="py-6 px-6">
                                                {!! $ticket->review->review !!}
                                            </td>
                                            <td class="py-6 px-6">
                                                <ul>
                                                    @foreach ($ticket->attachments as $file)
                                                        <li>
                                                            <a href="{{ asset('storage/' . $file->file_path) }}"
                                                                download="">{{ $file->file_path }}</a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </td>
                                            <td class=" rounded-tr-[10px] rounded-br-[10px]">
                                                <div class="flex">
                                                    <button
                                                        class="{{ $ticket->ticket_status == 'pending' ? 'bg-purple-500 hover:bg-purple-600' : 'bg-green-500 hover:bg-green-600' }}  text-white mt-4 font-medium rounded-lg text-sm px-5 
                                                    py-2.5 text-center hover:text-white mr-2 mb-2">
                                                        {{ $ticket->ticket_status }}
                                                    </button>
                                                    <a href="{{ route('business-owner.disputes', ['id' => $ticket->id]) }}"
                                                        class="text-white mt-4 bg-gradient-to-r from-gray-400 via-gray-500 to-gray-600 hover:bg-gradient-to-br
                                                     focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 
                                                     py-2.5 text-center hover:text-white mr-2 mb-2">Chat</a>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center">No ticket found</td>
                                        </tr>
                                    @endforelse


                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

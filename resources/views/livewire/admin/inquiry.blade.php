<div>

    @if ($viewd)
        <div class="w-full max-w-full px-3 lg:w-1/3 lg:flex-none">
            <color:div
                class="relative flex flex-col h-full min-w-0 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
                <div class="p-4 pb-0 mb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                    <div class="flex flex-wrap -mx-3">
                        <div class="flex items-center flex-none w-1/2 max-w-full px-3">
                            <h6 class="mb-0">Enquiry Detail</h6>
                        </div>
                    </div>
                </div>
                <div class="flex-auto p-4 pb-0">
                    <ul class="flex flex-col pl-0 mb-0 rounded-lg">
                        <li
                            class="relative flex justify-between px-4 py-2 pl-0 mb-2 bg-white border-0 rounded-t-inherit text-inherit rounded-xl">
                            <div class="flex flex-col">
                                <span class="leading-tight text-xs mb-1"><b
                                        class="mb-1 font-semibold leading-normal text-sm text-slate-700"> Date:
                                    </b>{{ date('d-m-Y', strtotime($inquiry->created_at)) }}</span>
                                <span class="leading-tight text-xs mb-1"><b
                                        class="mb-1 font-semibold leading-normal text-sm text-slate-700">Name:
                                    </b>{{ $inquiry->name }}</span>
                                <span class="leading-tight text-xs mb-1"><b
                                        class="mb-1 font-semibold leading-normal text-sm text-slate-700">Phone:
                                    </b>{{ $inquiry->phone }}</span>
                                <span class="leading-tight text-xs mb-1"><b
                                        class="mb-1 font-semibold leading-normal text-sm text-slate-700">Email:
                                    </b>{{ $inquiry->email }}</span>
                                <span class="leading-tight text-xs mb-1"><b
                                        class="mb-1 font-semibold leading-normal text-sm text-slate-700">Enquiry From:
                                    </b>{{ $inquiry->enquiry_from }}</span>
                                @isset($inquiry->enquiry_for)
                                    <span class="leading-tight text-xs mb-1"><b
                                            class="mb-1 font-semibold leading-normal text-sm text-slate-700">Enquiry For:
                                        </b>Product Id ({{ $inquiry->enquiry_for }})</span>
                                @endisset

                                <label for="message" class="leading-tight text-xs mb-1"><b
                                        class="mb-1 font-semibold leading-normal text-sm text-slate-700">The
                                        Message:</b></label>
                                <textarea id="message" rows="4" cols="100"
                                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    readonly>  {{ $inquiry->message }}</textarea>

                            </div>
                        </li>
                    </ul>
                </div>
            </color:div>
        </div>
    @else
        {{-- <div class="flex flex-wrap -mx-3"> --}}
        <div class="flex-none w-full max-w-full px-3">
            <div>
                @if (session()->has('message'))
                    <x-alerts.success :success="session('message')" />
                @endif
            </div>
            <div
                class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
                <div class="flex-auto px-0 pt-0 pb-2">
                    <div class="p-0 overflow-x-auto">
                        <table class="items-center w-full mb-0 align-top border-gray-200 text-slate-500">
                            <thead class="align-bottom">
                                <div class="flex items-center justify-end mt-2 mr-2">
                                    <label for="default-search"
                                        class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
                                    <div class="relative">
                                        <div
                                            class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                            <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400"
                                                fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                            </svg>
                                        </div>
                                        <input type="search" id="default-search"
                                            class="block w-full p-2 pl-8 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                            placeholder="Search Inquiries.. i@gmai.com" wire:model="searchTerm"
                                            required>
                                    </div>
                                </div>
                                <tr>
                                    <th
                                        class="px-6 py-3 pl-2 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                        #</th>
                                    <th
                                        class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                        Person Email</th>
                                    <th
                                        class="px-6 py-3 pl-2 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                        Quiries</th>
                                    <th
                                        class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                        Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($inquiries) > 0)
                                    @foreach ($inquiries as $key => $inquiry)
                                        <tr>
                                            <td
                                                class="p-1 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">

                                                <div>
                                                    {{ ++$key }}
                                                </div>
                                            </td>
                                            <td
                                                class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                                <h6 class="mb-0 leading-normal text-sm">{{ $inquiry->email }}</h6>
                                            </td>
                                            <td
                                                class="p-2  align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                                <p class="text-sm">{{ Str::limit($inquiry->message, 100) }}</p>
                                            </td>
                                            <td
                                                class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent ml-2">
                                                <a href="{{ route('admin.inquiry.view', $inquiry->id) }}"
                                                    class="bg-orange-500 hover:bg-orange-600 text-white text-sm py-2 px-2 border rounded">View</a>
                                                <button wire:click="destroy({{ $inquiry->id }})" type="button"
                                                    class="bg-rose-600 hover:bg-rose-700 text-white text-sm py-2 px-2 border rounded">Delete</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="3" align="center">
                                            No Quiries Found.
                                        </td>
                                    </tr>

                                @endif
                            </tbody>
                        </table>
                        {{ $inquiries->links() }}
                    </div>
                </div>
            </div>
        </div>
    @endif
    {{-- </div> --}}

    <x-modals.delete-alert message="You are going to delete enquiry" />
</div>

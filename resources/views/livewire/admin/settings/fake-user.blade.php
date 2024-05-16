<div>
    <h2 id="accordion-collapse-heading-3">
        <button type="button"
            class="flex items-center justify-between w-full p-5 font-medium text-left text-gray-500 border border-b-0 border-gray-200 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-800 dark:border-gray-700 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800"
            data-accordion-target="#accordion-fakeUSer" aria-expanded="false"
            aria-controls="accordion-fakeUSer">
            <span>Create Fake User</span>
            <svg data-accordion-icon class="w-6 h-6 shrink-0" fill="currentColor" viewBox="0 0 20 20"
                xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                    clip-rule="evenodd"></path>
            </svg>
        </button>
    </h2>
    <div wire:ignore.self id="accordion-fakeUSer" class="hidden"
        aria-labelledby="accordion-collapse-heading-3">
        <div class="p-5 font-light border border-b-0 border-gray-200 dark:border-gray-700 dark:bg-gray-900">
            <div class="flex-auto p-5">
                <h2 class="mb-4 font-semibold text-gray-700 dark:text-gray-200">
                    Easily generate a Fake User with just one click, complete with fake data </h2>
                    <div class="p-3 float-right" style="width: 25%">
                        <input type="number" style="width: 50%" wire:model="numFakeUsers" min="1" max="300" placeholder="1" class="mr-2 px-4 py-3 mb-2 border border-gray-300 rounded-lg" />
                        <x-input-error for="numFakeUsers" />

                        <button wire:click="makeFakeUser"
                            class="inline-block px-4 py-3 mb-2 ml-2 font-bold text-center uppercase align-middle transition-all bg-transparent border border-solid rounded-lg cursor-pointer xl-max:cursor-not-allowed xl-max:opacity-65 xl-max:pointer-events-none xl-max:bg-gradient-to-tl xl-max:from-purple-700 xl-max:to-pink-500 xl-max:text-white xl-max:border-0 hover:scale-102 hover:shadow-soft-xs active:opacity-85 leading-pro text-xs ease-soft-in tracking-tight-soft shadow-soft-md bg-150 bg-x-25 border-fuchsia-500 bg-none text-fuchsia-500 hover:border-fuchsia-500">
                            Create Fake User
                        </button>
                    </div>
                    

                <!-- resources/views/livewire/hot-bleep-users-table.blade.php -->

                <div
                    class="relative flex flex-col w-full min-w-0 mb-0 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
                    <div class="p-6 pb-0 mb-0 bg-white rounded-t-2xl">
                        <h6>Explore the theHotBleep Fake Users Table, where all user accounts have the password
                            "FakHbU212..###". </h6>
                    </div>
                    <div class="flex-auto px-0 pt-0 pb-2">
                        <div class="p-0 overflow-x-auto">
                            <x-admin.table>
                                <x-admin.table.thead>
                                    <tr>
                                        <th
                                            class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                            Name</th>
                                        <th
                                            class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                            Email</th>
                                        <th
                                            class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                            Has Business account</th>

                                    </tr>
                                </x-admin.table.thead>
                                <tbody>
                                    @forelse ($fakeUser as $user)
                                        <tr>
                                            <x-admin.table.cell>
                                                <div class="flex px-2 py-1">

                                                    <div class="flex flex-col justify-center">
                                                        <h6 class="mb-0 leading-normal text-sm">
                                                            {{ $user->name }}</h6>
                                                    </div>
                                                </div>
                                            </x-admin.table.cell>
                                            <x-admin.table.cell>
                                                <p
                                                    class="mb-0 overflow-hidden w-[180px] font-semibold leading-tight text-xs">
                                                    {{ $user->email }}
                                                </p>
                                            </x-admin.table.cell>
                                            <x-admin.table.cell>
                                                <p
                                                    class="mb-0 overflow-hidden w-[180px] font-semibold leading-tight text-xs">
                                                    @if ($user->has_business_account)
                                                        <span style="color: green;">&#10004;</span>
                                                    @else
                                                        <span style="color: red;">&#10008;</span>
                                                    @endif

                                                </p>
                                            </x-admin.table.cell>

                                        </tr>
                                </tbody>


                            @empty
                                <tr>
                                    <td class="py-4 px-6 text-center" colspan="5">
                                        No Record Found
                                    </td>
                                </tr>
                                @endforelse
                                </tbody>
                            </x-admin.table>
                            <div class="px-6 py-3 bg-gray-50">
                                {{ $fakeUser->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
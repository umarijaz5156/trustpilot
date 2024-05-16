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
        <button wire:click="showModal('addNewCategory')"
            class="px-4 py-3 mb-2 ml-2 font-bold text-center uppercase align-middle transition-all bg-transparent border border-solid rounded-lg cursor-pointer xl-max:cursor-not-allowed xl-max:opacity-65 xl-max:pointer-events-none xl-max:bg-gradient-to-tl xl-max:from-purple-700 xl-max:to-pink-500 xl-max:text-white xl-max:border-0 hover:scale-102 hover:shadow-soft-xs active:opacity-85 leading-pro text-xs ease-soft-in tracking-tight-soft shadow-soft-md bg-150 bg-x-25 border-fuchsia-500 bg-none text-fuchsia-500 hover:border-fuchsia-500"
            type="button">
            Add New Category
        </button>

        <div
            class="relative flex flex-col w-full min-w-0 mb-0 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
            <div class="p-6 pb-0 mb-0 bg-white rounded-t-2xl">
                <h6>Categories Table</h6>
            </div>
            <div class="flex-auto px-0 pt-0 pb-2">
                <div class="p-0 overflow-x-auto">
                    <x-admin.table>
                        <x-admin.table.thead>
                            <tr>
                                <th
                                    class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                    Category Title</th>
                                <th
                                    class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                    Category Description</th>
                                <th
                                    class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                    Category Banner</th>
                                <th
                                    class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                    Category Icon</th>
                                <th
                                    class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                    Action</th>

                                <th
                                    class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                    View Sub-Categories
                                </th>
                            </tr>
                        </x-admin.table.thead>
                        <tbody>
                            {{-- Parent Foreach --}}
                            @forelse ($categories as $category)
                                <tr>
                                    <x-admin.table.cell>
                                        <div class="flex px-2 py-1">

                                            <div class="flex flex-col justify-center">
                                                <h6 class="mb-0 leading-normal text-sm">{{ $category->title }}</h6>
                                            </div>
                                        </div>
                                    </x-admin.table.cell>
                                    <x-admin.table.cell>
                                        <p class="mb-0 overflow-hidden w-[180px] font-semibold leading-tight text-xs">
                                            {{ $category->description }}
                                        </p>
                                    </x-admin.table.cell>
                                    <x-admin.table.cell>
                                        <p class="mb-0 overflow-hidden w-[180px] font-semibold leading-tight text-xs">
                                        <div class="" uk-lightbox="animation: scale">
                                            <div>
                                                <a class="uk-inline"
                                                    href="{{ asset('storage/' . $category->banner_path) }}"
                                                    data-caption="Caption 1">
                                                    <img src="{{ asset('storage/' . $category->banner_path) }}"
                                                        class="w-20 h-20 object-cover rounded-[6px]" alt="">
                                                </a>
                                            </div>
                                        </div>
                                        </p>
                                    </x-admin.table.cell>
                                    <x-admin.table.cell>
                                        <p class="mb-0 overflow-hidden w-[180px] font-semibold leading-tight text-xs">
                                        <div class="" uk-lightbox="animation: scale">
                                            <div>
                                                <a class="uk-inline"
                                                    href="{{ asset('storage/' . $category->icon_path) }}"
                                                    data-caption="Caption 1">
                                                    <img src="{{ asset('storage/' . $category->icon_path) }}"
                                                        class="w-20 h-20 object-cover rounded-[6px]" alt="">
                                                </a>
                                            </div>
                                        </div>
                                        </p>
                                    </x-admin.table.cell>
                                    <x-admin.table.cell>
                                        <button type="button" wire:click="deleteCategory({{ $category->id }})"
                                            class="text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">Delete</button>

                                        <button type="button" wire:click="editCategory({{ $category->id }})"
                                            class="text-white bg-gradient-to-r from-blue-400 via-blue-500 to-blue-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">Edit</button>
                                    </x-admin.table.cell>
                                    <x-admin.table.cell>
                                        <button
                                            wire:click="collapseSubChild({{ $category->id }}, {{ $showHideLevel2 }})"
                                            type="button"
                                            class="flex items-center justify-between w-full p-5 font-medium text-left text-gray-500 border border-b-0 border-gray-200 rounded-t-xl focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-800 dark:border-gray-700 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800">

                                            <svg data-accordion-icon
                                                class="w-6 h-6 {{ $showHideLevel2 == $category->id ? 'rotate-180' : '' }}  shrink-0"
                                                fill="currentColor" viewBox="0 0 20 20"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd"
                                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                        </button>
                                    </x-admin.table.cell>
                                </tr>
                                <tr class="{{ $showHideLevel2 == $category->id ? '' : 'hidden' }}">
                                    <x-admin.table.cell class="bg-gray-300" colspan="5">
                                        <x-admin.table>
                        <tbody>
                            {{-- Child Foreach --}}
                            @forelse ($category->childCategories as $child)
                                <tr>
                                    <x-admin.table.cell>
                                        <div class="flex px-2 py-1">
                                            <div class="flex flex-col justify-center">
                                                <h6 class="mb-0 leading-normal text-sm">
                                                    {{ $child->title }}
                                                </h6>
                                            </div>
                                        </div>
                                    </x-admin.table.cell>
                                    <x-admin.table.cell>
                                        <p class="overflow-hidden w-[180px] mb-0 font-semibold leading-tight text-xs">
                                            {{ $child->description }}
                                        </p>
                                    </x-admin.table.cell>
                                    <x-admin.table.cell>
                                        <p class="mb-0 overflow-hidden w-[180px] font-semibold leading-tight text-xs">
                                        <div class="" uk-lightbox="animation: scale">
                                            <div>
                                                <a class="uk-inline"
                                                    href="{{ asset('storage/' . $child->banner_path) }}"
                                                    data-caption="Caption 1">
                                                    <img src="{{ asset('storage/' . $child->banner_path) }}"
                                                        class="w-20 h-20 object-cover rounded-[6px]" alt="">
                                                </a>
                                            </div>
                                        </div>
                                        </p>
                                    </x-admin.table.cell>
                                    <x-admin.table.cell>
                                        <p class="mb-0 overflow-hidden w-[180px] font-semibold leading-tight text-xs">
                                        <div class="" uk-lightbox="animation: scale">
                                            <div>
                                                <a class="uk-inline" href="{{ asset('storage/' . $child->icon_path) }}"
                                                    data-caption="Caption 1">
                                                    <img src="{{ asset('storage/' . $child->icon_path) }}"
                                                        class="w-20 h-20 object-cover rounded-[6px]" alt="">
                                                </a>
                                            </div>
                                        </div>
                                        </p>
                                    </x-admin.table.cell>
                                    <x-admin.table.cell>
                                        <button type="button" wire:click="deleteCategory({{ $child->id }})"
                                            class="text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">Delete</button>
                                        <button type="button" wire:click="editCategory({{ $child->id }})"
                                            class="text-white bg-gradient-to-r from-blue-400 via-blue-500 to-blue-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
                                            Edit</button>
                                    </x-admin.table.cell>
                                    {{-- <x-admin.table.cell>
                                        <button
                                            wire:click="collapseChildOfSubChild({{ $child->id }}, {{ $showHideLevel3 }})"
                                            type="button"
                                            class="flex items-center justify-between w-full p-5 font-medium text-left text-gray-500 border border-b-0 border-gray-200 rounded-t-xl focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-800 dark:border-gray-700 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800">

                                            <svg data-accordion-icon
                                                class="w-6 h-6 {{ $showHideLevel3 == $child->id ? 'rotate-180' : '' }} shrink-0"
                                                fill="currentColor" viewBox="0 0 20 20"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd"
                                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                        </button>
                                    </x-admin.table.cell> --}}
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
                    {{ $categories->links() }}
                </div>
            </div>
        </div>
    </div>


    {{-- Delete Confirmation Modal --}}
    <x-modals.delete-alert message="You are going to delete category" />

    <!-- Add Category modal -->
    @if ($addNewCategory)

        <x-modals.modal wire:model.live="addNewCategory" maxWidth="5xl">
            @slot('headerTitle')
                Add New Category
            @endslot

            @slot('content')
                <form class="space-y-6" wire:submit.prevent="createCategory">

                    <div class="grid gap-6 mb-6 md:grid-cols-2">
                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Category
                                Title</label>
                            <input type="text" wire:model="title" maxlength="255"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                placeholder="Enter Category Title">
                            @error('title')
                                <span class="text-xs text-red-500 mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label for="parent_id"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Select
                                Parent
                                Category</label>
                            <select wire:model="parent_id"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">

                                <option value="">Choose...</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->title }}</option>
                                    {{-- @if (count($category->childCategories) > 0)
                                        @foreach ($category->childCategories as $child)
                                            <option value="{{ $child->id }}">{{ $child->title }}</option>
                                        @endforeach
                                    @endif --}}
                                @endforeach
                            </select>
                        </div>

                        {{-- <div>
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Slug
                                Store</label>
                            <input type="text" wire:model="slugStore"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                maxlength="255" placeholder="Slug Store">
                            @error('slugStore')
                                <span class="text-xs text-red-500 mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Slug
                                Manufacturer</label>
                            <input type="text" wire:model="slugManufacturer"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                maxlength="255" placeholder="Enter Category Title">
                            @error('slugManufacturer')
                                <span class="text-xs text-red-500 mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label
                                clashortDescriptionss="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Short
                                Description</label>
                            <textarea type="text" wire:model="shortDescription" maxlength="300" placeholder="Short Description"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"></textarea>
                            @error('shortDescription')
                                <span class="text-xs text-red-500 mt-1">{{ $message }}</span>
                            @enderror
                        </div> --}}

                        <div>
                            <label
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Description</label>
                            <textarea type="text" wire:model="description" maxlength="1000" placeholder="Description"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"></textarea>
                            @error('description')
                                <span class="text-xs text-red-500 mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>
                    <div class="py-2">
                        <div class="grid gap-6 mb-6 md:grid-cols-2">
                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Cover
                                    Photo</label>
                                {{-- <p class="text-xs">dimensions 970x250 px required</p> --}}
                                <input type="file" wire:model="cover_photo" name="coverPhoto"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
                                {{-- <x-inputs.image-upload wire:model="cover_photo" fileName="coverPhoto" /> --}}
                                @error('cover_photo')
                                    <span class="text-xs text-red-500 mt-1">{{ $message }}</span>
                                @enderror
                            </div>
                            <div>
                                <label class= "block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Category
                                    Icon</label>
                                {{-- <p class="text-xs">dimensions 32x32 px required</p> --}}
                                <input type="file" wire:model="category_icon" name="categoryIcon"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
                                {{-- <x-inputs.image-upload wire:model="category_icon" fileName="categoryIcon" /> --}}
                                @error('category_icon')
                                    <span class="text-xs text-red-500 mt-1">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="!my-4 w-24 float-right">
                        <button type="submit"
                            class="inline-block w-full px-4 py-3 mb-2 ml-2 font-bold text-center uppercase align-middle transition-all bg-transparent border border-solid rounded-lg cursor-pointer xl-max:cursor-not-allowed xl-max:opacity-65 xl-max:pointer-events-none xl-max:bg-gradient-to-tl xl-max:from-purple-700 xl-max:to-pink-500 xl-max:text-white xl-max:border-0 hover:scale-102 hover:shadow-soft-xs active:opacity-85 leading-pro text-xs ease-soft-in tracking-tight-soft shadow-soft-md bg-150 bg-x-25 border-fuchsia-500 bg-none text-fuchsia-500 hover:border-fuchsia-500">Submit</button>
                    </div>
                </form>
            @endslot
        </x-modals.modal>
    @endif

    {{-- Edit Category Modal --}}
    @if ($editCategoryModal)
        <x-modals.modal wire:model.live="editCategoryModal" maxWidth="5xl">
            @slot('headerTitle')
                Edit Category
            @endslot

            @slot('content')
                <form class="space-y-6" wire:submit.prevent="updateCategory">
                    <div class="grid gap-6 mb-6 md:grid-cols-2">
                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Category
                                Title</label>
                            <input type="text" wire:model="title"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                maxlength="255" placeholder="Enter Category Title">
                            @error('title')
                                <span class="text-xs text-red-500 mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        @if (!is_null($parent_id) && !empty($parent_id))
                            <div>
                                <label for="parent_id"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Select
                                    Parent
                                    Category</label>
                                <select wire:model="parent_id"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">

                                    <option value="">Choose...</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->title }}</option>
                                        {{-- @if (count($category->childCategories) > 0)
                                        @foreach ($category->childCategories as $child)
                                            <option value="{{ $child->id }}">{{ $child->title }}</option>
                                        @endforeach
                                    @endif --}}
                                    @endforeach
                                </select>
                            </div>
                        @endif

                        <div>
                            <label
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Description</label>
                            <textarea type="text" wire:model="description" maxlength="1000" placeholder="Description"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"></textarea>
                            @error('description')
                                <span class="text-xs text-red-500 mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- <div>
                            <label for="enabled"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Enabled</label>
                            <select wire:model="enabled"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">

                                <option value="1">Yes</option>
                                <option value="0">No</option>

                            </select>
                            @error('enabled')
                                <span class="text-xs text-red-500 mt-1">{{ $message }}</span>
                            @enderror
                        </div> --}}
                    </div>
                    <div class="py-2">
                        {{-- <h5 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">Category Page Setup:</h5> --}}

                        <div class="grid gap-6 mb-6 md:grid-cols-2">
                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Cover
                                    Photo</label>
                                {{-- <p class="text-xs">dimensions 970x250 px required</p> --}}
                                <input type="file" wire:model="cover_photo" name="coverPhoto"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
                                {{-- <x-inputs.image-upload wire:model="cover_photo" fileName="coverPhoto" /> --}}
                                @error('cover_photo')
                                    <span class="text-xs text-red-500 mt-1">{{ $message }}</span>
                                @enderror
                            </div>
                            <div>
                                <label class= "block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Category
                                    Icon</label>
                                {{-- <p class="text-xs">dimensions 32x32 px required</p> --}}
                                <input type="file" wire:model="category_icon" name="categoryIcon"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
                                {{-- <x-inputs.image-upload wire:model="category_icon" fileName="categoryIcon" /> --}}
                                @error('category_icon')
                                    <span class="text-xs text-red-500 mt-1">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="!my-4 w-24 float-right">
                        <button type="submit"
                            class="inline-block w-full px-4 py-3 mb-2 ml-2 font-bold text-center uppercase align-middle transition-all bg-transparent border border-solid rounded-lg cursor-pointer xl-max:cursor-not-allowed xl-max:opacity-65 xl-max:pointer-events-none xl-max:bg-gradient-to-tl xl-max:from-purple-700 xl-max:to-pink-500 xl-max:text-white xl-max:border-0 hover:scale-102 hover:shadow-soft-xs active:opacity-85 leading-pro text-xs ease-soft-in tracking-tight-soft shadow-soft-md bg-150 bg-x-25 border-fuchsia-500 bg-none text-fuchsia-500 hover:border-fuchsia-500">Update</button>
                    </div>
                </form>
            @endslot
        </x-modals.modal>
    @endif

</div>

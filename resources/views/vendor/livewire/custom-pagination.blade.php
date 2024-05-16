<div>
    @if ($paginator->hasPages())
        @php(isset($this->numberOfPaginatorsRendered[$paginator->getPageName()]) ? $this->numberOfPaginatorsRendered[$paginator->getPageName()]++ : ($this->numberOfPaginatorsRendered[$paginator->getPageName()] = 1))

        <nav class="flex gap-4 flex-nowrap justify-between md:justify-center items-center" aria-label="Pagination">
            <span>
                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                    <span aria-disabled="true" aria-label="{{ __('pagination.previous') }}">
                        <span
                            class="border py-4 xl:text-base text-sm rounded-full px-6 text-white bg-[#37C99D] border-[#37c99d60]"
                            aria-hidden="true">
                            {{-- <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg> --}}
                            Previous
                        </span>
                    </span>
                @else
                    <button wire:click="previousPage('{{ $paginator->getPageName() }}')"
                        dusk="previousPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}.after"
                        rel="prev"
                        class="border py-4 xl:text-base text-sm rounded-full px-6 text-[#37C99D] focus:bg-[#37C99D] focus:text-[white] border-[#37C99D]"
                        aria-label="{{ __('pagination.previous') }}">
                        {{-- <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                        </svg> --}}
                        Previous
                    </button>
                @endif
            </span>

            {{-- Pagination Elements --}}
            {{-- <div class="flex gap-2 items-center"> --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <span aria-disabled="true">
                        <span
                            class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-gray-700 bg-white  cursor-default leading-5 select-none">{{ $element }}</span>
                    </span>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        <span
                            wire:key="paginator-{{ $paginator->getPageName() }}-{{ $this->numberOfPaginatorsRendered[$paginator->getPageName()] }}-page{{ $page }}">
                            @if ($page == $paginator->currentPage())
                                <span aria-current="page">
                                    <span
                                        class="xl:text-base text-sm rounded-full py-4 px-8 text-white bg-[#37C99D]">{{ $page }}</span>
                                </span>
                            @else
                                <button wire:click="gotoPage({{ $page }}, '{{ $paginator->getPageName() }}')"
                                    class="bg-[#37c99d60] border-[#37C99D] xl:text-base text-sm rounded-full py-4 px-8 text-[#37C99D] focus:bg-[#37c99d60] focus:text-[#37C99D]"
                                    aria-label="{{ __('Go to page :page', ['page' => $page]) }}">
                                    {{ $page }}
                                </button>
                            @endif
                        </span>
                    @endforeach
                @endif
            @endforeach
            {{-- </div> --}}

            <span>
                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                    <button wire:click="nextPage('{{ $paginator->getPageName() }}')"
                        dusk="nextPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}.after"
                        rel="next"
                        class="border py-4 xl:text-base text-sm rounded-full px-6 text-[#37C99D] focus:bg-[#37C99D] focus:text-[white] border-[#37C99D]"
                        aria-label="{{ __('pagination.next') }}">
                        {{-- <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                        </svg> --}}
                        next
                    </button>
                @else
                    <span aria-disabled="true" aria-label="{{ __('pagination.next') }}">
                        <span
                            class="border py-4 xl:text-base text-sm rounded-full px-6 text-white bg-[#37C99D] border-[#37C99d60]"
                            aria-hidden="true">
                            {{-- <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                            </svg> --}}
                            next
                        </span>
                    </span>
                @endif
            </span>
        </nav>
    @endif
</div>

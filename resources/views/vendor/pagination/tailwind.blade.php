@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="flex items-center justify-between">
        <div class="flex justify-between flex-1 sm:hidden">
            @if ($paginator->onFirstPage())
                <span class="relative inline-flex items-center px-4 py-2 text-sm font-medium font-barlow text-c2 bg-c3 border border-c2 cursor-default leading-5 rounded-md dark:text-c2 dark:bg-c1 dark:border-c2">
                    {!! __('pagination.previous') !!}
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium font-barlow focus:bg-c1 dark:text-c3 border dark:border-c3 border-c1  leading-5 rounded-md hover:text-c3 focus:outline-none focus:ring ring-c2 active:bg-c3 active:text-c1 focus:text-c3 transition ease-in-out duration-150 dark:bg-c1 bg-c3 dark:active:bg-c3 dark:active:text-c1 dark:focus:border-c2 dark:focus:text-c1">
                    {!! __('pagination.previous') !!}
                </a>
            @endif

            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium font-barlow focus:bg-c1 dark:text-c3 border dark:border-c3 border-c1  leading-5 rounded-md hover:text-c3 focus:outline-none focus:ring ring-c2 active:bg-c3 active:text-c1 focus:text-c3 transition ease-in-out duration-150 dark:bg-c1 bg-c3 dark:active:bg-c3 dark:active:text-c1 dark:focus:border-c2 dark:focus:text-c1">
                    {!! __('pagination.next') !!}
                </a>
            @else
                <span class="relative inline-flex items-center px-4 py-2 text-sm font-medium font-barlow text-c2 bg-c3 border border-c2 cursor-default leading-5 rounded-md dark:text-c2 dark:bg-c1 dark:border-c2">
                    {!! __('pagination.next') !!}
                </span>
            @endif
        </div>

        <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
            <div>
                <p class="text-sm text-c1 leading-5">
                    {!! __('Showing') !!}
                    @if ($paginator->firstItem())
                        <span class="font-medium">{{ $paginator->firstItem() }}</span>
                        {!! __('to') !!}
                        <span class="font-medium">{{ $paginator->lastItem() }}</span>
                    @else
                        {{ $paginator->count() }}
                    @endif
                    {!! __('of') !!}
                    <span class="font-medium">{{ $paginator->total() }}</span>
                    {!! __('results') !!}
                </p>
            </div>

            <div>
                <span class="relative z-0 inline-flex rtl:flex-row-reverse shadow-sm rounded-md"> <!-- text-c1 dark:text-c2 bg-white dark:bg-c1 border border-c1 dark:border-c1-->
                    {{-- Previous Page Link --}}
                    @if ($paginator->onFirstPage())
                        <span aria-disabled="true" aria-label="{{ __('pagination.previous') }}">
                            <span class="relative inline-flex items-center px-2 py-2 text-sm font-medium text-c2 dark:text-c2 bg-white dark:bg-c1 cursor-default rounded-l-md leading-5 border dark:border-c2" aria-hidden="true">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                            </span>
                        </span>
                    @else
                        <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="relative inline-flex items-center px-2 py-2 text-sm font-medium text-c1 dark:text-c3 bg-white dark:bg-c1 rounded-l-md leading-5 hover:text-c2 focus:z-10 focus:outline-none hover:bg-c1 dark:hover:bg-c3 dark:hover:text-c1  active:bg-c1 dark:active:bg-c3 active:text-c2 transition ease-in-out duration-150 border dark:border-c2" aria-label="{{ __('pagination.previous') }}">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                        </a>
                    @endif

                    {{-- Pagination Elements --}}
                    @foreach ($elements as $element)
                        {{-- "Three Dots" Separator --}}
                        @if (is_string($element))
                            <span aria-disabled="true">
                                <span class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium  cursor-default leading-5 dark:bg-gray-800 dark:border-gray-600">{{ $element }}</span>
                            </span>
                        @endif

                        {{-- Array Of Links --}}
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $paginator->currentPage())
                                    <span aria-current="page">
                                        <span class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium hover:font-extrabold text-c1 bg-c3 border border-c2 cursor-default leading-5 dark:bg-c1 dark:border-c2 dark:text-c2 ">{{ $page }}</span>
                                    </span>
                                @else
                                    <a href="{{ $url }}" class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium hover:font-extrabold text-c1 bg-c3 border border-c2 leading-5 dark:hover:bg-c3 focus:z-10 focus:outline-none active:bg-c3 active:text-c1 active:font-extrabold transition ease-in-out duration-150 dark:bg-c1 dark:border-c2 dark:text-c3 dark:hover:text-c1 dark:active:bg-gray-700 dark:focus:border-blue-800 hover:bg-c1 hover:text-c3" aria-label="{{ __('Go to page :page', ['page' => $page]) }}">
                                        {{ $page }}
                                    </a>
                                @endif
                            @endforeach
                        @endif
                    @endforeach

                    {{-- Next Page Link --}}
                    @if ($paginator->hasMorePages())
                        <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="relative inline-flex items-center px-2 py-2 text-sm font-medium text-c1 dark:text-c3 bg-white dark:bg-c1 rounded-r-md leading-5 hover:text-c2 focus:z-10 focus:outline-none f hover:bg-c1 dark:hover:bg-c3 dark:hover:text-c1  active:bg-c1 dark:active:bg-c3 active:text-c2 transition ease-in-out duration-150 border dark:border-c2" aria-label="{{ __('pagination.next') }}">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                            </svg>
                        </a>
                    @else
                        <span aria-disabled="true" aria-label="{{ __('pagination.next') }}">
                            <span class="relative inline-flex items-center px-2 py-2 -ml-px text-sm font-medium text-c2 bg-white border border-gray-300 cursor-default rounded-r-md leading-5 dark:bg-c1 dark:border-c2" aria-hidden="true">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                </svg>
                            </span>
                        </span>
                    @endif
                </span>
            </div>
        </div>
    </nav>
@endif

<style type="text/css">
    .link-box{
        color: #0056b3 !important;
    }
    span.actived.link-box{
        border-color: #c9571b !important;
        background-color: #c9571b !important;
        color: #fff !important;
    }
</style>
@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="">
        <div class="row align-items-center justify-content-between">
            <div class="col-auto">
                <div class="result-wrap">
                    <p class="text-sm text-gray-700 leading-5">
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
            </div>
            <div class="col-auto">
                <div class="row no-gutters align-items-center justify-content-between">
                    <div class="col-auto">
                        @if ($paginator->onFirstPage())
                            <span class="link-box nxt-prv ps-0 relative inline-flex items-center px-3 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default leading-5 rounded-md">
                                {!! __('pagination.previous') !!}
                            </span>
                        @else
                            <a href="{{ $paginator->previousPageUrl() }}" class="link-box nxt-prv ps-0 relative inline-flex items-center px-3 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 rounded-md hover:text-gray-500 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150">
                                {!! __('pagination.previous') !!}
                            </a>
                        @endif
        
                        
                    </div>
                    <div class="col-auto">
        
                        <div class="d-flex align-items-center">
                            {{-- Pagination Elements --}}
                            @foreach ($elements as $element)
                                {{-- "Three Dots" Separator --}}
                                @if (is_string($element))
                                    <span aria-disabled="true">
                                        <span class="link-box relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-gray-700 bg-white border border-gray-300 cursor-default leading-5">{{ $element }}</span>
                                    </span>
                                @endif
                                <div>    
                                {{-- Array Of Links --}}
                                @if (is_array($element))
                                    @foreach ($element as $page => $url)
                                        @if ($page == $paginator->currentPage())
                                            <span aria-current="page" class="actived link-box relative inline-flex items-center px-3 py-2 -ml-px text-sm font-medium text-gray-500 bg-white border  border-gray-300 cursor-default leading-5">
                                                {{ $page }}
                                            </span>
                                        @else
                                            <a href="{{ $url }}" class="link-box relative inline-flex items-center px-3 py-2 -ml-px text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 hover:text-gray-500 focus:z-10 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150" aria-label="{{ __('Go to page :page', ['page' => $page]) }}">
                                                {{ $page }}
                                            </a>
                                        @endif
                                    @endforeach
                                @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-auto">
                        @if ($paginator->hasMorePages())
                            <a href="{{ $paginator->nextPageUrl() }}" class="link-box nxt-prv pe-0 relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 rounded-md hover:text-gray-500 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150">
                                {!! __('pagination.next') !!}
                            </a>
                        @else
                            <span class="link-box nxt-prv pe-0 relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default leading-5 rounded-md">
                                {!! __('pagination.next') !!}
                            </span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </nav>
@endif

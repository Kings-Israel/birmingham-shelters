<div class="row">
    @if ($paginator->hasPages())
    <nav class="col-lg-12 col-md-12 col-sm-12">
        <ul class="pagination">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
            <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                <span class="page-link" aria-hidden="true">
                    <span class="ti-arrow-left"></span>
                    <span class="sr-only">Previous</span>
                </span>
            </li>
            @else
            <li class="page-item">
                <a href="javascript:void(0);" role="button" dusk="previousPage" class="page-link" wire:click="previousPage"
                    wire:loading.attr="disabled" rel="prev" aria-label="@lang('pagination.previous')">
                    <span class="ti-arrow-left"></span>
                    <span class="sr-only">Previous</span>
                </a>
            </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
            <li class="page-item disabled" aria-disabled="true">
                <a href="javascript:void(0);" role="button" class="page-link">{{ $element }}</a></li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
            @foreach ($element as $page => $url)
            @if ($page == $paginator->currentPage())
            <li class="page-item active" wire:key="paginator-page-{{ $page }}" aria-current="page">
                <span class="page-link">{{ $page }}</span></li>
            @else
            <li class="page-item" wire:key="paginator-page-{{ $page }}">
                <a href="javascript:void(0);" role="button" class="page-link" wire:click.prevent="gotoPage({{ $page }})">{{ $page }}</a></li>
            @endif
            @endforeach
            @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
            <li class="page-item">
                <a href="javascript:void(0);" role="button" dusk="nextPage" class="page-link" wire:click.prevent="nextPage"
                    wire:loading.attr="disabled" rel="next" aria-label="@lang('pagination.next')">
                    <span class="ti-arrow-right"></span>
                    <span class="sr-only">Next</span>
                </a>
            </li>
            @else
            <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                <span class="page-link" aria-hidden="true">
                    <span class="ti-arrow-right"></span>
                    <span class="sr-only">Next</span>
                </span>
            </li>
            @endif
        </ul>
    </nav>
    @endif
</div>

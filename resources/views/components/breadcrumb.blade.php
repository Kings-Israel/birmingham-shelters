@props(['items' => []])

<!-- Breadcrumb -->
<nav class="breadcrumb-nav bg-white border-top border-bottom" aria-label="Breadcrumb">
    <ol>
        <li>
            <a href="{{ route('admin-dashboard') }}" title="Dashboard">
                <i class="ti ti-home"></i>
                <span class="sr-only">Home</span>
            </a>
        </li>
        @foreach ($items as $title => $link)
        <li>
            <svg class="heroicon-chevron-right" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
            </svg>
            <a href="{{ $link }}">{{ $title }}</a>
        </li>
        @endforeach
    </ol>
</nav>
<!-- END Breadcrumb -->

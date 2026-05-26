@if ($paginator->hasPages())
    <nav class="paginacao-customizada">
        
        @if ($paginator->onFirstPage())
            <span class="pag-disabled">&laquo;</span>
        @else
            <a href="{{ $paginator->url(1) }}" class="pag-link">&laquo;</a>
        @endif

        @if ($paginator->onFirstPage())
            <span class="pag-disabled">&lsaquo;</span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" class="pag-link">&lsaquo;</a>
        @endif

        <span class="pag-info">
            {{ $paginator->currentPage() }} de {{ $paginator->lastPage() }}
        </span>

        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="pag-link">&rsaquo;</a>
        @else
            <span class="pag-disabled">&rsaquo;</span>
        @endif

        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->url($paginator->lastPage()) }}" class="pag-link">&raquo;</a>
        @else
            <span class="pag-disabled">&raquo;</span>
        @endif
        
    </nav>
@endif
@if ($paginator->hasPages())
    <nav>
        <ul class="pagination">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="disabled pagination__prev" aria-disabled="true" aria-label="@lang('pagination.previous')">
                    <span aria-hidden="true">&lsaquo;</span>
                </li>
            @else
                <li>
                    <a class="pagination__prev" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">&lsaquo;</a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li class="disabled" aria-disabled="true"><span>{{ $element }}</span></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="active" aria-current="page"><span>{{ $page }}</span></li>
                        @else
                            <li><a href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li>
                    <a class="pagination__next" href="{{ $paginator->nextPageUrl() }}" rel="next"
                       aria-label="@lang('pagination.next')">&rsaquo;</a>
                </li>
            @else
                <li class="disabled pagination__next" aria-disabled="true" aria-label="@lang('pagination.next')">
                    <span aria-hidden="true">&rsaquo;</span>
                </li>
            @endif
        </ul>
    </nav>
    <h3>Элементов на странице:</h3>
    <form method="get" action="{{url('cars')}}">
        <select class="page--choice" name="perpage">
            <option value="2" @if($paginator->perPage() == 2) selected @endif>2</option>
            <option value="3" @if($paginator->perPage() == 3) selected @endif>3</option>
            <option value="4" @if($paginator->perPage() == 4) selected @endif>4</option>
            <option value="5" @if($paginator->perPage() == 5) selected @endif>5</option>
            <option value="6" @if($paginator->perPage() == 6) selected @endif>6</option>
            <option value="7" @if($paginator->perPage() == 7) selected @endif>7</option>
            <option value="10" @if($paginator->perPage() == 10) selected @endif>10</option>
        </select>
        <input class="pagination-change__btn" type="submit" value="Изменить">
    </form>
@endif
<style>
    .pagination-change__btn {
        background-color: transparent;
        font-weight: bold;
        width: 15%;
        transition: all 0.3s ease;
        margin-top: 10px;
        border: 2px solid #424040;
        border-radius: 5px;
        color: #424040;
        font-size: 18px;
        margin-left: 10px;

        &:hover {
            background-color: #424040;
            color: #b3b3b3;
            transform: scale(1.05);
        }
    }

    .page--choice {
        width: 15%;
        height: 33px;
        border-radius: 5px;
        border: 2px solid #424040;
        background-color: transparent;
        color: #424040;
        font-size: 18px;
    }

    .pagination {
        color: #800007;
        gap: 15px;
        display: flex;
        justify-content: center;
        font-size: 16px;
        margin-top: 15px;
        font-weight: bold;

        a {
            text-decoration: none;
            color: #424040;
            transition: all 0.3s ease;
            &:hover {
                color: #ea414c;
            }
        }

        .pagination__prev, .pagination__next {
            font-weight: bold;
        }
    }
</style>

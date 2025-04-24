{{--@if ($records->lastPage() > 1)--}}
{{--    <ul class="pagination pagination-round" style="display: block">--}}
{{--        <li class="page-item @if(!($records->currentPage() > 1)) hidden @endif "><a class="page-link" href="{{$basic."page=".($records->currentPage() -1) }}">قبلی</a></li>--}}
{{--        <li class="page-item @if($records->currentPage() ===1) active @endif"><a class="page-link " href="{{$basic."page=1" }}">1</a></li>--}}
{{--        @if($records->currentPage() - 3 > 1)--}}
{{--            <li class="page-item"><a class="page-link">...</a></li>--}}
{{--        @endif--}}
{{--        @for($i=2;$i<$records->lastPage();$i++)--}}
{{--            @if($i + 3 < $records->currentPage())--}}
{{--                @continue--}}
{{--            @endif--}}
{{--            @if($i - 3 > $records->currentPage())--}}
{{--                @continue--}}
{{--            @endif--}}
{{--            <li class="page-item @if($i=== $records->currentPage()) active @endif">--}}
{{--                <a class="page-link" href="{{$basic."page=".$i}}">{{$i}}</a>--}}
{{--            </li>--}}
{{--        @endfor--}}
{{--        @if($records->currentPage() + 3 < $records->lastPage())--}}
{{--            <li class="page-item"><a class="page-link">...</a></li>--}}
{{--        @endif--}}
{{--        <li class="page-item @if($records->currentPage() ===$records->lastPage()) active @endif"><a class="page-link " href="{{$basic."page=".$records->lastPage() }}">{{$records->lastPage()}}</a></li>--}}
{{--        <li class="page-item @if(!($records->currentPage() < $records->lastPage())) hidden @endif "><a class="page-link" href="{{$basic."page=".($records->currentPage() +1) }}">بعدی</a></li>--}}
{{--    </ul>--}}
{{--@endif--}}


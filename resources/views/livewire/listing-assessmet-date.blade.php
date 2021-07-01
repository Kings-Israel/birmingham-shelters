<div>
    <span class="m-l-15" style="display: flex">
        <i class="ti ti-calendar m-r-5"></i>
        @if ($date == null)
            <p style="color: red">Date not set</p>
        @else
            {{ $date }}
        @endif
    </span>
</div>

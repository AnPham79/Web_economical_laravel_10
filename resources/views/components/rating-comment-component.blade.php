<div class="rate d-flex align-items-center">
    @for ($i = 0; $i < 5; $i++)
        @if ($i < $rating)
            <i class="fa-solid fa-star text-warning" style="font-size: 13px;"></i>
        @else
            <i class="fa-solid fa-star text-secondary" style="font-size: 13px;"></i>
        @endif
    @endfor
</div>

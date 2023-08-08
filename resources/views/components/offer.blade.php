<div>
    @if ($offer != null && $offer?->status == 1)
        <div class="offer-notify">
            <div class="_content">
                <p class="__text">
                    {{ $offer->body }}
                </p>
                <button onclick="this.parentElement.style.display='none';" class="__close"><i
                        class="fa-solid fa-xmark"></i></button>
            </div>
        </div>
    @endif

</div>

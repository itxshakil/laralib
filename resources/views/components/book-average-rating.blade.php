<div>
    @for ($i = 0; $i < 5; $i++)
        <span class="@if($averageRating > $i)text-red-500 @endif">&hearts;</span>
    @endfor
</div>
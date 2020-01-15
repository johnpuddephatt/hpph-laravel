@if($film->reviews)
<div class="single-listing--reviews">
    @foreach($film->reviews as $review)
      @if(!empty($review->rating))
        <div class="single-listing--reviews--review">
        @if(!empty($review->url))<a href="{{ $review->url }}" _target="blank">@endif
        @if(!empty($review->text))<div class="single-listing--reviews--review--text">“{{ $review->text }}”</div>@endif
        @if(!empty($review->rating))
          <div class="single-listing--reviews--review--rating">
            @for ($i = 0; $i < $review->rating; $i++)
              &starf;
            @endfor
          </div>
        @endif
        @if(!empty($review->author))
          <div class="single-listing--reviews--review--author">
            {{ $review->author }}
          </div>
        @endif
        @if(!empty($review->url))</a>@endif
        </div>
      @endif
    @endforeach
</div>
@endif
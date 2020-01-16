<div class="single-listing--strand-details__OTR"
  style="background-color: {{ $strand->secondary_color }}; color: {{$strand->color}}; fill: {{$strand->color}}; stroke: {{$strand->color}}; stroke-width: 0;">
  @include('icons.on-the-road')
  <h3 class="single-listing--strand-heading">{{$strand->title}}</h3>
  @if($strand->venue_name)<p class="single-listing--strand-subtitle">at {{$strand->venue_name}}</p>@endif
  <div class="single-listing--strand-description">{!! $strand->short_description !!}   <a href="/strand/{{ $strand->slug}}">Read more</a>
</div>

  <div class="single-listing--strand--related">
    @foreach($strand->newestfilms() as $film)
      @include('film.card', ['compact' => true])
    @endforeach
  </div>
</div>
<a href="/strand/{{ $strand->slug}}" class="single-listing--strand-details
  @if($strand->color && (hexdec(substr($strand->color,1,2)) + hexdec(substr($strand->color,3,2)) + hexdec(substr($strand->color,5,2))) < 300 ) dark-bg @endif" style="background-color: {{ $strand->color }}">
  <h3 class="single-listing--strand-heading">A {{$strand->title}} screening</h3>
  <div>{!! $strand->short_description !!}</div>
  <div class="single-listing--strand-callout"> View all {{ $strand->title}} screenings</div>
</a>
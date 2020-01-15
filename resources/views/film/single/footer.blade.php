<div class="single-listing--text--footer">
  <table>
    @if( $film->language )<tr><td>Language:</td><td>{{ $film->language }}</td></tr>@endif
    @if( $film->director )<tr><td>Director:</td><td>{{ $film->director }}</td></tr>@endif
    @if( $film->starring )<tr><td>Starring:</td><td>{{ $film->starring }}</td></tr>@endif
    @if( $film->f_rating )<tr><td>F-Rating:</td><td>@if($film->f_rating == 3)Triple @else Single @endif</td></tr>@endif
    @if( $film->association )<tr><td>Association:</td><td>{{ $film->association }}</td></tr>@endif
    @if( $film->format )<tr><td>Format:</td><td>{{ $film->format }}</td></tr>@endif
    @if( $film->tickets && $film->tickets !== '<p><br></p>')<tr><td>Tickets:</td><td>{!! $film->tickets !!}</td></tr>@endif
  </table>
</div>
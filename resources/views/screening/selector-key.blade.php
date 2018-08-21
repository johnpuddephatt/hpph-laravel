@php
  $tag_collection = collect($tag_array)->unique('id')->all();
@endphp

@if (count($tag_collection) || $film->audio_description)
  <div class="single-listing--screenings--key">
    <h3 class="single-listing--screenings--key--heading">Key</h3>
    <table class="single-listing--screenings--key--content">
      <tbody>
      @if($film->audio_description)
        <tr class="single-listing--screenings--key--item">
          <td>
            @include('film.audio-description')
          </td>
          <td>
            <h4 class="single-listing--screenings--key--title">Audio Description available</h4>
            <p class="single-listing--screenings--key--description">Audio Description tracks available for those with visual impairment. Ask a member of staff on arrival if you’d like to use a headset.</p>
          </td>
        </tr>
      @endif
      @foreach($tag_collection as $tag)
        <tr class="single-listing--screenings--key--item">
          <td>
            @include('screening.tag')
          </td>
          <td>
            <h4 class="single-listing--screenings--key--title">{{$tag->title}}</h4>
            <p class="single-listing--screenings--key--description">{{ $tag->description}}</p>
          </td>
        </tr>
      @endforeach
      </tbody>
    </table>
  </div>
@endif

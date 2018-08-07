@if (count($tag_array))
  <div class="single-listing--screenings--key">
    <h3 class="single-listing--screenings--key--heading">Key</h3>
    <ul>
      @foreach($tag_array as $tag)
        <li class="single-listing--screenings--key--item">
          @include('screening.tag')
          <div>
            <h4 class="single-listing--screenings--key--title">{{$tag->title}}</h4>
            <p class="single-listing--screenings--key--description">{{ $tag->description}}</p>
          </div>
        </li>
      @endforeach
    </ul>
  </div>
@endif
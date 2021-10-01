@if($home_hydeandseek)
<section class="section section--home-watch">
  <div class="container">
    <div class="section--home-watch--image">
      @include('utils.intervention', [
      'alt' => "",
      'img' => $home_hydeandseek->thumb,
      'class' => "",
      'height' => "750",
      'width' => "750",
      'quality' => "68",
      'modes' => 'c_fill,g_center,f_auto'
      ])
      <a href="/film/{{ $home_hydeandseek->slug }}"
        class="section--home-watch--button button button__yellow button__big">
        <span class="pre">Next up:</span>
        <span class="title">{{ Carbon\Carbon::parse($home_hydeandseek->date)->format('D jS F') }}:
          {{ $home_hydeandseek->title }}</span>
      </a>
    </div>
    <div class="section--home-watch--text">
      <h2 class="section-title">Hyde &amp; Seek</h2>
      <p>The home of family-friendly screenings and activity – helping young audiences enjoy brilliant movies and
        discover the
        wonder of cinema.</p>
      <a href="/strand/hyde-seek/" class="button button__underline button__black">Hyde &amp; Seek film screenings</a>
      <a href="/discover-cinema" class="button button__underline button__black">Discover Cinema – online learning
        resources</a>

    </div>
  </div>
</section>
@endif
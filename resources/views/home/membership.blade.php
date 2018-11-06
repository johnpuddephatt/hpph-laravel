<section class="section section--home-membership">
  @include('utils.cloudinary', [
    'alt' => "",
    'img' => "/images/home-membership.jpg",
    'class' => "section--home-membership--image",
    'height' => "250",
    'width' => "750",
  ])
  <div class="container">
    <a href="/membership">
      <h2 class="section-title">Become a Friend of the Picture House</h2>
      <ul>
      <li>Discounted entry</li>
      <li>Invites to special events</li>
      <li>Film guides posted every month</li>
    </ul>
    </a>
  </div>
</section>


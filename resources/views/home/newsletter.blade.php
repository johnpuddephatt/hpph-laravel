<section class="section section--home-newsletter">
  <div class="container">
    @include('utils.intervention', [
      'alt' => "",
      'img' => "/images/home-membership.jpg",
      'class' => "section--home-newsletter--image",
      'height' => "750",
      'width' => "750",
      'quality' => "65",
      'modes' => 'c_fill,g_center,f_auto'
    ])
    <div class="section--home-newsletter--text">
      <h2 class="section-title">Stay up to date</h2>
      <p>From news and developments, to the latest screenings and special events – subscribe to our emails and stay up to date with your friendly, local cinema.</p>
      <form
        action="https://system.spektrix.com/hydeparkpicturehouse/website/secure/signup.aspx"
        method="POST">
        <div class="field">
          <label class="sr-only" for="firstNameSubscribe">First name</label>
          <input placeholder="First name" id="firstNameSubscribe" name="FirstName" required type="text" maxlength="30"/>
          <label class="sr-only" for="lastNameSubscribe">Last name</label>
          <input placeholder="Last name" id="lastNameSubscribe" name="LastName" required type="text" maxlength="80"/>
        </div>
        <div class="field">
          <label class="sr-only" for="emailSubscribe">Email address</label>
          <input placeholder="Email" id="emailSubscribe" name="Email" required type="email" maxlength="255" />
          <input
            type="hidden"
            name="ReturnUrl"
            value="{{ config('app.newsletter_redirect', 'https://hydeparkpicturehouse.co.uk/signedup')}}"/>
          <input type="submit" value="Subscribe"  class="button button__ghost button__black">
        </div>

      </form>
    </div>
  </div>

</section>


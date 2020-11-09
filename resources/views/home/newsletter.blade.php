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
      <h2 class="section-title">Never miss a screening</h2>
      <p>Sign up to our weekly listings newsletter to stay on top of our screenings.</p>
      <form
        action="https://system.spektrix.com/hydeparkpicturehouse/website/secure/signup.aspx"
        method="POST">
        <div class="field-row">
          <div class="field">
            <label for="firstNameSubscribe">First name</label>
            <input id="firstNameSubscribe" name="FirstName" required type="text" maxlength="30"/>
          </div>
          <div class="field">
            <label for="lastNameSubscribe">Last name</label>
            <input id="lastNameSubscribe" name="LastName" required type="text" maxlength="80"/>
          </div>
        </div>
        <div class="field">
          <label for="emailSubscribe">Email address</label>
          <input id="emailSubscribe" name="Email" required type="email" maxlength="255" />
        </div>
        <input
          type="hidden"
          name="ReturnUrl"
          value="{{ config('app.newsletter_redirect', 'https://hydeparkpicturehouse.co.uk/signedup')}}"/>
        <input type="submit" value="Subscribe"  class="button button__ghost button__black">

      </form>
    </div>
  </div>

</section>


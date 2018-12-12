<section class="section section--home-shop">
  <div class="container">
    <h2 class="section-title">Shop</h2>
      <div class="shop--grid">
        <a class="shop--link" href="//hydeparkpicturehouse.bigcartel.com/products">
          @include('utils.intervention', [
            'alt' => "Photograph of cinema postcards",
            'img' => "/images/shop-mug-studio.jpg",
            'class' => "shop--image",
            'height' => "500",
            'width' => "500",
            'quality' => "50"
          ])
          <div class="inner">
            <h3 class="shop--link--title">Merchandise</h3>
            <p class="shop--link--description">Prints, bags, mugs &amp; postcards</p>
          </div>
        </a>
        <a class="shop--link" href="//hydeparkpicturehouse.bigcartel.com/product/gift-voucher-5">
          @include('utils.intervention', [
            'alt' => "Photograph of cinema vouchers",
            'img' => "/images/shop-gift-voucher-studio.jpg",
            'class' => "shop--image",
            'height' => "250",
            'width' => "500",
            'quality' => "50"
          ])
          <div class="inner">
            <h3 class="shop--link--title">Gift Vouchers</h3>
          </div>
        </a>
        <a class="shop--link" href="//hydeparkpicturehouse.bigcartel.com/product/membership">
          @include('utils.intervention', [
            'alt' => "Photograph of membership card",
            'img' => "/images/shop-membership-card-studio.jpg",
            'class' => "shop--image",
            'height' => "250",
            'width' => "500",
            'quality' => "50"
          ])
          <div class="inner">
            <h3 class="shop--link--title">Gift Membership</h3>
          </div>
        </a>
      </div>
  </div>
</section>


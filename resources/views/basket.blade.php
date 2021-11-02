@if(config('app.env') === 'production')
<spektrix-basket-summary hidden id="spektrixBasketSummary" client-name="hydeparkpicturehouse"
  custom-domain="tickets.hydeparkpicturehouse.co.uk">
  <a href="/checkout/">
    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
        d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
    </svg>

    <span data-basket-item-count></span> item(s) (<span data-basket-summary-currency></span><span
      data-basket-summary-basket-total></span>)
  </a>
  <script>
    console.log('basket');
    
    var spektrixBasketSummary = document.getElementById('spektrixBasketSummary');
    console.log(spektrixBasketSummary);
    if(spektrixBasketSummary.count > 0) {
      spektrixBasketSummary.setAttribute('hidden', false);
    }
  </script>
</spektrix-basket-summary>


@endif
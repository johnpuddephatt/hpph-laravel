{{-- @push('body-classes','home') --}}

@push('scripts')

<script src="https://webcomponents.spektrix.com/stable/webcomponents-loader.js"></script>
<script src="https://webcomponents.spektrix.com/stable/spektrix-component-loader.js"
    data-components="spektrix-basket-summary" async></script>
@endpush

@extends('layouts.app')

@section('content')

<div class="container">
    <spektrix-donate client-name="hydeparkpicturehouse" custom-domain="tickets.hydeparkpicturehouse.co.uk"
        fund-id="XMAS">
        <span>Amount you are donating: £</span><span data-display-donation-amount></span>
        <button data-donate-amount="10">£10</button>
        <button data-donate-amount="20">£20</button>
        <button data-donate-amount="30">£30</button>
        <button data-submit-donation>Donate</button>
        <button data-clear-donation>Clear Donation</button>
        <div data-success-container style="display: none;">Insert success content/markup here</div>
        <div data-fail-container style="display: none;">Insert failure content/markup here</div>
    </spektrix-donate>
</div>

@stop
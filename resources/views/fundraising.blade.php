{{-- @push('body-classes','home') --}}

@push('scripts')
<link rel="stylesheet" href="{{ mix('/css/fundraising.css') }}" />
<script defer src="{{ @asset('js/fundraising.js') }}"></script>
@endpush

@extends('layouts.app')

@section('content')

<spektrix-donate hidden donation-amount="25" id="spektrixDonate" client-name="hydeparkpicturehouse"
    custom-domain="tickets.hydeparkpicturehouse.co.uk" fund-id="401ANPJQJQPQMRSBDNMVNLSPGTRBVQVRH">

    <button class="button button__big" data-submit-donation>Submit</button>
    <div data-success-container style="display: none;">
        Added to basket. <a href="/checkout">Go to checkout</a>
    </div>
    <div data-fail-container style="display: none;">
        Could not add to basket.
        <a href="mailto:info@hydeparkpicturehouse.co.uk">Contact us</a>
        if problems persist.
    </div>
</spektrix-donate>

<header
    class="min-h-[100vw] md:min-h-[45vw] items-center flex px-6 lg:px-32 space-x-8 bg-christmas-beige border-solid border-0 border-b relative">
    <div class="container w-full px-0 mb-32 md:mb-60">
        <div class="">
            <div class="mb-2 font-serif text-4xl italic font-normal lg:text-5xl text-christmas-blue">The Picture House
            </div>
            <h1 class="font-serif italic font-normal text-7xl lg:text-8xl">Winter Fundraiser</h1>
        </div>
        <img src="{{ @asset('/images/winter-fundraising-banner.svg') }}"
            class="absolute right-0 w-full md:w-[80%] bottom-12">
    </div>
</header>
<donations></donations>
@stop
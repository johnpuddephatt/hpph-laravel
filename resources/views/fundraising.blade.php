{{-- @push('body-classes','home') --}}

@push('scripts')
<link rel="stylesheet" href="{{ mix('/css/fundraising.css') }}" />
<script defer src="{{ @asset('js/fundraising.js') }}"></script>
@endpush

@extends('layouts.app')

@section('content')

<spektrix-donate donation-amount="25" id="spektrixDonate" client-name="hydeparkpicturehouse"
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
    class="min-h-[60vh] flex items-center px-12 lg:px-32 py-16 space-x-8 bg-gray-100 border-solid border-0 border-b border-gray-300">
    <div class="container px-0">
        <div class="lg:w-2/3">
            <h1 class="mt-12 mb-8 text-6xl">Picture House Winter Fundraiser</h1>
            <p>With our redevelopment project now underway, we’re asking you – our wonderful community – for your help
                to raise the final funds required to
                deliver upcoming conservation work, ahead of our reopening next year.</p>
        </div>
    </div>
</header>
<donations></donations>
@stop
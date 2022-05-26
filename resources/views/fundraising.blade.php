{{-- @push('body-classes','home') --}}

@push('scripts')
<link rel="stylesheet" href="{{ mix('/css/fundraising.css') }}" />
<script defer src="{{ @asset('js/fundraising.js') }}"></script>
<script defer>
    document.addEventListener('DOMContentLoaded', ()=>{
        var date1 = new Date('12/24/2021');
        var date2 = new Date();
        var difference = date1.getTime() - date2.getTime();
        var days = Math.ceil(difference / (1000 * 3600 * 24));
        if(days >= 0) {
            document.querySelector('#time-remaining').innerText = days + ' days to go!';
        }
    });
</script>
@endpush

@extends('layouts.app')

@section('content')

<spektrix-donate hidden donation-amount="25" id="spektrixDonate" client-name="leedsheritagetheatres"
    custom-domain="tickets.hydeparkpicturehouse.co.uk" fund-id="401ANPJQJQPQMRSBDNMVNLSPGTRBVQVRH">
    <input id="tribute-name" type="text" data-tribute-name />
    <input id="tribute-type" type="text" name="tributeType" data-tribute-type />
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
    class="min-h-[120vw] md:min-h-[45vw] items-center flex px-6 lg:px-32 space-x-8 bg-christmas-beige border-solid border-0 border-b relative">
    <div class="container w-full px-0 mb-32 md:mb-60">
        <div class="">

            <div class="mt-6 mb-2 font-serif text-4xl italic font-normal lg:text-5xl text-christmas-blue">The Picture
                House
            </div>
            <h1 class="font-serif italic font-normal text-7xl lg:text-8xl">Winter Fundraiser</h1>
            <div class="mt-3 md:mt-6">
                <p id="time-remaining" class="inline-block px-4 font-medium text-white bg-christmas-red"></p>

            </div>
        </div>
        <img src="{{ @asset('/images/winter-fundraising-banner.svg') }}"
            class="absolute right-0 w-full md:w-[80%] bottom-12">
    </div>
</header>
<donations></donations>
@stop
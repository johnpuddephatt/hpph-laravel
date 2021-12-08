@push('scripts')
@endpush

@extends('layouts.app')

@section('content')

<div class="container container__narrow">
    <br><br><br><br>
    <spektrix-donate donation-amount="50" id="spektrixDonate" client-name="hydeparkpicturehouse"
        custom-domain="tickets.hydeparkpicturehouse.co.uk" fund-id="1201AQKTLDJVPVNVGVNTLHSSDPLSGRGBT">
        <h2>Sponsor a seat – staff and volunteers</h2>
        <p><strong>Seat sponsorship is open to the public for £100, but to say thank you to our staff and
                volunteers we’re making this available to you at a reduced rate of £50.</strong></p>
        <p>As a thank you for sponsoring a seat, we’ll install a personalised plaque on a seat of your choice, in either
            the stalls or balcony of our main auditorium. This plaque will remain in place for the lifetime of the seat,
            and can include a name, a short message or a quote.</p>
        <input style="display: none;" id="tribute-name" type="text" data-tribute-name />
        <input style="display: none;" id="tribute-type" type="text" name="tributeType" data-tribute-type />
        <button class="button button__big" data-submit-donation>Add to basket</button>
        <br>
        <div data-success-container style="display: none;">
            Added to basket. <a href="/checkout">Go to checkout</a>
        </div>
        <div data-fail-container style="display: none;">
            Could not add to basket.
            <a href="mailto:info@hydeparkpicturehouse.co.uk">Contact us</a>
            if problems persist.
        </div>
    </spektrix-donate>
    <br><br><br><br>
</div>
@stop
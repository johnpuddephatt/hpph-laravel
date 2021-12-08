@push('scripts')
@endpush

@extends('layouts.app')

@section('content')

<div class="container container__narrow">
    <br><br><br><br>
    <spektrix-donate donation-amount="50" id="spektrixDonate" client-name="hydeparkpicturehouse"
        custom-domain="tickets.hydeparkpicturehouse.co.uk" fund-id="1201AQKTLDJVPVNVGVNTLHSSDPLSGRGBT">
        <h2>Sponsor a seat – staff and volunteers</h2>
        <h3>£50</h3>


        <p>We’ve now launched our Sponsor a Seat scheme, to help towards the costs of reseating our main auditorium.</p>

        <p>To thank staff and volunteers for your many years of support, and to ensure the scheme is open to as many of
            you as possible, we’ve introduced a specially discounted rate of £50, down from the standard £150.</p>

        <p>By sponsoring a seat, you’ll receive a personalised plaque, installed on a seat of your choice, in either the
            stalls or balcony of our main auditorium. This plaque will remain in place for the lifetime of the seat, and
            can
            include a name, a short message or a quote.</p>

        <p>Sponsors will also be invited to a special event close to the cinema’s reopening, which will include a drinks
            reception and a screenings, where sponsors will be able to sit in their sponsored seat for the first time.
        </p>

        <p>Once you’ve placed your order, we’ll be in touch directly to confirm the location of your seat and what you’d
            like us to include on the plaque.</p>

        <p>If you have any questions, please don’t hesitate to get in touch with Ollie who will be very happy to help:
            <a href="mailto:ollie@hydeparkpicturehouse.co.uk">ollie@hydeparkpicturehouse.co.uk</a>
        </p>


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
{{-- @push('body-classes','home') --}}

@push('scripts')
<link rel="stylesheet" href="{{ mix('/css/fundraising.css') }}" />
{{-- <script src="https://webcomponents.spektrix.com/stable/webcomponents-loader.js"></script> --}}
{{-- <script src="https://webcomponents.spektrix.com/stable/spektrix-component-loader.js"
    data-components="spektrix-donate" async></script> --}}
<script defer src="{{ @asset('js/fundraising.js') }}"></script>
@endpush

@extends('layouts.app')

@section('content')


<div class="container">

    <header class="container mb-16 py-16 px-16 flex items-center space-x-8 content-center bg-gray-100 rounded-lg">
        <div class="w-1/2">
            <h1 class="mb-8 text-5xl">Christmas fundraising campaign</h1>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Cupiditate, labore reiciendis, laudantium, nam
                beatae assumenda obcaecati quasi enim illo eius eaque libero. Minima cupiditate facere ab. Inventore
                praesentium asperiores quas.</p>
        </div>
        <div class="text-center w-1/2">
            <donation-slider></donation-slider>
        </div>
    </header>
</div>

<div class="container container__narrow flex flex-col space-y-16 mb-32">
    @foreach([1,2,3,4,5] as $row)
    <div class="flex space-x-8 border-b items-center">
        <iframe class="w-2/5" width="560" height="315" src="https://www.youtube.com/embed/kKYiRtFNZss"
            title="YouTube video player" frameborder="0"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
            allowfullscreen></iframe>
        <div class="">
            <h2>Reward title</h2>
            <p>Area title</p>
        </div>
    </div>
    @endforeach
</div>
@stop
<header
  class="min-h-[120vw] md:min-h-[50vw] items-center flex px-3 md:px-6 lg:px-32 space-x-8 bg-christmas-beige border-solid border-0 border-b relative">
  <div class="container w-full px-0 mb-32 md:mb-24">
    <div class="relative md:w-5/6">
      <div class="md:mb-3">
        <p id="time-remaining" class="inline-block px-4 font-medium text-white bg-christmas-red"></p>
      </div>
      <div class="mb-2 font-serif text-4xl italic font-normal lg:text-5xl text-christmas-blue">Winter Fundraiser
      </div>
      <h1 class="font-serif text-5xl italic font-normal lg:text-6xl">Help us deliver vital conservation work this
        Christmas</h1>
      <a class="inline-block px-6 py-3 font-bold text-black bg-white rounded md:mt-8" href="/winter-fundraiser">Learn
        more</a>
    </div>
    <img src="{{ @asset('/images/winter-fundraising-banner.svg') }}"
      class="absolute pointer-events-none right-0 w-full md:w-[80%] bottom-12">

    <script>
      var date1 = new Date('12/25/2021');
        var date2 = new Date();
        var difference = date1.getTime() - date2.getTime();
        var days = Math.ceil(difference / (1000 * 3600 * 24));
        document.querySelector('#time-remaining').innerText = days + ' days to go!';
    </script>
  </div>
</header>
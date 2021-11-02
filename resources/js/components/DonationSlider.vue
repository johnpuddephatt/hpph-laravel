<template>
  <div>
    <div>
      <div class="relative inline-block">
        <div
          class="absolute flex items-center justify-center w-20 h-20 text-xs text-center text-white bg-red-900 rounded-full -top-3 -right-3"
        >
          <span v-html="`${selected.available}<br> available`"></span>
        </div>
        <div
          class="w-48 h-48 px-4 pt-4 mx-auto my-4 overflow-hidden rounded-full"
          :class="selected.color"
        >
          <img class="block max-h-full mx-auto" :src="selected.image" />
        </div>
      </div>

      <div class="mb-1 text-4xl font-bold" v-text="`£${selected.value}`"></div>

      <h3 class="mb-1">
        <span v-text="selected.label"></span>
      </h3>
      <p
        class="inline-block px-3 py-1 text-xs font-normal text-white bg-gray-500 rounded-full"
        v-text="selected.location"
      ></p>
      <p class="max-w-md mx-auto text-sm">
        <span v-text="selected.description"></span>
        <a class="font-bold text-black" href="#">Find out more&thinsp;»</a>
      </p>
    </div>

    <div class="flex flex-row items-center w-1/2 mx-auto my-4 space-x-4">
      <label class="mb-0" for="volume">Amount</label>
      <input
        v-model="value"
        class="flex-grow"
        type="range"
        id="amount"
        name="amount"
        min="0"
        max="3"
      />
    </div>

    <spektrix-donate
      donation-amount="25"
      client-name="hydeparkpicturehouse"
      custom-domain="tickets.hydeparkpicturehouse.co.uk"
      fund-id="401ANPJQJQPQMRSBDNMVNLSPGTRBVQVRH"
    >
      <button class="button button__big" data-submit-donation>
        Make your donation of £<span data-display-donation-amount></span>
      </button>
      <div data-success-container style="display: none;">
        Added to basket. <a href="/checkout">Go to checkout</a>
      </div>
      <div data-fail-container style="display: none;">
        Could not add to basket.
        <a href="mailto:info@hydeparkpicturehouse.co.uk">Contact us</a> if
        problems persist.
      </div>
    </spektrix-donate>
  </div>
</template>

<script>
export default {
  data() {
    return {
      value: 1,
      values: [
        {
          label: 'Repainting & plasterwork repair',
          location: 'main auditorium & foyer',
          reward: 'A3 paint sample print',
          value: 25,
          available: 250,
          color: 'bg-[#fdf6df]',
          description:
            'Lorem ipsum dolor sit amet adipisicing elit. Cupiditate, labore reiciendis, laudantium.',
          image:
            'https://res.cloudinary.com/hpph/image/upload/w_175,e_trim,c_scale/f_auto/v1596451154/hidinginplainsight/starcinema.svg',
        },
        {
          label: 'Terrazzo repair & restoration',
          location: 'foyer',
          reward: 'Terrazzo workshop',
          value: 50,
          available: 100,
          color: 'bg-[#b4cce8]',
          description:
            'Lorem ipsum dolor sit amet adipisicing elit. Cupiditate, labore reiciendis, laudantium.',
          image:
            'https://res.cloudinary.com/hpph/image/upload/w_175,e_trim,c_scale/f_auto/v1596451156/hidinginplainsight/scala.svg',
        },
        {
          label: 'Façade repair & restoration',
          location: 'external',
          value: 75,
          reward: 'Façade style coasters from Suken Studios',
          available: 100,
          color: 'bg-[#d17d47]',
          description:
            'Lorem ipsum dolor sit amet adipisicing elit. Cupiditate, labore reiciendis, laudantium.',
          image:
            'https://res.cloudinary.com/hpph/image/upload/w_175,e_trim,c_scale/f_auto/v1596451162/hidinginplainsight/pudseypicturehouse.svg',
        },
        {
          label: 'Lamppost restoration',
          location: 'external',
          reward: 'Golden lamppost broach',
          value: 100,
          available: 100,
          color: 'bg-[#efd68d]',
          description:
            'Lorem ipsum dolor sit amet adipisicing elit. Cupiditate, labore reiciendis, laudantium.',
          image:
            'https://res.cloudinary.com/hpph/image/upload/w_175,e_trim,c_scale/f_auto/v1595964823/hidinginplainsight/abbeypicturehouse.svg',
        },
      ],
    };
  },
  mounted() {
    // this.transferValue();
    let polyfillScript = document.createElement('script');
    polyfillScript.setAttribute(
      'src',
      'https://webcomponents.spektrix.com/stable/webcomponents-loader.js'
    );
    document.head.appendChild(polyfillScript);

    let componentScript = document.createElement('script');
    componentScript.setAttribute(
      'src',
      'https://webcomponents.spektrix.com/stable/spektrix-component-loader.js'
    );
    componentScript.setAttribute('data-components', 'spektrix-donate');
    document.head.appendChild(componentScript);
  },
  computed: {
    selected: function() {
      return this.values[this.value];
    },
  },
  watch: {
    value: function() {
      this.transferValue();
    },
  },

  methods: {
    transferValue() {
      console.log(this.$refs.widget);
      console.log('transfering...', this.values[this.value].value);
      document.querySelector('spektrix-donate').donationAmount = this.values[
        this.value
      ].value;
    },
  },
};
</script>

<style lang="scss"></style>

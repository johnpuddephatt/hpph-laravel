import Vue from 'vue';
import Donations from './components/Donations.vue';

import DonationSlider from './components/DonationSlider.vue';

Vue.config.ignoredElements = [/^spektrix-/];

var app = new Vue({
  el: '#app',
  components: {
    'donation-slider': DonationSlider,
    donations: Donations,
  },
});

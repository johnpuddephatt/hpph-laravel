import Vue from "vue";
import DonationSlider from "./components/DonationSlider.vue";

Vue.config.ignoredElements = [/^spektrix-/];

var app = new Vue({
  el: "#app",
  components: {
    "donation-slider": DonationSlider,
  },
});

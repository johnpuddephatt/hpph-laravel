import Vue from 'vue';
import Donations from './components/Donations.vue';

Vue.config.ignoredElements = [/^spektrix-/];

var app = new Vue({
  el: '#app',
  components: {
    donations: Donations,
  },
});

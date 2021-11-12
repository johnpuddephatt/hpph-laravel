<template>
  <div ref="wrapper" class="w-screen overflow-hidden">
    <modal @closeModal="showModal = false" v-show="showModal"></modal>
    <div
      class="flex flex-row w-[300vw] lg:w-[160vw] transform transition"
      :class="{
        '!translate-x-[-66.667%] lg:!translate-x-[-37.5%]': currentRewardID,
        'translate-x-[-33.333%]': showRewards,
      }"
    >
      <div class="w-screen p-6 lg:p-12 lg:w-3/5 lg:pl-32">
        <div class="flex flex-row items-center gap-4 mb-12 lg:hidden">
          <button
            @click="showRewards = false"
            class="px-6 py-3 font-sans text-lg bg-blue-100 border-none rounded-lg appearance-none"
          >
            Overview
          </button>
          <button
            @click="showRewards = true"
            class="px-6 py-3 font-sans text-lg bg-transparent border-none rounded-lg appearance-none hover:bg-blue-200"
          >
            Sponsorship opportunities
          </button>
        </div>
        <div class="mt-12 text-gray-600 lg:pr-12">
          <p class="mb-8 text-2xl font-medium text-black">
            With our redevelopment project now underway, we’re asking you – our
            amazing community – for your help to raise the final funds required
            to deliver upcoming conservation work, ahead of our reopening next
            year.
          </p>
          <p>
            The Picture House Winter Fundraiser provides you with an opportunity
            to sponsor parts of the cinema which are in need of expert
            conservation – from the repair of our tiled façade to the
            restoration of our iconic lamppost.
          </p>

          <p>
            And as a thank you, we’ve produced several bespoke, limited-edition
            rewards – which also make perfect gifts at this time of year. These
            also come with commemorative postcards, with information about what
            your donation is helping to support.
          </p>

          <p>
            So this Christmas, be part of this crucial chapter in the Picture
            House’s story. Help us complete this once in a century project and
            restore some of your favourite original features back to their
            former glory.
          </p>
          <button
            @click="showRewards = true"
            class="px-8 py-6 mt-4 font-sans text-lg font-medium bg-blue-100 border-0 rounded appearance-none hover:bg-blue-200 lg:hidden"
          >
            View the opportunities
          </button>

          <h2 class="mt-16 mb-8 text-3xl ">
            Frequently asked questions
          </h2>
          <details
            v-for="(faq, key) in faqs"
            :key="key"
            class="border-2 border-gray-100 border-solid"
            :class="{ 'border-t-0': key > 0 }"
          >
            <summary class="p-3 transition cursor-default hover:bg-gray-50">{{
              faq.question
            }}</summary>
            <p class="px-6 pt-4 pb-0">
              {{ faq.answer }}
            </p>
          </details>
        </div>
      </div>
      <div
        class="w-screen p-6 py-8 bg-blue-50 lg:p-12 lg:pt-16 lg:w-2/5 lg:pr-32"
      >
        <div
          v-if="dataLoaded"
          :class="{
            'transform translate-x-20': currentRewardID,
            '!translate-x-0': currentRewardID && showRewards,
          }"
          class="transition"
        >
          <button
            @click="currentRewardID = showRewards = null"
            class="mb-2 font-sans text-base text-left text-gray-600 bg-transparent border-none appearance-none"
            :class="{ invisible: !(showRewards || currentRewardID) }"
          >
            &larr; Back to overview
          </button>
          <h2 class="mt-4 mb-12 text-5xl lg:text-2xl">
            Sponsorship opportunities
          </h2>
          <div class="flex flex-col gap-6 ">
            <button
              :key="reward.id"
              v-for="reward in rewards"
              @click="currentRewardID = reward.id"
              class="flex flex-row items-stretch justify-between w-full gap-3 py-0 pl-0 pr-0 font-sans text-left transition bg-white border-0 border-none appearance-none hover:ring-4 ring-blue-300"
              :class="{ 'ring-blue-400 ring-4': currentRewardID == reward.id }"
            >
              <img
                class="w-28 h-28"
                :src="
                  `/imager/w_400,h_400,q_80,f_jpg,g_center/${reward.thumbnail}`
                "
              />
              <div class="flex-grow py-2 my-auto">
                <h3 class="mb-1.5 leading-tight">{{ reward.label }}</h3>
                <p
                  class="mb-0 font-serif text-lg italic leading-none text-gray-600"
                >
                  Reward: {{ reward.reward_title_short }}
                </p>
              </div>
              <div
                class="flex flex-col justify-center flex-none w-1/6 px-1 text-lg font-bold text-center text-white bg-christmas-blue"
              >
                <div>£{{ reward.value }}</div>
              </div>
            </button>
          </div>
        </div>
      </div>
      <div class="w-screen p-6 prose lg:p-12 lg:w-3/5 lg:pr-36 lg:pt-16">
        <div class="pb-8" v-if="currentRewardID">
          <button
            @click="currentRewardID = null"
            class="font-sans text-base text-left text-gray-600 bg-transparent border-none appearance-none lg:hidden"
          >
            &larr; Back to rewards
          </button>
          <header class="flex-row items-center justify-between gap-4 lg:flex">
            <h2 class="m-0 mt-4 text-5xl lg:mt-0">{{ currentReward.label }}</h2>

            <button
              aria-label="Add this reward to your basket"
              @click="makeDonation(currentReward.value)"
              class="flex flex-row items-center flex-none p-0 m-0 mt-6 font-sans text-white transition border-0 appearance-none lg:mt-0 hover:ring-4 ring-blue-300 bg-christmas-blue"
            >
              <div
                class="flex flex-row items-center pr-6 text-sm font-bold leading-none text-gray-700 lowercase bg-white border-2 border-solid border-christmas-blue"
              >
                <img
                  class="w-16 h-16 px-4 py-2 "
                  src="/images/present-icon.svg"
                />
                Add to <br />basket
              </div>
              <div class="px-6 text-xl font-bold text-center ">
                £{{ currentReward.value }}
              </div>
            </button>
          </header>

          <div
            class="mt-3 mb-12 font-serif text-xl italic tracking-normal text-gray-600"
          >
            Reward: {{ currentReward.reward_title }}
            <span class="block lg:inline"
              >({{ currentReward.available }}
              available) –
              <button
                class="p-0 font-sans text-sm text-gray-600 underline bg-transparent border-0 appearance-none"
                @click="$refs.rewardDetails.scrollIntoView()"
              >
                see details
              </button>
            </span>
          </div>

          <p
            v-if="currentReward.about_intro"
            class="text-gray-600"
            v-html="currentReward.about_intro.replace(/\n/g, '<br />')"
          />

          <div
            class="flex flex-row gap-4 mx-6 my-16 lg:mx-12"
            v-if="currentReward.about_images"
          >
            <img
              class="w-1/2 bg-blue-50"
              v-for="about_image in currentReward.about_images"
              :key="about_image"
              height="640"
              width="480"
              :src="`/imager/w_480,h_640,q_80,f_jpg,g_center/${about_image}`"
            />
          </div>

          <p
            v-if="currentReward.about_outro"
            class="text-gray-600"
            v-html="currentReward.about_outro.replace(/\n/g, '<br />')"
          />

          <div class="mx-6 lg:mx-12">
            <div
              class="responsive-iframe"
              v-html="currentReward.about_video"
            ></div>
          </div>

          <h3
            ref="rewardDetails"
            class="pt-12 mt-16 mb-1 text-4xl border-0 border-t-2 border-black border-solid"
          >
            About the reward
          </h3>
          <div
            class="mb-8 font-serif text-2xl italic tracking-normal text-gray-600"
          >
            {{ currentReward.reward_title }}
            <span class="block lg:inline">
              ({{ currentReward.available }} available)
            </span>
          </div>
          <p
            v-if="currentReward.reward_intro"
            class="text-gray-600"
            v-html="currentReward.reward_intro.replace(/\n/g, '<br />')"
          ></p>

          <div
            class="flex flex-row gap-4 mx-6 my-16 lg:mx-12"
            v-if="currentReward.reward_images"
          >
            <img
              class="w-1/2 bg-blue-50"
              v-for="reward_image in currentReward.reward_images"
              :key="reward_image"
              height="480"
              width="480"
              :src="`/imager/w_480,h_480,q_80,f_jpg,g_center/${reward_image}`"
            />
          </div>

          <p
            v-if="currentReward.reward_outro"
            class="text-gray-600"
            v-html="currentReward.reward_outro.replace(/\n/g, '<br />')"
          ></p>

          <div class="flex flex-row mt-16 bg-blue-50">
            <img
              height="600"
              width="800"
              class="object-cover object-center w-1/3 bg-blue-200 lg:w-2/5"
              :src="
                `/imager/w_800,h_600,q_80,f_jpg,g_center/${currentReward.thumbnail}`
              "
            />
            <div class="px-4 py-6 lg:p-8">
              <h2 class="m-0 mb-2 text-xl lg:text-2xl lg:mb-6">
                {{ currentReward.label }}
              </h2>

              <button
                aria-label="Add this reward to your basket"
                @click="makeDonation(currentReward.value)"
                class="flex flex-row items-center p-0 m-0 font-sans text-white transition border-0 appearance-none hover:ring-4 ring-blue-300 bg-christmas-blue"
              >
                <div
                  class="flex flex-row items-center pr-6 text-sm font-bold leading-none text-gray-700 lowercase bg-white border-2 border-solid border-christmas-blue"
                >
                  <img
                    class="w-16 h-16 px-4 py-2 "
                    src="/images/present-icon.svg"
                  />
                  Add to <br />basket
                </div>
                <div class="px-6 text-xl font-bold text-center ">
                  £{{ currentReward.value }}
                </div>
              </button>
            </div>
          </div>
          <button
            @click="currentRewardID = null"
            class="mt-8 font-sans text-base text-left bg-transparent border-none appearance-none lg:hidden"
          >
            &larr; Back to rewards
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import modal from './Modal.vue';
export default {
  components: {
    modal,
  },
  data() {
    return {
      dataLoaded: false,
      showModal: false,
      currentRewardID: null,
      showRewards: false,

      rewards: [],
      faqs: [],
    };
  },
  mounted() {
    fetch('https://simplejsoncms.com/api/vygli8mtv78')
      .then(response => response.json())
      .then(data => {
        this.rewards = data.rewards;
        this.faqs = data.faqs;
        this.dataLoaded = true;
      });
  },
  computed: {
    currentReward: function() {
      return this.rewards.find(elem => {
        return elem.id == this.currentRewardID;
      });
    },
  },
  watch: {
    currentRewardID: function() {
      this.$refs.wrapper.scrollIntoView();
    },
    showRewards: function() {
      this.$refs.wrapper.scrollIntoView();
    },
  },

  methods: {
    makeDonation(amount) {
      let donationComponent = document.getElementById('spektrixDonate');
      donationComponent.setAttribute('donation-amount', amount);
      let button = donationComponent.querySelector('button');
      button.click();
      this.showModal = true;
    },
  },
};
</script>

<style lang="scss"></style>

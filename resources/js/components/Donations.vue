<template>
  <div class="w-screen overflow-hidden">
    <modal @closeModal="showModal = false" v-show="showModal"></modal>
    <div
      class="flex flex-row w-[300vw] lg:w-[166.67vw] transform transition"
      :class="{
        '!translate-x-[-66.667%] lg:!translate-x-[-40%]': currentRewardID,
        'translate-x-[-33.333%]': showRewards,
      }"
    >
      <div class="w-screen p-6 lg:p-12 lg:w-2/3 lg:pl-32">
        <div class="flex flex-row items-center gap-4 mb-12 lg:hidden">
          <button
            @click="showRewards = false"
            class="px-6 py-3 font-sans text-lg border-none rounded-lg appearance-none bg-gray-50"
          >
            Overview
          </button>
          <button
            @click="showRewards = true"
            class="px-6 py-3 font-sans text-lg bg-transparent border-none rounded-lg appearance-none hover:bg-gray-100"
          >
            Sponsorship opportunities
          </button>
        </div>
        <div class="mt-12 text-gray-500 lg:pr-12">
          <p>
            The Picture House Winter Fundraiser provides you with an opportunity
            to sponsor parts of the cinema which are in need of expert
            conservation – from the repair of our tiled façade to the
            restoration of our iconic lamppost.
          </p>
          <p>
            And as a thankyou, we’ve produced several bespoke, limited-edition
            rewards – which also make perfect gifts at this time of year.
          </p>
          <p>
            They also come with commemorative postcards, with infomation about
            what your donation will be helping to support.
          </p>
          <p>
            So this Christmas, be part of this crucial chapter in the Picture
            House’s story. Help us complete this once in a century project and
            restore some of your favourite original features back to their
            former glory.
          </p>
          <button
            @click="showRewards = true"
            class="lg:hidden button button__big"
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
      <div class="w-screen p-6 bg-gray-100 lg:p-12 lg:w-1/3 lg:pr-32">
        <div
          :class="{
            'transform translate-x-20': currentRewardID,
            '!translate-x-0': currentRewardID && showRewards,
          }"
          class="flex flex-col gap-4 transition"
        >
          <button
            @click="currentRewardID = showRewards = null"
            class="py-3 font-sans text-base text-left bg-transparent border-none appearance-none"
            :class="{ invisible: !(showRewards || currentRewardID) }"
          >
            &larr; Back to overview
          </button>
          <h2 class="text-3xl">Sponsorship opportunities</h2>
          <button
            :key="reward.id"
            v-for="reward in rewards"
            @click="currentRewardID = reward.id"
            class="flex flex-row items-center justify-between w-full gap-2 px-4 py-6 font-sans text-left bg-white border-none rounded shadow appearance-none hover:ring-4 ring-yellow-200"
            :class="{ 'ring-yellow-300 ring-4': currentRewardID == reward.id }"
          >
            <div>
              <h3 class="mb-1.5">{{ reward.label }}</h3>
              <p class="mb-0 leading-snug text-gray-500">
                Reward: {{ reward.reward }}
              </p>
            </div>
            <div class="text-2xl font-bold">£{{ reward.value }}</div>
          </button>
        </div>
      </div>
      <div class="w-screen p-6 prose lg:p-12 lg:w-2/3 lg:pr-36">
        <div class="pt-8" v-if="currentRewardID">
          <button
            @click="currentRewardID = null"
            class="font-sans text-base text-left bg-transparent border-none appearance-none lg:hidden"
          >
            &larr; Back to rewards
          </button>
          <header class="flex-row gap-4 mb-12 lg:flex">
            <h2 class="mt-6 text-5xl">{{ currentReward.label }}</h2>
            <div
              class="flex flex-row items-center justify-between gap-2 mt-6 lg:flex-col"
            >
              <div class="text-3xl font-bold">£{{ currentReward.value }}</div>
              <button
                @click="makeDonation(currentReward.value)"
                class="mt-1 mb-auto button button__big"
              >
                Add to basket
              </button>
            </div>
          </header>

          <div class="text-gray-500" v-html="currentReward.description"></div>

          <h3 class="mt-12">Reward: {{ currentReward.reward }}</h3>
          <div v-html="currentReward.reward_description"></div>
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
      showModal: false,
      currentRewardID: null,
      showRewards: false,
      rewards: [
        {
          id: 1,
          label: 'Repainting & plasterwork repair',
          location: 'main auditorium & foyer',
          reward: 'A3 paint sample print',
          reward_description:
            'Limited edition enamel pin badge, featuring illustration by Adam Allsuch Boardman. Comes with commemorative postcard. Delivery within 5 working days',
          value: 25,
          available: 250,
          description:
            '<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Cupiditate, labore reiciendis, laudantium, nam beatae assumenda obcaecati quasi enim illo eius eaque libero. Minima cupiditate facere ab. Inventore praesentium asperiores quas.</p><p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Cupiditate, labore reiciendis, laudantium, nam beatae assumenda obcaecati quasi enim illo eius eaque libero. Minima cupiditate facere ab. Inventore praesentium asperiores quas.</p><p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Cupiditate, labore reiciendis, laudantium, nam beatae assumenda obcaecati quasi enim illo eius eaque libero. Minima cupiditate facere ab. Inventore praesentium asperiores quas.</p>',
          image:
            'https://res.cloudinary.com/hpph/image/upload/w_175,e_trim,c_scale/f_auto/v1596451154/hidinginplainsight/starcinema.svg',
        },
        {
          id: 2,
          label: 'Terrazzo repair & restoration',
          location: 'foyer',
          reward: 'Terrazzo workshop',
          reward_description:
            'Limited edition enamel pin badge, featuring illustration by Adam Allsuch Boardman. Comes with commemorative postcard. Delivery within 5 working days',
          value: 50,
          available: 100,
          description:
            '<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Cupiditate, labore reiciendis, laudantium, nam beatae assumenda obcaecati quasi enim illo eius eaque libero. Minima cupiditate facere ab. Inventore praesentium asperiores quas.</p><p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Cupiditate, labore reiciendis, laudantium, nam beatae assumenda obcaecati quasi enim illo eius eaque libero. Minima cupiditate facere ab. Inventore praesentium asperiores quas.</p><p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Cupiditate, labore reiciendis, laudantium, nam beatae assumenda obcaecati quasi enim illo eius eaque libero. Minima cupiditate facere ab. Inventore praesentium asperiores quas.</p>',
          image:
            'https://res.cloudinary.com/hpph/image/upload/w_175,e_trim,c_scale/f_auto/v1596451156/hidinginplainsight/scala.svg',
        },
        {
          id: 3,
          label: 'Façade repair & restoration',
          location: 'external',
          value: 75,
          reward: 'Façade style coasters from Sunken Studio',
          reward_description:
            'Limited edition enamel pin badge, featuring illustration by Adam Allsuch Boardman. Comes with commemorative postcard. Delivery within 5 working days',
          available: 100,
          description:
            '<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Cupiditate, labore reiciendis, laudantium, nam beatae assumenda obcaecati quasi enim illo eius eaque libero. Minima cupiditate facere ab. Inventore praesentium asperiores quas.</p><p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Cupiditate, labore reiciendis, laudantium, nam beatae assumenda obcaecati quasi enim illo eius eaque libero. Minima cupiditate facere ab. Inventore praesentium asperiores quas.</p><p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Cupiditate, labore reiciendis, laudantium, nam beatae assumenda obcaecati quasi enim illo eius eaque libero. Minima cupiditate facere ab. Inventore praesentium asperiores quas.</p>',
          image:
            'https://res.cloudinary.com/hpph/image/upload/w_175,e_trim,c_scale/f_auto/v1596451162/hidinginplainsight/pudseypicturehouse.svg',
        },
        {
          id: 4,
          label: 'Lamppost restoration',
          location: 'external',
          reward: 'Golden lamppost broach',
          reward_description:
            'Limited edition enamel pin badge, featuring illustration by Adam Allsuch Boardman. Comes with commemorative postcard. Delivery within 5 working days',
          value: 100,
          available: 100,
          description:
            '<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Cupiditate, labore reiciendis, laudantium, nam beatae assumenda obcaecati quasi enim illo eius eaque libero. Minima cupiditate facere ab. Inventore praesentium asperiores quas.</p><p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Cupiditate, labore reiciendis, laudantium, nam beatae assumenda obcaecati quasi enim illo eius eaque libero. Minima cupiditate facere ab. Inventore praesentium asperiores quas.</p><p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Cupiditate, labore reiciendis, laudantium, nam beatae assumenda obcaecati quasi enim illo eius eaque libero. Minima cupiditate facere ab. Inventore praesentium asperiores quas.</p>',
          image:
            'https://res.cloudinary.com/hpph/image/upload/w_175,e_trim,c_scale/f_auto/v1595964823/hidinginplainsight/abbeypicturehouse.svg',
        },
        {
          id: 5,
          label: 'Sponsor a seat',
          location: 'main auditorium',
          reward: 'Plaque for lifetime of seat',
          reward_description:
            'Limited edition enamel pin badge, featuring illustration by Adam Allsuch Boardman. Comes with commemorative postcard. Delivery within 5 working days',
          value: 150,
          available: 100,
          description:
            '<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Cupiditate, labore reiciendis, laudantium, nam beatae assumenda obcaecati quasi enim illo eius eaque libero. Minima cupiditate facere ab. Inventore praesentium asperiores quas.</p><p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Cupiditate, labore reiciendis, laudantium, nam beatae assumenda obcaecati quasi enim illo eius eaque libero. Minima cupiditate facere ab. Inventore praesentium asperiores quas.</p><p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Cupiditate, labore reiciendis, laudantium, nam beatae assumenda obcaecati quasi enim illo eius eaque libero. Minima cupiditate facere ab. Inventore praesentium asperiores quas.</p>',
          image:
            'https://res.cloudinary.com/hpph/image/upload/w_175,e_trim,c_scale/f_auto/v1595964823/hidinginplainsight/abbeypicturehouse.svg',
        },
        {
          id: 6,
          label: 'Gas light refurbishment',
          location: 'main auditorium & foyer',
          reward: 'Plaque under lamp',
          reward_description:
            'Limited edition enamel pin badge, featuring illustration by Adam Allsuch Boardman. Comes with commemorative postcard. Delivery within 5 working days',
          value: 1000,
          available: 9,
          description:
            '<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Cupiditate, labore reiciendis, laudantium, nam beatae assumenda obcaecati quasi enim illo eius eaque libero. Minima cupiditate facere ab. Inventore praesentium asperiores quas.</p><p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Cupiditate, labore reiciendis, laudantium, nam beatae assumenda obcaecati quasi enim illo eius eaque libero. Minima cupiditate facere ab. Inventore praesentium asperiores quas.</p><p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Cupiditate, labore reiciendis, laudantium, nam beatae assumenda obcaecati quasi enim illo eius eaque libero. Minima cupiditate facere ab. Inventore praesentium asperiores quas.</p>',
          image:
            'https://res.cloudinary.com/hpph/image/upload/w_175,e_trim,c_scale/f_auto/v1595964823/hidinginplainsight/abbeypicturehouse.svg',
        },
        {
          id: 7,
          label: '35mm projector refurbishment',
          location: 'external',
          reward: 'Plaque on projector and more',
          reward_description:
            'Plaque on projector, ‘become a projectionist’ day at the cinema & thank you slide on screen before every 35mm screening',
          value: 5000,
          available: 2,
          description:
            '<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Cupiditate, labore reiciendis, laudantium, nam beatae assumenda obcaecati quasi enim illo eius eaque libero. Minima cupiditate facere ab. Inventore praesentium asperiores quas.</p><p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Cupiditate, labore reiciendis, laudantium, nam beatae assumenda obcaecati quasi enim illo eius eaque libero. Minima cupiditate facere ab. Inventore praesentium asperiores quas.</p><p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Cupiditate, labore reiciendis, laudantium, nam beatae assumenda obcaecati quasi enim illo eius eaque libero. Minima cupiditate facere ab. Inventore praesentium asperiores quas.</p>',
          image:
            'https://res.cloudinary.com/hpph/image/upload/w_175,e_trim,c_scale/f_auto/v1595964823/hidinginplainsight/abbeypicturehouse.svg',
        },
      ],
      faqs: [
        {
          question: 'How can I gift my sponsorship to another person?',
          answer:
            'If you’d like to make a donation as a gift to a loved one, in the check-out simply select ‘giftsponsorship’. You can also provide us with the person’s name and address if you’d like us to send the rewards directly to them.',
        },
        {
          question:
            'Why are you raising money? Don’t you already have funding?',
          answer:
            'We are hugely grateful for the support we’ve already received on the project from all of our funders. However, alongside the funding grant we received from the National Lottery Heritage Fund, we’ve always needed to raise additional match-funding, and as a result of COVID and Brexit, the match-funding we need to raise has increased. So far we’ve been successful in securing match-funding from Leeds City Council and a variety of trusts and foundations. However we’ve always planned on reaching out to our community to help us raise some of this money. We’ve purposefully waited until now, closer to our reopening date, before reaching out to our community for support.',
        },
        {
          question: 'When will my reward be delivered?',
          answer:
            'Not all rewards will be delivered at the same time. Please see individual sponsorship and reward infomation for details of expected delivery times. The tile coasters produced by Suken Studios are being made to order and by hand. We therefore cannot guarantee exactly when these will be delivered to you, and for later orders these may take a number of months. ',
        },
      ],
    };
  },
  mounted() {},
  computed: {
    currentReward: function() {
      return this.rewards.find(elem => {
        return elem.id == this.currentRewardID;
      });
    },
  },
  watch: {
    // currentRewardID: function() {
    // },
  },

  methods: {
    makeDonation(amount) {
      let donationComponent = document.getElementById('spektrixDonate');
      donationComponent.setAttribute('donation-amount', amount);
      console.log(donationComponent);
      let button = donationComponent.querySelector('button');
      button.click();
      this.showModal = true;
    },
  },
};
</script>

<style lang="scss"></style>

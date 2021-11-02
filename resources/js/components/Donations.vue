<template>
  <div class="w-screen overflow-hidden">
    <div
      class="flex flex-row w-[300vw] lg:w-[166.67vw] transform transition"
      :class="{
        '!translate-x-[-66.667%] lg:!translate-x-[-40%]': currentRewardID,
        'translate-x-[-33.333%]': showRewards,
      }"
    >
      <div class="w-screen p-12 lg:w-2/3 lg:pl-32">
        <div class="flex flex-row items-center gap-4 mb-12 lg:hidden">
          <button
            @click="showRewards = false"
            class="py-3 font-sans text-lg bg-transparent border-none appearance-none"
          >
            Overview
          </button>
          <button
            @click="showRewards = true"
            class="py-3 font-sans text-lg bg-transparent border-none appearance-none"
          >
            Sponsorship opportunities
          </button>
        </div>
        <div class="mt-12 prose-lg lg:pr-12">
          <p>
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Cupiditate,
            labore reiciendis, laudantium, nam beatae assumenda obcaecati quasi
            enim illo eius eaque libero. Minima cupiditate facere ab. Inventore
            praesentium asperiores quas.
          </p>
          <p>
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Cupiditate,
            labore reiciendis, laudantium, nam beatae assumenda obcaecati quasi
            enim illo eius eaque libero. Minima cupiditate facere ab. Inventore
            praesentium asperiores quas.
          </p>
          <p>
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Cupiditate,
            labore reiciendis, laudantium, nam beatae assumenda obcaecati quasi
            enim illo eius eaque libero. Minima cupiditate facere ab. Inventore
            praesentium asperiores quas.
          </p>
          <p>
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Cupiditate,
            labore reiciendis, laudantium, nam beatae assumenda obcaecati quasi
            enim illo eius eaque libero. Minima cupiditate facere ab. Inventore
            praesentium asperiores quas.
          </p>
          <h2 class="mt-16 mb-8 text-3xl cursor-default">
            Frequently asked questions
          </h2>
          <details class="border-2 border-black border-solid">
            <summary class="p-3">What about this?</summary>
            <p class="p-3">
              Lorem ipsum dolor sit amet consectetur adipisicing elit.
              Cupiditate, labore reiciendis, laudantium, nam beatae assumenda
              obcaecati quasi enim illo eius eaque libero. Minima cupiditate
              facere ab. Inventore praesentium asperiores quas.
            </p>
          </details>
          <details
            class="border-2 border-t-0 border-black border-solid cursor-default"
          >
            <summary class="p-3">What about this?</summary>
            <p class="p-3">
              Lorem ipsum dolor sit amet consectetur adipisicing elit.
              Cupiditate, labore reiciendis, laudantium, nam beatae assumenda
              obcaecati quasi enim illo eius eaque libero. Minima cupiditate
              facere ab. Inventore praesentium asperiores quas.
            </p>
          </details>
          <details
            class="border-2 border-t-0 border-black border-solid cursor-default"
          >
            <summary class="p-3">What about this?</summary>
            <p class="p-3">
              Lorem ipsum dolor sit amet consectetur adipisicing elit.
              Cupiditate, labore reiciendis, laudantium, nam beatae assumenda
              obcaecati quasi enim illo eius eaque libero. Minima cupiditate
              facere ab. Inventore praesentium asperiores quas.
            </p>
          </details>
        </div>
      </div>
      <div class="w-screen p-12 bg-gray-100 lg:w-1/3 lg:pr-32">
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
            class="flex flex-row items-center justify-between w-full gap-2 p-4 font-sans text-left bg-white border-none rounded shadow appearance-none hover:ring-4 ring-yellow-200"
            :class="{ 'ring-yellow-300 ring-4': currentRewardID == reward.id }"
          >
            <div>
              <h3 class="mb-1">{{ reward.label }}</h3>
              <p class="mb-0">{{ reward.reward }}</p>
            </div>
            <div class="text-2xl font-bold">£{{ reward.value }}</div>
          </button>
        </div>
      </div>
      <div class="w-screen p-12 prose lg:w-2/3 lg:pr-36">
        <transition name="slide-fade">
          <div class="pt-6" v-if="currentRewardID">
            <button
              @click="currentRewardID = null"
              class="font-sans text-base text-left bg-transparent border-none appearance-none lg:hidden"
            >
              &larr; Back to rewards
            </button>
            <h2 class="mt-6 mb-12 text-5xl">{{ currentReward.label }}</h2>

            <button
              @click="makeDonation(currentReward.value)"
              class="button button__big"
            >
              Select this
            </button>
            <p>
              Lorem ipsum dolor sit amet consectetur adipisicing elit.
              Cupiditate, labore reiciendis, laudantium, nam beatae assumenda
              obcaecati quasi enim illo eius eaque libero. Minima cupiditate
              facere ab. Inventore praesentium asperiores quas.
            </p>
            <p>
              Lorem ipsum dolor sit amet consectetur adipisicing elit.
              Cupiditate, labore reiciendis, laudantium, nam beatae assumenda
              obcaecati quasi enim illo eius eaque libero. Minima cupiditate
              facere ab. Inventore praesentium asperiores quas.
            </p>
            <p>
              Lorem ipsum dolor sit amet consectetur adipisicing elit.
              Cupiditate, labore reiciendis, laudantium, nam beatae assumenda
              obcaecati quasi enim illo eius eaque libero. Minima cupiditate
              facere ab. Inventore praesentium asperiores quas.
            </p>
          </div>
        </transition>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      currentRewardID: null,
      showRewards: false,
      rewards: [
        {
          id: 1,
          label: 'Repainting & plasterwork repair',
          location: 'main auditorium & foyer',
          reward: 'A3 paint sample print',
          value: 25,
          available: 250,
          description:
            'Lorem ipsum dolor sit amet adipisicing elit. Cupiditate, labore reiciendis, laudantium.',
          image:
            'https://res.cloudinary.com/hpph/image/upload/w_175,e_trim,c_scale/f_auto/v1596451154/hidinginplainsight/starcinema.svg',
        },
        {
          id: 2,
          label: 'Terrazzo repair & restoration',
          location: 'foyer',
          reward: 'Terrazzo workshop',
          value: 50,
          available: 100,
          description:
            'Lorem ipsum dolor sit amet adipisicing elit. Cupiditate, labore reiciendis, laudantium.',
          image:
            'https://res.cloudinary.com/hpph/image/upload/w_175,e_trim,c_scale/f_auto/v1596451156/hidinginplainsight/scala.svg',
        },
        {
          id: 3,
          label: 'Façade repair & restoration',
          location: 'external',
          value: 75,
          reward: 'Façade style coasters from Suken Studios',
          available: 100,
          description:
            'Lorem ipsum dolor sit amet adipisicing elit. Cupiditate, labore reiciendis, laudantium.',
          image:
            'https://res.cloudinary.com/hpph/image/upload/w_175,e_trim,c_scale/f_auto/v1596451162/hidinginplainsight/pudseypicturehouse.svg',
        },
        {
          id: 4,
          label: 'Lamppost restoration',
          location: 'external',
          reward: 'Golden lamppost broach',
          value: 100,
          available: 100,
          description:
            'Lorem ipsum dolor sit amet adipisicing elit. Cupiditate, labore reiciendis, laudantium.',
          image:
            'https://res.cloudinary.com/hpph/image/upload/w_175,e_trim,c_scale/f_auto/v1595964823/hidinginplainsight/abbeypicturehouse.svg',
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
    },
  },
};
</script>

<style lang="scss"></style>

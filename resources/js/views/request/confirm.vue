<template>
  <div class="mx-auto max-w-7xl bg-white py-6 px-6 lg:px-8 my-8 sm:rounded-xl shadow">
    <h4 class="font-bold tracking-tight text-gray-900 sm:text-3xl text-2xl">What can you get with your CSC-ID?</h4>
    <p class="mt-6 max-w-full text-xl text-gray-500">
      Please indicate your choice from the list of claimable items using your CSC-ID.
    </p>

    <!-- Tiers -->
    <div class="mt-16 space-y-12 lg:grid lg:grid-cols-3 lg:gap-x-8 lg:space-y-0">
      <div v-for="tier in pricing.tiers" :key="tier.title" class="relative flex flex-col rounded-2xl border border-gray-200 bg-white p-8 shadow-sm">
        <div class="flex-1">
          <h3 class="text-xl font-semibold text-gray-900">{{ tier.title }}</h3>

          <div class="flex justify-center py-6">
            <component :is="tier.icon" class="h-32 w-32 text-gray-300" aria-hidden="true" />
          </div>

          <p class="mt-6 text-gray-500">{{ tier.description }}</p>

          <!-- Feature list -->
          <ul role="list" class="mt-6 space-y-6">
            <li v-for="feature in tier.features" :key="feature" class="flex">
              <XMarkIcon class="h-6 w-6 flex-shrink-0 text-red-500" aria-hidden="true" />
              <span class="ml-3 text-gray-500">{{ feature }}</span>

            </li>
          </ul>
        </div>

        <AppButton class="mt-4" :disabled="tier.disabled" @click="$req.RegisterAPI(tier.buttonType)">{{ tier.cta }}</AppButton>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import { XMarkIcon, LinkIcon, InboxArrowDownIcon, IdentificationIcon } from '@heroicons/vue/24/outline'
import { useRequestStore } from '@/store/RequestStore'

import AppButton from '@/components/form/AppButton.vue'

const $req = useRequestStore()
const pricing = {
  tiers: [
    {
      title: 'Claim to OHRM',
      description: 'You would required to claim from OHRM. The CSC-ID will be printed on paper.',
      features: [
        'Required Lamination'
      ],
      cta: 'Proceed',
      icon: InboxArrowDownIcon,
      buttonType: 'ohrm',
    },
    {
      title: 'Soft Copy',
      description: 'You will be responsible for printing. We recommend for Plastic ID. \n \n',
      features: [
        'Do it yourself (DIY)',
      ],
      cta: 'Proceed',
      icon: LinkIcon,
      buttonType: 'soft',
    },
    {
      title: 'Plastic ID',
      description: 'It can cost below 100 pesos, and it takes 1 day to process (via 3rd party printer).',
      features: [
        'It will cost more',
      ],
      cta: 'Not Available',
      disabled: true,
      icon: IdentificationIcon,
      buttonType: 'plastic',
    },
  ],
}
</script>

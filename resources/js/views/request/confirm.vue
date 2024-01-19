<template>
  <div class="mx-auto max-w-7xl bg-white py-6 px-6 lg:px-8 my-8 sm:rounded-xl shadow">
    <h4 class="font-bold tracking-tight text-gray-900 sm:text-3xl text-2xl">What can you get with your CSC-ID?</h4>
    <p class="mt-6 max-w-full text-xl text-gray-500">
      Please indicate your choice from the list of claimable items using your CSC-ID.
    </p>

    <!-- Tiers -->
    <div class="mt-16 space-y-12 lg:grid lg:grid-cols-3 lg:gap-x-8 lg:space-y-0">
      <div v-for="row in $claim.content" :key="row.name" class="relative flex flex-col rounded-2xl border border-gray-200 bg-white p-8 shadow-sm">
        <div class="flex-1">
          <h3 class="text-xl font-semibold text-gray-900">{{ row.name }}</h3>

          <div class="flex justify-center py-6">
            <component v-if="row.name == 'Claim to ORHM'" :is="InboxArrowDownIcon" class="h-32 w-32 text-gray-300" aria-hidden="true" />
            <component v-else-if="row.name == 'Soft-copy'" :is="LinkIcon" class="h-32 w-32 text-gray-300" aria-hidden="true" />
            <component v-else :is="IdentificationIcon" class="h-32 w-32 text-gray-300" aria-hidden="true" />
          </div>

          <p class="mt-6 text-gray-500">{{ row.description }}</p>

          <!-- Feature list -->
          <ul role="list" class="mt-6 space-y-6">
            <li v-for="feature in JSON.parse(row.features)" :key="feature" class="flex">
              <XMarkIcon class="h-6 w-6 flex-shrink-0 text-red-500" aria-hidden="true" />
              <span class="ml-3 text-gray-500">{{ feature }}</span>
            </li>
          </ul>
        </div>

        <AppButton class="mt-4" :disabled="row.name == 'Plastic ID'" @click="$req.RegisterAPI(row.id)" :loading="$req.config.buttonLoading">{{ row.name }}</AppButton>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import { XMarkIcon, LinkIcon, InboxArrowDownIcon, IdentificationIcon } from '@heroicons/vue/24/outline'
import { useRequestPublicStore } from '@/store/public/RequestPublicStore'
import { useClaimTypePublicStore } from '@/store/public/ClaimTypePublicStore'
import { useRouter } from 'vue-router'
import { onMounted } from 'vue'

import AppButton from '@/components/form/AppButton.vue'

const $req = useRequestPublicStore()
const $claim = useClaimTypePublicStore()
const $router = useRouter()

onMounted(() => {
  if(!$req.params.mobile || !$req.params.picture || !$req.params.position ) {
    $router.push('/')
  }

  $claim.GetAPI()
})
</script>

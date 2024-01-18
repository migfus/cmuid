<template>
  <ul v-if="$verify.content" role="list" class="grid grid-cols-1">
    <li class="col-span-1 divide-y divide-gray-200 rounded-lg bg-white shadow">
      <div class="flex w-full items-center justify-between space-x-6 p-6">
        <div class="flex-1 truncate">
          <h3 class="truncate text-sm font-medium text-gray-900">
            <span class="inline-block flex-shrink-0 rounded-full bg-green-100 px-2 py-0.5 text-lg font-medium text-green-800">
              Verified
            </span>
          </h3>
          <div class="flex items-center space-x-3">
            <h3 class="truncate text-sm font-medium text-gray-900">{{ FullName($verify.content) }}</h3>
          </div>
          <p class="mt-1 truncate text-sm text-gray-500">{{ $verify.content.position }}</p>
          <p class="mt-1 truncate text-sm text-gray-500">{{ $verify.content.unit ?? ''}}, {{ $verify.content.department ?? '' }}</p>
          <p class="mt-1 truncate text-sm text-gray-500">{{ $verify.content.email ?? ''}}</p>
          <p class="mt-1 truncate text-sm text-gray-500">0{{ $verify.content.mobile }}</p>
        </div>
      </div>
      <div class="p-5 grid grid-cols-1 sm:grid-cols-2">
        <div class="">
          <span class="font-strong">Raw Image</span>
          <img class="mt-2 rounded-xl shadow h-64 w-auto mb-2" :src="$verify.content.picture" alt="" />
        </div>
        <div v-if="$verify.content.files">
          <span>Download File</span>
          <img class="mt-2 rounded-xl shadow h-64 w-auto mb-2" :src="$verify.content.files[0].url" alt="" />
          <a :href="$verify.content.files[0].url" target="_blank">
            <AppButton>Download File</AppButton>
          </a>
        </div>
      </div>
    </li>
  </ul>
</template>

<script setup lang="ts">
import { FullName } from '@/helpers/Converter'
import { useVerifyPublicStore } from '@/store/public/VerifyPublicStore'

import AppButton from '@/components/form/AppButton.vue';

const $verify = useVerifyPublicStore()
</script>

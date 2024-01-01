<template>
  <ul v-if="$verify.content" role="list" class="grid grid-cols-1">
    <li class="col-span-1 divide-y divide-gray-200 rounded-lg bg-white shadow">
      <div class="flex w-full items-center justify-between space-x-6 p-6">
        <div class="flex-1 truncate">
          <div class="flex items-center space-x-3">
            <h3 class="truncate text-sm font-medium text-gray-900">{{ FullName($verify.content) }}</h3>
            <span class="inline-block flex-shrink-0 rounded-full bg-green-100 px-2 py-0.5 text-xs font-medium text-green-800">
              Verified
            </span>
          </div>
          <p class="mt-1 truncate text-sm text-gray-500">{{ $verify.content.position }}</p>
          <p class="mt-1 truncate text-sm text-gray-500">{{ $verify.content.unit ?? ''}}, {{ $verify.content.department ?? '' }}</p>
          <p class="mt-1 truncate text-sm text-gray-500">{{ $verify.content.email ?? ''}}</p>
          <p class="mt-1 truncate text-sm text-gray-500">0{{ $verify.content.mobile }}</p>
        </div>
      </div>
      <div class="p-5">
        <img class="mt-2 rounded-xl shadow h-64 w-auto mb-2" :src="$verify.content.picture" alt="" />
      </div>
    </li>
  </ul>
</template>

<script setup lang="ts">
import { FullName } from '@/helpers/Converter'
import { useVerifyStore } from '@/store/VerifyStore'

const $verify = useVerifyStore()
</script>

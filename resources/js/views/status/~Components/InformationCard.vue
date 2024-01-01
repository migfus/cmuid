<template>
  <ul v-if="$status.content" role="list" class="grid grid-cols-1">
    <li class="col-span-1 divide-y divide-gray-200 rounded-lg bg-white shadow">
      <div class="flex w-full items-center justify-between space-x-6 p-6">
        <div class="flex-1 truncate">
          <div class="flex items-center space-x-3">
            <h3 class="truncate text-sm font-medium text-gray-900">{{ FullName($status.content.info) }}</h3>
            <span class="inline-block flex-shrink-0 rounded-full bg-green-100 px-2 py-0.5 text-xs font-medium text-green-800">
              {{  $status.content.status[$status.content.status.length - 1].category.name }}
            </span>
          </div>
          <p class="mt-1 truncate text-sm text-gray-500">{{ $status.content.info.position }}</p>
          <p class="mt-1 truncate text-sm text-gray-500">{{ $status.content.info.unit ?? ''}}, {{ $status.content.info.department ?? '' }}</p>
          <p class="mt-1 truncate text-sm text-gray-500">{{ $status.content.info.email ?? ''}}</p>
          <p class="mt-1 truncate text-sm text-gray-500">0{{ $status.content.info.mobile }}</p>
        </div>
      </div>
      <div class="p-5">
        <img class="mt-2 rounded-xl shadow h-64 w-auto mb-2" :src="$status.content.info.picture" alt="" />
      </div>
    </li>
  </ul>
</template>

<script setup lang="ts">
import { FullName } from '@/helpers/Converter'
import { useStatusStore } from '@/store/StatusStore'

const $status = useStatusStore()
</script>

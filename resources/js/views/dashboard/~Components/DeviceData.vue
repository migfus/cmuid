<template>
  <li>
    <div class="block hover:bg-gray-50">
      <div class="px-4 py-4 sm:px-6">
        <div class="flex items-center justify-between">
          <p class="truncate text-md font-medium text-gray-600">{{ $props.name }}</p>
          <div class="ml-2 flex flex-shrink-0">
            <p v-if="moment().diff($props.last_response, 'minute') <= 2" class="inline-flex rounded-full bg-green-100 px-2 text-xs font-semibold leading-5 text-green-800">Active</p>
            <p v-else-if="moment().diff($props.last_response, 'minute') <= 5" class="inline-flex rounded-full bg-gray-100 px-2 text-xs font-semibold leading-5 text-gray-800">Sleeping</p>
            <p v-else class="inline-flex rounded-full bg-red-100 px-2 text-xs font-semibold leading-5 text-red-800">Inactive</p>
          </div>
        </div>
        <div class="mt-2 sm:flex sm:justify-between">
          <div class="sm:flex">

            <p class="flex items-center text-sm text-gray-500">
              <DevicePhoneMobileIcon class="mr-1.5 h-5 w-5 flex-shrink-0 text-gray-400" aria-hidden="true" />
              {{ $props.platform }}
            </p>

          </div>

          <div  class="mt-2 flex items-center text-sm text-gray-500 sm:mt-0">
            <p>
              Active {{ }}
              <time :datetime="moment($props.last_response).format('MM/DD/YYYY')">{{ moment($props.last_response).fromNow(true) }}</time>
            </p>
          </div>
        </div>

        <div class="grid grid-cols-2 mt-4 justify-evenly">
        </div>

        {{ moment().diff($props.last_response, 'minute') }}

      </div>
    </div>
  </li>
</template>

<script setup lang="ts">
import moment from 'moment'
import { DevicePhoneMobileIcon, CalendarIcon,  } from '@heroicons/vue/20/solid'

const $props = defineProps<{
  id: string,
  name: string
  platform: string
  last_response: string
}>()
</script>

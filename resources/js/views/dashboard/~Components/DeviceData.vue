<template>
  <li>
    <div class="block hover:bg-gray-50">
      <div class="px-4 py-4 sm:px-6">
        <div class="flex items-center justify-between">
          <p class="truncate text-md font-medium text-gray-600">{{ $props.name }}</p>
          <div class="ml-2 flex flex-shrink-0">
            <p class="inline-flex rounded-full bg-green-100 px-2 text-xs font-semibold leading-5 text-green-800">Active</p>
          </div>
        </div>
        <div class="mt-2 sm:flex sm:justify-between">
          <div class="sm:flex">

            <p class="flex items-center text-sm text-gray-500">
              <DevicePhoneMobileIcon class="mr-1.5 h-5 w-5 flex-shrink-0 text-gray-400" aria-hidden="true" />
              {{ $props.platform }}
            </p>

          </div>
          <div class="mt-2 flex items-center text-sm text-gray-500 sm:mt-0">
            <CalendarIcon class="mr-1.5 h-5 w-5 flex-shrink-0 text-gray-400" aria-hidden="true" />
            <p>
              Active
              <time :datetime="moment($props.last_response).format('MM/DD/YYYY')">{{ moment($props.last_response).fromNow() }}</time>
            </p>
          </div>
        </div>

        <div class="grid grid-cols-2 mt-4 justify-evenly">
          <!-- <img :src="row.picture" class="h-48 w-auto rounded-xl"/>
          <div class="flex justify-end gap-2">
            <AppButton @click="$request.params.id = row.id; $request.ShowChange('Cancel', FullName(row))" :loading="$request.config.buttonLoading" color="danger" class="mt-auto">Cancel</AppButton>
            <AppButton @click="$request.params.id = row.id; $request.ShowChange('Feedback', FullName(row))" :loading="$request.config.buttonLoading" class="mt-auto">Feedback</AppButton>
            <AppButton @click="$request.params.id = row.id; $request.ShowChange('Done', FullName(row))" :loading="$request.config.buttonLoading" class="mt-auto">Done</AppButton>
          </div> -->
        </div>

      </div>
    </div>
  </li>
</template>

<script setup lang="ts">
import moment from 'moment'
import { DevicePhoneMobileIcon, CalendarIcon } from '@heroicons/vue/20/solid'

const $props = defineProps<{
  id: string,
  name: string
  platform: string
  last_response: string
}>()
</script>
